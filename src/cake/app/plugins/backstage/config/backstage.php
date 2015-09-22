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

Configure::write('Backstage.itemSettings',array(
	'projects' => array(
		'actions' => array('create', 'edit', 'see_on_page', 'delete', 'publish_draft'),
		'limitSize' => 30,
		'statusOptions' => array('published', 'draft'),
		'columns' => array(
			'name' => array('label' => __d('cn', 'Nome', true), 'field' => 'FactSite.name', 'size' => 3),
			'alias_name' => array('label' => __d('cn', 'Apelido', true), 'field' => 'FactSite.alias_name', 'size' => 2),
			'mini_description' => array('label' => __d('cn', 'Mini descrição', true), 'field' => 'FactSite.mini_description', 'size' => 4),
			'status' => array('label' => __d('cn', 'Status', true), 'field' => 'publishing_status', 'size' => 1),
			'created' => array('label' => __d('cn', 'Criado', true), 'field' => 'FactSite.created', 'size' => 1),
			'modified' => array('label' => __d('cn', 'Modificado', true), 'field' => 'FactSite.modified', 'size' => 1),
		),
		'customRow' => false,
		'customHeader' => false,
		'customSearch' => false,
		//'paramsFoward' => array(0 => 'id'),
		'contain' => false,
	),
	'news' => array(
		'actions' => array('create', 'edit', 'see_on_page', 'delete', 'publish_draft'),
		'limitSize' => 30,
		'statusOptions' => array('published', 'draft'),
		'columns' => array(
			'title' => array('label' => __d('cn', 'Nome', true), 'field' => 'title', 'size' => 3),
			'author' => array('label' => __d('cn', 'Apelido', true), 'field' => 'author', 'size' => 2),
			'summary' => array('label' => __d('cn', 'Mini descrição', true), 'field' => 'summary', 'size' => 4),
			'projeto' => array('label' => __d('cn', 'Projeto', true), 'field' => 'mexc_space_id', 'size' => 1),
			'status' => array('label' => __d('cn', 'Status', true), 'field' => 'publishing_status', 'size' => 1),
			'created' => array('label' => __d('cn', 'Criado', true), 'field' => 'created', 'size' => 1),
		),
		'customRow' => false,
		'customHeader' => false,
		'customSearch' => false,
		//'paramsFoward' => array(0 => 'id'),
		'contain' => false,
	),
	'events' => array(
		'actions' => array('create', 'edit', 'see_on_page', 'delete', 'publish_draft'),
		'limitSize' => 30,
		'statusOptions' => array('published', 'draft'),
		'columns' => array(
			'name' => array('label' => __d('cn', 'Nome', true), 'field' => 'name', 'size' => 3),
			'summary' => array('label' => __d('cn', 'Descrição', true), 'field' => 'summary', 'size' => 4),
			'start' => array('label' => __d('cn', 'Começa', true), 'field' => 'start', 'size' => 1),
			'end' => array('label' => __d('cn', 'Termina', true), 'field' => 'end', 'size' => 1),
			'projeto' => array('label' => __d('cn', 'Projeto', true), 'field' => 'mexc_space_id', 'size' => 1),
			'status' => array('label' => __d('cn', 'Status', true), 'field' => 'publishing_status', 'size' => 1),
			'created' => array('label' => __d('cn', 'Criado', true), 'field' => 'created', 'size' => 1),
		),
		'customRow' => false,
		'customHeader' => false,
		'customSearch' => false,
		//'paramsFoward' => array(0 => 'id'),
		'contain' => false,
	),
	'galleries' => array(
		'actions' => array('create', 'edit', 'see_on_page', 'delete', 'publish_draft'),
		'limitSize' => 30,
		'statusOptions' => array('published', 'draft'),
		'columns' => array(
			'title' => array('label' => __d('cn', 'Nome', true), 'field' => 'title', 'size' => 3),
			'description' => array('label' => __d('cn', 'Apelido', true), 'field' => 'author', 'size' => 5),
			'image_count' => array('label' => __d('cn', 'N. Imagens', true), 'field' => 'mexc_image_count', 'size' => 1),
			'projeto' => array('label' => __d('cn', 'Projeto', true), 'field' => 'mexc_space_id', 'size' => 1),
			'status' => array('label' => __d('cn', 'Status', true), 'field' => 'publishing_status', 'size' => 1),
			'created' => array('label' => __d('cn', 'Criado', true), 'field' => 'created', 'size' => 1),
		),
		'customRow' => false,
		'customHeader' => false,
		'customSearch' => false,
		//'paramsFoward' => array(0 => 'id'),
		'contain' => false,
	),
	'documents' => array(
		'actions' => array('create', 'edit', 'see_on_page', 'delete', 'publish_draft'),
		'limitSize' => 30,
		'statusOptions' => array('published', 'draft'),
		'columns' => array(
			'title' => array('label' => __d('cn', 'Nome', true), 'field' => 'title', 'size' => 3),
			'author' => array('label' => __d('cn', 'Apelido', true), 'field' => 'author', 'size' => 2),
			'summary' => array('label' => __d('cn', 'Mini descrição', true), 'field' => 'summary', 'size' => 4),
			'projeto' => array('label' => __d('cn', 'Projeto', true), 'field' => 'mexc_space_id', 'size' => 1),
			'status' => array('label' => __d('cn', 'Status', true), 'field' => 'publishing_status', 'size' => 1),
			'created' => array('label' => __d('cn', 'Criado', true), 'field' => 'created', 'size' => 1),
		),
		'customRow' => false,
		'customHeader' => false,
		'customSearch' => false,
		//'paramsFoward' => array(0 => 'id'),
		'contain' => false,
	),
	'la_poste' => array(
		'actions' => array('create'),
		'limitSize' => 30,
		'statusOptions' => null, //array('published', 'draft'),
		'columns' => array(
			'created' => array('label' => __d('la_poste', 'LaPoste header: created', true), 'field' => 'created', 'size' => '2'),
			'subject' => array('label' => __d('la_poste', 'LaPoste header: subject', true), 'field' => 'subject', 'size' => '4'),
			'status' => array('label' => __d('la_poste', 'LaPoste header: status', true), 'field' => 'status', 'size' => '2'),
			'total' => array('label' => __d('la_poste', 'LaPoste header: total', true), 'field' => 'lp_copy_count', 'size' => '1'),
			'sent' => array('label' => __d('la_poste', 'LaPoste header: sent', true), 'field' => 'lp_pending_copy_count', 'size' => '1'),
			'aux' => array('label' => __d('la_poste', 'LaPoste header: aux', true), 'field' => 'aux_identifier', 'size' => '2'),
		),
		'customRow' => true,
		'customHeader' => false,
		'customSearch' => false,
		//'paramsFoward' => array(0 => 'id'),
		'contain' => false,
	),
	'user_users' => array(
		'actions' => array('delete','edit', 'create'),
		'limitSize' => 100,
		'statusOptions' => array('published', 'draft'),
		'columns' => array(
			'name' => array('label' => __d('backstage', 'UserUser header: name', true), 'field' => 'name', 'size' => '2'),
			'profiles' => array('label' => __d('backstage', 'UserUser header: profiles', true), 'size' => '4'),
			'actions' => array('label' => __d('backstage', 'UserUser header: actions', true), 'size' => '3'),
		),
		'customRow' => true,
		'customSearch' => true,
		'contain' => array('UserProfile'),
	),
	'user_profiles' => array(
		'actions' => array('delete','edit', 'create'),
		'limitSize' => 100,
		'statusOptions' => array('published', 'draft'),
		'columns' => array(
			'name' => array('label' => __d('backstage', 'UserProfile header: name', true), 'field' => 'name', 'size' => '2'),
			'profiles' => array('label' => __d('backstage', 'UserProfile header: permissions', true), 'size' => '4'),
			'actions' => array('label' => __d('backstage', 'UserProfile header: actions', true), 'size' => '3'),
		),
		'customRow' => true,
		'customSearch' => true,
		'contain' => array('UserPermission'),
	),
	'user_permissions' => array(
		'actions' => array('delete','edit', 'create'),
		'limitSize' => 100,
		'statusOptions' => array('published', 'draft'),
		'columns' => array(
			'name' => array('label' => __d('backstage', 'UserPermission header: name', true), 'field' => 'name', 'size' => '3'),
			'description' => array('label' => __d('backstage', 'UserPermission header: description', true), 'field' => 'name', 'size' => '6'),
			'actions' => array('label' => __d('backstage', 'UserPermission header: actions', true), 'size' => '3'),
		),
		'customRow' => true,
		'customSearch' => true,
	),
)
);
