<?php 
session_start(); 
header('Location: cms.php?cms=oglasi');
?>
<?php
$id=$_GET["id"];
include 'config.php'; 
$sql = "SELECT * from oglasi where id='$id'"; 
$result = mysqli_query ($con,$sql); 
$row = mysqli_fetch_array($result);
$oglasi=$row["naslov"];
$slika = $row['foto'];
$target = "oglasi/".$slika;
$akcija = mysqli_query($con,"DELETE FROM oglasi WHERE id='$id'") ;
if($akcija == true){
	unlink($target);
	$today = date('Y-m-d');
	mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Deleted oglasi ".$oglasi."','".$today."')") ;	
	$_SESSION['msg'] = "Deleted oglasi ".$oglasi;
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Deleted oglasi ".$oglasi;
	$userLog=$date.", ".$user.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
}else{
	$_SESSION['msg2'] = 'oglasi couldn\'t be deleted';
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Error deleting oglasi ".$oglasi.": " . mysqli_error($con);
	$userLog=$date.", ".$user.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
}

?>

 