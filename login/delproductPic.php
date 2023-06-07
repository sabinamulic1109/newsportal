<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php
$id=$_GET["id"];
include 'config.php'; 
$sql = "SELECT * FROM slikeProduct where id = $id"; 
$result = mysqli_query ($con,$sql); 
$row = mysqli_fetch_array($result);
$naziv=$row["foto"];
$galerija = "Product Photos";
$target = "productPhotos/".$naziv;
$akcija = mysqli_query($con,"DELETE FROM slikeProduct WHERE id='$id'"); 
if($akcija == true){
	unlink($target);
	$today = date("Y-m-d h:i:sa");
	mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Deleted photo ".$naziv." from gallery ".$galerija."','".$today."')") ;	
	$_SESSION['msg'] = 'Photo deleted';
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Deleted photo ".$naziv." from gallery ".$galerija;
	$userLog=$date.", ".$user.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
}else{
	$_SESSION['msg2'] = 'Photo could\'t be deleted!';
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Error deleting picture: " . mysqli_error($con);
	$userLog=$date.", ".$user.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
}
?>

 