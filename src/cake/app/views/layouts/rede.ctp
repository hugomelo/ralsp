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
		echo $this->Bl->title(null, null, $title_for_layout);
		echo $this->Bl->link(array(
				'rel' => 'shorcut icon',
				'href' => '/favicon.ico'
			)
		);	
		echo $this->Decorator->css(array(
				'scheme' => 'rede'
			)
		);
		
		if (isset($currentSpace))
		{
			echo $this->Decorator->css(array(
				'scheme' => 'rede',
				'subscheme' => $currentSpace
			)
		);
		}
		
		echo $this->Decorator->css(
			'instant.css',
			'inline'
		);
		echo $scripts_for_layout;
		
	echo $this->Bl->ehead();
	echo $this->Bl->sbody();
		echo $body_content;
		
		// Google Analytics
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
