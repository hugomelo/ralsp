<?php
echo $this->Bl->floatBreak();
echo $this->Bl->srow(array('class' => 'pages '.$slug));
	echo $this->Bl->sboxContainer(array('class' => "header col-xs-12"), array());
		echo $this->Bl->sdiv(array('class' => 'header-data'), array());
			if (is_array($breadcrumb)) {
				$c = count($breadcrumb);
				$section = $pageSections[$ourLocation[0]]['subSections'];
				foreach($breadcrumb as $k => $crumb) {
					if ($k == 0 || $k == $c-1) continue;
					echo $this->Bl->p(array('class' => 'bread-crumb'), array(),
						$this->Bl->anchor(array('class' => 'link-vsky' ), array('url' => $section[$ourLocation[$k]]['url']), $crumb));
					echo $this->Bl->p(array('class' => 'bread-crumb'), array(), '/');
					$section = $section[$ourLocation[$k]]['subSections'];
				}
			}
			echo $this->Bl->h1(array(), array(), $title);
		echo $this->Bl->ediv();
	echo $this->Bl->eboxContainer();
echo $this->Bl->erow();

