var Mexc = {};
/**
 * Handles the login popup
 * 
 */
Mexc.LoginPopup = Class.create({
	initialize: function(link_id, box_id)
	{
		this.ids = {link_id:link_id, box_id:box_id};
		if (document.loaded) this.loaded();
		else document.observe('dom:loaded', this.loaded.bind(this));
	},
	loaded: function(ev)
	{
		this.loginBox = $(this.ids.box_id);
		this.link = $(this.ids.link_id);
		
		this.link.observe('click', this.open.bind(this));
		this.link.observe('mousedown', this.active.bind(this));
		document.observe('click', this.close.bind(this));
	},
	active: function(ev)
	{
		this.link.addClassName('activated');
	},
	open: function(ev)
	{
		ev.stop();
		this.loginBox.show();
		
		new Effect.ScrollTo('site', {
			duration: 0.5,
			afterFinish:function() {
				var input = this.loginBox.down('input[type=text]');
				input.focus();
				input.select();
			}.bind(this)
		});
	},
	close: function(ev)
	{
		var element = ev.findElement('#'+this.ids.box_id);
		if (!element || element == document)
		{
			this.loginBox.fade({duration:0.2});
			this.link.removeClassName('activated');
		}
	}
});


/**
 * Handles the 'Programas' section in the first page
 * where all sub-sites are shown
 */
Mexc.SitePreview = Class.create({
	initialize: function(id)
	{
		this.div = $(id);
		this.previews = this.div.select('.fact_site_minipreview').invoke('hide');
		this.index = Math.floor(Math.random()*this.previews.length)		
		
		this.div
			.observe('mouseover', this.over.bind(this))
			.observe('mouseout', this.out.bind(this));
		this.over = false;
		this.show();
		this.startSlideshow();
	},
	startSlideshow: function()
	{
		this.executer = new PeriodicalExecuter(this.show.bind(this), 4);
	},
	over: function(ev)
	{
		this.over=true;
	},
	out: function(ev)
	{
		this.over=false;
	},
	show: function()
	{
		if (!this.over)
		{
			current = this.index;
			this.index = next = (this.index+1) % this.previews.length;
			if (next == current)
				return this.previews[current].show();
			
			new Effect.Parallel([
				new Effect.Fade(this.previews[current], { sync: true }),
				new Effect.Appear(this.previews[next], { sync: true }) 
			], { duration: 1 });
		}
	}
});

/**
 * Gallery interface
 */
Mexc.GalleryRoller = Class.create({
	initialize: function(id, url)
	{
		this.url = url;
		this.div = $(id);
		this.link = this.div.down('a.more_content');
		this.link.observe('click', this.more.bind(this));
		
		this.loading = this.link.next('img');
		if (this.loading)
			this.loading.hide();
		
		this.updateable = this.div.down('div.updateable');
		this.cache = $H({});
		this.full = false;
		this.current = this.updateable.readAttribute('id').replace('id', '');

		this.cache.set(this.current, this.updateable.innerHTML);
	},
	more: function(ev)
	{
		ev.stop();
		if (this.full)
			this.pickRandom();
		else
			new Ajax.Request(this.url, {
				parameters: {'data[ids]': this.cache.keys().join('|')},
				onCreate: function()
				{
					if (this.loading) this.loading.show();
				}.bind(this),
				onComplete: function(response)
				{
					if ((json = response.responseJSON) && json.content)
					{
						this.cache.set(json.id, json.content);
						var img_src = json.content.match(/img.+src="([^"]+)"/)
						if (img_src.length > 1)
						{
							var I = new Image();
							I.onload = this.update.bind(this, json.id);
							I.src = img_src[1];
						}
						else
						{
							this.update(json.id);
						}
					}
					else
					{
						this.full = true;
						this.pickRandom();
					}
				}.bind(this)
			});
	},
	pickRandom: function()
	{
		var keys = this.cache.keys();
		if (this.current)
			keys.splice(keys.indexOf(this.current), 1);
		this.update(keys[Math.floor(Math.random()*(keys.length-0.001))]);
	},
	update: function(id)
	{
		this.current = id;
		this.updateable.update(this.cache.get(id));
		if (this.loading)
			this.loading.hide();
	}
});

/**
 * Autocompleter used on search input
 * 
 */
Mexc.Autocompleter = Class.create({
	initialize: function(input_id, div_id, url)
	{
		this.request = false;
		this.updateable = $(div_id);
		this.url = url;
		this.input = $(input_id);
		
		this.input.observe('focus', this.cancelClose.bind(this));
		this.input.observe('blur', this.scheduleClose.bind(this));
		this.input.writeAttribute('autocomplete', 'off');
		this.input.store('old_value', this.input.value);
		
		this.pe = new PeriodicalExecuter(this.checkInput.bind(this), 0.5);
	},
	scheduleClose: function(ev)
	{
		this.timeout = window.setTimeout(this.close.bind(this), 2000);
	},
	cancelClose: function(ev)
	{
		if (this.timeout)
			window.clearTimeout(this.timeout);
		this.timeout = false;
	},
	checkInput: function(pe)
	{
		if (this.input.value != this.input.retrieve('old_value') && !this.request)
		{
			this.input.store('old_value', this.input.value);
			if (this.input.value.length >= 3)
				this.request = new Ajax.Request(this.url, {parameters: this.input.serialize(), onComplete: this.complete.bind(this)});
			else
				this.close();
		}
	},
	complete: function(response)
	{
		this.updateable.show();
		this.request = false;
		if (response.responseJSON)
			this.parseData(response.responseJSON);
		else
			this.close();
	},
	parseData: function(json)
	{
		this.updateable.update();
		$H(json).each(function(pair){
			if (!pair.value.content)
				return;
			
			if (!Object.isArray(pair.value.content))
				pair.value.content = [pair.value.content];

			if (pair.value.content.length)
			{
				var content = pair.value.content.map(this.createSearchLink.bind(this)),
					label, span;
				
				if (pair.value.label)
					label = new Element('span').insert(pair.value.label);
				
				span = new Element('span');
				while (content.length)
					span.insert(content.pop()).insert('&ensp;');
				
				this.updateable.insert(
					new Element('div').insert(label).insert(label?'&emsp;':'').insert(span)
				);
			}
		}.bind(this));
	},
	createSearchLink: function (data)
	{
		return (new Element('a', {href: '', 'mexc:search':data.search}).insert(data.label).observe('click', this.clickSearch.bind(this)));
	},
	clickSearch: function(ev)
	{
		ev.stop();
		var search_str = ev.findElement('a').readAttribute('mexc:search');
		location.href = this.input.up('form').action + '?' + this.input.name + '=' + search_str;
	},
	close: function()
	{
		var ef = new Effect.BlindUp(this.updateable, {duration: 0.3});
	}
});

/**
 * General No-Paste script
 * 
 */
Mexc.NoPaste = Class.create({
	threshold: 5,
	initialize : function (input_id)
	{
		this.input = $(input_id);
		this.old_value = this.input.value;
		this.pe = new PeriodicalExecuter(this.checkInput.bind(this), 0.2);
	},
	checkInput: function(pe)
	{
		if(this.old_value.length - this.input.value.length < -this.threshold)
		{
			this.input.value = '';
		}
		this.old_value = this.input.value;
	}
});


Mexc.Veil = Class.create({
	initialize: function(ontop)
	{
		this.ontop = $(ontop);
		this.veil = new Element('div', {className: 'veil'}).setOpacity(0);
		document.body.appendChild(this.veil);
		this.veil.insert({after: ontop});
		this.veil.style.zIndex = 999;
		
		new Effect.Opacity(this.veil, {from:0, to:0.6, afterFinish: Element.show.bind(ontop, ontop)});
		ontop.makePositioned().setStyle({zIndex: 1000}).hide();
		
		this.resizeBinded = this.resize.bind(this)
		Event.observe(window, 'resize', this.resizeBinded);
		Event.observe(window, 'scroll', this.resizeBinded);
		this.resize();
	},
	resize: function()
	{
		this.veil.setStyle({
			'top': document.viewport.getScrollOffsets().top+'px',
			'left': document.viewport.getScrollOffsets().left+'px',
			'height': document.viewport.getHeight()+'px',
			'width': document.viewport.getWidth()+'px'
		});
	},
	hide: function()
	{
		this.veil.setStyle({
			'display': 'none',
		});
	},
	destroy: function()
	{
		Event.stopObserving(window, 'resize', this.resizeBinded);
		Event.stopObserving(window, 'scroll', this.resizeBinded);
		this.veil.remove();
		this.ontop.undoPositioned();
	}
});

/**
 * Digital Collection input tags change on advanced search
 *
 */
function AddTextToTag(text)
	{
		if (text == '')
		{
			$("MexcDigitalCollectionTags").value = "";
			return;
		}
		if ($("MexcDigitalCollectionTags").value.search(text) < 0) 
		{
			$("MexcDigitalCollectionTags").value = text + $("MexcDigitalCollectionTags").value;
		}
	}
