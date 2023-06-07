<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['menu'] == 0){
echo '<script>window.location.href = "cms.php?cms=welcome"</script>';
}
?>
<style type="text/css">

</style>	  
 <?php
$idgr=$_GET["id"];
$sql = "SELECT * from podgrupe where id='$idgr'"; 
$result = mysqli_query ($con,$sql); 
$row = mysqli_fetch_array($result);
$nazivGR=$row["naziv"];
$urlGR=$row["url"];
$grupa = $row["grupa"];
?>	
<div class="col-sm-8 col-sm-offset-2">
<h3 style="text-align:center;text-transform:uppercase">Edit submenu item</h3>							  
				
<form action="updatepgr.php?id=<?php echo $idgr; ?>&&grupa=<?php echo $grupa; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">	 
<input type="text" name="naziv"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Menu" value="<?php echo $nazivGR;?>"> 
<input type="text" name="url"   style="width:calc(50% - 15px); height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0; float:left" placeholder="URL" value="<?php echo $urlGR;?>"> 
<p style="width:30px;height:40px;float:left;text-align:center;margin:5px 0;padding:7px 5px;">or</p>
<select name="urlcontent" style="width:calc(50% - 15px); height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0" placeholder="Choose content">
<option value="">Choose from content</option>
<?php
$sql = "SELECT * from tekst order by id"; 
$result = mysqli_query ($con,$sql); 
while($row = mysqli_fetch_array($result)){
$value='text.php?id='.$row["id"];
$naslov=$row["naslov"];
?>
<option value="<?php echo $value; ?>"><?php echo $naslov; ?></option>
<?php } ?>
</select> 	 
 <input type="submit" style="background-color:#941046;" name="Submit" value="       SAVE      " class="submitBtn"> 
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



 











