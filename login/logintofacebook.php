<?php 
	session_start();
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	include 'config.php';
	
	require_once ('facebook/src/Facebook/autoload.php');
	
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
	use Facebook\FacebookRequestException;
	
	$fb = new Facebook\Facebook([
		'app_id' => '1185764248242690', // Replace {app-id} with your app id
		'app_secret' => '73fd58bb5d07f744c20679f96d6bcc47',
		'default_graph_version' => 'v3.2',
	]);
	
	$helper = $fb->getRedirectLoginHelper();
	$_SESSION['FBRLH_state'] = $_GET['state'];
	

	try{
		$accessToken = $helper->getAccessToken();
	}catch(Facebook\Exceptions\FacebookResponseException $e) {
		/* // When Graph returns an error */
		echo 'Graph returned an error: ' . $e->getMessage();
		exit;
	}catch(Facebook\Exceptions\FacebookSDKException $e) {
		/* // When validation fails or other local issues */
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}

	
	

	if (! isset($accessToken)) {
		if ($helper->getError()) {
			header('HTTP/1.0 401 Unauthorized');
			echo "Error: " . $helper->getError() . "\n";
			echo "Error Code: " . $helper->getErrorCode() . "\n";
			echo "Error Reason: " . $helper->getErrorReason() . "\n";
			echo "Error Description: " . $helper->getErrorDescription() . "\n";
		} else {
			header('HTTP/1.0 400 Bad Request');
			echo 'Bad request';
		}
		exit;
	}

/* 	// Logged in
	echo '<h3>Access Token</h3>';
	$token = $accessToken->getValue(); */
	/* var_dump($accessToken->getValue()); */
	
	

		
	// The OAuth 2.0 client handler helps us manage access tokens
	$oAuth2Client = $fb->getOAuth2Client();



	// Get the access token metadata from /debug_token
	$tokenMetadata = $oAuth2Client->debugToken($accessToken);
	/* echo '<h3>Metadata</h3>';
	echo '<pre>'; var_dump($tokenMetadata); echo '</pre>'; */
	$appname = $tokenMetadata->getField('application');

	// Validation (these will throw FacebookSDKException's when they fail)
	$tokenMetadata->validateAppId('1185764248242690'); // Replace {app-id} with your app id
	// If you know the user ID this access token belongs to, you can validate it here
	//$tokenMetadata->validateUserId('123');
	$tokenMetadata->validateExpiration();

	if (! $accessToken->isLongLived()) {
	  // Exchanges a short-lived access token for a long-lived one
	  try {
		$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
	  } catch (Facebook\Exceptions\FacebookSDKException $e) {
		echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
		exit;
	  }

	 /*  echo '<h3>Long-lived</h3>';
	  var_dump($accessToken->getValue()); */
	}

	$_SESSION['fb_access_token'] = (string) $accessToken;
	$token = $_SESSION['fb_access_token'];

	/* 	echo '<h3>User</h3>'; */
	try {
		  // Returns a `Facebook\FacebookResponse` object
		  $response = $fb->get('/me?fields=id,name', $token);
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}

		$user = $response->getGraphUser();
	
		$username = $user['name'];
		$userid = $user['id'];
	/* echo 'Name: ' . $user['name']; */
	
		$vicituserid = $_COOKIE['id'];
		
		
		$sql="SELECT * FROM admin WHERE id = $vicituserid ";
		$result=mysqli_query($con,$sql);
		$count=mysqli_num_rows($result);
		if($count>0){
			$podaci = mysqli_fetch_array($result);
			$_SESSION['myusername'] = $podaci['user'];
			$_SESSION['id'] = $podaci['id'];
			$_SESSION['email'] = $podaci['email'];
		}
		
		$sql = "SELECT * from tblfacebookloginaccess where vicituserid = $vicituserid "; 
		/* echo $sql; */
		$result = mysqli_query ($con,$sql); 
		$fbrow = mysqli_fetch_array($result);
		$count=mysqli_num_rows($result);
		if($count == 0){
			$sql = "INSERT INTO tblfacebookloginaccess( vicituserid, accesstoken, appname, loggeduser, userid) 
			VALUES ($vicituserid,'$token','$appname','$username','$userid')";
			/* echo $sql; */
			$akcija = mysqli_query($con,$sql);  
			$_SESSION['fb_access_token'] = $token;
		}else{
			$akcija = mysqli_query($con,"UPDATE tblfacebookloginaccess SET 
							accesstoken = '$token',
							appname = '$appname',
							loggeduser = '$username',
							userid = '$userid'
							WHERE vicituserid  = $vicituserid "); 
			$_SESSION['fb_access_token'] = $token;
		}

	
	
	
	/*  User is logged in with a long-lived access token.
		You can redirect them to a members-only page. */
	echo "<script>location.href='cms.php?cms=socialmediaconnect'</script>";

?>