<?php
	/* if($_SESSION['myusername']==''){
		echo header("location:index.php?msg=2");
	} */
	session_start();
	include('config.php');
	require_once ('facebook/src/Facebook/autoload.php');
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
	use Facebook\FacebookRequestException;
?>

		
		<div class="col-sm-6">
			<div class="boxq">
				<?php
				$token = $_SESSION['fb_access_token'];
				if(!empty($token) || $token != ''){
					$vicituserid = $_SESSION['id'];
					$sql = "SELECT * from tblfacebookloginaccess where vicituserid = $vicituserid"; 
					$result = mysqli_query ($con,$sql); 
					$row = mysqli_fetch_array($result);
					$fbname = $row['loggeduser'];
					$appname = $row['appname'];
					$pagenamesv = $row['pagename'];
					$userid = $row['userid'];
					$_SESSION['fb_access_token'] = $row['accesstoken'];
					if($row['sharenews'] == 1){
						$sharenewschecked = 'checked';
					}else{
						$sharenewschecked = '';
					}
					if($row['shareimage'] == 1){
						$sharephotochecked = 'checked';
					}else{
						$sharephotochecked = '';
					}
				?> 
				<a href="logoutfromfacebook.php" style="background-color:#4267B2; color:#fff; border-radius:5px;padding: 8px 10px;font-weight:700">
					<img class="fblogout" src="images/facebooklogowhite.png" title="Logout from our Facebook App" /> Logout from Facebook
				</a>
				<p style="padding-top:20px">You are connected to facebook through <?php echo $appname; ?> as <?php echo $fbname; ?>.</p>
					<?php
					$token = $_SESSION['fb_access_token'];

					$fb = new Facebook\Facebook([
						'app_id' => '1185764248242690', 
						'app_secret' => '73fd58bb5d07f744c20679f96d6bcc47',
						'default_graph_version' => 'v3.2',
					]);
					$fb->setDefaultAccessToken($token);
 
					try {
					  // Returns a `Facebook\FacebookResponse` object
					  $response = $fb->get('/'.$userid, $token);
					} catch(Facebook\Exceptions\FacebookResponseException $e) {
					  echo 'Graph returned an error: ' . $e->getMessage();
					  exit;
					} catch(Facebook\Exceptions\FacebookSDKException $e) {
					  echo 'Facebook SDK returned an error: ' . $e->getMessage();
					  exit;
					}
					$data = $response->getRequest();
					$acct = $data->getAccessToken();
					

					try {
						// Returns a `Facebook\FacebookResponse` object
						$response = $fb->get('/me/permissions', $token);
					} catch(Facebook\Exceptions\FacebookResponseException $e) {
						echo 'Graph returned an error: ' . $e->getMessage();
						exit;
					} catch(Facebook\Exceptions\FacebookSDKException $e) {
						echo 'Facebook SDK returned an error: ' . $e->getMessage();
						exit;
					}
					
					echo '<pre>'; var_dump($response); echo '</pre>'; 
					
					try {
						// Returns a `Facebook\FacebookResponse` object
						$response = $fb->get('/'.$userid.'/accounts', $token);
					} catch(Facebook\Exceptions\FacebookResponseException $e) {
						echo 'Graph returned an error: ' . $e->getMessage();
						exit;
					} catch(Facebook\Exceptions\FacebookSDKException $e) {
						echo 'Facebook SDK returned an error: ' . $e->getMessage();
						exit;
					}
					
					echo '<pre>'; var_dump($response); echo '</pre>';
					
					$data = $response->getDecodedBody();
					if(count($data['data']) == 0){
						echo 'You do not have any facebook pages. To use our integration and to automatically share content on facebook, you have to have and/or administrate a facebook page';
					}else{
					?>
					<p style="padding-top:20px; color: #000">Please select on which facebook page you want to share content!</p>
					<?php
						
						for ($i = 0; $i< count($response);$i++){
							$pagename = $data['data'][$i]['name'];					
							$pagetoken = $data['data'][$i]['access_token'];
							$pageid = $data['data'][$i]['id'];
							if($pagename == $pagenamesv){
								$checked = 'checked';
							}else{
								$checked = '';
							}
						?>
						<input type="checkbox" id="<?php echo $pageid; ?>" name="fbpage" value="<?php echo $pagetoken; ?>" <?php echo $checked; ?>  />
						<label style="color: #000" for="<?php echo $pageid; ?>"><?php echo $pagename; ?></label>
						<?php
						
						}
						
					
					
					/* $data = $response->getDecodedBody();
					$pagename = $data['data'][0]['name'];					
					$pagetoken = $data['data'][0]['access_token'];
					$pageid = $data['data'][0]['id']; */

					
					?>
					<p style="padding-top:20px; color: #000">Please select which type of content below you want automatically to share on selected page</b>.</p>
					
					<input type="checkbox" id="facebooknews" name="checkiranfb" value="Your new articles " <?php echo $sharenewschecked; ?> />
					<label style="color: #000" for="facebooknews">Share new articles</label>
					
					<input type="checkbox" id="facebookphoto" name="checkiranfb" value="Your new photos" <?php echo $sharephotochecked; ?>/>
					<label style="color: #000" for="facebookphoto">Share new photos</label>
					
				<?php	
					}
				}else{
				?>
				<p style="padding-top:25px">Want to share website content on you Facebook page? Log to your account by clicking on logo below to connect.</p>
				<?php 
					
				
					$fb = new Facebook\Facebook([
						'app_id' => '1185764248242690', // Replace {app-id} with your app id
						'app_secret' => '73fd58bb5d07f744c20679f96d6bcc47',
						'default_graph_version' => 'v3.2',
					]);

					$helper = $fb->getRedirectLoginHelper();

					$permissions = ['email']; // Optional permissions
					$loginUrl = $helper->getLoginUrl($domenaXV.'/login/logintofacebook.php', $permissions);

				?>
				<div style="padding:25px 0 27px">
				<a href="<?php echo htmlspecialchars($loginUrl); ?>" style="background-color:#4267B2; color:#fff; border-radius:5px;padding: 8px 10px;font-weight:700">
					<img class="fblogout" src="images/facebooklogowhite.png" title="Click to connect CMS with your Facebook" /> Continue with Facebook
				</a>
				</div>
				<p>This app will not post content on your Facebook page that was not approved by you.</p>
				<p>With this app you can't post on your profile page, just on Facebook page you own and/or administrate.</p>
				<?php
				}
				?>
			</div>
		</div>

	</div>
	<br>
	<br>
	
		
</div>



