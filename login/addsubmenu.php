<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php 
include 'config.php';
include 'replace.php';

if(!empty($_POST["naslov"])){
	$grupa=$_GET["id"]; 
	$naslov=mysqli_real_escape_string($con,$_POST["naslov"]);
	$url=mysqli_real_escape_string($con,$_POST["url"]);
	$urlcontent=mysqli_real_escape_string($con,$_POST["urlcontent"]);
	$naslov = replace($naslov);
	$url = replace($url);
	$urlcontent = replace($urlcontent);

	$sql="SELECT * FROM podgrupe WHERE naziv='$naslov' and grupa = $grupa";
	$result=mysqli_query($con,$sql);
	$count=mysqli_num_rows($result);	
	if($count == 0){
		$sql = "SELECT * from grupe where id=$grupa"; 
		$result = mysqli_query ($con,$sql); 
		$row = mysqli_fetch_array($result);
		$grupaime=$row["naziv"];			
		if(!empty($url) || !empty($urlcontent)){
				if(!empty($url) && !empty($urlcontent)){
					$_SESSION['msg2']='You can\'t input url and choose it from content. You can use just one way!';
				}elseif(!empty($url)){
					$akcija = mysqli_query($con,"INSERT INTO `podgrupe` VALUES (0,'".$grupa."','".$naslov."','".$url."')") ;
					if($akcija == true){
						$today = date('Y-m-d');
						mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Added new submenu item ".$naslov." to menu ".$grupaime."','".$today."')") ;
						$user=$_SESSION['myusername'];
						$date=date("Y-m-d h:i:sa");
						$function="Added new submenu item ".$naslov." to menu ".$grupaime;
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
				}else{
					$akcija = mysqli_query($con,"INSERT INTO `podgrupe` VALUES (0,'".$grupa."','".$naslov."','".$urlcontent."')") ;
					if($akcija == true){
						$today = date('Y-m-d');
						mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Added new submenu item ".$naslov." to menu ".$grupaime."','".$today."')") ;
						$user=$_SESSION['myusername'];
						$date=date("Y-m-d h:i:sa");
						$function="Added new submenu item ".$naslov." to menu ".$grupaime;
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
			}else{
				$_SESSION['msg2']='You have to input url or choose it from content!';
			} 
	}else{
		$_SESSION['msg2']='You already have item with this name in this submenu!';
	}
}

