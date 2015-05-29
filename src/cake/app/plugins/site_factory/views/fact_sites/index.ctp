<?php

/*
 * Copyright 2011-2015, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * source:  https://github.com/museudecienciasunicamp/site_factory.git Mexc Highlights public repository
 *
 */


echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 8)));
	
	if (!empty($digitalCollections))
	{

		echo $this->Bl->sbox(array(), array('size' => array('M' => 8, 'g' => -1), 'type' => 'cloud'));
			echo $this->Bl->h2Dry(__d('mexc', 'Acervo digital', true));
			echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 8), 'type' => 'column_container'));
				foreach ($digitalCollections as $index => $digco)
				{
					if (!empty($digco['MexcDigitalCollection']))
					{
					echo $this->Bl->sbox(null,array('size' => array('M' => 4, 'g' => -1,), 'type' => 'inner_column'));
							echo $this->Jodel->insertModule('MexcDigitalCollections.MexcDigitalCollection', array('digco_results'), $digco);
						echo $this->Bl->ebox();
					}
					if ($index % 2 == 1)
						echo $this->Bl->floatBreak();

				}
			echo $this->Bl->eboxContainer();
			echo $this->Bl->floatBreak();
			echo $this->Bl->verticalSpacer();
			echo $this->Bl->anchor(null, array('url' => array('plugin' => 'mexc_digital_collections',
				'controller' => 'mexc_digital_collections', 'action' => 'index',
				'space' => $currentSpace)),"Procure por mais documentos na base do acervo");
		echo $this->Bl->ebox();
		echo $this->Bl->hr();
	}

	if (!empty($highlighted))
	{
		echo $this->Bl->h2Dry(__d('mexc', 'destaques', true));
		echo $this->Jodel->insertModule('MexcHighlights.MexcHighlightedContent', array('list', 'site_factory'), $highlighted);
		
		echo $this->Bl->hr();
	}


	if (!empty($one_new))
	{
		echo $this->Bl->sbox(array(),array('size' => array('M' => 4, 'g' => -1), 'type' => 'cloud'));
		
			echo $this->Bl->h2Dry($new_title);
			echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 4), 'type' => 'column_container'));
				
				echo $this->Bl->sbox(array(), array('size' => array('M' => 4, 'g' => -1), 'type' => 'inner_column'));
					echo $this->Jodel->insertModule('MexcNews.MexcNew', array('column', 'fact_site'), $one_new);
					echo $this->Bl->br();
					echo $this->Bl->hr();
					
					if (!empty($news))
					{
						foreach ($news as $new)
							echo $this->Jodel->insertModule('MexcNews.MexcNew', array('line', 4), $new);
						echo $this->Bl->br();
						echo $this->Bl->hr();
					}
				
					echo $this->Bl->anchor(
						array('class' => 'goto_section'),
						array(
							'url' => array('plugin' => 'mexc_news', 'controller' => 'mexc_news', 'action' => 'index'),
							'space' => $currentSpace
						),
						'Novidades mais antigas'
					);
			
				echo $this->Bl->ebox();
			echo $this->Bl->eboxContainer();
		echo $this->Bl->ebox();
	}

	if (!empty($one_event))
	{
		echo $this->Bl->sbox(array(),array('size' => array('M' => 4, 'g' => -1), 'type' => 'cloud'));
			echo $this->Bl->h2Dry($event_title);
			echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 4), 'type' => 'column_container'));			
				
				echo $this->Bl->sbox(array(), array('size' => array('M' => 4, 'g' => -1), 'type' => 'inner_column'));
					echo $this->Jodel->insertModule('MexcEvents.MexcEvent', array('column', 'fact_site'), $one_event);
					echo $this->Bl->br();
					echo $this->Bl->hr();

					if (!empty($events))
					{
						foreach ($events as $event)
							echo $this->Jodel->insertModule('MexcEvents.MexcEvent', array('line', 4), $event);
						echo $this->Bl->br();
						echo $this->Bl->hr();
					}
				
					echo $this->Bl->anchor(
						array('class' => 'goto_section'),
						array(
							'url' => array('plugin' => 'mexc_events', 'controller' => 'mexc_events', 'action' => 'index'),
							'space' => $currentSpace
						),
						'Eventos mais antigos'
					);
				echo $this->Bl->ebox();
			
			echo $this->Bl->eboxContainer();
		echo $this->Bl->ebox();
	}
	
	if (!empty($one_lecture))
	{
		echo $this->Bl->sbox(array(),array('size' => array('M' => 4, 'g' => -1), 'type' => 'cloud'));
			echo $this->Bl->h2Dry($lecture_title);
			echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 4), 'type' => 'column_container'));			
				
				echo $this->Bl->sbox(array(), array('size' => array('M' => 4, 'g' => -1), 'type' => 'inner_column'));
					echo $this->Jodel->insertModule('MexcLectures.MexcLecture', array('column'), $one_lecture);
					echo $this->Bl->br();
					echo $this->Bl->hr();

					if (!empty($lectures))
					{
						foreach ($lectures as $lecture)
							echo $this->Jodel->insertModule('MexcLectures.MexcLecture', array('line', 4), $lecture);
						echo $this->Bl->br();
						echo $this->Bl->hr();
					}
				
					echo $this->Bl->anchor(
						array('class' => 'goto_section'),
						array(
							'url' => array('plugin' => 'mexc_lectures', 'controller' => 'mexc_lectures', 'action' => 'index'),
							'space' => $currentSpace
						),
						'Mais palestras'
					);
				echo $this->Bl->ebox();
			
			echo $this->Bl->eboxContainer();
		echo $this->Bl->ebox();
	}

echo $this->Bl->eboxContainer();

// ContentStream about
echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 4)));
	echo $this->Bl->sbox(array(),array('size' => array('M' => 4, 'g' => -1), 'type' => 'cloud'));
		echo $this->Jodel->insertModule('ContentStream.CsContentStream', array('full', 'fact_site'), $site['FactSite']['about_content_stream_id']);
	echo $this->Bl->ebox();
echo $this->Bl->eboxContainer();


echo $this->Bl->hr(array('class' => 'double'));

if (!empty($documents) || !empty($gallery))
{
	echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 12)));
		if (!empty($gallery))
		{
			echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 7)));
			echo $this->Bl->sbox(array('id' => 'fact_gallery'),array('size' => array('M' => 6, 'g' => -1), 'type' => 'cloud'));
				
				echo $this->Bl->h2Dry($gallery_title);
				
				echo $this->Jodel->insertModule('MexcGalleries.MexcGallery', array('column', 'fact_site'), $gallery);
				
				echo $this->Bl->br();
				echo $this->Bl->anchor(array(), array('url' => array()), 'Mostrar outra galeria');
				echo $this->Bl->anchor(
					array('style' => 'float: right;'),
					array('url' => array('plugin' => 'mexc_galleries', 'controller' => 'mexc_galleries', 'action' => 'index')), 
					'Ver todas galerias'
				);
				
			echo $this->Bl->ebox();
			echo $this->Bl->eboxContainer();
		}
		if (!empty($documents))
		{
			echo $this->Bl->sbox(array(),array('size' => array('M' => 5, 'g' => -1), 'type' => 'cloud'));
				
				echo $this->Bl->h2Dry($document_title);
				foreach ($documents as $document)
					echo $this->Jodel->insertModule('MexcDocuments.MexcDocument', array('column_fact_site'), $document);
				
			echo $this->Bl->ebox();
		}
	echo $this->Bl->eboxContainer();
	echo $this->Bl->hr(array('class' => 'double'));
}

echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 12)));
	echo $this->Bl->sboxContainer(array('class' => 'logos'), array('size' => array('M' => 6)));
		echo $this->Bl->sbox(array(), array('size' => array('M' => 6, 'g' => -1), 'type' => 'cloud'));
			echo $this->Cork->tile(array(),array(
				'key' => 'logos_program_' . $site['FactSite']['id'],
				'type' => 'cs_cork',
				'title' => __d('mexc', 'Logos de parceiros/apoiadores para ' . $site['FactSite']['name'], true),
				'editorsRecommendations' => __d('mexc', 'Esses dados serão listados na área de logos da área "apoio". É importante que seja adicionado um título como "Apoio" ou "Apoiadores" antes de cada grupo de logos.', true),
				'options' => array(
					'cs_type' => 'about_logos',
				)
			));
		echo $this->Bl->ebox();
		echo $bl->floatBreak();
	echo $this->Bl->eboxContainer();
	
	echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 3)));
		echo $this->Bl->sbox(array(), array('size' => array('M' => 3, 'g' => -1), 'type' => 'cloud'));
			echo $this->Bl->h5Dry(__d('mexc', 'Conheça o museu', true));
			echo $this->Bl->hr();
			echo $this->Bl->anchor(array(), array('url' => array('controller' => 'main', 'action' => 'index')), __d('mexc', 'Página do Museu', true));
			echo $this->Bl->br();
			echo $this->Bl->anchor(array(), array('url' => array('plugin' => 'mexc_about', 'controller' => 'mexc_about', 'action' => 'museum')), __d('mexc', 'Sobre o Museu', true));
			
			echo $this->Bl->br();
			echo $this->Bl->br();
			
			foreach (Configure::read('Mexc.SocialMedias') as $k=>$item)
				echo $this->Bl->anchor(array(), array('url' => $item['url']), sprintf(__d('mexc', 'O museu no %s', true), $item['label'])), $this->Bl->br();
		echo $this->Bl->ebox();
	echo $this->Bl->eboxContainer();
	
	if (!empty($twitter_results))
	{
		echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 3)));
			echo $this->Bl->sbox(array(), array('size' => array('M' => 3, 'g' => -1), 'type' => 'cloud'));
				echo $this->Bl->h5Dry(sprintf(__d('mexc', '%s no twitter', true), $site['FactSite']['name']));
				echo $this->Bl->hr();
				echo $this->Bl->pDry(__d('mexc', 'Veja o que estão dizendo no Twitter:'));
				foreach ($twitter_results as $twitter)
					echo $this->Bl->spanDry(
						$this->Bl->anchor(array('href' => 'http://twitter.com/' . $twitter['from_user']), array(), $twitter['from_user'])
						. '&ensp;'
						. $twitter['text']
					), $this->Bl->br(), $this->Bl->br();
			echo $this->Bl->ebox();
		echo $this->Bl->eboxContainer();
	}
echo $this->Bl->eboxContainer();
