<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php 
include 'config.php';
include 'replace.php';

if(!empty($_POST["naslov"])){
	$naslov=$_POST["naslov"];
	$naslov = replace($naslov);
	$podnaslov="";
	$opis="";
	$foto="";
	$pozicija="";
	$sql="SELECT * FROM tekst WHERE naslov='$naslov'";
	$result=mysqli_query($con,$sql);
	$count=mysqli_num_rows($result);
	if($count == 0){
		$_SESSION['msg']='DONE!'; 
		mysqli_query($con,"INSERT INTO `tekst` VALUES (0,'".$naslov."','".$podnaslov."','".$opis."','".$foto."','".$pozicija."',0)"); 
		$today = date('Y-m-d');
		mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Added new content: ".$naslov."','".$today."')");
		$user=$_SESSION['myusername'];
		$date=date("m.d.Y h:i:sa");
		$function="Added new content ".$naslov;
		$userLog=$date.", ".$user.", ".$function."\n";				
		$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
		fwrite($myfile, $userLog);
	}else{
		$_SESSION['msg2']='Content with this title already exists.'; 
	}

}



?>
