<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php 
include 'config.php';
include 'replace.php';

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
	} else if ($captcha_success->success==true) 
		if(isset($_POST["email_add"]) && $_POST["email_add"] != '' ){
			echo "<p>You are a bot and we do not want you! Go away! </p>";
		}else{
			$name= mysqli_real_escape_string($con,$_POST["name"]);
			$dog= mysqli_real_escape_string($con,$_POST["dog"]);
			$email= mysqli_real_escape_string($con,$_POST["email"]);
			$phone= mysqli_real_escape_string($con,$_POST["phone"]);
			$message= mysqli_real_escape_string($con,$_POST["message"]);
			$dateDeparture = replace($_POST["dateDeparture"]);
			$dateArrival = replace($_POST["dateArrival"]);
			$today = date('Y-m-d');
			$authoremail = $email; 
			$message = replace($message);


			$akcija = mysqli_query($con,"INSERT INTO `reservation`( `dog`, `dateArrival`, `timeArrival`, `dateDeparture`, `timeDeparture`, `name`, `email`, `phone`, `message`, `date`) VALUES 
			('$dog','$dateArrival','10:00','$dateDeparture','10:00','$name','$email','$phone','$message','$today')");

			if($akcija == true){
				$id = mysqli_insert_id($con);
				
				$admins = array();
				$sql = "SELECT a.id, a.user, a.email, m.sendmail
						FROM admin a
						LEFT JOIN sendmailadmin m ON
						a.id = m.admin
						where m.sendmail=1"; 
				$result = mysqli_query ($con,$sql); 
				while($row = mysqli_fetch_array($result)){
					$admins[] = $row;
				}

				foreach($admins as $admin){
					$email = $admin['email'];
					$subject = $firstname." is trying to contact you";
					$txt ='<html>
							<body>
								<div style="text-align:center;">						
									<h2>'. $firstname.' has sent you a new message'.'</h2>
									<br><br><i>'.$message.'</i><br><br>
									You can find this message in your CMS.
									
								</div>
							</body>
						</html>';
					$headers = "MIME-Version: 1.0 \r\n";
						$headers .= "Content-type:text/html;charset=UTF-8 \r\n";
						$headers .= "From:noreply@vicit.world\r\n" .
						"Reply-To: noreply@vicit.world\r\n" .
						"X-Mailer: PHP/" . phpversion();
					mail($email, $subject, $txt, $headers);

				}

				$_SESSION['message'] ='Thank you for applying for a puppy. We will contact you shortly';
			}else{
				$_SESSION['message'] ='An error has occurred with sending you message. Please try again!'.mysqli_error($con);
			}
		}

?>

