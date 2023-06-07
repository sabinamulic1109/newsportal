<?php 
session_start(); 
header('Location: cms.php?cms=news');
?>
<?php
$id=$_GET["id"];
include 'config.php'; 
$sql = "SELECT * from novosti where id='$id'"; 
$result = mysqli_query ($con,$sql); 
$row = mysqli_fetch_array($result);
$news=$row["naslov"];
$slika = $row['foto'];
$target = "news/".$slika;
$akcija = mysqli_query($con,"DELETE FROM novosti WHERE id='$id'") ;
if($akcija == true){
	unlink($target);
	$today = date('Y-m-d');
	mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Deleted news ".$news."','".$today."')") ;	
	$_SESSION['msg'] = "Deleted news ".$news;
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Deleted news ".$news;
	$userLog=$date.", ".$user.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
}else{
	$_SESSION['msg2'] = 'News couldn\'t be deleted';
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Error deleting news ".$news.": " . mysqli_error($con);
	$userLog=$date.", ".$user.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
}

?>

 