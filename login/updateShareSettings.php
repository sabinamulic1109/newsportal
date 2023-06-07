<?php  
	session_start(); 
	include 'config.php';
	
	$vicituserid = $_SESSION['id'];
	
	$table = $_POST['tbl'];
	if($table == 'facebook'){
		$do = true;
		$tablename = 'tblfacebookloginaccess';
		$where = 'vicituserid = '.$vicituserid;
	}elseif($table == 'twitter'){
		$do = true;
		$tablename = 'tbltwitterloginaccess';
		$where = 'id = 1';
	}else{
		$do = false;
		$statoOf = "Wrong table";
	}

	if($do == true){
		$column = $_POST['column'];
		$value = $_POST['value'];
		
		$sql= "UPDATE $tablename SET $column = $value WHERE $where";
		if(mysqli_query ($con,$sql)){ 
			$statoOf = "true";
		}else{ 
			$statoOf = mysqli_error;
		}
	}
	
	$vrati = array("state"=> $statoOf);	
	echo json_encode($vrati);
					
?>