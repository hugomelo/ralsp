<?php

//echo $this->Bl->menu(array(), array('menuLevel' => 3));

echo $bl->sdiv(array('id' => 'about'));

    echo $bl->sdiv(array('class' => 'title')); 
        echo $bl->h2Dry(__d('mexc', 'A Rede de Agroecologia do Leste Paulista e Alta Mogiana', true));
    echo $bl->ediv();
    
	echo $this->Bl->srow(array('class' => 'pages rede'));
        echo $this->Cork->tile(array(), array(
            'key' => 'about_rede',
			'type' => 'cs_cork',
            'title' => __d('mexc', 'Sobre a rede', true),
            'editorsRecommendations' => __d('mexc', 'Um pequeno texto falando sobre a rede.', true),
			'location' => array('public_page', 'about', 'rede'),
			'options' => array(
				'type' => 'about_rede'
			)
        ));

	echo $this->Bl->erow();
echo $this->Bl->ediv();


