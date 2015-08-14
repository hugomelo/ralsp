<?php

/**
 *
 * Copyright 2010-2013, Preface Design LTDA (http://www.preface.com.br)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2010-2013, Preface Design LTDA (http://www.preface.com.br)
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link          https://github.com/prefacedesign/jodeljodel Jodel Jodel public repository 
 */

class MexcSpacesSblSearchItem extends UnifiedSearchAppModel
{
	var $name = 'MexcSpacesSblSearchItem';
	
	var $belongsTo = array(
		'UnifiedSearch.SblSearchItem',
		'MexcSpaces.MexcSpace'
	);
}
