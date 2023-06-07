<?php
session_start();  
header('Location: '.$_SERVER['HTTP_REFERER']);
/*ini_set('memory_limit','-1');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);*/
include 'config.php';


include 'functions.php';


 $idgl=$_GET["id"];
/*	$sql1 = "SELECT * from novosti where id='$idgl'"; 
	$result1 = mysqli_query ($con,$sql1); 
	$row1 = mysqli_fetch_array($result1);

	$idDok=$row1["id"];
	$naslovS=$row1["naslov"];
	$podnaslovS=$row1["podnaslov"];
	$tekstS=$row1["tekst"];
	$gpS=$row1["grupa"];

	$fileDok=$row1["foto"];*/
	
	
	if(isset($_POST)){
		$target = "productPhotos/"; 
		$target = $target . basename( $_FILES['photo1']['name']); 
		$random_digit=rand(000000,999999);
		$naslov=$_POST["naslov"];
		$naslov = str_replace("\\", '', $naslov);
		$naslov = str_replace("'","\'", $naslov);

		$slikax=($_FILES['photo1']['name']); 
		$ime = $_FILES['photo1']['name'];
		if($slikax!=""){
			$slika=$random_digit.$slikax;
		}
		$target = "productPhotos/".$slika; 
		if($slikax!=""){
			$sql="SELECT * FROM `slikeProduct` WHERE UPPER(foto) LIKE UPPER('%$ime%') and galerija = $idgl";
			$result=mysqli_query($con,$sql);
			$count=mysqli_num_rows($result);
			if($count>0){
				$$_SESSION['msg2']='You already added picture with this name to this product!';
			}else{
				$akcija = mysqli_query($con,"INSERT INTO `slikeProduct` VALUES (0,'".$idgl."','".$slika."','".$naslov."')");
				if($akcija == true){
					$types = array('image/jpeg','image/jpg', 'image/gif', 'image/png', 'application/pdf');
					if (in_array($_FILES['photo1']['type'], $types)) {
					/*	move_uploaded_file($_FILES['photo1']['tmp_name'], $target);*/
						$upload = $_FILES['photo1']['tmp_name']; 
						$target2 = "productPhotos/".$slika; 
						$degrees = orientationImage($upload);
						compress_image($upload,$target2,50);
						$target = $target2;
						if($degrees != 0){
							rotateImage($target2,$degrees);
						}
						$today = date("Y-m-d h:i:sa");
						mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Added new picture','".$today."')") ;
						$_SESSION['msg']='Photo added!';
						$user=$_SESSION['myusername'];
						$date=date("Y-m-d h:i:sa");
						$function="Added new product picture";
						$userLog=$date.", ".$user.", ".$function."\n";				
						$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
						fwrite($myfile, $userLog);
					}
				}else{
					$_SESSION['msg2']='Error adding product picture!';
				}			
			}	
		}

	}	

?>