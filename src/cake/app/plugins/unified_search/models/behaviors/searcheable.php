<?php

/**
 *
 * Copyright 2010-2013, Preface Design LTDA (http://www.preface.com.br)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2010-2013, Preface Design LTDA (http://www.preface.com.br)
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link          https://github.com/prefacedesign/jodeljodel Jodel Jodel public repository 
 */

	
class SearcheableBehavior extends ModelBehavior
{
	public function setup(&$model, $config = array()) {
		$this->settings[$model->alias] = $config;
	}
	
	
	function afterSave(&$Model, $created)
	{	
		$this->updateItem($Model, $Model->id);
	}

	function afterDelete(&$Model)
	{
		$this->getSearchItemModel()->removeItem($Model->alias.'@'.$Model->id);
	}
	
/**
 * Method used to synch every SearchItem entries 
 * 
 * @access public
 * @param Model $Model
 * @param boolean $force_update If true, will update all dashboard entries, else, will update only those witch modified field differ
 * @return void
 */
	function synchronizeWithSearchItems(&$Model, $force_update = false)
	{
		$SearchItem =& $this->getSearchItemModel();
		$dbo = $SearchItem->getDatasource();
		$dbo->begin($Model);
		
		// Remove childless entries
		
		$SearchItem->bindModel(array('belongsTo' => array(
			$Model->alias => array(
				'className' => $Model->name,
				'foreignKey' => 'foreign_id',
			)
		)));
		
		if (isset($Model->virtualFields)) {
			$Model->virtualFields = array();
		}
		if (isset($Model->order)) {
			$Model->order = array();
		}
		
		$childless = $SearchItem->find('all', array(
			'contain' => array($Model->alias => array('fields'=> array($Model->primaryKey))),
			'conditions' => array(
				'SblSearchItem.model' => $Model->alias,
				$Model->alias . '.' . $Model->primaryKey => null
			)
		));
		
		$SearchItem->deleteAll(
			array('SblSearchItem.id' => Set::extract($childless,'/SblSearchItem/id'))
		);

		$to_update = array();
		
		// Select out-dated entries
		if ($force_update)
		{
			$outdated = $SearchItem->find('all', array(
				'contain' => array(),
				'conditions' => array('SblSearchItem.model' => $Model->alias)
			));
		}
		else
		{
			$SearchItem->bindModel(array('belongsTo' => array(
				$Model->alias => array(
					'className' => $Model->name,
					'foreignKey' => 'foreign_id',
				)
			)));
			
			$outdated = $SearchItem->find('all', array(
				'contain' => array($Model->alias),
				'conditions' => array(
					'SblSearchItem.model' => $Model->alias,
					'OR' => array(
						"SblSearchItem.modified <> {$Model->alias}.modified",
						"SblSearchItem.modified" => null
					)
				)
			));
		}
		if (!empty($outdated)) {
			$to_update = Set::extract('/SblSearchItem/foreign_id', $outdated);
		}
		
		
		// And last but not least, items without search entries
		$Model->bindModel(array('hasOne' => array(
			'SblSearchItem' => array(
				'className' => 'UnifiedSearch.SblSearchItem',
				'foreignKey' => 'foreign_id',
				'conditions' => array('SblSearchItem.model' => $Model->alias)
			)
		)));
		
		$doesnt_have = $Model->find('all', array(
			'contain' => array('SblSearchItem'),
			'conditions' => array('SblSearchItem.id' => null)
		));
		
		$to_update += Set::extract("/{$Model->alias}/{$Model->primaryKey}", $doesnt_have);

		$to_update = array_unique($to_update);
		foreach ($to_update as $id) {
			$this->updateItem($Model, $id);
		}

		$dbo->commit($Model);
		
		return compact('childless', 'outdated', 'doesnt_have');
	}
/* CREATE TABLE `sbl_search_items` (
	`id` varchar(255) NOT NULL,
	`type` varchar(120) DEFAULT NULL,
	`publishing_status` enum('published','draft') DEFAULT NULL,
	`date` datetime DEFAULT NULL,
	`start` datetime DEFAULT NULL,
	`end` datetime DEFAULT NULL,
	`title` varchar(300) DEFAULT NULL,
	`subtitle` text,
	`summary` text,
	`content` mediumtext,
	`tags_text` text,
  	`mexc_space_id` VARCHAR(30) NULL ,
	`model` varchar(100) DEFAULT NULL,
	`foreign_id` int(11) DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,
	PRIMARY KEY (`id`),
	KEY `index2` (`date`),
	KEY `index4` (`model`),
	KEY `index5` (`foreign_id`),
	KEY `index6` (`type`),
	KEY `index7` (`start`),
	KEY `index8` (`end`),
	FULLTEXT KEY `index3` (`title`,`tags_text`,`subtitle`,`summary`,`content`,`mexc_space_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8
	 */
	 
	public function getSearchInfo(&$Model, $item_id) {
		$data = $Model->find('first', array(
			'contain' => array('MexcSpace','Tag'),
			'conditions' => array(
				$Model->alias.'.id' => $item_id,
			)
		));
		
		$searchInfo = array('SblSearchItem' => array());
		
		if (isset($data[$Model->alias]['publishing_status'])) {
			$searchInfo['SblSearchItem']['publishing_status'] = $data[$Model->alias]['publishing_status'];
		}
		if (isset($data[$Model->alias]['date'])) {
			$searchInfo['SblSearchItem']['date'] = $data[$Model->alias]['date'];
		} elseif (isset($data[$Model->alias]['created'])) {
			$searchInfo['SblSearchItem']['date'] = $data[$Model->alias]['created'];
		}
		if (isset($data[$Model->alias]['start'])) {
			$searchInfo['SblSearchItem']['start'] = $data[$Model->alias]['start'];
		}
		if (isset($data[$Model->alias]['end'])) {
			$searchInfo['SblSearchItem']['end'] = $data[$Model->alias]['end'];
		}
		if (isset($data[$Model->alias]['title'])) {
			$searchInfo['SblSearchItem']['title'] = $data[$Model->alias]['title'];
		}
		if (isset($data[$Model->alias]['name'])) {
			$searchInfo['SblSearchItem']['title'] = $data[$Model->alias]['name'];
		}
		if (isset($data[$Model->alias]['headline'])) {
			$searchInfo['SblSearchItem']['title'] = $data[$Model->alias]['headline'];
		}
		
		$searchInfo['SblSearchItem']['subtitle'] = '';
		
		if (isset($data[$Model->alias]['subtitle'])) {
			$searchInfo['SblSearchItem']['subtitle'] = $data[$Model->alias]['subtitle'];
		}
		if (isset($data[$Model->alias]['sub_headline'])) {
			$searchInfo['SblSearchItem']['subtitle'] = $data[$Model->alias]['sub_headline'];
		}
		if (isset($data[$Model->alias]['author'])) {
			$searchInfo['SblSearchItem']['subtitle'] .= ' - ' . $data[$Model->alias]['author'];
		}
		
		if (isset($data[$Model->alias]['summary'])) {
			$searchInfo['SblSearchItem']['summary'] = $data[$Model->alias]['summary'];
		}
		if (isset($data[$Model->alias]['description'])) {
			$searchInfo['SblSearchItem']['summary'] = $data[$Model->alias]['description'];
		}
		if (isset($data[$Model->alias]['post'])) {
			$searchInfo['SblSearchItem']['content'] = html_entity_decode(strip_tags($data[$Model->alias]['post']),  ENT_COMPAT, 'UTF-8');
		}
		if (isset($data[$Model->alias]['mexc_space_id'])) {
			$searchInfo['SblSearchItem']['mexc_space_id'] = $data[$Model->alias]['mexc_space_id'];
		}
		if (isset($data[$Model->alias]['modified'])) {
			$searchInfo['SblSearchItem']['modified'] = $data[$Model->alias]['modified'];
		}
		
		switch ($Model->alias) {
			case 'MexcNew': {
				$searchInfo['SblSearchItem']['type'] = 'novidade';
				break;
			}
			case 'MexcGallery': {
				$searchInfo['SblSearchItem']['type'] = 'galeria';
				break;
			}
			case 'MexcEvent': {
				$searchInfo['SblSearchItem']['type'] = 'agenda';
				break;
			}
		}
		
		if (isset($data['Tag'])) {
			
			$tags = Set::extract($data,'/Tag/name');
			
			$searchInfo['SblSearchItem']['tags']      = implode(", ", $tags);
			$searchInfo['SblSearchItem']['tags_text'] = implode(", ", $tags);
		}
		$searchInfo['originalData'] = $data;
		
		return $searchInfo;
	}
	
	function getDataForListing(&$Model, $id) {
		if (isset($this->settings[$Model->alias]['contain'])) {
			$Model->contain($this->settings[$Model->alias]['contain']);
		}
		
		return $Model->find('first', array(
			'conditions' => array($Model->alias . '.id' => $id)
		));
	}
	
	protected function updateItem(&$Model, $item_id)
	{
		//gets the summarized description of this registry
		
		$searchInfo = $Model->getSearchInfo($item_id);
		
		$searchInfo = array(
			'SblSearchItem' => array(
				'id'                => $Model->alias.'@'.$item_id,
				'model'             => $Model->alias,
				'foreign_id'        => $item_id,
				'type'				=> $searchInfo['SblSearchItem']['type'],
				'date'				=> isset($searchInfo['SblSearchItem']['date']				 ) ? $searchInfo['SblSearchItem']['date'] : null,
				'start'				=> isset($searchInfo['SblSearchItem']['start']				 ) ? $searchInfo['SblSearchItem']['start'] : null,
				'end'				=> isset($searchInfo['SblSearchItem']['end']				 ) ? $searchInfo['SblSearchItem']['end'] : null,
				'publishing_status' => isset($searchInfo['SblSearchItem']['publishing_status']	 ) ? $searchInfo['SblSearchItem']['publishing_status'] : 'published',
				'title'				=> isset($searchInfo['SblSearchItem']['title']				 ) ? $searchInfo['SblSearchItem']['title'] : '',
				'content'			=> isset($searchInfo['SblSearchItem']['content']			 ) ? $searchInfo['SblSearchItem']['content'] : '',
				'subtitle'			=> isset($searchInfo['SblSearchItem']['subtitle']			 ) ? $searchInfo['SblSearchItem']['subtitle'] : '',
				'summary'			=> isset($searchInfo['SblSearchItem']['summary']			 ) ? $searchInfo['SblSearchItem']['summary'] : '',
				'tags'				=> isset($searchInfo['SblSearchItem']['tags']				 ) ? $searchInfo['SblSearchItem']['tags'] : '',
				'tags_text'			=> isset($searchInfo['SblSearchItem']['tags']				 ) ? $searchInfo['SblSearchItem']['tags_text'] : '',
				'mexc_space_id'	    	=> isset($searchInfo['SblSearchItem']['mexc_space_id']				 ) ? $searchInfo['SblSearchItem']['mexc_space_id'] : '',
				'modified'			=> isset($searchInfo['SblSearchItem']['modified']			 ) ? $searchInfo['SblSearchItem']['modified'] : '',
			),
		);
		
		//saves the summary into the dashboard
		$this->getSearchItemModel()->saveSearchItem($searchInfo);
	}
	
	protected function getSearchItemModel()
	{
		static $SearchItem = false;
		if ($SearchItem === false)
			$SearchItem =& ClassRegistry::init(array('class' => 'UnifiedSearch.SblSearchItem'));
		return $SearchItem;
	}
}

