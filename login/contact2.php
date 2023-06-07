<?php
/* header('Location: '.$_SERVER['HTTP_REFERER']); */
/* echo $_SERVER['HTTP_REFERER']; */
session_start();
/* error_reporting(E_ALL); 
ini_set('display_errors', 1); */

/* ini_set('extension', 'php_com_dotnet.dll'); */

?>

<?php 
/* $extdir=ini_get('extension_dir');

$modules=get_extensions();
foreach($modules as $m){
    $lib=$extdir.'/'.$m.'.so';
    if (file_exists($lib)) {
        print "$m: dynamically loaded<br>";
    } else {
        print "$m: statically loaded<br>";
    }
}  */
?>

<?php 
include 'config.php';
include 'replace.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



	$response = $_POST["g-recaptcha-response"];
	$url = 'https://www.google.com/recaptcha/api/siteverify';
	/* Unesi secret key kreiran na google recaptcha admin */
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
		if(isset($_POST["email_add"]) && $_POST["email_add"] != '' ){
			echo "<p>You are a bot! Go away!2</p>";
		}else{
			$firstname= mysqli_real_escape_string($con,$_POST["firstname"]);
			$from= mysqli_real_escape_string($con,$_POST["email"]);
			$phone= mysqli_real_escape_string($con,$_POST["phone"]);
			$message= mysqli_real_escape_string($con,$_POST["message"]);
			$today = date('Y-m-d');
			$authoremail = $from; 
			$message = replace($message);
			$txt ='<html>
						<body>
							<div style="text-align:center;">						
								<h2>'.$firstname.' <<a href="mailto:'.$from.'">'. $from.'</a>> has sent you a new message</h2>
								<h4>Click on email above to answer them.</h4>
								<br><br><i>'.$message.'</i><br><br>
								You can find this message in your CMS.
							
							</div>
						</body>
					</html>';

			$akcija = mysqli_query($con,"INSERT INTO `poruke`( `isRead`, `name`, `email`, `phone`, `message`, `date`) 
			VALUES (0,'$firstname','$authoremail','$phone','$message','$today')");





			if($akcija == true){
				$mail = new PHPMailer;
				$mail->isSMTP(); 
				$mail->SMTPDebug = 0; 
				$mail->Host = "tls://smtp.gmail.com:587"; 
				/* $mail->Host = "smtp.amis.hr"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6 */
				$mail->Port = 587; // TLS only
				$mail->SMTPSecure = 'tls';
				$mail->Priority = 3;
				
				$mail->SMTPAuth = true;
				/* $mail->Username = 'geosoft';
				$mail->Password = 'NY3UN94P'; */
				$mail->Username = 'vicitdigitalagency@gmail.com';
				$mail->Password = 'Vicitdigitalsupport2019!';
				$mail->smtpConnect(
					array(
						"ssl" => array(
							"verify_peer" => false,
							"verify_peer_name" => false,
							"allow_self_signed" => true
						)
					)
				);

				$mail->AddReplyTo($from, $firstname);
				$mail->addAddress('adis@vicitdigital.com','Adis Saha' );  
				//$mail->addAddress('emaa.suljic@gmail.com','' );  
				$mail->From = 'vicitdigitalagency@gmail.com';
				$mail->FromName = 'Vicit Digital Agency';
				$mail->Sender = $from;
			//	$mail->addAddress('emaa.suljic@gmail.com','' );  
				/* Ovo za provjeru da li je mail na spam listi */
				/* $mail->addAddress('test-z3ks9@mail-tester.com','' );  */
				$mail->Subject = $firstname." is trying to contact you through vicitdigital.net";
				
				
				$mail->addCustomHeader("Organization" , 'vicitdigital.net'); 
				$mail->addCustomHeader("X-MSmail-Priority" , "Normal");
				$mail->addCustomHeader("X-MimeOLE" , "Produced By Microsoft MimeOLE V6.00.2800.1441");
				$mail->addCustomHeader('X-AntiAbuse', 'This is a solicited email for vicitdigital.net mailing list.');
				$mail->addCustomHeader('X-AntiAbuse', "Servername - ".$_SERVER['SERVER_NAME']);
				$mail->addCustomHeader('X-AntiAbuse', $mail->Sender);
				$mail->AddCustomHeader("List-Unsubscribe: <mailto:support@vicitdigital.net?subject=Unsubscribe>");
				
				
				
				$mail->msgHTML($txt);/*  //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded, */
				
				$mail->AltBody = $message;
				
				/* $mail->DKIM_domain = 'vicitdigital.net';
				$mail->DKIM_private = 'selector._domainkey';
				$mail->DKIM_selector = 'phpmailer';
				$mail->DKIM_passphrase = '';
				$mail->DKIM_identity = $mail->From; */

				
				if(!$mail->send()){
					echo "Mailer Error: " . $mail->ErrorInfo;
					$_SESSION['message'] = 'Message couldn\'t be send now. Please try later!';
				}else{
					/* echo 'Poslana je'; */
					$_SESSION['message'] = "Message sent!";
				}
			/* 	echo "kraj"; */
			}else{
				$_SESSION['message'] = 'Message couldn\'t be send now. Please try later!';
			}
			echo '<script>window.location.href="'.$_SERVER['HTTP_REFERER'].'"</script>';	
		}
	}
?>

