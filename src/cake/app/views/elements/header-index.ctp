<?php
echo $this->Bl->floatBreak();
echo $this->Bl->srow(array('class' => 'pages '.$slug));
	echo $this->Bl->sboxContainer(array('class' => "header col-xs-12"), array());
		echo $this->Bl->sdiv(array('class' => 'header-data'), array());
			echo $this->Bl->h1(array(), array(), "Rede de Agroecologia<br>do Leste Paulista e Alta Mogiana");
			echo $this->Bl->h1(array('class' => 'title'), array(), $title);
		echo $this->Bl->ediv();
	echo $this->Bl->eboxContainer();
echo $this->Bl->erow();
