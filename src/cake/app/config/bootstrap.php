<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php
 *
 * This is an application wide file to load any function that is not used within a class
 * define. You can also use this to include or require any files in your application.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 * This is related to Ticket #470 (https://trac.cakephp.org/ticket/470)
 *
 * App::build(array(
 *     'plugins' => array('/full/path/to/plugins/', '/next/full/path/to/plugins/'),
 *     'models' =>  array('/full/path/to/models/', '/next/full/path/to/models/'),
 *     'views' => array('/full/path/to/views/', '/next/full/path/to/views/'),
 *     'controllers' => array(/full/path/to/controllers/', '/next/full/path/to/controllers/'),
 *     'datasources' => array('/full/path/to/datasources/', '/next/full/path/to/datasources/'),
 *     'behaviors' => array('/full/path/to/behaviors/', '/next/full/path/to/behaviors/'),
 *     'components' => array('/full/path/to/components/', '/next/full/path/to/components/'),
 *     'helpers' => array('/full/path/to/helpers/', '/next/full/path/to/helpers/'),
 *     'vendors' => array('/full/path/to/vendors/', '/next/full/path/to/vendors/'),
 *     'shells' => array('/full/path/to/shells/', '/next/full/path/to/shells/'),
 *     'locales' => array('/full/path/to/locale/', '/next/full/path/to/locale/')
 * ));
 *
 */

define('VALID_CEP', '/^[0-9]{8}$/');
define('VALID_PHONE', '/\(?\d{2,2}[\) ]?[\d\.\- ]{8,10}/');


Configure::write('Mojo.token', '761a3d7509505abbf4a6e6754f9f3ac7195f4833');
Configure::write('MojoFactSite.token', '63f21ff9084581076d63d4a9ce4f7ef185246e1c');

Configure::write('Mexc.SocialMedias', array(
	'facebook' => array('label' => 'Facebook', 'url' => 'http://www.facebook.com/pages/Museu-Explorat%C3%B3rio-de-Ci%C3%AAncias/231240706915803'),
	'twitter' => array('label' => 'Twitter', 'url' => 'http://twitter.com/MC_Unicamp'),
));
Configure::write('Config.language', 'por');

 /** Tells JodelJodel about wich modules are installed in the current installation.
  *  And provides some configuration of these modules.
  */
 Configure::write('jj.modules', array(
	
	// Content modules
		'news' => array(
			'model' => 'MexcNews.MexcNew',
			'viewUrl' => array('action' => 'read'),
			'humanName' => __('Novidades', true),
			'plugged' => array('dashboard','backstage','factory','backstage_custom'),
			'fact_name' => __d('fact_site', 'Novidades', true),
			'additionalFilteringConditions' => array('MexcSpace.DashboardFiltering'),
			'permissions' => array(
				'delete' => array('backstage_delete_item', 'new'), 
				'edit_draft' => array('backstage_edit_draft', 'new'),
				'edit_published' => array('backstage_edit_published', 'new'),
				'create' => array('backstage_edit_draft', 'new'),
				'edit_publishing_status' => array('backstage_edit_publishing_status', 'new'),
				'view' => array('backstage_view_item', 'new'),
			),
		),
		'events' => array(
			'model' => 'MexcEvents.MexcEvent',
			'viewUrl' => array('controller' => 'mexc_events', 'action' => 'read'),
			'humanName' => __('MODULE MexcEvent human name', true),
			'plugged' => array('dashboard','backstage','factory','backstage_custom'),
			'fact_name' => __d('fact_site', 'Eventos', true),
			'additionalFilteringConditions' => array('MexcSpace.DashboardFiltering'),
			'permissions' => array(
				'delete' => array('backstage_delete_item', 'event'), 
				'edit_draft' => array('backstage_edit_draft', 'event'),
				'edit_published' => array('backstage_edit_published', 'event'),
				'create' => array('backstage_edit_draft', 'event'),
				'edit_publishing_status' => array('backstage_edit_publishing_status', 'event'),
				'view' => array('backstage_view_item', 'event'),
			),
		),
		'documents' => array(
			'model' => 'MexcDocuments.MexcDocument',
			'viewUrl' => array('action' => 'read'),
			'humanName' => __('MODULE MexcDocument human name', true),
			'plugged' => array('dashboard','backstage','factory','backstage_custom'),
			'fact_name' => __d('fact_site', 'Documentos', true),
			'additionalFilteringConditions' => array('MexcSpace.DashboardFiltering'),
			'permissions' => array(
				'delete' => array('backstage_delete_item', 'document'), 
				'edit_draft' => array('backstage_edit_draft', 'document'),
				'edit_published' => array('backstage_edit_published', 'document'),
				'create' => array('backstage_edit_draft', 'document'),
				'edit_publishing_status' => array('backstage_edit_publishing_status', 'document'),
				'view' => array('backstage_view_item', 'document'),
			),
		), 
		'galleries' => array(
			'model' => 'MexcGalleries.MexcGallery',
			'viewUrl' => array('action' => 'read'),
			'humanName' => __('MODULE MexcGallery human name', true),
			'plugged' => array('dashboard','backstage','factory','backstage_custom'),
			'fact_name' => __d('fact_site', 'Galeria de fotos', true),
			'additionalFilteringConditions' => array('MexcSpace.DashboardFiltering'),
			'permissions' => array(
				'delete' => array('backstage_delete_item', 'gallery'), 
				'edit_draft' => array('backstage_edit_draft', 'gallery'),
				'edit_published' => array('backstage_edit_published', 'gallery'),
				'create' => array('backstage_edit_draft', 'gallery'),
				'edit_publishing_status' => array('backstage_edit_publishing_status', 'gallery'),
				'view' => array('backstage_view_item', 'gallery'),
			),
		),
		
	// Structure modules
		'projects' => array(
			'model' => 'SiteFactory.FactSite',
			'humanName' => __('Projeto', true),
			'plugged' => array('dashboard','backstage','backstage_custom'),
			'permissions' => array(
				'delete' => array('backstage_delete_item', 'factory'), 
				'edit_draft' => array('backstage_edit_draft', 'factory'),
				'edit_published' => array('backstage_edit_published', 'factory'),
				'create' => array('backstage_edit_draft', 'factory'),
				'edit_publishing_status' => array('backstage_edit_publishing_status', 'factory'),
				'view' => array('backstage_view_item', 'factory'),
			),
		),
		'fact_section' => array(
			'model' => 'SiteFactory.FactSection',
			'humanName' => __('MODULE FactSection human name', true),
		),
		'highlight' => array(
			'model' => 'MexcHighlights.MexcHighlightedContent',
			'humanName' => __('MODULE MexcHighlightedContent human name', true),
			'plugged' => array('dashboard','backstage'),
			'additionalFilteringConditions' => array('MexcSpace.DashboardFiltering'),
			'permissions' => array(
				'delete' => array('backstage_delete_item', 'highlight'), 
				'edit_draft' => array('backstage_edit_draft', 'highlight'),
				'edit_published' => array('backstage_edit_published', 'highlight'),
				'create' => array('backstage_edit_draft', 'highlight'),
				'edit_publishing_status' => array('backstage_edit_publishing_status', 'highlight'),
				'view' => array('backstage_view_item', 'highlight'),
			),
		),
	
		'contact' => array(
			'model' => 'MexcContacts.MexcContact',
			'humanName' => __('MODULE MexcContact human name', true),
			'plugged' => array('dashboard','backstage','factory'),
			'fact_name' => __d('fact_site', 'Formulário de contato', true),
			'additionalFilteringConditions' => array('MexcSpace.DashboardFiltering'),
			'permissions' => array(
				'delete' => array('backstage_delete_item', 'contact'), 
				'edit_draft' => array('backstage_edit_draft', 'contact'),
				'edit_published' => array('backstage_edit_published', 'contact'),
				'create' => array('backstage_edit_draft', 'contact'),
				'edit_publishing_status' => array('backstage_edit_publishing_status', 'contact'),
				'view' => array('backstage_view_item', 'contact'),
			),
		),
		'static_page' => array(
			'model' => 'MexcStaticPages.MexcStaticPage',
			'humanName' => __('MODULE MexcStaticPage human name', true),
			'plugged' => array('dashboard','backstage','factory'),
			'fact_name' => __d('fact_site', 'Página estática', true),
			'additionalFilteringConditions' => array('MexcSpace.DashboardFiltering'),
			'permissions' => array(
				'delete' => array('backstage_delete_item', 'static_page'), 
				'edit_draft' => array('backstage_edit_draft', 'static_page'),
				'edit_published' => array('backstage_edit_published', 'static_page'),
				'create' => array('backstage_edit_draft', 'static_page'),
				'edit_publishing_status' => array('backstage_edit_publishing_status', 'static_page'),
				'view' => array('backstage_view_item', 'static_page'),
			),
		),
		
	// Corktile modules
	
		'text_cork' => array(
			'model' => 'TextCork.TextTextCork',
			'humanName' => __('MODULE TextTextCork human name', true),
			'plugged' => array('corktile')
		),
		'cs_cork' => array(
			'model' => 'ContentStream.CsCork',
			'humanName' => __('MODULE CsCork human name', true),
			'plugged' => array('corktile')
		),
		'corktile' => array(
			'model' => 'Corktile.CorkCorktile',
			'humanName' => __('MODULE CorkCorkTile human name', true),
			'plugged' => array('dashboard', 'backstage'),
			'permissions' => array(
				'edit' => array('backstage_edit_published', 'corktile'),
				'view' => array('backstage_view_item', 'corktile'),
			),
		),
	
	//admin user sections
		'user_users' => array(
			'model' => 'JjUsers.UserUser',
			'humanName' => __('MODULE UserUser human name', true),
			'plugged' => array('backstage', 'backstage_custom'),
			'permissions' => array(
				'delete' => array('user_delete'), 
				'edit' => array('user_edit'),
				'create' => array('user_add'),
				'view' => array('user_list'),
			),
		),
		'user_profiles' => array(
			'model' => 'JjUsers.UserProfile',
			'humanName' => __('MODULE UserProfile human name', true),
			'plugged' => array('backstage', 'backstage_custom')
		),
		'user_permissions' => array(
			'model' => 'JjUsers.UserPermission',
			'humanName' => __('MODULE UserPermission human name', true),
			'plugged' => array('backstage', 'backstage_custom')
		)
 ));
 
 

/**
 * As of 1.3, additional rules for the inflector are added below
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */

require APP . 'plugins' . DS . 'media' . DS . 'config' . DS . 'core.php';
require APP . 'plugins' . DS . 'typographer' . DS . 'config' . DS . 'core.php';

/**
 *
 * This function returns the month abbreviation in portuguese
 *
 * @param: month number
 * @return a string with the month abbreviation 
 */
function br_month_abbrev($monthNumber)
{
	$meses = array(
		1 => 'Jan',
		2 => 'Fev',
		3 => 'Mar',
		4 => 'Abr',
		5 => 'Mai',
		6 => 'Jun',
		7 => 'Jul',
		8 => 'Ago',
		9 => 'Set',
		10 => 'Out',
		11 => 'Nov',
		12 => 'Dez'
	);

	if (array_key_exists((int)$monthNumber, $meses))
		return $meses[(int)$monthNumber];
	else
		return "";
}

function br_strftime($formato, $tempo)
{
	//UGLY HACK to make it work with english too:
	
	if (Configure::read('Config.language') == 'por')
	{
		$meses = array(
			1 => 'janeiro',
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
			12 => 'dezembro'
		);

		$data = getdate($tempo);
		return strftime(str_replace('%B',$meses[$data['mon']], $formato), $tempo);
	}
	else
		return strftime($formato, $tempo);
}

//DINAFON specific
//@todo Introduce something more sofisticated for time formatting
function _formatInterval($begin, $end)
{
	$beginArray = getdate($begin);
	$endArray = getdate($end);
	
	if ($beginArray['mon'] == $endArray['mon'])
	{
		return sprintf(
			__('%d-%d de %s de %d',true), 
			$beginArray['mday'],
			$endArray['mday'],
			br_strftime('%B', $begin),
			$endArray['year']
		);
	}
	else
	{
		return sprintf(
			__('%d de %s a %d de %s de %d',true), 
			$beginArray['mday'],
			br_strftime('%B', $begin),
			$endArray['mday'],
			br_strftime('%B', $end),
			$endArray['year']
		);
	}
}



/**
 * As of 1.3, additional rules for the inflector are added below
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */
 
	Inflector::rules('singular', array(
		'rules' => array(),
		'uninflected' => array(),
		'irregular' => array(
			'questoes_migalhas_imagens' => 'questoes_migalhas_imagem',
			'citacoes' => 'citacao',
			'questoes' => 'questao',
			'respostas_jornais' => 'respostas_jornal',
			'respostas_avaliacoes' => 'respostas_avaliacao',
			'questoes_jornais' => 'questoes_jornal',
			'gd_orientadores' => 'gd_orientador',
			'edicoes' => 'edicao',
			'orientadores' => 'orientador',
			'imagens' => 'imagem',
			'versoes' => 'versao',
			'votacoes' => 'votacao',
			'dados_professores' => 'dados_professor',
			'respostas_certidoes' => 'respostas_certidao',
			'respostas_redacoes' => 'respostas_redacao',
			'colecao_itens' => 'colecao_item',
			'itens' => 'item',
			'itens_imagens' => 'itens_imagem',
			'questoes_certidoes' => 'questoes_certidao',
			'questoes_redacoes' => 'questoes_redacao'
		)
	));

	Inflector::rules('plural', array(
		'rules' => array(),
		'uninflected' => array(),
		'irregular' => array(
			'questoes_migalhas_imagem' => 'questoes_migalhas_imagens',
			'citacao' => 'citacoes',
			'questao' => 'questoes',
			'respostas_jornal' => 'respostas_jornais',
			'respostas_avaliacao' => 'respostas_avaliacoes',
			'questoes_jornal' => 'questoes_jornais',
			'gd_orientador' => 'gd_orientadores',
			'edicao' => 'edicoes',
			'orientador' => 'orientadores',
			'imagem' => 'imagens',
			'versao' => 'versoes',
			'votacao' => 'votacoes',
			'dados_professor' => 'dados_professores',
			'respostas_certidao' => 'respostas_certidoes',
			'respostas_redacao' => 'respostas_redacoes',
			'colecao_item' => 'colecao_itens',
			'item' => 'itens',
			'itens_imagem' => 'itens_imagens',
			'questoes_certidao' => 'questoes_certidoes',
			'questoes_redacao' => 'questoes_redacoes'
		)
	));

	if (!function_exists('money_format'))
	{
		function money_format($format, $number)
		{
			$regex  = '/%((?:[\^!\-]|\+|\(|\=.)*)([0-9]+)?'.
					  '(?:#([0-9]+))?(?:\.([0-9]+))?([in%])/';
			if (setlocale(LC_MONETARY, 0) == 'C') {
				setlocale(LC_MONETARY, '');
			}
			$locale = localeconv();
			preg_match_all($regex, $format, $matches, PREG_SET_ORDER);
			foreach ($matches as $fmatch) {
				$value = floatval($number);
				$flags = array(
					'fillchar'  => preg_match('/\=(.)/', $fmatch[1], $match) ?
								   $match[1] : ' ',
					'nogroup'   => preg_match('/\^/', $fmatch[1]) > 0,
					'usesignal' => preg_match('/\+|\(/', $fmatch[1], $match) ?
								   $match[0] : '+',
					'nosimbol'  => preg_match('/\!/', $fmatch[1]) > 0,
					'isleft'    => preg_match('/\-/', $fmatch[1]) > 0
				);
				$width      = trim($fmatch[2]) ? (int)$fmatch[2] : 0;
				$left       = trim($fmatch[3]) ? (int)$fmatch[3] : 0;
				$right      = trim($fmatch[4]) ? (int)$fmatch[4] : $locale['int_frac_digits'];
				$conversion = $fmatch[5];

				$positive = true;
				if ($value < 0) {
					$positive = false;
					$value  *= -1;
				}
				$letter = $positive ? 'p' : 'n';

				$prefix = $suffix = $cprefix = $csuffix = $signal = '';

				$signal = $positive ? $locale['positive_sign'] : $locale['negative_sign'];
				switch (true) {
					case $locale["{$letter}_sign_posn"] == 1 && $flags['usesignal'] == '+':
						$prefix = $signal;
						break;
					case $locale["{$letter}_sign_posn"] == 2 && $flags['usesignal'] == '+':
						$suffix = $signal;
						break;
					case $locale["{$letter}_sign_posn"] == 3 && $flags['usesignal'] == '+':
						$cprefix = $signal;
						break;
					case $locale["{$letter}_sign_posn"] == 4 && $flags['usesignal'] == '+':
						$csuffix = $signal;
						break;
					case $flags['usesignal'] == '(':
					case $locale["{$letter}_sign_posn"] == 0:
						if ($positive) $prefix = $suffix = ' ';
						else  {
							$prefix = '(';  $suffix = ')';
						}
						break; 
				}
				if (!$flags['nosimbol']) {
					$currency = $cprefix .
								($conversion == 'i' ? $locale['int_curr_symbol'] : $locale['currency_symbol']) .
								$csuffix;
				} else {
					$currency = '';
				}
				$space  = $locale["{$letter}_sep_by_space"] ? ' ' : '';

				$value = number_format($value, $right, $locale['mon_decimal_point'],
						 $flags['nogroup'] ? '' : $locale['mon_thousands_sep']);
				$value = @explode($locale['mon_decimal_point'], $value);

				$n = strlen($prefix) + strlen($currency) + strlen($value[0]);
				if ($left > 0 && $left > $n) {
					$value[0] = str_repeat($flags['fillchar'], $left - $n) . $value[0];
				}
				$value = implode($locale['mon_decimal_point'], $value);
				if ($locale["{$letter}_cs_precedes"]) {
					$value = $prefix . $currency . $space . $value . $suffix;
				} else {
					$value = $prefix . $value . $space . $currency . $suffix;
				}
				if ($width > 0) {
					$value = str_pad($value, $width, $flags['fillchar'], $flags['isleft'] ?
							 STR_PAD_RIGHT : STR_PAD_LEFT);
				}

				$format = str_replace($fmatch[0], $value, $format);
			}
			return $format;
		} 
	}

	if (Configure::read('debug') > 0) {
		App::Import('Vendor', 'scssc', array('file' => 'scssphp/scss.inc.php'));
		App::Import('Vendor', 'SassCompiler', array('file' => 'php-sass' . DS . 'sass-compiler.php'));

		SassCompiler::run(WWW_ROOT."scss/", WWW_ROOT."css/");
	}
