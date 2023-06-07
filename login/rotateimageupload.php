<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$exif = exif_read_data($target);

$ort = $exif['Orientation']; /*STORES ORIENTATION FROM IMAGE */
$ort1 = $ort;
$exif = exif_read_data($target, 0, true);
if (!empty($ort1)){
	$fileType = strtolower(substr($target, strrpos($target, '.') + 1));
	if($fileType == 'png'){
		$image = imagecreatefrompng($target);
	}

	if($fileType == 'jpg' || $fileType == 'jpeg'){
		$image = imagecreatefromjpeg($target);
	}
	/* $image = imagecreatefromjpeg($target); */
	$ort = $ort1;
	switch ($ort) {
		case 3:
			$image = imagerotate($image, 180, 0);
			break;

		case 6:
			$image = imagerotate($image, -90, 0);
			break;

		case 8:
			$image = imagerotate($image, 90, 0);
			break;
	}
}
if($fileType == 'png'){
		imagepng($image,$target,90);
	}

	if($fileType == 'jpg' || $fileType == 'jpeg'){
		imagejpeg($image,$target, 90);
	}

 
?>