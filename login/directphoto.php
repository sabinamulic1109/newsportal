<?php
	if($_SESSION['myusername']==''){
	echo header("location:index.php?msg=2");
	}
	if($roles['gallery'] == 0){
	echo '<script>window.location.href = "cms.php?cms=welcome"</script>';
	}

	$galleries = array();

	$sql = "SELECT * from galerija where naziv != 'Header' order by id DESC"; 
	$result = mysqli_query ($con,$sql); 
	while($row = mysqli_fetch_array($result)){
		$galleries[] = $row;
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
@media only screen and (max-width: 600px) {

	.submitBtn{
		top: 50px;
		position: fixed;
		width: 102%;
		margin-left: -9%;
	}
	#add-header{
		margin-top:50px;
	}
}
</style>
<div align="left">
<div class="col-sm-8 col-sm-offset-2">

	<h3 id="add-header" style="text-align:center;text-transform:uppercase">Add new picture</h3>
	<form action="addpicturedirectly.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
	<?php if(count($galleries) == 0){
	?>
	<label>You don't have galleries yet. Please enter name of your first gallery</label>
	<input type="text" name="gallerytitle"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Gallery title">
	<?php	
	}else{ ?>
	<label>Choose gallery</label>
	<select name="gallery" style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0" placeholder="Choose gallery">
	<?php
		foreach($galleries as $g){
			$value=$g["id"];
			$naslov=$g["naziv"];
	?>
			<option value="<?php echo $value; ?>"><?php echo $naslov; ?></option>
	<?php } ?>
	</select> 
	<?php } ?>
	<label>Image title</label>
	<input type="text" name="naslov"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Title"> 
	<!--
	<div class="col-sm-6" style="margin:10px 0;padding:0" >
		<?php 
		$token = $_SESSION['fb_access_token'];
		if(!empty($token) || $token != ''){
		?>
		<input type="checkbox" id="facebook" name="facebook" />
		<label  for="facebook" >Publish on your facebook page</label>
		<?php	
		}else{
		?>
		<input type="checkbox" id="facebook" name="facebook" disabled />
		<label  for="facebook" >To publish on facebook please <a href="cms.php?cms=socialmediaconnect" target="_blank">connect your account</a> to CMS </label>	
		
			
		<?php } ?>
	</div>
	
	<div class="col-sm-6" style="margin:10px 0;padding:0" >
		<?php 
		$token = $_SESSION['oauth_token'];
		if(!empty($token) || $token != ''){
		?>
		<input type="checkbox" id="twitter" name="twitter" />
		<label  for="twitter" >Publish on twitter account</label>	
	<?php	
		}else{
		?>
		
			<input type="checkbox" id="facebook" name="facebook" disabled />
		<label  for="facebook" >To publish on twitter please <a href="cms.php?cms=socialmediaconnect" target="_blank">connect your account</a> to CMS </label>	
		
		<?php } ?>

	</div> 
	-->
	<label>Choose photo</label>	
	<input type="file" name="photo1"  id="file" style="width:100%; height:40px;  border:#941046 solid 1px; padding:5px; margin:5px 0;" onchange="loadFile(event)" >  
	<div class="imgShow">
		<span name="delPic" id="delete" onclick="hide()"><i class="fa fa-times" title="Dismiss"></i></span>
		<img id="output" width="100%" height="auto" style="margin-bottom:5px;">
	</div>
 
<input type="submit" style="background-color: #941046;" name="Submit" value="SAVE" class="submitBtn"> 	  
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
	  
</form>	
</div>


<script language="JavaScript" type="text/javascript">
	$(document).ready(function(){
		if(screen.width < 601){
			$('#glavni').removeClass('wow');
			$('#glavni').removeClass('fadeInUp');
			$('#glavni').css('visibility','visible');
		}
	});
	
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




