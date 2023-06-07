<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php 
include 'config.php';
include 'replace.php';

$target = "slider/"; 
$target = $target . basename( $_FILES['photo1']['name']); 
$random_digit=rand(000000,999999);

$id=$_GET["id"];
$naslovS=$_POST["naslov"];
$podnaslovS=$_POST["podnaslov"]; 
$url=$_POST["url"]; 

$naslovS=replace($naslovS);
$podnaslovS=replace($podnaslovS);



$slikax=$_REQUEST["photo1"];
$slikax=($_FILES['photo1']['name']); 
if($slikax!=""){$slika=$random_digit.$slikax;}
$target = "slider/".$slika;

 
$sql="SELECT * FROM slider WHERE naslov='$naslovS' and id != $id";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
if($count>0){
	$_SESSION['msg'] = 'You can\'t change title to '.$naslovS.' because it is already title to another slider!';
}else{
	$sql = "UPDATE `slider` set naslov='$naslovS', podnaslov='$podnaslovS', url='$url' where id='$id'";
	$akcija =  mysqli_query($con,$sql);	
	if($akcija == true){
		if($slikax!=""){
			mysqli_query($con,"UPDATE `slider` set file='$slika' where id='$id'");
			$types = array('image/jpeg','image/jpg', 'image/gif', 'image/png', 'application/pdf');
			if (in_array($_FILES['photo1']['type'], $types)) {
				move_uploaded_file($_FILES['photo1']['tmp_name'], $target);
			}
		}
		$today = date('Y-m-d');
		mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Edited slide: ".$naslovS."','".$today."')");
		$user1=$_SESSION['myusername'];
		$date=date("Y-m-d h:i:sa");
		$function="Edited slide: ".$naslovS;
		$userLog=$date.", ".$user1.", ".$function."\n";				
		$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
		fwrite($myfile, $userLog);
		$_SESSION['msg'] = 'Slide updated';
	}else{
		$user1=$_SESSION['myusername'];
		$date=date("Y-m-d h:i:sa");
		$function="Error editing slide".$naslovS.": " . mysqli_error($con);
		$userLog=$date.", ".$user1.", ".$function."\n";				
		$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
		fwrite($myfile, $userLog);
		$_SESSION['msg2'] = $function;
	}
}
?>

