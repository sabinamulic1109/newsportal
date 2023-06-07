<?php 
include 'config.php';
session_start();  

$id = $_POST['idgal']; 
$title = $_POST['titleedit'];
$today = date("Y-m-d");
$sql="SELECT * FROM galerija WHERE id='$id'";
$result=mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)){	
	$naslovT=$row["naziv"];
}


$akcija = mysqli_query($con,"UPDATE `galerija` SET naziv = '$title' WHERE id=$id");
if($akcija == true){
	mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Edited gallery : ".$naslovT."','".$today."')");
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Edited gallery: ".$naslovT;
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