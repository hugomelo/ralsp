<?php

/**
 * @var array(string) $type
 * @var array(array) $data
 */

switch ($type[0]) {
case 'view':
	switch ($type[1]) {
	case 'index_listing':
		$fId =$data['SblSearchItem']['foreign_id'];
		switch ($data['SblSearchItem']['model']) {
		case 'MexcNew':
			echo $this->Jodel->insertModule('MexcNews.MexcNew', array('preview', 'unified_search'), $fId);
			break;

		case 'MexcEvent':
			echo $this->Jodel->insertModule('MexcEvents.MexcEvent', array('preview', 'unified_search'), $fId);
			break;

		case 'MexcGallery':
			echo $this->Jodel->insertModule('MexcGalleries.MexcGallery', array('preview', 'unified_search'), $fId);
			break;

		default:
			trigger_error("Type '{$data['SblSearchItem']['type']}' not known.");
		}
		break;
	}
	break;
}
