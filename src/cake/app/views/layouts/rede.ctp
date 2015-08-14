<?php
$body_content = $this->element(
	$layout_scheme.'_layout', 
	array(
		'plugin' => 'typographer',
		'content_for_layout' => $content_for_layout
	)
);

echo $this->Html->doctype();
echo $this->Bl->shtml(array(
		'xmlns' => 'http://www.w3.org/1999/xhtml',
		'xml:lang' => 'pt-br',
		'lang' => 'pt-br'
	)
);

	echo $this->Bl->shead();
		echo $this->Html->charset();
	    echo '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
		echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
		echo $this->Bl->title(null, null, $title_for_layout);
		echo $this->Bl->link(array(
				'rel' => 'shorcut icon',
				'href' => '/favicon.ico'
			)
		);	
		//echo $this->Decorator->css(array(
				//'scheme' => 'rede'
			//)
		//);
		
		if (isset($currentSpace))
		{
			echo $this->Decorator->css(array(
				'scheme' => 'rede',
				'subscheme' => $currentSpace
			)
		);
		}

		echo '<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
			    <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
				    <!--[if lt IE 9]>
					      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->';
		
		// if dev, use local
	if (Configure::read('debug') == 0) {
		echo '
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
			<!-- Optional theme
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
 -->
			<!-- Latest compiled and minified JavaScript -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
';
	} else {
		echo '<link href="/css/bootstrap.min.css" rel="stylesheet">';
		//echo '<link href="/css/bootstrap-theme.css" rel="stylesheet">';
		echo'<script src="/js/jquery.min.js"></script>';
		echo '<script src="/js/bootstrap.min.js"></script>';
	}

		echo $this->Html->script('ralsp');
		echo $this->Decorator->css('/css/default.css');
		echo $this->Decorator->css(
			'instant.css',
			'inline'
		);
		echo $scripts_for_layout;
		
	echo $this->Bl->ehead();
	echo $this->Bl->sbody();
		echo $body_content;
		
		// Google Analytics - only on server
		if ($_SERVER['SERVER_NAME']=='ralsp.org'):
			?>
			<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
						  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

				  ga('create', 'UA-63552431-1', 'auto');
				  ga('send', 'pageview');

				  </script>
			<?php
		endif;
	echo $this->Bl->ebody();
echo $this->Bl->ehtml();
//if (Configure::read('debug') > 0)
	//echo $this->element('sql_dump');
