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

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 */
class AppController extends Controller
{

/**
 * Default helpers
 * 
 * @access public
 * @var array
 */
	var $helpers = array('Html', 'Form', 'Session', 'Time', 'Ajax', 'JjUsers.JjAuth');

/**
 * Default components
 * 
 * @access public
 * @var array
 */
	var $components = array(
		'Tradutore.TradLanguageSelector',
		'PageSections.SectSectionHandler',
		'JjUsers.JjAuth'
	);

/**
 * Holds an array with all MexcSpaces availables, indexed by MexcSpace.id
 * 
 * @var array
 * @access public
 */
	var $allSpaces;
	
/**
 * The MexcSpace.id from current FactSite, if any. Null, if not in an FactSite.
 * 
 * This data is also reacheable by $this->currentSite['FactSite']['mexc_space_id'].
 * 
 * @var string
 * @access public
 */
	var $currentSpace;
	
/**
 * Data from database for the current FactSite. Null, if not in an FactSite.
 * 
 * @var array
 * @access public
 */
	var $currentSite;

/**
 * startupProcess method, that is called by the Dispatcher
 * 
 * Needed to overwrite this method (without calling the parent one) to take
 * controll of the Components and controller initialization order.
 * Here, the FactSite sections are created and appended to PageSections config.
 * Because the SectionHandler component need sections completed on initializing 
 * and the Auth component calls the Controller::isAuthorized() method on 
 * initialization (that also uses the sections), is mandatory to create all 
 * sections data before calling $this->Component->initialize() (that is before
 * beforeFilter)
 * 
 * Hope that people undertand this.
 * 
 * @access public
 */
	function startupProcess()
	{
		App::import('Behavior', 'Status.Status');
		
		$this->_loadMexcSpaces();
		
		if (isset($this->params['space']))
		{
			if (!isset($this->allSpaces[$this->params['space']]))
			{
				if (Configure::read())
					trigger_error('FactoryError - Space \'' . $this->params['space'] . '\' not known.');
				$this->cakeError('error404');
			}
			
			$this->currentSpace = $this->params['space'];
			
			$this->loadModel('SiteFactory.FactSite');
			$this->FactSite->contain(array('FactSection'));
			$this->currentSite = $this->FactSite->findByMexcSpaceId($this->currentSpace);
			
			if (empty($this->currentSite))
			{
				if (Configure::read())
					trigger_error('FactoryError - Factory site for \'' . $this->params['space'] . '\' not found.');
				$this->cakeError('error404');
			}
			
			Configure::write('SiteFactory.currentSite', $this->currentSite);
			$this->_createSectionStructure();
		}
		
		$this->set('currentSite', $this->currentSite);
		$this->set('currentSpace', $this->currentSpace);
		
		$this->Component->initialize($this);
		$this->beforeFilter();
		$this->Component->triggerCallback('startup', $this);
	}

/**
 * Overwrites the default paginate method so the "limit" passed argument doesnt overwrite the self::paginate['ModelName']['limit']
 * 
 * @access public
 * @return array Same as Controller::paginate()
 */
	function paginate($object = null, $scope = array(), $whitelist = array())
	{
		if (is_string($object))
			$this->passedArgs['show'] = $this->passedArgs['limit'] = $this->paginate[$object]['limit'];
		$results = parent::paginate($object, $scope, $whitelist);
		
		return $results;
	}

/**
 * Some JodelJodel bindings
 * 
 * @access public
 */
	function beforeFilter()
	{
		parent::beforeFilter();		
		
		App::Import('Behavior', 'Status.Status');
		
		//starts all status with nothing active
		StatusBehavior::setGlobalActiveStatuses(array(
			'publishing_status' => array('active' => array(), 'overwrite' => true, 'mergeWithCurrentActiveStatuses' => false),
		));
		
		// in the applicationAppController or in each controller of a plugin (in beforeRender) is need to add the status, like this
		/*
			StatusBehavior::setGlobalActiveStatuses(array(
				'publishing_status' => array('active' => array('published'), 'overwrite' => true, 'mergeWithCurrentActiveStatuses' => false),
			));
		*/
		
		$standardUrl = $curModule = array();
		if ($this->params['plugin'])
		{
			$curModule = Configure::read('jj.modules.'.$this->params['plugin']);
			if (empty($curModule))
			{
				$module = split('_', $this->params['plugin']);
				if (isset($module[1]))
					$curModule = Configure::read('jj.modules.'.$module[1]);
				if (empty($curModule))
				{
					if (isset($module[1]))
						$curModule = Configure::read('jj.modules.'.Inflector::singularize($module[1]));
				}
			}
		}

		if (!empty($curModule))
		{
			$curModule += array('model' => '', 'viewUrl' => array());
			list($plugin, $model) = pluginSplit($curModule['model']);

			if (!is_array($curModule['viewUrl']))
				$this->jodelError('BackstageTypeBricklayerHelper::moduleView() - `viewUrl` configuration must be an array.');
			
			$plugin = Inflector::underscore($plugin);
			
			$standardUrl = $curModule['viewUrl'] + array(
				'plugin' => $plugin, 
				'controller' => Inflector::pluralize($plugin),
				'action' => 'view'
			);
		}
		
		if ($standardUrl && $this->params['action'] == $standardUrl['action'] && $this->params['controller'] == $standardUrl['controller'])
		{
			if ($this->JjAuth->can('view_drafts'))
			{
				//if the user have the permission view_drafts then the status are changed to published and draft
				StatusBehavior::setGlobalActiveStatuses(array(
					'publishing_status' => array('active' => array('published', 'draft'), 'overwrite' => true, 'mergeWithCurrentActiveStatuses' => true),
				));
				
			}
		}
		
	}
	
	function _loadMexcSpaces()
	{
		if (!empty($this->allSpaces))
			return;
		
		if ($this->loadModel('MexcSpace.MexcSpace'))
		{
			$this->MexcSpace->contain();
			$spaces_data = $this->MexcSpace->find('all');
			$spaces = array();
			foreach ($spaces_data as $space)
				$spaces[$space['MexcSpace']['id']] = $space;
				
			$this->allSpaces = $spaces;
			$this->set(compact('spaces'));
		}
	}
	
/**
 * 
 * 
 * @access 
 */
	function _createSectionStructure()
	{
		$mexc_space_id = $this->currentSpace;
		$sections = $this->currentSite['FactSection'];
		
		$sectionMap = array(
			'rule' => array('space' => $mexc_space_id),
			'location' => array('public_page', 'fact_sites', $mexc_space_id),
			'subRules' => array()
		);
		$subSections = array();
		
		// Front page (hardcoded)
		$subSections['home'] = array(
			'linkCaption' => __d('mexc', 'Início', true),
			'jj_module' => 'factory',
			'url' => array(
				'plugin' => 'site_factory', 'controller' => 'fact_sites',
				'action' => 'index', 'space' => $mexc_space_id
			)
		);
		$sectionMap['subRules'][] = array(
			'rule' => array('plugin' => 'site_factory', 'action' => 'index'),
			'location' => array(null,null,null,'home')
		);
		if (isset($sections))
		{
			foreach ($sections as $section)
			{
				$url = $rule = $location = array();
				$linkCaption = $section['name'];
				
				$config = Configure::read('jj.modules.'.$section['type']);
				if (empty($config))
					continue;

				$type = $section['type'];
				
				if ($type == 'sui_subscription')
				{
					$url['plugin'] = 'sui';
					$url['controller'] = 'sui_fact_subscriptions';
					$url['action'] = 'index';
				}
				else
				{
					list($plugin, $model) = pluginSplit(Inflector::underscore($config['model']));
					$url['plugin'] = $plugin;
					$url['controller'] = Inflector::pluralize($model);
					$url['action'] = 'index';
				}
				$rule = array('plugin' => $url['plugin'], 'controller' => $url['controller']);
				if (!empty($section['metadata']['address']))
				{
					$rule['pass'] = array($section['metadata']['address']);
					$url[] = $section['metadata']['address'];
					$type .= $section['metadata']['address'];
				}
				
				if (!empty($section['metadata']['sui_subscription_id']))
				{
					$rule['action'] = 'index';
					$rule['pass'] = array($section['id']);
					$url[] = $section['id'];
					$type .= $section['id'];
				}
				
				if (!empty($section['metadata']['mojo_id']))
				{
					$rule['action'] = 'index';
					$rule['pass'] = array($section['id']);
					$url[] = $section['id'];
					$type .= $section['id'];
				}
				
				$location = array(null,null,null,$type);
				$url['space'] = $mexc_space_id;
				
				$subSections[$type] = compact('url', 'linkCaption');
				$sectionMap['subRules'][] = compact('rule', 'location');
			}
		}
		App::import('Config', 'PageSections.sections');
		Configure::write('PageSections.sectionMap', array_merge(array($sectionMap), Configure::read('PageSections.sectionMap')));
		
		$sections = array();
		$sections[$mexc_space_id]['url'] = $subSections['home']['url'];
		$sections[$mexc_space_id]['subSections'] = &$subSections;
		$sections[$mexc_space_id]['linkCaption'] = $this->currentSite['FactSite']['name'];
		Configure::write('PageSections.sections.public_page.subSections.fact_sites.subSections', $sections);
	}
	
	function beforeRender()
	{
		parent::beforeRender();		
		$userData = $this->JjAuth->user();
		$this->set('userData',$userData['UserUser']);

		// compile scss
		if (Configure::read('debug') > 0) {
			if (!in_array($this->params['controller'], array('dash_dashboard', 'back_contents', 'buro_burocrata'))) {
				App::Import('Vendor', 'scssc', array('file' => 'scssphp/scss.inc.php'));
				App::Import('Vendor', 'SassCompiler', array('file' => 'php-sass' . DS . 'sass-compiler.php'));

				SassCompiler::run(WWW_ROOT."scss/", WWW_ROOT."css/");
			}
		}
	}
	
	protected function jodelError($message)
	{
		if (Configure::read() == 0)
			$this->cakeError('error500');
		
		$this->header("HTTP/1.0 500 Internal Server Error");
		$this->cakeError('error', array('code' => 500, 'name' => __('Jodel Jodel internal error', true), 'message' => $message));
	}
}

require_once('rede_app_controller.php');
