<?php
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['users'] == 0){
echo '<script>window.location.href = "cms.php?cms=welcome"</script>';
}
?>
<style type="text/css">

label{
	padding-left:20px !important;
	padding-right:10px;
}
#passworddiv{
	display:none;
	height:155px;
}
</style>

<?php
$id=$_GET["id"];
$sql = "SELECT * from admin where id='$id'"; 
$result = mysqli_query ($con,$sql); 
$row = mysqli_fetch_array($result);
$user=$row["user"];
$email=$row["email"];
$oldpass=$row["pass"];
$type = $row['type'];
$rolesu = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM roles WHERE userid = $id"));
?>
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
<div class="col-sm-8 col-sm-offset-2" style="text-align:left">
<h3 style="text-align:center;text-transform:uppercase">Edit user</h3> 																			
<br>	
<form action="updateuser.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">		  
<input type="text" name="username"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" value="<?php echo $user; ?>" required> 
<input type="text" name="email"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" value="<?php echo $email; ?>" required> 
<input type="checkbox" id="passwordshow" name="checkiran" value=""/>
<label for="passwordshow"> Change password</label>
<div id="passworddiv">
<input type="password" name="oldpassword"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Old password" > 
<input type="password" name="password"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="New password">  
<input type="password" name="repeat"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Repeat new password" >
</div>
<select onchange="selectType();" name="type" id="type">
	<option value="admin" <?php if($type == 'admin'){ ?> selected <?php } ?>>Administrator</option>
	<option value="user" <?php if($type == 'user'){ ?> selected <?php } ?>>User</option>
</select>
<?php if($type == 'user'){?>
<div id="roles">
<label  style="width:100%; text-align:left; padding:5px; margin:5px 0;">Assign what this user can manage and see!</label>
<input type="checkbox" id="settings" name="settings" <?php if($rolesu['settings'] == 1){ ?> checked <?php } ?> />
<label for="settings" >Settings</label>
<input type="checkbox" id="content" name="content" <?php if($rolesu['content'] == 1){ ?> checked <?php } ?>  />
<label for="content" >Content</label>
<input type="checkbox" id="slider" name="slider" <?php if($rolesu['slider'] == 1){ ?> checked <?php } ?>  />
<label for="slider">Slider</label>
<input type="checkbox" id="menu" name="menu" <?php if($rolesu['menu'] == 1){ ?> checked <?php } ?>  />
<label for="menu">Menu</label>
<input type="checkbox" id="news" name="news" <?php if($rolesu['news'] == 1){ ?> checked <?php } ?>  />
<label for="news">News</label>
<input type="checkbox" id="gallery" name="gallery" <?php if($rolesu['gallery'] == 1){ ?> checked <?php } ?> />
<label for="gallery">Gallery</label>
<input type="checkbox" id="reservations" name="reservations" <?php if($rolesu['reservations'] == 1){ ?> checked <?php } ?>  />
<label for="reservations">Reservations</label>
<input type="checkbox" id="testimonials" name="testimonials" <?php if($rolesu['testimonials'] == 1){ ?> checked <?php } ?>  />
<label for="testimonials">Testimonials</label>
<input type="checkbox" id="messages" name="messages" <?php if($rolesu['messages'] == 1){ ?> checked <?php } ?>  />
<label for="messages">Messages</label>
<input type="checkbox" id="users" name="users" <?php if($rolesu['users'] == 1){ ?> checked <?php } ?>  />
<label for="users">Users</label>
<input type="checkbox" id="userlogs" name="userlogs" <?php if($rolesu['userlogs'] == 1){ ?> checked <?php } ?>  />
<label for="userlogs">Userlogs</label>
</div>	
<?php } ?> 
<input type="submit" name="Submit" value="SAVE" style="background-color: #941046;" class="submitBtn"> 
</form>	
</div>	
<script language="JavaScript" type="text/javascript">
function selectType(){
	var tip = $('#type').val();
	if(tip == 'user'){
		console.log('aaa');
		$('#roles').css('display','block');
	}else{
		$('#roles').css('display','none');
	}
}
$(document).ready(function() {
    $('#passwordshow').change(function() {
        $('#passworddiv').slideToggle();
    });
});
</script>










