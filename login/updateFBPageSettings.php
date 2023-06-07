<?php  
	session_start(); 
	include 'config.php';

	$vicituserid = $_SESSION['id'];
	
	$pageid = $_POST['pageid'];
	$pagename = $_POST['pagename'];	
	$pagetoken = $_POST['value'];
		
	$sql= "UPDATE tblfacebookloginaccess SET pageid = '$pageid',
		pagename = '$pagename',
		pagetoken = '$pagetoken' WHERE vicituserid = $vicituserid";
	if(mysqli_query ($con,$sql)){ 
		$statoOf = "true";
	}else{  
		$statoOf = mysqli_error;
	}

	
	$vrati = array("state"=> $statoOf);	
	echo json_encode($vrati);
					
?>