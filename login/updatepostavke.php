<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php 
include 'config.php';
include 'replace.php';

 
$naslov=$_POST["naslov"];
$naslov = replace($naslov);

$opis=$_POST["opis"];
$opis = replace($opis);

$kljucne=$_POST["kljucne"];
$kljucne = replace($kljucne);

$adresa=$_POST["adresa"];
$adresa = replace($adresa);

$grad=$_POST["grad"];
$grad = replace($grad);

$zemlja=$_POST["zemlja"];
$zemlja = replace($zemlja);

$telefon=$_POST["telefon"];
$telefon = replace($telefon);

$telefon2=$_POST["telefon2"];
$telefon2 = replace($telefon2);

$email=$_POST["email"];
$email = replace($email);

$domena=$_POST["domena"];
$domena = replace($domena);

$akcija = mysqli_query($con,"UPDATE `postavke` set naslov='$naslov', opis='$opis', kljucne='$kljucne', adresa='$adresa', grad='$grad', zemlja='$zemlja', telefon='$telefon', telefon2='$telefon2', email='$email', domena='$domena'");

if($akcija == true){
	$today = date('Y-m-d');
	mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Changed settings','".$today."')");
	$user1=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Changed settings";
	$userLog=$date.", ".$user1.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
	$_SESSION['msg'] = 'Your changes are saved';
	$msg='<div class="alert alert-success">
	  <strong>'.$_SESSION['msg'].'</strong>
	</div>'; 
}else{
	$user1=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Error changing settings: " . mysqli_error($con);
	$userLog=$date.", ".$user1.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
	$_SESSION['msg2'] = $function;
	$msg='<div class="alert alert-warning">
	  <strong>'.$_SESSION['msg2'].'</strong>
	</div>'; 
}




?>

