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

if(!empty($_POST["naslov"])){
	$target = "shop/"; 
	$target = $target . basename( $_FILES['photo1']['name']); 

	
	$random_digit=rand(000000,999999);

	$naslov=$_POST["naslov"];
	$cijena=$_POST["cijena"]; 
	$grupa=$_POST["grupa"]; 
	$tekst=$_POST["tekst"]; 
	
	$cijena2="0"; 
	$cijena3="0"; 

	$datum=date("Y-m-d");  
	$status="0";
	$visible="1";

	$slikax=($_FILES['photo1']['name']); 
	if($slikax!=""){$slika=$random_digit.$slikax;}
	$target = "shop/".$slika; 

	$naslov = replace($naslov);
	$tekst = replace($tekst);
	$tekst = str_ireplace('files/', 'login/files/',$tekst);  

	
	$author = $_SESSION['myusername'];
	$sql="SELECT * FROM shop_artikli WHERE naziv LIKE '$naslov'";
	$result=mysqli_query($con,$sql);
	$count=mysqli_num_rows($result);

	if($count>0){
		$_SESSION['msg2']='You already have product with this name!Please change product title!';
	}else{

		$akcija = mysqli_query($con,"INSERT INTO `shop_artikli` (grupa, naziv,opis,cijena,cijena2,cijena3,foto,status,visible,visits) VALUES ('".$grupa."','".$naslov."','".$tekst."','".$cijena."','".$cijena2."','".$cijena3."','".$slika."','".$status."', 1,0)") ;  
		if($akcija == true){

			$types = array('image/jpeg','image/jpg', 'image/gif', 'image/png', 'application/pdf');
			if (in_array($_FILES['photo1']['type'], $types)) {
				/* move_uploaded_file($_FILES['photo1']['tmp_name'], $target); */

				
				$upload = $_FILES['photo1']['tmp_name']; 
				$target2 = "shop/".$slika; 
				$degrees = orientationImage($upload);
				compress_image($upload,$target2,50);
				$target = $target2;
				if($degrees != 0){
					rotateImage($target2,$degrees);
				}

				
			}	
			$today = date('Y-m-d');
			mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Added new product ".$naslov."','".$today."')") ;	
			$user=$_SESSION['myusername'];
			$date=date("Y-m-d h:i:sa");
			$function="Added new product ".$naslov;
			$userLog=$date.", ".$user.", ".$function."\n";				
			$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
			fwrite($myfile, $userLog);
			$_SESSION['publish'] = true;
			$sql = "SELECT * from shop_artikli order by id DESC limit 1"; 
			$result = mysqli_query ($con,$sql); 
			$row = mysqli_fetch_array($result);
			$newsid = $row['id'];
			$newslink = $domenaXV.'/shop-details.php?id='.$newsid;
			$imagelink = $domenaXV."/login/".$target2; 
			
			/* Ovdje unijeti link do galerije na stranici */
			$_SESSION['newsid'] = $newsid;
			$_SESSION['target'] = $newslink;
			$_SESSION['imagelink'] = $imagelink;
			$_SESSION['title'] = $naslov;
				
			
			$_SESSION['msg']='Your product is added!';
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
