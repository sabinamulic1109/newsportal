<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php
$id=$_GET["id"];
include 'config.php'; 
$sql = "SELECT * FROM dokumenti  where id = $id"; 
$result = mysqli_query ($con,$sql); 
$row = mysqli_fetch_array($result);
$naziv=$row["naslov"];
$target  = $row['file'];
$akcija = mysqli_query($con,"DELETE FROM dokumenti WHERE id='$id'"); 
if($akcija == true){
	unlink($target);
	$today = date('Y-m-d');
	mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Deleted file ".$naziv."','".$today."')") ;	
	$_SESSION['msg'] = 'File deleted';
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Deleted file ".$naziv;
	$userLog=$date.", ".$user.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
}else{
	$_SESSION['msg2'] = 'File could\'t be deleted!';
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Error deleting file: " . mysqli_error($con);
	$userLog=$date.", ".$user.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
}
?>