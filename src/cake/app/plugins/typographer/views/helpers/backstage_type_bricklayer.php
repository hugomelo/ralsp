<?php

/**
 *
 * Copyright 2010-2012, Preface Design LTDA (http://www.preface.com.br")
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2010-2011, Preface Design LTDA (http://www.preface.com.br)
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link          https://github.com/prefacedesign/jodeljodel Jodel Jodel public repository 
 */


App::import('Helper','Typographer.TypeBricklayer');

class BackstageTypeBricklayerHelper extends TypeBricklayerHelper
{

	function mexcSpace($attr = array(), $options = array(), $content = array())
	{
		if (isset($content['MexcSpace']))
			$content = $content['MexcSpace'];
		
		if (!isset($attr['style']))	
			$attr['style'] = '';
		if (!empty($content['back_color']))
			$attr['style'] .= 'background-color: ' . $content['back_color'] . ';';
		if (!empty($content['fore_color']))
			$attr['style'] .= 'color: ' . $content['fore_color'] . ';';
		
		$out = '';
		if (!empty($content['name']))
		{
			$attr = $this->addClass($attr, 'space_tag');
			$out .= $this->sspan($attr, $options);
			$out .= $content['name'];
			$out .= $this->espan();
		}
		
		return $out;
	}

/**
 * Constructs the URL for the view of an specifc module
 * 
 * @access public
 * @param string $moduleName The module name 
 * @param string $id The module ID
 * @return array|false Return the URL in array form, if could contruct it. And false otherwise.
 */
	function moduleViewURL($moduleName, $id)
	{
		$curModule = Configure::read('jj.modules.'.$moduleName);
		
		if (empty($curModule))
		{
			trigger_error('BackstageTypeBricklayerHelper::moduleView() - Module type `'.$item['DashDashboardItem']['type'].'` not known.');
			return false;
		}

		list($plugin, $model) = pluginSplit($curModule['model']);
	
		if (!isset($curModule['viewUrl']))
			$curModule['viewUrl'] = array();
		elseif ($curModule['viewUrl'] == false)
			return false;
			
		if (!is_array($curModule['viewUrl']))
		{
			trigger_error('BackstageTypeBricklayerHelper::moduleView() - `viewUrl` configuration must be an array.');
			return false;
		}
		
		$languages = Configure::read('Tradutore.languages');
		if (count($languages) > 1)
		{
			$language = Configure::read('Tradutore.mainLanguage');
			$curModule['viewUrl']['language'] = $language;
		}
		
		$plugin = Inflector::underscore($plugin);
		$curModule['viewUrl'][] = $id;
		$defaults =  array(
			'plugin' => $plugin, 
			'controller' => Inflector::pluralize($plugin),
			'action' => 'view'
		);
		return $curModule['viewUrl']+$defaults;
	}

/* Handles the Backstage links.
 *
 * @access public
 * @param $attr The HTML attributes.
 * @param $options Extra element related options. Here, we are treating the 'text' superclass: array('superclass' => 'text');
 * @return 
 */
	function sa($attr = array(), $options = array())
	{
		/*$new_attr = array('class' => 'text');
		
		if (isset($options['superclass']))
		{
			if (in_array('image', $options['superclass']))
				unset($new_attr['class']);
		}
		$attr = $this->_mergeAttributes($attr, $new_attr);
		*/
		return parent::sa($attr, $options);
	}
	
	function sh1($attr = array(), $options = array(), $content = array())
	{
		$standard_options = array(
			'escape' => true
		);
		
		$options = am($standard_options, $options);
		extract($options);
	
		$divAttr = array('class' => 'h1div');
	
		if (isset($contentDivAttr))
		{
			$divAttr = $this->_mergeAttributes($divAttr, $contentDivAttr);
		}
	
		$r  = $this->sdiv($divAttr);
		if (isset($additionalText))
		{
			$r .= $this->span(array(), array('escape' => $escape), $additionalText);
		}	
		$r .= parent::sh1($attr, $options);
		
		return $r;
	}
	
	function eh1()
	{
		return parent::eh1() . $this->ediv();
	}
	
	function sbigInfoBox($attr = array(), $options = array())
	{
		$attr = $this->_mergeAttributes(array('class' => array('big_info_box')), $attr);
		
		return $this->sdiv($attr, $options) . $this->sdiv();
	}
	
	function ebigInfoBox()
	{
		return $this->ediv().$this->ediv();
	}
	
	function scontrolBox($attr = array(), $options = array())
	{
		$attr = $this->_mergeAttributes(array('class' => array('control_box')), $attr);
		
		return $this->sdiv($attr, $options) . $this->sdiv();
	}
	
	function econtrolBox()
	{
		return $this->ediv().$this->ediv();
	}

	function sinfoBox($attr = array(), $options = array())
	{
		$attr = $this->_mergeAttributes(array('class' => array('info_box')), $attr);

		return $this->sdiv($attr, $options);
	}

	function einfoBox()
	{
		return $this->ediv();
	}

	
	function date($htmlAttr = array(), $options = array(), $content = '')
	{
		return $this->sdate($htmlAttr, $options) . $this->edate();
	}
	
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
				$date_str = ($from?'de ':'') . $begin['mday'] .  ' de ' . $b_month  . ' a ' . $end['mday'] . ' de ' . $e_month;
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

}



?>
