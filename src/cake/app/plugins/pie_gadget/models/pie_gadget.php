<?php
class PieGadget extends PieGadgetAppModel {

/**
 * Model name.
 * 
 * @var string
 * @access public
 */
	var $name = 'PieGadget';
	
	function saveContentStream($data) {
		$data['PieGadget']['width'] = 540;
		
		$width = strpos($data['PieGadget']['url'], ' width=');
		if ($width !== false) {
			$width = substr($data['PieGadget']['url'], $width, 12);
			$width = split('"', $width);
			$data['PieGadget']['original_width'] = $width[1];
		}
		$height = strpos($data['PieGadget']['url'], ' height=');
		if ($height !== false) {
			$height = substr($data['PieGadget']['url'], $height, 13);
			$height = split('"', $height);
			$data['PieGadget']['original_height'] = $height[1];
		}
		
		$height_prop = 9 / 16;
		$real_width = $data['PieGadget']['width'];
		if (isset($width[1])) {
			if (isset($height[1])) {
				$height_prop = $height[1] / $width[1];
			}
		}
		$height = $real_width * $height_prop;
		
		if ($height > 450) {
			$height = 450;
			$real_width = 540;
		}
		
		$data['PieGadget']['real_width'] = $real_width;
		$data['PieGadget']['real_height'] = $height;
		
		
		if (strpos($data['PieGadget']['url'], 'youtube') !== false || 
		 strpos($data['PieGadget']['url'], 'youtu.be') !== false) {
			$data['PieGadget']['source'] = 'youtube';
		} elseif (strpos($data['PieGadget']['url'], 'maps.google.com') !== false) {
			$data['PieGadget']['source'] = 'google_maps';
		} elseif (strpos($data['PieGadget']['url'], 'vimeo.com') !== false) {
			$data['PieGadget']['source'] = 'vimeo';
		} elseif (strpos($data['PieGadget']['url'], '8tracks.com') !== false) {
			$data['PieGadget']['source'] = '8tracks';
		} else {
			$data['PieGadget']['source'] = 'free';
		}
		
		return $this->saveAll($data);
	}
}
