<?php
class PieLogo extends PieLogoAppModel
{
/**
 * Model name.
 * 
 * @var string
 * @access public
 */
	var $name = 'PieLogo';

/**
 * Behaviors
 * 
 * @access public
 */
	var $actsAs = array(
		'Containable',
		'JjMedia.StoredFileHolder' => array('file_id')
	);

/**
 * belongsTo relationship
 * 
 * @var array
 * @access 
 */
	var $belongsTo = array(
		'SfilStoredFile' => array(
			'className' => 'JjMedia.SfilStoredFile',
			'foreignKey' => 'file_id'
		)
	);
}