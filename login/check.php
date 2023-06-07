<?php
	include 'replace.php';
	$con = mysqli_connect("localhost", "root", "", "portal");

	$tbl_name = "admin";  

	$myusername = replace($_POST['username']); 
	$password =  replace($_POST['password']); 
	$mypassword = sha1($password);

	$sql="SELECT * FROM $tbl_name WHERE user='$myusername' and pass='$mypassword' ";
	$result=mysqli_query($con,$sql);
	$count=mysqli_num_rows($result);
	if($count>0){
		session_start(); 
		$_SESSION['fb_access_token'] = $_SESSION['oauth_token'] = '';
		$podaci = mysqli_fetch_array($result);
		$_SESSION['myusername'] = $myusername;
		$_SESSION['id'] = $podaci['id'];
		$userid = $podaci['id'];
		$_SESSION['email'] = $podaci['email'];
		$date=date("Y-m-d");
		mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Logged in','".$date."')") ;
		$user=$_SESSION['myusername'];
		$date=date("Y-m-d h:i:sa");
		$function="Logged in";
		$userLog=$date.", ".$user.", ".$function."\n";				
		$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
		fwrite($myfile, $userLog);	
		
		/* Save twitter access token in session */
		$sql = "SELECT * from tbltwitterloginaccess where id = 1"; 
		$result = mysqli_query ($con,$sql); 
		$row = mysqli_fetch_array($result);
		
		$token = $row['accesstoken'];
		if(!empty($token) || $token != ''){
			$_SESSION['oauth_token'] = $token;
			$_SESSION['oauth_token_secret'] = $row['secrettoken'];
		}
		
		
		$cookie_name = "id";
		$cookie_value = $_SESSION['id'];
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
		
		/* Save facebook access token in session */
		$sql = "SELECT * from tblfacebookloginaccess where vicituserid = $userid "; 
		$result = mysqli_query ($con,$sql); 
		$fbrow = mysqli_fetch_array($result);
		$count=mysqli_num_rows($result);
		if($count>0){
			
			$fbtoken = $fbrow['accesstoken'];
			if(!empty($fbtoken) || $fbtoken != ''){
				$_SESSION['fb_access_token'] = $fbtoken;
			}
		}

		header("location:cms.php?cms=welcome");
	}

	else{
		header("location:index.php?msg=1");
		/* echo '<meta http-equiv="refresh" content="1;url=index.php?msg=1" />'; */

	}

?>