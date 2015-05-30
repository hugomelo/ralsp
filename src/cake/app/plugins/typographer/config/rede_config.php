<?php
App::import('Vendor','Typographer.tools');
App::import('Vendor','Typographer.rede_tools');
App::import('Vendor','browserdetection');

$browserInfo = getBrowser();

$currentSite = Configure::read('SiteFactory.currentSite.FactSite');

$unit = new Unit(
	array(
		'unit_name' => 'px',
		'multiplier' => 1,
		'round_it' => true
	)
);

$horizontalGrid = new Grid(array(
	'M_size' => 80,
	'm_size' => 10,
	'g_size' => 20,
	'M_quantity' => 12,
	'alignment' => 'center',
	'left_gutter'  => 0,
	'right_gutter' => 0,
	'unit' => &$unit
));

$verticalGrid = $horizontalGrid;

$palette = array();

$palette['text'] 				 = new Color(  0,  0,  0);
$palette['line'] 				 = new Color(  0,  0,  0);
$palette['submit_blue']   		 = new Color(125,194,223);
$palette['negative_text']   	 = new Color(255,255,255);
$palette['cloud']				 = new Color(255,255,255);
$palette['sky']             	 = new Color( 37,188,215);
$palette['sky_night']       	 = new Color(  0,  8, 89);
$palette['museum_red']      	 = new Color(236, 19, 19);
$palette['half_museum_red']    	 = clone $palette['museum_red'];
$palette['half_museum_red']->blendWith($palette['cloud'], 0.8);

$palette['menu_background'] 	 = new Color(185,234,239);
$palette['hills']           	 = new Color(197,223, 24);
$palette['buttons']				 = new Color(255,197,  5);
$palette['scaping_donkey']  	 = new Color(104,103, 77);
$palette['half_scaping_donkey']	 = clone $palette['scaping_donkey'];
$palette['half_scaping_donkey']->blendWith($palette['cloud'], 0.5);

$palette['stand_by']			 = new Color(208,206,206);
$palette['green_ok']			 = new Color(  0,151,  0);
$palette['users_color']			 = new Color(229,234,214);
$palette['users_color_lighter']	 = new Color(250,251,247);
$palette['half_users_color']	 = clone $palette['users_color'];
$palette['half_users_color']->blendWith($palette['cloud'], 0.5);
$palette['login_blue']			 = new Color(  0,140,202);
$palette['digco_orange']		 = new Color(242,155,110);
$palette['subscription_ok']		 = new Color(183,233,114);


$palette['link'] 				 =& $palette['text'];
$palette['hatched']				 = clone $palette['sky'];
$palette['hatched']->blendWith($palette['cloud'], 0.8);

$palette['fact_site']['text']    = new Color($currentSite['color_foreground']);
$palette['fact_site']['bg']      = new Color($currentSite['color_background']);
$palette['fact_site']['link']    = new Color($currentSite['color_link']      );
$palette['fact_site']['menu_bg'] = new Color($currentSite['color_menu_bg']   );
$palette['fact_site']['menu_fg'] = new Color($currentSite['color_menu_fg']   );
$palette['fact_site']['outline'] = new Color($currentSite['color_outline']   );
$palette['fact_site']['lines']   = new Color($currentSite['color_lines']     );
$palette['fact_site']['hatched'] = clone $palette['fact_site']['lines'];
$palette['fact_site']['hatched']->blendWith($palette['fact_site']['bg'], 0.8);

$lineHeight = $horizontalGrid->size(array('g' => 1));
$standardFontSize = 13;
$mainFontFamily = array('HelveticaNeueLTStd-Roman', 'Helvetica LT Std Roman', 'HelveticaNeue', 'Helvetica Neue', 'HelveticaNeueRoman', 'HelveticaNeue-Roman', 'Helvetica Neue Roman', /*'TeXGyreHeros',*/ 'Arial', 'sans-serif');
$fixedFontFamily = array('Lekton', 'Andale Mono', 'Courier New', 'Courier', 'monospace');


$fontScale = array(
	'titles' =>	array(
		'sky' => new TypefaceSettings(array('fontFamily' => $mainFontFamily, 'fontSize' => 21 * $standardFontSize / 13, 'lineHeight' => 40 * $lineHeight / 20, 'fontWeight' => '400'), $unit),
		1     => new TypefaceSettings(array('fontFamily' => $mainFontFamily, 'fontSize' => 27 * $standardFontSize / 13, 'lineHeight' => 40 * $lineHeight / 20, 'fontWeight' => 'bold'), $unit),
		2     => new TypefaceSettings(array('fontFamily' => $mainFontFamily, 'fontSize' => 21 * $standardFontSize / 13, 'lineHeight' => 30 * $lineHeight / 20, 'fontWeight' => 'bold'), $unit),
		3     => new TypefaceSettings(array('fontFamily' => $mainFontFamily, 'fontSize' => 17 * $standardFontSize / 13, 'lineHeight' => 20 * $lineHeight / 20, 'fontWeight' => '400'), $unit),
		4     => new TypefaceSettings(array('fontFamily' => $mainFontFamily, 'fontSize' => 13 * $standardFontSize / 13, 'lineHeight' => 20 * $lineHeight / 20, 'fontWeight' => 'bold'), $unit),
		5     => new TypefaceSettings(array('fontFamily' => $mainFontFamily, 'fontSize' => 13 * $standardFontSize / 13, 'lineHeight' => 20 * $lineHeight / 20, 'fontWeight' => 'bold', 'textTransform' => 'uppercase'), $unit),
		6     => new TypefaceSettings(array('fontFamily' => $mainFontFamily, 'fontSize' => 13 * $standardFontSize / 13, 'lineHeight' => 20 * $lineHeight / 20, 'fontWeight' => '400', 'fontStyle' => 'italic'), $unit)
	),
	'text' => array(
		'big'			=> new TypefaceSettings(array('fontFamily' => $mainFontFamily,	'fontSize' => 17 * $standardFontSize / 13, 'lineHeight' => 20 * $lineHeight / 20, 'fontWeight' => '400'), $unit),
		'regular_bold'	=> new TypefaceSettings(array('fontFamily' => $mainFontFamily,	'fontSize' => 13 * $standardFontSize / 13, 'lineHeight' => 20 * $lineHeight / 20, 'fontWeight' => 'bold'), $unit),
		'regular'		=> new TypefaceSettings(array('fontFamily' => $mainFontFamily,	'fontSize' => 13 * $standardFontSize / 13, 'lineHeight' => 20 * $lineHeight / 20, 'fontWeight' => '400'), $unit),
		'small'			=> new TypefaceSettings(array('fontFamily' => $mainFontFamily,	'fontSize' => 11 * $standardFontSize / 13, 'lineHeight' => 20 * $lineHeight / 20, 'fontWeight' => '400'), $unit),
		'tiny'			=> new TypefaceSettings(array('fontFamily' => $mainFontFamily,	'fontSize' =>  8 * $standardFontSize / 13, 'lineHeight' => 15 * $lineHeight / 20, 'fontWeight' => '400', 'textTransform' => 'uppercase'), $unit),
		'fixed'			=> new TypefaceSettings(array('fontFamily' => $fixedFontFamily,	'fontSize' => 13 * $standardFontSize / 13, 'lineHeight' => 20 * $lineHeight / 20, 'fontWeight' => '400'), $unit),
	)	
);


$imageGenerator = new CompoundImage;

/*$used_automatic_classes = array(
	'width' => array()
);

for ($i = 1; $i <= 12; $i++)
{
	$used_automatic_classes['width'][] = array('M' => $i, 'g' => -1);
	$used_automatic_classes['width'][] = array('M' => $i, 'g' =>  0);
}

for ($i = 1; $i <= 7; $i++)
{
	$used_automatic_classes['width'][] = array('g' => $i);
}

$used_automatic_classes['width'][] = array('M' => 3, 'g' =>  -3, 'm' => -1);

for ($i = 1; $i <= 7; $i++)
{
	$used_automatic_classes['height'][] = array('g' => $i);
}

*/

Configure::write('Typographer.Rede.tools',
	array(
		'vg'             => $verticalGrid,
		'hg'             => $horizontalGrid,
		'u'              => $unit,
		'ig'             => $imageGenerator,
		'palette'        => $palette,
		'browserInfo'    => $browserInfo,
		'fontScale'      => $fontScale,
		'mainFontFamily' =>	$mainFontFamily,
		'lineHeight'     => $lineHeight,
	)
);
Configure::write('Typographer.Rede.used_automatic_classes', array(
	'width' => array(
		array('M' => 6, 'g'=> -1, 'm' => -2),
		array('M' => 4, 		  'm' => -1),
		array('M' => 3, 		  'm' =>  3),
		array('M' => 3, 		  'm' =>  1),
		array('M' => 2, 'g' => 1, 'm' =>  1, 'u' => -5),
		array('M' => 2, 'g' => 1, 'm' => -1, 'u' => -5),
		array('M' => 2, 'g'=> -1),
		array('M' => 2, 'g'=> -1, 'm' => -3),
		array('M' => 2, 		  'm' =>  4),
		array('M' => 2, 		  'm' =>  2),
		array('M' => 2, 		  'm' =>  1),
		array('M' => 2, 		  'm' => -1),
		array('M' => 2, 		  'm' => -4),
		array('M' => 1),
		array('M' => 1,			  'm' => -3),
		array('g' => 2, 		  'm' => -2),
		array('g' => 2, 					 'u' =>  5),
	)
));

?>
