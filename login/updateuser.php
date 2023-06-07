<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
include 'config.php';
$id=$_GET["id"];

$sql = "SELECT * from admin where id='$id'"; 
$result = mysqli_query ($con,$sql); 
$row = mysqli_fetch_array($result);
$oldpass=$row["pass"];

$username = mysqli_real_escape_string($con, $_POST['username']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$type = mysqli_real_escape_string($con, $_POST['type']);
if(!empty($_POST['oldpassword'])&& !empty($_POST['password'])){
$old =  sha1(mysqli_real_escape_string($con, $_POST['oldpassword']));
if($old === $oldpass){
	$pass = mysqli_real_escape_string($con, $_POST['password']);
	$repPass = mysqli_real_escape_string($con, $_POST['repeat']);
	$sql="SELECT * FROM admin WHERE user='$username' and id != $id";
	$result=mysqli_query($con,$sql);
	$count=mysqli_num_rows($result);
	if($count > 0){
		$_SESSION['msg2']='User with this username exists!';
	}else{
		if($pass === $repPass){
			$pass = sha1($pass);
			$akcija = mysqli_query($con,"UPDATE `admin` set user='$username', email='$email', pass='$pass', type = '$type' where id='$id'");
			if($akcija == true){
				$today = date('Y-m-d');
				mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Updated user ".$username."','".$today."')");	
				$user1=$_SESSION['myusername'];
				$date=date("Y-m-d h:i:sa");
				$function="Updated user ".$username;
				$userLog=$date.", ".$user1.", ".$function."\n";				
				$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
				fwrite($myfile, $userLog);
				
				if($type == 'admin'){
					mysqli_query($con,"UPDATE roles SET settings=1,content=1,slider=1,menu=1,news=1,gallery=1,reservations=1,testimonials=1,messages=1,users=1,userlogs=1 WHERE userid=$id") ;							
				}else{
						if(isset($_POST['settings'])){
							$settings = 1;
						}else{
							$settings = 0;
						}
						if(isset($_POST['content'])){
							$content = 1;
						}else{
							$content = 0;
						}
						if(isset($_POST['slider'])){
							$slider = 1;
						}else{
							$slider = 0;
						}if(isset($_POST['settings'])){
							$settings = 1;
						}else{
							$setting = 0;
						}
						if(isset($_POST['menu'])){
							$menu = 1;
						}else{
							$menu = 0;
						}
						if(isset($_POST['news'])){
							$news = 1;
						}else{
							$news = 0;
						}
						if(isset($_POST['gallery'])){
							$gallery = 1;
						}else{
							$gallery = 0;
						}
						if(isset($_POST['reservations'])){
							$reservations = 1;
						}else{
							$reservations = 0;
						}
						if(isset($_POST['testimonials'])){
							$testimonials = 1;
						}else{
							$testimonials = 0;
						}
						if(isset($_POST['messages'])){
							$messages = 1;
						}else{
							$messages = 0;
						}
						if(isset($_POST['users'])){
							$users = 1;
						}else{
							$users = 0;
						}
						if(isset($_POST['userlogs'])){
							$userlogs = 1;
						}else{
							$userlogs = 0;
						}
						mysqli_query($con,"UPDATE roles SET settings=$settings,content=$content,slider=$slider,menu=$menu,news=$news,gallery=$gallery,reservations=$reservations,testimonials=$testimonials,messages=$messages,users=$users,userlogs=$userlogs WHERE userid=$id") ;
				}				
				$_SESSION['msg']='Changes have been saved!';
				
			}else{
				$user1=$_SESSION['myusername'];
				$date=date("Y-m-d h:i:sa");
				$function="Error updating user ".$username.": " . mysqli_error($con);
				$userLog=$date.", ".$user1.", ".$function."\n";				
				$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
				fwrite($myfile, $userLog);
				$_SESSION['msg2']= mysqli_error($con);
			}
		}else{
			$_SESSION['msg2']='Please type same password in both fields!';
		}
	}				
}else{
	$_SESSION['msg2']='Old password is incorrect!';	
}			
}else{
$sql="SELECT * FROM admin WHERE user='$username' and id != $id";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
if($count > 0){
		$_SESSION['msg2']='User with this username exists!';
}else{
	$today = date('Y-m-d');
	mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Updated user ".$username."','".$today."')") ;
	mysqli_query($con,"UPDATE `admin` set user='$username', email='$email', type = '$type' where id=$id");
	if($type == 'admin'){
		mysqli_query($con,"UPDATE roles SET settings=1,content=1,slider=1,menu=1,news=1,gallery=1,reservations=1,testimonials=1,messages=1,users=1,userlogs=1 WHERE userid=$id") ;							
	}else{
			if(isset($_POST['settings'])){
				$settings = 1;
			}else{
				$settings = 0;
			}
			if(isset($_POST['content'])){
				$content = 1;
			}else{
				$content = 0;
			}
			if(isset($_POST['slider'])){
				$slider = 1;
			}else{
				$slider = 0;
			}if(isset($_POST['settings'])){
				$settings = 1;
			}else{
				$setting = 0;
			}
			if(isset($_POST['menu'])){
				$menu = 1;
			}else{
				$menu = 0;
			}
			if(isset($_POST['news'])){
				$news = 1;
			}else{
				$news = 0;
			}
			if(isset($_POST['gallery'])){
				$gallery = 1;
			}else{
				$gallery = 0;
			}
			if(isset($_POST['reservations'])){
				$reservations = 1;
			}else{
				$reservations = 0;
			}
			if(isset($_POST['testimonials'])){
				$testimonials = 1;
			}else{
				$testimonials = 0;
			}
			if(isset($_POST['messages'])){
				$messages = 1;
			}else{
				$messages = 0;
			}
			if(isset($_POST['users'])){
				$users = 1;
			}else{
				$users = 0;
			}
			if(isset($_POST['userlogs'])){
				$userlogs = 1;
			}else{
				$userlogs = 0;
			}
			mysqli_query($con,"UPDATE roles SET settings=$settings,content=$content,slider=$slider,menu=$menu,news=$news,gallery=$gallery,reservations=$reservations,testimonials=$testimonials,messages=$messages,users=$users,userlogs=$userlogs WHERE userid=$id") ;
		}
	$_SESSION['msg']='Changes have been saved';
}
}



?>