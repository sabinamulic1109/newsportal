<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['messages'] == 0){
echo '<script>window.location.href = "cms.php?cms=welcome"</script>';
}
?>

<div align="left">
<?php
$ID=$_GET['ID'];
$sql = "SELECT * FROM customers WHERE customer_id=$ID";
$result = mysqli_query ($con,$sql); 
while($row = mysqli_fetch_array($result)){

?>	
<table width="100%" border="0">
<th style="border-bottom:#000000 solid 1px;"> 
<span style="font-weight:bold"><?php echo $row["customer_full_name"]; ?></span> 
<span style="font-style:italic"><<a href="mailto:<?php echo $row["customer_email"]; ?>"><?php echo $row["customer_email"]; ?></a>></span> <br>
<span style="color:#a6a3a3;font-size:12px;"><?php echo date('m/d/Y', strtotime($row["date"])); ?></span> </th>
<tr >

</tr>
<tr >
<td style="padding:20px">
<b>Customer Name:</b> <?php echo $row["customer_full_name"]; ?><br>
<b>Email:</b> <?php echo $row["customer_email"]; ?><br>
<b>Phone:</b> <?php echo $row["customer_phone"]; ?><br>
<b>Address:</b> <?php echo $row["customer_address_line_1"]; ?><br>
<b>Additional Address:</b> <?php echo $row["customer_address_line_2"]; ?><br>
<b>City:</b> <?php echo $row["customer_city"]; ?><br>
<b>Zip:</b> <?php echo $row["customer_zip"]; ?><br>
<b>State:</b> <?php echo $row["customer_stateprovince"]; ?><br>
<b>Country:</b> <?php echo $row["customer_country"]; ?><br>
<hr>
<b>Customer Shipping Name:</b> <?php echo $row["ship_customer_first_name"]; ?> <?php echo $row["	ship_customer_last_name"]; ?><br>
<b>Shipping Email:</b> <?php echo $row["ship_customer_email"]; ?><br>
<b>Shipping Phone:</b> <?php echo $row["ship_customer_phone"]; ?><br>
<b>Shipping Address:</b> <?php echo $row["ship_customer_address_line_1"]; ?><br>
<b>Shipping Additional Address:</b> <?php echo $row["ship_customer_address_line_2"]; ?><br>
<b>Shipping City:</b> <?php echo $row["ship_customer_city"]; ?><br>
<b>Shipping Zip:</b> <?php echo $row["ship_customer_zip"]; ?><br>
<b>Shipping State:</b> <?php echo $row["	ship_customer_stateprovince"]; ?><br>
<b>Shipping Country:</b> <?php echo $row["	ship_customer_country"]; ?><br>
</td>
</tr>
<?php
}
?>						
</table>		
</div>