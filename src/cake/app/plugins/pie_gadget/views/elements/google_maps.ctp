<?php

	$gadget = split("src=", $data['PieGadget']['url']);
	$final_gadget = split('<small>', $gadget[1]);
	echo '<iframe width="'.$data['PieGadget']['real_width'].'" height="'.$data['PieGadget']['real_height'].'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src='.$final_gadget[0];
