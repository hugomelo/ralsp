<?php

/*
 * Copyright 2011-2015, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * source:  https://github.com/museudecienciasunicamp/site_factory.git Mexc Highlights public repository
 *
 */


$section_types = array();
foreach (Configure::read('jj.modules') as $module_name => $module)
{
	if (isset($module['plugged']) && in_array('factory', $module['plugged']))
	{
		if (isset($module['fact_name']))
			$section_types[$module_name] = $module['fact_name'];
		else
			trigger_error('Parameter \'fact_name\' obligatory, when plugged to factory.');
	}
}

$this->set(compact('section_types'));


switch ($type[0])
{
	case 'buro':
		switch ($type[1])
		{
			case 'form':
				echo $this->element('fact_section_form', array('plugin' => 'site_factory'));
			break;
			
			case 'view':
				echo $this->Bl->strongDry('Nome'),
					 '&ensp;',
					 $this->Bl->spanDry($data['FactSection']['name']);

				echo $this->Bl->br();
				
				echo $this->Bl->strongDry('Tipo de seção'),
					 '&ensp;',
					 $this->Bl->spanDry($section_types[$data['FactSection']['type']]);
				
				echo $this->Bl->br();

#				$htmlAttributes = array(
#					'onclick' => "var form = BuroCR.get(this.up('.buro_form').id); if (form.changed()) { alert('Antes de prosseguir, o formulário atual será salvo.'); form.addCallbacks({'onSave': function(url){ location.href = url }.curry(this.href)}); form.submits(); return false;}"
#				);

				if ($data['FactSection']['type'] == 'sui_subscription')
				{
					$slugSection = Inflector::slug($data['FactSection']['name']);
					if (isset($data['FactSection']['metadata']['subscription_help_text']))
					{
						echo $this->Bl->anchor(array(), array('url' => array(
							'plugin' => 'corktile',
							'controller' => 'cork_corktiles',
							'action' => 'edit', "secao_{$slugSection}_{$data['FactSection']['id']}_texto_de_ajuda"
						)), 'Edição do texto de ajuda');
						
						echo $this->Bl->br();
					}
					
					echo $this->Bl->anchor(array(), array('url' => array(
						'plugin' => 'corktile',
						'controller' => 'cork_corktiles',
						'action' => 'edit', "secao_{$slugSection}_{$data['FactSection']['id']}_introducao"
					)),'Edição do texto de introdução');
				}
				
				if ($data['FactSection']['type'] == 'mojo')
				{
					$slugSection = Inflector::slug($data['FactSection']['metadata']['mojo_id']);
					if (isset($data['FactSection']['metadata']['has_help_text']))
					{
						echo $this->Bl->anchor(array(), array('url' => array(
							'plugin' => 'corktile',
							'controller' => 'cork_corktiles',
							'action' => 'edit', "{$slugSection}_{$data['FactSection']['id']}_fact_mojo_section_cstext",
						)), 'Edição do texto de ajuda/dúvidas');
						
						echo $this->Bl->br();
					}
					
					echo $this->Bl->anchor(array(), array('url' => array(
						'plugin' => 'corktile',
						'controller' => 'cork_corktiles',
						'action' => 'edit', "{$slugSection}_{$data['FactSection']['id']}_fact_mojo_section_cstext_before_form",
					)),'Edição do texto antes do formulário de dúvidas');
				}
				
				$config = Configure::read('jj.modules.' . $data['FactSection']['type']);
				if (!empty($config))
					echo $this->Jodel->insertModule($config['model'], array('factory', 'subview'), $data);
				
				echo $this->Bl->br();
				echo $this->Bl->br();
				if ($data['FactSection']['publishing_status'] == 'draft')
					echo $this->Bl->spanDry(__d('fact_section', 'this fact_section is maked as draft', true));
				else
					echo $this->Bl->spanDry(__d('fact_section', 'this fact_section is marked as published', true));
			break;
		}
	break;
}
