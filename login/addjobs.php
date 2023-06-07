<?php 
session_start(); 
$url = "cms.php?cms=jobs";
header('Location: '.$url);

include 'functions.php';
include 'config.php';
include 'replace.php';
include 'twittershare.php';
include 'facebookshare.php';

if(!empty($_POST["naziv"])){
	$target = "jobs/"; 
	$target = $target . basename( $_FILES['photo1']['name']); 
	$random_digit=rand(000000,999999);

	$naziv=$_POST["naziv"];
	$grupa='Jobs';
		
	$lokacija=$_POST["lokacija"]; 

	$kvalifikacije=$_POST["kvalifikacije"]; 
	$opis=$_POST["opis"]; 
	$datum=date("Y-m-d");  
	 
	$slikax=($_FILES['photo1']['name']); 
	if($slikax!=""){
		$slika=$random_digit.$slikax;
		/* $slika=$slikax; */
	}
	$target = "jobs/".$slika; 


	$naziv = replace($naziv);	
		
	$lokacija = replace($lokacija);	

	$kvalifikacije = replace($kvalifikacije);
	$opis = replace($opis);
	$opis = str_ireplace('files/', 'login/files/',$opis);  
	
	$sql="SELECT * FROM jobs WHERE naziv='$naziv'";
	$result=mysqli_query($con,$sql);
	$count=mysqli_num_rows($result);

	if($count>0){
		$_SESSION['msg2']='You already have jobs with this title!Please choose different title!';
	}else{
		$author = $_SESSION['myusername'];
		$akcija = mysqli_query($con,"INSERT INTO `jobs` VALUES (0,'".$grupa."','".$naziv."','".$lokacija."','".$opis."','".$kvalifikacije."','".$datum."','".$author."',0,1)") ; 
		if($akcija == true){
			$types = array('image/jpeg','image/jpg', 'image/gif', 'image/png', 'application/pdf');
			if (in_array($_FILES['photo1']['type'], $types)) {
				/* move_uploaded_file($_FILES['photo1']['tmp_name'], $target); */
				
				$upload = $_FILES['photo1']['tmp_name']; 
				$target2 = "jobs/".$slika; 
				$degrees = orientationImage($upload);
				compress_image($upload,$target2,50);
				$target = $target2;
				if($degrees != 0){
					rotateImage($target2,$degrees);
				}
				
			}	
			$today = date('Y-m-d');
			mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Added new jobs ".$naziv."','".$today."')") ;	
			$user=$_SESSION['myusername'];
			$date=date("Y-m-d h:i:sa");
			$function="Added new jobs ".$naziv;
			$userLog=$date.", ".$user.", ".$function."\n";				
			$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
			fwrite($myfile, $userLog);
			$_SESSION['publish'] = true;
			$sql = "SELECT * from jobs order by id DESC limit 1"; 
			$result = mysqli_query ($con,$sql); 
			$row = mysqli_fetch_array($result);
			$jobsid = $row['id'];
			$jobslink = $domenaXV.'/careers.php?id='.$jobsid;
			$imagelink = $domenaXV."/login/".$target2; 
			
			/* Ovdje unijeti link do galerije na stranici */
			$_SESSION['jobsid'] = $jobsid;
			$_SESSION['target'] = $jobslink;
			$_SESSION['imagelink'] = $imagelink;
			$_SESSION['title'] = $naziv;
			
			if(isset($_SESSION['fb_access_token'])){
				$vicituserid = $_SESSION['id'];
				$token = $_SESSION['fb_access_token'];
				if(!empty($token) || $token != ''){
					$sql = "SELECT * from tblfacebookloginaccess where vicituserid = $vicituserid"; 
					$result = mysqli_query ($con,$sql); 
					$row = mysqli_fetch_array($result);
					if($row['sharejobs'] == 1){
						postJobToFacebook($naziv, $jobslink);	
					}
				}
			}
			
			if(isset($_SESSION['oauth_token'])){
				$tokentw = $_SESSION['oauth_token'];
				if(!empty($tokentw) || $tokentw != ''){
					$sql = "SELECT * from tbltwitterloginaccess where id = 1"; 
					$result = mysqli_query ($con,$sql); 
					$row = mysqli_fetch_array($result);
					if($row['sharejobs'] == 1){
						postJobToTwitter($naziv, $jobslink);
					}
				}	
			}	

			$_SESSION['msg']='Your posao is added!';
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
