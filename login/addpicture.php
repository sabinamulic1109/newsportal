<?php

session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);

include 'functions.php';

?>
<?php 
include 'config.php';
include 'replace.php';

$idgl=$_GET["id"]; 

$target = "galerija/"; 
$target = $target . basename( $_FILES['photo1']['name']); 
$random_digit=rand(000000,999999);
$naslov=$_POST["naslov"];
$naslov = replace($naslov);
if(isset($_POST["facebook"])){
	$publish = $_POST["facebook"]; 
}

 
$slikax=($_FILES['photo1']['name']); 
$ime = $_FILES['photo1']['name'];
if($slikax!=""){
	$slika=$random_digit.$slikax;
	/* $slika=$slikax; */
}
$target = "galerija/".$slika; 
if($slikax!=""){
	$sql="SELECT * FROM `slike` WHERE UPPER(foto) = UPPER('$ime') and galerija = $idgl";
	$result=mysqli_query($con,$sql);
	$count=mysqli_num_rows($result);
	if($count>0){
		$_SESSION['msg2']='You already added picture with this name to this gallery!';
	}else{
		$akcija = mysqli_query($con,"INSERT INTO `slike` VALUES (0,'".$idgl."','".$slika."','".$naslov."')");
		if($akcija == true){
			$types = array('image/jpeg','image/jpg', 'image/gif', 'image/png', 'application/pdf');
			if (in_array($_FILES['photo1']['type'], $types)) {
				/* move_uploaded_file($_FILES['photo1']['tmp_name'], $target); */
				
				$upload = $_FILES['photo1']['tmp_name']; 
				$target2 = "galerija/".$slika; 
				$degrees = orientationImage($upload);
				compress_image($upload,$target2,50);
				$target = $target2;
				if($degrees != 0){
					rotateImage($target2,$degrees);
				}

				$today = date('Y-m-d');
				mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Added new picture','".$today."')") ;
				$_SESSION['msg']='Photo added!';
				$user=$_SESSION['myusername'];
				$date=date("Y-m-d h:i:sa");
				$function="Added new picture";
				$userLog=$date.", ".$user.", ".$function."\n";				
				$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
				fwrite($myfile, $userLog);
				
				$sql = "SELECT * from slike where galerija = $idgl order by id DESC limit 1"; 
				$result = mysqli_query ($con,$sql); 
				$row = mysqli_fetch_array($result);
				$imageid = $row['id'];
				$gallerylink = $domenaXV.'/gallery.php?id='.$idgl.'&&image='.$imageid;
				$imagelink = $domenaXV."/login/galerija/".$slika; 
				$_SESSION['publish'] = true;
				/* Ovdje unijeti link do galerije na stranici */
				$_SESSION['target'] = $gallerylink;
				$_SESSION['imagelink'] = $imagelink;
				
				$file = "galerija/".$slika; 
				
				if(isset($_SESSION['fb_access_token'])){
					include 'facebookshare.php';
					$vicituserid = $_SESSION['id'];
					$token = $_SESSION['fb_access_token'];
					if(!empty($token) || $token != ''){
						$sql = "SELECT * from tblfacebookloginaccess where vicituserid = $vicituserid"; 
						$result = mysqli_query ($con,$sql); 
						$row = mysqli_fetch_array($result);
						if($row['shareimage'] == 1){
							postPictureToFacebook($file, $gallerylink);
						}
					}
				}
				
				
				if(isset($_SESSION['oauth_token'])){
					include 'twittershare.php';
					$tokentw = $_SESSION['oauth_token'];
					if(!empty($tokentw) || $tokentw != ''){
						$sql = "SELECT * from tbltwitterloginaccess where id = 1"; 
						$result = mysqli_query ($con,$sql); 
						$row = mysqli_fetch_array($result);
						if($row['shareimage'] == 1){
							postPictureToTwitter($file, $gallerylink);
						}
					}
				}
				/* 
				if(isset($_POST["facebook"])){
					
					$sql = "SELECT * from slike where galerija = $idgl order by id DESC limit 1"; 
					$result = mysqli_query ($con,$sql); 
					$row = mysqli_fetch_array($result);
					$imageid = $row['id'];
					$gallerylink = $domenaXV.'/gallery.php?id='.$idgl.'&&image='.$imageid;
					$imagelink = $domenaXV."/galerija/".$slika; 
					$_SESSION['publish'] = true;
					// Ovdje unijeti link do galerije na stranici 
					$_SESSION['target'] = $gallerylink;
					$_SESSION['imagelink'] = $imagelink;
				} */
			}
			echo $_SESSION['msg'];
		}else{
			$_SESSION['msg2']='Error adding picture!';
		}			
	}	
}
