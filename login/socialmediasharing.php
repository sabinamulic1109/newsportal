<?php
	session_start();
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	include 'config.php';
	
	require_once ('twitter/src/codebird.php');
	\Codebird\Codebird::setConsumerKey('Jno4ML74WM1o6X4840pQUpgo0', 'sY5VdpwShxZD3oncR0VvxIwVMnTusYdDojvN7t85cj7CyiXwxK'); // static, see README

	$cb = \Codebird\Codebird::getInstance();

	if (! isset($_SESSION['oauth_token'])) {
	  // get the request token
	  $reply = $cb->oauth_requestToken([
		'oauth_callback' => 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
	  ]);

	  // store the token
	  $cb->setToken($reply->oauth_token, $reply->oauth_token_secret);
	  $_SESSION['oauth_token'] = $reply->oauth_token;
	  $_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;
	  $_SESSION['oauth_verify'] = true;

	  // redirect to auth website
	  $auth_url = $cb->oauth_authorize();
	  header('Location: ' . $auth_url);
	  die();

	} elseif (isset($_GET['oauth_verifier']) && isset($_SESSION['oauth_verify'])) {
	  // verify the token
	  $cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
	  unset($_SESSION['oauth_verify']);

	  // get the access token
	  $reply = $cb->oauth_accessToken([
		'oauth_verifier' => $_GET['oauth_verifier']
	  ]);

	  // store the token (which is different from the request token!)
	  $_SESSION['oauth_token'] = $reply->oauth_token;
	  $_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;
		
			
	  // send to same URL, without oauth GET parameters
	  header('Location: ' . basename(__FILE__));
	  die();
	}
	// assign access token on each page load
	$cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
	$token = $_SESSION['oauth_token'];
	$secret = $_SESSION['oauth_token_secret'];
	$akcija = mysqli_query($con,"UPDATE tbltwitterloginaccess SET accesstoken = '$token',
								secrettoken = '$secret'
								WHERE id = 1"); 
	
	$reply = (array) $cb->statuses_homeTimeline();
	print_r($reply);


?>