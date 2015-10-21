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
/*
SELECT *, MATCH (`title`, `tags_text`, `subtitle`, `summary`, `content`, `themes`) AGAINST ('papa') AS relevance 
FROM sbl_search_items WHERE MATCH (`title`, `tags_text`, `subtitle`, `summary`, `content`, `themes`) AGAINST ('papa' IN BOOLEAN MODE) 
ORDER BY relevance DESC;
*/

/**
 * Class SblSearchItem
 *
 * @property MexcSpaces              $MexcSpace
 */
class SblSearchItem extends UnifiedSearchAppModel {

	var $name       = 'SblSearchItem';
	var $actsAs     = array('Tags.Taggable', 'Containable');
	var $itemModels = array();

	var $belongsTo = array('MexcSpaces.MexcSpace');

	function saveSearchItem ($data) {
		return $this->save($data);
	}

	function getSearchResults ($searchString, $filterOptions = array(), &$paging=false) {
		$contain = array('MexcSpace' => 'FactSite');
		$order = array('SblSearchItem.date DESC');
		$conditions = array(
			array("{$this->alias}.publishing_status" => 'published'),
			'OR' => array(
				"{$this->alias}.date <=" => date('Y-m-d'),
				"{$this->alias}.date" => NULL,
			)
		);

		if (!empty($searchString)) {
			$matchRule =
				"MATCH (`title`, `tags_text`, `subtitle`, `summary`, `content`, `themes`) " .
				"AGAINST (" . $this->getDatasource()->value($searchString) . ")";

			$conditions[] = $matchRule;
			$this->virtualFields = array('relevance' => $matchRule);
			array_unshift($order, array('SblSearchItem.relevance DESC'));
		}

		if (!empty($filterOptions['type'])) {
			$conditions['SblSearchItem.type'] = $filterOptions['type'];
		}
		
		if (!empty($filterOptions['order'])) {
			switch ($filterOptions['order']) {
				case 'date DESC': {
					$order = array('SblSearchItem.date DESC', 'SblSearchItem.relevance DESC');
					break;
				}
				case 'date ASC': {
					$order = array('SblSearchItem.date ASC', 'SblSearchItem.relevance DESC');
					break;
				}
				case 'relevance DESC': {
					$order = array('SblSearchItem.relevance DESC', 'SblSearchItem.date DESC');
					break;
				}
				case 'relevance ASC': {
					$order = array('SblSearchItem.relevance ASC', 'SblSearchItem.date DESC');
					break;
				}
			}
		}
		
		if (!empty($filterOptions['mexc_space_id'])) {
			$conditions['SblSearchItem.mexc_space_id'] = $filterOptions['mexc_space_id'];
		}
		
		if (!empty($filterOptions['after'])) {
			$conditions['SblSearchItem.date >='] = $filterOptions['after'];
		}
		
		if (!empty($filterOptions['before'])) {
			$conditions['SblSearchItem.date <='] = $filterOptions['before'];
		}

		$limit = isset($paging['options']['limit']) ? $paging['options']['limit'] : 16;
		$page = isset($paging['page']) ? $paging['page'] : 1;

		$results = $this->find('all', array(
			'conditions' => $conditions,
			'group'      => 'SblSearchItem.id',
			'order'      => $order,
			'contain'    => $contain,
			'limit'      => $limit,
			'page' => $page
		));

		// Search count by type
		$this->virtualFields = array(
			'hits' => 'COUNT(DISTINCT SblSearchItem.id)'
		);
		
		$count = $this->find('all', array(
			'conditions' => $conditions,
			'contain'    => $contain,
		));

		if (isset($conditions['SblSearchItem.type'])) {
			unset($conditions['SblSearchItem.type']);
		}

		$hitCount = $this->find('all', array(
			'conditions' => $conditions,
			'contain'    => $contain,
			'group'      => 'SblSearchItem.type'
		));
		
		$count = array_sum(Set::extract('/SblSearchItem/hits', $count));
		$pageCount = intval(ceil($count / $limit));
		
		$paging = array(
			'page'      => $page,
			'current'   => $count,
			'count'     => $count,
			'prevPage'  => ($page > 1),
			'nextPage'  => ($count > ($page * $limit)),
			'pageCount' => $pageCount,
			'defaults'  => array(),
			'options'   => array(
				'limit' => $limit
			)
		);

		return compact('results', 'hitCount');
	}
}
