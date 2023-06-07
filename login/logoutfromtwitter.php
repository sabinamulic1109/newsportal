<?php
	session_start();
	/* ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL); */
	include 'config.php';
	
	require_once ('twitter/src/codebird.php');
	\Codebird\Codebird::setConsumerKey('Jno4ML74WM1o6X4840pQUpgo0', 'sY5VdpwShxZD3oncR0VvxIwVMnTusYdDojvN7t85cj7CyiXwxK'); // static, see README

	$cb = \Codebird\Codebird::getInstance();

	$cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

	$akcija = mysqli_query($con,"UPDATE tbltwitterloginaccess SET accesstoken = null,
								secrettoken = null, screenname = null, sharenews = null,
							shareimage = null
								WHERE id = 1"); 
	$cb->logout();
	
	unset($_SESSION['oauth_token']);
	unset($_SESSION['oauth_token_secret']);
	
	echo "<script>location.href='cms.php?cms=socialmediaconnect'</script>";


?>