<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['testimonials'] == 0){
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
	display:none;
	position:absolute;
	z-index:1;
}
</style>
<div align="left">
<div class="col-sm-8 col-sm-offset-2">
<?php
if(isset($_SESSION['msg'])){
	$msg2='<div class="alert alert-success">
	<strong>'.$_SESSION['msg'].'</strong>
	</div>'; 
	echo $msg2;
	unset($_SESSION['msg']);
}

if(isset($_SESSION['msg2'])){
	$msg2='<div class="alert alert-warning">
	<strong>'.$_SESSION['msg2'].'</strong>
	</div>'; 
	echo $msg2;
	unset($_SESSION['msg2']);
}

?>
<h3 style="text-align:center;text-transform:uppercase">Add new testimonial</h3>
<form action="savetestimonial.php" method="post" enctype="multipart/form-data" name="form1" id="form1">

	<input type="text" name="firstname"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Author's name" required > 
	<input type="text" name="lastname"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Author's lastname" required > 
	<input type="email" name="email"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Author's email" required > 
			
	<textarea name="tekst"  style="width:100%; height:250px; padding:5px; margin:5px; border:#CCCCCC solid 1px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Testimonial" maxlength="500"></textarea>
	Photo
	<input type="file" name="photo1" id="file"  style="width:100%; height:40px;  border:#941046 solid 1px; padding:5px; margin:5px 0;" onchange="loadFile(event)">  

	<div class="imgShow">
		<span name="delPic" id="delete" onclick="hide()"><i class="fa fa-times" title="Dismiss"></i></span>
		<img id="output" width="100%" height="auto" style="margin-bottom:5px;">
	</div>
	<input type="submit" name="Submit" style="background-color: #941046;" value="       INSERT      " class="submitBtn"> 

	</form>				
</div>
</div>
<script>
  var loadFile = function(event) {
	var output = document.getElementById('output');
	output.src = URL.createObjectURL(event.target.files[0]);
	document.getElementById('delete').style.display="block";
	document.getElementById('output').style.display="block";
  };
  
  function hide(){
	  document.getElementById('output').style.display="none";
	  document.getElementById('delete').style.display="none";
	  
	  var file = document.getElementById("file");
	  file.value = file.defaultValue;
  }
</script>

