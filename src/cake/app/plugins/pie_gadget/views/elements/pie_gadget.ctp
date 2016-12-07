<?php

switch ($type[0]) {
case 'full':
	switch ($type[1]) {
	case 'cork':
	case 'mexc_new':
	case 'mexc_event':
	case 'mexc_document':
		echo $this->element(
			$data['PieGadget']['source'], 
			array(
				'plugin' => 'pie_gadget', 
				'data' => $data, 
				'width' => '675',
			)
		);
		break;
	}
	break;
	
case 'buro':
	switch ($type[1]) {
	case 'form':
		echo $this->Buro->sform(array(), array('model' => 'PieGadget.PieGadget'));
			
			echo $this->Buro->input(
				array(),
				array(
					'fieldName' => 'id',
					'type' => 'hidden'
				)
			);
			
			echo $this->Form->create('PieGadget');
			
				echo $this->Buro->input(
					array(),
					array(
						'fieldName' => 'url',
						'type' => 'textarea',
						'label' => __d('cedes', 'URL', true),
						'instructions' => __d('cedes', 'Coloque aqui a URL simples do Gadget ou então todo o código da incorporação.', true),
						'options' => array(
							'class' => 'PieGadgetUrl'
						)
					)
				);
				
			
			echo $this->Form->end();

			echo $this->Buro->submit(array(), array('cancel' => true));
			
		echo $this->Buro->eform();
		echo $this->Bl->floatBreak();
		break;
		
	case 'view':
		if (!empty($data['PieGadget']['url'])) {
			echo $this->element(
				$data['PieGadget']['source'], 
				array(
					'plugin' => 'pie_gadget', 
					'data' => $data, 
					'width' => $hg->size('5M-g')
				)
			);
		}
		break;
	}
	break;
}
