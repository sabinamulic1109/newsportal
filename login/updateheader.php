<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php 
include 'config.php';
include 'replace.php';

$sql="SELECT * from galerija where naziv = 'Header'";
$result=mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)){	
	$idgal=$row["id"];
}

$target = "galerija/"; 

if(isset($_FILES['photo1']['name'])){
	$random_digit=rand(000000,999999);
	$target = "galerija/"; 
	$target = $target . basename( $_FILES['photo2']['name']); 
	$slikax=($_FILES['photo1']['name']); 
	$ime = $_FILES['photo1']['name'];
	$slika=$random_digit.$slikax;
	$target = "galerija/".$slika;
}else{
	$slikax="";
}

$sql = "SELECT s.* FROM slike s INNER JOIN galerija g on s.galerija = g.id WHERE g.naziv = 'Header'"; 
$result = mysqli_query ($con,$sql); 
$count=mysqli_num_rows($result);

if($count == 0){
	$akcija = mysqli_query($con,"INSERT INTO slike VALUES (0,'".$idgal."','".$slika."','Header image')");
	if($akcija == true){
		$types = array('image/jpeg','image/jpg', 'image/gif', 'image/png', 'application/pdf');
		if (in_array($_FILES['photo1']['type'], $types)) {
			move_uploaded_file($_FILES['photo1']['tmp_name'], $target);
			$today = date('Y-m-d');
			mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Added header image','".$today."')") ;
			$_SESSION['msg']='Header image is added!';
			$user=$_SESSION['myusername'];
			$date=date("Y-m-d h:i:sa");
			$function="Added header image";
			$userLog=$date.", ".$user.", ".$function."\n";				
			$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
			fwrite($myfile, $userLog);
		}
	}else{
		$_SESSION['msg2']='Error adding picture!';
	}
}else{
	$akcija = mysqli_query($con,"UPDATE slike SET foto='$slika' WHERE galerija='$idgal'");
	
	if($akcija == true){
		$types = array('image/jpeg','image/jpg', 'image/gif', 'image/png', 'application/pdf');
		if (in_array($_FILES['photo1']['type'], $types)) {
			move_uploaded_file($_FILES['photo1']['tmp_name'], $target);
			$today = date('Y-m-d');
			mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Edited header image','".$today."')") ;

			$user=$_SESSION['myusername'];
			$date=date("Y-m-d h:i:sa");
			$function="Edited header image";
			$userLog=$date.", ".$user.", ".$function."\n";	
			$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
			fwrite($myfile, $userLog);
		}
	}else{
		$_SESSION['msg2']='Error editing header image';
	}
	
	
	
	
}