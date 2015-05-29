<?php

switch ($type[0])
{
	case 'full':
		switch ($type[1])
		{
			case 'cork':
				echo $this->Bl->p(array('class' => 'cargo'), array(), $data['PieMember']['cargo']);

				if (!empty($data['PieMember']['file_id']))
					echo $this->Bl->img(array(), array('id' => $data['PieMember']['file_id'], 'version' => 'image_3M'));

				echo $this->Bl->p(array('class' => 'name'), array(), $data['PieMember']['name']);
				echo $this->Bl->textile(array('class' => 'description'), array(), $data['PieMember']['description']);
			break;
		}
	break;
	
	case 'buro':
		switch ($type[1])
		{
			case 'form':
				echo $this->Buro->sform(array(), array('model' => 'PieMember.PieMember'));
					
					echo $this->Buro->input(
						array(),
						array(
							'fieldName' => 'id',
							'type' => 'hidden'
						)
					);
					
					echo $this->Buro->input(
						array(), 
						array(
							'fieldName' => 'file_id',
							'type' => 'image',
							'label' => __d('content_stream', 'PieMember.file_id label', true),
							'instructions' => __d('content_stream', 'PieMember.file_id instructions', true),
							'options' => array(
								'version' => 'image_3M'
							)
						)
					);
					
					echo $this->Buro->input(
						array(),
						array(
							'fieldName' => 'name',
							'type' => 'text',
							'label' => __d('content_stream', 'PieMember.name label', true),
							'instructions' => __d('content_stream', 'PieMember.name instructions', true)
						)
					);
					
					echo $this->Buro->input(
						array(),
						array(
							'fieldName' => 'cargo',
							'type' => 'text',
							'label' => __d('content_stream', 'PieMember.cargo label', true),
							'instructions' => __d('content_stream', 'PieMember.cargo instructions', true)
						)
					);
					
					echo $this->Buro->input(
						array(), 
						array(
							'fieldName' => 'description',
							'type' => 'textarea',
							'label' => __d('content_stream', 'PieMember.description label', true),
							'instructions' => __d('content_stream', 'PieMember.description instructions', true),
						)
					);
					
					echo $this->Buro->submit(array(), array('cancel' => true));
					
				echo $this->Buro->eform();
				echo $this->Bl->floatBreak();
			break;
			
			case 'view':
				if (!empty($data['PieMember']['name']))
					echo $this->Bl->h3Dry($data['PieMember']['name']);
				if (!empty($data['PieMember']['cargo']))
					echo $this->Bl->pDry($data['PieMember']['cargo']);
				if (!empty($data['PieMember']['description']))
					echo $this->Bl->pDry($data['PieMember']['description']);
				if (!empty($data['PieMember']['file_id']))
					echo $this->Bl->img(array(), array('id' => $data['PieMember']['file_id'], 'version' => 'image_3M'));
			break;
		}
	break;
}
