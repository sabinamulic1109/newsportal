<?php 
include 'config.php';
session_start(); 

$id = $_POST['idfaq']; 
$idgal = $_POST['idgal']; 

$title = $_POST['titleEdit']; 


if(isset($_FILES['photo2']['name'])){
	$random_digit=rand(000000,999999);
	$target = "galerija/"; 
	$target = $target . basename( $_FILES['photo2']['name']); 
	$slikax=($_FILES['photo2']['name']); 
	$ime = $_FILES['photo2']['name'];
	$slika=$random_digit.$slikax;
	$target = "galerija/".$slika;
}else{
	$slikax="";
}


$today = date("Y-m-d h:i:sa");
$sql="SELECT * FROM galerija WHERE id='$id'";
$sql="SELECT * from slike where galerija='$idgal' and id='$id'";
$result=mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)){	
	$naslovG=$row["naslov"];
}

if($slikax == ''){

$akcija = mysqli_query($con,"UPDATE `slike` SET naslov='$title' WHERE id=$id and galerija='$idgal'");

}else{
	$akcija = mysqli_query($con,"UPDATE `slike` SET naslov='$title', foto='$slika' WHERE id=$id and galerija='$idgal'");

	$types = array('image/jpeg','image/jpg', 'image/gif', 'image/png', 'application/pdf');
	if (in_array($_FILES['photo2']['type'], $types)) {
		move_uploaded_file($_FILES['photo2']['tmp_name'], $target);
		$today = date('Y-m-d');
		mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Added new picture','".$today."')") ;
		$msg='<div class="alert alert-success">
		<strong>Photo added!</strong>
		</div>';
		$user=$_SESSION['myusername'];
		$date=date("Y-m-d h:i:sa");
		$function="Edited new picture";
		$userLog=$date.", ".$user.", ".$function."\n";	
		$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
		fwrite($myfile, $userLog);
	}
}

if($akcija == true){
	mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Edited Gallery: ".$naslovG."','".$today."')");
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Edited Gallery: ".$naslovG;
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