<?php 
include 'config.php';
session_start();  

$id = $_GET['id']; 
$today = date("Y-m-d");
$sql="SELECT * FROM testimonials WHERE id='$id'";
$result=mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)){	
	$naslovT=$row["testimonial"];
}

$id = $_GET['id']; 
$akcija = mysqli_query($con,"UPDATE `testimonials` SET approved = 1 WHERE id=$id");
if($akcija == true){
	
	mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Approved testimonial: ".$naslovT."','".$today."')");
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Approved testimonial: ".$naslovT;
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
