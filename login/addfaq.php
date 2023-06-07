<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php 
include 'config.php';
include 'replace.php';

$pitanje= mysqli_real_escape_string($con,$_POST["question"]);
$odgovor= mysqli_real_escape_string($con,$_POST["answer"]);
$pitanje = replace($pitanje);
$odgovor = replace($odgovor);

$sql="SELECT * FROM tblfaq WHERE question='$pitanje'";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);

if($count>0){
	$_SESSION['msg2'] ='This question is already in database!';
}else{
	$akcija = mysqli_query($con,"INSERT INTO `tblfaq`(`question`, `answer`, `approved`) VALUES ('$pitanje','$odgovor',1)");
	if($akcija == true){
		$today = date('Y-m-d');
		mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Added new faq ".$pitanje."','".$today."')") ;
		$user=$_SESSION['myusername'];
		$date=date("Y-m-d h:i:sa");
		$function="Added new faq ".$pitanje;
		$userLog=$date.", ".$user.", ".$function."\n";				
		$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
		fwrite($myfile, $userLog);
		$_SESSION['msg'] ='Progress saved';
	}else{
		$_SESSION['msg2'] ='An error has occurred with saving: '.mysqli_error($con);
		$user=$_SESSION['myusername'];
		$date=date("Y-m-d h:i:sa");
		$function="Error description: " . mysqli_error($con);
		$userLog=$date.", ".$user.", ".$function."\n";				
		$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
		fwrite($myfile, $userLog);
	}
}


?>
