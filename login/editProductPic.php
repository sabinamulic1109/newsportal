<?php 
include 'config.php';
include 'functions.php';
session_start();  

$id = $_POST['idfaq']; 
$idgal = $_POST['idgal']; 
$idtip = $_POST['idtip']; 
$title = $_POST['titleEdit']; 
$title=str_replace("'", '`', $title);

$target = "productPhotos/"; 
		$target = $target . basename( $_FILES['photo2']['name']); 
		$random_digit=rand(000000,999999);
//$slikax=$_REQUEST["photo2"];
		$slikax=($_FILES['photo2']['name']); 
		$ime = $_FILES['photo2']['name'];
	if($slikax!=""){
			$slika=$random_digit.$slikax;
		}
		//echo $slika;
	//$slika1=explode('/',$slika)	;
	//$slika=$slika1[1];
$target = "productPhotos/".$slika;


$today = date("Y-m-d h:i:sa");
$sql="SELECT * FROM shop_artikli WHERE id='$id'";
$sql="SELECT * from slikeProduct where galerija='$idgal' and id='$id'";
$result=mysqli_query($con,$sql);
$foto="";
while($row = mysqli_fetch_array($result)){	
	$naslovG=$row["naslov"];
	$foto=$row["foto"];
}
$target1 = "productPhotos/".$foto;
if(empty($slika)){
	
	$akcija = mysqli_query($con,"UPDATE `slikeProduct` SET naslov='$title' WHERE id=$id and galerija='$idgal'");
	
}else{
	
	unlink($target1);
	$akcija = mysqli_query($con,"UPDATE `slikeProduct` SET naslov='$title', foto='$slika' WHERE id=$id and galerija='$idgal'");
	
	$types = array('image/jpeg','image/jpg', 'image/gif', 'image/png', 'application/pdf');
					if (in_array($_FILES['photo2']['type'], $types)) {
						/*move_uploaded_file($_FILES['photo2']['tmp_name'], $target);*/
						$upload = $_FILES['photo2']['tmp_name']; 
						$target2 = "productPhotos/".$slika; 
						$degrees = orientationImage($upload);
						compress_image($upload,$target2,50);
						$target = $target2;
						if($degrees != 0){
							rotateImage($target2,$degrees);
						}
						$today = date("Y-m-d h:i:sa");
						mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Added product picture','".$today."')") ;
						$msg='<div class="alert alert-success">
							<strong>Photo added!</strong>
						</div>';
						$user=$_SESSION['myusername'];
						$date=date("Y-m-d h:i:sa");
						$function="Edited product picture";
						$userLog=$date.", ".$user.", ".$function."\n";				
						$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
						fwrite($myfile, $userLog);
					}
}




//var_dump($slika1);

//echo $slika;

//echo "UPDATE `slike` SET naslov='$title', foto='$slika' WHERE id=$id and tip='$idtip' and galerija='$idgal'";
//$akcija = mysqli_query($con,"UPDATE `slike` SET naslov='$title', foto='$slika' WHERE id=$id and tip='$idtip' and galerija='$idgal'");

if($akcija == true){
	

					
	
	mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Edited Picture: ".$naslovG."','".$today."')");
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Edited Picture: ".$naslovG;
	$userLog=$date.", ".$user.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
	
	$vrati = array("state"=> 'true');	
	echo json_encode($vrati);
}else{
	$vrati = array("state"=> mysqli_error($con));	
	echo json_encode($vrati);
}

?>
