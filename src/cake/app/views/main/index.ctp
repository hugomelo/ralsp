<?php

echo $this->Bl->srow(array('class' => 'home'));
	echo $this->Bl->sboxContainer(array('class' => "header col-xs-12"), array());
		echo $this->Bl->sdiv(array('class' => 'header-data'), array());
			echo $this->Bl->h1(array(), array(), "Rede de Agroecologia<br>do Leste Paulista e Alta Mogiana");
			echo $this->Bl->p(array('class' => 'about'), array(), "A Rede Regional de Agroecologia Mantiqueira-Mogiana é formada por agricultores, técnicos e pesquisadores que têm como objetivo comum a busca pelo desenvolvimento e aprimoramento da agricultura de base ecológica.");
		echo $this->Bl->ediv();
	echo $this->Bl->eboxContainer();

	echo $this->Bl->sdiv(array('class' => 'projects col-xs-12'));
		echo $this->Bl->h4Dry("Nossos projetos");
		$projects = '';
		echo $this->Bl->sdiv(array('class' => 'project-desc')); {
			$first = true;
			foreach ($fact_sites as $site) {
				$klass = $first ? 'active' : "";
				$first = false;
				$site['KLASS'] = $klass;
				echo $this->Jodel->insertModule('SiteFactory.FactSite', array('mini_preview'), $site);
				$projects .= $this->Bl->anchor(array('class' => $klass), array(
						'url' => array('plugin' => 'site_factory', 'controller' => 'fact_sites', 'action' => 'index'),
						'space' => $site['FactSite']['mexc_space_id']
					), $site['FactSite']['name']);
			}
		} echo $this->Bl->ediv();
		echo $this->Bl->div(array('class' => 'project-select'), array(), $projects);
	echo $this->Bl->ediv();








echo $this->Bl->erow();

if (!empty($highlighted))
{
	echo $this->Bl->h2Dry('destaques');
	echo $this->Jodel->insertModule('MexcHighlights.MexcHighlightedContent', array('list', 'main_page'), $highlighted);
}






if (!empty($three_news))
{
	echo $this->Bl->sbox(array(),array('size' => array('M' => 9, 'g' => -1), 'type' => 'cloud'));
	
		echo $this->Bl->h2Dry('novidades');
		
		//echo $this->Jodel->insertModule('MexcNews.MexcNew', array('columns', 9), $three_news);
		echo $this->Bl->floatBreak();
		
		echo $this->Bl->br();
		echo $this->Bl->hr();
		
		if (!empty($seven_news))
		{
			foreach ($seven_news as $new)
				//echo $this->Jodel->insertModule('MexcNews.MexcNew', array('line', 9), $new);
			echo $this->Bl->hr();
		}
		echo $this->Bl->anchor(
			array('class' => 'goto_section'),
			array('url' => array('plugin' => 'mexc_news', 'controller' => 'mexc_news', 'action' => 'index')),
			'Novidades mais antigas'
		);
	
	echo $this->Bl->ebox();
}






if (!empty($fact_sites))
{
	echo $this->Bl->sbox(array('id' => 'fact_sites'), array('size' => array('M' => 3, 'g' => -1), 'type' => 'cloud'));
		echo $this->Bl->h2Dry('programas');
		
		//foreach ($fact_sites as $site)
			//echo $this->Jodel->insertModule('SiteFactory.FactSite', array('mini_preview'), $site);
		
		echo $this->Bl->sdiv(array('class' => 'links'));
			echo $this->Bl->anchor(
				array(),
				array(
					'url' => array('plugin' => 'site_factory', 'controller' => 'fact_sites', 'action' => 'all_sites'),
				),
				'ver todos'
			);
		echo $this->Bl->ediv();
		
	echo $this->Bl->ebox();
	
	$this->BuroOfficeBoy->addHtmlEmbScript("new Mexc.SitePreview('fact_sites');");
}






if (!empty($two_events))
{
	echo $this->Bl->sbox(array(),array('size' => array('M' => 6, 'g' => -1), 'type' => 'cloud'));
	
		echo $this->Bl->h2Dry('agenda');
		
		echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 6), 'type' => 'column_container'));
			foreach ($two_events as $event)
			{
				echo $this->Bl->sbox(array(), array('size' => array('M' => 3, 'g' => -1), 'type' => 'inner_column'));
				echo $this->Jodel->insertModule('MexcEvents.MexcEvent', array('column'), $event);
				echo $this->Bl->ebox();
			}
		echo $this->Bl->eboxContainer();
		echo $this->Bl->floatBreak();
		
		echo $this->Bl->br();
		echo $this->Bl->hr();
		
		if (!empty($seven_events))
		{
			foreach ($seven_events as $event)
				echo $this->Jodel->insertModule('MexcEvents.MexcEvent', array('line', 6), $event);
			echo $this->Bl->hr();
		}
		echo $this->Bl->anchor(
			array('class' => 'goto_section'),
			array('url' => array('plugin' => 'mexc_events', 'controller' => 'mexc_events', 'action' => 'index')),
			'Eventos mais antigos'
		);
	
	echo $this->Bl->ebox();
}






if (!empty($gallery))
{
	echo $this->Bl->sbox(array('id' => 'gallery_cloud'),array('size' => array('M' => 5, 'g' => -1), 'type' => 'cloud'));
		
		echo $this->Bl->h2Dry('fotos');
		
		echo $this->Bl->div(
			array('class' => 'updateable', 'id' => 'id'.$gallery['MexcGallery']['id']),
			array(),
			$this->Jodel->insertModule('MexcGalleries.MexcGallery', array('column'), $gallery)
		);
		
		echo $this->Bl->br();
		echo $this->Bl->anchor(
			array('class' => 'more_content'),
			array('url' => array()), 
			__d('mexc', 'Mostrar outra galeria', true)
		);
		echo '&ensp;';
		echo $this->Bl->img(array('src' => '/img/loading.gif'));
		
		echo $this->Bl->anchor(
			array('style' => 'float: right;'),
			array('url' => array('plugin' => 'mexc_galleries', 'controller' => 'mexc_galleries', 'action' => 'index')), 
			__d('mexc', 'Ver todas galerias', true)
		);
		
		
		$url = $this->Html->url(array('plugin' => 'mexc_galleries', 'controller' => 'mexc_galleries', 'action' => 'another_gallery'));
		$this->BuroOfficeBoy->addHtmlEmbScript("new Mexc.GalleryRoller('gallery_cloud', '$url');");
		
	echo $this->Bl->ebox();
}
echo "</div>";
