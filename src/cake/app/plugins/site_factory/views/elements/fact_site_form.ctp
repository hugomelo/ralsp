<?php

/*
 * Copyright 2011-2015, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * source:  https://github.com/museudecienciasunicamp/site_factory.git Mexc Highlights public repository
 *
 */


echo $this->Html->scriptBlock('window.canShowPopup = true');

echo $this->Buro->sform(array(), array(
		'model' => $fullModelName,
		'callbacks' => array(
			'onStart' => array('lockForm', 'js' => 'form.setLoading()'),
			'onComplete' => array('unlockForm', 'js' => 'form.unsetLoading(); window.canShowPopup = true;'),
			'onReject' => array('js' => '$("content").scrollTo(); showPopup("error");', 'contentUpdate' => 'replace'),
			'onSave' => array('js' => 'if (window.canShowPopup) showPopup("notice");', 'contentUpdate' => 'replace'),
		)
	));
		echo $this->Buro->input(array(), array('fieldName' => 'id', 'type' => 'hidden'));
		
		echo $this->Buro->sinput(array(), array('type' => 'super_field', 'label' => __d('fact_site', 'form - general configuration superfield label', true)));

			/** Removed as of this version this image is not used anywhere
			echo $this->Buro->input(
				array(),
				array(
					'type' => 'image',
					'fieldName' => 'img_id2',
					'label' => __d('fact_site', 'form - img_id2 label', true),
					'instructions' => __d('fact_site', 'form - img_id2 instructions', true),
					'options' => array(
						'version' => 'preview'
					)
				)
			);
			**/
			
			echo $this->Buro->input(
				array(),
				array(
					'type' => 'text',
					'fieldName' => 'name',
					'label' => __d('fact_site', 'form - name label', true),
					'instructions' => __d('fact_site', 'form - name instructions', true)
				)
			);
			
			echo $this->Buro->input(
				array(),
				array(
					'type' => 'textarea',
					'fieldName' => 'description',
					'label' => __d('fact_site', 'form - description label', true),
					'instructions' => __d('fact_site', 'form - description instructions', true)
				)
			);
			
			echo $this->Buro->input(
				array(),
				array(
					'type' => 'textarea',
					'fieldName' => 'mini_description',
					'label' => __d('fact_site', 'form - mini_description label', true),
					'instructions' => __d('fact_site', 'form - mini_description instructions', true)
				)
			);
			
		echo $this->Buro->einput();
		
		
		echo $this->Buro->input(
			array(),
			array(
				'type' => 'content_stream',
				'label' => __d('fact_site', 'form - about_content_stream_id label', true),
				'instructions' => __d('fact_site', 'form - about_content_stream_id instructions', true),
				'options' => array(
					'foreignKey' => 'about_content_stream_id'
				)
			)
		);
		
		
		echo $this->Buro->input(
			array(),
			array(
				'type' => 'relational',
				'label' => __d('fact_site', 'form - sections (relational) label', true),
				'instructions' => __d('fact_site', 'form - sections (relational) instructions', true),
				'options' => array(
					'type' => 'many_children',
					'model' => 'SiteFactory.FactSection'
				)
			)
		);
		
		echo $this->Buro->sinput(array(), array(
			'type' => 'super_field', 
			'label' => __d('fact_site', 'form - space configuration superfield label', true), 
			'instructions' => __d('fact_site', 'form - space configuration superfield instructions', true)
		));
			
			echo $this->Buro->input(
				array(), 
				array(
					'fieldName' => 'MexcSpace.name',
					'label' => __d('fact_site', 'form - mexc_space name label', true),
					'instructions' => __d('fact_site', 'form - mexc_space name instructions', true)
				)
			);
			
			echo $this->Buro->input(
				array(), 
				array(
					'fieldName' => 'MexcSpace.id',
					'label' => __d('fact_site', 'form - mexc_space id label', true),
					'instructions' => __d('fact_site', 'form - mexc_space id instructions', true)
				)
			);
			
			echo $this->Buro->input(
				array(), 
				array(
					'type' => 'color',
					'fieldName' => 'MexcSpace.fore_color',
					'label' => __d('fact_site', 'form - mexc_space fore_color label', true)
				)
			);
			
			echo $this->Buro->input(
				array(), 
				array(
					'type' => 'color',
					'fieldName' => 'MexcSpace.back_color',
					'label' => __d('fact_site', 'form - back_color id label', true)
				)
			);
			
		echo $this->Buro->einput();
		
		
		
		echo $this->Buro->sinput(array(), array(
			'type' => 'super_field', 
			'label' => __d('fact_site', 'form - layout configuration superfield label', true), 
			'instructions' => __d('fact_site', 'form - layout configuration instructions',true)
		));
			
			echo $this->Buro->pDry(__d('fact_site', 'form - preset sites', true));

			App::import('Config', 'SiteFactory.SiteFactory');
			foreach (Configure::read('FactSite.preset') as $n => $preset)
			{
				$pair = ($n+1)%2 == 0;
				if (!$pair)
					echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 4, 'g' => -1)));
				echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 3)));
				
				echo $this->Bl->a(
					array(
						'id' => $id = $this->uuid('div', 'site_factory'),
						'href' => '',
						'style' => "display: block; margin-bottom: 30px; line-height: 30px; text-align: center; border: 1px solid {$preset['color_outline']}; color: {$preset['color_foreground']}; background: {$preset['color_background']}"
					),
					array(),
					'Exemplo ' . ($n+1)
				);
				
				echo $this->Html->scriptBlock("
					$('$id').observe('click', function(ev) {
						ev.stop();
						if ((form = ev.findElement('.buro_form')) && (form = BuroCR.get(form.id)))
						{
							form.addParameters({'data[FactSite][preset]':'$n'}).submits();
							window.canShowPopup = false;
						}
					});
				");
				
				if (!$pair)
					echo $this->Bl->eboxContainer();
				echo $this->Bl->eboxContainer();
			
			}
			echo $this->Bl->floatBreak();
			
			// Start input colors {
			
			echo $this->Buro->input(array(),
				array(
					'type' => 'color',
					'fieldName' => 'color_background',
					'label' => __d('fact_site', 'form - color_background label', true),
				)
			);
			
			echo $this->Buro->input(array(),
				array(
					'type' => 'color',
					'fieldName' => 'color_foreground',
					'label' => __d('fact_site', 'form - color_foreground label', true),
				)
			);
			
			echo $this->Buro->input(array(),
				array(
					'type' => 'color',
					'fieldName' => 'color_link',
					'label' => __d('fact_site', 'form - color_link label', true),
				)
			);
			
			echo $this->Buro->input(array(),
				array(
					'type' => 'color',
					'fieldName' => 'color_menu_bg',
					'label' => __d('fact_site', 'form - color_menu_bg label', true),
				)
			);
			
			echo $this->Buro->input(array(),
				array(
					'type' => 'color',
					'fieldName' => 'color_menu_fg',
					'label' => __d('fact_site', 'form - color_menu_fg label', true),
				)
			);
			
			echo $this->Buro->input(array(),
				array(
					'type' => 'color',
					'fieldName' => 'color_outline',
					'label' => __d('fact_site', 'form - color_outline label', true),
				)
			);
			
			echo $this->Buro->input(array(),
				array(
					'type' => 'color',
					'fieldName' => 'color_lines',
					'label' => __d('fact_site', 'form - color_lines label', true),
				)
			);
			
			// End of input colors }
			
			// Start of image inputs {
			
			echo $this->Buro->input(
				array(),
				array(
					'type' => 'image',
					'fieldName' => 'img_id',
					'label' => __d('fact_site', 'form - img_id label', true),
					'instructions' => __d('fact_site', 'form - img_id instructions', true),
					'options' => array(
						'version' => 'preview'
					)
				)
			);
			
			echo $this->Buro->input(array(),
				array(
					'type' => 'image',
					'fieldName' => 'img_bg_id',
					'label' => __d('fact_site', 'form - img_bg_id label', true),
					'instructions' => __d('fact_site', 'form - img_bg_id instructions', true),
					'options' => array(
						'version' => 'preview'
					)
				)
			);
			
			echo $this->Buro->input(
				array(),
				array(
					'type' => 'image',
					'fieldName' => 'picture_id',
					'label' => __d('fact_site', 'form - picture_id label', true),
					'instructions' => __d('fact_site', 'form - picture_id instructions', true),
					'options' => array(
						'version' => 'preview'
					)
				)
			);
			
			echo $this->Buro->input(array(),
				array(
					'type' => 'image',
					'fieldName' => 'img_head_id',
					'label' => __d('fact_site', 'form - img_head_id label', true),
					'instructions' => __d('fact_site', 'form - img_head_id instructions', true),
					'options' => array(
						'version' => 'preview'
					)
				)
			);
			
			echo $this->Buro->input(array(),
				array(
					'type' => 'image',
					'fieldName' => 'img_foot_id',
					'label' => __d('fact_site', 'form - img_foot_id label', true),
					'instructions' => __d('fact_site', 'form - img_foot_id instructions', true),
					'options' => array(
						'version' => 'preview'
					)
				)
			);
		
			// End of image inputs }
			
		echo $this->Buro->einput();
		
		echo $this->Buro->submitBox(array(),array('publishControls' => false));
echo $this->Buro->eform();
