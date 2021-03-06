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


$config['Dashboard.itemSettings'] = array(
		'default' => array(
			'actions' => array('publish_draft','delete','edit', 'create', 'see_on_page'),
			'edit_version' => 'backstage'
		),
		'corktile' => array(
			'actions' => array('edit'),
			'edit_version' => 'corktile'
		),
	);

$config['Dashboard.limitSize'] = 20;
$config['Dashboard.statusOptions'] = array('published', 'draft');
$config['Dashboard.additionalFilteringConditions'] = array('MexcSpace.DashboardFiltering');

