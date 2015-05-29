<?php

echo $this->Bl->sboxContainer(array('id' => 'footer_about'), array('size' => array('M' => 7)));
	
	echo $this->Bl->sbox(array(), array('size' => array('M' => 6, 'g' => -1), 'type' => 'cloud'));
		
		echo $this->Bl->div(array('class' => 'bg'));
		
		echo $this->Cork->tile(array(),array(
			'key' => 'footer_about',
			'type' => 'cs_cork',
			'title' => __d('mexc', 'Sobre o site no rodapé', true),
			'editorsRecommendations' => __d('mexc', 'Um texto que aparecerá no rodapé do site todo.', true),
			'location' => array(),
			'options' => array(
				'type' => 'footer_about'
			)
		));
		echo $this->Bl->br();
		
		echo $this->Bl->sboxContainer(array('class' => 'menu'), array('size' => array('M' => 6), 'type' => 'column_container'));
			
			$urlbase = array('plugin' => 'mexc_about', 'controller' => 'mexc_about');
			$menu_about = array(
				'more' =>		array('label' => 'Saiba mais',		 'url' => $urlbase + array('action' => 'museum')),
				'staff' =>		array('label' => 'Equipe',			 'url' => $urlbase + array('action' => 'staff')),
				'contact' =>	array('label' => 'Contato',			 'url' => $urlbase + array('action' => 'museum', '#' => 'contact')),
				'local' =>		array('label' => 'Como chegar',		 'url' => $urlbase + array('action' => 'museum', '#' => 'local')),
				'press' =>		array('label' => 'Imprensa',		 'url' => $urlbase + array('action' => 'museum', '#' => 'press')),
				'site_map' =>	array('label' => 'Mapa do site',	 'url' => $urlbase + array('action' => 'site_map')),
				'about_site' =>	array('label' => 'Créditos do site', 'url' => $urlbase + array('action' => 'museum', '#' => 'about')),
			);

			echo $this->Bl->sbox(array(), array('size' => array('M' => 3, 'm' => -1), 'type' => 'inner_column'));
				foreach ($menu_about as $k=>$item)
					echo $this->Bl->anchor(array('class' => $k), array('url' => $item['url'], 'type' => 'vertical_menu'), $item['label']);
			echo $this->Bl->ebox();
			
		echo $this->Bl->eboxContainer();
		
	echo $this->Bl->ebox();

echo $this->Bl->eboxContainer();
