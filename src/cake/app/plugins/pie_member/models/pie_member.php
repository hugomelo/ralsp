<?php
class PieMember extends PieMemberAppModel
{
/**
 * Model name.
 * 
 * @var string
 * @access public
 */
	var $name = 'PieMember';

/**
 * Behaviors
 * 
 * @access 
 */
	var $actsAs = array(
		'Containable', 
		'JjMedia.StoredFileHolder' => array('file_id'),
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
