<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
include 'config.php';

$username = mysqli_real_escape_string($con, $_POST['username']);
$email = mysqli_real_escape_string($con, $_POST['email']);
$pass = mysqli_real_escape_string($con, $_POST['password']);
$repPass = mysqli_real_escape_string($con, $_POST['repeat']);
$type = $_POST['type'];
$sql="SELECT * FROM admin WHERE user='$username'";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);

if($count > 0){
	$_SESSION['msg2']='User with this username exists!';
}else{
	if($pass == $repPass){
		$pass = sha1($pass);
		$token="0";
		$akcija = mysqli_query($con,"INSERT INTO `admin` VALUES (0,'".$username."','".$pass."','".$type."','".$email."','".$token."')");
		if($akcija == true){
			$id = mysqli_insert_id($con);
			$today = date('Y-m-d');
			mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Added new user ".$username."','".$today."')") ;	
			$user=$_SESSION['myusername'];
			$date=date("Y-m-d h:i:sa");
			$function="Added new user ".$username;
			$userLog=$date.", ".$user.", ".$function."\n";				
			$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
			fwrite($myfile, $userLog);
			if($type == 'admin'){
				mysqli_query($con,"INSERT INTO `roles` VALUES (0,'".$id."','1','1','1','1','1','1','1','1','1','1','1','1','1')");
			}else if($type == 'user') {
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
					}/*if(isset($_POST['settings'])){
						$settings = 1;
					}else{
						$setting = 0;
					}*/
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
					if(isset($_POST['jobs'])){
						$jobs = 1;
					}else{
						$jobs = 0;
					}
					if(isset($_POST['oglasi'])){
						$oglasi = 1;
					}else{
						$oglasi = 0;
					}
					$akc=mysqli_query($con,"INSERT INTO `roles` VALUES (0,'".$id."','".$settings."','".$content."',
					'".$slider."','".$menu."','".$news."','".$gallery."','".$reservations."','".$testimonials."','".$messages."','".$users."','".$userlogs."','".$jobs."','".$oglasi."')") ;
			
				}
			if ($akc == true) {
				$_SESSION['msg'] = 'User saved!';
				$notf = "INSERT INTO notifikacije(comment_subject, comment_text)VALUES ('Dodan novi korisnik:', '$username')";
				mysqli_query($con, $notf);
			}
		}else{
			$user=$_SESSION['myusername'];
			$date=date("Y-m-d h:i:sa");
			$function="Error description: " . mysqli_error($con);
			$userLog=$date.", ".$user.", ".$function."\n";				
			$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
			fwrite($myfile, $userLog);
			$_SESSION['msg2'] = mysqli_error($con);
		}							
	}else{
		$_SESSION['msg2']='Please type same password in both fields!';
	}
}


?>