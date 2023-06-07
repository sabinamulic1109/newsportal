<?php
session_start();  
include 'config.php';
$id = $_GET['id']; 
$today = date("Y-m-d");
$sql="SELECT * FROM tblfaq WHERE id='$id'";
$result=mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)){	
	$naslovT=$row["question"];
}
$akcija = mysqli_query($con,"UPDATE `tblfaq` SET approved = 1 WHERE id=$id");
if($akcija == true){
	$sql = "SELECT * FROM tblfaq WHERE id = $id"; 
	mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Approved question: ".$naslovT."','".$today."')");
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Approved question: ".$naslovT;
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