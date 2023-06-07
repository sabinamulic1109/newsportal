<?php  
session_start(); 
include 'config.php';
$id = $_GET['id'];
$akcija = mysqli_query($con,"DELETE FROM poruke WHERE id='$id'"); 
if($akcija == true){
	
	$statoOf = 'true';
	
}else{
	$statoOf = 'Message could\'t be deleted!';
	
}
$vrati = array("state"=> $statoOf);	
echo json_encode($vrati);
			
			
?>