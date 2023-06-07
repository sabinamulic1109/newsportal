<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php
$id=$_GET["id"];
include 'config.php'; 

$akcija = mysqli_query($con,"DELETE FROM poruke WHERE id='$id'"); 
if($akcija == true){
	
	$_SESSION['msg'] = 'Message deleted';
	
}else{
	$_SESSION['msg2'] = 'Message could\'t be deleted!';
	
}
?>

 