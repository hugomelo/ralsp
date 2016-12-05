<?php

	$gadget = split("width=", $data['PieGadget']['url']);
	echo $gadget[0] . ' width="'.$data['PieGadget']['real_width'].'" height="'.$data['PieGadget']['real_height'].'" style="border: 0px none;"></iframe>';
