<?php

/** @type CnThemesColor $CnThemesColor */
$CnThemesColor = ClassRegistry::getObject('CnThemesColor');
$CnThemesColor->resetAssociations();
$themes = $CnThemesColor->find('all', array('contain' => 'CnTheme'));

{ echo $this->Bl->sdiv(array('class' => 'search_themes', 'id' => $containerDiv = uniqid('div')));

	echo $this->Bl->span(array('class' => 'title'), array(), __d('cn', 'Temas', true));

	$links = '';

	foreach ($themes as $theme) {
		echo $this->Bl->a(array(
			'class' => array('theme', $theme['CnThemesColor']['id']),
			'value' => $theme['CnThemesColor']['id'],
			'href' => ''
		));

		$links .= $this->Bl->labelDry(
			$this->Bl->span(
				array('class' => 'theme-container'), array(),
				$this->Bl->span(
					array('class' => 'theme-icon size-1'), array(),
					$this->Bl->span(array('class' => $theme['CnThemesColor']['id']))
				)
			)
			. $this->Bl->input(array(
				'type'  => 'checkbox',
				'name'  => '',
				'value' => $theme['CnThemesColor']['id']
			))
			. implode(', ', Set::extract('/CnTheme/name', $theme))
		);
	}
	echo $this->Bl->floatBreak();

	{ echo $this->Bl->sdiv(array('id' => 'theme-details'));
		echo $this->Bl->anchor(array('class' => 'close-theme-details'), array('url' => ''), '&nbsp;');
		echo $links;
		echo $this->Bl->floatBreak();
		echo $this->Bl->input(array(
			'type' => 'hidden',
			'name' => 'cores',
			'value' => isset($baseParams['cores']) ? $baseParams['cores'] : ''
		));
	} echo $this->Bl->ediv();
	echo $this->Bl->anchor(array('class' => 'more-theme-details'), array('url' => ''), '&nbsp;');
} echo $this->Bl->ebox();
?>

<script type="text/javascript">
!function ($, divId) {
	$(document).ready(function () {
		var div = $(divId),
			ckBoxes = div.find('input[type=checkbox]'),
			links = div.find('a.theme'),
			hidInput = div.find('input[type=hidden]');

		ckBoxes.change(renderResult);
		links.click(function (ev) {
			ev.preventDefault();
			var input = ckBoxes.filter('[value='+$(this).attr('value')+']');
			if (input.length == 1 && !input.prop('disabled')) {
				input.prop('checked', !input.is(':checked')).change();
				renderResult();
			}
		});
		div.find('.more-theme-details').click(function (ev) {
			ev.preventDefault();
			div.addClass('opened');
		});
		div.find('.close-theme-details').click(function (ev) {
			ev.preventDefault();
			div.removeClass('opened');
		});
		parseString();

		function renderResult () {
			var filtered = ckBoxes.filter(':checked');
			if (filtered.length == 1) {
				filtered.prop('disabled', true);
			}
			else {
				ckBoxes.prop('disabled', false);
			}
			if (ckBoxes.length == filtered.length) {
				hidInput.val('').prop('disabled', true);
			}
			else {
				hidInput.val(filtered.map(function (i, el) {return el.value}).get().join('-')).prop('disabled', false);
			}
			updateLinks();
		}

		function parseString() {
			var values = $.grep(hidInput.val().split('-'), function (el) {return el.trim();});
			ckBoxes.each(function (i, el) {
				el.checked = !values.length || values.indexOf(el.value) != -1;
			});
			renderResult();
		}

		function updateLinks () {
			links.each(function (i, el) {
				el = $(el);
				if (ckBoxes.filter('[value='+el.attr('value')+']').is(':checked')) {
					el.addClass('selected');
					return;
				}
				el.removeClass('selected');
			});
		}
	});
} (jQuery, "#<?php echo $containerDiv; ?>");
</script>
