<?php

class JjMailerTask extends Shell
{
/**
* Controller class
*
* @var Controller
*/
    var $Controller;

/**
* Startup for the EmailTask
*
*/
    function initialize()
    {
    	App::import('Core', array('Router', 'Controller'));
    	include CONFIGS . 'routes.php';
    	
        $this->Controller =& new Controller();
        $this->Controller->components = array('MexcMail');
        $this->Controller->uses = array();
        $this->Controller->constructClasses();
        $this->Controller->Component->initialize($this->Controller);
    }

/**
 * Sets the controller plugin that tells the View where to look for elements.
 * 
 * @access public
 * @param string $plugin Plugin name
 * @return void
 */
	function setPlugin($plugin)
	{
        $this->Controller->plugin = $plugin;
	}

/**
* Send an email useing the EmailComponent
*
* @param array $settings
* @return boolean
*/
    function send($to, $mail_space, $subject, $template)
    {
        return $this->Controller->MexcMail->send($to, $mail_space, $subject, $template);
    }

/**
* Used to set view vars to the Controller so
* that they will be available when the view render
* the template
*
* @param string $name
* @param mixed $data
*/
    function set($name, $data) {
        $this->Controller->set($name, $data);
    }
}

