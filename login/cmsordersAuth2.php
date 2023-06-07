<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['messages'] == 0){
echo '<script>window.location.href = "cms.php?cms=welcome"</script>';
}
?>
<style>

@media only screen and (min-device-width: 0px) and (max-device-width: 420px) and (-webkit-min-device-pixel-ratio: 2){
	#tabelaOrder{font-size:12px!important;}
}

@media screen and (max-width:420px){
	#tabelaOrder{font-size:12px!important;}
}


</style>
<div align="left">
<?php
$ID=$_GET['ID'];
$sql = "SELECT * FROM orders WHERE order_id=$ID";
$result = mysqli_query ($con,$sql); 
while($row = mysqli_fetch_array($result)){



$order_subscribe_product_id = $row["order_subscribe_product_id"];

$order_subscribe_typename = $row["order_subscribe_typename"];

$order_subscribe_price = $row['order_subscribe_price'];
?>	

<input type="hidden" class="form-control" name="order_id" id="order_id" value="<?php echo $ID; ?>" />
<table id="tabelaOrder" width="100%" border="0">
<tr>
<td colspan="2">
<h2 style="font-size: 30px;" ><i class="far fa-credit-card"></i>  Order number: <?php echo $row["order_number"]; ?>  </h2>
<?php 
	$created= $row["order_datecreated"];
	$created1=explode(" ", $created);
	
	$modify= $row["order_datemodified"];
	$modify1=explode(" ", $modify);
		?>
	<b>Created: </b> <?php echo $created1[0];  ?>    <b>Modified: </b> <?php echo $modify1[0];  ?>

<td>
</tr>

<th style="width:50%;"> 
Order Info
</th>
<th style="width:50%;"> Customer Info

</th>

<tr >
<td style="vertical-align: top;width:50%;padding:20px">
<b>Order status: </b> 
<?php
$status= $row["order_status"];
$statusName="";
$statusColor="";
if($status=="0"){$statusName="New";$statusColor="#5bc0de";}
else if($status=="1"){$statusName="Archived";$statusColor="#777";}
else if($status=="2"){$statusName="Canceled";$statusColor="#d9534f";}
else if($status=="3"){$statusName="Processed";$statusColor="#5cb85c";}
else if($status=="4"){$statusName="Rejected";$statusColor="#d9534f";}
else if($status=="5"){$statusName="On hold";$statusColor="#337ab7";}
else {$statusName="Unknown";$statusColor="black";}
?>
<select name="grupa" id="grupa" style="width:20%;height:30px; border:#941046 solid 1px; padding:0px 5px; margin:0;border-radius: 5px; ">

<option style="font-weight: bold; color:<?php echo $statusColor; ?>;" value="<?php echo $status; ?>" selected><?php echo $statusName; ?></option>
<option style="color:#5bc0de; " value="0">New</option>
<option style="color:#777; "value="1">Archived</option>
<option style="color:#d9534f; "value="2">Canceled</option>
<option style="color:#5cb85c; "value="3">Processed</option>
<option style="color:#d9534f; "value="4">Rejected</option>
<option style="color:#337ab7; "value="5">On hold</option>

	</select> <br><br>
<b>Subtotal:</b> $ <?php echo $row["order_originalamount"]; ?><br>
<b>Total:</b> $ <?php echo $row["order_amount"]; ?><br>
<b>Order Number:</b> <?php echo $row["order_number"]; ?><br>
<b>Order Info:</b> <?php echo $row["order_info"]; ?><br>
<hr>
<b>Authorize.Net Transaction ID:</b> <?php echo $row["order_authorizenet_transId"]; ?><br>
<b>Authorize.Net Authorization:</b> <?php echo $row["order_authorizenet_authorization"]; ?><br>
<b>Authorize.Net Account Type:</b> <?php echo $row["order_authorizenet_accountType"]; ?><br>
<b>Authorize.Net Account Number:</b> <?php echo $row["order_authorizenet_accountNumber"]; ?><br>
</td>

<td style="vertical-align: top;width:50%;padding:20px">
<?php $customerId= $row["order_customerid"]; 

$sql1 = "SELECT * FROM customers WHERE customer_id=$customerId";
$result1 = mysqli_query ($con,$sql1); 
while($row1 = mysqli_fetch_array($result1)){


?>

<b>Customer: </b> <?php echo $row1["customer_full_name"]; ?><br>
<b>Email: </b> <?php echo $row1["customer_email"]; ?><br>
<b>Phone: </b> <?php echo $row1["customer_phone"]; ?><br>
<b>Address: </b> <?php echo $row1["customer_address_line_1"]; ?><br>
<b>Additional Address: </b> <?php echo $row1["customer_address_line_2"]; ?><br>
<b>City: </b> <?php echo $row1["customer_city"]; ?><br>
<b>Zip: </b> <?php echo $row1["customer_zip"]; ?><br>
<b>State: </b> <?php echo $row1["customer_stateprovince"]; ?><br>
<b>Country: </b> <?php echo $row1["customer_country"]; ?><br>
<hr>
<h2>Shipping</h2>
<b>Shipping Customer: </b> <?php echo $row1["ship_customer_first_name"]; ?> <?php echo $row1["ship_customer_last_name"]; ?><br>
<b>Shipping Email: </b> <?php echo $row1["ship_customer_email"]; ?><br>
<b>Shipping Phone: </b> <?php echo $row1["ship_customer_phone"]; ?><br>
<b>Shipping Address: </b> <?php echo $row1["ship_customer_address_line_1"]; ?><br>
<b>Shipping Additional Address: </b> <?php echo $row1["ship_customer_address_line_2"]; ?><br>
<b>Shipping City: </b> <?php echo $row1["ship_customer_city"]; ?><br>
<b>Shipping Zip: </b> <?php echo $row1["ship_customer_zip"]; ?><br>
<b>Shipping State: </b> <?php echo $row1["ship_customer_stateprovince"]; ?><br>
<b>Shipping Country: </b> <?php echo $row1["ship_customer_country"]; ?><br>
<?php } ?>
</td>
</tr>
<?php
}
?>	
<tr >
<td colspan="2">

<?php if(is_null($order_subscribe_product_id) && is_null($order_subscribe_typename)) { 

?>


<table width="100%" border="0">
<th style="width:30%;"></th>
<th style="width:30%;">Product</th>
<th style="width:10%;">Quantity</th>
<th style="width:10%;">Price</th>
<th style="width:10%;">Discount</th>
<th style="width:10%;">Amount</th>
<?php 

$sql2="SELECT id,grupa,naziv,foto,cijena,discount,po_quantity,po_price FROM shop_artikli INNER JOIN po ON id = po_productid WHERE po_orderid=$ID";


$result2 = mysqli_query ($con,$sql2); 
while($row2 = mysqli_fetch_array($result2)){
	

?>
<tr>
	<td style="width:30%;">
		<img style="width: 80%;" src="shop/<?php echo $row2["foto"]; ?>" alt="">
	</td>
	
	<td style="width:30%;">
		<p> <?php echo $row2["naziv"]; ?></p>
	</td>
	
	<td style="width:10%;">
		<p> <?php echo $row2["po_quantity"]; ?></p>
	</td>
	
	<td style="width:10%;">
		<p> $ <?php echo $row2["cijena"]; ?></p>
	</td>
	
	<td style="width:10%;">
		<?php $discount=$row2["discount"]; ?>
		<p> <?php if($discount>0){ echo $discount; } else{ echo "No discount"; } ?></p>
	</td>
	
	<td style="width:10%;">
		<p> $ <?php echo $row2["po_price"]; ?></p>
	</td>


</tr>
<?php } ?>

</table>

<?php }else{ ?>



<table width="100%" border="0">
<th style="width:30%;"></th>
<th style="width:30%;">Subscription Name</th>
<th style="width:10%;">Subscription Type</th>
<th style="width:10%;">Subscription Price</th>


<?php 

$sql2="SELECT * FROM shop_artikli WHERE id=$order_subscribe_product_id";
$result2 = mysqli_query ($con,$sql2); 
while($row2 = mysqli_fetch_array($result2)){
?>
<tr>
	<td style="width:30%;">
		<img style="width: 80%;" src="shop/<?php echo $row2["foto"]; ?>" alt="">
	</td>
	
	<td style="width:30%;">
		<p> <?php echo $row2["naziv"]; ?></p>
	</td>
	
	<td style="width:10%;">
		<p> <?php echo $order_subscribe_typename; ?></p>
	</td>
	
	<td style="width:10%;">
		<p> $ <?php echo (round($order_subscribe_price, 2)); ?></p>
	</td>
	
</tr>
<?php } ?>

</table>


<?php } ?>
</td>

</tr >					
</table>		
</div>


<script>


$("#grupa").change(function()

{

	var order_id = $("#order_id").val();

	var status_id=$(this).val();

	var ajaxFunction = "updateOrderStatus";

	var dataString = 'order_id=' + order_id + '&status_id=' + status_id;

	var postData = dataString + '&action=' + ajaxFunction;

	$.ajax

	({

	type: "POST",
	
	dataType: 'json', 

	url: "ajaxAuth.php",

	data: postData,

	cache: false,

	success: function(html)

	{
		console.log(html);
		swal("Order status updated!");

	},
	error: function (html){
		console.log(html);
	}

	});

});


</script>