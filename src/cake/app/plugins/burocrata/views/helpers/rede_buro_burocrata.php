<?php
/**
 * Version of Burocrata Helper for backstage
 *
 * PHP versions 5
 *
 * @package       jodel
 * @subpackage    jodel.burocrata.views.helpers
 */
 
/**
 * Importing of main burocrata class.
 */
App::import('Helper', 'Burocrata.BuroBurocrata');

/**
 * Version of Burocrata Helper for backstage
 *
 * PHP versions 5
 *
 * @package       jodel
 * @subpackage    jodel.burocrata.views.helpers
 */
class RedeBuroBurocrataHelper extends BuroBurocrataHelper
{

	function inputMultipleCheckbox($options)
	{
		$checkboxmultiple = $this->Html->tags['checkboxmultiple'];
		$baseID = $this->_readFormAttribute('baseID');
		$this->Html->tags['checkboxmultiple'] = '<input type="checkbox" name="%s[]"%s buro:form="'.$baseID.'" />';
		
		$options += array('options' => array());
		$options['type'] = 'select';
		$options['options']['multiple'] = 'checkbox';
		
		$input = $this->input(null, $options);
		
		$this->Html->tags['checkboxmultiple'] = $checkboxmultiple;
		
		return $input;
	}

}
