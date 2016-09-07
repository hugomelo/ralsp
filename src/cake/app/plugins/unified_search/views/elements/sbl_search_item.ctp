<?php

/**
 * @var array(string) $type
 * @var array(array) $data
 */

switch ($type[0]) {
case 'view':
	switch ($type[1]) {
	case 'index_listing':
		switch ($data['SblSearchItem']['model']) {
		case 'MexcNew':
			echo $this->Jodel->insertModule('MexcNews.MexcNew', array('preview', 'unified_search'), $data);
			break;

		case 'MexcEvent':
			echo $this->Jodel->insertModule('MexcEvents.MexcEvent', array('preview', 'unified_search'), $data);
			break;

		case 'MexcGallery':
			echo $this->Jodel->insertModule('MexcGalleries.MexcGallery', array('preview', 'unified_search'), $data);
			break;

		case 'MexcDocument':
			echo $this->Jodel->insertModule('MexcDocuments.MexcDocument', array('preview', 'unified_search'), $data);
			break;

		default:
			trigger_error("Model '{$data['SblSearchItem']['model']}' not known.");
		}
		break;
	}
	break;
}
