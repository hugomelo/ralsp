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

	// @todo write documentation for the layout framework and give it a definitive name.

class TypographerAppController extends AppController
{
/**
 * Components
 * 
 * @var array
 * @access public
 */
	var $components = array('Typographer.TypeLayoutSchemePicker');

/**
 * beforeFilter
 * 
 * @access public
 */
	function beforeFilter()
	{
		parent::beforeFilter();
		App::import('Behavior', 'Status.Status');
		StatusBehavior::setGlobalActiveStatuses(array(
			'publishing_status' => array('active' => array('published'), 'overwrite' => true, 'mergeWithCurrentActiveStatuses' => true),
		));
	}
}
