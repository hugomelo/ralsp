<?php

/*
 * Copyright 2011-2015, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * source:  https://github.com/museudecienciasunicamp/site_factory.git Mexc Highlights public repository
 *
 */

class FactSection extends SiteFactoryAppModel
{
	var $name = 'FactSection';
	var $actsAs = array(
		'Containable',
		'JjUtils.Serializable' => array('field' => 'metadata'),
		'JjUtils.Ordered' => array(
			'field' => 'weight',
			'foreign_key' => 'fact_site_id'
		)
	);
	var $belongsTo = array('SiteFactory.FactSite');
	
	var $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'required' => true
			)
		),
	);

/**
 * Kludge to make bahaviors callbacks to work (needed for Serialize Behavior)
 * 
 * @access public
 * @return array The modified results
 */
	public function afterFind($results, $primary)
	{
		if (!$primary)
		{
			$return = $this->Behaviors->trigger($this, 'afterFind', array($results, $primary), array('modParams' => true));
			if ($return !== true) {
				$results = $return;
			}
		}
		return $results;
	}
	
/**
 * Find for burocrata actions.
 * 
 * @access public
 * @return array Data from Model::findById()
 */	
	public function findBurocrata($id)
	{
		$this->contain();
		return $this->findById($id);
	}

/**
 * Used to create an ContentStream through Corktile
 * 
 * IT stores the Corktile key, in the metadata column.
 * 
 * @access public
 * @param array The array of data
 * @return mixed The result from Model::save()
 */
	function saveBurocrata($data)
	{
		$this->set($data);
		
		if (!$this->exists())
		{
			$return = $this->callAction('create', $data[$this->alias]['type']);
			if (is_array($return))
				$this->set($data = $return);
			elseif ($return === false)
				return false;
		}
		
		$return = $this->callAction('save', $data[$this->alias]['type']);
		if (is_array($return))
			$this->set($data = $return);
		elseif ($return === false)
			return false;

		return $this->save();
	}

/**
 * Overwrites the default Model::delete() method
 * 
 * @access public
 * @return boolean Same as parent::delete()
 */
	function delete($id)
	{
		$this->id = $id;
		$this->read();
		return $this->callAction('delete', $this->data[$this->alias]['type']) && parent::delete($id);
	}

/**
 * This method calls the Model's method responsible for this kind of Section
 * 
 * @access protected
 * @return mixed When the model is succefully loaded, the result of factoryActions method, true otherwise. 
 */
	protected function callAction($action, $type)
	{
		$config = Configure::read('jj.modules.' . $type);
		if (!empty($config))
		{
			$Model = ClassRegistry::init($config['model']);
			if (method_exists($Model, 'factoryActions'))
				return $Model->factoryActions($action, $this->data);
		}
		return true;
	}
}
