<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php 
include 'config.php';
include 'replace.php';

$firstname= mysqli_real_escape_string($con,$_POST["firstname"]);
$email= mysqli_real_escape_string($con,$_POST["email"]);
$phone= mysqli_real_escape_string($con,$_POST["phone"]);
$message= mysqli_real_escape_string($con,$_POST["message"]);
$today = date('Y-m-d');
$authoremail = $email; 
$message = replace($message);


$akcija = mysqli_query($con,"INSERT INTO `poruke`( `isRead`, `name`, `email`, `phone`, `message`, `date`) 
	VALUES (0,'$firstname','$authoremail','$phone','$message','$today')");

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
			$headers .= "From:".$authoremail." ".$subject."\r\n" .
			"Reply-To: ".$authoremail."\r\n" .
			"X-Priority: 3 \r\n" .
			"X-Mailer: small-PHP/" . phpversion();
		mail($email, $subject, $txt, $headers);

	}
	
	

	$_SESSION['message'] ='Thank you for sending us a message. We will contact you shortly';
}else{
	$_SESSION['message'] ='An error has occurred with sending you message. Please try again!'.mysqli_error($con);
}

?>

