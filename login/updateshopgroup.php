<?php 
session_start(); 
/*ini_set('memory_limit','-1');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);*/
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php 
include 'functions.php';
include 'config.php';
include 'replace.php';




	$id=$_GET["id"];
	$name=$_POST["name"];




 
 
	$name = replace($name);	



$sql="SELECT * FROM shop_group WHERE name='$name' and id != $id" ;
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
if($count>0){
	$_SESSION['msg2'] = 'You can\'t change title of this product group to '.$name.' because it is already title to another product group you uploaded!';
}else{
	$akcija = mysqli_query($con,"UPDATE `shop_group` set naziv='$name' where id='$id'");
	if($akcija == true){		

		
		$user=$_SESSION['myusername'];
		$date=date("Y-m-d h:i:sa");
		$function="Edited product group: ".$name;
		$userLog=$date.", ".$user.", ".$function."\n";				
		$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
		fwrite($myfile, $userLog);			
		$today = date('Y-m-d');
		mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Edited product group: ".$name."','".$today."')");
		$_SESSION['msg'] = 'Product group updated';		
	}else{
		echo("Error description: " . mysqli_error($con));
		$_SESSION['msg2'] = mysqli_error($con);
		$user=$_SESSION['myusername'];
		$date=date("Y-m-d h:i:sa");
		$function="Error editing product group ".$name.": " . mysqli_error($con);
		$userLog=$date.", ".$user.", ".$function."\n";				
		$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
		fwrite($myfile, $userLog);
	}
	
	
}
?>

