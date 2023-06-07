<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
/* echo 'Current PHP version: ' . phpversion(); */
?>
<?php 
include 'config.php';
include 'functions.php';

$target = "testimonials/"; 
$target = $target . basename( $_FILES['photo1']['name']); 
$random_digit=rand(000000,999999);

$firstname= mysqli_real_escape_string($con,$_POST["firstname"]);
$lastname= mysqli_real_escape_string($con,$_POST["lastname"]);
$email= mysqli_real_escape_string($con,$_POST["email"]);
$testimonial= mysqli_real_escape_string($con,$_POST["tekst"]);
$today = date('d.m.Y');

$testimonial = str_replace("\\", '', $testimonial);
$testimonial = str_ireplace("'","\'", $testimonial);
$testimonial = str_ireplace("or 1=1","", $testimonial);
$testimonial = str_ireplace("OR 1=1","", $testimonial);	
$testimonial = str_ireplace("or1=1","", $testimonial);	
$testimonial = str_ireplace("OR1=1","", $testimonial);	
$testimonial = str_ireplace("SELECT * FROM","", $testimonial);
$testimonial = str_ireplace("DELETE FROM","", $testimonial);


$slikax=$_REQUEST["photo1"];
$slikax=($_FILES['photo1']['name']); 
if($slikax!=""){$slika=$random_digit.$slikax;}
$target = "testimonials/".$slika; 

/* $sql="SELECT * FROM testimonials WHERE authoremail='$email'";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result); */


$akcija = mysqli_query($con,"INSERT INTO `testimonials`(`authoremail`, `authorname`, `authorlastname`, `testimonial`, `approved`, `date`) VALUES ('$email','$firstname','$lastname','$testimonial',1,'$today')");

if($akcija == true){
	$id = mysqli_insert_id($con);
	if($slikax!=""){
		mysqli_query($con,"UPDATE `testimonials` set picture='$target' where id='$id'");
		$types = array('image/jpeg','image/jpg', 'image/gif', 'image/png', 'application/pdf');
		if (in_array($_FILES['photo1']['type'], $types)) {
			/* move_uploaded_file($_FILES['photo1']['tmp_name'], $target); */
			
			$upload = $_FILES['photo1']['tmp_name']; 
			$target2 = "testimonials/".$slika; 
			$degrees = orientationImage($upload);
			compress_image($upload,$target2,50);
			$target = $target2;
			if($degrees != 0){
				rotateImage($target2,$degrees);
			}
		}
	}
	$_SESSION['msg'] ='Testimonial is saved!';
}else{
	$_SESSION['msg2'] ='An error has occurred with saving testimonial: '.mysqli_error($con);
}

?>
