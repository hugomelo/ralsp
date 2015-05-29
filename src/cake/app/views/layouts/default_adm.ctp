<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php 
	//pega o primeiro nome do usuário logado
	if($session->check('Usuario'))
		$nome_completo = explode(' ', trim($session->read('Usuario.nome')));
?>

<html xmlns = "http://www.w3.org/1999/xhtml"  xml:lang = "pt-br"  lang = "pt-br">
	<head>
		<title><?php echo $title_for_layout . ' - Administração do Site';?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" href="/img/img_layout/favicon_admin.ico" />
		<?php echo $html->css('/paineladmin/css/adm.css', null, array('media' => 'screen, projection')); ?>
		<?php echo $html->css('/popup/css/popup.css', null, array('media' => 'screen, projection')); ?>
		
		<!--[if lte IE 6]>
			<?php echo $html->css('/paineladmin/css/adm_ie.css'); ?>
			
		<![endif]-->
		<!--[if IE 7]>
			<?php echo $html->css('/paineladmin/css/adm_ie7.css'); ?>
			
		<![endif]-->
		<?php
		echo $javascript->link('/paineladmin/js/protoaculous.js');
		echo $javascript->link('/paineladmin/js/script.js');
		echo $scripts_for_layout;
		
		if(isset($onde_estamos[0]))
		{
			switch($onde_estamos[0])
			{
				case 'grande_desafio':
					echo $html->css('/grandedesafio/css/admin.css');
				break;
				
				case 'olimpiada':
					echo $html->css('/olimpiada/css/admin.css?12');
				break;
			}
		}
		?>
	</head>

	<body>
		<?php
		
		if (isset($aviso_manutencao))
		{
			echo '<div style="font-size: 20px; font-weight:bold; line-height: 40px; text-align: left; color:white; background-color: red;">' . $aviso_manutencao . '</div>';
			echo '<br class="limpador"/>';
		}		
		?>
	
		<p class="escondido"><a href="#fim_da_navegacao">Pular navegação</a></p>
		
		<div id = "container">
			<div id = "menu">
				<div id = "ola">
					<h1 class = "texto_grande texto_rebaixado">Página Administrativa</h1>
					<?php if($session->check('Usuario')):?>
					<span class = "texto_rebaixado">Olá <?php echo $nome_completo[0];?>, você entrou às <?php echo $session->read('Hora') . ' de ' . $session->read('DataEntrada') . ', ' . $html->link('sair',array('controller' => 'usuarios', 'plugin' => 'paineladmin', 'action' => 'admin_sair'), array('class' => 'link_texto link_em_nuvem mais_forte'));?></span>
					<?php endif;?>
				</div>
				<?php 
				if (!isset($onde_estamos))
					$onde_estamos = array();
				
				/*
				if($session->read('Usuario.tipo_usuario') == 'megapower')
					$permissao = 'su';
				else
					$permissao = $session->read('Usuario.permissoes');
				*/
				echo $mexc->geraMenuAdmin($onde_estamos);
				?>
				<a name="fim_da_navegacao"></a>
			</div>
			<div id = "<?php echo isset($onde_estamos[3]) ? 'conteudo_arquivo' : (isset($id_conteudo) ? $id_conteudo : 'conteudo');?>">
				<?php
					if(isset($onde_estamos[3])){?>
					<div id = "conteudo_topo2">
						<ul class="coluna_direita">
							<li class = "mais_forte"><?php echo $onde_estamos[3];?></li>
						</ul>
					</div>
				<?php } ?>
				<?php echo $content_for_layout;?>
			</div>
			<br />
			<br />
		</div>
		<script type="text/javascript">
			var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
			document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		var pageTracker = _gat._getTracker("UA-1711136-7");
			pageTracker._initData();
			pageTracker._trackPageview();
		</script>
	</body>
</html>
