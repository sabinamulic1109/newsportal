<?php
	session_start();
	/* ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL); */
	
	require_once ('facebook/src/Facebook/autoload.php');
	
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
	use Facebook\FacebookRequestException;
	
	
	
	
	function postPictureToFacebook($file, $imagelink){
		$vicituserid = $_SESSION['id'];
		include 'configfunctions.php';
		
		$token = $_SESSION['fb_access_token'];

		$fb = new Facebook\Facebook([
			'app_id' => '1185764248242690', 
			'app_secret' => '73fd58bb5d07f744c20679f96d6bcc47',
			'default_graph_version' => 'v3.2',
		]);
		$fb->setDefaultAccessToken($token);

		/* try {
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
		$app_access_token = $data['data'][0]['access_token'];
		$appID = $data['data'][0]['id']; */
		
		$sql = "SELECT * from tblfacebookloginaccess where vicituserid = $vicituserid"; 
		$result = mysqli_query ($con,$sql); 
		$row = mysqli_fetch_array($result);
		$appID = $row['pageid'];
		$app_access_token = $row['pagetoken'];
		if($app_access_token != '0' ){
			$fb->setDefaultAccessToken($app_access_token);
			$batch = [
			  'photo-one' => $fb->request('POST', '/'.$appID.'/feed', [
					'message' => "Check out new photo we added to our website!",
					'link'    => $imagelink,
					'access_token' => $app_access_token,

				]),
			];

			try {
				$responses = $fb->sendBatchRequest($batch);
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
			  // When Graph returns an error
				echo 'Graph returned an error: ' . $e->getMessage();
				exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
				// When validation fails or other local issues
				echo 'Facebook SDK returned an error: ' . $e->getMessage();
				exit;
			}

			foreach ($responses as $key => $response) {
			  if ($response->isError()) {
				$e = $response->getThrownException();
				echo '<p>Error! Facebook SDK Said: ' . $e->getMessage() . "\n\n";
				echo '<p>Graph Said: ' . "\n\n";
				echo '<pre>'; var_dump($e->getResponse()); echo '</pre>';
			  } else {
				/* echo "<p>(" . $key . ") HTTP status code: " . $response->getHttpStatusCode() . "<br />\n";
				echo "Response: " . $response->getBody() . "</p>\n\n";
				echo "<hr />\n\n"; */
			  }
			}
		}
		else{
			
		}
		
				
		
	}
	
	function postArticleToFacebook($naslov, $newslink){
		$vicituserid = $_SESSION['id'];
		include 'configfunctions.php';
		
		$naslov = ucwords($naslov);
		$naslov = str_ireplace(' ','',$naslov);
		$naslov = '#'.$naslov;
		
		
		$token = $_SESSION['fb_access_token'];

		$fb = new Facebook\Facebook([
			'app_id' => '1185764248242690', 
			'app_secret' => '73fd58bb5d07f744c20679f96d6bcc47',
			'default_graph_version' => 'v3.2',
		]);
		$fb->setDefaultAccessToken($token);

		/* try {
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
		$app_access_token = $data['data'][0]['access_token'];
		$appID = $data['data'][0]['id']; */
		
		$sql = "SELECT * from tblfacebookloginaccess where vicituserid = $vicituserid"; 
		$result = mysqli_query ($con,$sql); 
		$row = mysqli_fetch_array($result);
		$appID = $row['pageid'];
		$app_access_token = $row['pagetoken'];
		if($app_access_token != '0' ){		
			$fb->setDefaultAccessToken($app_access_token);
			$batch = [
			  'photo-one' => $fb->request('POST', '/'.$appID.'/feed', [
					'message' => $naslov,
					'link'    => $newslink,
					'access_token' => $app_access_token,

				]),
			];

			try {
				$responses = $fb->sendBatchRequest($batch);
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
			  // When Graph returns an error
				echo 'Graph returned an error: ' . $e->getMessage();
				exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
				// When validation fails or other local issues
				echo 'Facebook SDK returned an error: ' . $e->getMessage();
				exit;
			}

			foreach ($responses as $key => $response) {
			  if ($response->isError()) {
				$e = $response->getThrownException();
				echo '<p>Error! Facebook SDK Said: ' . $e->getMessage() . "\n\n";
				echo '<p>Graph Said: ' . "\n\n";
				echo '<pre>'; var_dump($e->getResponse()); echo '</pre>';
			  } else {
				/* echo "<p>(" . $key . ") HTTP status code: " . $response->getHttpStatusCode() . "<br />\n";
				echo "Response: " . $response->getBody() . "</p>\n\n";
				echo "<hr />\n\n"; */
			  }
			}		
		}
		
	}