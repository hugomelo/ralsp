<?php

$test_link = split('embed', $data['PieGadget']['url']);
if (isset($test_link[1])) {
	$test_link2 = split('frameborder=', $test_link[1]);
	if (isset($test_link2[1])) {
		$test_link[1] = split('"', $test_link[1]);
		$correct_link = 'http://www.youtube.com/embed'.$test_link[1][0];
	} else {
		$correct_link = 'http://www.youtube.com/embed'.$test_link[1];
	}
} else {
	$test_link = split('v=', $data['PieGadget']['url']);
	if (isset($test_link[1])) {
		$test_link2 = split('&feature=', $test_link[1]);
		if (isset($test_link2[1])) {
			$correct_link = 'http://www.youtube.com/embed/'.$test_link2[0];
		} else {
			$correct_link = 'http://www.youtube.com/embed/'.$test_link[1];
		}
	} else {
		$test_link = split('youtu.be/', $data['PieGadget']['url']);
		if (isset($test_link[1])) {
			$correct_link = 'http://www.youtube.com/embed/'.$test_link[1];
		}
	}
}

$height = round($width * $data['PieGadget']['real_height']/$data['PieGadget']['real_width']);

echo '<iframe width="'.$width.'" height="'.$height.'" src="'.$correct_link.'" 
  frameborder="0" allowfullscreen></iframe>';
