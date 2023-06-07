<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php 
include 'config.php';
include 'replace.php';

if(!empty($_POST["naslov"])){
	$naslov=mysqli_real_escape_string($con, $_POST["naslov"]);
	$naslov = replace($naslov);

	$sql="SELECT * FROM galerija WHERE naziv='$naslov'";
	$result=mysqli_query($con,$sql);
	$count=mysqli_num_rows($result);
	if($count > 0){
		$msg='<div class="alert alert-warning">
			<strong>You already have gallery with that name!</strong>
			</div>';
	}else{			
		$akcija = mysqli_query($con,"INSERT INTO `galerija` VALUES (0,'".$naslov."')"); 
		if($akcija == true){
			$today = date('Y-m-d');
			mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Added new gallery ".$naslov."','".$today."')") ;
			$user=$_SESSION['myusername'];
			$date=date("Y-m-d h:i:sa");
			$function="Added new gallery ".$naslov;
			$userLog=$date.", ".$user.", ".$function."\n";				
			$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
			fwrite($myfile, $userLog);
			$_SESSION['msg']='DONE!'; 
		}else{
			$user=$_SESSION['myusername'];
			$date=date("Y-m-d h:i:sa");
			$function="Error description: " . mysqli_error($con);
			$userLog=$date.", ".$user.", ".$function."\n";				
			$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
			fwrite($myfile, $userLog);
			$_SESSION['msg2']=mysqli_error($con); 
		}
		
	}	
	echo $msg;
}