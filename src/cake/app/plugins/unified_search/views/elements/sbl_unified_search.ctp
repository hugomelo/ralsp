<?php

/**
 * @var array(string) $type
 * @var array(string) $baseParams
 * @var array(array) $data
 */

switch ($type[0]) {
case 'view':
	switch ($type[1]) {
	case 'index_listing':
		foreach ($data['results'] as $n => $result) {
			echo $this->Bl->box(
				array('class' => 'search-result'), array('size' => '4M-g'),
				"\n" . $this->Jodel->insertModule('UnifiedSearch.SblSearchItem', array('view', 'index_listing'), $result)
			);
		}

		break;

	}
	break;

}
	
