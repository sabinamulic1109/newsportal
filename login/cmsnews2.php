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
	$sql = "SELECT * from novosti where id='$noid'"; 
	$result = mysqli_query ($con,$sql); 
	$row = mysqli_fetch_array($result);
	$idDok = $row["id"];
	$naslovS = $row["naslov"];
	$podnaslovS = $row["podnaslov"];
	$tekstS = $row["tekst"];
	$gpS = $row["grupa"];
	$fileDok = $row["foto"];
	$visible = $row['visible'];
	/* Create direct url to news article - used for share news on social media */
	$targeturl = $domenaXV.'/article.php?id='.$noid;
	/* Create direct url to news article image - used for share news on social media*/
	$imageurl = $domenaXV."/news/".$fileDok; 
?>	

<div align="left">
<div class="col-sm-8 col-sm-offset-2">
<h3 style="text-align:center;text-transform:uppercase">Edit news article</h3>

<div class="row" >
	<div class="col s12 m6" style="text-align:left"  >
		<h4 class="header" style="margin-bottom:10px">Visibility</h4>
		<div class="flat-toggle <?php if($visible == 1 ){echo ' on'; }?>" title="Change visibility of this article" >
			<?php if($visible == 1 ){ ?>
			<span id="visiblemsg">This article is visible on website</span>
			<?php }else{ ?>
			<span id="visiblemsg">This article is not visible on website</span>
			<?php } ?>
		</div>
	</div>
	<div class="col s12 m6" style="text-align:right;"  >
		<h4 class="header" style="margin-bottom:10px">Share on social media</h4>
		<div class="a2a_kit a2a_kit_size_32 a2a_default_style" style="padding:5px 10px;float:right"
		data-a2a-url="<?php echo $targeturl; ?>" 
		data-a2a-image="<?php echo $imageurl; ?>"
		data-a2a-title="<?php echo $naslovS; ?>"
		>
		<a class="a2a_button_facebook"></a>
		<a class="a2a_button_twitter"></a>
		<a class="a2a_button_pinterest"></a>
		</div>
		<script async src="https://static.addtoany.com/menu/page.js"></script>
	</div>
</div>

<form action="updatenews.php?id=<?php echo $idDok; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
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
	<label style="margin: 5px 0">Title</label>	 
	<input type="text" name="naslov"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title = "Title" placeholder = "Title" value="<?php echo $naslovS; ?>"> 
</div>	 
	
<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">Subtitle</label>	 
	<input type="text" name="podnaslov"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" title ="Subtitle" placeholder="Subtitle"  value="<?php echo $podnaslovS; ?>"> 
</div>	 

<div class="col s12 m12" style="padding-left:0;padding-right:0">
	<label style="margin: 5px 0">Photo</label>	  
	<input type="file" name="photo1"  id="file" style="width:100%; height:40px;  border:#941046 solid 1px; padding:5px; margin:5px 0;" onchange="loadFile(event)"> 
</div>	
 
 

<div class="imgShow">
	<!-- <span name="delPic" id="delete" onclick="hide()"><i class="fa fa-times" title="Dismiss"></i></span> -->
	<?php if($row["foto"] == ''){
	?>
	<img id="output" width="100%" height="auto" style="margin-bottom:5px;">	
	<?php	
	}else{ ?>
	<p style="text-align:center">
		<a href ="rotateimage.php?type=news&id=<?php echo $idDok; ?>&degrees=90" title="Rotate counterclockwise">
			<i class="fas fa-undo" style="font-size:13px;color:#454545"></i>
		</a> 
		| 
		<a href ="rotateimage.php?type=news&id=<?php echo $idDok; ?>&degrees=270" title="Rotate clockwise">
			<i class="fas fa-redo" style="font-size:13px;color:#454545"></i>
		</a>
	</p>
	<img id="output" width="100%" height="auto" style="margin-bottom:5px;" src="news/<?php echo $fileDok; ?>">
	<?php	
	} ?>
</div>

 <textarea name="tekst" id="editor" style="width:100%; height:402px; padding:5px; margin:5px; border:#CCCCCC solid 1px; border:#941046 solid 1px; padding:5px; margin:5px 0;"  placeholder="Description"><?php echo $tekstS; ?></textarea>
	
	 
 <input type="submit" style="background-color:#941046;" name="Submit" value="       SAVE      " class="submitBtn"> 	   
  	</form>	
</div>
</div>

<script type="text/javascript">

	$(document).ready(function(){
		$('.flat-toggle').on('click', function() {
			$(this).toggleClass('on');
		  
			if ($(this).hasClass('on')) {
			  $('#visiblemsg').html('This article is visible on website');
			  var visible = 1;
			  
			} else {
			  $('#visiblemsg').html('This article is not visible on website');
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
	
	function updateVisibility(newsid, visible){
		var formData = new FormData();
		$.ajax({
			type:"POST",
			data:formData,
			url: "updateNewsVisible.php?newsid="+newsid+"&&visible="+visible,
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