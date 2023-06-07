<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php 
include 'config.php';
include 'functions.php';
include 'replace.php';
$target = "images/"; 
$target = $target . basename( $_FILES['photo1']['name']); 
$random_digit=rand(000000,999999);
$id=$_GET["id"];
$naslovT= mysqli_real_escape_string($con,$_POST["naslov"]);
$podnaslovT= mysqli_real_escape_string($con,$_POST["podnaslov"]);
$tekstT=$_POST["tekst"];
$naslovT=replace($naslovT);
$podnaslovT=replace($podnaslovT);
$tekstT=replace($tekstT); 
$tekstT = str_ireplace('files/', 'login/files/',$tekstT);  
$slikax=$_REQUEST["photo1"];
$slikax=($_FILES['photo1']['name']); 
if($slikax!=""){$slika=$random_digit.$slikax;}
$target = "images/".$slika; 
$sql="SELECT * FROM tekst WHERE naslov='$naslovT' and id != $id";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
if($count>0){
	$_SESSION['msg2'] = 'You can\'t change title to '.$naslovT.' because it is already title to another content!';
} else{
	$akcija = mysqli_query($con,"UPDATE `tekst` set naslov='$naslovT', podnaslov='$podnaslovT', opis='$tekstT' where id='$id'");
	echo "UPDATE `tekst` set naslov='$naslovT', podnaslov='$podnaslovT', opis='$tekstT' where id='$id'";
	if($akcija == true){
		if($slikax!=""){mysqli_query($con,"UPDATE `tekst` set foto='$slika' where id='$id'");
		$types = array('image/jpeg','image/jpg', 'image/gif', 'image/png', 'application/pdf');
			if (in_array($_FILES['photo1']['type'], $types)) {
				
				/* move_uploaded_file($_FILES['photo1']['tmp_name'], $target); */
			
				/* compresuj i upload sliku */
				
				$upload = $_FILES['photo1']['tmp_name']; 
				$target2 = "images/".$slika; 
				$degrees = orientationImage($upload);
				compress_image($upload,$target2,50);
				$target = $target2;
				if($degrees != 0){
					rotateImage($target2,$degrees);
				}
			}
		}

		$today = date('Y-m-d');
		mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Edited content: ".$naslovT."','".$today."')");
		$_SESSION['msg'] = 'Content updated';

		$user=$_SESSION['myusername'];
		$date=date("Y-m-d h:i:sa");
		$function="Edited content: ".$naslovT;
		$userLog=$date.", ".$user.", ".$function."\n";				
		$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
		fwrite($myfile, $userLog);	
	}else{
		echo("Error description: " . mysqli_error($con));
		$_SESSION['msg2'] = mysqli_error($con);
		$user=$_SESSION['myusername'];
		$date=date("Y-m-d h:i:sa");
		$function="Error description: " . mysqli_error($con);
		$userLog=$date.", ".$user.", ".$function."\n";				
		$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
		fwrite($myfile, $userLog);
	}
}
?>

