<?php

	if (strpos($data['PieGadget']['url'], 'vimeo.com') !== false && strpos($data['PieGadget']['url'], 'iframe') === false)
	{
		$gadget = split('vimeo.com', $data['PieGadget']['url']);
		if (isset($gadget[1]))
		{
			echo '<iframe src="https://player.vimeo.com/video'.$gadget[1].'?title=0&amp;byline=0&amp;portrait=0" width="'.$data['PieGadget']['real_width'].'" height="'.$data['PieGadget']['real_height'].'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
		}
	}
	else
	{
		echo  $data['PieGadget']['url'];
	}
