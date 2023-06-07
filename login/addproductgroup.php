<?php 
ini_set('memory_limit','-1');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start(); 

header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php 
include 'functions.php';
include 'config.php';
include 'replace.php';

if(!empty($_POST["name"])){

	

	$name=$_POST["name"];




	$name = replace($name);	


	
	$sql="SELECT * FROM shop_group WHERE naziv='$name'" ;
	$result=mysqli_query($con,$sql);
	$count=mysqli_num_rows($result);

	if($count>0){
		$_SESSION['msg2']='You already have shop group with this name!Please choose different name!';
	}else{
		$author = $_SESSION['myusername'];
		$akcija = mysqli_query($con,"INSERT INTO `shop_group` VALUES (0,'".$name."')") ; 
		if($akcija == true){
			
			$today = date('Y-m-d');
			mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Added new shop group ".$name."','".$today."')") ;	
			$user=$_SESSION['myusername'];
			$date=date("Y-m-d h:i:sa");
			$function="Added new shop group ".$name;
			$userLog=$date.", ".$user.", ".$function."\n";				
			$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
			fwrite($myfile, $userLog);
			$_SESSION['publish'] = true;
			$sql = "SELECT * from novosti order by id DESC limit 1"; 
			$result = mysqli_query ($con,$sql); 
			$row = mysqli_fetch_array($result);
			
			
			$_SESSION['msg']='Your shop group is added!';
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

}


?>
