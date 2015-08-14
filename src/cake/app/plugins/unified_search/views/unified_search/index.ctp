<?php

/**
 * @var string[] $baseParams
 * @var string[] $searchData
 * @var array[] $data
 * $var Grid $hg
 */
$isAjax = isset($this->params['isAjax']) && $this->params['isAjax'] === true;
if ($isAjax) {
	echo $this->Jodel->insertModule('UnifiedSearch.SblUnifiedSearch', array('view', 'index_listing'), $data);
	return;
}

echo $this->Bl->sboxContainer(array('id' => 'search_header'),array('size' => '12M'));
	
	echo $this->Bl->sform(array(
		'name' => 'search-form', 
		'id' => 'search-form', 
		'action' => Router::url(array()),
		'method' => 'GET',
	)); {

		if (!empty($baseParams['tipos'])) {
			echo $this->Bl->input(array(
				'type' => 'hidden',
				'name' => 'tipos',
				'value' => $baseParams['tipos']
			));
		}

		{ echo $this->Bl->sbox(array('class' => 'search_box'),array('size' => '12M-g'));
			echo $this->Bl->input(array(
				'class' => 'search_input',
				'autocomplete' => 'off',
				'type' => 'text',
				'name' => 'termos',
				'value' => isset($searchData['termos']) ? $searchData['termos'] : '',
				'placeholder' => __d('cn', 'Digite os termos para efetuar sua busca', true)
			));

			echo $this->Bl->buttonDry(
				$this->Bl->abbr(
					array('class' => 'glass', 'title' => __d('cn', 'Busca', true)), null, '&#59395;'
				)
			);
		} echo $this->Bl->ebox();
		echo $this->Bl->floatBreak();

		echo $this->Bl->h3Dry('Filtros:');

		{ echo $this->Bl->sbox(array(),array('size' => '8M-g'));
			echo $this->element('theme_interface', array('plugin' => 'unified_search'));
		} echo $this->Bl->ebox();

		$ordem = isset($this->params['url']['periodo_e_ordem']) ? $this->params['url']['periodo_e_ordem'] : '';
		echo $this->Bl->sbox(array('class' => 'order_themes'),array('size' => '4M-g-2u'));
			echo $this->Form->input('order-filter', array(
				'options' => array(
					'mais_relevantes' => 'Mais relevantes',
					'mais_recentes' => 'Mais recentes',
					'mais_antigos' => 'Mais antigos',
					'ultimo_mes' => 'Último mes',
					'ultima_semana' => 'Última semana',
					'ultimo_ano' => 'Último ano'
				),
				'label' => false,
				'name' => 'periodo_e_ordem',
				'selected' => $ordem
			));
		echo $this->Bl->ebox();
		echo $this->Bl->floatBreak();

	{ echo $this->Bl->sbox(array(), array('size' => '12M-g'));
		echo $this->Bl->button(array('class' => 'search_submit dark'), array(), 'Pesquisar');
	} echo $this->Bl->ebox();

		if (empty($data['hitCount']) || empty($searchData['termos'])) {
			if (!empty($searchData['termos'])) {
				echo $this->Bl->box(
					array('class' => 'results'),array('size' => '12M-g'),
					$this->Bl->span(
						array('class' => 'desc_results'), array(),
						__d('cn', sprintf('Nenhum resultado encontrado para "%s"', h($searchData['termos'])), true)
					)
				);
			}
		}
		else {
		
			$types = array(
				'cidade_informa' => 'Cidade Informa',
				'cidade_inova'   => 'Cidade Inova',
				'cidade_inspira' => 'Cidade Inspira',
				'cidade_instiga' => 'Cidade Instiga',
				'mediateca' => 'Mediateca',
				'revista' => 'Revista',
				'product' => 'Livro'
			);
			
			$hits = Set::combine($data['hitCount'], '/SblSearchItem/type','/SblSearchItem/hits');

			echo $this->Bl->box(array(), array('size' => '12M-g'), $this->Bl->hr(array('class' => 'light')));
			echo $this->Bl->sbox(array('class' => 'results'),array('size' => '12M-g'));
				{ echo $this->Bl->sdiv(array('class' => 'areas'));
					$currentTypes = false;
					if (!empty($baseParams['tipos'])) {
						$currentTypes = explode('-', $baseParams['tipos']);
					}
					$lowered = $currentTypes && !in_array('todos', $currentTypes);

					$params = $baseParams;
					unset($params['tipos']);
					echo $this->Bl->anchor(
						array('class' => $lowered ? 'lowered' : ''),
						array('url' => array('?' => $params)),
						'Todos'
					);
					echo $this->Bl->span(
						array('class' => 'count' . ($lowered ? ' lowered' : '')), array(),
						'(' . (array_sum($hits)) . ')'
					);
					unset($params);

					foreach ($types as $type => $typeName) {
						$lowered = !$currentTypes || !in_array($type, $currentTypes);
						echo $this->Bl->anchor(
							array('class' => $lowered ? 'lowered' : ''),
							array('url' => array('?' => array('tipos' => $type) + $baseParams)),
							$typeName
						);
						echo $this->Bl->span(
							array('class' => 'count' . ($lowered ? ' lowered' : '')), array(),
							'(' . (isset($hits[$type])? $hits[$type] : 0) . ')'
						);
					}
				} echo $this->Bl->ediv();
				
				if ($this->Paginator->counter('%pages%') > 1) {
					$text = $this->Paginator->counter('%count% resultados encontrados para "%s", divididos em %pages% páginas');
				}
				else {
					if ($this->Paginator->counter('%count%') == 1) {
						$text = $this->Paginator->counter('Um resultado encontrado para "%s"');
					}
					else {
						$text = $this->Paginator->counter('%count% resultados encontrados para "%s"');
					}
				}

				echo $this->Bl->span(
					array('class' => 'desc_results'), array(),
					__d('cn', sprintf($text, h($searchData['termos'])), true)
				);
				
			echo $this->Bl->ebox();
			echo $this->Bl->floatBreak();
		}

	} echo $this->Bl->eform();
echo $this->Bl->eboxContainer();
echo $this->Bl->floatBreak();

$containerId = uniqid('a');
if (!empty($data['hitCount'])) {
	echo $this->Bl->sboxContainer(array('id' => 'search_results'),array('size' => '12M'));
	echo $this->Bl->boxContainer(
		array('class' => 'infinite-content', 'id' => $containerId), array('size' => '12M'),
		$this->Jodel->insertModule('UnifiedSearch.SblUnifiedSearch', array('view', 'index_listing'), $data)
	);
	echo $this->Bl->floatBreak();
	echo $this->Bl->eboxContainer();
	echo $this->Bl->floatBreak();
}


//ADVANCED LAYER
echo $this->Bl->sboxContainer(
	array('id' => 'advanced_layer', 'style' => 'display:none'),
	array('size' => '12M-g')
);
	echo $this->Bl->sdiv(array('class' => 'period'),array('size' => '12M-g-m'));
		echo $this->Bl->sbox(array(),array('size' => 'M-g'));
			echo $this->Bl->h3Dry(__d('cn', 'Período:', true));
		echo $this->Bl->ebox();
		echo $this->Bl->sbox(array(),array('size' => '5M'));
			echo $this->Bl->h4Dry(__d('cn', 'Início', true));
			echo $this->Form->input('BeginYear',
				array(
					'type' => 'select',
					'label' => false,
					'div' => false,
					'options' => array('0' => 'Todos os anos')
				)
			);
			echo $this->Form->input('BeginMonth',
				array(
					'type' => 'select',
					'label' => false,
					'div' => false,
					'options' => array('0' => 'Todos os meses')
				)
			);
			echo $this->Form->input('BeginDay',
				array(
					'type' => 'select',
					'label' => false,
					'div' => false,
					'options' => array('0' => 'Todos os dias')
				)
			);
		echo $this->Bl->ebox();
		echo $this->Bl->sbox(array(),array('size' => '5M'));
			echo $this->Bl->h4Dry(__d('cn', 'Fim', true));
			echo $this->Form->input('EndYear',
				array(
					'type' => 'select',
					'label' => false,
					'div' => false,
					'options' => array('0' => 'Todos os anos')
				)
			);
			echo $this->Form->input('EndMonth',
				array(
					'type' => 'select',
					'label' => false,
					'div' => false,
					'options' => array('0' => 'Todos os meses')
				)
			);
			echo $this->Form->input('EndDay',
				array(
					'type' => 'select',
					'label' => false,
					'div' => false,
					'options' => array('0' => 'Todos os dias')
				)
			);
		echo $this->Bl->ebox();
		echo $this->Bl->floatBreak();
	echo $this->Bl->ediv();
echo $this->Bl->eboxContainer();

echo $this->Js->writeBuffer();


$this->Html->script('masonry.pkgd.min.js', array('inline' => false));
?>

<script type="application/javascript">
!function ($, containerId, width) {
	var count = 1, container, jDoc = $(document),
		linkClick = function (ev) {
			if (count < 6) {
				ev.preventDefault();
				var link = $(ev.target);
				if (!link.hasClass('disabled')) {
					link.addClass('disabled');
					count++;
					loadContent(link);
				}
			}
		},
		loadContent = function (link) {
			$.get(link.attr('href'), {}, function (data) {
				container.append(data = $(data).hide());

				!function (img) {
					var check = function () {
						for (var i = 0; i < img.length; i++) {
							if (img[i].complete && img[i].naturalWidth != 0) {
								img.splice(i,1);
								return check();
							}
						}
						if (img.length) {
							window.setTimeout(check, 50);
						}
						else {
							data.show();
							if (container.masonry) {
								container.masonry('appended', data);
							}
						}
					};
					check();
				} (data.find('img').toArray());

				var newLink = data.find('a.grey-button');
				if (newLink.length) {
					newLink.click(linkClick);
				}
			});
		};

	jDoc.ready(function() {
		var link = $('.cn-edit-pager .last.grey-button');
		link.click(linkClick);
		container = $(containerId);

		var form = $('#search-form'),
			inputs = form.find(':input'),
			buttons = form.find('button').prop('disabled', true);

		inputs.on('change input', function () {
			buttons.prop('disabled', false);
		});

		form.on('submit', function (ev) {
			if (buttons.prop('disabled')) {
				ev.preventDefault();
			}
		});
	});

	$(window).load(function() {
		container.masonry({columnWidth: width, itemSelector: '.box'});
	});

}(jQuery, "#<?php echo $containerId; ?>", <?php echo $hg->size('4M', false); ?>);
</script>
