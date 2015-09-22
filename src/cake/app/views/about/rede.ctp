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
            'title' => __d('mexc', 'Página sobre - texto inicial', true),
            'editorsRecommendations' => __d('mexc', 'Um pequeno texto falando sobre a rede.', true),
			'options' => array(
				'cs_type' => 'about_section_title',
				'type' => 'about_section_title'
			)
        ));

        echo $this->Cork->tile(array(),array(
            'key' => 'about_rede_header_image',
            'type' => 'cs_cork',
            'title' => __d('mexc', 'Imagem ilustrativa da rede', true),
            'editorsRecommendations' => __d('mexc', 'Uma imagem principal na página de sobre.', true),
            'options' => array(
                'cs_type' => 'about_images',
                'type' => 'about_ilustration_image'
            )
        ));
	echo $this->Bl->erow();
echo $this->Bl->ediv();


