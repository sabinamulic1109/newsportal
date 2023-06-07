<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php
$id=$_GET["id"];
if($id == 1 || $id == 2){
	$_SESSION['msg2'] = 'You can not delete admin!';
}else{
	include 'config.php'; 
	$sql = "SELECT * from admin where id='$id'"; 
	$result = mysqli_query ($con,$sql); 
	$row = mysqli_fetch_array($result);
	$user=$row["user"];
	$akcija = mysqli_query($con,"DELETE FROM `admin` WHERE id=$id"); 

	if($akcija == true){
		unlink($target);
		$today = date('Y-m-d');
		mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Deleted user ".$user."','".$today."')") ;		
		$_SESSION['msg'] = 'User deleted';
		$user=$_SESSION['myusername'];
		$date=date("Y-m-d h:i:sa");
		$function="Deleted user ".$user;
		$userLog=$date.", ".$user.", ".$function."\n";				
		$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
		fwrite($myfile, $userLog);
	}else{
		$_SESSION['msg2'] = 'User couldn\'t be deleted';
		$user=$_SESSION['myusername'];
		$date=date("Y-m-d h:i:sa");
		$function="Error deleting user ".$user.": " . mysqli_error($con);
		$userLog=$date.", ".$user.", ".$function."\n";				
		$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
		fwrite($myfile, $userLog);
}
}

?>

 