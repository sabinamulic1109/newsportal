<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['slider'] == 0){
echo '<script>window.location.href = "cms.php?cms=welcome"</script>';
}
?>
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
	display:block;
	position:absolute;
	z-index:1;
}
</style>       
<?php

$sql = "SELECT s.* FROM slike s INNER JOIN galerija g on s.galerija = g.id WHERE g.naziv = 'Header'"; 
$result = mysqli_query ($con,$sql); 
$count=mysqli_num_rows($result);

if($count > 0){
	$row = mysqli_fetch_array($result);
	$fileDok=$row["foto"];	
	$poruka = 'Picture below is your current header image. If you want to change it, please use the form below.';
}else{
	$fileDok = '';
	$poruka = 'You have not uploaded header image yet. Please upload it if you need it.';
}

?>
<div class="col-sm-8 col-sm-offset-2">
<h3 style="text-align:center;text-transform:uppercase">Edit your header image</h3>		 	                   
<form action="updateheader.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
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

<br> 
<h6 style="margin-bottom:30px"><?php echo $poruka; ?></h6>
<input type="file" name="photo1"  id="file" style="width:100%; height:40px;  border:#941046 solid 1px; padding:5px; margin:5px 0;" onchange="loadFile(event)" required>  
<div class="imgShow">
<?php if($fileDok == ''){ $display = 'display:none;';}else{$display = 'display:block;';} ?>
<img id="output" width="100%" height="auto" style="margin:5px 0;<?php echo $display; ?>" src="galerija/<?php echo $fileDok;?>">

</div>
	 
	<div align="right">
<input type="submit" style="background-color:#941046;" name="Submit" value="       Save      " class="submitBtn"></div>	 	 
  	</form>	
</div>

<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
	document.getElementById('output').style.display="block";
  };
  
  function hide(){
	  document.getElementById('output').style.display="none";
	  var file = document.getElementById("file");
	  file.value = file.defaultValue;
  }
</script>