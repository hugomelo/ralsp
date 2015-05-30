<?php

class TypefaceSettings
{
	var $style = array(
		'fontFamily' => null,
		'fontSize' => null,
		'lineHeight' => null,
		'letterSpacing' => null,
		'textTransform' => null,
		'textDecoration' => null,
		'fontStyle' => null,
		'fontWeight' => null,
		'fontVariant' => null
	);
	
	var $unit;
	
	function __construct($settings = array(), &$unit)
	{
		$this->unit = $unit;
		
		foreach ($settings as $key => $value)
		{
			if (array_key_exists($key,$this->style))
			{
				$this->style[$key] = $value;
			}
		}
	}
	
	function cssRules()
	{
		$wichOnes = func_get_args();
		
		if (empty($wichOnes))
			$wichOnes = array_keys($this->style);
		
		if (isset($wichOnes[0]) && is_array($wichOnes[0]))
			$wichOnes = $wichOnes[0];
	
		$rules = array();
		foreach ($wichOnes as $setting)
		{
			$methodName = 'getRules'.Inflector::camelize($setting);
			$rules += call_user_method($methodName, $this, $setting);
		}
		
		return $rules;
	}
	
	function getRulesFontSize()
	{
		return array('font-size' => $this->unit->t($this->style['fontSize']));
	}
	
	function getRulesFontFamily()
	{
		if (!is_array($this->style['fontFamily']))
		{
			$this->style['fontFamily'] = array($this->style['fontFamily']);
		}
		return array('font-family' => '"' . implode('","', $this->style['fontFamily']) . '"');
	}
	
	function getRulesLineHeight()
	{
		return array('line-height' => $this->unit->t($this->style['lineHeight']));
	}
	
	function getRulesFontStyle()
	{
		return array('font-style' => $this->style['fontStyle']);
	}
	
	function getRulesFontWeight()
	{
		return array('font-weight' => $this->style['fontWeight']);
	}
	
	function getRulesLetterSpacing()
	{
		return array('letter-spacing' => $this->style['letterSpacing']);
	}
	
	function getRulesTextTransform()
	{
		return array('text-transform' => $this->style['textTransform']);
	}
	
	function getRulesTextDecoration()
	{
		return array('text-decoration' => $this->style['textDecoration']);
	}
	
	function getRulesFontVariant()
	{
		return array('font-variant' => $this->style['fontVariant']);
	}
	
};
