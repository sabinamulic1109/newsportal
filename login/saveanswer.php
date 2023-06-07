<?php 
session_start(); 
include 'config.php';
include 'replace.php';
$id = $_POST["idfaq"];
$odgovor= $_POST["answeredit"];
$odgovor = replace($odgovor);
$today = date('Y-m-d');

$sql="SELECT * FROM tblfaq WHERE id='$id'";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
while($row = mysqli_fetch_array($result)){	
	$naslovT=$row["question"];
}
if($count > 0){
	$akcija = mysqli_query($con,"UPDATE `tblfaq` SET answer = '$odgovor' WHERE id=$id");
	if($akcija == true){
		mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Added answer to question: ".$naslovT."','".$today."')");
		$user=$_SESSION['myusername'];
		$date=date("Y-m-d h:i:sa");
		$function="Added answer to question: ".$naslovT;
		$userLog=$date.", ".$user.", ".$function."\n";				
		$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
		fwrite($myfile, $userLog);
		$vrati = array("state"=> 'true');	
		echo json_encode($vrati);
	}else{
		$user=$_SESSION['myusername'];
		$date=date("Y-m-d h:i:sa");
		$function="Error saving answer to question: ".$naslovT."! - ".mysqli_error($con);
		$userLog=$date.", ".$user.", ".$function."\n";				
		$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
		fwrite($myfile, $userLog);
		$vrati = array("state"=> mysqli_error($con));	
		echo json_encode($vrati);
	}
}else{
	$vrati = array("state"=> 'false');	
	echo json_encode($vrati);
}



 

?>
