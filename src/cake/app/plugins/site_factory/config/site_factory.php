<?php

/*
 * Copyright 2011-2015, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 * source:  https://github.com/museudecienciasunicamp/site_factory.git Mexc Highlights public repository
 *
 */


$path = dirname(dirname(__FILE__)) . DS . 'webroot' . DS . 'files' . DS;

Configure::write('FactSite.preset.0', array(
	'color_background' => '#fff3b8',
	'color_foreground' => '#000000',
	'color_link' => '#000000',
	'color_menu_bg' => '#000000',
	'color_menu_fg' => '#ffffff',
	'color_outline' => '#ffc50c',
	'color_lines' => '#edbc1c',
	'img_head_id' => $path . 'fab1' . DS . 'cabecalho.png',
	'img_foot_id' => $path . 'fab1' . DS . 'rodape.png',
	'picture_id' => $path . 'fab1' . DS . 'foto-ilustrativa.png',
));

Configure::write('FactSite.preset.1', array(
	'color_background' => '#d9ede7',
	'color_foreground' => '#000000',
	'color_link' => '#000000',
	'color_menu_bg' => '#000000',
	'color_menu_fg' => '#ffffff',
	'color_outline' => '#0c4147',
	'color_lines' => '#18878c',
	'img_head_id' => $path . 'fab2' . DS . 'cabecalho.png',
	'img_foot_id' => $path . 'fab2' . DS . 'rodape.png',
	'picture_id' => $path . 'fab2' . DS . 'foto-ilustrativa.png',
));

Configure::write('FactSite.preset.2', array(
	'color_background' => '#e8ff85',
	'color_foreground' => '#000000',
	'color_link' => '#000000',
	'color_menu_bg' => '#000000',
	'color_menu_fg' => '#ffffff',
	'color_outline' => '#828c00',
	'color_lines' => '#acaf22',
	'img_head_id' => $path . 'fab3' . DS . 'cabecalho.png',
	'img_foot_id' => $path . 'fab3' . DS . 'rodape.png',
	'picture_id' => $path . 'fab3' . DS . 'foto-ilustrativa.png',
));

Configure::write('FactSite.preset.3', array(
	'color_background' => '#6a664d',
	'color_foreground' => '#ffffff',
	'color_link' => '#ffffff',
	'color_menu_bg' => '#ffffff',
	'color_menu_fg' => '#000000',
	'color_outline' => '#ea1d25',
	'color_lines' => '#ea1d25',
	'img_head_id' => $path . 'fab4' . DS . 'cabecalho.png',
	'img_foot_id' => $path . 'fab4' . DS . 'rodape.png',
	'picture_id' => $path . 'fab4' . DS . 'foto-ilustrativa.png',
));

