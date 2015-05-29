<?php
	
class GeraImagemHelper extends AppHelper
{	
	var $helpers = array('Html', 'Session');

	/*
	 *	atributos:
	 *		- aumenta: (true, false) diz se permite ou não aumentar a foto. Default = false
	 *		- largura: (em pixels) é a largura da foto a ser buscada
	 *		- largura_max: (em pixels) é a máxima largura possivel da foto a ser gerada. Pra ser usada junto com altura
	 *		- altura: (em pixels) é a altura da foto a ser buscada
	 *		- altura_max: (em pixels) é a máxima altura possivel da foto a ser gerada. Pra ser usada junto com largura
	 */
//---------------------------------------------------------------------------------------------------------------img
	function img($id = null, $atributos = array())
	{
		$dados_img = $this->dados_img($id, $atributos);
		$opcoes = array();
		if(isset($atributos['class']))
			$opcoes['class'] = $atributos['class'];
		if(isset($atributos['id']))
			$opcoes['id'] = $atributos['id'];
		
		if(!empty($dados_img) && !empty($dados_img['endereco']))
		{
			return $this->output($this->Html->image($dados_img['endereco'], $opcoes));
		}
		else
		{
			$Imagem = &ClassRegistry::init('Grandedesafio.Imagem');
			$imagem = $Imagem->findById($id);
			if($imagem)
				return $this->output($this->Html->para('', 
					'Ocorreu um erro com a imagem. Para vê-la '. 
					$this->Html->link(
						'clique aqui',
						'/files/' . $imagem['FileUpload']['subdir'] . '/' . $imagem['Imagem']['nome_arquivo']) .'.'
					),
					array('class' => 'link_texto link_em_nuvem')
				);
			else
				return $this->output($this->Html->para('', 'Ocorreu um erro com a imagem.'));
		}
	}
//------------------------------------------------------------------------------------------------------------dados_img
	function dados_img($id = null, $atributos = array())
	{
		if(!$id)
			return $this->output('Erro no helper de imagem: id incorreto.');
		if(!count($atributos))
			return $this->output('Erro no helper de imagem: falta de atributos.');

		$aumenta = (isset($atributos['aumenta']) && $atributos['aumenta']==true);
		
		//cria uma variável para o Model
		$Imagem = &ClassRegistry::init('Grandedesafio.Imagem');

		//condicoes para a pesquisa de imagens (parece complexo, mas não é) (ou até é)
		$condicoes = array('Imagem.qual_imagem' => $id);
		
		
		if(isset($atributos['largura']))
		{
			if(isset($atributos['altura_max']))
			{
				$condicoes['or'][] = array('and' => array
				(
					'Imagem.largura' => $atributos['largura'],
					'Imagem.altura <= '.$atributos['altura_max']
				));
				$condicoes['or'][] = array('and' => array
				(
					'Imagem.altura' => $atributos['altura_max'],
					'Imagem.largura <= '.$atributos['largura']
				));
			}
			else
			{
				$condicoes['Imagem.largura'] = $atributos['largura'];
			}
		}
		else if(isset($atributos['altura']))
		{
			if(isset($atributos['largura_max']))
			{
				$condicoes['or'][] = array('and' => array
				(
					'Imagem.altura' => $atributos['altura'],
					'Imagem.largura <= '.$atributos['largura_max']
				));
				$condicoes['or'][] = array('and' => array
				(
					'Imagem.largura' => $atributos['largura_max'],
					'Imagem.altura <= '.$atributos['altura']
				));
			}
			else
			{
				$condicoes['Imagem.altura'] = $atributos['altura'];
			}
		}

		$imagens = $Imagem->find('all',array('conditions' => $condicoes, 'order' => 'tamanho', 'recursive' => 1));
		
		$endereco = $largura = $altura = $tamanho = $formato = '';
		
		if (!$aumenta)
		{
			$dados_originais = $Imagem->findById($id);
			
			if (isset($atributos['largura']))
			{
				if ($dados_originais['Imagem']['largura'] < $atributos['largura']
					&& $dados_originais['Imagem']['altura'] < $atributos['altura_max'])
				{
					$imagens[0] = $dados_originais;
				}
			}
			elseif (isset($atributos['altura']))
			{
				if ($dados_originais['Imagem']['altura'] < $atributos['altura']
					&& $dados_originais['Imagem']['largura'] < $atributos['largura_max'])
				{
					$imagens[0] = $dados_originais;
				}
			}
		}		
		
		if(count($imagens))
		{
			$imagens[0]['Imagem']['nome_arquivo'] = rawurlencode(utf8_decode($imagens[0]['Imagem']['nome_arquivo']));
			$endereco = '/files/' . $imagens[0]['FileUpload']['subdir'] . '/' . $imagens[0]['Imagem']['nome_arquivo'];
			$largura = $imagens[0]['Imagem']['largura'];
			$altura = $imagens[0]['Imagem']['altura'];
			$tamanho = $imagens[0]['FileUpload']['file_size'];
			$formato = $imagens[0]['Imagem']['formato'];
		}
		else
		{
			//pega os dados das imagens do banco de dados
			$dados_originais = $Imagem->findById($id);
			
			$formato = $dados_originais['Imagem']['formato'];
			
			$largura = (float) $dados_originais['Imagem']['largura'];
			$altura = (float) $dados_originais['Imagem']['altura'];
			$largura_nova = 0;
			$altura_nova = 0;

			//caminho padrão para os arquivos de imagem:
			$path = WWW_ROOT . 'files' . DS . $dados_originais['FileUpload']['subdir'] ;

			//novas dimensoes
			if(isset($atributos['largura']))
			{
				$largura_nova = (float) $atributos['largura'];
				$altura_nova = $altura*$largura_nova/$largura;

				if(isset($atributos['altura_max']) && $altura_nova > $atributos['altura_max'])
				{
					$altura_nova = (float) $atributos['altura_max'];
					$largura_nova = $largura*$altura_nova/$altura;
				}
			}
			else if(isset($atributos['altura']))
			{
				$altura_nova = (float) $atributos['altura'];
				$largura_nova = $largura*$altura_nova/$altura;

				if(isset($atributos['largura_max']) && $largura_nova > $atributos['largura_max'])
				{
					$largura_nova = (float) $atributos['largura_max'];
					$altura_nova = $altura*$largura_nova/$largura;
				}
			}
			else
			{
				return $this->output('Não foi especificada nem altura e nem largura!');
			}
			
			$nome_novo = $dados_originais['Imagem']['nome_arquivo'];
			$a=1;

			while(file_exists($path . DS . $nome_novo))
			{
				$ultimo_ponto = strrpos($dados_originais['Imagem']['nome_arquivo'], '.');
				$extensao = substr($dados_originais['Imagem']['nome_arquivo'],$ultimo_ponto);
				$nome = substr($dados_originais['Imagem']['nome_arquivo'],0,$ultimo_ponto);
				$nome_novo = $nome . ($a++) . $extensao;
			}

			$endereco_original = $path . DS . $dados_originais['Imagem']['nome_arquivo'];
			$endereco_novo = $path . DS . $nome_novo;
			
			//gera uma imagem na memoria a partir da original
			$imagem_original = false;
			ini_set("memory_limit","200M");
			switch($formato)
			{
				case 'GIF':		$imagem_original=@imagecreatefromgif($endereco_original);	break;
				case 'JPEG':	$imagem_original=@imagecreatefromjpeg($endereco_original);	break;
				case 'PNG':		$imagem_original=@imagecreatefrompng($endereco_original);	break;
			}
			
			if($imagem_original)
			{
				//gera uma imagem nova
				$imagem_nova = imagecreatetruecolor($largura_nova,$altura_nova);
				imagecopyresampled($imagem_nova, $imagem_original, 0, 0, 0, 0, $largura_nova, $altura_nova, $largura, $altura);

				switch($formato)
				{
					case 'GIF':		imagegif($imagem_nova, $endereco_novo); break;
					case 'JPEG':	imagejpeg($imagem_nova, $endereco_novo, 100); break;
					case 'PNG':		imagepng($imagem_nova, $endereco_novo, 0); break;
				}

				//retira as imagens da memória
				imagedestroy($imagem_original);
				imagedestroy($imagem_nova);
				
				$endereco =  '/files/' . $dados_originais['FileUpload']['subdir'] . '/' . $nome_novo;
				$tamanho = filesize($path . DS . $nome_novo)/1024;
				$largura = (int)$largura_nova;
				$altura = (int)$altura_nova;
				
				//insere os dados da nova imagem no banco de dados
				$dados = array
				(
					'qual_imagem' => $id,
					'nome_arquivo' => $nome_novo,
					'formato' => $formato,
					'altura' => $altura,
					'largura' => $largura,
					'tamanho' => $tamanho,
					'file_upload_id' => $dados_originais['Imagem']['file_upload_id']
				);
				$Imagem->id = false;
				$Imagem->save($dados);
			}
			else
			{
				return false;
			}
		}
		return array(
			'endereco' => $endereco,
			'tamanho' => $tamanho,
			'largura' => $largura,
			'altura' => $altura,
			'formato' => $formato
		);
	}
	
	function dados_original($id)
	{
		$Imagem = &ClassRegistry::init('Grandedesafio.Imagem');
		$dados = $Imagem->findById($id);
		$dados['Imagem']['nome_arquivo'] = rawurlencode($dados['Imagem']['nome_arquivo']);
		$dados['FileUpload']['file_name'] = rawurlencode($dados['FileUpload']['file_name']);
		return $dados;
		
	}	
};	


?>