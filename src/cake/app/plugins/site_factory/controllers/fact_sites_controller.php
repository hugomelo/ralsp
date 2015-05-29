<?php

/*
 * Copyright 2011-2015, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * source:  https://github.com/museudecienciasunicamp/site_factory.git Mexc Highlights public repository
 *
 */


class FactSitesController extends SiteFactoryAppController
{
	var $name = 'FactSites';

	function beforeFilter()
	{
		Configure::write('jj.modules.factory.viewUrl', array(
			'plugin' => 'site_factory', 'controller' => 'fact_sites',
			'action' => 'index', 'space' => $this->currentSpace));
		parent::beforeFilter();
	}

/**
 * Index page: lists all FactSites
 * 
 * Accessible by /programas/index
 * 
 * @access public
 */
	function all_sites()
	{
		$this->loadModel('SiteFactory.FactSite');
		$this->FactSite->contain(array('MexcSpace', 'FactSection'));
		$sites = $this->FactSite->find('all', array('order' => array('rand()')));
		$this->set(compact('sites'));
	}

/**
 * Front page for each FactSite
 * 
 * Accessible by /programas/{space_id}/index
 * 
 * @access public
 */
	function index()
	{
		$this->loadModel('SiteFactory.FactSite');
		$this->FactSite->contain(array('MexcSpace', 'FactSection'));
		$site = $this->FactSite->findByMexcSpaceId($this->currentSpace);
		
		if (empty($site))
			$this->cakeError('error404');
		
		$twitter_results = array();
		if (!empty($site['FactSite']['twitter_hashtag']))
		{
			App::import('Core', 'HttpSocket');
			$HttpSocket = new HttpSocket();
			$results = $HttpSocket->get('http://search.twitter.com/search.json', 'q=%23' . $site['FactSite']['twitter_hashtag']);
			if ($HttpSocket->response['status']['code'] == 200)
			{
				$results = json_decode($results, true);
				$twitter_results = array_slice($results['results'], 0, 3);
			}
		}
		
		$this->set(compact('site', 'twitter_results'));
		
		
		$this->loadModel('MexcHighlights.MexcHighlightedContent');
		$highlighted = $this->MexcHighlightedContent->getHightlightedsFrom($this->currentSpace, 2);
		$this->set(compact('highlighted'));
		
		foreach ($site['FactSection'] as $section)
		{
			$config = Configure::read('jj.modules.'.$section['type']);
			if (!empty($config))
			{
				$this->loadModel($config['model']);
				$this->set($section['type'] . '_title', $section['name']);
				
				list($modelPlugin, $modelName) = pluginSplit($config['model']);
				$conditions = $this->MexcSpace->getConditionsForSpaceFiltering($this->currentSpace, $modelName);
				
				switch ($section['type'])
				{
					case 'new':
						$limit = 5;
						$this->{$modelName}->contain();
						$this->{$modelName}->setActiveStatuses(array('display_level' => array('general', 'fact_site')));
						$news = $this->{$modelName}->find('all', compact('conditions', 'limit'));
						$one_new = array_shift($news);
						
						$this->set(compact('news', 'one_new'));
					break;
					
					case 'event':
						$limit = 5;
						$this->{$modelName}->contain();
						$this->{$modelName}->setActiveStatuses(array('display_level' => array('general', 'fact_site')));
						$events = $this->{$modelName}->find('all', compact('conditions', 'limit'));
						$one_event = array_shift($events);
						
						$this->set(compact('events', 'one_event'));
					break;
					
					case 'lecture':
						$limit = 5;
						$count = $this->{$modelName}->find('count');
						$page = mt_rand(1,floor($count/$limit));
						
						$this->{$modelName}->contain('MexcSpeaker');
						$lectures = $this->{$modelName}->find('all', compact('conditions', 'limit', 'page'));
						$one_lecture = array_shift($lectures);
						
						$this->set(compact('lectures', 'one_lecture'));
					break;
					
					case 'gallery':
						$this->MexcGallery->contain(array('MexcImage' => array('limit' => 1)));
						$this->MexcGallery->setActiveStatuses(array('display_level' => array('general', 'fact_site')));
						$this->set('gallery', $this->MexcGallery->find('first', compact('conditions')));
					break;
					
					case 'document':
						$limit = 3;
						$this->MexcDocument->contain();
						$this->MexcDocument->setActiveStatuses(array('display_level' => array('general', 'fact_site')));
						$this->set('documents', $this->MexcDocument->find('all', compact('conditions', 'limit')));
					break;

					case 'digital_collection':
						$limit = 4;
						$order = "MexcDigitalCollection.modified DESC";
						$digco = $this->MexcDigitalCollection->find('all', compact('conditions', 'limit', 'order'));
						$this->set('digitalCollections', $digco);
					break;
				}
			}
		}
	}

/**
 * Renders just a part of section form
 * 
 * @access public
 */
	function get_subform()
	{
		$this->view = 'JjUtils.Json';
		$this->helpers['Burocrata.*BuroBurocrata'] = array('name' => 'Buro');
	}
}
