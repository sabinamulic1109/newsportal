<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['settings'] == 0){
echo '<script>window.location.href = "cms.php?cms=welcome"</script>';	
}
?>
<style>
#modal{
	top:64px;
	transform:none;
	height:calc(100vh - 115px);
	
}
.modal-content{
	height:calc(100vh - 175px);
	overflow:auto;
}
</style>
<div class="col-sm-8 col-sm-offset-2">
	<a href="cms.php?cms=social" style="color:#000"><button style="background-color: #941046;" class="submitBtn" >Social media links</button></a>  
	<a href="cms.php?cms=backup" style="color:#000"><button style="background-color: #941046;" class="submitBtn" >Backup database</button></a>
<!--  	
	<a onclick="openModal()" style="color:#000"><button class="submitBtn blue" style="width:49%;float:left;margin-right:1%"  >Facebook connection</button></a>  -->
	<a href="cms.php?cms=mailsettings" style="color:#000;"><button class="submitBtn" style="width:100%; background-color: #941046;" >Email settings</button></a> 
<form action="updatepostavke.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
		   
<input type="text" name="naslov" title="Title" placeholder="Title"  value="<?php  echo $naslovXV;?>" style="width:100%; height:40px; padding:5px; margin:5px 0; border:#CCCCCC solid 1px;" required> 
<input type="text" name="opis"  title="Description" placeholder="Description"  value="<?php  echo $opisXV;?>" style="width:100%; height:40px; padding:5px; margin:5px 0; border:#CCCCCC solid 1px;" required> 
<input type="text" name="kljucne" title="Keywords" placeholder="Keywords"  value="<?php  echo $kljucneXV;?>" style="width:100%; height:40px; padding:5px; margin:5px 0; border:#CCCCCC solid 1px;" required> 
<input type="text" name="adresa" title="Address" placeholder="Address"  value="<?php  echo $adresaXV;?>" style="width:100%; height:40px; padding:5px; margin:5px 0; border:#CCCCCC solid 1px;" required> 
<input type="text" name="grad" title="City" placeholder="City"  value="<?php  echo $gradXV;?>" style="width:100%; height:40px; padding:5px; margin:5px 0; border:#CCCCCC solid 1px;" required> 
<input type="text" name="zemlja" title="Country" placeholder="Country"  value="<?php  echo $zemljaXV;?>" style="width:100%; height:40px; padding:5px; margin:5px 0; border:#CCCCCC solid 1px;" required> 

<input type="text" name="telefon"  title="Phone" placeholder="Phone"  value="<?php  echo $telefonXV;?>" style="width:100%; height:40px; padding:5px; margin:5px 0; border:#CCCCCC solid 1px;" required> 
<input type="text" name="telefon2"  title="Phone 2" placeholder="Phone 2"  value="<?php  echo $telefon2XV;?>" style="width:100%; height:40px; padding:5px; margin:5px 0; border:#CCCCCC solid 1px;" required> 
<input type="text" name="email" title="E-mail" placeholder="E-mail"  value="<?php  echo $emailXV;?>" style="width:100%; height:40px; padding:5px; margin:5px 0; border:#CCCCCC solid 1px;" required> 
<input type="text" name="domena" title="Domain" placeholder="Domain"  value="<?php  echo $domenaXV;?>" style="width:100%; height:40px; padding:5px; margin:5px 0; border:#CCCCCC solid 1px;" required> 
 
 
<div align="right"><input type="submit" style="background-color:#941046;" name="Submit" value="       SAVE      " class="submitBtn" ></div> 
</form>
</div>	
<?php 
$sql = "SELECT * from facebookconnect"; 
$result = mysqli_query ($con,$sql); 
$postavke = array();
while($row = mysqli_fetch_array($result)){
	$postavke[] = $row;
}
$p = $postavke[0];
?>
<div class="modal" id="modal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content" >
      <div class="modal-header">
        <h3 class="modal-title" style="float:left;width:90%">Insert facebook connection data</h3>
        <button type="button" class="close" onclick="closemodal()" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align:left">
			<h3 id="title" style="margin-top:0"></h3>
			<form action="javascript:saveFacebook();" method="post" id="spremi"> 
				<div class="form-group">
					<label>Facebook page</label>
					<input type="text" class="form-control" class="form-control" name="facebookpage" id="facebookpage"  placeholder="Facebook page" title="Facebook page" value="<?php echo $p['facebookpage']; ?>" required />
				</div>
				<div class="form-group">
					<label>API Key</label>
					<input type="text" class="form-control" class="form-control" name="apikey" id="apikey"  placeholder="API Key" title="API Key" value="<?php echo $p['apikey']; ?>" required />
				</div>
				<div class="form-group">
					<label>Security Key</label>
					<input type="text" class="form-control" class="form-control" name="securitykey" id="securitykey"  placeholder="Security Key" title="Security Key" value="<?php echo $p['securitykey']; ?>" required />
				</div>
				<div class="form-group">
					<label>Page ID</label>
					<input type="text" class="form-control" class="form-control" name="pageid" id="pageid"  placeholder="Security Key" title="Page ID" value="<?php echo $p['pageid']; ?>" required />
				</div>
				<div class="form-group">
					<label>App ID</label>
					<input type="text" class="form-control" class="form-control" name="appid" id="appid"  placeholder="Security Key" title="App Id" value="<?php echo $p['appid']; ?>" required />
				</div>
			  <button type="submit" style="background-color:#941046;color:#fff;width:100%; height:40px; border: 1px solid transparent; padding:5px; margin:5px 0;border-radius: .25rem;">SAVE</button>
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


      </div>
      <div class="modal-footer">
        <a onclick="closemodal()" style="color:#000;cursor:pointer">CLOSE</a>
      </div>
    </div>
  </div>
</div>	

<script>
function openModal(){
	$("#modal").toggle();	     
}

function closemodal(){
	$("#modal").toggle();	
}

function saveFacebook(){
	var formData = $('#spremi').serialize();
	$.ajax({
		type:"POST",
		data:formData,
		url: "saveFacebook.php",
		//contentType: "application/json; charset=utf-8",
		dataType: "JSON",
		success:function (data) {
			if(data.state == 'true'){
				swal("Changes are saved!");
				$("#modal").toggle();
			}else{
				swal("Error with saving");
				console.log(data);
			}			
		}, error:function(data){
			swal("Error with saving cnnect");
			console.log(data);
		}
	});     
} 
</script>