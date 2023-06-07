<?php
	session_start();
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	require_once ('facebook/src/Facebook/autoload.php');
	
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
	use Facebook\FacebookRequestException;
	
	
	$token = $_SESSION['fb_access_token'];

	$fb = new Facebook\Facebook([
		'app_id' => '1185764248242690', 
		'app_secret' => '73fd58bb5d07f744c20679f96d6bcc47',
		'default_graph_version' => 'v3.2',
	]);
	$fb->setDefaultAccessToken($token);

	try {
		// Returns a `Facebook\FacebookResponse` object
		$response = $fb->get('/me/accounts', $token);
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		echo 'Graph returned an error: ' . $e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}
	
	$data = $response->getDecodedBody();
	
	echo '<pre>'; var_dump($data); echo '</pre>';
	
	$app_access_token = $data['data'][0]['access_token'];
	echo 'Token  '.$app_access_token;