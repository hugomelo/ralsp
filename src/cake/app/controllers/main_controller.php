<?php
class MainController extends RedeAppController
{

	var $name = 'Main';
	var $uses = array();
	
	function index()
	{
		// GET HIGHLIGHTED CONTENT (3 FIRST COLUMNS)
		$this->loadModel('MexcHighlights.MexcHighlightedContent');
		$highlighted = $this->MexcHighlightedContent->getHightlightedsFrom('museu');
		
		// GET NEWS
		$this->loadModel('MexcNews.MexcNew');
		$this->MexcNew->setActiveStatuses(array('display_level' => array('general')));
		$news = $this->MexcNew->find('all', array('limit' => 10, 'contain' => false));
		$three_news = array_slice($news, 0, 3);
		$seven_news = array_slice($news, 3);
		
		// GET PROGRAMS
		$this->loadModel('SiteFactory.FactSite');
		$fact_sites = $this->FactSite->find('all', array('contain' => false));
		
		// GET EVENTS
		$this->loadModel('MexcEvents.MexcEvent');
		$this->MexcEvent->setActiveStatuses(array('display_level' => array('general')));
		$events = $this->MexcEvent->find('all', array(
			'limit' => 9, 
			'contain' => false, 
			'conditions' => array('MexcEvent.end >=' => date('Y-m-d')),
			'order' => array('MexcEvent.start' => 'asc')
		));
		if (empty($events))
		{
			$events = $this->MexcEvent->find('all', array('limit' => 9, 'contain' => false));
		}
		$two_events = array_slice($events, 0, 2);
		$seven_events = array_slice($events, 2);
		
		// GET GALLERY
		$this->loadModel('MexcGalleries.MexcGallery');
		$this->MexcGallery->setActiveStatuses(array('display_level' => array('general')));
		$gallery = $this->MexcGallery->find('first', array('contain' => array('MexcImage' => array('limit' => 1))));
		
		// SET THEM ALL
		$this->set(compact('highlighted', 'three_news', 'seven_news', 'two_events', 'seven_events', 'gallery', 'fact_sites'));
	}
}
