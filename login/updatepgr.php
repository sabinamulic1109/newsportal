<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php 
include 'config.php';

$id=$_GET["id"];
$grupa=$_GET["grupa"];
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

$sql = "SELECT * from grupe where id=$grupa"; 
$result = mysqli_query ($con,$sql); 
$row = mysqli_fetch_array($result);
$grupaime=$row["naziv"];	

$sql="SELECT * FROM podgrupe WHERE naziv='$naziv' and grupa = $grupa and id !=$id";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
if($count > 0){
	$_SESSION['msg2'] = 'You can\'t change title of this submenu item to '.$naziv.' because it is already title to another submenu item in this menu!';
}else{
	$akcija = mysqli_query($con,"UPDATE `podgrupe` set naziv='$naziv', url='$url' where id='$id'");
	
	if($akcija == true){
		$today = date('Y-m-d');
		mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Edited submenu item: ".$naziv." in menu ".$grupaime."','".$today."')");
		$user1=$_SESSION['myusername'];
		$date=date("Y-m-d h:i:sa");
		$function="Edited submenu item: ".$naziv." in menu ".$grupaime;
		$userLog=$date.", ".$user1.", ".$function."\n";				
		$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
		fwrite($myfile, $userLog);
		$_SESSION['msg'] = 'Menu item updated';
	}else{
		$user1=$_SESSION['myusername'];
		$date=date("Y-m-d h:i:sa");
		$function="Error editing submenu item: ".$naziv.": " . mysqli_error($con);
		$userLog=$date.", ".$user1.", ".$function."\n";				
		$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
		fwrite($myfile, $userLog);
		$_SESSION['msg2'] = $function;
	}
}
?>

