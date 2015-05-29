<?php

/*
 * Copyright 2011-2015, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * source:  https://github.com/museudecienciasunicamp/site_factory.git Mexc Highlights public repository
 *
 */

echo $this->Bl->br();

foreach ($sites as $n => $site)
{
	$odd = ($n+1)%2;
	
	if ($odd)
		echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 7)));		
		echo $this->Bl->sbox(array(), array('size' => array('M' => 5, 'g' => -1), 'type' => 'cloud'));
			echo $this->Jodel->insertModule('SiteFactory.FactSite', array('preview'), $site);
		echo $this->Bl->ebox();
		
	if ($odd)
		echo $this->Bl->eboxContainer();

}