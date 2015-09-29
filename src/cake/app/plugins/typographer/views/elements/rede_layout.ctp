<?php
echo $this->Bl->sdiv(array('class' => 'row'), array());
	echo $this->Bl->sdiv(array('class' => 'col-md-1 col-xs-12'), array());
		echo $bl->menuBt(array(), array('menuLevel' => 2));
	echo $this->Bl->ediv();
	echo $this->Bl->sdiv(array('class' => 'col-md-11 col-xs-12'), array());
		echo $this->Bl->sdiv(array('id' => 'main'), array());
			echo $this->Bl->sdiv(array('class' => 'body'), array());
				echo $this->Bl->sdiv(array('class' => 'container'), array()); ?>
					<div class="w-form search">
						<form class="" id="search-form" name="search-form" data-name="Search Form">
							<input class="w-input input-search" id="search" type="text" name="search" data-name="search">
								<div class="bot-o-submit-search">
							</div>
						</form>
					</div>
<?php
					echo $content_for_layout;	
				echo $this->Bl->ediv(); // container
			echo $this->Bl->ediv(); // body
		echo $this->Bl->sdiv(array('class' => 'footer'), array());
				echo $this->Bl->sdiv(array('class' => 'container'), array());
					echo $this->Bl->sdiv(array('class' => 'row'), array());
						echo $this->Bl->sdiv(array('class' => 'col-md-7 col-xs-12'), array());
							echo $this->Bl->sdivDry();
								echo $this->Bl->h4(array(), array(), 'Apoio & Patrocínio');
								echo $this->Bl->sul(array('class' => 'clearfix support-list'), array());
									echo "<img src=/img/ECOFORTE.jpg >";
								echo $this->Bl->eul();
							echo $this->Bl->ediv();
							echo $this->Bl->sdivDry();
								echo $this->Bl->h4(array(), array(), 'parcerias');
								echo $this->Bl->sul(array('class' => 'clearfix partners-list'), array());
									echo $this->Bl->liDry('Área reservada para parceiros');
								echo $this->Bl->eul();
							echo $this->Bl->ediv();
						echo $this->Bl->ediv();
						echo $this->Bl->sdiv(array('class' => 'col-md-5 col-xs-12'), array());
							echo $this->Bl->h4(array(), array(), 'a rede');
							echo $this->Bl->pDry("A Rede Regional de Agroecologia Mantiqueira-Mogiana é formada por agricultores, técnicos e pesquisadores que têm como objetivo comum a busca pelo desenvolvimento e aprimoramento da agricultura de base ecológica");
							echo $this->Bl->sul(array('class' => 'rede unlisted clearfix'), array());
								echo $this->Bl->li(array(), array(), 
									$this->Bl->anchor(array('class' => 'rede unit'), array(), 'Unidades de referência'));
								echo $this->Bl->li(array(), array(), 
									$this->Bl->anchor(array('class' => 'rede','href' => ''), array( ), 'Membros'));
								echo $this->Bl->li(array(), array(), 
									$this->Bl->anchor(array('class' => 'rede'), array(), 'Contato'));
							echo $this->Bl->eul();
							echo $this->Bl->pDry('Site desenhado por <a class="rede" target="_blank" href="http://www.preface.com.br">Preface design</a>, e construído por&nbsp;<a class="rede" target="_blank" href="http://amaroli.com.br/">Amaroli</a>. Fundo adaptado de um padrão encontrado em <a class="rede" target="_blank" href="http://subtlepatterns.com">subtlepatterns.com</a>');
						echo $this->Bl->ediv();
					echo $this->Bl->ediv();
				echo $this->Bl->ediv();
		echo $this->Bl->ediv();
		echo $this->Bl->ediv();
	echo $this->Bl->ediv();
echo $this->Bl->ediv();
