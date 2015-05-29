/**
 *
 *
 *
 * @param options object
 * @TODO Progressive loading
 * @TODO Layers 
 * @TODO Events
 * @TODO Animated pan
 * 
 * Already made:
 * @TODO Controls
 * @TODO Pan into the clicked area
 * @TODO Constraint the moviment into the window when zooming in and zooming out
 * @TODO Constraint the moviment into the window 
 */

var JjGiantImageViewer = Class.create({
	maxPadding: 30,
	initialize: function(options)
	{
		this.options = options || {};
		
		this.options.div = this.options.div || false;
		this.options.canvas = this.options.canvas || {};
		this.options.scales = this.options.scales || [1];
		
		this.currentZoomIndex = 0;
		this.window = {top: 0, bottom: 0, left:0, right:0};
		this.cache = {heights: {}, widths: {}};
		this.dragging = {enabled: false, mouse: {}};
		this.clickCount = {right: 0, left:0};
		this.currentPosition = {x:0, y:0};
		this.layers = [];
		this.matrix = [];
		
		if (document.loaded)
			this.completeInitialization();
		else
			document.observe('dom:loaded', this.completeInitialization.bind(this));
	},
	completeInitialization: function()
	{
		this.div = $(this.options.div);
		this.div.insert(this.layersContainer = new Element('div', {style: 'position:absolute;'}));
		this.layersContainer.insert(this.tileContainer = new Element('div'));
		
		if (Object.isArray(this.options.layers))
		{
			this.layers = this.options.layers.map(function(layerName)
			{
				var layer = new Element('div', {className: 'layer '+layerName});
				this.layersContainer.insert(layer);
				return layer;
			}.bind(this));
		}
		
		this.div.on('mousedown', this.mouseDownHandler.bind(this));
		this.div.on('contextmenu', function(ev){ev.stop();});
		document.observe('mouseup', this.stopDrag.bind(this))
			.observe('mousemove', this.drag.bind(this));
		
		this.div
			.addClassName('giant_image_viewer')
			.setStyle({
				height: this.options.canvas.height+"px",	overflow: 'hidden',
				width: this.options.canvas.width+"px",		position: 'relative'
			});
		
		this.div.insert(
			new Element('div', {className: 'control'})
				.insert(
					new Element('div', {className: 'direction'})
						.insert(this.buttonMoveUp = new Element('a', {href: '#', className: 'up'}))
						.insert(this.buttonMoveDown = new Element('a', {href: '#', className: 'down'}))
						.insert(this.buttonMoveLeft = new Element('a', {href: '#', className: 'left'}))
						.insert(this.buttonMoveRight = new Element('a', {href: '#', className: 'right'}))
				)
				.insert(this.buttonMoreZoom = new Element('a', {href: '#', className: 'zoom more_zoom'}))
				.insert(this.buttonLessZoom = new Element('a', {href: '#', className: 'zoom less_zoom'}))
		);
		
		stopPropagating = function(ev){ev.stop();}
		
		this.buttonMoreZoom
			.observe('click', function(ev){ ev.stop(); this.increaseZoom(); }.bind(this))
			.observe('mousedown', stopPropagating);
		this.buttonLessZoom
			.observe('click', function(ev){ ev.stop(); this.decreaseZoom(); }.bind(this))
			.observe('mousedown', stopPropagating);
		
		this.buttonMoveUp
			.observe('click', function(ev){ ev.stop(); this.moveBy(0,  10); }.bind(this)).observe('mousedown', stopPropagating);
		this.buttonMoveDown
			.observe('click', function(ev){ ev.stop(); this.moveBy(0, -10); }.bind(this)).observe('mousedown', stopPropagating);
		this.buttonMoveLeft
			.observe('click', function(ev){ ev.stop(); this.moveBy( 10, 0); }.bind(this)).observe('mousedown', stopPropagating);
		this.buttonMoveRight
			.observe('click', function(ev){ ev.stop(); this.moveBy(-10, 0); }.bind(this)).observe('mousedown', stopPropagating);
		
		this.queue = new JjImageLoader();
		
		try
		{
			this.moveContainerTo(
				(this.options.canvas.width-this.getWidth())/2,
				(this.options.canvas.height-this.getHeight())/2
			);
			this.renderZoomChange();
		}
		catch(err)
		{
			console.error(err);
		}
	},
	mouseDownHandler: function(ev)
	{
		ev.stop();
		
		this.dragging.mouse = {
			x_initial: ev.pointerX(),
			y_initial: ev.pointerY()
		};
		
		var clickType = ev.isRightClick() ? 'right' : ( ev.isLeftClick() ? 'left' : false );
		if (clickType)
		{
			this.clickCount[clickType]++;
			if (this.clickCount[clickType] == 2)
			{
				this.clickCount[clickType] = 0;
				switch (clickType)
				{
					case 'right': this.decreaseZoom(); break;
					case 'left': this.increaseZoom(); break;
				}
			}
			
			window.setTimeout(this.resetDblClick.bind(this), 500);
		}
	},
	resetDblClick: function()
	{
		this.clickCount.left =
		this.clickCount.right = 0;
	},
	startDrag: function()
	{
		var layout = this.layersContainer.getLayout();
		this.dragging = {
			enabled: true,
			dx_initial: this.dragging.mouse.x_initial-layout.get('left'),
			dy_initial: this.dragging.mouse.y_initial-layout.get('top')
		};
		this.resetDblClick();
	},
	stopDrag: function(ev)
	{
		this.dragging.enabled = false;
	},
	drag: function(ev)
	{
		if (!this.dragging.enabled)
		{
			if (this.clickCount.left)
			{
				var dx = this.dragging.mouse.x_initial - ev.pointerX(),
					dy = this.dragging.mouse.y_initial - ev.pointerY();
	
				if (Math.sqrt(dx*dx+dy*dy) > 10)
					this.startDrag();
			}
			return;
		}
		
		this.moveContainerTo(
			(ev.pointerX() - this.dragging.dx_initial),
			(ev.pointerY() - this.dragging.dy_initial)
		);
		this.renderZoomChange();
	},
	increaseZoom: function()
	{
		var zoomDiff = 0,
			oldZoom = this.currentZoomIndex,
			layout = this.layersContainer.getLayout();

		this.currentZoomIndex = Math.min(this.options.scales.length-1, this.currentZoomIndex+1);
		
		if (oldZoom == this.currentZoomIndex)
			return;
		
		zoomDiff = this.options.scales[this.currentZoomIndex]-this.options.scales[oldZoom];
		this.moveContainerTo(
			layout.get('left') - this.options.originalSize.width*zoomDiff*(this.window.right+this.window.left)/2,
			layout.get('top') - this.options.originalSize.height*zoomDiff*(this.window.top+this.window.bottom)/2
		);
		
		this.renderZoomChange();
	},
	decreaseZoom: function()
	{
		var zoomDiff = 0,
			oldZoom = this.currentZoomIndex,
			layout = this.layersContainer.getLayout();

		this.currentZoomIndex = Math.max(0, this.currentZoomIndex-1);
		
		if (oldZoom == this.currentZoomIndex)
			return;

		zoomDiff = this.options.scales[this.currentZoomIndex]-this.options.scales[oldZoom];
		this.moveContainerTo(
			layout.get('left') - this.options.originalSize.width*zoomDiff*(this.window.right+this.window.left)/2,
			layout.get('top') - this.options.originalSize.height*zoomDiff*(this.window.top+this.window.bottom)/2
		);
		
		this.renderZoomChange();
	},
	renderZoomChange: function()
	{
		var col,row,
			scale = this.options.scales[this.currentZoomIndex],
			colsCoeficient = this.options.originalSize.width*scale/this.options.tileSize,
			rowsCoeficient = this.options.originalSize.height*scale/this.options.tileSize,
			totalCols = Math.ceil(colsCoeficient),
			totalRows = Math.ceil(rowsCoeficient),
			cols = {
				start: Math.max(0, Math.floor(this.window.left*colsCoeficient)),
				end: Math.min(totalCols, Math.ceil(this.window.right*colsCoeficient))
			},
			rows = {
				start: Math.max(0, Math.floor(this.window.top*rowsCoeficient)),
				end: Math.min(totalRows, Math.ceil(this.window.bottom*rowsCoeficient))
			};
		
		if (this.matrix.length != totalRows)
		{
			this.tileContainer.update();
			this.matrix = new Array(totalRows);
			for (row = 0; row < totalRows; row++)
				this.matrix[row] = new Array(totalCols);
		}
		
		for (row = rows.start; row < rows.end; row++)
			for (col = cols.start; col < cols.end; col++)
				if (!this.matrix[row][col])
					this.queue.push(this.options.src + scale + '/' + (row*totalCols+col) + '.jpg', this.placeTile.bind(this, row, col));

		this.layers.each(function(layer){
			layer.setStyle({
				'width': this.getWidth()+'px',
				'height': this.getHeight()+'px'
			});
		}.bind(this));
	},
	placeTile: function(row, col, imgParams)
	{
		this.tileContainer.insert(imgParams.img);
		imgParams.img.setStyle({
			position: 'absolute',
			top: (row*this.options.tileSize)+'px',
			left: (col*this.options.tileSize)+'px'
		});
		this.matrix[row][col] = true;
	},
	getWidth: function()
	{
		if (!this.cache.widths[this.currentZoomIndex])
			this.cache.widths[this.currentZoomIndex] = this.options.scales[this.currentZoomIndex] * this.options.originalSize.width;
		
		return this.cache.widths[this.currentZoomIndex];
	},
	getHeight: function()
	{
		if (!this.cache.heights[this.currentZoomIndex])
			this.cache.heights[this.currentZoomIndex] = this.options.scales[this.currentZoomIndex] * this.options.originalSize.height;
		
		return this.cache.heights[this.currentZoomIndex];
	},
	moveBy: function(dx, dy)
	{
		var layout = this.layersContainer.getLayout();
		this.moveContainerTo(
			layout.get('left')+dx,
			layout.get('top')+dy
		);
	},
	moveContainerTo: function(x, y)
	{
		if (this.getWidth() > this.options.canvas.width-2*this.maxPadding)
		{
			x = Math.min(x, this.maxPadding);
			x = Math.max(x, this.options.canvas.width-this.getWidth()-this.maxPadding);
		}
		else
		{
			x = Math.max(x, this.maxPadding);
			x = Math.min(x, this.options.canvas.width-this.getWidth()-this.maxPadding);
		}
		
		if (this.getHeight() > this.options.canvas.height-2*this.maxPadding)
		{
			y = Math.min(y, this.maxPadding);
			y = Math.max(y, this.options.canvas.height-this.getHeight()-this.maxPadding);
		}
		else
		{
			y = Math.max(y, this.maxPadding);
			y = Math.min(y, this.options.canvas.height-this.getHeight()-this.maxPadding);
		}
		
		this.computeWindow(x, y);

		this.layersContainer.setStyle({left: Math.round(x)+'px', top: Math.round(y)+'px'});
	},
	computeWindow: function(x, y)
	{
		this.window = {
			top: 	-y/this.getHeight(),
			bottom:	(-y+this.options.canvas.height)/this.getHeight(),
			left:	-x/this.getWidth(),
			right:	(-x+this.options.canvas.width)/this.getWidth()
		};
	}
});



/**
 * A simple img queue loader
 * 
 */
var JjImageLoader = Class.create({
	maxSimultaneous: 4,
	initialize: function()
	{
		this.loading = 0;
		this.queue = [];
	},
	push: function(url, callback)
	{
		this.queue.push({url: url, callback: callback});
		this.loadNext();
	},
	loadNext: function()
	{
		if (this.loading >= this.maxSimultaneous || !this.queue.length)
			return;
		
		this.loading++;
		var imgParams = this.queue.shift(),
			img = new Image();
		
		imgParams.img = img;
		img.onload = this.loadHandler.bindAsEventListener(this, imgParams);
		img.src = imgParams.url;
	},
	loadHandler: function(ev, imgParams)
	{
		if (Object.isFunction(imgParams.callback))
			imgParams.callback(imgParams);
		
		this.loading--;
		this.loadNext();
	}
});
