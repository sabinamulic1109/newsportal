<?php 
include 'config.php';
session_start(); 

$newsid = $_GET['newsid']; 
$visible = $_GET['visible']; 

$today = date("Y-m-d h:i:sa");

$sql = "SELECT * from shop_artikli where id='$newsid'"; 
$result = mysqli_query ($con,$sql); 
$row = mysqli_fetch_array($result);
$aboutnaslov=$row["naziv"];
$magID = $row["magID"];


$akcija = mysqli_query($con,"UPDATE shop_artikli SET visible='$visible' WHERE id='$newsid'");

if($magID!=null){

$akcija = mysqli_query($con,"UPDATE magazin SET visible='$visible' WHERE id='$magID'");
}

if($akcija == true){
	if($visible == 1){
		$funk = 'Made product "'.$aboutnaslov.'" visible';
	}else{
		$funk = 'Made product "'.$aboutnaslov.'" not visible';
	}
	mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','".$funk."','".$today."')");
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function=$funk;
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