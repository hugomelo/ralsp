<?php

/*
 * Copyright 2011-2015, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * source:  https://github.com/museudecienciasunicamp/site_factory.git Mexc Highlights public repository
 *
 */

class FactSite extends SiteFactoryAppModel
{
	var $name = 'FactSite';
	
	var $actsAs = array(
		'Containable',
		'Dashboard.DashDashboardable', 
		'JjMedia.StoredFileHolder' => array('img_id', 'img2_id', 'img_foot_id', 'img_head_id', 'img_bg_id', 'picture_id'),
		'Status.Status' => array('publishing_status'),
		'ContentStream.CsContentStreamHolder' => array(
			'streams' => array(
				'about_content_stream_id' => 'about_fact_site'
			)
		)
	);
	
	var $belongsTo = array(
		'MexcSpace.MexcSpace'
	);

	var $hasMany = array(
		'FactSection' => array(
			'className' => 'SiteFactory.FactSection',
			'dependent' => true,
			'order' => 'FactSection.weight'
		)
	);
	
	var $validate = array(
		'mexc_space_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'required' => true
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty')
			),
		),
		'description' => array(
			'rule' => array('between', 0, 400)
		),
		'mini_description' => array(
			'rule' => array('between', 0, 170)
		),
	);
	
	function findBurocrata($id)
	{
		$this->contain(array('MexcSpace', 'FactSection'));
		$data = $this->findById($id);
		return $data;
	}
	
	function saveBurocrata($data)
	{
		$saved = false;
		
		// Save when is asked one of preset sites
		if (isset($data['FactSite']['preset']) && empty($this->MexcSpace->validationErrors))
		{
			App::import('Config', 'SiteFactory.SiteFactory');
			$preset = Configure::read('FactSite.preset.' . $data['FactSite']['preset']);

			if ($preset)
			{
				$tmpData['FactSite'] = $preset + array('id' => $data['FactSite']['id']);
				
				$SfilStoredFile = ClassRegistry::init('JjMedia.SfilStoredFile');
				foreach (array('img_head_id','img_foot_id','picture_id') as $field)
				{
					$dirname = dirname($tmpData['FactSite'][$field]);
					if (!in_array($dirname, $SfilStoredFile->validate['file']['location']['rule'][1]))
						$SfilStoredFile->validate['file']['location']['rule'][1][] = $dirname;

					$SfilStoredFile->create(array(
						'SfilStoredFile' => array(
							'file' => $tmpData['FactSite'][$field],
						)
					));
					$SfilStoredFile->setScope($SfilStoredFile->findTheScope("FactSite.$field"));

					if ($SfilStoredFile->save())
						$tmpData['FactSite'][$field] = $SfilStoredFile->id;
					else
						$tmpData['FactSite'][$field] = null;
				}
			}
			
			$this->save($data, array('validate' => false));
			return $this->save($tmpData, false);
		}
		
		// Normal save
		$this->contain('MexcSpace');
		$old_data = $this->findById($data[$this->alias][$this->primaryKey]);
		
		if (isset($old_data['MexcSpace']['id']) && $data['MexcSpace']['id'] != $old_data['MexcSpace']['id'])
			$this->MexcSpace->invalidate('id', 'change');
		
		$data[$this->alias]['mexc_space_id'] = $data['MexcSpace']['id'];
		
		if ($this->saveAll($data, array('validate' => 'only')) && empty($this->MexcSpace->validationErrors))
			$saved = $this->saveAll($data, array('validate' => false));
		
		return $saved;
	}
	
	function createEmpty()
	{
		$data = array(
			'FactSite' => array(
				'publishing_status' => 'draft'
			)
		);
		$this->create();
		return $this->save($data, false);
	}
	
	function getDashboardInfo($id)
	{
		$this->contain();
		$data = $this->findById($id);
		if ($data == null)
			return null;
		
		$dashdata = array(
			'dashable_id'	=> $id,
			'dashable_model'=> $this->name,
			'type'			=> 'factory',
			'mexc_space_id' => $data[$this->alias]['mexc_space_id'],
			'status'		=> $data[$this->alias]['publishing_status'],
			'created'		=> $data[$this->alias]['created'],
			'modified'		=> $data[$this->alias]['modified'],
			'name'			=> $data[$this->alias]['name'],
			'info'			=> 'Desc.: ' . mb_substr($data[$this->alias]['description'],0,200),
			'idiom'			=> array()
		);
		
		return $dashdata;
	}
	
	function dashDelete($id)
	{
		return $this->delete($id);
	}

}
?>
