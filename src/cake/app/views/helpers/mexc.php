<?php
	
class MexcHelper extends AppHelper
{	
	var $helpers = array('Html', 'Session', 'JjUsers.JjAuth');
	var $estrutura_de_secoes = array(
				'secoes' => array(
					array('id' => 'atividades', 'nome' => 'Nossas Atividades', 'largura_px' => 136, 'ajustezinho_apontador' => -2, 'link' => '/atividades/', 'tem_setinha_no_segundo_nivel' => true),
					array('id' => 'eventos', 'nome' => 'Eventos', 'largura_px' => 58, 'ajustezinho_apontador' => 3, 'link' => '/eventos/', 'tem_setinha_no_segundo_nivel' => false),
					array('id' => 'novidades', 'nome' => 'Novidades', 'largura_px' => 78, 'ajustezinho_apontador' => 0, 'link' => '/novidades/', 'tem_setinha_no_segundo_nivel' => false),
					array('id' => 'material', 'nome' => 'Fotos e Textos', 'largura_px' => 106, 'ajustezinho_apontador' => 2, 'link' => '/material/', 'tem_setinha_no_segundo_nivel' => false),
					array('id' => 'localizacao', 'nome' => 'Como Chegar', 'largura_px' => 99, 'ajustezinho_apontador' => 0, 'link' => '/localizacao/', 'tem_setinha_no_segundo_nivel' => false),
					array('id' => 'sobre', 'nome' => 'Sobre o Museu', 'largura_px' => 110, 'ajustezinho_apontador' => 2, 'link' => '/sobre/', 'tem_setinha_no_segundo_nivel' => false)
				),
				'sub_secoes' => array(
					'atividades' => array(
						array('id' => 'nano_aventura', 'nome' => 'Nano Aventura', 'largura_px' => 83, 'ajustezinho_apontador' => 0, 'link' => '/atividades/nano_aventura/', 'segundo_andar' => array('altura'=>300)),
						array('id' => 'oficina_desafio', 'nome' => 'Oficina Desafio', 'largura_px' => 89, 'ajustezinho_apontador' => 3, 'link' => '/atividades/oficina_desafio/', 'segundo_andar' => array('altura'=>300)),
						array('id' => 'grande_desafio', 'nome' => 'Grande Desafio', 'largura_px' => 95, 'ajustezinho_apontador' => 0, 'link' => '/grandedesafio/','segundo_andar' => array('altura'=>300)),
						array('id' => 'olimpiada_de_historia', 'nome' => 'Olimpíada de História', 'largura_px' => 134, 'ajustezinho_apontador' => 0, 'link' => '/3-olimpiada/','segundo_andar' => array('altura'=>300)),
						array('id' => 'praca_tempo_espaco', 'nome' => 'Praça Tempo e Espaço', 'largura_px' => 123, 'ajustezinho_apontador' => 0, 'link' => '/atividades/','segundo_andar' => array('altura'=>300)),
						array('id' => 'unicamp_itinerante', 'nome' => 'Unicamp Itinerante', 'largura_px' => 119, 'ajustezinho_apontador' => 0, 'link' => '/unicamp_itinerante/','segundo_andar' => array('altura'=>300))
					), 
					'novidades' => array(
						array('id' => 'novidades_em_destaque', 'nome' => 'Novidades em Destaque', 'largura_px' => 143, 'link' => '/novidades/', 'segundo_andar'=>array('inicio_direita'=>9,'altura'=>400)),
						array('id' => 'arquivo_novidades', 'nome' => 'Arquivo de Novidades do Museu', 'largura_px' => 192, 'link' => '/novidades/arquivo/', 'segundo_andar'=>array('inicio_direita'=>6,'altura'=>200)),
						array('id' => 'arquivo_noticias', 'nome' => 'Arquivo de Notícias de Ciências', 'largura_px' => 189, 'link' => '/novidades/noticias_ciencias/', 'segundo_andar'=>array('inicio_direita'=>6,'altura'=>200))
					),
					'sobre' => array(
						array('id' => 'como_agendar', 'nome' => 'Como Agendar', 'largura_px' => 86, 'link' => '/sobre/como_agendar/','segundo_andar'=>array('inicio_direita'=>9,'altura'=>300)),
						array('id' => 'contato', 'nome' => 'Contato', 'largura_px' => 45, 'link' => '/sobre/contato/','segundo_andar'=>array('inicio_direita'=>4,'altura'=>300)),
						array('id' => 'creditos', 'nome' => 'Créditos', 'largura_px' => 49, 'link' => '/sobre/creditos/','segundo_andar'=>array('inicio_direita'=>5,'altura'=>200)),
						array('id' => 'equipe', 'nome' => 'Equipe', 'largura_px' => 41, 'link' => '/sobre/equipe/','segundo_andar'=>array('inicio_direita'=>7,'altura'=>300)),
						array('id' => 'historia_do_museu', 'nome' => 'História do Museu', 'largura_px' => 108, 'link' => '/sobre/historia/','segundo_andar'=>array('inicio_direita'=>5,'altura'=>600)),
						array('id' => 'imprensa', 'nome' => 'Imprensa', 'largura_px' => 55, 'link' => '/sobre/imprensa/','segundo_andar'=>array('inicio_direita'=>6,'altura'=>300)),
						array('id' => 'informacoes_gerais', 'nome' => 'Informações Gerais', 'largura_px' => 115, 'link' => '/sobre/', 'segundo_andar'=>array('inicio_direita'=>9,'altura'=>300)),
						array('id' => 'mapa_do_site', 'nome' => 'Mapa do Site', 'largura_px' => 78, 'link' => '/sobre/mapa_do_site/','segundo_andar'=>array('inicio_direita'=>4,'n_nuvens'=>5,'altura'=>600))
						
					),
					'material' => array(
						array('id' => 'galeria_fotos', 'nome' => 'Galeria de Fotos', 'largura_px' => 103, 'link' => '/fotos/','segundo_andar'=>array('inicio_direita'=>9,'altura'=>400)),
						array('id' => 'arquivos_do_museu', 'nome' => 'Arquivos do Museu', 'largura_px' => 113, 'link' => '/arquivos/index/1/'),
						array('id' => 'arquivos_dos_visitantes', 'nome' => 'Arquivos dos Visitantes', 'largura_px' => 140, 'link' => '/arquivos/index/2/')
					),
					'eventos' => array(						
						array('id' => 'resumo_da_programacao', 'nome' => 'Resumo da Programação', 'largura_px' => 148, 'link' => '/eventos/destaques/'),
						array('id' => 'eventos_eventos', 'nome' => 'Eventos', 'largura_px' => 47, 'link' => '/eventos/eventos/')
					)
				)
			);
			
	var $estrutura_de_secoes_adm = array(
				'secoes' => array(
					//array('id' => 'secoes', 		   'nome' => 'Site Principal',	   'url' => array('controller' => 'novidades')),
					array('id' => 'grande_desafio',    'nome' => 'Grande Desafio',	   'url' => array('paineladmin' => false, 'edicao' => 6, 'plugin' => 'grandedesafio', 'controller' => 'equipes', 'action' => 'admin_premiacoes')),
					array('id' => 'olimpiada', 		   'nome' => 'Olimpíada',		   'url' => array('controller' => 'fases', 'plugin' => 'olimpiada_quatro', 'edicao' => 4, 'paineladmin' => true, 'action' => 'index')),
					//array('id' => 'unicamp_itinerante','nome' => 'Unicamp Itinerante', 'url' => array('controller' => 'blog', 'plugin' => 'unicamp_itinerante')),
					//array('id' => 'administradores',   'nome' => 'Administradores',	   'url' => array('controller' => 'usuarios', 'action' => 'admin_administradores')),
					//array('id' => 'preferencias', 	   'nome' => 'Minha conta',		   'url' => array('controller' => 'usuarios', 'action' => 'admin_alterar'))
				),
				'sub_secoes' => array(
					'secoes' => array(
						array('id' => 'novidades',	'nome' => 'Novidades',				'url' => array('controller' => 'novidades')),
						array('id' => 'noticias',	'nome' => 'Notícias de divulgação', 'url' => array('controller' => 'noticias')),
						array('id' => 'eventos',	'nome' => 'Eventos',				'url' => array('controller' => 'eventos')),
						array('id' => 'arquivos',	'nome' => 'Arquivos',				'url' => array('controller' => 'arquivos')),
						array('id' => 'fotos',		'nome' => 'Fotos', 					'url' => array('controller' => 'fotos'))
					),
					'usuarios' => array(
						array('id' => 'todos_usuarios', 'nome' => 'Todos',			'url' => array('action' => 'admin_lista')),
						array('id' => 'novo_usuario',	'nome' => 'Novo usuário',	'url' => array('action' => 'admin_novo'))
					),
					'olimpiada' => array(
						array('id' => 'oh_01', 'nome' => '1ª ONHB', 'url' => array('edicao' => 1, 'plugin' => 'olimpiada', 'controller' => 'inscricoes')),
						array('id' => 'oh_02', 'nome' => '2ª ONHB', 'url' => array('edicao' => 2, 'plugin' => 'olimpiada', 'controller' => 'fases')),
						array('id' => 'oh_04', 'nome' => '4ª ONHB', 'url' => array('edicao' => 4, 'plugin' => 'olimpiada_quatro', 'controller' => 'fases', 'paineladmin' => true, 'action' => 'index'))
					),
					'grande_desafio' => array(
						//array('id' => 'gd_edicoes',		'nome' => 'Edições',	'url' => array('plugin' => 'grandedesafio', 'controller' => 'grandedesafio')),
						array('id' => 'gd_12_', 'nome' => 'GD2012', 'url' => array('edicao' => 6, 'plugin' => 'grandedesafio', 'controller' => 'equipes', 'action' => 'admin_premiacoes')),
						array('id' => 'gd_11_', 'nome' => 'GD2011', 'url' => array('edicao' => 5, 'plugin' => 'grandedesafio', 'controller' => 'equipes', 'action' => 'admin_premiacoes')),
						array('id' => 'gd_10_', 'nome' => 'GD2010', 'url' => array('edicao' => 4, 'plugin' => 'grandedesafio', 'controller' => 'equipes', 'action' => 'admin_premiacoes')),
						//array('id' => 'gd_09_', 'nome' => 'GD2009', 'url' => array('edicao' => 3, 'plugin' => 'grandedesafio', 'controller' => 'inscricao'))
					),
					'unicamp_itinerante' => array(
						array('id' => 'blog', 'nome' => 'Blog', 'url' => array('plugin' => 'unicamp_itinerante', 'controller' => 'blog'))
					)
				),
				'sub_sub_secoes' => array(
					
					'arquivos' => array(
						array('id' => 'museu', 'nome' => 'Arquivos do Museu', 'url' => array('controller' => 'arquivos', 'action' => 'admin_index/0/0/1')),
						array('id' => 'visitantes', 'nome' => 'Arquivos dos Visitantes', 'url' => array('controller' => 'arquivos', 'action' => 'admin_index/0/0/2'))
					),
					'gd_09_' => array(
						//array('id' => 'arquivos',	'nome' => 'Arquivos',	'url' => array('edicao' => 3, 'plugin' => 'grandedesafio', 'controller' => 'arquivos')),						
						//array('id' => 'inscricao',	'nome' => 'Equipes',	'url' => array('edicao' => 3, 'plugin' => 'grandedesafio', 'controller' => 'inscricao')),
						//array('id' => 'fotos',		'nome' => 'Fotos',		'url' => array('edicao' => 3, 'plugin' => 'grandedesafio', 'controller' => 'fotos')),
						//array('id' => 'novidades',	'nome' => 'Novidades',	'url' => array('edicao' => 3, 'plugin' => 'grandedesafio', 'controller' => 'novidades'))
					),
					'gd_10_' => array(
						//array('id' => 'arquivos',	'nome' => 'Arquivos',	'url' => array('edicao' => 4, 'plugin' => 'grandedesafio', 'controller' => 'arquivos')),						
						//array('id' => 'inscricao',	'nome' => 'Equipes',	'url' => array('edicao' => 4, 'plugin' => 'grandedesafio', 'controller' => 'inscricao')),
						//array('id' => 'fotos',		'nome' => 'Fotos',		'url' => array('edicao' => 4, 'plugin' => 'grandedesafio', 'controller' => 'fotos')),
						//array('id' => 'novidades',	'nome' => 'Novidades',	'url' => array('edicao' => 4, 'plugin' => 'grandedesafio', 'controller' => 'novidades')),
						array('id' => 'premiacoes',	'nome' => 'Premiações',	'url' => array('edicao' => 4, 'plugin' => 'grandedesafio', 'controller' => 'equipes', 'action' => 'premiacoes'))
					),
					'gd_11_' => array(
						//array('id' => 'arquivos',	'nome' => 'Arquivos',	'url' => array('edicao' => 5, 'plugin' => 'grandedesafio', 'controller' => 'arquivos')),						
						//array('id' => 'inscricao',	'nome' => 'Equipes',	'url' => array('edicao' => 5, 'plugin' => 'grandedesafio', 'controller' => 'inscricao')),
						//array('id' => 'fotos',		'nome' => 'Fotos',		'url' => array('edicao' => 5, 'plugin' => 'grandedesafio', 'controller' => 'fotos')),
						//array('id' => 'novidades',	'nome' => 'Novidades',	'url' => array('edicao' => 5, 'plugin' => 'grandedesafio', 'controller' => 'novidades')),
						array('id' => 'premiacoes',	'nome' => 'Premiações',	'url' => array('edicao' => 5, 'plugin' => 'grandedesafio', 'controller' => 'equipes', 'action' => 'premiacoes'))
					),
					'gd_12_' => array(
						//array('id' => 'arquivos',	'nome' => 'Arquivos',	'url' => array('edicao' => 5, 'plugin' => 'grandedesafio', 'controller' => 'arquivos')),						
						//array('id' => 'inscricao',	'nome' => 'Equipes',	'url' => array('edicao' => 5, 'plugin' => 'grandedesafio', 'controller' => 'inscricao')),
						//array('id' => 'fotos',		'nome' => 'Fotos',		'url' => array('edicao' => 5, 'plugin' => 'grandedesafio', 'controller' => 'fotos')),
						//array('id' => 'novidades',	'nome' => 'Novidades',	'url' => array('edicao' => 5, 'plugin' => 'grandedesafio', 'controller' => 'novidades')),
						array('id' => 'premiacoes',	'nome' => 'Premiações',	'url' => array('edicao' => 6, 'plugin' => 'grandedesafio', 'controller' => 'equipes', 'action' => 'premiacoes'))
					),
					'oh_01' => array(
						array('id' => 'ol_inscricao',	'nome' => 'As Equipes',		'url' => array('edicao' => 1, 'controller' => 'inscricoes', 'plugin' => 'olimpiada')),
						array('id' => 'ol_documentos',	'nome' => 'Os Documentos',	'url' => array('edicao' => 1, 'controller' => 'documentos', 'plugin' => 'olimpiada')),
						array('id' => 'ol_questoes',	'nome' => 'Questões',		'url' => array('edicao' => 1, 'controller' => 'questoes', 'plugin' => 'olimpiada')),
						array('id' => 'ol_novidades',	'nome' => 'Novidades',		'url' => array('edicao' => 1, 'controller' => 'blog', 'plugin' => 'olimpiada'))
					),
					'oh_02' => array(
						array('id' => 'ol_fases', 'nome' => 'As Fases', 'url' => array('plugin'=>'olimpiada', 'controller' => 'fases', 'action' => 'admin_index', 'edicao'=>2)),
						array('id' => 'ol_equipes',		'nome' => 'As Equipes',			'url' => array('edicao' => 2, 'controller' => 'equipes', 'plugin' => 'olimpiada', 'action' => 'index')),
						array('id' => 'ol_convocacoes',	'nome' => 'Convocações',		'url' => array('edicao' => 2, 'controller' => 'convocacoes', 'plugin' => 'olimpiada', 'action' => 'index')),
						array('id' => 'ol_premiacoes',	'nome' => 'Premiações',			'url' => array('edicao' => 2, 'controller' => 'premiacoes', 'plugin' => 'olimpiada', 'action' => 'index')),
						array('id' => 'ol_novidades',	'nome' => 'Novidades',			'url' => array('edicao' => 2, 'controller' => 'blog', 'plugin' => 'olimpiada')),
						array('id' => 'ol_emails',		'nome' => 'E-mails',			'url' => array('edicao' => 2, 'controller' => 'email', 'plugin' => 'olimpiada'))
					),
					'oh_04' => array(
						array('id' => 'ol_fases',		'nome' => 'As Fases', 		'url' => array('plugin' => 'olimpiada_quatro', 'edicao' => 4, 'controller' => 'fases', 'action' => 'paineladmin_index')),
						array('id' => 'ol_equipes',		'nome' => 'As Equipes',		'url' => array('plugin' => 'olimpiada_quatro', 'edicao' => 4, 'controller' => 'equipes', 'action' => 'paineladmin_index')),
						array('id' => 'ol_convocacoes',	'nome' => 'Convocações',	'url' => array('plugin' => 'olimpiada_quatro', 'edicao' => 4, 'controller' => 'convocacoes', 'action' => 'index')),
						//array('id' => 'ol_premiacoes',	'nome' => 'Premiações',			'url' => array('edicao' => 2, 'controller' => 'premiacoes', 'plugin' => 'olimpiada', 'action' => 'index')),
					)
				)
			);

	/* exemplo de caminho de pão:   array('novidades','arquivo_novidades','novidade')*/
	function geraMenu($caminho_de_pao, $manutencao = false)
	{
		$m = ''; // variável que será retornada
		
		$m .= 
			'<ul id="navegacao">
				<li>
					<a id="home" href="/">
						<img src="/img/img_layout/simbolo_grafico.gif" alt="Link para a página inicial."/>
						<img id="logotipo" src="/img/img_layout/logotipo.gif" alt="Link para a página inicial." />
					</a>
				</li>
				<li>
			<ul id="menu">';

		if (!$manutencao)
		foreach($this->estrutura_de_secoes['secoes'] as $secao)
		{
			
			if ((count($caminho_de_pao) >= 1) && ($caminho_de_pao[0] == $secao['id']))
			{ 
				/*$m .=
					'<li class="selecionado li_n1" style="background-image: url(/img/img_layout/link_' . $secao['id'] . '.gif); width: ' . $secao['largura_px'] . 'px">
						<span class="escondido">' .
							$secao['nome'] .
					   '</span>';
				if (isset($this->estrutura_de_secoes['sub_secoes'][$secao['id']]))
					$m .= '<ul class="menu_nivel2">'; */
					
				$m .=
					'<li class="selecionado li_n1" style="background-image: url(/img/img_layout/link_' . $secao['id'] . '.gif); width: ' . $secao['largura_px'] . 'px">
						<a href="' . $secao['link'] . '">
							<span class="escondido">' .
								$secao['nome'] .
							'</span>
						</a>';
					   
				if (isset($this->estrutura_de_secoes['sub_secoes'][$secao['id']]))
					$m .= '<ul class="menu_nivel2">'; 
					
			}
			else
			{
				$m .=
					'<li class="li_n1">
						<a href="' . $secao['link'] . '" style="background-image: url(/img/img_layout/link_' . $secao['id'] . '.gif); width: ' . $secao['largura_px'] . 'px">
							<span class="escondido">' .
								$secao['nome'] .
							'</span>
						</a>';
				if (isset($this->estrutura_de_secoes['sub_secoes'][$secao['id']]))
					$m .= '<ul class="escondido menu_nivel2">';
			}
			if (isset($this->estrutura_de_secoes['sub_secoes'][$secao['id']]))
			{
				foreach ($this->estrutura_de_secoes['sub_secoes'][$secao['id']] as $sub_secao)
				{				
					if ((count($caminho_de_pao) >= 2) && ($caminho_de_pao[1] == $sub_secao['id']))
					{
						$m .= 
							'<li class="selecionado li_n2" style="background-image: url(/img/img_layout/link_' . $sub_secao['id'] . '.gif); width: ' . $sub_secao['largura_px'] . 'px">
								<a href="' . $sub_secao['link'] . '">
									<span class="escondido">' .
										$sub_secao['nome'] .
									'</span>
								</a>
							</li>';
					}
					else
					{	
						$m .=
							'<li class="li_n2">
								<a href="' . $sub_secao['link'] . '" style="background-image: url(/img/img_layout/link_' . $sub_secao['id'] . '.gif); width: ' . $sub_secao['largura_px'] . 'px">
									<span class="escondido">' .
										$sub_secao['nome'] .
								   '</span>
								</a>
							</li>';						
					}
				}
				$m .= '</ul>';
			}
			$m .= '</li>';
		}
		
		$m .= 
					'</ul>
				</li>
			</ul>';
		return $this->output($m);
	}
	
	function geraMenuAdmin($caminho_de_pao = array('secoes', 'novidades'), $permissoes = null)
	{
		$url = Router::url('/img/img_layout/');
		$lista_permissoes = explode(',', $permissoes);
		$m = '
			<ul id = "navegacao">
				<li id = "li_logo"><a id="home" href="/admin"><img src="'.$url.'logo_museu_pagina_admin.gif" alt="Link para a página inicial."/><img id="logotipo" src="'.$url.'letreiro_museu_pagina_admin.gif" alt="Link para a página inicial." /></a></li>';
				if ($this->JjAuth->can(array('paineladmin', 'OR' => array('olimpiada', 'gd'))))
				{
					$m .= '
				<li>
					<ul id = "menu_n1">
						';
						
					foreach ($this->estrutura_de_secoes_adm['secoes'] as $secao)
					{
						if($secao['id'] == 'administradores' && $permissoes !== 'su')
							continue;
						
						$essa_secao = in_array($secao['id'], $caminho_de_pao);
						$secao['url'] = am(array('action' => 'admin_index', 'plugin' => null), $secao['url']);
						
						$m .= '<li class = "li_n1">' . $this->Html->link ($secao['nome'], $secao['url'], array('class' => 'texto_grande' . ($essa_secao?' selecionado':'')));
						
						if (isset($this->estrutura_de_secoes_adm['sub_secoes'][$secao['id']]))
						{
							$margem = '';
							if ($secao['id'] == 'olimpiada')
								$margem = 'margin-left: -152px';
							elseif ($secao['id'] == 'grande_desafio')
								$margem = 'margin-left: -20px';
							elseif ($secao['id'] == 'unicamp_itinerante')
								$margem = 'margin-left: -368px';
							$m .= '
							<ul class = "menu_n2' . ($essa_secao ? '' : ' escondido') . '" style="'.$margem.'">';
							
							foreach ($this->estrutura_de_secoes_adm['sub_secoes'][$secao['id']] as $sub_secao)
							{
								$sessao = '';
								switch($sub_secao['id'])
								{
									case 'novidades':
									case 'noticias':
										$sessao = 'sessao_novidades';
										break;
									case 'eventos':
										$sessao = 'sessao_eventos';
										break;
									case 'fotos':
										$sessao = 'sessao_fotos';
										break;
									case 'arquivos':
										$sessao = 'sessao_arquivos';
										break;
									case 'gd_12_':
									case 'gd_11_':
									case 'gd_10_':
									case 'gd_09_':
										$sessao = 'sessao_grande_desafio';
										break;
									case 'oh_01':
									case 'oh_02':
									case 'oh_04':
										$sessao = 'sessao_olimpiada';
										break;
								}
								if ($sessao = 'sessao_grande_desafio' && !$this->JjAuth->can('gd'))
									continue;
								elseif ($sessao = 'sessao_olimpiada' && !$this->JjAuth->can('olimpiada'))
									continue;
								
									
								$essa_sub_secao = in_array($sub_secao['id'], $caminho_de_pao);
								
								if (!isset($sub_secao['url']['controller'])) $sub_secao['url']['action'] = $secao['url']['controller'];
								if (!isset($sub_secao['url']['action'])) $sub_secao['url']['action'] = 'admin_index';
								if (!isset($sub_secao['url']['plugin'])) $sub_secao['url']['plugin'] = false;
								$m .= '
								<li class = "li_n2">' . $this->Html->link($sub_secao['nome'], $sub_secao['url'], array('class' => 'texto_grande' . ($essa_sub_secao?' selecionado':'')));
								
								
								//teste para sub-sub-secao
								
								if (isset($this->estrutura_de_secoes_adm['sub_sub_secoes'][$sub_secao['id']]))
								{
									$m .= '
									<ul class = "menu_n3' . ($essa_sub_secao ? '' : ' escondido') . '">';
									foreach ($this->estrutura_de_secoes_adm['sub_sub_secoes'][$sub_secao['id']] as $sub_sub_secao)
									{
										$essa_sub_sub_secao = in_array($sub_sub_secao['id'], $caminho_de_pao);
										
										$endereco = array();
										
										if (isset($sub_sub_secao['url']['plugin']))
											$endereco['plugin'] = $sub_sub_secao['url']['plugin'];
											
										if (isset($sub_sub_secao['url']['edicao']))
											$endereco['edicao'] = $sub_sub_secao['url']['edicao'];
										
										$endereco['controller'] = isset($sub_sub_secao['url']['controller']) ? $sub_sub_secao['url']['controller'] : $sub_secao['url']['controller'];
										$endereco['action'] = isset($sub_sub_secao['url']['action']) ? $sub_sub_secao['url']['action'] : 'admin_index';

										//debug ($endereco);
										$m .= '
										<li class = "li_n2">' . $this->Html->link($sub_sub_secao['nome'], $endereco, array('class' => 'mais_forte' . ($essa_sub_sub_secao?' selecionado':''))) . '</li>';
									}
									$m .= '
									</ul>
									';
								}
								$m .= '
								</li>
								';
							}
							$m .= '
							</ul>
							';
						}
						$m .= '
						</li>
						';
					}
					$m .= '
					</ul>
				</li>
				';
				}
		$m .='
			</ul>
		';
		return $this->output($m);
	}
	
	/*<p id="caminho_de_pao" class="texto_no_ceu texto_pequeno">Você está em <a href="http://www.mc.unicamp.br/" class="link_texto link_no_ceu">Página inicial</a> > Novidades > <strong class="texto_no_ceu">Arquivo de Notícias de Ciências</strong> </p>*/
	function setinha($caminho_de_pao)
	{
		if ((count($caminho_de_pao) == 0) || (!isset($this->estrutura_de_secoes['sub_secoes'][$caminho_de_pao[0]])))
			return $this->output('');
		else
		{
			$tam_espacozinho = 32;
			$margem = -$tam_espacozinho;
			$tam_espacozinho_inho = 16;
			$segunda_margem = null;
			
			foreach ($this->estrutura_de_secoes['secoes'] as $secao)
			{
				if($secao['id'] == $caminho_de_pao[0])
				{
					$margem += $tam_espacozinho + $secao['largura_px']/2
							+ $secao['ajustezinho_apontador'];
					if ($secao['tem_setinha_no_segundo_nivel'])
					{
						$segunda_margem = -$tam_espacozinho_inho;
						foreach ($this->estrutura_de_secoes['sub_secoes']['atividades'] as $pagina)
						{
							if ($pagina['id'] == $caminho_de_pao[1])
							{
								$segunda_margem += $tam_espacozinho_inho + $pagina['largura_px']/2 + $pagina['ajustezinho_apontador'];
								break;
							}
							$segunda_margem += $tam_espacozinho_inho + $pagina['largura_px'];
						}
					}
					break;
				}
				$margem += $tam_espacozinho + $secao['largura_px'];
			}

			
			return $this->output('
				<div class="apontador centralizar">
					<div class="flechinha" style="margin-left:' . $margem . 'px"></div>
				</div>
				' . ($segunda_margem ? '
				<div class="segundo_apontador centralizar">
					<div class="flechinha" style="margin-left: ' . intval($segunda_margem) .'px"></div>
				</div>' : ''));
		}
	}

	function ondeEstou($caminho_de_pao)
	{
		$oe = '';
		
		if(!count($caminho_de_pao))
			$oe .= 'Você está na página inicial do Museu Exploratório de Ciências';
		else
			$oe .= 'Você está em '  .$this->Html->link('Página inicial', '/', array('class' => 'link_texto link_no_ceu'));
		foreach($caminho_de_pao as $local)
		{
			foreach($this->estrutura_de_secoes['secoes'] as $secao)
				if($secao['id'] == $local)
					$oe .= ' &gt; <strong class="texto_no_ceu">' . $secao['nome'] . '</strong>';
		}

		return $this->output($this->Html->para('texto_no_ceu texto_pequeno', $oe, array('id' => 'caminho_de_pao')));
	}
	
	
	/*
		Exemplo de array de divisorias: 
		$modulos = 12
		$divisorias = array(3, 5);
		
		resultado:
		 nuvem_3m_divisoria_5m_divisoria_4m
		
	*/
	
	
	function nuvem_inicio($modulos, $divisorias = null, $id = null, $classes = null)
	{			
		$n = '<div' . ($id!=null ? (' id="' . $id . '"') : '') . ' class="nuvem nuvem_' . $modulos . 'm'; 
			
		if ($divisorias != null)
		{
			$modulos_faltantes 	  = $modulos;
			$classe_de_divisorias = 'nuvem';
		
			foreach ($divisorias as $intervalo_modulos)
			{
				$classe_de_divisorias .= '_' . $intervalo_modulos . 'm_divisoria';
				$modulos_faltantes -= $intervalo_modulos;
			}
			
			$classe_de_divisorias .= '_' . $modulos_faltantes . 'm';
			
			$n .= ' '. $classe_de_divisorias;
		}
		
		$n .= ($classes!=null ? ' ' .$classes : '') . '">';
		
		$n .=  '<div class="borda">
					<div class="canto topo_esquerda"></div>
					<div class="canto topo_direita"></div>
				</div>';		
		
		return $this->output($n);		
	}
	
	function nuvem_fim()
	{
		$n  = '<div class="borda borda_baixo limpador"><div class="canto base_esquerda limpador"></div><div class="canto base_direita"></div></div>';
		$n .= '</div>';
		
		return $this->output($n);
	}
	
	function nenhuma_novidade_ou_noticia($o_que)
	{
		if ($o_que == 'novidade')
		{
			$n  = '<div class="primeira_novidade limpador"><div class="texto_pequeno texto_rebaixado mais_forte">Nenhuma novidade neste perído</div></div>';
		}
		else
		{
			$n  = '<div class="primeira_novidade limpador"><div class="texto_pequeno texto_rebaixado mais_forte">Nenhuma notícia neste perído</div></div>';
		}
		return $this->output($n);
	}
	
	function quebra_nuvens()
	{
		$n = '<br class="limpador"/>';
		return $this->output($n);
	}
	
	function coluna_de_texto_inicio 
		($modulos, 
		 $modulozinhos_intercolunio = 0,   //margem interna em modulozinhos (padding)
		 $margem = array(0, 0, 0, 0),   //margem externa em modulozinhos (margin)
		 $caracteristicas = array('no_ceu' => false, 'apos_divisor' => false), 
		 $id = null,
		 $classes_adicionais = null,
		 $nome_do_caixote = 'div',
		 $menos_intercolunio = null)
	{	
		$c = '<' . $nome_do_caixote;
		
		if ($id != null)
			$c .= ' id="' . $id . '"';
		
		if ($menos_intercolunio == null)
			$c .= ' class="coluna_de_texto col_' . $modulos . 'm';
		else
			$c .= ' class="coluna_de_texto col_' . $modulos . 'm_' . $menos_intercolunio . 'i';
		
		if ($modulozinhos_intercolunio != 0)
		{	
			$c .= ' col_';
			
			if ($modulozinhos_intercolunio > 1)
				$c .= $modulozinhos_intercolunio;
			
			$c .=  'i';
		}		
		
		if (isset($caracteristicas['no_ceu']) && $caracteristicas['no_ceu'])
			$c .= '_no_ceu';
		
		
		if (isset($caracteristicas['apos_divisor']) && $caracteristicas['apos_divisor'])
			$c .= ' pos_divisor';
		
		if ($classes_adicionais != null)
			$c .= ' ' . $classes_adicionais;	
				
		$c .= '" style="margin: ' . $margem[0] * 10 . 'px ' 
								  . $margem[1] * 10 . 'px ' 
								  . $margem[2] * 10 . 'px '
								  . $margem[3] * 10 . 'px">';
		
		return $this->output($c);
	}
	
	function coluna_de_texto_fim ($nome_do_caixote = 'div')
	{
		return $this->output('</' . $nome_do_caixote . '>');
	}
	
	function quebra_coluna_de_texto ()
	{
		return $this->output('<hr class="limpador separador_i"/>');
	}
	
	function titulo_da_pagina($titulo, $id = null, $classes_adicionais = null)
	{	
		$t = '<h1 class="texto_no_ceu texto_enorme titulo_externo';
		
		if ($classes_adicionais != null)
			$t .= ' ' . $classes_adicionais;
			
		$t .= '"';
			
		if ($id != null)
			$t .= ' id="' . $id . '"';		
			
		$t .= '>' . $titulo . '</h1>';
		return $this->output($t);
	}
	
	function titulo_secao_pagina ($titulo, $img = null, $id = null, $classes_adicionais = null)
	{
		$t = '<h2 class="texto_grande titulo_interno folgado';
		
		if ($img != null)
			$t .= ' nao_quebrar_depois';
		
		if ($classes_adicionais != null)
			$t .= ' ' . $classes_adicionais;
		
		$t .= '"';
			
		if ($id != null)
			$t .= ' id="' . $id . '"';						
			
		$t .= '>' . $titulo . '</h2>';
		
		if ($img != null)
		{
			$t .= '<img src="' . $img . '" alt=""/>';
		}
		
		return $this->output($t);
	}
	
	function titulo_pequeno ($titulo, $vermelho = true, $id = null, $classes_adicionais = null)
	{
		$t = '<h4 class="';
		
		if ($vermelho)
		{	$t .= 'titulo_interno';
		}
		else
		{	$t .= 'mais_forte';
		}
		
		if ($classes_adicionais != null)
			$t .= ' ' . $classes_adicionais;
			
		$t .= '"';
			
		if ($id != null)
			$t .= ' id="' . $id . '"';						
			
		$t .= '>' . $titulo . '</h4>';
		return $this->output($t);
	}
	
	function titulo_caixotao ($titulo, $id = null, $classes_adicionais = null)
	{
		$t =  '<div class="barra_amarela">
					<div class="borda_pequena">
						<div class="canto_pequeno amarelo_topo_esquerda"> </div>
						<div class="canto_pequeno amarelo_topo_direita"> </div>
					</div>';

		$t .= '<h3 class="mais_forte apertado apertado_caixotao';
						
		if ($classes_adicionais != null)
			$t .= ' ' . $classes_adicionais;
		
		$t .= '"';
		
		if ($id != null)
			$t .= ' id="' . $id . '"';
			
		$t .= '>' . $titulo . '</h3>';

		$t .=  	'	<div class="borda_pequena borda_baixo_caixotao a_esquerda_ie">
						<div class="canto_pequeno amarelo_base_esquerda"> </div>
						<div class="canto_pequeno amarelo_base_direita"> </div>
					</div></div>';
				
		return $this->output($t);
	}
	
	function titulo_caixotao_arquivo ($titulo, $id = null, $classes_adicionais = null, $acao = null)
	{
		$t =  '<div class="barra_amarela_arquivo">
					<div class="borda_pequena">
						<div class="canto_pequeno amarelo_topo_esquerda"> </div>
						<div class="canto_pequeno amarelo_topo_direita"> </div>
					</div>';

		$t .= '<ul><li class="li_n3 margenzinha_esquerda apertado_caixotao';
						
		if ($classes_adicionais != null)
			$t .= ' ' . $classes_adicionais;
		
		$t .= '"';
		
		if ($id != null)
			$t .= ' id="' . $id . '">';
		else
			$t .= '">';
		
		for ($a=count($titulo)-1; $a>0; $a--) 
		{
			if ($a == 1)
				$t .= '<span class = "mais_forte">' . $titulo[$a]['titulo'] . '</span>';
			else
				$t .= '<a href="javascript:;" class="link_texto link_acao" onclick="javascript:MostraCategoria('.$titulo[$a]['id'].');">' . $titulo[$a]['titulo'] . '</a> > ';

		}
		
		if ($acao != null) 
			$t .= '<span class="mais_forte"> > ' . $acao . '</span>';
		
		$t .=  	'	</li></ul>
					<div class="borda_pequena borda_baixo_caixotao_arquivo a_esquerda_ie">
						<div class="canto_pequeno amarelo_base_esquerda"> </div>
						<div class="canto_pequeno amarelo_base_direita"> </div>
					</div></div>';
				
		return $this->output($t);

	}
	
	/*
		Estilos diferentes:
		'longo' 					06 de julho de 2010
		'curto' 					06/07/2010
		'curtinho' 					06/07
		'longo_espertinho' 			06 de julho, segunda (ou "06 de julho de 2009, segunda", se não for o ano atual)
		'longo_espertinho_horas'	06 de julho, segunda, às 5h30
		'longo_simples'				06 de julho (ou "06 de julho de 2009, segunda", se não for o ano atual)
		'meses' 					julho (ou "julho de 2009", se não for o ano atual)
		'em_relacao_a_hoje' 		daqui a 3 dias
		'curto_espertinho'			Dia 13, segunda
		'hora_simples'				5h30
		
		a data tem que estar no formata americano aparentemente
	*/
	
	function formata_texto_data ($data, $estilo)
	{	
		$meses = array('01' => 'janeiro',
					   '02' => 'fevereiro',
					   '03' => 'março',
					   '04' => 'abril',
					   '05' => 'maio',
					   '06' => 'junho',
					   '07' => 'julho',
					   '08' => 'agosto',
					   '09' => 'setembro',
					   '10' => 'outubro',
					   '11' => 'novembro',
					   '12' => 'dezembro');
					   
		$numeros = 
				array(
					1 => 'um',
					2 => 'dois',
					3 => 'três',
					4 => 'quatro',
					5 => 'cinco',
					6 => 'seis',
					7 => 'sete',
					8 => 'oito',
					9 => 'nove',
				   10 => 'dez');
		
		$dias_da_semana = 
				array( 
					'Sunday'    => 'domingo',
					'Monday'    => 'segunda',
					'Tuesday'   => 'terça',
					'Wednesday' => 'quarta',
					'Thursday'  => 'quinta',
					'Friday'	=> 'sexta',
					'Saturday'  => 'sábado');
		
		$numeros_dias_da_semana =
				array( 
					'Sunday'    => 1,
					'Monday'    => 2,
					'Tuesday'   => 3,
					'Wednesday' => 4,
					'Thursday'  => 5,
					'Friday'	=> 6,
					'Saturday'  => 7);
					

		
		//$data_vetor = date_parse($data);
		
		$c = '';
		
		//debug($data);
		//die;
		
		$outra_data = strtotime($data);
		
		$data_vetor['day'] = date('d', $outra_data);
		$data_vetor['month'] = date('m', $outra_data);
		$data_vetor['year'] = date('Y', $outra_data);
		$data_vetor['hour'] = date('H', $outra_data);
		$data_vetor['minute'] = date('i', $outra_data);
		
		//debug($data_vetor);
		//die;
		
		
		$outra_data_vetor = getdate(strtotime($data));
		
		/*pr($data_vetor);
		pr($outra_data_vetor); */
		
		//$agora = date_parse(date("Y-m-d H:i:s"));
		
		$agora['day'] = date('d');
		$agora['month'] = date('n');
		$agora['year'] = date('Y');
		$agora['hour'] = date('H');
		$agora['minute'] = date('i');
		
		$outro_agora = getdate();
		
		$c = '';
		
		switch ($estilo)
		{
			case 'longo': 
				$c .= $data_vetor['day'] . ' de ' . $meses[$data_vetor['month']] . ' de ' . $data_vetor['year'];
				break;
				
			case 'curto':
				$c .= $data_vetor['day'] . '/' . $data_vetor['month'] . '/' . $data_vetor['year'];
				break;
			
			case 'curtinho':
				$c .= $data_vetor['day'] . '/' . $data_vetor['month'];
				break;
			
			case 'longo_espertinho':
				$c .= $data_vetor['day'] . ' de ' . $meses[$data_vetor['month']];
				
				if ($data_vetor['year'] != $agora['year'])
					$c .= ' de ' . $data_vetor['year'];
				
				$c .=  ', ' . $dias_da_semana[$outra_data_vetor['weekday']];
				break;
				
			case 'longo_simples':
				$c .= $data_vetor['day'] . ' de ' . $meses[$data_vetor['month']];
				
				if ($data_vetor['year'] != $agora['year'])
					$c .= ' de ' . $data_vetor['year'];
				
				break;
				
			case 'longo_espertinho_horas':
				$c .= $this->formata_texto_data($data, 'longo_espertinho') . ', às '
				   .  $this->formata_texto_data($data, 'hora_simples');				
				break;
				
			case 'curto_espertinho':
				$c .= 'Dia ' . $data_vetor['day'] . ', '. $dias_da_semana[$outra_data_vetor['weekday']];
				break;
			
			case 'meses':
				$c .= $meses[$data_vetor['month']];
				
				if ($data_vetor['year'] != $agora['year'])
					$c .= ' de ' . $data_vetor['year'];
				
				break;
			
			case 'em_relacao_a_hoje':
				
				$diferenca_em_anos  = $data_vetor['year' ] - $agora['year' ];
				$diferenca_em_meses = $data_vetor['month'] - $agora['month'] + $diferenca_em_anos * 12;
				$diferenca_em_dias  = $data_vetor['day'  ] - $agora['day'  ] + $diferenca_em_meses * 30; //primeira aproximação
				
				//debug($diferenca_em_anos);
				//debug($diferenca_em_meses);
				//debug($diferenca_em_dias);
				
				
				
				if ($diferenca_em_meses == 1) //como a diferenca é pequena, importa bastante isto daqui
				{	switch ($agora['month'])
					{	case '1' :
						case '3' :
						case '5' :
						case '7' :
						case '8' :
						case '10':
						case '12':
							$diferenca_em_dias += 1; // meses de 31 dias;
							break;
						case '2' : 
							if (checkdate(2, 29, $agora['year']))  //para anos bissextos
								$diferenca_em_dias -= 1;
							else
								$diferenca_em_dias -= 2;
							break;
						default:  //meses 30 --- para estes meses o cálculo já está correto
							break;
					}
					//debug($diferenca_em_dias);
					//die;
					//break;
					
				}
				elseif ($diferenca_em_meses == -1)
				{	switch ($data_vetor['month'])
					{	case '1' :
						case '3' :
						case '5' :
						case '7' :
						case '8' :
						case '10':
						case '12':
							$diferenca_em_dias -= 1; // meses de 31 dias;
							break;
						case '2' : 
							if (checkdate(2, 29, $data_vetor['year']))  //para anos bissextos
								$diferenca_em_dias += 1;
							else
								$diferenca_em_dias += 2;
							break;
						default:  //meses 30 --- cálculo já está correto
							break;
					}
					//break;
				}
	
				if ($diferenca_em_dias > 0) //compensa o lance de ser sexta, e o outro dia segunda... isto dá uma semana de diferença!!!
					$diferenca_em_semanas = floor(($diferenca_em_dias + $numeros_dias_da_semana[$outro_agora['weekday']] - 1)/ 7); 
				else
					$diferenca_em_semanas = floor(($diferenca_em_dias - $numeros_dias_da_semana[$outra_data_vetor['weekday']] + 1)/ 7);
				
				
				if (abs($diferenca_em_dias) <= 4)
				{
					if ($diferenca_em_dias == 0)
					{	$c .= 'hoje';
					}
					elseif ($diferenca_em_dias == 1)
					{	$c .= 'amanhã';					
					}
					elseif ($diferenca_em_dias == -1)
					{	$c .= 'ontem';
					}
					elseif ($diferenca_em_dias > 1)
					{	$c .= 'daqui a ' . $diferenca_em_dias . ' dias';
					}
					else
					{	$c .= 'há ' . -$diferenca_em_dias . ' dias atrás';
					}
					break;
				}
				
				if (abs($diferenca_em_semanas) <= 5)
				{
					if ($diferenca_em_semanas == 0)
					{	$c .= 'nesta semana';
					}
					elseif ($diferenca_em_semanas == 1)
					{	$c .= 'na próxima semana';					
					}
					elseif ($diferenca_em_semanas == -1)
					{	$c .= 'semana passada';
					}
					elseif ($diferenca_em_semanas > 1)
					{	$c .= 'daqui a ' . $diferenca_em_semanas . ' semanas';
					}
					else
					{	$c .= 'há ' . -$diferenca_em_semanas . ' semanas atrás';
					}
					break;
				}
				
				if ((abs($diferenca_em_meses) > 2) && ($diferenca_em_anos != 0))
				{
					if ($diferenca_em_anos == 1)
					{	$c .= 'ano que vem';					
					}
					elseif ($diferenca_em_anos == -1)
					{	$c .= 'ano passado';
					}
					elseif ($diferenca_em_anos > 1)
					{	$c .= 'daqui a ' . $diferenca_em_anos . ' anos';
					}
					else
					{	$c .= 'há ' . -$diferenca_em_anos . ' anos';
					}
					break;
				}				
				else
				{
					if ($diferenca_em_meses == 0)
					{	$c .= 'neste mês';
					}
					elseif ($diferenca_em_meses == 1)
					{	$c .= 'mês que vem';					
					}
					elseif ($diferenca_em_meses == -1)
					{	$c .= 'mês passado';
					}
					elseif ($diferenca_em_meses > 1)
					{	$c .= 'daqui a ' . $diferenca_em_meses . ' meses';
					}
					else
					{	$c .= 'há ' . -$diferenca_em_meses . ' meses';
					}
					break;
				}
				break;
				
			case 'hora_simples':
				$c .= $data_vetor['hour'] . 'h' . sprintf('%02d', $data_vetor['minute']);
				break;
			
			default:
				$c .= 'helper mexc formata_texto_data: não conheço este estilo';
				break;
		}
		return $c; 
	}
	
	
	function formata_intervalo ($data_inicial, $data_final, $menciona_hora = false, $quebra = true)
	{
		$meses = array( 1 => 'janeiro',
					    2 => 'fevereiro',
					    3 => 'março',
					    4 => 'abril',
					    5 => 'maio',
					    6 => 'junho',
					    7 => 'julho',
					    8 => 'agosto',
					    9 => 'setembro',
					   10 => 'outubro',
					   11 => 'novembro',
					   12 => 'dezembro');
					   
		$numeros = 
				array(
					1 => 'um',
					2 => 'dois',
					3 => 'três',
					4 => 'quatro',
					5 => 'cinco',
					6 => 'seis',
					7 => 'sete',
					8 => 'oito',
					9 => 'nove',
				   10 => 'dez');
		
		$dias_da_semana = 
				array( 
					'Sunday'    => 'domingo',
					'Monday'    => 'segunda',
					'Tuesday'   => 'terça',
					'Wednesday' => 'quarta',
					'Thursday'  => 'quinta',
					'Friday'	=> 'sexta',
					'Saturday'  => 'sábado');
		
		$numeros_dias_da_semana =
				array( 
					'Sunday'    => 1,
					'Monday'    => 2,
					'Tuesday'   => 3,
					'Wednesday' => 4,
					'Thursday'  => 5,
					'Friday'	=> 6,
					'Saturday'  => 7);
					
		
		$agora['day'] = date('d');
		$agora['month'] = date('m');
		$agora['year'] = date('Y');
		$agora['hour'] = date('H');
		$agora['minute'] = date('i');
		
		$c = '';
		
		//debug($data_inicial);
		//die;
		
		$data_vetor_inicial['day'] = date('d', $data_inicial);
		$data_vetor_inicial['month'] = date('n', $data_inicial);
		$data_vetor_inicial['year'] = date('Y', $data_inicial);
		$data_vetor_inicial['hour'] = date('H', $data_inicial);
		$data_vetor_inicial['minute'] = date('i', $data_inicial);
		
		
		
		$data_vetor_final['day'] = date('d', $data_final);
		$data_vetor_final['month'] = date('n', $data_final);
		$data_vetor_final['year'] = date('Y', $data_final);
		$data_vetor_final['hour'] = date('H', $data_final);
		$data_vetor_final['minute'] = date('i', $data_final);
		
		$hora = '';
		$hora_inicial = '';
		$hora_final = '';
		if ($menciona_hora)
		{
			if ($data_vetor_inicial['day'] == $data_vetor_final['day'] && $data_vetor_inicial['month'] == $data_vetor_final['month'] && $data_vetor_inicial['year'] == $data_vetor_final['year'] && $data_vetor_inicial['hour'] == $data_vetor_final['hour'] && $data_vetor_inicial['minute'] == $data_vetor_final['minute'])
				$hora = '';
			else
			{
				if ($data_vetor_inicial['day'] == $data_vetor_final['day'] && $data_vetor_inicial['month'] == $data_vetor_final['month'] && $data_vetor_inicial['year'] == $data_vetor_final['year'])
					$hora = ' das ' . $data_vetor_inicial['hour'] . ':' . $data_vetor_inicial['minute'] . ' às ' . $data_vetor_final['hour'] . ':' . $data_vetor_inicial['minute'];
				else
				{
					$hora_inicial = ' às '.$data_vetor_inicial['hour'] . ':' . $data_vetor_inicial['minute'];
					$hora_final = ' às '.$data_vetor_final['hour'] . ':' . $data_vetor_final['minute'];
				}
					
			}
		}
		
			
		
		if ($data_vetor_inicial['day'] == $data_vetor_final['day'] && $data_vetor_inicial['month'] == $data_vetor_final['month'] && $data_vetor_inicial['year'] == $data_vetor_final['year'])
		{
			if ($agora['year'] == $data_vetor_inicial['year'])
				$c = $data_vetor_inicial['day'] . ' de ' . $meses[$data_vetor_inicial['month']] . $hora;
			else
				$c = $data_vetor_inicial['day'] . ' de ' . $meses[$data_vetor_inicial['month']] . ' de ' . $data_vetor_inicial['year'] . $hora;
		}
		else if ($data_vetor_inicial['month'] == $data_vetor_final['month'] && $data_vetor_inicial['year'] == $data_vetor_final['year'])
		{
			if ($agora['year'] == $data_vetor_inicial['year'])
				$c = $data_vetor_inicial['day'] . $hora_inicial . ' a ' . $data_vetor_final['day'] . ' de ' . $meses[$data_vetor_inicial['month']] . $hora_final;
			else
				$c = $data_vetor_inicial['day'] . $hora_inicial . ' a ' . $data_vetor_final['day'] . ' de ' . $meses[$data_vetor_inicial['month']] . ' de ' . $data_vetor_inicial['year'] . $hora_final;
		}
		else if ($data_vetor_inicial['year'] == $data_vetor_final['year'])
		{
			if ($agora['year'] == $data_vetor_inicial['year'])
				$c = $data_vetor_inicial['day'] . ' de ' . $meses[$data_vetor_inicial['month']] . $hora_inicial . ' a ' . $data_vetor_final['day'] . ' de ' . $meses[$data_vetor_final['month']] . $hora_final;
			else
			{
				if ($quebra)
					$c = $data_vetor_inicial['day'] . ' de ' . $meses[$data_vetor_inicial['month']] . ' de ' . $data_vetor_inicial['year'] . $hora_inicial . '<br />a ' . $data_vetor_final['day'] . ' de ' . $meses[$data_vetor_final['month']] . ' de ' . $data_vetor_inicial['year'] . $hora_final;
				else
					$c = $data_vetor_inicial['day'] . ' de ' . $meses[$data_vetor_inicial['month']] . ' de ' . $data_vetor_inicial['year'] . $hora_inicial . ' a ' . $data_vetor_final['day'] . ' de ' . $meses[$data_vetor_final['month']] . ' de ' . $data_vetor_inicial['year'] . $hora_final;
			}
		}
		else
		{
			if ($quebra)
				$c = $data_vetor_inicial['day'] . ' de ' . $meses[$data_vetor_inicial['month']] . ' de ' . $data_vetor_inicial['year'] . $hora_inicial . '<br />a ' . $data_vetor_final['day'] . ' de ' . $meses[$data_vetor_final['month']] . ' de ' . $data_vetor_final['year'] . $hora_final;
			else
				$c = $data_vetor_inicial['day'] . ' de ' . $meses[$data_vetor_inicial['month']] . ' de ' . $data_vetor_inicial['year'] . $hora_inicial . ' a ' . $data_vetor_final['day'] . ' de ' . $meses[$data_vetor_final['month']] . ' de ' . $data_vetor_final['year'] . $hora_final;
				
		}
		
		return $c; 
	}
	
	
	
	function data ($data, $estilo, $id = null, $classes_adicionais = null, $texto_normal = false, $funcao_data = true)
	{	
		$c = '<span';
		
		if ($id != null)
			$c .= ' id="' . $id . '"';
		
		$c .= ' class="';
		
		if (!$texto_normal)
			$c .= 'texto_pequeno mais_forte';
				
		if ($classes_adicionais != null)
			$c .= ' ' . $classes_adicionais;
		
		$c .= '">';
		
		if ($funcao_data)
			$c .= $this->formata_texto_data($data, $estilo);
		else
			$c .= $data;
		
		$c .= '</span>';
		
		return $this->output($c);
	}
	
	
	
	/* tipos diferentes:
		'interno', 'externo', 'maiszinho'
		
		array 
		$parametros ('title' => , 'url' => ,  'htmlAttributes' => , '',  )
	*/
	
	function linque($endereco, $texto, $tipo = 'interno', $id = null, $classes_adicionais = null, $confirm = null)
	{
		$c = '';
		if($tipo == 'maiszinho' || $tipo == 'maiszinho_gd')
			$c .= '<div class="modulo_inferior">';
			
		$class = '';
			
		switch ($tipo)
		{
			case 'interno':
				$class .= 'link_texto link_em_nuvem';
				break;
			case 'externo':
				$class .= 'link_texto externo link_em_nuvem';
				break;
			case 'maiszinho':
				$class .= 'link_texto link_mais';
				break;
			case 'maiszinho_gd':
				$class .= 'link_texto link_mais_gd';
				break;
			case 'no_ceu':
				$class .= 'link_texto link_no_ceu';
				break;
			case 'acao':
				$class .= 'link_texto link_acao';
				break;
			case 'rodape':
				$class .= 'link_texto link_rodape caps';
				break;
			case 'preface':
				$class .= 'link_texto link_preface';
				break;
		}
				
		if ($classes_adicionais != null)
			$class .= ' ' . $classes_adicionais;
			
		$atributos_html = array();
		if ($class)
		{
			$atributos_html['class'] = $class;
		}
		
		if ($id)
		{
			$atributos_html['id'] = $id;
		}
		
		$c .= $this->Html->link($texto, $endereco, $atributos_html, $confirm, true);
		
		if($tipo == 'maiszinho' || $tipo == 'maiszinho_gd')
			$c .= '</div>';
	
		return $this->output($c);
	}
	
	function agencia_de_noticias($texto, $id = null, $classes_adicionais = null, $span_ou_div = 'span')
	{
		$c = '<'.$span_ou_div;
		
		if ($id != null)
			$c .= ' id="' . $id . '"';
			
		$c .= ' class="caps texto_rebaixado mais_forte';
		
		if ($classes_adicionais != null)
			$c .= ' ' . $classes_adicionais;
		
		$c .= '">' . $texto . '</'.$span_ou_div.'>';				
		
		return $this->output($c);
	}
		
	//Muito boa a função Xuxa, só
	//tirei o primeiro, e corrigi um pouco o negócio!
	//por padrão agora coloca o primeiro parágrafo!!!
	
	function paragrafos($txt, $classes_adicionais = null, $sem_paragrafo = false)
	{
		$nTxt = explode("\n", $txt);


		if (!$sem_paragrafo)
		{
			$txt = "";
			$primeiro_p = '<p class="limpador primeiro_paragrafo texto' . ($classes_adicionais != null ? ' ' . $classes_adicionais .'">' : '">');
			$p = '<p class="texto ' . ($classes_adicionais != null ? ' ' . $classes_adicionais  . '">' : '">');
			
			for ($i = 0; $i < sizeof($nTxt); $i++)
			{
				if (strlen($nTxt[$i]) > 1)
				{
					$txt .= ($i == 0 ? $primeiro_p : $p) .  htmlentities(str_replace("\r", "", $nTxt[$i]), ENT_COMPAT, "UTF-8") . "</p>\n";
				}
			}
		}
		//return $txt;
		$nTxt = $txt;
		$novoTxt = $txt;
		
		$total = strlen($nTxt)-7;
		$i = 0;
		while ($i <= $total)
		{	
			if (substr($novoTxt, $i, 7) == 'http://')
			{
				$cont = 0;
				for ($a = $i+7; $a < strlen($novoTxt); $a++)
				{
					$cont++;
					$t = substr($novoTxt, $a, 1);
					if ($t == ' ' || $t == '<' || $t == ',' || $t == ')')
					{
						break;
					}
				}
				$anterior = strlen($novoTxt)-7;
				//debug($i);
				//debug(substr($novoTxt, $i, $a - $i));
				$novo_link = '<a class="link_texto link_em_nuvem" href="'.substr($novoTxt, $i, $a - $i).'">' . substr($novoTxt, $i, 17) . '...</a>';
				$txt = str_replace(substr($novoTxt, $i, $a - $i), $novo_link, $novoTxt);
				$novoTxt = $txt;
				$total = strlen($novoTxt) - 7;
				$i = $i + ($total - $anterior) + $cont;
				//debug($cont);
				//pr($txt);
			}
			$i++;
		}
		return $txt;
	}
	
	function nuvens_no_ceu($caminho_de_pao = null)
	{
		
		// definições das nuvens
		
		$primeiro_andar['inicio'] = -1;
		$primeiro_andar['fim'] = 14;
		$primeiro_andar['n_nuvens'] = 3;

		$segundo_andar = null;
		
		$estrutura = null;
		$pagina_atual = -1;
		
		// acha o índice mais profundo, mas padroniza
		// a maneira de alcançar seus dados, para que
		// seja necessário apenas um tipo de foreach

		
		if (isset($caminho_de_pao[1]))
		{
			$estrutura = $this->estrutura_de_secoes['sub_secoes'][$caminho_de_pao[0]];
			$pagina_atual = $caminho_de_pao[1];
		}
		elseif (isset($caminho_de_pao[0]))
		{
			$estrutura = $this->estrutura_de_secoes['secoes'];
			$pagina_atual = $caminho_de_pao[0];
		} 
			else 
			{
				$pagina_atual = "Página Inicial";
				$estrutura = array(array('id' => $pagina_atual, 'segundo_andar'=>array('fim_esquerda'=> 3,'altura' => 400)));
			}
		
		/*echo '<!--';
		print_r($caminho_de_pao);
		print_r($estrutura);
		print_r($pagina_atual);
		echo '-->';*/

		if ($estrutura)
		{
			foreach ($estrutura as $sub_secao)
			{
				if ($sub_secao['id'] == $pagina_atual && isset($sub_secao['segundo_andar']))
				{
					// O que não foi declarado receberá um valor padrão
					$segundo_andar = array();
					$segundo_andar['n_nuvens'] = isset($sub_secao['segundo_andar']['n_nuvens']) ? $sub_secao['segundo_andar']['n_nuvens'] : 2;
					$segundo_andar['inicio_esquerda'] = isset($sub_secao['segundo_andar']['inicio_esquerda']) ? $sub_secao['segundo_andar']['inicio_esquerda'] : -3;
					$segundo_andar['fim_esquerda'] = isset($sub_secao['segundo_andar']['fim_esquerda']) ? $sub_secao['segundo_andar']['fim_esquerda'] : 0;
					$segundo_andar['inicio_direita'] = isset($sub_secao['segundo_andar']['inicio_direita']) ? $sub_secao['segundo_andar']['inicio_direita'] : 12;
					$segundo_andar['fim_direita'] = isset($sub_secao['segundo_andar']['fim_direita']) ? $sub_secao['segundo_andar']['fim_direita'] : 12;
					$segundo_andar['altura'] = isset($sub_secao['segundo_andar']['altura']) ? $sub_secao['segundo_andar']['altura'] : 300;
				}
			}
		}
		

		
		$nuvens = array(
			0 => array('class' => 'nuvem_p',  'imagem' => '/img/img_layout/nuvem_p.png', 'largura' => 94,  'altura' => 38),
			1 => array('class' => 'nuvem_m',  'imagem' => '/img/img_layout/nuvem_m.png', 'largura' => 130, 'altura' => 52),
			2 => array('class' => 'nuvem_g',  'imagem' => '/img/img_layout/nuvem_g.png', 'largura' => 174, 'altura' => 68),
			3 => array('class' => 'nuvem_gg', 'imagem' => '/img/img_layout/nuvem_gg.png', 'largura' => 228, 'altura' => 88) 
		);

		$modulo = 80;
		$base = 0;
		$altura_primeiro_andar = 250;

		$n = '
		<div id="e_aqui_vao_as_nuvens">
		';
		
		
		// primeiro andar
		$maiores_na_frente = 0;
		for ($i = 0; $i < $primeiro_andar['n_nuvens']; $i++)
		{
			$nuvem = $maiores_na_frente;
			$maiores_na_frente += (!rand(0,2) && $maiores_na_frente < 3 ? 1 : 0 ); // vai aumentando o tamanho... mas impede duma nuvem pequena estar na frente duma grande
			
			/* para posicionar absolutamente,
			   é preciso subtrair metade da largura:
				 - $modulo * 6
			*/
			$x = rand($primeiro_andar['inicio']*$modulo,$primeiro_andar['fim']*$modulo)  -  $nuvens[$nuvem]['largura'] / 2  + rand(-$modulo/4,$modulo/4);			
			$y = $altura_primeiro_andar - rand($base + $nuvens[$nuvem]['altura'], $base + $altura_primeiro_andar);

			$n .= '<div class="'.$nuvens[$nuvem]['class'].'" style="'.($i==0?'':'margin-top:-'.strval($altura_primeiro_andar).'px; ').' 
			height: '.strval($altura_primeiro_andar).'px; width: 100%; background-position: '.strval($x).'px '.strval($y).'px"></div>
			';
		}

		
		if ($segundo_andar)
		{
		
			$delta_esquerda = $segundo_andar['fim_esquerda'] - $segundo_andar['inicio_esquerda'];
			$delta_direita = $segundo_andar['fim_direita'] - $segundo_andar['inicio_direita'];
			$chance_esquerda = $delta_esquerda / ($delta_direita + $delta_esquerda)  * 100;
			
			for ($i = 0; $i < $segundo_andar['n_nuvens']; $i++)
			{
				$nuvem = rand(0,1); // só nuvens p e m no segundo andar
				$onde = rand(0, 100);				
				if ($onde <= $chance_esquerda) {
					$x = rand($segundo_andar['fim_esquerda'], $segundo_andar['inicio_esquerda']);
					$x = $x * $modulo  -  $nuvens[$nuvem]['largura']  -  $modulo * 6  - rand(0, $modulo/2);
				}
				else {
					
					$x = rand($segundo_andar['inicio_direita']*$modulo, $segundo_andar['fim_direita']*$modulo - $nuvens[$nuvem]['largura']);
					$x -= $modulo * 6;
				}
				
				$y = - rand($nuvens[$nuvem]['altura'], $segundo_andar['altura']);
				
				$n .= '
					<div class="'.$nuvens[$nuvem]['class'].'" 
					style="position: absolute; top: '. strval($y) .'px; left: 50%; margin-left: '.strval($x).'px;"></div>
				';
				/*$n .= '<div class="'.$nuvens[$nuvem]['class'].'" style="margin-top:-'.strval($segundo_andar['altura']+($i==0?$altura_primeiro_andar:0)).'px; 
				border: 1px solid black; height: '.strval($segundo_andar['altura']).'px; width: 100%; background-position: '.strval($x).'px '.strval($y).'px"></div>
				';*/

			}
		}
		/*
		isto aqui evita o problema de nuvens na frente do observatório, mas
		estava criando problemas maiores, resolvi tirar e limitar a altura mínima das nuvens...
		<div style="width: 100%; text-align: center;">		
				<div class="centralizar" style="width: 950px; background:url(/img/img_layout/observatorio.gif) no-repeat 20px bottom; height: 53px;"></div>
			</div>*/
		$n .= '
			
		</div>
		';
				
		return $this->output($n);
	}	
	
};







?>
