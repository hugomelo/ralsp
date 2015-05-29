<?php
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
		
		
		echo $this->Decorator->css(
			'instant.css',
			'inline'
		);
		echo $scripts_for_layout;
		
		
	echo $this->Bl->ehead();
	echo $this->Bl->sbody();
		echo $content_for_layout;
	echo $this->Bl->ebody();
echo $this->Bl->ehtml();
