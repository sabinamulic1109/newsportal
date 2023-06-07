<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['gallery'] == 0){
echo '<script>window.location.href = "cms.php?cms=welcome"</script>';
}
$idgl=$_GET["id"];
$targ = '';
$fbcon = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM facebookconnect WHERE id = 1"));
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
#modal {
    height: 100vh;
	overflow:scroll;
	max-height:calc(100vh - 170px);
	min-height:calc(100vh - 170px);
}

#modal .modal-dialog{
	margin-top:5px;
}

#modal .modal-dialog .modal-content .modal-body{
	min-height:calc(75vh - 180px);
	max-height:calc(75vh - 180px); 
	overflow-y:scroll; 
}

#modalshare{
	width:70vw;
	max-height:calc(100vh - 170px);
	min-height:calc(100vh - 170px);
}

#modalshare .modal-dialog{
	margin-top:5px;
	width:70vw;
}

#modalshare .modal-dialog .modal-content .modal-body{
	min-height:calc(75vh - 180px);
	max-height:calc(75vh - 180px); 
	overflow-y:scroll; 
}

@media only screen and (max-width: 600px) {
	.flat-toggle.on > span {
		display:none;
	}
	#modal{
		top:50%;
		width:100%;
		max-height:calc(100vh - 100px);
		min-height:calc(100vh - 100px);
	}
	#modalshare{
		top:54px;
		width:100%;
		max-height:calc(100vh - 150px);
		min-height:calc(100vh - 150px);
	}
	#modalshare .modal-dialog, #modal .modal-dialog{
		margin-top:5px;
		width:95vw;
	}
	
	#modalshare .modal-dialog .modal-content {

	}
	
	#modalshare .modal-dialog .modal-content .modal-body{
		min-height:calc(65vh - 150px);
		max-height:calc(65vh - 150px); 
		overflow-y:scroll;	
	}
	#modal .modal-dialog .modal-content .modal-body{
		min-height:calc(85vh - 150px);
		max-height:calc(85vh - 150px); 
		overflow-y:scroll; 
	}
	
	#modalshare .modal-dialog .modal-content .modal-header .col .header{
		font-size:12px;
	}
	
	/* .submitBtn{
		top: 50px;
		position: fixed;
		width: 102%;
		margin-left: -9%;
	}
	#add-header{
		margin-top:50px;
	} */
}
</style>
<div align="left">
<div class="col-sm-8 col-sm-offset-2">
	<div class="modal" id="modal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
				<h3 class="modal-title" style="float:left;width:90%">Edit Gallery Picture</h3>
				<button type="button" class="close" onclick="closemodal()" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body">
					<h3 id="title" style="margin-top:0"></h3>
					<form action="javascript:saveAnswer();" method="post" enctype="multipart/form-data" id="spremi"> 
					<input type="hidden" name="idfaq" id="idfaq">
					<input type="hidden" name="idgal" id="idgal">
					<input type="hidden" name="idtip" id="idtip">	
					<div class="form-group">
					<label for="exampleInputEmail1">Gallery picure</label>
					<input type="text" class="form-control" class="form-control" name="titleEdit" id="titleEdit" placeholder="Title" required ></input>
					<input type="file" name="photo2" id="file1" style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" onchange="loadFile1(event)" > 
					<div class="imgShow">
					<!--<span name="delPic" id="delete1" onclick="hide1()"><i class="fa fa-times" title="Dismiss"></i></span> -->
					<img id="output1" width="100%" height="auto" style="margin-bottom:0px;">
					</div>	 
					</div>
					<button type="submit" class="submitBtn" style="background-color:#941046;">SAVE</button>
					</form>
				</div>
				<div class="modal-footer">
				<a onclick="closemodal()" style="color:#000;cursor:pointer">CLOSE</a>
				</div>
			</div>
		</div>
	</div>

<h3 style="text-align:center;text-transform:uppercase">Add new picture to gallery</h3>
<form action="addpicture.php?id=<?php echo $idgl; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">	  
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
<input type="file" name="photo1"  id="file" style="width:100%; height:40px;  border:#941046 solid 1px; padding:5px; margin:5px 0;" onchange="loadFile(event)" >  
<div class="imgShow">
	<!-- <span name="delPic" id="delete" onclick="hide()"><i class="fa fa-times" title="Dismiss"></i></span> -->
	<img id="output" width="100%" height="auto" style="margin-bottom:5px;">
</div>
<!--
<div class="col-sm-12" style="margin-bottom:20px;padding:0" >

			<input type="checkbox" id="facebook" name="facebook" />

			<label  for="facebook" >Publish on social media</label>
			
</div>	
-->	 
<input type="submit" name="Submit" style="background-color:#941046;" value="INSERT" class="submitBtn"> 	  
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



	
	if(isset($_SESSION['publish'])){
		/* echo $_SESSION['target']; */
		/* $targ = $_SESSION['target']; */
	?>
	<div style="display:none!important;">
	<div class="modal" id="modalshare" tabindex="-1" role="dialog" style="top:50%;left:50%;transform:translate(-50%,-50%)">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" style="float:left;width:90%">Share on social media</h3>
					<button type="button" class="close" onclick="$('#modalshare').toggle();" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body row">
					<div class="col s12" style="text-align:center"  >
						<img src="<?php echo $_SESSION['imagelink']; ?>" style="max-width:90%" />
						<br>
						<p style="margin-top:25px">Your picture is added to gallery. Please select on which social media you want to share this picture, or click close.</p>
					</div>
					<div class="col s12" style="text-align:right"  >
						<div class="a2a_kit a2a_kit_size_32 a2a_default_style" style="float:right; padding:5px 10px"
						data-a2a-url="<?php echo $_SESSION['target']; ?>" 
						data-a2a-image="<?php echo $_SESSION['imagelink']; ?>"
						data-a2a-title="<?php echo 'New picture on our website. Check it out'; ?>"
						>
						<a class="a2a_button_facebook"></a>
						<a class="a2a_button_twitter"></a>
						<a class="a2a_button_pinterest"></a>
						</div>
						<script async src="https://static.addtoany.com/menu/page.js"></script>
					</div>
				</div>
				<div class="modal-footer">
				<a onclick="$('#modalshare').toggle();" style="color:#000;cursor:pointer">CLOSE</a>
				</div>
			</div>
		</div>
	</div>
	</div>
	<script>$('#modalshare').toggle();</script>
	<?php
		
		unset($_SESSION['publish']);
		unset($_SESSION['target']);
		unset($_SESSION['imagelink']);
	}
		
?> 	  
</form>	
</div>
<div class="col-sm-12" style="padding:0">
<br>
<br>
<h3 style="text-align:center;text-transform:uppercase">Added pictures</h3> 	
<div class="nnD" onclick="deleteMultiple();">Delete selected pictures</div> 																		
<br>
<br>
 				
<?php

$sql = "SELECT * from slike where galerija='$idgl' order by id DESC"; 
$result = mysqli_query ($con,$sql); 
while($row = mysqli_fetch_array($result)){

$idF = $row["id"];
$fotoF = $row["foto"];
$naslovF = $row["naslov"];
/* Create direct url to this picture - used for share news on social media */
$targeturl = $domenaXV.'/gallery.php?id='.$idgl.'&&image='.$idF;
/* Create direct url to news article image - used for share news on social media*/
$imageurl = $domenaXV."/galerija/".$fotoF;   
$update = filemtime('galerija/'.$fotoF);

?>
<div class="foto">
	<div><input type="checkbox" id="foto<?php echo $idF; ?>" name="checkiran" value="<?php echo $idF; ?>" />
		<label style="float:left" for="foto<?php echo $idF; ?>"></label>
		<span style="float:right">
		<a href ="rotateimage.php?type=gallery&id=<?php echo $idF; ?>&degrees=90" title="Rotate counterclockwise">
			<i class="fas fa-undo" style="font-size:13px;color:#454545"></i>
		</a> 
		<a href ="rotateimage.php?type=gallery&id=<?php echo $idF; ?>&degrees=270" title="Rotate clockwise">
				<i class="fas fa-redo" style="font-size:13px;color:#454545"></i>
		</a>
		</span>
	</div>
	
<img class="slikagalerija" src="galerija/<?php echo $fotoF; ?>?m=<?php echo $update; ?>"><br><?php echo $naslovF; ?><br>
<a class="nnP" onclick="editPicture(<?php echo $idF; ?>,'<?php echo $naslovF; ?>','<?php echo $fotoF; ?>','<?php echo $idgl; ?>');" ><span style="color:#fff">Edit</span></a>
<a class="nnD" onclick="return checkDelete(<?php echo $idF; ?>)"><span style="color:#fff;">Delete</span></a>
	
	<div class="row" style="margin:0 auto">		
		<div class="col s12" style="text-align:right;"  >
			
			<div class="a2a_kit a2a_kit_size_20 a2a_default_style" style=" position: relative; left: 50%;transform: translateX(-50%);padding: 5px 10px;float: left;"
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
	
</div>
<?php					
}
?>						
					
					

</div>

<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
	//document.getElementById('delete').style.display="block";
	document.getElementById('output').style.display="block";
  };
  
  function hide(){
	  document.getElementById('output').style.display="none";
	  //document.getElementById('delete').style.display="none";
	  
	  var file = document.getElementById("file");
	  file.value = file.defaultValue;
  }
  
   var loadFile1 = function(event) {
    var output = document.getElementById('output1');
    output.src = URL.createObjectURL(event.target.files[0]);
	/* document.getElementById('delete').style.display="block"; */
	document.getElementById('output1').style.display="block";
  };
  
  function hide1(){
	  document.getElementById('output1').style.display="none";
	  /* document.getElementById('delete').style.display="none"; */
	  
	  var file = document.getElementById("file1");
	  file.value = file.defaultValue;
  }
  
</script>
<script src="https://connect.facebook.net/en_US/sdk.js"></script>
<script>
var appid = '<?php echo $fbcon['appid']; ?>';
  FB.init({
	appId   : appid,
	status  : true,
	xfbml   : true,
	version : 'v2.9'
  });
  FB.AppEvents.logPageView();
  </script>
<script language="JavaScript" type="text/javascript">

function deleteMultiple(){
	swal({
		title: "Are you sure?",
		text: "Once deleted, you can not recover it!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	}).then((willDelete) => {
	if (willDelete) {
		var provjera = '';
		var checkboxes = document.querySelectorAll('input[name="checkiran"]'), values = [];
		Array.prototype.forEach.call(checkboxes, function(el) {
			values.push(el.value);		
		});
		
		$.each(values, function (key, value) {
			var id = "foto"+value;
			var check = document.getElementById(id);
			if(check.checked == true){
				var checked = 1;
				$.ajax({
				type:"POST",
				url: "delpicajax.php?id="+value,
				contentType: "application/json; charset=utf-8",
				dataType: "JSON",
					success:function (data) {
						provjera = true;
						provjeraF(provjera);
					}, error:function(data){
						provjera = false;				
						provjeraF(provjera);
					}
				});
				
				
			}else{
				var checked = 0;
			}
			
			
		});
      } else {
        swal("You have canceled deleting");
      }
    }); 
	
}

function provjeraF(provjera){
	if(provjera == true){
		swal('Photos are deleted');
		location.reload();
	}else{
		swal('Something went wrong');	
	}
}


function checkDelete(id){
	event.preventDefault();
		swal({
			title: "Are you sure?",
			text: "Once deleted, you can not recover it!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		}).then((willDelete) => {
		if (willDelete) {
			window.location.href = "delg.php?id="+id;
      } else {
        swal("You have canceled deleting");
      }
    }); 
}

function editPicture(id,title,photo,idgal){
	$("#idfaq").val(id);
	$("#titleEdit").val(title);
	$('#output1').attr('src','galerija/'+photo);
	$("#idgal").val(idgal);

	//$("#output1").val(photo);
	//$("#modal").css('z-index','999999999999');
	$("#modal").toggle();
};

function closemodal(){
$("#modal").toggle();

}

function saveAnswer(){
	var formData = new FormData();
	//var formData = $('#spremi').serialize();
	var file_data = $('#file1').prop('files')[0]; 

	var file_data1 = $('#idfaq').val();
	var file_data2 = $("#titleEdit").val(); 
	var file_data3 = $('#idgal').val();

	formData.append('idfaq', file_data1);
	formData.append('idgal', file_data3);

	formData.append('titleEdit', file_data2);
	formData.append('photo2', file_data);
	//console.log(formData);
	$.ajax({
		type:"POST",
		data:formData,
		url: "editgallerypic.php",
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
				swal("Changes saved!", {	
				}).then((value) => {
				location.reload();
			});

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

$(document).ready(function() {
    var publish = '<?php echo $targ; ?>';
	if(publish != ''){
		var appid = '<?php echo $fbcon['appid']; ?>';
		/* page treba da bude $_SESSION['target'] - sta zeli da se podijeli */
		var page = 'http://vicit.world/allprojects/login/'+publish;
		var pageid = '<?php echo $fbcon['pageid']; ?>';

		FB.ui({
			method: 'share',
			href: page,
			to: pageid,
			from: pageid   
		}, function(response){});

	}else{
	}
});

</script>
</script>

