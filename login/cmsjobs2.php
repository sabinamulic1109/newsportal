<?php
if($_SESSION['myusername']==''){
	echo header("location:index.php?msg=2");
}
if($roles['jobs'] == 0){
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
	display:block;
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
	$sql = "SELECT * from jobs where id='$noid'"; 
	$result = mysqli_query ($con,$sql); 
	$row = mysqli_fetch_array($result);
	$idDok = $row["id"];
	$nazivS = $row["naziv"];
	$lokacijaS = $row["lokacija"];
	$opisS = $row["opis"];
	
	$gpS = $row["grupa"];

	$kvalifikacijeS = $row["kvalifikacije"];
	$visible = $row['visible'];
	/* Create direct url to jobs job - used for share jobs on social media */
	$targeturl = $domenaXV.'/careers.php?id='.$noid;
	/* Create direct url to jobs job image - used for share jobs on social media*/
	//$imageurl = $domenaXV."/jobs/".$datumS; 
?>	

<div align="left">
<div class="col-sm-8 col-sm-offset-2">
<h3 style="text-align:center;text-transform:uppercase">Edit jobs job</h3>

<div class="row" >
	<div class="col s12 m6" style="text-align:left"  >
		<h4 class="header" style="margin-bottom:10px">Visibility</h4>
		<div class="flat-toggle <?php if($visible == 1 ){echo ' on'; }?>" title="Change visibility of this job" >
			<?php if($visible == 1 ){ ?>
			<span id="visiblemsg">This job is visible on website</span>
			<?php }else{ ?>
			<span id="visiblemsg">This job is not visible on website</span>
			<?php } ?>
		</div>
	</div>
	<div class="col s12 m6" style="text-align:right;"  >
		<h4 class="header" style="margin-bottom:10px">Share on social media</h4>
		<div class="a2a_kit a2a_kit_size_32 a2a_default_style" style="padding:5px 10px;float:right"
		data-a2a-url="<?php echo $targeturl; ?>" 
		data-a2a-title="<?php echo $nazivS; ?>"
		>
		<a class="a2a_button_facebook"></a>
		<a class="a2a_button_twitter"></a>
		<a class="a2a_button_pinterest"></a>
		</div>
		<script async src="https://static.addtoany.com/menu/page.js"></script>
	</div>
</div>

<form action="updatejobs.php?id=<?php echo $idDok; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
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
<input type="text" name="naziv" value="<?php echo $nazivS;  ?>"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Naziv" required >
<input type="text" name="lokacija" value="<?php echo $lokacijaS;  ?>"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Lokacija" required >
<input type="text" name="kvalifikacije" value="<?php echo $kvalifikacijeS;  ?>"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Kvalifikacije" required > 

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

<!--Photo

<input type="file" name="photo1" id="file"  
style="width:100%; height:50px;   border:#941046 solid 1px; 
padding:5px; margin:5px 0;" onchange="loadFile(event)">  -->
<div class="imgShow">
	<!--<span name="delPic" id="delete" onclick="hide()"><i class="fa fa-times" title="Dismiss"></i></span>-->
	<img id="output" width="100%" height="auto" style="margin-bottom:5px;">
</div>	
Unesite opis
<textarea name="opis"  id="editor" style="width:100%; height:402px; padding:5px; margin:5px; border:#CCCCCC solid 1px; border:#941046 solid 1px; padding:5px; margin:5px 0;"><?php echo $opisS;  ?></textarea>
<input type="submit" name="Submit" style="background-color:#941046;" value="       SAVE      " class="submitBtn"> 	    		
  	</form>
</div>

<script type="text/javascript">

	$(document).ready(function(){
		$('.flat-toggle').on('click', function() {
			$(this).toggleClass('on');
		  
			if ($(this).hasClass('on')) {
			  $('#visiblemsg').html('This job is visible on website');
			  var visible = 1;
			  
			} else {
			  $('#visiblemsg').html('This job is not visible on website');
			  var visible = 0;
			}
			
			updateVisibility(<?php echo $noid; ?>, visible);
		});


		$('#editor').summernote({
			tabsize: 8,
			height: 300,
			followingToolbar: false 
		});	
	});
	
	function updateVisibility(jobsid, visible){
		var formData = new FormData();
		$.ajax({
			type:"POST",
			data:formData,
			url: "updatejobsVisible.php?jobsid="+jobsid+"&&visible="+visible,
			//contentType: "application/json; charset=utf-8",
			dataType: "JSON",
			cache: false,
			contentType: false,
			processData: false,
			beforeSend:function(){
				$('#modalloader').toggle();
			},
			success:function (data) {
				$('#modalloader').css('display','none');
				if(data.state == 'true'){
					swal("Changes saved!");
				}else{
					swal("Error with saving");
					console.log(data);
				}	
			}, error:function(data){
				$('#modalloader').css('display','none');
				swal("Error with saving");
				console.log(data);
			}
		}); 
	} 

	

	var loadFile = function(event) {
		var output = document.getElementById('output');
		output.src = URL.createObjectURL(event.target.files[0]);
		/* document.getElementById('delete').style.display="block"; */
		document.getElementById('output').style.display="block";
	};

	function hide(){
	  document.getElementById('output').style.display="none";
	/*   document.getElementById('delete').style.display="none"; */
	  
	  var file = document.getElementById("file");
	  file.value = file.defaultValue;
	}
</script>