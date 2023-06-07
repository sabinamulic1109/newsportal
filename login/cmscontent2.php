<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['content'] == 0){
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
	display:none;
	position:absolute;
	z-index:1;
}
#editor{
height:800px;
}
</style>
  <?php
$idT=$_GET["id"];
$sql = "SELECT * from tekst where id='$idT'"; 
$result = mysqli_query ($con,$sql); 
$row = mysqli_fetch_array($result);
$nasvloTek=$row["naslov"];
$podnasvloTek=$row["podnaslov"];
$tekstTek=$row["opis"];


?>		
<div align="left">
<div class="col-sm-8 col-sm-offset-2">
<h3 style="text-align:center;text-transform:uppercase">Edit content</h3>
<form action="updatetekst.php?id=<?php echo $_GET["id"];?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
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
	  	 
<input type="text" name="naslov"  value="<?php echo $nasvloTek;?>" style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;"> 
<input type="text" name="podnaslov"  value="<?php echo $podnasvloTek;?>" style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;">  
Photo
<input type="file" name="photo1"  id="file" style="width:100%; height:40px;  border:#941046 solid 1px; padding:5px; margin:5px 0;" onchange="loadFile(event)">  

<div class="imgShow">
	<!-- <span name="delPic" id="delete" onclick="hide()"><i class="fa fa-times" title="Dismiss"></i></span> -->
	<?php if($row["foto"] == ''){
	?>
	<img id="output" width="100%" height="auto" style="margin-bottom:5px;">	
	<?php	
	}else{ ?>
	<p style="text-align:center">
		<a href ="rotateimage.php?type=content&id=<?php echo $idT; ?>&degrees=90" title="Rotate counterclockwise">
			<i class="fas fa-undo" style="font-size:13px;color:#454545"></i>
		</a> 
		| 
		<a href ="rotateimage.php?type=content&id=<?php echo $idT; ?>&degrees=270" title="Rotate clockwise">
			<i class="fas fa-redo" style="font-size:13px;color:#454545"></i>
		</a>
	</p>
	<img id="output" width="100%" height="auto" style="margin-bottom:5px;" src="images/<?php echo $row["foto"];?>?m=<?php echo filemtime('images/'.$row["foto"]); ?>">
	<?php	
	} ?>
</div>
<textarea name="tekst"  id="editor" rows="20" style="width:100%; height:802px; padding:5px; margin:5px; border:#CCCCCC solid 1px; border:#941046 solid 1px; padding:5px; margin:5px 0;"><?php echo $tekstTek;?></textarea>	
<input type="submit" name="Submit" style="background-color: #941046;" value="       SAVE      " class="submitBtn"> 
</form>
</div>
 <script>
	$('#editor').summernote({
			tabsize: 8,
			height: 300,
			followingToolbar: false 
		});	
</script>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
	/* document.getElementById('delete').style.display="block"; */
	document.getElementById('output').style.display="block";
  };
  
  function hide(){
	  document.getElementById('output').style.display="none";
	 /*  document.getElementById('delete').style.display="none"; */
	  
	  var file = document.getElementById("file");
	  file.value = file.defaultValue;
  }
</script>
</div>


