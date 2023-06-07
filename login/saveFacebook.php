<?php
session_start();  
include 'config.php';
include 'replace.php';

$page= replace($_POST["facebookpage"]);
$api= $_POST["apikey"];
$sec= $_POST["securitykey"];
$pageid= $_POST["pageid"];
$appid= $_POST["appid"];

$today = date("Y-m-d");

$akcija = mysqli_query($con,"UPDATE `facebookconnect` 
	SET facebookpage='$page',
	apikey='$api',
	securitykey='$sec', 
	appid='$appid',
	pageid='$pageid',
	WHERE id=1");
if($akcija == true){
	mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Updated facebook connection data','".$today."')");
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Updated facebook connection data";
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