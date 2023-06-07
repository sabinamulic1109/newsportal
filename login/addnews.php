<?php 
session_start(); 
$url = "cms.php?cms=news";
header('Location: '.$url);

include 'functions.php';
include 'config.php';
include 'replace.php';
include 'twittershare.php';
include 'facebookshare.php';

if(!empty($_POST["naslov"])){
	$target = "news/"; 
	$target = $target . basename( $_FILES['photo1']['name']); 
	$random_digit=rand(000000,999999);

	$naslov=$_POST["naslov"];
	$grupa='News';
	$podnaslov=$_POST["podnaslov"]; 
	$tekst=$_POST["tekst"];
	$zanr = $_POST["zanr"];
	$datum=date("Y-m-d");  
	 
	$slikax=($_FILES['photo1']['name']); 
	if($slikax!=""){
		$slika=$random_digit.$slikax;
		/* $slika=$slikax; */
	}
	$target = "news/".$slika; 


	$naslov = replace($naslov);	
	$podnaslov = replace($podnaslov);
	$tekst = replace($tekst);
	$tekst = str_ireplace('files/', 'login/files/',$tekst);  
	
	$sql="SELECT * FROM novosti WHERE naslov='$naslov'";
	$result=mysqli_query($con,$sql);
	$count=mysqli_num_rows($result);

	if($count>0){
		$_SESSION['msg2']='You already have news with this title!Please choose different title!';
	}else{
		$author = $_SESSION['myusername'];
		$akcija = mysqli_query($con,"INSERT INTO `novosti` VALUES (0,'".$grupa."','".$naslov."','".$podnaslov."','".$tekst."','".$slika."','".$datum."','".$zanr."','".$author."',0,1)") ; 
		if($akcija == true){
			$types = array('image/jpeg','image/jpg', 'image/gif', 'image/png', 'application/pdf');
			if (in_array($_FILES['photo1']['type'], $types)) {
				/* move_uploaded_file($_FILES['photo1']['tmp_name'], $target); */
				
				$upload = $_FILES['photo1']['tmp_name']; 
				$target2 = "news/".$slika; 
				$degrees = orientationImage($upload);
				compress_image($upload,$target2,50);
				$target = $target2;
				if($degrees != 0){
					rotateImage($target2,$degrees);
				}
				
			}	
			$today = date('Y-m-d');
			mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Added new news ".$naslov."','".$today."')") ;	
			$user=$_SESSION['myusername'];
			$date=date("Y-m-d h:i:sa");
			$function="Added new news ".$naslov;
			$userLog=$date.", ".$user.", ".$function."\n";				
			$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
			fwrite($myfile, $userLog);
			$_SESSION['publish'] = true;
			$sql = "SELECT * from novosti order by id DESC limit 1"; 
			$result = mysqli_query ($con,$sql); 
			$row = mysqli_fetch_array($result);
			$newsid = $row['id'];
			$newslink = $domenaXV.'/article.php?id='.$newsid;
			$imagelink = $domenaXV."/login/".$target2; 
			
			/* Ovdje unijeti link do galerije na stranici */
			$_SESSION['newsid'] = $newsid;
			$_SESSION['target'] = $newslink;
			$_SESSION['imagelink'] = $imagelink;
			$_SESSION['title'] = $naslov;
			
			if(isset($_SESSION['fb_access_token'])){
				$vicituserid = $_SESSION['id'];
				$token = $_SESSION['fb_access_token'];
				if(!empty($token) || $token != ''){
					$sql = "SELECT * from tblfacebookloginaccess where vicituserid = $vicituserid"; 
					$result = mysqli_query ($con,$sql); 
					$row = mysqli_fetch_array($result);
					if($row['sharenews'] == 1){
						postArticleToFacebook($naslov, $newslink);	
					}
				}
			}
			
			if(isset($_SESSION['oauth_token'])){
				$tokentw = $_SESSION['oauth_token'];
				if(!empty($tokentw) || $tokentw != ''){
					$sql = "SELECT * from tbltwitterloginaccess where id = 1"; 
					$result = mysqli_query ($con,$sql); 
					$row = mysqli_fetch_array($result);
					if($row['sharenews'] == 1){
						postArticleToTwitter($naslov, $newslink);
					}
				}	
			}	

			$_SESSION['msg']='Your article is added!';
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
