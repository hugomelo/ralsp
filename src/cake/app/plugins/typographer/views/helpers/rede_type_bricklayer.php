<?php

App::import('Helper', 'Typographer.TypeBricklayer');

class RedeTypeBricklayerHelper extends TypeBricklayerHelper
{

	public function __construct($options = array())
	{
		$this->helpers += array('Ajax', 'Html', 'Js' => 'prototype', 'Form', 'Burocrata.BuroOfficeBoy');
		return parent::__construct($options);
	}

/**
 * logic executed before render the view
 * 
 * @access public
 * @return void 
 */
	public function beforeRender()
	{
		// Kludge! Needed this to wrap the radio on a div (and than, fixing an CSS issue).
		$this->Html->tags['radio'] = $this->divDry($this->Html->tags['radio']);
	}
/**
 * Adding mexc.js to layout
 * 
 * @access public
 * @return void
 */
	public function afterRender()
	{
		if (ClassRegistry::getObject('view'))
			$this->Html->script('mexc', array('inline' => false));
	}

/**
 * Formats the document number
 * 
 * @access public
 * @return strine HTML of <span> with an formated CNPJ or CPF
 */
	public function formatString($htmlAttr = array(), $options = array(), $c = null)
	{
		$options += array(
			'type' => false
		);
		
		$c = preg_replace("/[^0-9]/", '', $c);
		switch ($options['type'])
		{
			case 'cnpj':
				$c = sprintf('%s.%s.%s / %s-%s', substr($c,0,2), substr($c,2,3),substr($c,5,3),substr($c,8,4),substr($c,12,2));
			break;
			case 'cpf':
				$c = sprintf('%s.%s.%s-%s', substr($c,0,3), substr($c,3,3),substr($c,6,3),substr($c,9,2));
			break;
			case 'phone':
				$c = sprintf('(%s) %s-%s', substr($c,0,2), substr($c,2,4), substr($c,6,4));
			break;
		}
		return $this->span($htmlAttr, $options, $c);
	}

/**
 * Like an <br /> but is not.
 * 
 * @access public
 * @return string Html code
 */
	public function verticalSpacer($htmlAttr = array())
	{
		$htmlAttr = $this->_mergeAttributes($htmlAttr, array('class' => 'vertical_spacer'));
		return $this->div($htmlAttr, null, ' ');
	}

/**
 * List of tags
 * 
 * @access public
 */
	function tagList($htmlAttr = array(), $options = array())
	{
		$options += array(
			'tags' => false,
			'before' => __d('tags', 'Marcado como', true)
		);
		extract($options);
		if (!isset($tags) || !is_array($tags))
			trigger_error ('RedeTypeBricklayerHelper::stagList() -  Received nothing here. Must pass an array on parameter named \'tags\'.');

		$out = '';
		if (!empty($tags))
		{
			if (isset($tags['Tag']))
				$tags = $tags['Tag'];
			
			$htmlAttr = $this->_mergeAttributes($htmlAttr, array('class' => array('tag_link', 'light')));
			foreach ($tags as $tag)
			{
				$tags_links[] = $this->anchor(
					array('class' => 'tag_link'),
					array('url' => '/'),
					$tag['name']
				);
			}
			$out .=  $before . ' ' . implode(', ', $tags_links) . '.';
		}
		return $this->p($htmlAttr, array(), $out);
	}
	
/**
 * Creates a space tag using a span
 * 
 * @access public
 */
	function mexcSpaceTag($htmlAttr = array(), $options = array())
	{
		$options += array('space_id' => false);
		$View = ClassRegistry::getObject('view');
		$spaces = $View->viewVars['spaces'];
		
		if ($options['space_id'] && array_key_exists($options['space_id'], $spaces))
		{
			$name = $spaces[$options['space_id']]['MexcSpace']['name'];
			$htmlAttr = $this->_mergeAttributes($htmlAttr, array('class' => 'space_tag'));
			$htmlAttr = $this->_mergeAttributes($htmlAttr, array('class' => $options['space_id']));
			return $this->span($htmlAttr, $options, $name);
		}
		else
		{
			trigger_error('RedeTypeBricklayerHelper::mexcSpaceTag - `space_id` não foi especificado ou não existe. Dado '.$options['space_id']);
		}
	}

/**
 * Creates a span to readability
 * 
 * @access public
 */
	function shiddenSpan($htmlAttr = array(), $options = array())
	{
		$htmlAttr = $this->_mergeAttributes($htmlAttr, array('class' => 'hidden'));
		return parent::sspan($htmlAttr, $options);
	}

/**
 * Ends the hidden span
 * 
 * @access public
 */
	function ehiddenSpan()
	{
		return parent::espan();
	}

/**
 * Overloads the anchor for types implementations
 * 
 * @access public
 */
	function anchor($htmlAttr = array(), $options = array(), $content = '')
	{
		$options += array('type' => false, 'space' => 'museu');
		extract($options);
		unset($options['type']);
		
		if (isset($section))
		{
			unset($options['section']);
			if (isset($section['FactSection']))
				$section = $section['FactSection'];
			
			if ($options['space'] == 'museu')
				trigger_error('RedeTypeBricklayerHelper::anchor() - Space must not be "museu", when using [section].');
				
			$options['url'] = array();
			switch ($section['type'])
			{
				case 'content_stream':
					$options['url']['plugin'] = 'site_factory';
					$options['url']['controller'] = 'fact_sites';
					$options['url']['action'] = 'page';
					$options['url'][] = $section['id'];
					$options['url'][] = strtolower(Inflector::slug($section['name']));
				break;
				
				case 'sui_subscription':
					$options['url']['plugin'] = 'sui';
					$options['url']['controller'] = 'sui_fact_subscriptions';
					$options['url']['action'] = 'index';
					$options['url'][] = $section['id'];
				break;
				
				case 'mojo':
					$options['url']['plugin'] = 'mojo';
					$options['url']['controller'] = 'mojos';
					$options['url']['action'] = 'index';
					$options['url'][] = $section['id'];
				break;
				
				default:
					$config = Configure::read('jj.modules.'.$section['type']);
					if (empty($config))
					{
						trigger_error('RedeTypeBricklayerHelper::anchor() - Config jj.modules.'.$section['type'].' not found');
					}
					else
					{
						list($plugin, $model) = pluginSplit($config['model']);
						$options['url']['plugin'] = Inflector::underscore($plugin);
						$options['url']['controller'] = Inflector::underscore(Inflector::pluralize($model));
						$options['url']['action'] = 'index';
					}
				break;
			}
		}
		
		switch ($type)
		{
			case 'vertical_menu':
				return $this->div(
					array('class' => array('vertical_menu')),
					array(),
					parent::anchor($htmlAttr, $options, $content)
				);
			break;
			
			case 'to_right':
				$htmlAttr = $this->_mergeAttributes($htmlAttr, array('class' => 'glyphed hand right'));
				$content .= $this->spanDry('&nbsp;');
			break;
			
			case 'to_left':
				$htmlAttr = $this->_mergeAttributes($htmlAttr, array('class' => 'glyphed hand left'));
				$content = $this->spanDry('&nbsp;') . $content;
			break;
			
			case 'glyphed':
				$htmlAttr = $this->_mergeAttributes($htmlAttr, array('class' => 'glyphed'));
			break;
				
		}
		
		unset($options['space']);
		if (!empty($space) && $space != 'museu')
		{
			if (!is_array($options['url']))
				trigger_error('RedeTypeBricklayerHelper::anchor - `url` must be an array to `space` work.');
			else
				$options['url']['space'] = $space;
		}
		
		return parent::anchor($htmlAttr, $options, $content);
	}

/**
 * 
 * 
 * @access public
 */
	function sbox($htmlAttr = array(), $options = array())
	{
		if (isset($options['type']))
		{
			switch ($options['type'])
			{
				case 'hatched_cloud':
					$htmlAttr = $this->_mergeAttributes($htmlAttr, array('class' => array('hatched')));
				case 'cloud':
					if (!isset($options['size']['m'])) $options['size']['m'] = 0;
					$options['size']['m'] -= 2;
					
					$htmlAttr = $this->_mergeAttributes($htmlAttr, array('class' => array('cloud')));
				break;
				
				case 'sky':
					if (!isset($options['size']['m'])) $options['size']['m'] = 0;
					$options['size']['m'] -= 2;
					
					$htmlAttr = $this->_mergeAttributes($htmlAttr, array('class' => array('sky')));
				break;
				
				case 'inner_column':
					if (!isset($options['size']['m'])) $options['size']['m'] = 0;
					$options['size']['m'] -= 2;
				break;
				
				case 'dark_featured':
					if (!isset($options['size']['m'])) $options['size']['m'] = 0;
					$options['size']['m'] -= 2;
					
					$htmlAttr = $this->_mergeAttributes($htmlAttr, array('class' => array('dark_featured')));
				break;
			}
		}	
		return parent::sbox($htmlAttr, $options);
	}

/**
 * 
 * 
 * @access public
 */
	function sboxContainer($htmlAttr = array(), $options = array())
	{
		$options += array('type' => false);
		switch ($options['type'])
		{
			case 'fact_site':
				$htmlAttr = $this->_mergeAttributes($htmlAttr, array('class' => array('fact_site')));
				// if (!isset($options['size']['u'])) $options['size']['u'] = 0;
					// $options['size']['u'] -= 2;
				// if (!isset($options['size']['m'])) $options['size']['m'] = 0;
					// $options['size']['m'] -= 1;
			break;
			case 'column_container':
				$htmlAttr =  $this->_mergeAttributes($htmlAttr, array('class' => array('column_container')));
			break;
		}
		return parent::sboxContainer($htmlAttr, $options);
	}
	
	function date($htmlAttr = array(), $options = array(), $content = '')
	{
		return $this->sdate($htmlAttr, $options) . $this->edate();
	}


	function ssuiFoldableList($htmlAttr = array(), $options = array())
	{
		$e = '';
		$base = uniqid('');

		$e.= $this->sdiv(array_merge_recursive($htmlAttr, array('class' => 'sui_pendencias')));

		$e.= $this->span(array('class' => 'cont'), array(), $options['count']);
		$e.= $this->anchor(array('id' => "link$base"), array('url' => ''), $options['title']);
		$e.= $this->div(array('id' => 'plus'.$base, 'class' => 'plus_sign'), array(), '&nbsp;');

		$e.= $this->sdiv(array('id' => 'sui_pendencias_'.$base, 'class' => 'foldable_container'));
		$e.= $this->Form->create('SuiApplication', array('id' => uniqid('frm'), 'url' => array('plugin' => 'sui', 'controller' => 'sui_subscriptions', 'action' => 'post_router')));
		
		$e.= $this->BuroOfficeBoy->addHtmlEmbScript("new Sui.FoldableList('$base');");
		
		return $e;
	}
	
	function esuiFoldableList()
	{
		$e = '';
		$e.= $this->Form->end();
		$e.= $this->ediv();
		$e.= $this->ediv();
		return $e;

	}
/**
 * Formats a date string
 * 
 * This method receives a date ($options['date']) and formats it.
 * The list of options is:
 * 
 * - `format` string Can be 'relative', 'event', 'gd', 'simple' (default), 'locale'
 * - `compact` boolean When true, the year is omited
 * - `from` boolean If true, will prepend a string "de "
 * - `date` string|int Date used for 'simple' and 'locale' formats
 * - `begin` string|int Date used for 'event' and 'gd' formats
 * - `end` string|int Date used for 'event' and 'gd' formats
 * 
 * @access public
 * @return type description
 */
	function sdate($htmlAttr = array(), $options = array())
	{
		$options += array(
			'format' => 'simple',
			'compact' => false,
			'from' => false
		);
		extract($options);
		$today = getdate();
		
		$date_str = '';
		switch ($format)
		{
			case 'relative':
				$htmlAttr = $this->_mergeAttributes($htmlAttr, array('class' => 'relative_date'));
				
				$begin = $this->_parseDate($begin);
				$end = $this->_parseDate($end);
				if ($end[0] < $today[0])
				{
					$date_str = __d('mexc', 'Já passou', true);
				}
				elseif ($begin[0] < $today[0])
				{
					$date_str = __d('mexc', 'Acontecendo!', true);
					$htmlAttr = $this->_mergeAttributes($htmlAttr, array('class' => 'highlight'));
				}
				elseif ($begin['mday'] == $today['mday'] && $begin['month'] == $today['month'] && $begin['year'] == $today['year'])
				{
					$date_str = __d('mexc', 'Será hoje!', true);
					$htmlAttr = $this->_mergeAttributes($htmlAttr, array('class' => 'highlight'));
				}
				elseif ($begin['mday']-1 == $today['mday'] && $begin['month'] == $today['month'] && $begin['year'] == $today['year'])
				{
					$date_str = __d('mexc', 'Amanhã', true);
				}
				else
				{
					$date_str = __d('mexc', 'Em breve', true);
				}
			break;
			
			case 'event':
				$begin = $this->_parseDate($begin);
				$end = $this->_parseDate($end);
				
				if ($compact && $begin['mday'] != $end['mday'] && $begin['mon'] == $end['mon'] && $begin['year'] == $end['year'])
				{
					$date_str = $begin['mday'] . ' a ' . $this->date(array(), array('format' => 'simple', 'date' => $end));
				}
				else
				{
					if ($begin['yday'] == $end['yday'] && $begin['year'] == $end['year'])
						$date_str = $this->date(array(), array('format' => 'simple', 'date' => $begin));
					else
						$date_str = ($from?'de ':'') . $this->date(array(), array('format' => 'simple', 'date' => $begin)) .  ' a ' . $this->date(array(), array('format' => 'simple', 'date' => $end));
				}
			break;
			
			case 'gd':
				$b_month = br_strftime('%B', strtotime($begin));
				$e_month = br_strftime('%B', strtotime($end));
				$begin = $this->_parseDate($begin);
				$end = $this->_parseDate($end);
				if ($begin['yday'] == $end['yday'])
				{
					if ($begin['hours'] == $end['hours'])
						$date_str = $begin['mday'].' de '.$b_month;
					else
						$date_str = $begin['mday'].' de '.$b_month.' das '.date('H:i', $begin[0]).' às '.date('H:i', $end[0]);	
				}
				else
				{
					$date_str = ($from?'de ':'') . $begin['mday'] .  ' de ' . $b_month  . ' a ' . $end['mday'] . ' de ' . $e_month;
				}
			break;
			
			case 'simple':
				$date = $this->_parseDate($date);
				if ($today['year'] == $date['year'] || $compact)
					$date_str = sprintf('%d/%d', $date['mday'], $date['mon']);
				else
					$date_str = sprintf('%d/%d/%d', $date['mday'], $date['mon'], $date['year']);
			break;
			
			case 'locale':
				$month = br_strftime('%B', strtotime($date));
				$date = $this->_parseDate($date);
				$date_str = sprintf('%d de %s', $date['mday'], $month);
			break;
		}
		
		return $this->sspan($htmlAttr) . $date_str;
	}
	
	function edate()
	{
		return $this->espan();
	}

/**
 * Makes sure that the date is in getdate() function format.
 * 
 * @access protected
 * @param mixed $date A string (to be parsed with strtotime) or a int
 * @return array Result of PHP getdate function
 */
	protected function _parseDate($date)
	{
		if (is_string($date))
			$date = strtotime($date);
		
		if (is_numeric($date))
			$date = getdate($date);
		
		return $date;
	}

	function month_year($date)
	{
		$date = split('-', $date);
		$year = $date[0];
		if (!empty($date[1]))
			$month = br_month_abbrev($date[1]);
		else
			$month = "";

		return "$month $year";
	}

	function menuBt($htmlAttr = array(), $options = array())
	{
		$menuLevel = 2;
		$htmlAttr += array('class' => array('navbar'));
		
		$View = ClassRegistry::getObject('view');
		$ourLocation = $View->getVar('ourLocation');
		
		$sections = $View->getVar('pageSections');
		
		if (empty($ourLocation))
		{
			trigger_error('TypeBricklayerHelper::menu() - Unknown location. Check if you properly filled the $sectionMap on page_section plugin.config.');
			return false;
		}
		
		for ($i = 0; $i < $menuLevel; $i++)
		{
			if (isset($sections[$ourLocation[$i]]['subSections']))
				$sections = $sections[$ourLocation[$i]]['subSections'];
			else
				return false;
		}
		
		$fixedItems = array();
		$collapsedItems = array();
		foreach($sections as $sectionName => $sectionSettings)
		{
			if ($sectionSettings['active'] && $sectionSettings['display'])
				if (!empty($sectionSettings['collapse']) && $sectionSettings['collapse']) {
					$collapsedItems[] = $this->menuItem(array(),
						compact('sectionName','sectionSettings','writeCaptions','specificClasses','menuLevel','hiddenCaptions'));
				} else {
					$append = '';
					if ($sectionName == 'fact_sites')
						$append = $this->projectsMenu();
					elseif ($sectionName == 'home')
						$sectionSettings['linkCaption'] = $this->spanDry($sectionSettings['linkCaption']);

					$fixedItems[] = $this->menuItem(array(),
						compact('sectionName','sectionSettings','writeCaptions','specificClasses','menuLevel','hiddenCaptions'), $append);
				}
		}

		$content = $this->sdiv(array('class' => 'navbar'), array());
			$content .= '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavBar">
							<span class="sr-only">abrir/fechar menu</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span> </button>';

			$content .= $this->sul(array('class' => 'nav'), array());
				$content .= implode("\n", $fixedItems);
			$content .= $this->eul();
		$content .= $this->ediv(); // closes div.navbar

		$content .= $this->sdiv(array('class'=>"collapse navbar-collapse sidebar-navbar-collapse", 'id'=> "mainNavBar"));
			$content .= $this->sul(array('class' => 'nav navbar-nav'), array());
				$content .= implode("\n", $collapsedItems);
			$content .= $this->eul();
		$content .= $this->ediv(); //<!-- /.nav-collapse -->
		return $this->tag('nav', $htmlAttr, array('close_me' => false), $content);
	}

	function projectsMenu() {
		$space = ClassRegistry::init('SiteFactory.FactSite');
		$projects = $space->listSites(); 
		$p =  '<ul class="nav project-list" >';
		foreach($projects as $project) {
			$p .= '<li>'.$this->anchor(array(), array('url' => array(
				'plugin' => 'site_factory', 'controller' => 'fact_sites',
				'action' => 'index', 'space' => $project['FactSite']['mexc_space_id'])), $project['FactSite']['name']).'</li>';
		}
		$p .= '</ul>';
		return $p;
	}
/**
 * Creates a menu, given the menuLevel desired, and some options. It uses menuItem(), for each menuItem.
 * 
 * @access public
 * @param array $htmlAttr
 * @param array $options
 * @return string
 */
	function menuBtOld($htmlAttr = array(), $options = array())
	{
		$options += array(
			'menuLevel' => 0,
			'writeCaptions' => true,
			'specificClasses' => true,
			'hiddenCaptions' => false,
			'wrapTag' => 'nav'
		);
		
		extract($options);
		$htmlAttr += array('class' => array('navbar'));
		
		$View = ClassRegistry::getObject('view');
		$ourLocation = $View->getVar('ourLocation');
		
		$sections = $View->getVar('pageSections');
		
		if (empty($ourLocation))
		{
			trigger_error('TypeBricklayerHelper::menu() - Unknown location. Check if you properly filled the $sectionMap on page_section plugin.config.');
			return false;
		}
		
		for ($i = 0; $i < $menuLevel; $i++)
		{
			if (isset($sections[$ourLocation[$i]]['subSections']))
				$sections = $sections[$ourLocation[$i]]['subSections'];
			else
				return false;
		}
		
		$fixedItems = array();
		$collapsedItems = array();
		foreach($sections as $sectionName => $sectionSettings)
		{
			if ($sectionSettings['active'] && $sectionSettings['display'])
				if (!empty($sectionSettings['collapse']) && $sectionSettings['collapse']) {
					$collapsedItems[] = $this->menuItem(array(), compact('sectionName','sectionSettings','writeCaptions','specificClasses','menuLevel','hiddenCaptions'));
				} else {
					$fixedItems[] = $this->menuItem(array(), compact('sectionName','sectionSettings','writeCaptions','specificClasses','menuLevel','hiddenCaptions'));
				}
		}

		$content = $this->sdiv(array('class' => 'navbar'), array());
			$content .= '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mainNavBar">
							<span class="sr-only">abrir/fechar menu</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span> </button>';
			$content .= $this->sul(array('class' => 'nav left-block'), array());
				foreach($fixedItems as $item) {
					if (strpos($item,'Projetos')>0) {
						$content .= '<li class="dropdown">
						<a href="#" class="project-dropdown">Projetos</a>'.$p.'</li>';
					} else
						$content .= $item;
				}
			$content .= $this->eul();
		$content .= $this->ediv(); // closes navbar-header

		$content .= $this->sdiv(array('class'=>"collapse navbar-collapse", 'id'=> "mainNavBar"));
			$content .= $this->sul(array('class' => 'nav navbar-nav'), array());
				foreach($collapsedItems as $item) {
					$content .= $item;
				}
			$content .= $this->eul();
		$content .= $this->ediv();
		return $this->tag($wrapTag, $htmlAttr, array('close_me' => false), $content);
	}
/**
 * Creates a menuItem, given the menuLevel desired, and some options. Used by menu().,
 * 
 * @access public
 * @param array $htmlAttr
 * @param array $options
 * @return string
 */
	function menuItem($htmlAttr = array(), $options = array(), $append='')
	{

		$View = ClassRegistry::getObject('view');
		$ourLocation = $View->getVar('ourLocation');
	
		$options += array(
			'menuLevel' => 0,
			'writeCaptions' => true,
			'specificClasses' => true,
			'hiddenCaptions' => false
		);
		extract($options);
		
		$defaultHtmlAttr = array();
		if ($specificClasses)
			$defaultHtmlAttr['class'][] = $sectionName;
		
		if ($ourLocation[$menuLevel] == $sectionName)
			$defaultHtmlAttr['class'][] = 'active';
		
		$htmlAttr += $defaultHtmlAttr;
		if (!isset($anchorOptions))
			$anchorOptions = array();
		
		$anchorOptions['url'] = $sectionSettings['url'];
		$content = $writeCaptions ? $sectionSettings['linkCaption'] : ' ';
		
		if ($hiddenCaptions)
			$content = $this->hiddenSpanDry($content);
		
		return $this->li($htmlAttr, array(), $this->anchor(array(), $anchorOptions, $content).$append);
	}

	function srow($htmlAttr = array(), $options = array()) {
		if (empty($htmlAttr['class']))
			$htmlAttr['class'] = "";
		$htmlAttr['class'] .= ' row';
		return $this->sdiv($htmlAttr, $options);
	}

	function erow($htmlAttr = array(), $options = array()) {
		return $this->ediv($htmlAttr, $options)."<!-- close row -->";
	}
}
