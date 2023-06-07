<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php 
include 'config.php';
include 'replace.php';

if(!empty($_POST["naslov"])){
	$target = "news/"; 
	$target = $target . basename( $_FILES['photo1']['name']); 
	$random_digit=rand(000000,999999);

	$naslov=$_POST["naslov"];
	$datum=date("Y-m-d");  
	 
	$slikax=$_REQUEST["photo1"];
	$slikax=($_FILES['photo1']['name']); 
	if($slikax!=""){$slika=$random_digit.$slikax;}
	$target = "files/".$slika; 
	$target2 = "files/".$slika;

	$naslov = replace($naslov);	

	
	$sql="SELECT * FROM dokumenti WHERE naslov='$naslov'";
	$result=mysqli_query($con,$sql);
	$count=mysqli_num_rows($result);

	if($count>0){
		$_SESSION['msg2']='You already have news with this title!Please choose different title!';
	}else{
		$author = $_SESSION['myusername'];
		$akcija = mysqli_query($con,"INSERT INTO `dokumenti` VALUES (0,'".$naslov."','".$target2."')") ; 
		if($akcija == true){
			$types = array('image/jpeg','image/jpg', 'image/gif', 'image/png', 'application/pdf');
			if (in_array($_FILES['photo1']['type'], $types)) {
				move_uploaded_file($_FILES['photo1']['tmp_name'], $target);
			}	
			$today = date('Y-m-d');
			mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Added new file ".$naslov."','".$today."')") ;	
			$user=$_SESSION['myusername'];
			$date=date("Y-m-d h:i:sa");
			$function="Added new file ".$naslov;
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

}


?>
