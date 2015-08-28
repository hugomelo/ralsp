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
		echo $this->Bl->sdiv(array('class' => "posts-list"), array());
			foreach ($data['results'] as $n => $result) {
				$model = strtolower(str_replace('Mexc','', $result['SblSearchItem']['model']));
				echo $this->Bl->sdiv(array('class' => "col-xs-12 col-sm-6 col-md-4"), array());
					echo $this->Bl->sdiv(array('class' => "post $model"), array());
						echo $this->Jodel->insertModule('UnifiedSearch.SblSearchItem', array('view', 'index_listing'), $result);
					echo $this->Bl->ediv();
				echo $this->Bl->ediv();
			}
		echo $this->Bl->ediv();
		break;

	}
	break;

}
	
