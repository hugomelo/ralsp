<?php

switch ($type[0])
{
	case 'full':
		switch ($type[1])
		{
			case 'cork':
				if (!empty($data['PieLogo']['file_id']))
				{
					echo $this->Bl->sdiv(array('class' => 'logo'));
						echo $this->Bl->sp();
							$img = '';
							if (!empty($data['PieLogo']['file_id']))
								$img = $this->Bl->img(array('alt' => $data['PieLogo']['name']), array('id' => $data['PieLogo']['file_id'], 'version' => 'thumb'));
						
							if (empty($data['PieLogo']['link']))
								echo $img;
							else
								echo $this->Bl->anchor(array(),array('url' => $data['PieLogo']['link']),$img);
						echo $this->Bl->ep();
					echo $this->Bl->ediv();
				}
			break;
		}
	break;
	
	case 'buro':
		switch ($type[1])
		{
			case 'form':
				echo $this->Buro->sform(array(), array('model' => 'PieLogo.PieLogo'));
					
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
							'label' => __d('content_stream', 'PieLogo.file_id label', true),
							'instructions' => __d('content_stream', 'PieLogo.file_id instructions', true),
							'options' => array(
								'version' => 'thumb'
							)
						)
					);
					
					echo $this->Buro->input(
						array(),
						array(
							'fieldName' => 'name',
							'type' => 'text',
							'label' => __d('content_stream', 'PieLogo.name label', true),
							'instructions' => __d('content_stream', 'PieLogo.name instructions', true)
						)
					);
					
					echo $this->Buro->input(
						array(),
						array(
							'fieldName' => 'link',
							'type' => 'text',
							'label' => __d('content_stream', 'PieLogo.link label', true),
							'instructions' => __d('content_stream', 'PieLogo.link instructions', true)
						)
					);
					
					
					echo $this->Buro->submit(array(), array('cancel' => true));
					
				echo $this->Buro->eform();
				echo $this->Bl->floatBreak();
			break;
			
			case 'view':
				if (!empty($data['PieLogo']['name']))
					echo $this->Bl->h3Dry($data['PieLogo']['name']);
				if (!empty($data['PieLogo']['link']))
					echo $this->Bl->pDry($data['PieLogo']['link']);
				if (!empty($data['PieLogo']['file_id']))
					echo $this->Bl->img(array(), array('id' => $data['PieLogo']['file_id'], 'version' => 'thumb'));
			break;
		}
	break;
}
