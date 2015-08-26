<?php
class MainController extends RedeAppController
{

	var $name = 'Main';
	var $uses = array();
	
	function index()
	{
		// GET GALLERY
		$this->loadModel('UnifiedSearch.SblSearchItem');
		$paging = array();
		$items = $this->SblSearchItem->getSearchResults("", array(), $paging);
		
		// GET PROGRAMS
		$this->loadModel('SiteFactory.FactSite');
		$fact_sites = $this->FactSite->find('all', array('contain' => false));
		
		// SET THEM ALL
		$this->set(compact('items', 'fact_sites'));
	}
}
