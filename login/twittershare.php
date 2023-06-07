<?php
	session_start(); 
	require_once ('twitter/src/codebird.php');
	\Codebird\Codebird::setConsumerKey('Jno4ML74WM1o6X4840pQUpgo0', 'sY5VdpwShxZD3oncR0VvxIwVMnTusYdDojvN7t85cj7CyiXwxK'); // static, see README

	$cb = \Codebird\Codebird::getInstance();
	
	
	function logToTwitter(){
		$cb = \Codebird\Codebird::getInstance();

		if (! isset($_SESSION['oauth_token'])) {
			/* get the request token */
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

		echo $_SESSION['oauth_token']; 
		$reply = (array) $cb->statuses_homeTimeline();
		print_r($reply);

	}
	
	
	function postPictureToTwitter($file, $imagelink){
		$cb = \Codebird\Codebird::getInstance();
		$cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
		
		$media_ids = [];

		$reply = $cb->media_upload([
			'media' => $file
		]);
		$media_ids[] = $reply->media_id_string;
		$media_ids = implode(',', $media_ids);

		/*  send Tweet with these medias */
		$reply = $cb->statuses_update([
			'status' => 'New photo on our website '.$imagelink,
			'media_ids' => $media_ids
		]);	
		
	}
	
	function postArticleToTwitter($naslov, $newslink){
		$cb = \Codebird\Codebird::getInstance();
		$cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
		$naslov = ucwords($naslov);
		$naslov = str_ireplace(' ','',$naslov);
		$naslov = '#'.$naslov;
		$params = [
			'status' => $naslov.' '.$newslink
		];
		
		$reply = $cb->statuses_update($params);
		
	}