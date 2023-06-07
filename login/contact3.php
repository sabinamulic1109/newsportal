<?php

$firstname= mysqli_real_escape_string($con,$_POST["firstname"]);
$from= mysqli_real_escape_string($con,$_POST["email"]);
$phone= mysqli_real_escape_string($con,$_POST["phone"]);
$message= mysqli_real_escape_string($con,$_POST["message"]);
$today = date('Y-m-d');
$authoremail = $from; 


	$response = $_POST["g-recaptcha-response"];
	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$data = array(
		'secret' => '6Lfrpo0UAAAAAEi-Bp9qio2vc1ZbQreWU-9WtZqY',
		'response' => $_POST["g-recaptcha-response"]
	);
	$options = array(
		'http' => array (
			'method' => 'POST',
			'content' => http_build_query($data)
		)
	);
	$context  = stream_context_create($options);
	$verify = file_get_contents($url, false, $context);
	$captcha_success=json_decode($verify);
	if ($captcha_success->success==false) {
		echo "<p>You are a bot! Go away!</p>";
	} else if ($captcha_success->success==true) {
		echo "<p>You are not not a bot!</p>";
	}

?>