<?php
session_start();  
include 'config.php';
$id = $_GET['id']; 

$sql="SELECT * FROM reservation WHERE id='$id'";
$result=mysqli_query($con,$sql);
$rezervacija = array();
while($row = mysqli_fetch_array($result)){	
	$rezervacija[]=$row;
}
echo json_encode($rezervacija);
?>