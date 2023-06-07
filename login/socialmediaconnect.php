<?php
	/* if($_SESSION['myusername']==''){
		echo header("location:index.php?msg=2");
	} */
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	require_once ('facebook/src/Facebook/autoload.php');
	use Facebook\FacebookRequest;
	use Facebook\GraphObject;
	use Facebook\FacebookRequestException;
?>
<style type="text/css">

tr{
	border-bottom:1px solid black;
}
.submitBtn{
	padding:10px;
	cursor:pointer;
	text-transform:uppercase
}
.submitBtn:hover{
	color:#fff
}
#modal{
	top:64px;
	transform:none;
	height:calc(100vh - 115px);
	
}
.modal-content{
	height:auto;
	overflow:auto;
}
.col-sm-6 .boxq{
	color:#941046;
	width:100%;
	min-height:250px;
	border:1px solid #941046;
	border-radius:5px; 
	padding:25px;
	text-align:center;
	cursor:pointer;
	transition:all 0.5s;
	margin-bottom:10px;
}
.col-sm-6 .boxq img{
	width:150px;	
}
.fblogout{
	margin-top: -4px;
	width:25px !important;
}


</style>
<div align="left">
<div class="col-sm-10 col-sm-offset-1">
	<h2 style="text-align:center;text-transform:uppercase;font-size:2rem">Connect to your social media</h2>
	<div class="row">
		<div class="col-sm-12" style="text-align:justify">
			<p>Choose social media platform to connect with VicitCMS to automatically post your content on this platform. This option will only add content you want to add, saving you time, because you do not have to copy content from your website and paste it to your social media. With our CMS you can do all that with one click. </p>
		</div>
		
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
					  $response = $fb->get('/me', $token);
					} catch(Facebook\Exceptions\FacebookResponseException $e) {
					  echo 'Graph returned an error: ' . $e->getMessage();
					  exit;
					} catch(Facebook\Exceptions\FacebookSDKException $e) {
					  echo 'Facebook SDK returned an error: ' . $e->getMessage();
					  exit;
					}
					$data = $response->getRequest();
					$acct = $data->getAccessToken();
					
					
					
					/* try {
						// Returns a `Facebook\FacebookResponse` object
						$response = $fb->get('/me/permissions', $token);
					} catch(Facebook\Exceptions\FacebookResponseException $e) {
						echo 'Graph returned an error: ' . $e->getMessage();
						exit;
					} catch(Facebook\Exceptions\FacebookSDKException $e) {
						echo 'Facebook SDK returned an error: ' . $e->getMessage();
						exit;
					}
					
					$permissionsal = $response->getDecodedBody();
					
					echo count($permissionsal['data']);
					foreach($permissionsal['data'] as $p){
						echo '<li>'.$p['permission'].'</li>';
					} */
					
					
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

					$permissions = ['email','manage_pages','publish_pages']; // Optional permissions
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
		
		<div class="col-sm-6">
			<div class="boxq">
				<?php

				$token = $_SESSION['oauth_token'];
				if(!empty($token) || $token != ''){
					$sql = "SELECT * from tbltwitterloginaccess where id = 1"; 
					$result = mysqli_query ($con,$sql); 
					$row = mysqli_fetch_array($result);
					$screenname = $row['screenname'];
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
				<a href="logoutfromtwitter.php">
					<img src="images/twitterlogo.png" title="Logout from your twitter" />
				</a>
				<p style="padding-top:20px">You are connected to your twitter account as <?php echo $screenname; ?>.</p>
				
				<p style="padding-top:20px; color: #000">Please select which type of content below you want automatically to share on your twitter account
					<b><?php echo strtoupper($screenname); ?></b>.</p>
					
					<input type="checkbox" id="twitternews" name="checkirantw" value="Your new articles " <?php echo $sharenewschecked; ?> />
					<label style="color: #000" for="twitternews">Share new articles</label>
					
					<input type="checkbox" id="twitterphoto" name="checkirantw" value="Your new photos" <?php echo $sharephotochecked; ?>  />
					<label style="color: #000" for="twitterphoto">Share new photos</label>	
				<?php	
				}else{
				?>
				<p style="padding-top:25px">Connect to twitter</p>
				<a href="logintotwitter.php">
					<img src="images/twitterlogo.png" title="Click to connect CMS with your Twitter" />
				</a>
				
				<?php
				}
				?>
				
			</div>
		</div>

	</div>
	<br>
	<br>
	
		
</div>
<script>
$(document).ready(function(){
	$('input[type=checkbox][name=checkiranfb]').change(function () {
		var actionmsg = this.value;
		var name = this.id;

		if ($('#'+name).is(':checked')) {
			var value = 1;
		}else{
			var value = 0;
		}
		if(name == 'facebooknews'){
			var column = 'sharenews';
		}else{
			var column = 'shareimage';
		}

		var form_data = new FormData(); 
		form_data.append('column', column);
		form_data.append('value', value);
		form_data.append('tbl', 'facebook'); 
		
		
		$.ajax({
			url: "updateShareSettings.php",
			dataType: 'json', 
			cache: false,
			contentType: false,
			processData: false,
			data: form_data, 
			type: 'post',
			success:function (data) {
				if(value == 1){
					var msg = ' will now be automatically shared on your page.';
				}else{
					var msg = ' are no longer automatically shared on your page.';
				}
				var finalmsg = actionmsg+msg;
				swal(finalmsg);	
			}, error:function(data){
				swal(data);
			}
		});  
	});
	
	
	$('input[type=checkbox][name=fbpage]').change(function () {
		var pagetoken = this.value;
		var pageid = this.id;
		var pagename = $("label[for='"+pageid+"']").text(); 
		console.log(pagename);
		if ($('#'+pageid).is(':checked')) {
			var value = pagetoken;
		}else{
			var value = 0;
			pageid = 0; 
			pagename = 0;
		}
		

		var form_data = new FormData(); 
		form_data.append('pageid', pageid);
		form_data.append('value', value);
		form_data.append('pagename', pagename); 
		
		$.ajax({
			url: "updateFBPageSettings.php",
			dataType: 'json', 
			cache: false,
			contentType: false,
			processData: false,
			data: form_data, 
			type: 'post',
			success:function (data) {
				console.log(data);
				swal('Changes saved');	
			}, error:function(data){
				swal(data);
			}
		});  
	});
	
	$('input[type=checkbox][name=checkirantw]').change(function () {
		var actionmsg = this.value;
		var name = this.id;
		
		if ($('#'+name).is(':checked')) {
			var value = 1;
		}else{
			var value = 0;
		}
		if(name == 'twitternews'){
			var column = 'sharenews';
		}else{
			var column = 'shareimage';
		}

		var form_data = new FormData(); 
		form_data.append('column', column);
		form_data.append('value', value);
		form_data.append('tbl', 'twitter'); 
		
		
		$.ajax({
			url: "updateShareSettings.php",
			dataType: 'json', 
			cache: false,
			contentType: false,
			processData: false,
			data: form_data, 
			type: 'post',
			success:function (data) {
				if(value == 1){
					var msg = ' will now be automatically shared on your twitter account.';
				}else{
					var msg = ' are no longer automatically shared on your twitter account.';
				}
				var finalmsg = actionmsg+msg;
				swal(finalmsg);	
			}, error:function(data){
				swal(data);
			}
		});  
	});
	
});
</script>


