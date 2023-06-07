<?php
session_start(); 
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['gallery'] == 0){
echo '<script>window.location.href = "cms.php?cms=welcome"</script>';
}
$idgl=$_GET["id"];
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
.z-depth-4, .modal {
    box-shadow: none!important;
	    background-color: transparent!important;
}
#modal {
    top: 10%!important;
    transform: translateY(0%)!important;
    height: auto!important;
	overflow: auto!important;
    margin-bottom: 50px!important;
}
</style>
<div class="col-sm-8 col-sm-offset-2">
<h3 style="text-align:center;text-transform:uppercase">Add product photos</h3>
<div align="left">
<form action="addProductPicture.php?id=<?php echo $idgl; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">	  
<input type="text" name="naslov"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Title"> 	 
<input type="file" name="photo1"  id="file" style="width:100%; height:40px;  border:#941046 solid 1px; padding:5px; margin:5px 0;" onchange="loadFile(event)" >  
								<div class="imgShow">
									<span name="delPic" id="delete" onclick="hide()"><i class="fa fa-times" title="Dismiss"></i></span>
									<img id="output" width="100%" height="auto" style="margin-bottom:5px;">
								</div>	 
<input type="submit" style="background-color:#941046;" name="Submit" value="       INSERT      " class="submitBtn"> 	
		 
  	</form>	
	
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
<br>
 		
</div>	
</div>	
<div class="col-sm-12" style="padding:0">
<br>
<br>
<h3 style="text-align:center;text-transform:uppercase">Added pictures</h3>
<div align="left">
<?php

$sql = "SELECT * from slikeProduct where galerija='$idgl' order by id"; 
$result = mysqli_query ($con,$sql); 
while($row = mysqli_fetch_array($result)){

$idF=$row["id"];
$fotoF=$row["foto"];
$naslovF=$row["naslov"];
$naslovF1=strip_tags(substr($naslovF,0,20)).'...'; 
$tip=$row["tip"];  

$update = filemtime('productPhotos/'.$fotoF);

echo '
<div class="foto">
	<div>
		<label style="float:left" for="foto'.$idF.'"></label>
		<span style="float:right">
		<a href ="rotateimage.php?type=galleryProduct&id='.$idF.'&degrees=90" title="Rotate counterclockwise">
			<i class="fas fa-undo" style="font-size:13px;color:#454545"></i>
		</a> 
		<a href ="rotateimage.php?type=galleryProduct&id='.$idF.'&degrees=270" title="Rotate clockwise">
				<i class="fas fa-redo" style="font-size:13px;color:#454545"></i>
		</a>
		</span>
	</div>
	
<img class="slikagalerija" src="productPhotos/'.$fotoF.'?m='.$update.'"><br>'.$naslovF.'<br>
<a class="nnP" onclick="editPicture('.$idF.',\''.$naslovF.'\',\''.$fotoF.'\',\''.$idgl.'\');" ><span style="color:#fff">Edit</span></a>
<a class="nnD" onclick="return checkDelete('.$idF.')"><span style="color:#fff;">Delete</span></a>
	
</div>';


/*
echo '<div class="foto"><img class="slikagalerija" style="object-fit:cover;" src="galerija/',$fotoF,'">',$naslovF1,'<br>
<a class="nnP" onclick="editPicture('.$idF.',\''.$naslovF.'\',\''.$fotoF.'\',\''.$idgl.'\',\''.$tip.'\');" ><span style="color:#ffffff"> Edit </span></a>
<a class="nnD" href="delg.php?id=',$idF,'" onclick="return checkDelete('.$idF.')"><span style="color:#ffffff;"> Delete </span></a>
</div>';*/
	
	
}
?>						
					
					

</div>
</div>
<div class="modal" id="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" style="float:left;width:90%">Edit  Picture</h3>
        <button type="button" class="close" onclick="closemodal()" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<h3 id="title" style="margin-top:0"></h3>
			<form action="javascript:saveAnswer();" method="post" enctype="multipart/form-data"  id="spremi"> 
				<input type="hidden" name="idfaq" id="idfaq">
				<input type="hidden" name="idgal" id="idgal">				
				<div class="form-group">
					<label for="exampleInputEmail1">Product picture</label>
					<input type="text" class="form-control" class="form-control" name="titleEdit" id="titleEdit"  placeholder="Title" required ></input>
					<input type="file" name="photo2"  id="file1" style="width:100%; height:40px;  border:#941046 solid 1px; padding:5px; margin:5px 0;" onchange="loadFile1(event)" >  
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
  
   var loadFile1 = function(event) {
    var output = document.getElementById('output1');
    output.src = URL.createObjectURL(event.target.files[0]);
	//document.getElementById('delete1').style.display="block";
	document.getElementById('output1').style.display="block";
  };
  
  function hide1(){
	  document.getElementById('output1').style.display="none";
	//  document.getElementById('delete1').style.display="none";
	  
	  var file = document.getElementById("file1");
	  file.value = file.defaultValue;
  }
</script>

<script language="JavaScript" type="text/javascript">
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
			window.location.href = "delproductPic.php?id="+id;
      } else {
        swal("You have canceled deleting");
      }
    }); 
}

function editPicture(id,title,photo,idgal,idtip){
	$("#idfaq").val(id);
	$("#titleEdit").val(title);
	$('#output1').attr('src','productPhotos/'+photo);
	$("#idgal").val(idgal);
	$("#idtip").val(idtip);
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
	var file_data4 = $("#idtip").val();   	
	formData.append('idfaq', file_data1);
	formData.append('idgal', file_data3);
	formData.append('idtip', file_data4);
	formData.append('titleEdit', file_data2);
	formData.append('photo2', file_data);
	console.log(formData);
	$.ajax({
		type:"POST",
		data:formData,
		url: "editProductPic.php",
		//contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		cache: false,
		contentType: false,
		processData: false,
                       
		success:function (data) {
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
			swal("Error with saving");
			console.log(data);
		}
	});     
} 
</script>

