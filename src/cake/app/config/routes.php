<?php
/**
 * Routes Configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Sets the known params
 */
	Router::connectNamed(array('tag', 'search', 'page'), array('default' => true));

/**
 * Connects the root address and /sobre to main_controller
 */
	Router::connect('/', array('controller' => 'main', 'action' => 'index'));

/**
 * Connects the /sobre (about) section
 */
	Router::connect('/sobre/index', array('plugin' => 'mexc_about', 'controller' => 'mexc_about', 'action' => 'museum'));
	Router::connect('/sobre/equipe', array('plugin' => 'mexc_about', 'controller' => 'mexc_about', 'action' => 'staff'));
	Router::connect('/sobre/historia', array('plugin' => 'mexc_about', 'controller' => 'mexc_about', 'action' => 'history'));
#	Router::connect('/sobre/mapa_do_site', array('plugin' => 'mexc_about', 'controller' => 'mexc_about', 'action' => 'site_map'));


/**
 * Connects /olimpiada to the old (but intregrate) schema of olimpiada 
 */
	Router::connect('/novidades',	array('plugin' => 'mexc_news', 'controller' => 'mexc_news'));
	
	

/**
 * Connects to /paineladmin (old schema admin of museu, workin for gd and olimpiada)
 */
	Router::connect('/paineladmin', array('plugin' => 'paineladmin', 'controller' => 'usuarios', 'action' => 'admin_index'));
	Router::connect('/paineladmin/:controller', array('plugin' => 'paineladmin', 'controller' => 'usuarios', 'action' => 'admin_index'));
	Router::connect('/paineladmin/:edicao/olimpiada/:controller/:action/*', 
						array('plugin' => 'olimpiada_quatro', 'prefix' => 'paineladmin', 'paineladmin' => true),
						array('edicao' => '[0-9]+')
						);
	Router::connect('/paineladmin/:controller/:action/*', array('plugin' => 'paineladmin', 'controller' => 'usuarios', 'action' => 'admin_index'));
 

/**
 * Connects the /programas spacial URLS
 */
	Router::connect('/programas/index', array('plugin' => 'site_factory', 'controller' => 'fact_sites', 'action' => 'all_sites'));
	Router::connect('/programas/:space/novidades/:action/*',	array('plugin' => 'mexc_news',		'controller' => 'mexc_news'));
	Router::connect('/programas/:space/inscricoes/:action/*',	array('plugin' => 'sui',			'controller' => 'sui_fact_subscriptions'));
	Router::connect('/programas/:space/duvidas/:action/*',		array('plugin' => 'mojo',			'controller' => 'mojos'));
	Router::connect('/programas/:space/eventos/:action/*',		array('plugin' => 'mexc_events',	'controller' => 'mexc_events'));
	Router::connect('/programas/:space/documentos/:action/*',	array('plugin' => 'mexc_documents', 'controller' => 'mexc_documents'));
	Router::connect('/programas/:space/fotos/:action/*',		array('plugin' => 'mexc_galleries', 'controller' => 'mexc_galleries'));
	Router::connect('/programas/:space/palestras/:action/*',	array('plugin' => 'mexc_lectures',	'controller' => 'mexc_lectures'));
	Router::connect('/programas/:space/palestrantes/:action/*',	array('plugin' => 'mexc_lectures',	'controller' => 'mexc_speakers'));
	Router::connect('/programas/:space/contato/:action/*',		array('plugin' => 'mexc_contacts',	'controller' => 'mexc_contacts'));
	Router::connect('/programas/:space/acervo/:action/*',		array('plugin' => 'mexc_digital_collections',
																									'controller' => 'mexc_digital_collections'));
	Router::connect('/programas/:space/acervo/:action/',		array('plugin' => 'mexc_digital_collections',
																									'controller' => 'mexc_digital_collections'));
	Router::connect('/programas/:space/index', array('plugin' => 'site_factory', 'controller' => 'fact_sites', 'action' => 'index'));
	Router::connect('/programas/:space', array('plugin' => 'site_factory', 'controller' => 'fact_sites', 'action' => 'index'));
	Router::connect('/programas/:space/*', array('plugin' => 'mexc_static_pages', 'controller' => 'mexc_static_pages'), array('space' => '[a-z0-9_]+'));

/**
 * Connects the main content
 */
	Router::connect('/novidades/:action/*', array('plugin' => 'mexc_news', 'controller' => 'mexc_news'));
	Router::connect('/eventos/:action/*', array('plugin' => 'mexc_events', 'controller' => 'mexc_events'));
	Router::connect('/documentos/:action/*', array('plugin' => 'mexc_documents', 'controller' => 'mexc_documents'));
	Router::connect('/fotos/:action/*', array('plugin' => 'mexc_galleries', 'controller' => 'mexc_galleries'));
	
/**
 * Connecting the two responsible plugins for admin actions
 */
	Router::connect('/admin/:language', array('plugin' => 'dashboard', 'controller' => 'dash_dashboard', 'action' => 'index'), array('language' => '[a-t]{3}'));
	Router::connect('/admin/:language/cork/:action/*', array('plugin' => 'corktile', 'controller' => 'cork_corktiles'), array('language' => '[a-t]{3}'));
	Router::connect('/admin/:language/user/:action/*', array('plugin' => 'jj_users', 'controller' => 'user_users', 'action' => 'logout'), array('language' => '[a-t]{3}'));
	Router::connect('/admin/:language/:action/*', array('plugin' => 'backstage', 'controller' => 'back_contents'), array('language' => '[a-t]{3}'));
	
	Router::connect('/admin', array('plugin' => 'dashboard', 'controller' => 'dash_dashboard', 'action' => 'index'));
	Router::connect('/admin/cork/:action/*', array('plugin' => 'corktile', 'controller' => 'cork_corktiles'));
	Router::connect('/admin/user/:action/*', array('plugin' => 'jj_users', 'controller' => 'user_users', 'action' => 'logout'));
	Router::connect('/admin/:action/*', array('plugin' => 'backstage', 'controller' => 'back_contents'));


/**
 * Connecting '/dl' for forcing download of upload files and '/vw' for just viewing
 */
	Router::connect('/dl/*', array('plugin' => 'jj_media', 'controller' => 'jj_media', 'action' => 'index', '1'));
	Router::connect('/vw/*', array('plugin' => 'jj_media', 'controller' => 'jj_media', 'action' => 'index', '0'));


/**
 * Here, we are connecting '/css/sheet-layout_scheme.css' to a action called
 * 'sheet' in the 'estilos' controller. This allows us to create dynamic CSS,
 * according to the layout framework, called now "Estilista".
 *
 * @todo change plugin name
 * @todo check wether reverse routing will work in this case, it may be the case to change
 *	  routing in order to address this issue.
 * 
 */
	//New CSS rule, for the site factory
	Router::connect('/css/:scheme-:subscheme-:action.css/*',
		array('plugin' => 'typographer', 'controller' => 'type_stylesheet'),
		array(
			'pass' => array('scheme','subscheme'),
			'scheme' => '[a-z0-9_]+',
			'subscheme' => '[a-z0-9_]+'
		)
	);
	
	Router::connect('/css/:scheme-:action.css/*',
		array('plugin' => 'typographer', 'controller' => 'type_stylesheet'),
		array(
			'pass' => array('scheme'),
			'scheme' => '[a-z0-9_]+',
		)
	);

	
	
	Router::connect('/:language/:plugin/:controller/:action/*',
		array(),
		array('language' => '[a-t]{3}')
	);

	Router::connect('/:language/:controller/:action/*',
		array(),
		array('language' => '[a-t]{3}')
	);
	


/**
 * A active router (using redirect)
 * 
 */
	
if (isset($_SERVER['REQUEST_URI']))
{
	$redirect = false;
	
	if (preg_match('/^\/programas\/gd_([0-9]+)\/(\w+)\/(\w+)\/([0-9]+)/', $_SERVER['REQUEST_URI'], $match))
	{
		$url = array('plugin' => 'grandedesafio', 'controller' => 'inicio', 'edicao' => $match[1]);
		switch ($match[2])
		{
			case 'novidades':
				$url['controller'] = 'novidades';
				$url['action'] = 'artigo';
				$url[] = $match[4];
			break;
		
			case 'fotos':
				$url['controller'] = 'fotos';
				$url['action'] = 'ver_galeria';
				$url[] = $match[4];
			break;
		}
		$redirect = Router::url($url);
	}

	if (preg_match('/^\/programas\/olimpiada_([0-9]+)\/(\w+)\/(\w+)\/([0-9]+)/', $_SERVER['REQUEST_URI'], $match))
	{
		$url = array('plugin' => 'olimpiada', 'controller' => 'inicio', 'edicao' => $match[1]);
		if ($match[1] == 1)
			$url['plugin'] = 'olimpiada_velha';
	
		switch ($match[2])
		{
			case 'novidades':
				$url['controller'] = 'blog';
				$url['action'] = 'novidade';
				$url['#'] = $match[4];
			break;
		}
		$redirect = Router::url($url);
	}
	
	if (!$redirect && preg_match('/^\/programas\/olimpiada/', $_SERVER['REQUEST_URI'], $match))
	{
		$redirect = '/olimpiada';
	}

	if (!$redirect && preg_match('/^\/programas\/gd/', $_SERVER['REQUEST_URI'], $match))
	{
		$redirect = '/grandedesafio';
	}
	
	if ($redirect)
	{
		header("Location: $redirect");
		exit;
	}
}

/**
 * Define the FULL_BASE_URL constant if missing, with the production site
 * 
 */
if (!defined('FULL_BASE_URL'))
{
	define('FULL_BASE_URL', 'http://www.mc.unicamp.br');
}

