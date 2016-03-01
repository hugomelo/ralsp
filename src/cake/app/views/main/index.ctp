<?php

echo $this->Bl->srow(array('class' => 'home'));
	echo $this->Bl->sboxContainer(array('class' => "header col-xs-12"), array());
		echo $this->Bl->sdiv(array('class' => 'header-data'), array());
			echo $this->Bl->h1(array(), array(), "Rede de Agroecologia<br>do Leste Paulista");
		echo $this->Bl->ediv(); // close header-data
	echo $this->Bl->eboxContainer(); // close header
echo $this->Bl->erow(); // close row

echo $this->Bl->ediv(); // close container || YES, it was needed for showing the about_project

echo $this->Bl->sdiv(array('class' => 'about_project'), array());
	echo $this->Bl->sdiv(array('class' => 'container'), array());
		echo $this->Bl->srow(array('class' => ''));
			echo $this->Bl->p(array('class' => 'about'), array(), "A Rede de Agroecologia do Leste Paulista é formada por agricultores, técnicos e pesquisadores que têm como objetivo comum a busca pelo desenvolvimento e aprimoramento da agricultura de base ecológica.");
		echo $this->Bl->erow(); // close row
	echo $this->Bl->ediv(); // close container
echo $this->Bl->ediv();

echo $this->Bl->sdiv(array('class' => 'container'), array());

echo $this->Bl->srow(array('class' => 'home'));
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

echo $this->Bl->srow(array('class' => 'home'));
	echo $this->Jodel->insertModule('UnifiedSearch.SblUnifiedSearch', array('view', 'index_listing'), $items);
echo $this->Bl->erow();
		
