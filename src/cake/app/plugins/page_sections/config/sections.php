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

$config = array();

/**
 * Config file for the Section Handler, it has basically two important
 * indexes: 'sections' and 'sectionMap'.
 *
 * Usage:
 * 'sections' =>
 * <code>
 * 	$config['sections'] = array(
 * 	'section_name' => array(
 *		
 *		// This is the text that will be used in the menu link.
 *		// DEFAULTS: To humanized section name
 *		'linkCaption' => __('The Section', true),		
 *		
 *		// To were the link points - the section's address
 *		'url' => array(
 *			'plugin' => 'module',
 *			'controller' => 'controller',
 *			'action' => 'sobre'
 *		),
 *
 *		// If it should be displayed in a menu:
 *		// DEFAULTS: To true
 *		'display' => true,
 *
 *      // If the section is active, defaults to TRUE.
 *      'active' => false // or true, or 'admin', or 'adminTechie', or 'debug'
 *			
 *		// Array of titles given in the page title, 'null' indicates to use the previous section
 *		// title in this specific array position.
 *		// DEFAULTS: To the array of previous section appended with ['linkCaption']	
 *		'pageTitle' => array(null, __('The title of this section', true)), 
 *			
 *		// If the page has a header, this will be the Heading (h1 probably) that will be displayed
 *		// DEFAULTS: To ['linkCaption']	
 *		'headerCaption' => __('The Section', true),
 *			
 *		// If somewhere it's needed to show a human name other than for Heading, this is 
 *		// used.
 *		// DEFAULTS: To ['The Section']	
 *		'humanName' => __('The Section', true),
 *			
 *		//optional:  The module this section corresponds.
 *		'module' => 'SectionModule',
 *			
 *		// To wich ACO one must be authenticated in order to access this Sesssion.
 *		// If there is more than one it will be checked against all of them.
 *		// DEFAULTS TO: array('section_name' => array('read'))	
 *		'acos' => array('permission_area' => array('read')),
 *
 *      // In case if there is some agroupment in the same menu level.
 *      'sectionGroup' => 'this_group' 
 *		
 *		// The sub sections of this section
 *		'subSections' => array(
 *			'other_section_name' => 
 *			'another_section_name' => 			
 * )
 * );
 * </code>
 *
 * 'sectionMap':
 *	  $config['sectionMap'] => array(
 *			array( //an entry in the sectionMap - it provides a match rule the equivalent
 *				   //section, and the subRules for matching.
 *				'rule' => array('controller' => 'section_controller'), //it will match any action that has these parameters
 *				'location' => array('section_name'),
 *				'subRules' => array( //if the parent matches it searches 
 *					array(), 
 *					array(),
 *					array(),
 *				)
 *			)
 *		 );
 *
 */
 
 
$sections = array(
	'public_page' => array(
		'linkCaption' => __('Sections: public_page linkCaption', true),
		'pageTitle'   => array(__('Sections: public_page pageTitle', true)),
		'url' => array(
			'plugin' => false,
			'controller' => 'main',
			'action' => 'index'
		),
		'display' => false,
		'subSections' => array(
			'rede' => array(
				'linkCaption' => __('Sections: museum linkCaption', true),
				'pageTitle'   => array(__('Sections: museum pageTitle', true)),
				'url' => array(
					'plugin' => false,
					'controller' => 'main',
					'action' => 'index'
				),
				'subSections' => array(
					'home' => array(
						'linkCaption' => __('home', true),
						'humanName'   => __('home', true),
						'pageTitle'   => array(null, __('home', true)),
						'url' => array(
							'plugin' => false,
							'controller' => 'main',
							'action' => 'index'
						),
					),
					'news' => array(
						'linkCaption' => __('Novidades', true),
						'pageTitle'   => array(null, __('Novidades', true)),
						'url' => array(
							'plugin' => 'mexc_news', 'controller' => 'mexc_news', 'action' => 'index'),
						'subSections' => array(
							'index' => array(
								'linkCaption' => __('Sections: mexc_news index linkCaption', true),
								'pageTitle'   => array(null, null, __('Sections: mexc_news index pageTitle', true)),
								'url' => array(
									'plugin' => 'mexc_news', 'controller' => 'mexc_news', 'action' => 'index'),
							),
							'item' => array(
								'linkCaption' => __('Sections: mexc_news item linkCaption', true),
								'pageTitle'   => array(null, null, __('Sections: mexc_news item pageTitle', true)),
								'jj_module'   => 'new',
								'url' => array(
									'plugin' => 'mexc_news', 'controller' => 'mexc_news', 'action' => 'read'),
							),
						),
					),
					'events' => array(
						'linkCaption' => __('Agenda', true),
						'pageTitle'   => array(null, __('Agenda', true)),
						'url' => array(
							'plugin' => 'mexc_events', 'controller' => 'mexc_events', 'action' => 'index'),
						'subSections' => array(
							'index' => array(
								'linkCaption' => __('Agenda', true),
								'pageTitle'   => array(null, null, __('Agenda', true)),
								'url' => array(
									'plugin' => 'mexc_events', 'controller' => 'mexc_events', 'action' => 'index'),
							),
							'item' => array(
								'linkCaption' => __('Agenda', true),
								'pageTitle'   => array(null, null, __('Agenda', true)),
								'jj_module'   => 'event',
								'url' => array(
									'plugin' => 'mexc_events', 'controller' => 'mexc_events', 'action' => 'read'),
							),
						),
					),
					'galleries' => array(
						'linkCaption' => __('Galerias', true),
						'pageTitle'   => array(null, __('Galeria', true)),
						'url' => array(
							'plugin' => 'mexc_galleries', 'controller' => 'mexc_galleries', 'action' => 'index'),
						'subSections' => array(
							'index' => array(
								'linkCaption' => __('Galeria', true),
								'pageTitle'   => array(null, null, __('Galeria', true)),
								'url' => array(
									'plugin' => 'mexc_galleries', 'controller' => 'mexc_galleries', 'action' => 'index'),
							),
							'item' => array(
								'linkCaption' => __('Galeria', true),
								'pageTitle'   => array(null, null, __('Galeria', true)),
								'jj_module'   => 'gallery',
								'url' => array(
									'plugin' => 'mexc_galleries', 'controller' => 'mexc_galleries', 'action' => 'read'),
							),
						),
					),
					'fact_sites' => array(
						'linkCaption' => __('Projetos', true),
						'pageTitle' => array(null,__('Projetos', true)),
						'url' => array(
							'plugin' => 'site_factory', 'controller' => 'fact_sites', 'action' => 'all_sites'
						),
					),
					'documents' => array(
						'linkCaption' => __('Biblioteca', true),
						'pageTitle' => array(null,__('Biblioteca', true)),
						'collapse' => true,
						'url' => array(
							'plugin' => 'mexc_documents', 'controller' => 'mexc_documents', 'action' => 'index'),
						'subSections' => array(
							'index' => array(
								'linkCaption' => __('Biblioteca', true),
								'pageTitle'   => array(null, null, __('Biblioteca', true)),
								'url' => array(
									'plugin' => 'mexc_documents', 'controller' => 'mexc_documents', 'action' => 'index'),
							),
							'item' => array(
								'linkCaption' => __('Biblioteca', true),
								'pageTitle'   => array(null, null, __('Biblioteca', true)),
								'jj_module'   => 'document',
								'url' => array(
									'plugin' => 'mexc_documents', 'controller' => 'mexc_documents', 'action' => 'read'),
							),
						),
					),
					'files' => array(
						'linkCaption' => __('Arquivos', true),
						'pageTitle' => array(null,__('Arquivos', true)),
						'collapse' => true,
						'url' => array(
							'plugin' => 'mexc_documents', 'controller' => 'mexc_documents', 'action' => 'index'
						),
					),
					'about' => array(
						'linkCaption' => __('Sobre', true),
						'pageTitle'   => array(null, __('A Rede', true)),
						'collapse' => true,
						'url' => array('plugin' => null, 
							'controller' => 'about', 'action' => 'rede'
						),
						'subSections' => array(
							'rede' => array(
								'linkCaption' => __('A Rede', true),
								'pageTitle'   => array(null, null, __('Sobre', true)),
								'url' => array(
									'plugin' => null, 'controller' => 'about', 'action' => 'rede'),
							),
							//'site_map' => array(
								//'linkCaption' => __('Sections: mexc_about site_map linkCaption', true),
								//'pageTitle'   => array(null, null, __('Sections: mexc_about site_map pageTitle', true)),
								//'display' => false,
								//'url' => array(
									//'plugin' => 'mexc_about',
									//'controller' => 'mexc_about',
									//'action' => 'site_map'
								//),
							//),
						)
					),
					'facebook' => array(
						'linkCaption' => 'Facebook',
						'collapse' => true,
						'url' => 'http://facebook.com'
					)
				),
			),
			'fact_sites' => array(
				'linkCaption' => __('Projetos', true),
				'pageTitle' => array(null,__('Projetos', true)),
				'url' => array(
					'plugin' => 'site_factory', 'controller' => 'fact_sites', 'action' => 'all_sites'
				),
				'subSections' => array(
					'ecoforte' => array(
						'linkCaption' => 'Projeto Ecoforte',
						'url' => array('plugin' => 'site_factory', 'controller' => 'fact_sites', 'action' => 'index', 'ecoforte'),
						'subSections' => array(
							'sobre' => array(
								'linkCaption' => 'Sobre o projeto',
							),   
							'equipe' => array(
								'linkCaption' => 'Equipe'
							),   
							'urs' => array(
								'linkCaption' => 'Unidades de referência'
							),   
						)    
					),   
				),
			),
			'public_sui_stuff' => array(
				'linkCaption' => ' ',
				'display' => false,
				'breadcrumb' => false,
				'subSections' => array(
					'login' => array(
						'display' => false,
						'linkCaption' => __d('page_sections', 'Login linkCaption', true),
						'humanName' => __d('page_sections', 'Login humanName', true),
						'pageTitle' => array(null, __d('page_sections', 'Login pageTitle', true)),
					),
					'fake_login' => array(
						'display' => false,
						'linkCaption' => __d('page_sections', 'Login linkCaption', true),
						'humanName' => __d('page_sections', 'Login humanName', true),
						'pageTitle' => array(null, __d('page_sections', 'Login pageTitle', true)),
					),
					'new_account' => array(
						'linkCaption' => __d('page_sections', 'NewAccount SUI linkCaption', true),
						'humanName' => __d('page_sections', 'NewAccount SUI humanName', true),
						'display' => false,
					),
					'success' => array(
						'linkCaption' => __d('page_sections', 'NewAccount success linkCaption', true),
						'humanName' => __d('page_sections', 'NewAccount success humanName', true),
						'pageTitle' => array(null, __d('page_sections', 'NewAccount success pageTitle', true)),
						'display' => false,
					),
					'resend' => array(
						'linkCaption' => 'Reenviar e-mail',
						'humanName' => 'Reenviar e-mail',
						'pageTitle' => array(null, 'Reenviar e-mail'),
						'display' => false,
					),
					'recover' => array(
						'linkCaption' => __d('page_sections', 'NewAccount recover linkCaption', true),
						'humanName' => __d('page_sections', 'NewAccount recover humanName', true),
						'pageTitle' => array(null, __d('page_sections', 'NewAccount recover pageTitle', true)),
						'display' => false,
					),
					'validate' => array(
						'linkCaption' => __d('page_sections', 'NewAccount validate linkCaption', true),
						'humanName' => __d('page_sections', 'NewAccount validate humanName', true),
						'pageTitle' => array(null, __d('page_sections', 'NewAccount validate pageTitle', true)),
						'display' => false,
					),
					'message' => array(
						'linkCaption' => __d('page_sections', 'NewAccount message linkCaption', true),
						'humanName' => __d('page_sections', 'NewAccount message humanName', true),
						'pageTitle' => array(null, __d('page_sections', 'NewAccount message pageTitle', true)),
						'url' => array('plugin' => 'sui', 'controller' => 'sui_main', 'action' => 'mensagem'),
						'display' => false,
					),
					'cancel_account_edition' => array(
						'linkCaption' => ' ',
						'display' => false,
					),
					'account_validation' => array(
						'linkCaption' => ' ',
						'display' => false,
					),
					'institution' => array(
						'linkCaption' => ' ',
						'display' => false,
					),
					'save' => array(
						'linkCaption' => ' ',
						'display' => false,
					),
				)
			),
			'user_area' => array(
				'display' => false,
				'url' => array('plugin' => 'sui','controller' => 'sui_main','action' => 'index'),
				'linkCaption' => __d('page_sections', 'SUI link', true),
				'pageTitle' => array(null, __d('page_sections', 'SUI pageTitle', true)),
				'headerCaption' => __d('page_sections', 'SUI headerCaption', true),
				'humanName' => __d('page_sections', 'SUI humanName', true),
				'subSections' => array(
					'main' => array(
						'linkCaption' => __d('page_sections', 'Main SUI linkCaption', true),
						'humanName' => __d('page_sections', 'Main SUI humanName', true),
						'url' => array('plugin' => 'sui', 'controller' => 'sui_main', 'action' => 'index'),
					),
					'application' => array(
						'display' => false,
						'linkCaption' => __d('page_sections', 'Application SUI linkCaption', true),
						'humanName' => __d('page_sections', 'Application SUI humanName', true),
					),
					'payment' => array(
						'display' => false,
						'linkCaption' => __d('page_sections', 'Payment SUI linkCaption', true),
						'humanName' => __d('page_sections', 'Payment SUI humanName', true),
					),
					'account' => array(
						'linkCaption' => __d('page_sections', 'Account SUI linkCaption', true),
						'humanName' => __d('page_sections', 'Account SUI humanName', true),
						'url' => array('plugin' => 'sui', 'controller' => 'sui_users', 'action' => 'cadastro'),
					),
					'logout' => array(
						'linkCaption' => __d('page_sections', 'Logout SUI linkCaption', true),
						'humanName' => __d('page_sections', 'Logout SUI humanName', true),
						'url' => array('plugin' => 'sui', 'controller' => 'sui_users', 'action' => 'logout'),
					)
				)
			),
			'search' => array(
				'linkCaption' => __d('page_sections', 'Search linkCaption', true),
				'pageTitle' => array(null,__d('page_sections', 'Search pageTitle',true)),
				'display' => false,
				'url' => array(
					'plugin' => 'mexc_search',
					'controller' => 'mexc_search',
					'action' => 'index'
				),
			),
		)
	),
	'backstage' => array(
		'linkCaption' => __('Sections: backstage linkCaption', true),
		'url' => array(
			'plugin' => 'backstage',
			'controller' => 'back_contents',
			'action' => 'index'
		),
		'pageTitle' => array(__('Sections: backstage pageTitle',true)),
		'headerCaption' => __('Sections: backstage headerCaption', true),
		'humanName' => __('Sections: backstage humanName',true),
		'subSections' => array(
			'login' => array(
				'linkCaption' => __('Sections: login linkCaption', true),
				'url' => array(
					'plugin' => 'jj_users',
					'controller' => 'user_users',
					'action' => 'login'
				),
				'display' => false,
				'pageTitle' => array(null, __('Sections: login pageTitle',true)),
				'headerCaption' => __('Sections: login headerCaption', true),
				'humanName' => __('Sections: login humanName',true),
			),
			'dashboard' => array(
				'linkCaption' => __('Sections: dashboard linkCaption', true),
				'url' => array(
					'plugin' => 'dashboard',
					'controller' => 'dash_dashboard',
					'action' => 'index'
				),
				'permissions' => array('dashboard'),
				'pageTitle' => array(null, __('Sections: dashboard pageTitle',true)),
				'headerCaption' => __('Sections: dashboard headerCaption', true),
				'humanName' => __('Sections: dashboard humanName',true),
			),
			'projects' => array(
				'linkCaption' => __('Projetos', true),
				'pageTitle' => array(null, __('Projetos',true)),
				'headerCaption' => __('Projetos', true),
				'humanName' => __('Projetos',true),
				'url' => array('plugin' => 'backstage','controller' => 'back_contents','action' => 'index','projects'),
				'permissions' => array('backstage', 'user_list'),
			),
			'news' => array(
				'linkCaption' => __('Novidades', true),
				'pageTitle' => array(null, __('Novidades',true)),
				'headerCaption' => __('Novidades', true),
				'humanName' => __('Novidades',true),
				'url' => array('plugin' => 'backstage','controller' => 'back_contents','action' => 'index','news'),
				'permissions' => array('backstage', 'user_list'),
			),
			'events' => array(
				'linkCaption' => __('Agenda', true),
				'pageTitle' => array(null, __('Agenda',true)),
				'headerCaption' => __('Agenda', true),
				'humanName' => __('Agenda',true),
				'url' => array('plugin' => 'backstage','controller' => 'back_contents','action' => 'index','events'),
				'permissions' => array('backstage', 'user_list'),
			),
			'galleries' => array(
				'linkCaption' => __('Galerias', true),
				'pageTitle' => array(null, __('Galerias',true)),
				'headerCaption' => __('Galerias', true),
				'humanName' => __('Galerias',true),
				'url' => array('plugin' => 'backstage','controller' => 'back_contents','action' => 'index','galleries'),
				'permissions' => array('backstage', 'user_list'),
			),
			'documents' => array(
				'linkCaption' => __('Documentos', true),
				'pageTitle' => array(null, __('Documentos',true)),
				'headerCaption' => __('Documentos', true),
				'humanName' => __('Documentos',true),
				'url' => array('plugin' => 'backstage','controller' => 'back_contents','action' => 'index','documents'),
				'permissions' => array('backstage', 'user_list'),
			),
			'preferences' => array(
				'linkCaption' => __('Sections: preferences linkCaption', true),
				'pageTitle' => array(null, __('Sections: preferences pageTitle',true)),
				'headerCaption' => __('Sections: preferences headerCaption', true),
				'humanName' => __('Sections: preferences humanName',true),
				'url' => array('plugin' => 'jj_users', 'controller' => 'user_users', 'action' => 'preferences'),
				'permissions' => array('backstage'),
			),
			'user_administration' => array(
				'linkCaption' => __('Sections: admin linkCaption', true),
				'pageTitle' => array(null, __('Sections: admin pageTitle',true)),
				'headerCaption' => __('Sections: admin headerCaption', true),
				'humanName' => __('Sections: admin humanName',true),
				'url' => array('plugin' => 'backstage','controller' => 'back_contents','action' => 'index', 'user_users'),
				'permissions' => array('backstage', 'user_list'),
				'subSections' => array(
					'user_users' => array(
						'linkCaption' => __('Sections: user_users linkCaption', true),
						'url' => array('plugin' => 'backstage','controller' => 'back_contents','action' => 'index', 'user_users'),
						'permissions' => array('backstage', 'user_list'),
						'pageTitle' => array(null, null, __('Sections: user_users pageTitle',true)),
						'headerCaption' => __('Sections: user_users headerCaption', true),
						'humanName' => __('Sections: user_users humanName',true),
						'subSections' => array(
							'edit' => array(
								'url' => array(
									'plugin' => 'backstage',
									'controller' => 'back_contents',
									'action' => 'edit',
									0 => 'user_users'
								),
								'pageTitle' => array(null, __('Sections: User edit pageTitle',true)),
								'permissions' => array('backstage', 'OR' => array('user_add', 'user_edit')),
							),
							'delete' => array(
								'url' => array(
									'plugin' => 'backstage',
									'controller' => 'back_contents',
									'action' => 'delete_item',
									0 => 'user_users',
								),
								'permissions' => array('backstage', 'user_delete'),
							),
						),
						
					),
					'user_profiles' => array(
						'linkCaption' => __('Sections: user_profiles linkCaption', true),
						'url' => array('plugin' => 'backstage','controller' => 'back_contents','action' => 'index', 'user_profiles'),
						'permissions' => array('backstage', 'user_permission_tree'),
						'pageTitle' => array(null, null, __('Sections: user_profiles pageTitle',true)),
						'headerCaption' => __('Sections: user_profiles headerCaption', true),
						'humanName' => __('Sections: user_profiles humanName',true),
						
					),
					'user_permissions' => array(
						'linkCaption' => __('Sections: user_permissions linkCaption', true),
						'url' => array('plugin' => 'backstage','controller' => 'back_contents','action' => 'index', 'user_permissions'),
						'permissions' => array('backstage', 'user_permission_tree'),
						'pageTitle' => array(null, null, __('Sections: user_permissions pageTitle',true)),
						'headerCaption' => __('Sections: user_permissions headerCaption', true),
						'humanName' => __('Sections: user_permissions humanName',true),
						
					),
				)
			),
			'burocrata_save' => array(
				'linkCaption' => __('Sections: burocrata_save linkCaption', true),
				'url' => array(
					'plugin' => 'burocrata',
					'controller' => 'buro_burocrata',
					'action' => 'save'
				),
				'display' => false,
				'permissions' => array('backstage', 'OR' => array('backstage_edit_draft', 'backstage_edit_published')),
			),
			'set_publishing_status' => array(
				'linkCaption' => __('Sections: set_publishing_status linkCaption', true),
				'url' => array(
					'plugin' => 'backstage',
					'controller' => 'back_contents',
					'action' => 'set_publishing_status'
				),
				'display' => false,
				'permissions' => array('backstage', 'backstage_edit_publishing_status'),
			),
			'dashboard_delete' => array(
				'linkCaption' => __('Sections: set_publishing_status linkCaption', true),
				'url' => array(
					'plugin' => 'dashboard',
					'controller' => 'dash_dashboard',
					'action' => 'delete_item'
				),
				'display' => false,
				'permissions' => array('backstage', 'backstage_delete_item'),
			),
			'backstage_delete' => array(
				'url' => array(
					'plugin' => 'backstage',
					'controller' => 'back_contents',
					'action' => 'delete_item'
				),
				'display' => false,
				'permissions' => array('backstage', 'backstage_delete_item'),
			),
			'corktile_edit' => array(
				'linkCaption' => __('Sections: corktile_edit linkCaption', true),
				'url' => array(
					'plugin' => 'corktile',
					'controller' => 'cork_corktiles',
					'action' => 'edit'
				),
				'display' => false,
				'permissions' => array('backstage', 'backstage_edit_published', 'corktile'),
				'pageTitle' => array(null, __('Sections: corktile_edit pageTitle',true)),
				'headerCaption' => __('Sections: corktile_edit headerCaption', true),
				'humanName' => __('Sections: corktile_edit humanName',true),
			),
			'sui_user' => array(
				'linkCaption' => __d('sui', 'Sections: sui_user linkCaption', true),
				'url' => array('plugin' => 'backstage','controller' => 'back_contents','action' => 'index', 'sui_user'),
				'permissions' => array('backstage', 'sui_user'),
				'pageTitle' => array(null, __d('sui', 'Sections: sui_user pageTitle',true)),
				'headerCaption' => __d('sui', 'Sections: sui_user headerCaption', true),
				'humanName' => __d('sui', 'Sections: sui_user humanName',true),
				'subSections' => array(
					'users_sheet' => array(
						'url' => array(
							'plugin' => 'sui',
							'controller' => 'sui_users',
							'action' => 'users_sheet',
						),
						'linkCaption' => __d('sui', 'Sections: sui_user users_sheet linkCaption', true),
						'permissions' => array('backstage', 'sui_user', 'sui_application_sheet'),
						'display' => false,
					),
					'view_user' => array(
						'url' => array('plugin' => 'sui', 'controller' => 'sui_admin', 'action' => 'view_user'),
						'permissions' => array('backstage', 'sui_user'),
						'display' => false
					)
				)
			),
			'sui_institution' => array(
				'linkCaption' => __d('sui', 'Sections: sui_institution linkCaption', true),
				'url' => array('plugin' => 'backstage','controller' => 'back_contents','action' => 'index', 'sui_institution'),
				'permissions' => array('backstage', 'sui_institution'),
				'pageTitle' => array(null, __d('sui', 'Sections: sui_institution pageTitle',true)),
				'headerCaption' => __d('sui', 'Sections: sui_institution headerCaption', true),
				'humanName' => __d('sui', 'Sections: sui_institution humanName',true),
				'subSections' => array(
					'view_institution' => array(
						'url' => array('plugin' => 'sui', 'controller' => 'sui_admin', 'action' => 'view_institution'),
						'permissions' => array('backstage', 'sui_institutions'),
						'display' => false
					)
				)
			),
			'sui_subscription' => array(
				'linkCaption' => __d('sui', 'Sections: sui_subscription linkCaption', true),
				'url' => array('plugin' => 'backstage','controller' => 'back_contents','action' => 'index', 'sui_subscription'),
				'permissions' => array('backstage', 'sui_subscription'),
				'pageTitle' => array(null, __d('sui', 'Sections: sui_subscription pageTitle',true)),
				'headerCaption' => __d('sui', 'Sections: sui_subscription headerCaption', true),
				'humanName' => __d('sui', 'Sections: sui_subscription humanName',true),
				'subSections' => array(
					'edit' => array(
						'url' => array(
							'plugin' => 'sui', 'controller' => 'sui_subscription', 'action' => 'edit'
						),
						'permissions' => array('sui_edit_subscription'),
						'display' => false
					)
				)
			),
			'sui_application' => array(
				'linkCaption' => __d('sui', 'Sections: sui_application linkCaption', true),
				'pageTitle' => array(null, __d('sui', 'Sections: sui_application pageTitle',true)),
				'headerCaption' => __d('sui', 'Sections: sui_application headerCaption', true),
				'humanName' => __d('sui', 'Sections: sui_application humanName',true),
				'url' => array('plugin' => 'backstage','controller' => 'back_contents','action' => 'index', 'sui_application'),
				'permissions' => array('backstage', 'sui_application'),
				'display' => false,
				'subSections' => array(
					'planilha_gd' => array(
						'url' => array('plugin' => 'sui', 'controller' => 'sui_applications', 'action' => 'planilha_gd'),
						'permissions' => array('sui_application_sheet'),
						'display' => false,
					),
					'planilha_onhb' => array(
						'url' => array('plugin' => 'sui', 'controller' => 'sui_applications', 'action' => 'planilha_onhb'),
						'permissions' => array('sui_application_sheet'),
						'display' => false,
					),
					'cancel' => array(
						'url' => array('plugin' => 'sui', 'controller' => 'sui_applications', 'action' => 'cancel'),
						'permissions' => array('sui_edit_application'),
						'display' => false,
					),
					'mark_as_test' => array(
						'url' => array('plugin' => 'sui', 'controller' => 'sui_applications', 'action' => 'mark_as_test'),
						'permissions' => array('sui_edit_application'),
						'display' => false,
					),
					'feedback' =>  array(
						'url' => array('plugin' => 'sui', 'controller' => 'sui_feedbacks', 'action' => 'edit'),
						'permissions' => array('sui_edit_application'),
						'display' => false
					),
					'view_application' => array(
						'url' => array('plugin' => 'sui', 'controller' => 'sui_admin', 'action' => 'view_application'),
						'permissions' => array('backstage', 'sui_application'),
						'display' => false
					),
					'admin_payment' => array(
						'url' => array('plugin' => 'sui', 'controller' => 'sui_applications', 'action' => 'admin_payment'),
						'permissions' => array('backstage', 'sui_edit_application'),
						'display' => false
					)
				)
			),
			'sui_admin' => array(
				'url' => array('plugin' => 'sui','controller' => 'sui_admin'),
				'linkCaption' => __d('sui', 'Sections: sui_admin linkCaption', true),
				'permissions' => array('backstage'),
				'display' => false,
				'subSections' => array(
					'force_login' => array(
						'url' => array('plugin' => 'sui', 'controller' => 'sui_main', 'action' => 'force_login'),
						'linkCaption' => ' ',
						'permissions' => array('force_login'),
						'display' => false
					),
					'block_user' => array(
						'url' => array(
							'plugin' => 'sui',
							'controller' => 'sui_admin',
							'action' => 'block_user',
						),
						'linkCaption' => __d('sui', 'Sections: sui_admin block user linkCaption', true),
						'permissions' => array('sui_edit_user'),
						'display' => false,
					),
					'get_users_type' => array(
						'url' => array(
							'plugin' => 'sui',
							'controller' => 'sui_admin',
							'action' => 'get_users_type',
						),
						'linkCaption' => __d('sui', 'Sections: sui_admin get_users_type linkCaption', true),
						'permissions' => array('backstage_edit_published'),
						'display' => false,
					),
					'get_institutions_type' => array(
						'url' => array(
							'plugin' => 'sui',
							'controller' => 'sui_admin',
							'action' => 'get_institutions_type',
						),
						'linkCaption' => __d('sui', 'Sections: sui_admin get_institutions_type linkCaption', true),
						'permissions' => array('backstage_edit_published'),
						'display' => false,
					),
					'delete_user' => array(
						'linkCaption' => __d('sui', 'Sections: sui_admin get_institutions_type linkCaption', true),
						'url' => array('plugin' => 'sui', 'controller' => 'sui_users', 'action' => 'delete'),
						'permissions' => array('backstage_delete_item', 'sui_edit_user'),
						'display' => false,
					)
				),
			),
			'edit' => array(
				'linkCaption' => __('Sections: edit linkCaption', true),
				'url' => array(
					'plugin' => 'backstage',
					'controller' => 'back_contents',
					'action' => 'edit'
				),
				'display' => false,
				'permissions' => array('backstage', 'backstage_edit_draft'),
				'pageTitle' => array(null, __('Sections: edit pageTitle',true)),
				'headerCaption' => __('Sections: edit headerCaption', true),
				'humanName' => __('Sections: edit humanName',true),
			),
		),
	),
	'paineladmin' => array(
		'linkCaption' => __('Sections: paineladmin linkCaption', true),
		'url' => array(
			'plugin' => 'paineladmin',
		),
		'pageTitle' => array(__('Sections: paineladmin pageTitle',true)),
		'headerCaption' => __('Sections: paineladmin headerCaption', true),
		'humanName' => __('Sections: paineladmin humanName',true),
		'display' => false,
		'subSections' => array(
			'olimpiada' => array(
				'linkCaption' => __('Sections: olimpiada linkCaption', true),
				'url' => array(
					'plugin' => 'olimpiada_quatro',
					'prefix' => 'paineladmin', 
					'paineladmin' => true
				),
				'permissions' => array('paineladmin', 'olimpiada'),
				'display' => false,
				'pageTitle' => array(null, __('Sections: olimpiada pageTitle',true)),
				'headerCaption' => __('Sections: olimpiada headerCaption', true),
				'humanName' => __('Sections: olimpiada humanName',true),
			),
			'gd' => array(
				'linkCaption' => __('Sections: gd linkCaption', true),
				'url' => array(
					'plugin' => 'grandedesafio',
					'controller' => 'equipes', 
					'action' => 'admin_premiacoes'
				),
				'permissions' => array('paineladmin', 'gd'),
				'display' => false,
				'pageTitle' => array(null, __('Sections: gd pageTitle',true)),
				'headerCaption' => __('Sections: gd headerCaption', true),
				'humanName' => __('Sections: gd humanName',true),
			),
		),
	),
);

$sectionMap = array(
	// Factory rules (subrules are completed by MexcAppController)
	array(
		'rule' => array('plugin' => 'site_factory', 'controller' => 'fact_sites'),
		'location' => array('public_page', 'fact_sites'),
		'subRules' => array(
			array(
				'rule' => array('action' => 'all_sites'),
				'location' => array(null,null,'all_sites')
			)
		)
	),
	
	// Hardcoded factory rules
	array(
		'rule' => array('plugin' => 'olimpiada'),
		'location' => array('public_page', 'fact_sites', 'olimpiada'),
		'subRules' => array(
			array(
				'rule' => array('edicao' => 2),
				'location' => array(null, null, null, 'olimpiada_2')
			),
		)
	),
	
	// Main site
	array(
		'rule' => array('controller' => 'main', 'action' => 'index'),
		'location' => array('public_page', 'rede', 'home'),
	),
	array(
		'rule' => array('plugin' => 'mexc_news', 'controller' => 'mexc_news'),
		'location' => array('public_page', 'rede', 'news'),
		'subRules' => array(
			array(
				'rule' => array ('action' => 'read'),
				'location' => array(null, null, null, 'item'),
			),
		)
	),
	array(
		'rule' => array('plugin' => 'mexc_documents', 'controller' => 'mexc_documents'),
		'location' => array('public_page', 'rede', 'documents'),
		'subRules' => array(
			array(
				'rule' => array ('action' => 'read'),
				'location' => array(null, null, null, 'item'),
			),
		)
	),
	array(
		'rule' => array('plugin' => 'mexc_events', 'controller' => 'mexc_events'),
		'location' => array('public_page', 'rede', 'events'),
		'subRules' => array(
			array(
				'rule' => array ('action' => 'read'),
				'location' => array(null, null, null, 'item'),
			),
		)
	),
	array(
		'rule' => array('plugin' => 'mexc_documents', 'controller' => 'mexc_files'),
		'location' => array('public_page', 'rede', 'files'),
		'subRules' => array(
			array(
				'rule' => array ('action' => 'view'),
				'location' => array(null, null, null, 'item'),
			),
		)
	),
	array(
		'rule' => array('plugin' => 'mexc_galleries', 'controller' => 'mexc_galleries'),
		'location' => array('public_page', 'rede', 'galleries'),
		'subRules' => array(
			array(
				'rule' => array ('action' => 'read'),
				'location' => array(null, null, null, 'item'),
			),
		)
	),
	array(
		'rule' => array('plugin' => 'mexc_digital_collections', 'controller' => 'mexc_digital_collections'),
		'location' => array('public_page', 'rede', 'digital_collections'),
		'subRules' => array(
			array(
				'rule' => array ('action' => 'read'),
				'location' => array(null, null, null, 'item'),
			),
		)
	),
	
	// About
	array(
		'rule' => array('controller' => 'about'),
		'location' => array('public_page', 'rede', 'about'),
		'subRules' => array(
			array(
				'rule' => array('action' => 'rede'),
				'location' => array(null,null,null,'rede')
			),
			//array(
				//'rule' => array('action' => 'site_map'),
				//'location' => array(null,null,null,'site_map')
			//)
		)
	),
	
	// SUI
	array(
		'rule' => array('plugin' => 'sui'),
		'location' => array('public_page', 'user_area'),
		'subRules' => array(
			// Public actions
			array(
				'rule' => array('controller' => 'sui_users', 'action' => 'novo_cadastro'),
				'location' => array(null, 'public_sui_stuff', 'new_account')
			),
			array(
				'rule' => array('controller' => 'sui_users', 'action' => 'login'),
				'location' => array(null, 'public_sui_stuff', 'login')
			),
			array(
				'rule' => array('controller' => 'sui_users', 'action' => 'fake_login'),
				'location' => array(null, 'public_sui_stuff', 'fake_login')
			),
			array(
				'rule' => array('controller' => 'sui_users', 'action' => 'sucesso'),
				'location' => array(null, 'public_sui_stuff', 'success')
			),
			array(
				'rule' => array('controller' => 'sui_users', 'action' => 'recuperar'),
				'location' => array(null, 'public_sui_stuff', 'recover')
			),
			array(
				'rule' => array('controller' => 'sui_users', 'action' => 'troca_senha'),
				'location' => array(null, 'public_sui_stuff', 'recover')
			),
			array(
				'rule' => array('controller' => 'sui_users', 'action' => 'reenviar'),
				'location' => array(null, 'public_sui_stuff', 'resend')
			),
			array(
				'rule' => array('controller' => 'sui_users', 'action' => 'validar'),
				'location' => array(null, 'public_sui_stuff', 'validate')
			),
			array(
				'rule' => array('controller' => 'sui_users', 'action' => 'validates'),
				'location' => array(null, 'public_sui_stuff', 'account_validation')
			),
			array(
				'rule' => array('controller' => 'sui_users', 'action' => 'cancelar'),
				'location' => array(null, 'public_sui_stuff', 'cancel_account_edition')
			),
			array(
				'rule' => array('controller' => 'sui_users', 'action' => 'save'),
				'location' => array(null, 'public_sui_stuff', 'save')
			),
			array(
				'rule' => array('controller' => 'sui_main', 'action' => 'mensagem'),
				'location' => array(null, 'public_sui_stuff', 'message')
			),
			array(
				'rule' => array('controller' => 'sui_institutions'),
				'location' => array(null, 'public_sui_stuff', 'institution')
			),
			
			// Private actions
			array(
				'rule' => array('controller' => 'sui_main', 'action' => 'index'),
				'location' => array(null, null, 'main')
			),
			array(
				'rule' => array('controller' => 'sui_users', 'action' => 'cadastro'),
				'location' => array(null, null, 'account')
			),
			array(
				'rule' => array('controller' => 'sui_subscriptions', 'action' => 'inscrever'),
				'location' => array(null, null, 'application')
			),
			array(
				'rule' => array('controller' => 'sui_payments'),
				'location' => array(null, null, 'payment')
			),
			
			//Admin actions
			array(
				'rule' => array('controller' => 'sui_admin', 'action' => 'force_login'),
				'location' => array('backstage', 'sui_admin', 'force_login')
			),
			array(
				'rule' => array('controller' => 'sui_admin', 'action' => 'block_user'),
				'location' => array('backstage', 'sui_admin', 'block_user')
			),
			array(
				'rule' => array('controller' => 'sui_admin', 'action' => 'get_users_type'),
				'location' => array('backstage', 'sui_admin', 'get_users_type')
			),
			array(
				'rule' => array('controller' => 'sui_admin', 'action' => 'get_institutions_type'),
				'location' => array('backstage', 'sui_admin', 'get_institutions_type')
			),
			array(
				'rule' => array('controller' => 'sui_users', 'action' => 'delete'),
				'location' => array('backstage', 'sui_admin', 'delete_user')
			),
			array(
				'rule' => array('controller' => 'sui_users', 'action' => 'users_sheet'),
				'location' => array('backstage', 'sui_user', 'users_sheet')
			),
			array(
				'rule' => array('controller' => 'sui_admin', 'action' => 'view_user'),
				'location' => array('backstage', 'sui_user', 'view_user')
			),
			array(
				'rule' => array('controller' => 'sui_admin', 'action' => 'view_institution'),
				'location' => array('backstage', 'sui_institution', 'view_institution')
			),
			array(
				'rule' => array('controller' => 'sui_admin', 'action' => 'view_application'),
				'location' => array('backstage', 'sui_application', 'view_application')
			),
			array(
				'rule' => array('controller' => 'sui_applications', 'action' => 'admin_payment'),
				'location' => array('backstage', 'sui_application', 'admin_payment')
			),
			array(
				'rule' => array('controller' => 'sui_applications', 'action' => 'planilha_gd'),
				'location' => array('backstage', 'sui_application', 'planilha_gd')
			),
			array(
				'rule' => array('controller' => 'sui_applications', 'action' => 'planilha_onhb'),
				'location' => array('backstage', 'sui_application', 'planilha_onhb')
			),
			array(
				'rule' => array('controller' => 'sui_applications', 'action' => 'cancel'),
				'location' => array('backstage', 'sui_application', 'cancel')
			),
			array(
				'rule' => array('controller' => 'sui_applications', 'action' => 'mark_as_test'),
				'location' => array('backstage', 'sui_application', 'mark_as_test')
			),
			array(
				'rule' => array('controller' => 'sui_feedbacks', 'action' => 'edit'),
				'location' => array('backstage', 'sui_application', 'feedback')
			),
			array(
				'rule' => array('controller' => 'sui_subscriptions', 'action' => 'edit'),
				'location' => array('backstage', 'sui_subscription', 'edit')
			)
		)
	),
	
	// Backstage 
	
	array(
		'rule' => array('plugin' => 'jj_users'),
		'location' => array('backstage'),
		'subRules' => array(
			array(
				'rule' => array('controller' => 'user_users', 'action' => 'preferences'),
				'location' => array(null, 'preferences')
			),
			array(
				'rule' => array('controller' => 'user_users', 'action' => 'login'),
				'location' => array(null, 'login')
			)
		)
	),
	array(
		'rule' => array('plugin' => 'backstage'),
		'location' => array('backstage'),
		'subRules' => array(
			array(
				'rule' => array('controller' => 'back_contents', 'action' => 'edit'),
				'location' => array(null,'dashboard'),
				'subRules' => array(
					array(
						'rule' => array('pass' => array(0 => 'news')),
						'location' => array(null, 'news'),
					),
					array(
						'rule' => array('pass' => array(0 => 'events')),
						'location' => array(null, 'events'),
					),
					array(
						'rule' => array('pass' => array(0 => 'galleries')),
						'location' => array(null, 'galleries'),
					),
					array(
						'rule' => array('pass' => array(0 => 'documents')),
						'location' => array(null, 'documents'),
					),
					array(
						'rule' => array('pass' => array(0 => 'projects')),
						'location' => array(null, 'projects'),
					),
					array(
						'rule' => array('pass' => array(0 => 'sui_user')),
						'location' => array(null, 'sui_user'),
					),
					array(
						'rule' => array('pass' => array(0 => 'sui_institution')),
						'location' => array(null,'sui_institution'),
					),
					array(
						'rule' => array('pass' => array(0 => 'sui_subscription')),
						'location' => array(null,'sui_subscription'),
					),
					array(
						'rule' => array('pass' => array(0 => 'sui_application')),
						'location' => array(null,'sui_subscription'),
					),
					array(
						'rule' => array('pass' => array(0 => 'user_users')),
						'location' => array(null, 'user_administration', 'user_users', 'edit'),
					),
					array(
						'rule' => array('pass' => array(0 => 'user_profiles')),
						'location' => array(null, 'user_administration', 'user_profiles'),
					),
					array(
						'rule' => array('pass' => array(0 => 'user_permissions')),
						'location' => array(null, 'user_administration', 'user_permissions'),
					),
					array(
						'rule' => array('controller' => 'back_contents', 'action' => 'edit', 'pass' => array(0 => 'mojo_queue')),
						'location' => array(null, 'mojo_queue'),
					),
					array(
						'rule' => array('pass' => array(0 => 'la_poste')),
						'location' => array(null, 'la_poste', 'la_poste_edit'),
					)
				),
			),
			array(
				'rule' => array('controller' => 'back_contents', 'action' => 'index'),
				'location' => array(null, 'backstage'),
				'subRules' => array(	
					array(
						'rule' => array('pass' => array(0 => 'news')),
						'location' => array(null, 'news'),
					),
					array(
						'rule' => array('pass' => array(0 => 'events')),
						'location' => array(null, 'events'),
					),
					array(
						'rule' => array('pass' => array(0 => 'galleries')),
						'location' => array(null, 'galleries'),
					),
					array(
						'rule' => array('pass' => array(0 => 'documents')),
						'location' => array(null, 'documents'),
					),
					array(
						'rule' => array('pass' => array(0 => 'projects')),
						'location' => array(null, 'projects'),
					),
					array(
						'rule' => array('pass' => array(0 => 'user_users')),
						'location' => array(null, 'user_administration', 'user_users'),
					),
					array(
						'rule' => array('pass' => array(0 => 'user_profiles')),
						'location' => array(null, 'user_administration', 'user_profiles'),
					),
					array(
						'rule' => array('pass' => array(0 => 'user_permissions')),
						'location' => array(null, 'user_administration', 'user_permissions'),
					),
					array(
						'rule' => array('pass' => array(0 => 'sui_user')),
						'location' => array(null, 'sui_user'),
					),
					array(
						'rule' => array('pass' => array(0 => 'sui_institution')),
						'location' => array(null,'sui_institution'),
					),
					array(
						'rule' => array('pass' => array(0 => 'sui_subscription')),
						'location' => array(null,'sui_subscription'),
					),
					array(
						'rule' => array('pass' => array(0 => 'sui_application')),
						'location' => array(null,'sui_subscription'),
					),
					array(
						'rule' => array('pass' => array(0 => 'la_poste')),
						'location' => array(null,'la_poste'),
					),
					array(
						'rule' => array('pass' => array(0 => 'lp_copy')),
						'location' => array(null,'la_poste'),
					),
					array(
						'rule' => array('controller' => 'back_contents', 'action' => 'index', 'pass' => array(0 => 'mojo_queue')),
						'location' => array(null, 'mojo_queue'),
					),
				),
			),
			array(
				'rule' => array('controller' => 'back_contents', 'action' => 'set_publishing_status'),
				'location' => array(null,'set_publishing_status'),
			),
			array(
				'rule' => array('controller' => 'back_contents', 'action' => 'delete_item'),
				'location' => array(null,'backstage_delete'),
				'subRules' => array(				
					array(
						'rule' => array('controller' => 'back_contents', 'action' => 'delete_item', 'pass' => array(0 => 'user_users')),
						'location' => array(null, 'user_administration', 'user_users', 'delete'),
					),
				)
			),
		),
	),
	array(
		'rule' => array('plugin' => 'dashboard'),
		'location' => array('backstage'),
		'subRules' => array(
			array(
				'rule' => array('controller' => 'dash_dashboard', 'action' => 'index'),
				'location' => array(null,'dashboard'),
			),
			array(
				'rule' => array('controller' => 'dash_dashboard', 'action' => 'delete_item'),
				'location' => array(null,'dashboard_delete'),
			),
		),
	),
	array(
		'rule' => array('plugin' => 'corktile', 'controller' => 'cork_corktiles', 'action' => 'edit'),
		'location' => array('backstage','dashboard'),
	),
	array(
		'rule' => array('plugin' => 'burocrata', 'controller' => 'buro_burocrata', 'action' => 'save'),
		'location' => array('backstage','burocrata_save'),
	),
);

Configure::write('PageSections.sections', $sections);
Configure::write('PageSections.sectionMap', $sectionMap);

?>
