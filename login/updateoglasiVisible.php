<?php 
include 'config.php';
session_start(); 

$oglasiid = $_GET['oglasiid']; 
$visible = $_GET['visible']; 

$today = date("Y-m-d h:i:sa");

$sql = "SELECT * from oglasi where id='$oglasiid'"; 
$result = mysqli_query ($con,$sql); 
$row = mysqli_fetch_array($result);
$aboutnaslov=$row["naslov"];

$akcija = mysqli_query($con,"UPDATE oglasi SET visible='$visible' WHERE id=$oglasiid");

if($akcija == true){
	if($visible == 1){
		$funk = 'Made oglas "'.$aboutnaslov.'" visible';
	}else{
		$funk = 'Made oglas "'.$aboutnaslov.'" not visible';
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