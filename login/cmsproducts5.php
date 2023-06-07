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

</style>
<?php

	$noid = $_GET["id"];
	$sql = "SELECT * from shop_group where id='$noid'"; 
	$result = mysqli_query ($con,$sql); 
	$row = mysqli_fetch_array($result);
	$idDok = $row["id"];
	$name = $row["naziv"];



?>	

<div align="left">
<div class="col-sm-8 col-sm-offset-2">
<h3 style="text-align:center;text-transform:uppercase">Edit Product Group </h3>



<form action="updateshopgroup.php?id=<?php echo $idDok; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
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
	<label style="margin: 5px 0">Product Group Name:</label>	 
	<input type="text" name="name"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "Product Group Name" placeholder = "Product Group Name" value="<?php echo $name; ?>"> 
</div>	 
	







 <input type="submit" style="background-color:#941046;" name="Submit" value="       SAVE      " class="submitBtn"> 	   
  	</form>	
</div>
</div>

<script type="text/javascript">

	$(document).ready(function(){


		$('#editor').summernote({
			tabsize: 8,
			height: 300
		});	
	});

</script>