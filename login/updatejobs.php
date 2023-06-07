<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php 
include 'functions.php';
include 'config.php';


$target = "jobs/"; 
/*
$target = $target . basename( $_FILES['photo1']['name']); 
$random_digit=rand(000000,999999);*/


$id=$_GET["id"];
$nazivT=mysqli_real_escape_string($con,$_POST["naziv"]);
$lokacijaT=mysqli_real_escape_string($con,$_POST["lokacija"]);
$opisT=$_POST["opis"];
$kvalifikacijeT=$_POST["kvalifikacije"];

$grupaT='Jobs';


 
 
 
 
 
$nazivT=str_replace("'", '`', $nazivT);
$lokacijaT=str_replace("'", '`', $lokacijaT);
$opisT=str_replace("'", '`', $opisT);
$kvalifikacijeT=str_replace("'", '`', $kvalifikacijeT);
 
/*
$slikax=$_REQUEST["photo1"];
$slikax=($_FILES['photo1']['name']); 
if($slikax!=""){$slika=$random_digit.$slikax;}
$target = "jobs/".$slika; */


$sql="SELECT * FROM jobs WHERE naziv='$nazivT' and id != $id";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
if($count>0){
	$_SESSION['msg2'] = 'You can\'t change title of this jobs to '.$nazivT.' because it is already title to another jobs you uploaded!';
}else{
	$akcija = mysqli_query($con,"UPDATE `jobs` set naziv='$nazivT', lokacija='$lokacijaT', opis='$opisT', kvalifikacije='$kvalifikacijeT' where id='$id'");
	if($akcija == true){		
		if($slikax!=""){
			mysqli_query($con,"UPDATE `jobs` set foto='$slika' where id='$id'");
			$types = array('image/jpeg','image/jpg', 'image/gif', 'image/png', 'application/pdf');
			if (in_array($_FILES['photo1']['type'], $types)) {
				move_uploaded_file($_FILES['photo1']['tmp_name'], $target); 
				
				//compresuj i upload sliku 
			
				$upload = $_FILES['photo1']['tmp_name']; 
				$target2 = "jobs/".$slika; 
				$degrees = orientationImage($upload);
				compress_image($upload,$target2,50);
				$target = $target2;
				if($degrees != 0){
					rotateImage($target2,$degrees);
				}
				
				
			}
		}
		$user=$_SESSION['myusername'];
		$date=date("Y-m-d h:i:sa");
		$function="Edited jobs: ".$nazivT;
		$userLog=$date.", ".$user.", ".$function."\n";				
		$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
		fwrite($myfile, $userLog);			
		$today = date('Y-m-d');
		mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Edited jobs: ".$nazivT."','".$today."')");
		$_SESSION['msg'] = 'jobs updated';		
	}
	else{
		echo("Error description: " . mysqli_error($con));
		$_SESSION['msg2'] = mysqli_error($con);
		$user=$_SESSION['myusername'];
		$date=date("Y-m-d h:i:sa");
		$function="Error editing jobs ".$nazivT.": " . mysqli_error($con);
		$userLog=$date.", ".$user.", ".$function."\n";				
		$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
		fwrite($myfile, $userLog);
	}
	
	
}
?>

