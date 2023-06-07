<?php 
session_start(); 
$url = "oglasDodan.php";
header('Location: '.$url);
include 'functions.php';
include 'config.php';
include 'replace.php';
include 'twittershare.php';
include 'facebookshare.php';

if(!empty($_POST["naslov"])){
	$target = "oglasi/"; 
	$target = $target . basename( $_FILES['photo1']['name']); 
	$random_digit=rand(000000,999999);

	$naslov=$_POST["naslov"];
	$grupa='Oglasi';
	$link=$_POST["link"]; 
	//$tekst=$_POST["tekst"];
	//$zanr = $_POST["zanr"];
	$datum=date("Y-m-d");
	$position = $_POST["position"];
	 
	$slikax=($_FILES['photo1']['name']); 
	if($slikax!=""){
		$slika=$random_digit.$slikax;
		/* $slika=$slikax; */
	}
	$target = "oglasi/".$slika; 


	$naslov = replace($naslov);	
	$link = replace($link);
	//$tekst = replace($tekst);
	//$tekst = str_ireplace('files/', 'login/files/',$tekst);  
	
	$sql="SELECT * FROM oglasi WHERE naslov='$naslov'";
	$result=mysqli_query($con,$sql);
	$count=mysqli_num_rows($result);

	if($count>0){
		$_SESSION['msg2']='You already have oglasi with this title!Please choose different title!';
	}else{
		$author = $_SESSION['myusername'];
		if(isset($_POST['position'])){
			$position = 1;
		}else{
			$position = 0;
		}
		$akcija = mysqli_query($con,"INSERT INTO `oglasi` VALUES (0,'".$naslov."','Oglasi','".$slika."','".$link."','".$datum."','".$author."',0,0,'".$position."')") ; 

        if($akcija == true){
$notf = "INSERT INTO notifikacije(comment_subject, comment_text)VALUES ('Novi post id: ', '".$id."')";

mysqli_query($conn, $notf);}
if($notf==true){


            
            			
		
			$types = array('image/jpeg','image/jpg', 'image/gif', 'image/png', 'application/pdf');
			if (in_array($_FILES['photo1']['type'], $types)) {
				/* move_uploaded_file($_FILES['photo1']['tmp_name'], $target); */
				
				$upload = $_FILES['photo1']['tmp_name']; 
				$target2 = "oglasi/".$slika; 
				$degrees = orientationImage($upload);
				compress_image($upload,$target2,50);
				$target = $target2;
				if($degrees != 0){
					rotateImage($target2,$degrees);
				}
				
			}	

			$today = date('Y-m-d');
			mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Added new oglasi ".$naslov."','".$today."')") ;	
			$user=$_SESSION['myusername'];
			$date=date("Y-m-d h:i:sa");
			$function="Added new oglasi ".$naslov;
			$userLog=$date.", ".$user.", ".$function."\n";				
			$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
			fwrite($myfile, $userLog);
			$_SESSION['publish'] = true;
			$sql = "SELECT * from oglasi order by id DESC limit 1"; 
			$result = mysqli_query ($con,$sql); 
			$row = mysqli_fetch_array($result);
			$oglasiid = $row['id'];
			$oglasilink = $domenaXV.'/oglas.php?id='.$oglasiid;
			$imagelink = $domenaXV."/login/".$target2; 
			
			/* Ovdje unijeti link do galerije na stranici */
			$_SESSION['oglasiid'] = $oglasiid;
			$_SESSION['target'] = $oglasilink;
			$_SESSION['imagelink'] = $imagelink;
			$_SESSION['title'] = $naslov;
			
			if(isset($_SESSION['fb_access_token'])){
				$vicituserid = $_SESSION['id'];
				$token = $_SESSION['fb_access_token'];
				if(!empty($token) || $token != ''){
					$sql = "SELECT * from tblfacebookloginaccess where vicituserid = $vicituserid"; 
					$result = mysqli_query ($con,$sql); 
					$row = mysqli_fetch_array($result);
					if($row['shareoglasi'] == 1){
						postoglasToFacebook($naslov, $oglasilink);	
					}
				}
			}
			
			if(isset($_SESSION['oauth_token'])){
				$tokentw = $_SESSION['oauth_token'];
				if(!empty($tokentw) || $tokentw != ''){
					$sql = "SELECT * from tbltwitterloginaccess where id = 1"; 
					$result = mysqli_query ($con,$sql); 
					$row = mysqli_fetch_array($result);
					if($row['shareoglasi'] == 1){
						postoglasToTwitter($naslov, $oglasilink);
					}
				}	
			}	

			$_SESSION['msg']='Your oglas is added!';
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
