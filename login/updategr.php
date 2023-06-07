<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php 
include 'config.php';

 

$id=$_GET["id"];
$naziv=mysqli_real_escape_string($con,$_POST["naziv"]); 
$naziv = str_replace("\\", '', $naziv);
$naziv = str_replace("'","\'", $naziv);

if(!empty($_POST["urlcontent"])){
	$url = $_POST["urlcontent"];
}else{
	$url=mysqli_real_escape_string($con,$_POST["url"]);
	$url = str_replace("\\", '', $url);
	$url = str_replace("'","\'", $url);	
}

$sql="SELECT * FROM grupe WHERE naziv='$naziv' and id != $id";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
if($count != 0){
	$_SESSION['msg2'] = 'You can\'t change title to '.$naziv.' because it is already title to another content!';
}else{
	$akcija = mysqli_query($con,"UPDATE `grupe` set naziv='$naziv', url='$url' where id='$id'");
	if($akcija == true){
		$today = date('Y-m-d');
		mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Edited menu item: ".$naziv."','".$today."')");
		$user1=$_SESSION['myusername'];
		$date=date("Y-m-d h:i:sa");
		$function="Edited menu item: ".$naziv;
		$userLog=$date.", ".$user1.", ".$function."\n";				
		$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
		fwrite($myfile, $userLog);
		$_SESSION['msg'] = 'Menu item updated';
	}else{
		$user1=$_SESSION['myusername'];
		$date=date("Y-m-d h:i:sa");
		$function="Error updating menu item: ".$naziv.": " . mysqli_error($con);
		$userLog=$date.", ".$user1.", ".$function."\n";				
		$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
		fwrite($myfile, $userLog);
		$_SESSION['msg2'] = $function;
	}
	
}
 
?>

