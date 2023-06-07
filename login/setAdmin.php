<?php  
session_start(); 
include 'config.php';
$id = $_GET['id'];
$check = $_GET['check'];

$sql= "SELECT * FROM `sendmailadmin` WHERE admin = $id";
$result = mysqli_query ($con,$sql);
if($result->num_rows == 0){
	$sql= "INSERT INTO sendmailadmin( admin, sendmail) VALUES ($id,$check)";
	if(mysqli_query ($con,$sql)){ 
		$statoOf = "true";
	}else{ 
		$statoOf = $_SESSION['message'];
	}
}else{
	$sql= "UPDATE sendmailadmin SET sendmail=$check WHERE admin = $id";
	if(mysqli_query ($con,$sql)){ 
		$statoOf = "true";
	}else{ 
		$statoOf = mysqli_error;
	}
}	
$vrati = array("state"=> $statoOf);	
echo json_encode($vrati);
			
			
?>