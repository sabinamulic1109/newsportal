<?php 
session_start(); 
header('Location: cms.php?cms=jobs');
?>
<?php
$id=$_GET["id"];
include 'config.php'; 
$sql = "SELECT * from jobs where id='$id'"; 
$result = mysqli_query ($con,$sql); 
$row = mysqli_fetch_array($result);
    $naziv=$row["naziv"];
	$lokacija=$row["lokacija"];
	$opis=$row["opis"];
	$kvalifikacije=$row["kvalifikacije"];
	$datum=$row["datum"];
$akcija = mysqli_query($con,"DELETE FROM jobs WHERE id='$id'") ;
if($akcija == true){
	unlink($target);
	$today = date('Y-m-d');
	mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Deleted jobs ".$jobs."','".$today."')") ;	
	$_SESSION['msg'] = "Deleted jobs ".$jobs;
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Deleted jobs ".$jobs;
	$userLog=$date.", ".$user.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
}else{
	$_SESSION['msg2'] = 'jobs couldn\'t be deleted';
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Error deleting jobs ".$jobs.": " . mysqli_error($con);
	$userLog=$date.", ".$user.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
}

?>

 