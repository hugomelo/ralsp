<?php

echo $this->Bl->sboxContainer(array('id' => 'footer_contact'), array('size' => array('M' => 4)));
	
	echo $this->Bl->sbox(array(), array('size' => array('M' => 4, 'g' => -1), 'type' => 'cloud'));
		echo $this->Bl->div(array('class' => 'bg'));
		// An image corktile
		
		echo $this->Bl->h5Dry('Endereço');
		echo $this->Cork->tile(array(),array(
			'key' => 'public_footer_address',
			'type' => 'text_cork',
			'title' => __d('mexc', 'Endereço do site no rodapé', true),
			'editorsRecommendations' => __d('mexc', 'Breve endereço no rodapé', true),
			'location' => array('public_page', 'museum'),
			'options' => array(
				'type' => 'only_text'
			)
		));
		
		echo $this->Bl->sboxContainer(array('class' => 'contact'), array('size' => array('M' => 3, 'g' => -2)));
			echo $this->Bl->h5Dry('Formas de contato');
			echo $this->Cork->tile(array(),array(
				'key' => 'public_footer_contact',
				'type' => 'text_cork',
				'title' => __d('mexc', 'Formas de contato no rodapé', true),
				'editorsRecommendations' => __d('mexc', 'Breve descrição de formas de contato no rodapé', true),
				'location' => array('public_page', 'museum'),
				'options' => array(
					'type' => 'only_text'
				)
			));
		echo $this->Bl->eboxContainer();
		
		echo $this->Bl->sboxContainer(array('class' => 'logos'), array('size' => array('M' => 4, 'g' => -1)));
			echo $this->Bl->h5Dry('Participamos');
			echo $this->Cork->tile(array(),array(
				'key' => 'logos_where_we_are',
				'type' => 'cs_cork',
				'title' => __d('mexc', 'Logos da área "participamos"', true),
				'editorsRecommendations' => __d('mexc', 'Esses dados serão listados na área de logos da área "participamos". É importante que seja adicionado um título como "Participamos" ou "Parceiros".', true),
				'location' => array('public_page'),
				'options' => array(
					'cs_type' => 'about_just_logos',
				)
			));
		echo $this->Bl->eboxContainer();
		
		echo $this->Bl->sboxContainer(array('class' => 'logos'), array('size' => array('M' => 4, 'g' => -1)));
			echo $this->Bl->h5Dry('Apoio');
			echo $this->Cork->tile(array(),array(
				'key' => 'logos_supporters',
				'type' => 'cs_cork',
				'title' => __d('mexc', 'Logos da área "apoio"', true),
				'editorsRecommendations' => __d('mexc', 'Esses dados serão listados na área de logos da área "apoio". É importante que seja adicionado um título como "Apoio" ou "Apoiadores".', true),
				'location' => array('public_page'),
				'options' => array(
					'cs_type' => 'about_just_logos',
				)
			));
		echo $this->Bl->eboxContainer();
		
	echo $this->Bl->ebox();

echo $this->Bl->eboxContainer();
