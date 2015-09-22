<?php

class RedeAppController extends AppController
{
	var $currentSite;
	var $currentSpace;
	
	var $layout = 'rede';
	var $components = array('Typographer.TypeLayoutSchemePicker', 'Session', 'Cookie');
	
	var $helpers = array(
		'Typographer.TypeDecorator' => array(
			'name' => 'Decorator',
			'compact' => false,
			'receive_tools' => true
		),
		'Typographer.*TypeStyleFactory' => array(
			'name' => 'TypeStyleFactory',
			'receive_automatic_classes' => true, 
			'receive_tools' => true,
			'generate_automatic_classes' => false 
		),
		'Typographer.*TypeBricklayer' => array(
			'name' => 'Bl',
			'receive_tools' => true,
		),
		'Corktile.Cork', 'JjUtils.Jodel'
	);

	function beforeFilter()
	{
		parent::beforeFilter();
		StatusBehavior::setGlobalActiveStatuses(array(
			'publishing_status' => array('active' => array('published'), 'overwrite' => true, 'mergeWithCurrentActiveStatuses' => true),
		));
	}
	
	function beforeRender()
	{
		parent::beforeRender();
		$this->TypeLayoutSchemePicker->pick('rede');
	}
}
