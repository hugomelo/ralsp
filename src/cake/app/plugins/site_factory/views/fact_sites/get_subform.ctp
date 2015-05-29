<?php

/*
 * Copyright 2011-2015, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * source:  https://github.com/museudecienciasunicamp/site_factory.git Mexc Highlights public repository
 *
 */


$object = array(
	'error' => false,
	'content' => ''
);

$config = Configure::read('jj.modules.'.$this->data['section_type']);
if (!empty($config))
{
	$this->Buro->sform(array(), array('model' => 'SiteFactory.FactSection'));
	$object['content'] = $this->Jodel->insertModule($config['model'], array('factory', 'subform'));
	$this->Buro->eform();
}

echo $this->Js->object($object);
