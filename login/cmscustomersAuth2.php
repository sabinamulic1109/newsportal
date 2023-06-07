<?php
if($_SESSION['myusername']==''){
	echo header("location:index.php?msg=2");
}
if($roles['news'] == 0){
	echo '<script>window.location.href = "cms.php?cms=welcome"</script>';
}
?>
<script src="cms/js/summernote-lite.js"></script>
<style type="text/css">

.imgShow button{
	background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;
    outline:none;
}
.imgShow img{
	box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}
.imgShow i{
	color:#a82626;
	font-size:24px;
	padding:5px;
}

#delete{

	position:absolute;
	z-index:1;
}

#delete1{

	position:absolute;
	z-index:1;
}

/* Toggle button */
.flat-toggle {
	width: 32px;
	border-radius: 4px;
	height: 10px;
	background-color: #DDD;
	position: relative;
	margin: 20px 0;
	-moz-user-select: none;
	-khtml-user-select: none;
	-webkit-user-select: none;
	-o-user-select: none;
	user-select: none;
}

.flat-toggle:after {
	border-radius: 100%;
	background-color: #941046;
	position: absolute;
	left: 0;
	top: -3px;
	width: 15px;
	height: 15px;
	content: '';
	-webkit-transform: translate(0);
	-ms-transform: translate(0);
	transform: translateX(0);
	 transition: all 0.2s ease-in-out;
	-webkit-transition: all 0.2s ease-in-out;
	-moz-transition: all 0.2s ease-in-out;
}

.flat-toggle > span {
	margin-left: 45px;
	position: relative;
	top: -2px;
	color: #941046;
	white-space: nowrap;
	display: block;
	cursor: pointer;
}

.flat-toggle:hover {
	cursor: pointer;
}

.flat-toggle:hover span {
	color: black;
	cursor: pointer;
}

.flat-toggle.on {
	background-color: #7aafb6;
	transform: translate3d(0,0,0);
}

.flat-toggle.on:hover span {
	color: #941046;
	cursor: pointer;
}

.flat-toggle.on:after {
	background-color: #00A3D9;
	-webkit-transform: translate(17px);
	-ms-transform: translate(17px);
	transform: translateX(17px);
}

.flat-toggle.on > span {
	text-align:right;
	color: #941046;
}
#passworddiv{
	display:none;
	height:155px;
}
</style>
<?php

	$noid = $_GET["ID"];
	$sql = "SELECT * from customers where customer_id='$noid'"; 
	$result = mysqli_query ($con,$sql); 
	$row = mysqli_fetch_array($result);
	$idDok = $row["customer_id"];
	$fname = $row["customer_first_name"];
	$lname = $row["customer_last_name"];
	$addres1=$row["customer_address_line_1"];
	$addres2=$row["customer_address_line_2"];
	$email = $row["customer_email"];
	$phone = $row["customer_phone"];
	$city=$row["customer_city"];
	$zip = $row["customer_zip"];
	$state=$row["customer_stateprovince"];
	$country = $row["customer_country"];


	
	$shfname = $row["ship_customer_first_name"];
	$shlname = $row["ship_customer_last_name"];
	$shaddres1=$row["ship_customer_address_line_1"];
	$shaddres2=$row["ship_customer_address_line_2"];
	$shemail = $row["ship_customer_email"];
	$shphone = $row["ship_customer_phone"];
	$shcity=$row["ship_customer_city"];
	$shzip = $row["ship_customer_zip"];
	$shstate=$row["ship_customer_stateprovince"];
	$shcountry = $row["ship_customer_country"];

	
?>	

<div align="left">
<div class="col-sm-8 col-sm-offset-2">
<h3 style="text-align:center;text-transform:uppercase">Edit Customer 
</h3>



<form action="updatecustomersAuth.php?id=<?php echo $idDok; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
<?php
if(isset($_SESSION['msg'])){
	/*$msg2='<div class="alert alert-success">
	<strong>'.$_SESSION['msg'].'</strong>
	</div>'; 
	echo $msg2;*/
	$msg=$_SESSION['msg'];
	echo '<script language="JavaScript" type="text/javascript">swal("'.$msg.'");</script>';
	unset($_SESSION['msg']);
	$msg="";
}

if(isset($_SESSION['msg2'])){
	/*$msg2='<div class="alert alert-warning">
	<strong>'.$_SESSION['msg2'].'</strong>
	</div>'; 
	echo $msg2;*/
	$msg=$_SESSION['msg2'];
	echo '<script language="JavaScript" type="text/javascript">swal("'.$msg.'");</script>';
	unset($_SESSION['msg2']);
	$msg="";
}

?>

<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">First Name:</label>	 
	<input type="text" name="fname"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "First Name" placeholder = "First Name" value="<?php echo $fname; ?>"> 
</div>	 
	
<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">Last Name:</label>	 
	<input type="text" name="lname"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "Last Name" placeholder = "Last Name" value="<?php echo $lname; ?>"> 
</div>	

<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">E-mail address:</label>	 
	<input type="email" name="email"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "E-mail address" placeholder = "E-mail address" value="<?php echo $email; ?>"> 
</div>	

<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">Phone number:</label>	 
	<input type="text" name="phone"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "Phone number" placeholder = "Phone number" value="<?php echo $phone; ?>"> 
</div>	

<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">Address:</label>	 
	<input type="text" name="address"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "Address" placeholder = "Address" value="<?php echo $addres1; ?>"> 
</div>	

<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">Additional Address:</label>	 
	<input type="text" name="addressad"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "Additional Address" placeholder = "Additional Address" value="<?php echo $addres2; ?>"> 
</div>	

<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">Zip:</label>	 
	<input type="text" name="zip"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "Zip" placeholder = "Zip" value="<?php echo $zip; ?>"> 
</div>	


<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">City:</label>	 
	<input type="text" name="city"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "City" placeholder = "City" value="<?php echo $city; ?>"> 
</div>

<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">State:</label>	 
	<input type="text" name="state"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "State" placeholder = "State" value="<?php echo $state; ?>"> 
</div>
	

<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">Country:</label>	 
	<input type="text" name="country"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "Country" placeholder = "Country" value="<?php echo $country; ?>"> 
</div>
	

<div class="col s12 m12" style="padding-left:0;padding-right:0;text-align:center;">
<hr>
	<label style="margin: 5px 0">Shipping</label>	 
</div>

<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">Shipping First Name:</label>	 
	<input type="text" name="shfname"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "Shipping First Name" placeholder = "Shipping First Name" value="<?php echo $shfname; ?>"> 
</div>	 
	
<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">Shipping Last Name:</label>	 
	<input type="text" name="shlname"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "Shipping Last Name" placeholder = "Shipping Last Name" value="<?php echo $shlname; ?>"> 
</div>	

<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">Shipping E-mail address:</label>	 
	<input type="email" name="shemail"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "Shipping E-mail address" placeholder = "Shipping E-mail address" value="<?php echo $shemail; ?>"> 
</div>	

<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">Shipping Phone number:</label>	 
	<input type="text" name="shphone"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "Shipping Phone number" placeholder = "Shipping Phone number" value="<?php echo $shphone; ?>"> 
</div>	

<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">Shipping Address:</label>	 
	<input type="text" name="shaddress"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "Shipping Address" placeholder = "Shipping Address" value="<?php echo $shaddres1; ?>"> 
</div>	

<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">Shipping Additional Address:</label>	 
	<input type="text" name="shaddressad"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "Shipping Additional Address" placeholder = "Shipping Additional Address" value="<?php echo $shaddres2; ?>"> 
</div>	

<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">Shipping Zip:</label>	 
	<input type="text" name="shzip"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "Shipping Zip" placeholder = "Shipping Zip" value="<?php echo $shzip; ?>"> 
</div>	


<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">Shipping City:</label>	 
	<input type="text" name="shcity"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "Shipping City" placeholder = "Shipping City" value="<?php echo $shcity; ?>"> 
</div>

<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">Shipping State:</label>	 
	<input type="text" name="shstate"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "Shipping State" placeholder = "Shipping State" value="<?php echo $shstate; ?>"> 
</div>
	

<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">Shipping Country:</label>	 
	<input type="text" name="shcountry"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "Shipping Country" placeholder = "Shipping Country" value="<?php echo $shcountry; ?>"> 
</div>
	

 <input type="submit" style="background-color: #941046;" name="Submit" value="       SAVE      " class="submitBtn"> 	   
  	</form>	
</div>
</div>


<script language="JavaScript" type="text/javascript">

$(document).ready(function() {
    $('#passwordshow').change(function() {
        $('#passworddiv').slideToggle();
    });
});
</script>