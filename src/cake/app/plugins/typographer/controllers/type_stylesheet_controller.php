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


class TypeStylesheetController extends TypographerAppController
{
	var $name = 'TypeStylesheet';
	var $layout = 'css';
	var $components = array('Typographer.TypeLayoutSchemePicker');
	var $uses = array();
	var $helpers = array(
		'Typographer.TypeDecorator' => array(
			'name' => 'Decorator',
			'compact' => false,
			'mode' => 'inline_echo',
			'receive_tools' => true
		),
		'Typographer.*TypeStyleFactory' => array(
			'name' => 'StyleFactory', 
			'receive_automatic_classes' => false, 
			'receive_tools' => true,
			'generate_automatic_classes' => true //significa que eu que vou produzir as classes automaticas
		),
		'Typographer.*TypeBricklayer' => array(
			'name' => 'Bl',
			'receive_tools' => true,
		)
	);

/**
 * AuthComponent access hardcoded
 * 
 * @access public
 * @return void
 */
	function  beforeFilter()
	{
		parent::beforeFilter();

		if (isset($this->JjAuth))
		{
			$this->JjAuth->allow('*');
		}
	}

/**
 * Avoid the parent beforeRender triggering.
 * 
 * @access public
 * @return void
 */
	function beforeRender()
	{
	}

/**
 * Action for rendering CSS
 * 
 * @access public
 * @return view
 */	
	//Altered because of the Site Factory
	function style($layout_scheme = 'standard', $subspace = null, $type = 'main')
	{
		// Start MEXC specific code
		$this->set('currentSpace', $subspace);
		$this->currentSpace = $subspace;
		
		if ($subspace != null && $this->loadModel('SiteFactory.FactSite'))
		{
			StatusBehavior::setGlobalActiveStatuses(array(
				'publishing_status' => array('active' => array('published', 'draft'), 'overwrite' => true, 'mergeWithCurrentActiveStatuses' => true),
			));
			$this->FactSite->contain();
			$this->currentSite = $this->FactSite->findByMexcSpaceId($this->currentSpace);
			
			if (empty($this->currentSite))
				$this->cakeError('error404');
			
			$this->set('currentSite', $this->currentSite);
			Configure::write('SiteFactory.currentSite', $this->currentSite);
			$element = $layout_scheme . '_fact_site_css';
			
			$assetFile = implode(DS, array(ROOT, 'app', 'plugins', 'typographer', 'views', 'elements', $element . $this->ext));
			$assetFilemTime = strtotime($this->currentSite['FactSite']['modified']);
		}
		// End MEXC specific code
		else
		{
			$element = $layout_scheme . '_css';
			$assetFile = implode(DS, array(ROOT, 'app', 'plugins', 'typographer', 'views', 'elements', $element . $this->ext));
			$assetFilemTime = filemtime($assetFile);
		}
		
		$eTag = md5_file($assetFile) . $assetFilemTime;
		
		$this->TypeLayoutSchemePicker->pick($layout_scheme);
		
		if (env('HTTP_IF_NONE_MATCH') && env('HTTP_IF_NONE_MATCH') == $eTag)
		{
			$this->header("HTTP/1.1 304 Not Modified");
			$this->_stop();
		}
		
		header("Last-Modified: " . gmdate("D, j M Y G:i:s ", $assetFilemTime) . 'GMT');
		header("Etag: " . $eTag);
		header('Content-type: text/css');
		
		$this->set(compact('element'));		
	}
}
