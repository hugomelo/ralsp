<?php
	$links = array(
		'twitter' => array('label' => 'Twitter', 'url' => '/'),
		'facebook' => array('label' => 'Facebook', 'url' => '/'),
		'orkut' => array('label' => 'Orkut', 'url' => '/'),
		'email' => array('label' => 'por e-mail', 'url' => '/')
	);

	$list = array();
	foreach ($links as $link)
		$list[] = $this->Bl->anchor(
			array(),
			array(
				'url' => $link['url']
			),
			$link['label']
		);
	
	//echo $this->Bl->p(array('class' => 'media_share'), array(), 'Compartilhar no ' . $this->Text->toList($list, 'ou'));
