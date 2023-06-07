<?php

include 'functions.php';
include 'config.php';
include 'replace.php';





/*

    $order_id = $_POST['order_id'];

    $order_info = $_POST['order_info'];

    
	
	$akcija = mysqli_query($con,"UPDATE `orders` set klijent='$client', naslov='$title', podnaslov='$subtitle', url='$url' where id='$id'");
	if($akcija == true){

    $updateOrderInfo_query = $db->prepare("

							UPDATE idk_orders

                            SET order_info = :order_info, order_datemodified = NOW()

							WHERE order_id = :order_id");

						

	$updateOrderInfo_query->execute(array(

		':order_id' => $order_id,

        ':order_info' => $order_info

        ));*/





    $order_id = $_POST['order_id'];

    $status_id = $_POST['status_id'];

	$dateM=date("Y-m-d H:i:s");
    
	$akcija = mysqli_query($con,"UPDATE `orders` set order_status='$status_id', order_datemodified='$dateM' where order_id='$order_id'");
	if($akcija == true){	
	$vrati = 'true';
	}else{
	$vrati = 'Status could not be changed!';
	}

echo json_encode($vrati);




?>