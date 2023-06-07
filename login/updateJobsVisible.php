<?php 
include 'config.php';
session_start(); 

$jobsid = $_GET['jobsid']; 
$visible = $_GET['visible']; 

$today = date("Y-m-d h:i:sa");

$sql = "SELECT * from jobs where id='$jobsid'"; 
$result = mysqli_query ($con,$sql); 
$row = mysqli_fetch_array($result);
$naziv=$row["naziv"];

$akcija = mysqli_query($con,"UPDATE jobs SET visible='$visible' WHERE id=$jobsid");

if($akcija == true){
	if($visible == 1){
		$funk = 'Made job "'.$naziv.'" visible';
	}else{
		$funk = 'Made job "'.$naziv.'" not visible';
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