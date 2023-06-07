<?php 
session_start(); 
include 'config.php';
$id = $_GET['id']; 
$sql="SELECT * FROM reservation WHERE id='$id'";
$today = date("Y-m-d");
$result=mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)){	
	$naslovT=$row["name"];
}
$akcija = mysqli_query($con,"DELETE FROM reservation WHERE id=$id");
if($akcija == true){
	mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Deleted reservation from: ".$naslovT."','".$today."')");
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Deleted reservation from: ".$naslovT;
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