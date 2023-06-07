<?php  
session_start(); 
include 'config.php';
$id = $_GET['id'];

$sql = "SELECT s.*, g.naziv as galime FROM slike s inner join galerija g on s.galerija = g.id where s.id = $id"; 
$result = mysqli_query ($con,$sql); 
$row = mysqli_fetch_array($result);
$naziv=$row["foto"];
$galerija = $row['galime'];
$target = "galerija/".$naziv;
$akcija = mysqli_query($con,"DELETE FROM slike WHERE id='$id'"); 
if($akcija == true){
	unlink($target);
	$today = date('Y-m-d');
	mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Deleted photo ".$naziv." from gallery ".$galerija."','".$today."')") ;	
	$statoOf = 'true';
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Deleted photo ".$naziv." from gallery ".$galerija;
	$userLog=$date.", ".$user.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
}else{
	$statoOf = 'Photo could\'t be deleted!';
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Error deleting picture: " . mysqli_error($con);
	$userLog=$date.", ".$user.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
}
$vrati = array("state"=> $statoOf);	
echo json_encode($vrati);
			
			
?>