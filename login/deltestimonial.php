<?php 
include 'config.php';
$id = $_GET['id']; 
$akcija = mysqli_query($con,"DELETE from testimonials WHERE id=$id");
if($akcija == true){
	$vrati = array("state"=> 'true');	
	echo json_encode($vrati);
}else{
	$vrati = array("state"=> mysqli_error($con));	
	echo json_encode($vrati);
}
?>
