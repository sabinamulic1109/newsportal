<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php 
include 'config.php';
include 'replace.php';
$target = "testimonials/"; 
$target = $target . basename( $_FILES['photo1']['name']); 
$random_digit=rand(000000,999999);
$firstname= mysqli_real_escape_string($con,$_POST["firstname"]);
$lastname= mysqli_real_escape_string($con,$_POST["lastname"]);
$email= mysqli_real_escape_string($con,$_POST["email"]);
$testimonial= mysqli_real_escape_string($con,$_POST["tekst"]);
$today = date('Y-m-d');
$authoremail = $email; 
$testimonial = replace($testimonial);

$slikax=$_REQUEST["photo1"];
$slikax=($_FILES['photo1']['name']); 
if($slikax!=""){$slika=$random_digit.$slikax;}
$target = "testimonials/".$slika; 

/* $sql="SELECT * FROM testimonials WHERE authoremail='$email'";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result); */


$akcija = mysqli_query($con,"INSERT INTO `testimonials`(`authoremail`, `authorname`, `authorlastname`, `testimonial`, `approved`, `date`) VALUES ('$email','$firstname','$lastname','$testimonial',0,'$today')");

if($akcija == true){
	$id = mysqli_insert_id($con);
	if($slikax!=""){
		mysqli_query($con,"UPDATE `testimonials` set picture='$target' where id='$id'");
		$types = array('image/jpeg','image/jpg', 'image/gif', 'image/png', 'application/pdf');
		if (in_array($_FILES['photo1']['type'], $types)) {
			move_uploaded_file($_FILES['photo1']['tmp_name'], $target);
		}
	}
	$sql = "SELECT * from testimonials where id='$id'"; 
	$result = mysqli_query ($con,$sql); 
	$row = mysqli_fetch_array($result);
	$picture = $row['picture'];
	if(!empty($picture)){
		$ispisslika='<img src="'.$domenaXV.$picture.'" >';
	}else{
		$ispisslika='';
	}
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
	var_dump($admins);
	foreach($admins as $admin){
		$email = $admin['email'];
		$subject = "You have a new testimonial, please approve it";
		$txt ='<html>
				<body>
					<div style="text-align:center;">						
						<h2>'. $firstname.' '.$lastname.' has left you a new testimonial:'.'</h2>
						' .$ispisslika. '
						<br><br><i>'.$testimonial.'</i><br><br>
						Please log into your CMS and approve it, so it could be visible in your testimonials page.
						
					</div>
				</body>
			</html>';
		$headers = "MIME-Version: 1.0 \r\n";
			$headers .= "Content-type:text/html;charset=UTF-8 \r\n";
			$headers .= "From:noreply@vicit.world\r\n" .
			"Reply-To: noreply@vicit.world\r\n" .
			"X-Mailer: PHP/" . phpversion();
		mail($email, $subject, $txt, $headers);
		
		echo $txt;
	}

	$_SESSION['message'] ='Thanks for submitting a testimonial about our beautiful dogs. Your comment and photo are under moderation and should appear shortly!';
}else{
	$_SESSION['message'] ='An error has occurred with saving your testimonial. Please try again!'.mysqli_error($con);
}

?>

