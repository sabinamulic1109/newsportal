<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php
$id=$_GET["id"];
include 'config.php'; 
$sql = "SELECT * from grupe where id='$id'"; 
$result = mysqli_query ($con,$sql); 
$row = mysqli_fetch_array($result);
$menu=$row["naziv"];

$akcija = mysqli_query($con,"DELETE FROM grupe WHERE id='$id'") ; 
if($akcija == true){
	$today = date('Y-m-d');
	mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Deleted menu item ".$menu."','".$today."')") ;
	$_SESSION['msg'] = 'Menu item deleted';
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Deleted menu item ".$menu;
	$userLog=$date.", ".$user.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
}else{
	$_SESSION['msg2'] = 'Menu item couldn\'t be deleted!';
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Error deleting menu item ".$menu.": " . mysqli_error($con);
	$userLog=$date.", ".$user.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
}

?>

 