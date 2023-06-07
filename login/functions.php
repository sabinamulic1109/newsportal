<?php
ini_set('memory_limit','-1');
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);  */


function orientationImage($target){
	$degrees = 0;
	$exif = exif_read_data($target);
	if(isset($exif['Orientation'])){
		$ort = $exif['Orientation']; /*STORES ORIENTATION FROM IMAGE */
		$ort1 = $ort;
		$exif = exif_read_data($target, 0, true);
		if (!empty($ort1)){
			$ort = $ort1;
			switch ($ort){
				case 3:
					$degrees = 180;
					break;
				case 6:
					$degrees = -90;
					break;
				case 8:
					$degrees = 90;
					break;
			}
		}
	}	
	return $degrees;
}

function compress_image($source_url, $destination_url, $quality) {
	$info = getimagesize($source_url);
	$sizeinkb = filesize($source_url)/1024;

	if($sizeinkb < 2500 && $sizeinkb > 1301 ){
		$quality = 20;
		$quality2 = 2;
	}
	elseif($sizeinkb < 1300 && $sizeinkb > 501 ){
		$quality = 30;
		$quality2 = 3;
	}elseif($sizeinkb < 500){
		$quality = 55;
		$quality2 = 5;
	}else{
		$quality = 15;
		$quality2 = 1;
	}
	if ($info['mime'] == 'image/jpeg'){
		$image = imagecreatefromjpeg($source_url);
		imagejpeg($image, $destination_url, $quality);			
	}
	elseif ($info['mime'] == 'image/gif'){
		$image = imagecreatefromgif($source_url);
		imagegif($image, $destination_url, $quality);
	}		
	elseif ($info['mime'] == 'image/png'){
		/*move_uploaded_file($source_url, $destination_url); */
		$image = imagecreatefrompng($source_url);
		$quality = $quality + 20;
		imagejpeg($image, $destination_url, $quality);
	}

	/* imagejpeg($image, $destination_url, $quality);	 */
	return $destination_url;
}

function rotateImageUpload($target, $destination_url, $quality){

	$exif = exif_read_data($target);
	$fileType = strtolower(substr($target, strrpos($target, '.') + 1));
	if(isset($exif['Orientation'])){
		$ort = $exif['Orientation']; /*STORES ORIENTATION FROM IMAGE */
		$ort1 = $ort;
		$exif = exif_read_data($target, 0, true);
		if (!empty($ort1)){
			
			if($fileType == 'png'){
				$image = imagecreatefrompng($target);
			}elseif($fileType == 'jpg' || $fileType == 'jpeg'){
				$image = imagecreatefromjpeg($target);

			}else{
				$image = imagecreatefromjpeg($target);
			}

			$ort = $ort1;
			switch ($ort) {
				case 3:
					echo 'Rotira 180';
					$image = imagerotate($image, 180, 0);
					break;

				case 6:
					echo 'Rotira -90';
					$image = imagerotate($image, -90, 0);
					break;

				case 8:
					echo 'Rotira 90';
					$image = imagerotate($image, 90, 0);
					break;
			}
			echo '<pre>'; var_dump($image); echo '</pre>';	
			//compress_image($image, $destination_url, $quality);

		}
	}else{
		compress_image($target, $destination_url, $quality);
	}
	
	
	
	return $target;
}

function rotateImage($target, $degrees){

	$rotateFilename = $target; /* // PATH */
	$fileDok = $target;
	$fileType = strtolower(substr($fileDok, strrpos($fileDok, '.') + 1));

	if($fileType == 'png'){
		/* header('Content-type: image/png'); */
		$source = imagecreatefrompng($rotateFilename);
		$bgColor = imagecolorallocatealpha($source, 255, 255, 255, 127);
		/* // Rotate */
		$rotate = imagerotate($source, $degrees, $bgColor);
		imagesavealpha($rotate, true);
		$rotateFilename2 = 'rotated'.$fileDok;
		imagepng($rotate,$rotateFilename);
	}

	if($fileType == 'jpg' || $fileType == 'jpeg'){
		/* header('Content-type: image/jpeg'); */
		$source = imagecreatefromjpeg($rotateFilename);
		/* // Rotate */
		$rotate = imagerotate($source, $degrees, 0);
		$rotateFilename2 = 'rotated'.$fileDok;
		imagejpeg($rotate,$rotateFilename);
	}

	imagedestroy($source);
	imagedestroy($rotate);
	
	return $target;
}

?>