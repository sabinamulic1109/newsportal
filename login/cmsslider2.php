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
$idsl=$_GET["id"];
$sql = "SELECT * from slider where id='$idsl'"; 
$result = mysqli_query ($con,$sql); 
$row = mysqli_fetch_array($result);
$naslovSL=$row["naslov"];
$podnaslovSL=$row["podnaslov"];
$urlSL=$row["url"];
$fileDok=$row["file"];
?>
<div class="col-sm-8 col-sm-offset-2">
<h3 style="text-align:center;text-transform:uppercase">Edit slide</h3>		 	   
  [Photo size: 1920 * 1000 px]                    
<form action="updateslider.php?id=<?php echo $idsl; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
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

<input type="text" name="naslov"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Title" value="<?php echo $naslovSL;?>"> 
<input type="text" name="podnaslov"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Subtitle" value="<?php echo $podnaslovSL;?>"> 
<input type="text" name="url"  style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Link" value="<?php echo $urlSL;?>"> 
<input type="file" name="photo1"  id="file" style="width:100%; height:40px;  border:#941046 solid 1px; padding:5px; margin:5px 0;" onchange="loadFile(event)">
<p style="text-align:center">
		<a href ="rotateimage.php?type=slider&id=<?php echo $idsl; ?>&degrees=90" title="Rotate counterclockwise">
			<i class="fas fa-undo" style="font-size:13px;color:#454545"></i>
		</a> 
		| 
		<a href ="rotateimage.php?type=slider&id=<?php echo $idsl; ?>&degrees=270" title="Rotate clockwise">
			<i class="fas fa-redo" style="font-size:13px;color:#454545"></i>
		</a>
	</p>  
 
<div class="imgShow">
<!-- <span name="delPic" id="delete" onclick="hide()"><i class="fa fa-times" title="Dismiss"></i></span> -->
<img id="output" width="100%" height="auto" style="margin:5px 0;" src="slider/<?php echo $fileDok;?>?m=<?php echo filemtime('slider/'.$fileDok); ?>">
</div>
	 
	<div align="right">
<input type="submit" style="background-color:#941046;" name="Submit" value="       Save      " class="submitBtn"></div>	 	 
  	</form>	
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
</script>