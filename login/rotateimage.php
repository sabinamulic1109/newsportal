<?php 
ini_set('memory_limit','-1');
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);

include 'config.php';
$id = $_GET["id"];
$degrees = $_GET["degrees"];

$type = $_GET["type"];

switch($type){
	case 'news':
		$sql = "SELECT * from novosti where id='$id'"; 
		$result = mysqli_query ($con,$sql); 
		$row = mysqli_fetch_array($result);
		$fileDok=$row["foto"];
		$target = "news/".$fileDok; 
		$folder = "news/";
		$sqlupdate1 = "UPDATE novosti SET foto = ";
		$sqlupdate2 = " where id='$id'";
		break;
		
	case 'product':
		$sql = "SELECT * from shop_artikli where id='$id'"; 
		$result = mysqli_query ($con,$sql); 
		$row = mysqli_fetch_array($result);
		$fileDok=$row["foto"];
		$target = "shop/".$fileDok; 
		$folder = "shop/";
		$sqlupdate1 = "UPDATE shop_artikli SET foto = ";
		$sqlupdate2 = " where id='$id'";
		break;	
		
	case 'shop':
		$sql = "SELECT * from shop_artikli where magID='$id'"; 
		$result = mysqli_query ($con,$sql); 
		$row = mysqli_fetch_array($result);
		$fileDok=$row["foto"];
		$target = "shop/".$fileDok; 
		$folder = "shop/";
		$sqlupdate1 = "UPDATE shop_artikli SET foto = ";
		$sqlupdate2 = " where magID='$id'";
		break;

	case 'galleryProduct':
		$sql = "SELECT * from slikeProduct where id='$id'"; 
		$result = mysqli_query ($con,$sql); 
		$row = mysqli_fetch_array($result);
		$fileDok=$row["foto"];
		$target = "productPhotos/".$fileDok; 
		$folder = "productPhotos/";
		$sqlupdate1 = "UPDATE slikeProduct SET foto = ";
		$sqlupdate2 = " where id='$id'";
		break;	
		
		
		
	case 'gallery':
		$sql = "SELECT * from slike where id='$id'"; 
		$result = mysqli_query ($con,$sql); 
		$row = mysqli_fetch_array($result);
		$fileDok=$row["foto"];
		$target = "galerija/".$fileDok; 
		$folder = "galerija/";
		$sqlupdate1 = "UPDATE slike SET foto = ";
		$sqlupdate2 = " where id='$id'";
		break;
	case 'content':
		$sql = "SELECT * from tekst where id='$id'"; 
		$result = mysqli_query ($con,$sql); 
		$row = mysqli_fetch_array($result);
		$fileDok=$row["foto"];
		$target = "images/".$fileDok; 
		$folder = "images/";
		$sqlupdate1 = "UPDATE tekst SET foto = ";
		$sqlupdate2 = " where id='$id'";
		break;
	case 'slider':
		$sql = "SELECT * from slider where id='$id'"; 
		$result = mysqli_query ($con,$sql); 
		$row = mysqli_fetch_array($result);
		$fileDok=$row["file"];
		$target = "slider/".$fileDok; 
		$folder = "slider/";
		$sqlupdate1 = "UPDATE slider SET foto = ";
		$sqlupdate2 = " where id='$id'";
		break;
}

$rotateFilename = $target; /* // PATH */

$fileType = strtolower(substr($fileDok, strrpos($fileDok, '.') + 1));

if($fileType == 'png'){
	echo 'png je';
	header('Content-type: image/png');
	$source = imagecreatefrompng($rotateFilename);
	$bgColor = imagecolorallocatealpha($source, 255, 255, 255, 127);
	/* // Rotate */
	$rotate = imagerotate($source, $degrees, $bgColor);
	imagesavealpha($rotate, true);
	$realPath = $folder.'2'.$fileDok;
	imagepng($rotate,$realPath);
	$newphoto = '2'.$fileDok;
	$sqlupdatefinal = $sqlupdate1."'$newphoto'".$sqlupdate2;
	$result = mysqli_query ($con,$sqlupdatefinal);  
	unlink($rotateFilename);
}

if($fileType == 'jpg' || $fileType == 'jpeg'){
	echo 'jpg je';
	header('Content-type: image/jpeg');
	$source = imagecreatefromjpeg($rotateFilename);
	/* // Rotate */
	$rotate = imagerotate($source, $degrees, 0);
	$realPath = $folder.'2'.$fileDok;
	imagejpeg($rotate,$realPath);
	$newphoto = '2'.$fileDok;
	$sqlupdatefinal = $sqlupdate1."'$newphoto'".$sqlupdate2;
	$result = mysqli_query ($con,$sqlupdatefinal);
	unlink($rotateFilename);
}

imagedestroy($source);
imagedestroy($rotate);


?>

