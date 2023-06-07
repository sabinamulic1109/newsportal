<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php 
include 'config.php';
include 'replace.php';

if(!empty($_POST["naslov"])){
	$naslov=mysqli_real_escape_string($con,$_POST["naslov"]);
	$url=mysqli_real_escape_string($con,$_POST["url"]);
	$urlcontent=mysqli_real_escape_string($con,$_POST["urlmenu"]);
	
	$naslov = replace($naslov);
	$url = replace($url);
	$urlcontent = replace($urlcontent);
	$pozicija = "H";

	
	$sql="SELECT * FROM grupe WHERE naziv='$naslov'";
	$result=mysqli_query($con,$sql);
	$count=mysqli_num_rows($result);
	
	
	if($count == 0){
		if(!empty($url) || !empty($urlcontent)){
			if(!empty($url) && !empty($urlcontent)){
				$msg='<div class="alert alert-warning">
					<strong>You can\'t input url and choose it from content. You can use just one way!</strong>
					</div>';
			}elseif(!empty($url)){						
				$akcija = mysqli_query($con,"INSERT INTO `grupe` VALUES (0,'".$naslov."','".$url."','".$pozicija."')");
				if($akcija == true){
					$today = date('Y-m-d ');
					mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Added new menu item ".$naslov."','".$today."')") ;
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
			}else{
				$akcija = mysqli_query($con,"INSERT INTO `grupe` VALUES (0,'".$naslov."','".$urlcontent."','".$pozicija."')") ; 
				if($akcija == true){
					$today = date('Y-m-d');
					mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Added new menu item ".$naslov."','".$today."')") ;
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
		}else{
			$_SESSION['msg2']='You have to input url or choose it from content!';
		}				
	}else{
		$_SESSION['msg2']='You already have menu item with this name!';
	}
}