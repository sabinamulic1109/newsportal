<?php 
session_start(); 
include 'config.php';
include 'replace.php';
$idsen = $_SESSION["id"];
$idrec = $_POST["iduser"];
$subject= replace($_POST["subject"]);
$message= replace($_POST["message"]);
$today = date('Y-m-d');

$akcija = mysqli_query($con,"INSERT INTO mymessages( sender, receiver, date, subject, message) 
		VALUES ($idsen,$idrec,'$today','$subject','$message')");
if($akcija == true){
	$msgid = $con->insert_id;
	$akcijasender = mysqli_query($con,"INSERT INTO messagestatus( status,message, user, type) 
					VALUES ('sent',$msgid,$idsen,1)");
	$akcijareceiver = mysqli_query($con,"INSERT INTO messagestatus( status,message, user, type) 
					VALUES ('inbox',$msgid,$idrec,0)");
	$vrati = array("state"=> 'true');	
	echo json_encode($vrati);
}else{
	$vrati = array("greska"=> mysqli_error($con),"state"=> 'false');		
	echo json_encode($vrati);
}

	
	




 