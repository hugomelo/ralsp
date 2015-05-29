<?php
class MexcMailComponent extends Object
{
	var $components = array('Email');
	
	var $smtpOptions = array(
		'port'=>'587', 
		'timeout'=>'30',
		'host' => 'mail.preface.com.br',
		'username'=> 'inscricoes_olimpiada@preface.com.br',
		'password'=>'9o8j08qeq'
	);
	
	var $Controller;
	
	function initialize(&$controller, $settings=array())
	{
		$this->Controller =& $controller;
	}
	
	function send($to, $mail_space, $subject, $template)
	{
		$this->Email->reset();
		$this->Email->replyTo = 
		$this->Email->from = '"Sistema do Site do Museu"<nao-responda@mc.unicamp.br>';
		$this->Email->to = $to;
		$this->Email->return = $to;
		$this->Email->template = $template;
		$this->Email->sendAs = 'both';
		if (!empty($mail_space))
			$this->Email->subject = sprintf('[%s] %s', $mail_space, $subject);
		else
			$this->Email->subject = $subject;

		$this->Email->smtpOptions = $this->smtpOptions;
		$this->Email->delivery = 'smtp';
		
		if (isset($this->Controller->TypeLayoutSchemePicker))
			$this->Controller->TypeLayoutSchemePicker->pick('mexico');
		
		if (!$this->Email->send())
			return $this->Email->smtpError;
		
		return true;
	}
}
