<?php

/**
 *
 * Copyright 2010-2012, Preface Design LTDA (http://www.preface.com.br")
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2010-2011, Preface Design LTDA (http://www.preface.com.br)
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link          https://github.com/prefacedesign/jodeljodel Jodel Jodel public repository 
 */


/**
 * Filters and versions
 *
 * For each media type a set of filters keyed by version name is configured.
 * A filter is a set of instructions which are processed by the Media_Process class.
 *
 * For more information on available methods see the classes
 * located in `libs/mm/src/Media/Process`.
 * 
 * Avaible processes:
 * - fit/fitInside: Resizes media proportionally keeping both sides within given dimensions.
 * - fitOutside:Resizes media proportionally keeping _smaller_ side within corresponding dimensions.
 * - crop: Crops media to provided dimensions.
 * - zoom/zoomFit: Enlarges media proportionally by factor 2.
 * - zoomCrop: 
 * - fitCrop: First resizes media so that it fills out the given dimensions, then cuts off overlapping parts.
 * - compress:Selects level of compression than compresses the media according to provided value.
 * - strip: Strips unwanted data from an image.
 * - colorProfile:
 * - colorDepth: Changes the color depths (of the channels).
 * - interlace: Enables or disables interlacing. Formats like PNG, GIF and JPEG support interlacing.
 * - convert: Converts the media to given MIME type.
 * 
 * 
 * @see GeneratorBehavior
 */

/**
 * Basic configuration of JjMedia plugin:
 * 
 * {{{Configure::write('Media.filter_plus.NAME_OF_CONFIGURATION', array( // NAME_OF_CONFIGURATION is a name that has significance
 * 	'fields' => array(),				// List of Model.file_id that this config will be applyed
 * 	'image' => array(					// What type of media transformation (image, sound, video....)
 * 		'filter' => array(				// Name of the version (will be used in future to get this version)
 * 			'fit' => array(120,120)		// One filter
 * 			'convert' => 'image/jpeg'	// Other filter
 * 		)
 * 	)
 * ));}}} 
 */
 
Configure::write('Media.filter_plus.textile', array(
	'fields' => array('Textile.image_id'),
	'image' => array(
		'filter' => array(
			'fit' => array(
				$redeTools['hg']->size(array('M' => 6), false),
				$redeTools['vg']->size(array('M' => 6), false)
			),
			'convert' => 'image/jpeg'
		)
	)
)); 

Configure::write('Media.filter_plus.content_stream', array(
	'fields' => array('PieImage.file_id'),
	'image' => array(
		'backstage_preview' => array(
			'fit' => array(
				$backstageTools['hg']->size('5M-g', false),
				$backstageTools['vg']->size('7M-g', false)
			),
			'convert' => 'image/jpeg'
		),
		
		// Image for MexcNew and MexcDocument
		'image_6M' => array( 
			'fitInside' => array(
				$redeTools['hg']->size('6M-g-2m', false),
				$redeTools['vg']->size('6M-g-2m', false)
			),
			'convert' => 'image/jpeg'
		),
		
		// Image for MexcEvent
		'image_5M' => array(
			'fitInside' => array(
				$redeTools['hg']->size('5M-g-2m', false),
				$redeTools['vg']->size('5M-g-2m', false)
			),
			'convert' => 'image/jpeg'
		),
		
		// Image for FactSite
		'image_fact' => array(
			'fitInside' => array(
				$redeTools['hg']->size('4M-g-2m', false),
				$redeTools['vg']->size('3M-g-2m', false)
			),
			'convert' => 'image/jpeg'
		),
		
		// Image for MexcAbout
		'image_9M' => array(
			'fitCrop' => array(
				$redeTools['hg']->size('9M-g-m', false),
				$redeTools['vg']->size('3M-g-2m', false)
			),
			'convert' => 'image/jpeg'
		),
	)
));

Configure::write('Media.filter_plus.member', array(
	'fields' => array('PieMember.file_id'),
	'image' => array(
		'backstage_preview' => array(
			'fitCrop' => array(
				$redeTools['hg']->size('3M-g-2m', false),
				$redeTools['vg']->size('2M-g-2m', false)
			),
			'convert' => 'image/jpeg'
		),
		
		// Image for PieMember
		'image_3M' => array(
			'fitCrop' => array(
				$redeTools['hg']->size('3M-g-2m', false),
				$redeTools['vg']->size('2M-g-2m', false)
			),
			'convert' => 'image/jpeg'
		),
	)
));


Configure::write('Media.filter_plus.logo', array(
	'fields' => array('PieLogo.file_id'),
	'image' => array(
		'thumb' => array(
			'fitInside' => array(
				$redeTools['hg']->size('M', false),
				$redeTools['hg']->size('M', false)
			),
			'convert' => 'image/jpeg'
		),
	)
));


Configure::write('Media.filter_plus.highlights', array(
	'fields' => array('MexcHighlightedContent.img_id'),
	'image' => array(
		'version' => array(
			'fitCrop' => array(
				$redeTools['hg']->size('4M-g-2m', false),
				$redeTools['vg']->size('2M', false)
			),
			'convert' => 'image/jpeg'
		)
	)
));

Configure::write('Media.filter_plus.new', array(
	'fields' => array('MexcNew.img_id'),
	'image' => array(
		'backstage_preview' => array(
			'fit' => array(
				$backstageTools['hg']->size('5M-g', false),
				$backstageTools['vg']->size('7M-g', false)
			)
		),
		'preview_column' => array(
			'fit' => array(
				$redeTools['hg']->size('3M-g-2m', false),
				$redeTools['vg']->size('2M', false)
			)
		),
		'preview_column_fact' => array(
			'fit' => array(
				$redeTools['hg']->size('4M-g-2m', false),
				$redeTools['vg']->size('3M', false)
			)
		),
		'view' => array(
			'fit' => array(
				$redeTools['hg']->size('6M-g-2m', false),
				$redeTools['vg']->size('5M', false)
			)
		)
	)
));

Configure::write('Media.filter_plus.event', array(
	'fields' => array('MexcEvent.img_id'),
	'image' => array(
		'backstage_preview' => array(
			'fit' => array(
				$backstageTools['hg']->size('5M-g', false),
				$backstageTools['vg']->size('7M-g', false)
			)
		),
		'preview_column' => array(
			'fit' => array(
				$redeTools['hg']->size('3M-g-2m', false),
				$redeTools['vg']->size('2M', false)
			)
		),
		'preview_column_fact' => array(
			'fit' => array(
				$redeTools['hg']->size('4M-g-2m', false),
				$redeTools['vg']->size('3M', false)
			)
		),
		'view' => array(
			'fit' => array(
				$redeTools['hg']->size('5M-g-2m', false),
				$redeTools['vg']->size('4M', false)
			)
		)
	)
));

Configure::write('Media.filter_plus.digital_collection', array(
	'fields' => array('MexcDigcoImage.image_id'),
	'image' => array(
		'backstage_preview' => array(
			'fit' => array(
				$backstageTools['hg']->size('5M-g', false),
				$backstageTools['vg']->size('7M-g', false)
			)
		),
		'backstage_list' => array(
			'fit' => array(
				$backstageTools['hg']->size('5M-g', false),
				$backstageTools['vg']->size('7M-g', false)
			)
		),
		'preview' => array(
			'fit' => array(
				$redeTools['hg']->size('4M-g-2m', false),
				$redeTools['vg']->size('6M-g', false)
			)
		),
		'full' => array(
			'fit' => array(
				$redeTools['hg']->size('8M-g', false),
				$redeTools['vg']->size('45g', false)
			)
		),
	)
));

Configure::write('Media.filter_plus.gallery', array(
	'fields' => array('MexcImage.img_id'),
	'image' => array(
		'backstage_preview' => array(
			'fit' => array(
				$backstageTools['hg']->size('5M-g', false),
				$backstageTools['vg']->size('7M-g', false)
			)
		),
		'backstage_list' => array(
			'fit' => array(
				$backstageTools['hg']->size('5M-g', false),
				$backstageTools['vg']->size('7M-g', false)
			)
		),
		'preview' => array(
			'fitCrop' => array(
				$redeTools['hg']->size('3M-g', false),
				$redeTools['vg']->size('3M-g', false)
			)
		),
		'preview_column' => array(
			'fitCrop' => array(
				$redeTools['hg']->size('5M-g-2m', false),
				$redeTools['vg']->size('4M', false)
			)
		),
		'preview_column_fact_site' => array(
			'fitCrop' => array(
				$redeTools['hg']->size('6M-g-2m', false),
				$redeTools['vg']->size('4M', false)
			)
		),
		'preview_mini_column' => array(
			'fitCrop' => array(
				$redeTools['hg']->size('3Mg6u', false),
				$redeTools['vg']->size('2Mm', false)
			)
		),
		'mini_preview' => array(
			'fitCrop' => array(
				$redeTools['hg']->size('2M-0.75g-m', false),
				$redeTools['vg']->size('Mm', false)
			)
		),
		'gallery_thumb' => array(
			'fit' => array(
				$redeTools['hg']->size('9M-g-2m', false),
				$redeTools['vg']->size('Mmg-2u', false) // M 108,333333333 (to fit 4 in 9M-g-2m)
			)
		),
		'gallery_full' => array(
			'fit' => array(
				$redeTools['hg']->size('9M-g', false),
				$redeTools['vg']->size('5Mg', false)
			)
		),
	)
));

Configure::write('Media.filter_plus.fact_footer', array(
	'fields' => array('FactSite.img_foot_id'),
	'image' => array(
		'preview' => array(
			'fitCrop' => array(
				$redeTools['hg']->size('6M-0.5g-u', false),
				$redeTools['vg']->size('M', false)
			)
		),
		'cropped' => array(
			'fitCrop' => array(
				$redeTools['hg']->size('12M-g-2u', false), // 2u from border!
				$redeTools['vg']->size('2M', false)
			)
		)
	)
));

Configure::write('Media.filter_plus.fact_bg', array(
	'fields' => array('FactSite.img_bg_id'),
	'image' => array(
		'preview' => array(
			'fit' => array(
				$redeTools['hg']->size('4M', false),
				$redeTools['vg']->size('4M', false)
			)
		)
	)
));

Configure::write('Media.filter_plus.fact_header', array(
	'fields' => array('FactSite.img_head_id'),
	'image' => array(
		'preview' => array(
			'fitCrop' => array(
				$redeTools['hg']->size('6M-0.5g-u', false),
				$redeTools['vg']->size('M-g', false)
			)
		),
		'cropped' => array(
			'fitCrop' => array(
				$redeTools['hg']->size('12M-g-2u', false),
				$redeTools['vg']->size('2M-2g', false)
			)
		)
	)
));

Configure::write('Media.filter_plus.fact_picture', array(
	'fields' => array('FactSite.picture_id'),
	'image' => array(
		'preview' => array(
			'fitCrop' => array(
				$redeTools['hg']->size('5M-g-2m', false),
				$redeTools['vg']->size('2M-m', false)
			)
		),
		'cropped' => array(
			'fitCrop' => array(
				$redeTools['hg']->size('3M-g-2m', false),
				$redeTools['vg']->size('2M-g-m', false)
			)
		)
	)
));

Configure::write('Media.filter_plus.fact_logo_1', array(
	'fields' => array('FactSite.img_id'),
	'image' => array(
		'preview' => array(
			'fit' => array(
				$redeTools['hg']->size('4M-g-2m', false),
				$redeTools['vg']->size('4g-5u', false)
			)
		)
	)
));

Configure::write('Media.filter_plus.fact_logo_2', array(
	'fields' => array('FactSite.img2_id'),
	'image' => array(
		'preview' => array(
			'fit' => array(
				$redeTools['hg']->size('4M-g', false),
				$redeTools['vg']->size('M-m', false)
			)
		)
	)
));

Configure::write('Media.filter_plus.mexc_speaker', array(
	'fields' => array('MexcSpeaker.img_id'),
	'image' => array(
		'filter' => array(
			'fit' => array(
				$redeTools['hg']->size('3M-g-2m', false),
				$redeTools['vg']->size('2M-g', false)
			)
		),
		'about_text' => array(
			'fit' => array(
				$redeTools['hg']->size('4M-g-2m', false),
				$redeTools['vg']->size('3M-g', false)
			)
		)
	)
));
