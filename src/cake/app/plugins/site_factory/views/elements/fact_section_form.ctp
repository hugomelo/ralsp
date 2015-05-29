<?php

/*
 * Copyright 2011-2015, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * source:  https://github.com/museudecienciasunicamp/site_factory.git Mexc Highlights public repository
 *
 */


echo $this->Buro->sform(
	array(),
	array(
		'model' => 'SiteFactory.FactSection'
	)
);

	echo $this->Buro->input(
		array(),
		array(
			'type' => 'hidden',
			'fieldName' => 'id'
		)
	);
	
	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'name',
			'label' => __d('fact_section', 'form - name label', true),
			'instructions' => __d('fact_section', 'form - name instructions', true)
		)
	);
	
	echo $this->Buro->input(
		array('id' => $select_id = $this->uuid('select', 'fact_site')),
		array(
			'type' => 'select',
			'fieldName' => 'type',
			'label' => __d('fact_section', 'form - type label', true),
			'instructions' => __d('fact_section', 'form - type instructions', true),
			'options' => array(
				'options' => $section_types,
				'empty' => true
			)
		)
	);

	$content = '';
	if (!empty($this->data))
	{
		$config = Configure::read('jj.modules.' . $this->data['FactSection']['type']);
		if (!empty($config))
			$content = $this->Jodel->insertModule($config['model'], array('factory', 'subform'));
	}
	echo $this->Bl->div(array('id' => $div_id = $this->uuid('div', 'fact_site')), array(), $content);
	
	$url = Router::url(array('plugin' => 'site_factory', 'controller' => 'fact_sites', 'action' => 'get_subform'));
	echo $this->BuroOfficeBoy->addHtmlEmbScript("
		$('$select_id').observe('change', function(ev)
		{
			var select = ev.element(),
				buro_form = select.readAttribute('buro:form');
			$('$div_id').update();
			if (!select.value.blank())
			new BuroAjax(
				'$url',
				{parameters: {'data[section_type]': select.value}},
				{onSuccess: function(buro_form,re,json) {
					$('$div_id').update(json.content).select('[buro\\\\:form]').invoke('writeAttribute', 'buro:form', buro_form)
				}.curry(buro_form)}
			);
		});
	");
	
	echo $this->Buro->input(
		array(),
		array(
			'type' => 'select',
			'fieldName' => 'publishing_status',
			'label' => __d('fact_section', 'form - publishing_status label', true),
			'instructions' => __d('fact_section', 'form - publishing_status instructions', true),
			'options' => array(
				'options' => array(
					'published' => __d('fact_section', 'form - published', true),
					'draft' => __d('fact_section', 'form - draft', true)
				)
			)
		)
	);

	echo $this->Buro->submit(
		array(),
		array(
			'label' => __d('fact_section', 'save form', true),
			'cancel' => array(
				'label' => __d('fact_section', 'cancel form', true)
			)
		)
	);
echo $this->Buro->eform();
echo $this->Bl->floatBreak();
