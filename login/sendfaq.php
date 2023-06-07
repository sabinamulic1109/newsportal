<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php 
include 'config.php';
include 'replace.php';


use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	
	include 'PHPMailer/src/Exception.php';
	include 'PHPMailer/src/PHPMailer.php';
	include 'PHPMailer/src/SMTP.php';


$pitanje= mysqli_real_escape_string($con,$_POST["question"]);
$odgovor= '';
$pitanje = replace($pitanje);
$odgovor = replace($odgovor);

$sql="SELECT * FROM tblfaq WHERE question='$pitanje'";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);

if($count>0){
	$_SESSION['message'] ='We already received this question. It will be visible shortly!';
}else{
	$akcija = mysqli_query($con,"INSERT INTO `tblfaq`(`question`,  `approved`) VALUES ('$pitanje',0)");
	if($akcija == true){
		
		$ime="DemoCMS.";
						$email=$emailXV;
						/*$email="adis@vicitdigital.com";*/
						$mail1 = new PHPMailer;
												$mail1->isSMTP(); 
												$mail1->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
												$mail1->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
												$mail1->Port = 587; // TLS only
												$mail1->SMTPSecure = 'tls'; // ssl is depracated
												$mail1->SMTPAuth = true;
												$mail1->Username = 'vicitdigitalagency@gmail.com';
												$mail1->Password = 'Vicitdigitalsupport2019!';
												$mail1->AddReplyTo('noreply@DemoCMS.com', 'No-reply address');
												$mail1->setFrom('noreply@aramediauploads.com', 'New DemoCMS Question from our Clients' );
												//$mail->AddReplyTo('sljuki@hotmail.com', 'Reply to name');
												$mail1->addAddress($email, $ime); 
												$mail1->Subject = 'New DemoCMS Question from our Clients';
												$mail1->IsHTML(true);
								
												
												$mail1->Body = "<div style='width:80%;text-align:center; margin-left:20px;'><br><br>
																
															
																<p style='color: black; font-size:16px;'>
																
																You have new question message from our website. Please check it <br><br>
																
																<b>Question:</b><br> $pitanje<br><br>
																
																
																
																<p style='color: black; font-size:16px;'>Thank you!</p>
																<p style='color: black; font-size:16px;'>Your DemoCMS.</p><br>
																<a style=' font-size:16px;'  >t: $telefonXV </a><br>
																<a style=' font-size:16px;' href='mailto:$emailXV'>e: $emailXV</a><br>
																<p style='color: black; font-size:16px;'>$adresaXV</p><br><br>
										
																	<br>
																
																<p style='color: black; font-size:14px;'>This message is confidential. It may also be privileged or otherwise protected by work product immunity or other legal rules. If you have received it by mistake, please let us know by e-mail reply and delete it from your system; you may not copy this message or disclose its contents to anyone.</p>
																</div>
																"; 
												// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

												if(!$mail1->send()){
													//$msg=6;
													//echo "Mailer Error: " . $mail->ErrorInfo;
												}else{
													//$msg=2;
													//echo "Message sent!";
												}
		
		$_SESSION['message'] ='We received your question. As soon as we answer it, it will be visible on our page.';
	}else{
		
		$_SESSION['message']="Your question could not be saved.Error description: " . mysqli_error($con);
		
	}
}


?>
