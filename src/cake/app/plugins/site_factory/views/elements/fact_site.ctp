<?php

/*
 * Copyright 2011-2015, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * source:  https://github.com/museudecienciasunicamp/site_factory.git Mexc Highlights public repository
 *
 */


switch ($type[0])
{
	case 'buro':
		switch ($type[1])
		{
			case 'form':
				echo $this->element('fact_site_form', array('plugin' => 'site_factory'));
			break;
		}
	break;
	
	case 'preview':
		echo $this->Bl->sdiv(array('class' => 'fact_site_preview'));
			
			if (!empty($data['FactSite']['img_id']))
				echo $this->Bl->anchor(
					array('class' => 'img_link'),
					array('url' => array('action' => 'index', 'space' => $data['FactSite']['mexc_space_id'])), 
					$this->Bl->img(array(), array('id' => $data['FactSite']['img_id'], 'version' => 'preview'))
				);
			
			echo $this->Bl->anchor(
				array('class' => 'enter'),
				array('url' => array('action' => 'index', 'space' => $data['FactSite']['mexc_space_id'])), 
				__d('mexc', 'Entrar', true)
			);
			echo $this->Bl->floatBreak();
			echo $this->Bl->br();
			
			if (!empty($data['FactSite']['picture_id']))
				echo $this->Bl->anchor(
					array('class' => 'img_link'),
					array('url' => array('action' => 'index', 'space' => $data['FactSite']['mexc_space_id'])), 
					$this->Bl->img(array(), array('id' => $data['FactSite']['picture_id'], 'version' => 'preview'))
				);
			
			echo $this->Bl->paraDry(explode("\n", $data['FactSite']['description']));
			echo $this->Bl->br();
			
			foreach ($data['FactSection'] as $section)
			{
				echo $this->Bl->anchor(
					array(),
					array('section' => $section, 'space' => $data['FactSite']['mexc_space_id']), 
					$section['name']
				);
				echo '&ensp;';
			}
			
		echo $this->Bl->ediv();
	break;
	
	case 'mini_preview':
		echo $this->Bl->sdiv(array('class' => 'fact_site_minipreview ' . $data['FactSite']['mexc_space_id']));
			
			
			$content = '';
			$content .= $this->Bl->sdiv(array('class' => 'img_header'));
				if (!empty($data['FactSite']['picture_id']))
					$content .= $this->Bl->div(
						array('class' => 'image'),
						array(),
						$this->Bl->anchor(array(), array(
								'url' => array('plugin' => 'site_factory', 'controller' => 'fact_sites', 'action' => 'index'),
								'space' => $data['FactSite']['mexc_space_id']
							),
							$this->Bl->img(array(), array('id' => $data['FactSite']['picture_id'], 'version' => 'cropped'))
						)
					);
			$content .= $this->Bl->ediv();
			
			if (!empty($data['FactSite']['img2_id']))
				$anchorLabel = $this->Bl->img(array('alt' => $data['FactSite']['name']), array('id' => $data['FactSite']['img2_id'], 'version' => ''));
			else
				$anchorLabel = $this->Bl->spanDry($data['FactSite']['name']);
			
			$content .= $this->Bl->div(
				array('class' => 'logo'),
				array(),
				$this->Bl->anchor(array(), array(
						'url' => array('plugin' => 'site_factory', 'controller' => 'fact_sites', 'action' => 'index'),
						'space' => $data['FactSite']['mexc_space_id']
					),
					$anchorLabel
				)
			);
			
			echo $content;
			/*
			echo $this->Bl->anchor(array(), array(
					'url' => array('plugin' => 'site_factory', 'controller' => 'fact_sites', 'action' => 'index'),
					'space' => $data['FactSite']['mexc_space_id']
				),
				$anchorLabel
			);
			*/
			
			echo $this->Bl->sdiv(array('class' => 'fact_site_description'));
				echo $this->Bl->paraDry(explode("\n", $data['FactSite']['mini_description']));
			echo $this->Bl->ediv();	
			
		echo $this->Bl->ediv();
	break;
}
