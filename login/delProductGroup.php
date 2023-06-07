<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php
$id=$_GET["id"];
include 'config.php'; 
$sql = "SELECT * from shop_group where id='$id'"; 
$result = mysqli_query ($con,$sql); 
$row = mysqli_fetch_array($result);
$news=$row["naziv"];




$akcija = mysqli_query($con,"DELETE FROM shop_group WHERE id='$id'") ;
if($akcija == true){

	$today = date('Y-m-d');
	mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Deleted shop group ".$news."','".$today."')") ;	
	$_SESSION['msg'] = "Deleted shop group ".$news;
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Deleted shop group ".$news;
	$userLog=$date.", ".$user.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
}else{
	$_SESSION['msg2'] = 'Shop group couldn\'t be deleted';
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Error deleting shop group ".$news.": " . mysqli_error($con);
	$userLog=$date.", ".$user.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
}

?>

 