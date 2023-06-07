<?php
	session_start();
	include 'config.php';
	
	$vicituserid = $_SESSION['id'];
	$akcija = mysqli_query($con,"UPDATE tblfacebookloginaccess SET 
							accesstoken = null,
							appname = null,
							loggeduser = null,
							userid = '0',
							sharenews = null,
							shareimage = null,
							pageid = '0',
							pagename = '0',
							pagetoken = '0'
							WHERE vicituserid  = $vicituserid"); 

	
	unset($_SESSION['fb_access_token']);
	echo "<script>location.href='cms.php?cms=socialmediaconnect'</script>";


?>