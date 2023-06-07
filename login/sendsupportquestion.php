<?php 
	session_start(); 
	include 'config.php';
	include 'replace.php';
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';
	
	$message= $_POST["message"];
	$message = replace($message);

	
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

	$emailXV = $admins[0]['email'];
	

	$emailsupport = 'support@vicitdigital.com';
	$subject = "New support request from ".$naslovXV;
	$link = '<a href="'.$domenaXV.'">'.$naslovXV.'</a>';
	$txt ='<html>
		<body>
			<div style="text-align:center;">						
				<h2>Owner of website'. $naslovXV.'has a question for you:'.'</h2>
				
				<br>
				<br>
				<i>'.$message.'</i>
				<br>
				<br>
			</div>
		</body>
	</html>';

	$mail = new PHPMailer;
	$mail->isSMTP(); 
	$mail->SMTPDebug = 0; 
	$mail->Host = "tls://smtp.gmail.com:587"; 
	$mail->Port = 587; 
	$mail->SMTPSecure = 'tls';
	$mail->Priority = 3;
	$mail->SMTPAuth = true;
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
	
	$mail->From = $emailXV;
	$mail->FromName = $naslovXV;
	$mail->Sender = $emailXV;
	$mail->AddReplyTo($emailXV, $naslovXV);
	$mail->addAddress($emailsupport ,'');  
	$mail->Subject = $subject;	
	$mail->msgHTML($txt); 
	
	$mail->AltBody = 'New support question: '.$message;	
	
	if(!$mail->send()){
		$_SESSION['message'] = 'Message couldn\'t be send now. Please try later!';
		$vrati = array("state"=> 'false', "error" => $_SESSION['message']);	
		echo json_encode($vrati);
	}else{
		$subject = "We received your question ";
		$link = '<a href="https://vicitdigital.com/">Vicit Digital Agency</a>';
		$txt ='<html>
				<body>
					<style>
						.pquote {
							float: right;
							width: 80%;
							color: #030;
							font-size: 26px;
							line-height: 0.9;
							font-style: italic;
							padding: 13px;
						}

						blockquote {
							margin: 0;
						}

						.pquote p:first-letter {
							font-size: 39px;
							font-weight: bold;
						}
					</style>
					<div style="text-align:left;">						
						<p>Dear client,</p>					
						<br>
						<p>We value about your opinion. You sent us question below:</p>
						<aside class="pquote">
							<blockquote>
								<p>'.$message.'</p>
							</blockquote>
						</aside>
						<p>We received it and we will answer it as soon as posible.
						</p>
						<br>
						<br>
						<p>Yours truly,'.$link.'</p>
					</div>
				</body>
			</html>';
			
		$mail2 = new PHPMailer;
		$mail2->isSMTP(); 
		$mail2->SMTPDebug = 0; 
		$mail2->Host = "tls://smtp.gmail.com:587"; 
		$mail2->Port = 587; 
		$mail2->SMTPSecure = 'tls';
		$mail2->Priority = 3;
		$mail2->SMTPAuth = true;
		$mail2->Username = 'vicitdigitalagency@gmail.com';
		$mail2->Password = 'Vicitdigitalsupport2019!';
		$mail2->smtpConnect(
			array(
				"ssl" => array(
					"verify_peer" => false,
					"verify_peer_name" => false,
					"allow_self_signed" => true
				)
			)
		);
		
		$mail2->From = $emailsupport;
		$mail2->FromName = 'Vicit Digital Agency';
		$mail2->Sender = $emailsupport;
		$mail2->AddReplyTo($emailsupport, 'No reply');
		$mail2->addAddress($emailXV ,$naslovXV);  
		$mail2->Subject = $subject;	
		$mail2->msgHTML($txt); 
		
		$mail2->AltBody = 'We received your question: '.$message;		
		
		if(!$mail2->send()){
			$errormsg =  "Mailer Error: " . $mail->ErrorInfo;
			$vrati = array("state"=> 'false', "error" => $errormsg);	
			echo json_encode($vrati);
		}else{
			$vrati = array("state"=> 'true');	
			echo json_encode($vrati);
		}	
			
	}
	

?>
