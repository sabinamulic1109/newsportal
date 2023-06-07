<?PHP
	session_start();
	include 'config.php';
	$today = date('Y-m-d');
	mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Logged out','".$today."')") ;	
	//echo "INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Logged out','".$today."')";
	$user=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Logged out";
	$userLog=$date.", ".$user.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
	/*session_destroy();
	header("location:index.php");*/
	$con1=mysqli_connect("localhost", "root", "", "portal");
	$ipAddressUser= $_SERVER['REMOTE_ADDR'];
	//$sql1="SELECT * FROM users WHERE user='$ipAddressUser' AND domain='$domenaN'"; 
	$sql1="SELECT * FROM admin WHERE user='$ipAddressUser'"; 
	$result1=mysqli_query($con1,$sql1);
	$count=mysqli_num_rows($result1);
	$device=$_SESSION['device'];
	if($device="mobilePhone" && $count>0){
		
		/*$ipAddressUser1= $_SERVER['REMOTE_ADDR'];
		$domenaB=explode('www.', $domenaXV);
		$domenaN=$domenaB[1];

		$akcija = mysqli_query($con,"UPDATE `admin` set token='0' WHERE user='$myusername' and pass='$mypassword' ");
		$con1=mysqli_connect("vicitdigital.com", "vicitdig_domains", "Domains2000!!", "vicitdig_domains");
		$akcija2 = mysqli_query($con1,"UPDATE `users` set token='0' WHERE user='$ipAddressUser1' AND domain='$domenaN'");
		$podaci = mysqli_fetch_array($result);*/
	session_destroy();
	header("location:indexMobile.php?odjava=true");
	}else{
	session_destroy();
	header("location:index.php");
	}
?>
