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
		'actions' => array('create', 'edit', 'see_on_page', 'delete'),
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
		'actions' => array('create', 'edit', 'see_on_page', 'delete'),
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
		'actions' => array('create', 'edit', 'see_on_page', 'delete'),
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
		'actions' => array('create', 'edit', 'see_on_page', 'delete'),
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
		'actions' => array('create', 'edit', 'see_on_page', 'delete'),
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
	'lp_copy' => array(
		'actions' => array('create'),
		'limitSize' => 40,
		'statusOptions' => null, //array('published', 'draft'),
		'columns' => array(
			'to' => array('label' => __d('la_poste', 'LpCopy header: to', true), 'size' => '5.5'),
			'state' => array('label' => __d('la_poste', 'LpCopy header: state', true), 'size' => '1.5'),
			'first_try' => array('label' => __d('la_poste', 'LpCopy header: first_try', true), 'size' => '2'),
			'last_try' => array('label' => __d('la_poste', 'LpCopy header: last_try', true), 'size' => '2'),
			'tries' => array('label' => __d('la_poste', 'LpCopy header: tries', true), 'size' => '1'),
		),
		'customRow' => true,
		'customHeader' => true,
		'customSearch' => false,
		'paramsFoward' => array(0 => 'LpCopy.lp_letter_id'),
		'contain' => array('LpFirstTry', 'LpLastTry', 'LpLetter'),
	),
	'sui_user' => array(
		'actions' => array('delete','edit'),
		'limitSize' => 20,
		'columns' => array(
			'name' => array('label' => __d('sui', 'SuiUser header: name', true), 'field' => 'name', 'size' => '2'),
			'city' => array('label' => __d('sui', 'SuiUser header: city', true), 'field' => 'city', 'size' => '2'),
			'state' => array('label' => __d('sui', 'SuiUser header: state', true), 'field' => 'state', 'size' => '1'),
			'sui_users_type_id' => array('label' => __d('sui', 'SuiUser header: sui_users_type_id', true), 'field' => 'sui_users_type_id', 'size' => '1'),
			'user_status' => array('label' => __d('sui', 'SuiUser header: user_status', true), 'field' => 'user_status', 'size' => '1'),
			'username' => array('label' => __d('sui', 'SuiUser header: username', true), 'size' => '2'),
			'institutions' => array('label' => __d('sui', 'SuiUser header: institutions', true), 'size' => '2'),
			'subscriptions' => array('label' => __d('sui', 'SuiUser header: subscriptions', true), 'size' => '1'),
		),
		'customRow' => true,
		'customSearch'  => true,
		'contain' => array('SuiUsersType', 'SuiInstitution', 'SuiApplicationsSuiUser', 'SuiApplication'),
	),
	'sui_institution' => array(
		'actions' => array('delete','edit'),
		'limitSize' => 20,
		'columns' => array(
			'name' => array('label' => __d('sui', 'SuiInstitution header: name', true), 'field' => 'name', 'size' => '4'),
			'city' => array('label' => __d('sui', 'SuiInstitution header: city', true), 'field' => 'city', 'size' => '3'),
			'state' => array('label' => __d('sui', 'SuiInstitution header: state', true), 'field' => 'state', 'size' => '1'),
			'cnpj' => array('label' => __d('sui', 'SuiInstitution header: cnpj', true), 'field' => 'cnpj', 'size' => '2'),
			'type' => array('label' => __d('sui', 'SuiInstitution header: type', true), 'size' => '1'),
			'subscriptions' => array('label' => __d('sui', 'SuiInstitution header: subscriptions', true), 'size' => '1'),
		),
		'customRow' => true,
		'customSearch'  => true,
		'contain' => array('SuiInstitutionType', 'SuiApplicationCompleted'),
	),
	'sui_subscription' => array(
		'actions' => array('create', 'edit'),
		'limitSize' => 20,
		'columns' => array(
			'subscription_model' => array('label' => __d('sui', 'SuiSubscription header: name', true), 'field' => 'subscription_model', 'size' => '2'),
			'title' => array('label' => __d('sui', 'SuiSubscription header: title', true), 'field' => 'title', 'size' => '4'),
			'start' => array('label' => __d('sui', 'SuiSubscription header: start', true), 'size' => '2'),
			'subscription_status' => array('label' => __d('sui', 'SuiSubscription header: subscription_status', true), 'field' => 'subscription_status', 'size' => '2'),
			'subscriptions_completed' => array('label' => __d('sui', 'SuiSubscription header: subscriptions_completed', true), 'size' => '1'),
			'subscriptions_waiting' => array('label' => __d('sui', 'SuiSubscription header: subscriptions_waiting', true), 'size' => '1'),
		),
		'customRow' => true,
		'customSearch'  => true,
		'paramsFoward' => array('a'),
		'contain' => array(
			'SuiApplicationPeriod', 'SuiCurrentApplicationPeriod'
		)
	),
	'sui_application' => array(
		'actions' => array('edit'),
		'limitSize' => 20,
		'columns' => array(
			'code' => array('label' => __d('sui', 'SuiApplication header: code', true), 'field' => 'code', 'size' => '1'),
			'team_name' => array('label' => __d('sui', 'SuiApplication header: team_name', true), 'field' => 'team_name', 'size' => '2'),
			'mode' => array('label' => __d('sui', 'SuiApplication header: mode', true), 'size' => '2'),
			'type_school' => array('label' => __d('sui', 'SuiApplication header: type_school', true), 'size' => '1'),
			'school' => array('label' => __d('sui', 'SuiApplication header: school', true), 'size' => '2'),
			'where' => array('label' => __d('sui', 'SuiApplication header: where', true), 'size' => '1'),
			'responsible' => array('label' => __d('sui', 'SuiApplication header: responsible', true), 'size' => '2'),
			'status' => array('label' => __d('sui', 'SuiApplication header: status', true), 'field' => 'status', 'size' => '1'),
		),
		'customRow' => true,
		'customSearch' => true,
		'customHeader' => true,
		'paramsFoward' => array(0 => 'sui_subscription_id'),
		'contain' => array(
			'SuiUser',
			'SuiInstitution',
			'SuiFeedback' => 'UserUser',
			'SuiApplicationPeriod'
		),
		'additionalFilteringConditions' => array('MexcSpace.DashboardFiltering'),
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
	'mojo_queue' => array(
		'actions' => array('delete','edit', 'create'),
		'limitSize' => 20,
		'columns' => array(
			'name' => array('label' => __d('sui', 'MojoQueue header: name', true), 'field' => 'name', 'size' => '4'),
			'slug' => array('label' => __d('sui', 'MojoQueue header: slug', true), 'field' => 'slug', 'size' => '3'),
			'created' => array('label' => __d('sui', 'MojoQueue header: created', true), 'field' => 'created', 'size' => '2'),
			'modified' => array('label' => __d('sui', 'MojoQueue header: modified', true), 'field' => 'modified', 'size' => '2'),

		),
	),
)
);
