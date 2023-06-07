<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php
$id=$_GET["id"];
include 'config.php'; 
$sql = "SELECT * from shop_artikli where id='$id'"; 
$result = mysqli_query ($con,$sql); 
$row = mysqli_fetch_array($result);
$news=$row["naziv"];
$slika = $row['foto'];
$magID = $row["magID"];
$target = "magazine/".$slika;
$target2 = "shop/".$slika;

$akcija = mysqli_query($con,"DELETE FROM shop_artikli WHERE id='$id'") ; 
if($magID!=null){
	$akcija1 = mysqli_query($con,"DELETE FROM magazin WHERE id='$id'") ;
}

if($akcija == true){
		unlink($target);
	if($magID!=null){
		unlink($target2);
	}
	$today = date('Y-m-d');
	mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Deleted product ".$news."','".$today."')") ;	
	$_SESSION['msg'] = "Deleted product ".$news;
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Deleted product ".$news;
	$userLog=$date.", ".$user.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
}else{
	$_SESSION['msg2'] = 'Product couldn\'t be deleted';
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Error deleting product ".$news.": " . mysqli_error($con);
	$userLog=$date.", ".$user.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
}

?>



 