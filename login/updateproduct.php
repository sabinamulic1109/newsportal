<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
/*ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);*/
?>
<?php 
include 'functions.php';
include 'config.php';
include 'replace.php';
$id=$_GET["id"];
$sql1 = "SELECT * from shop_artikli WHERE id='$id'"; 
$result1 = mysqli_query ($con,$sql1); 
while($row1 = mysqli_fetch_array($result1)){
	
	$slikaOld=$row1["foto"];
	$magID=$row1["magID"];
	
}

	$target = "shop/"; 
	$target = $target . basename( $_FILES['photo1']['name']); 
	$target1 = "magazin/"; 
	$target1 = $target1 . basename( $_FILES['photo1']['name']); 
	
	$random_digit=rand(000000,999999);







	$grupa=$_POST["grupa"];
	$naziv=$_POST["naslov"]; 
	$cijena=$_POST["cijena"]; 
	$cijena2=$_POST["cijena2"]; 
	$cijena3=$_POST["cijena3"]; 
	$opis=$_POST["opis"];
	
	
	
	$naziv = replace($naziv);
	$opis=str_replace("'", '`', $opis);
	$opis = replace($opis);
	$opis = str_ireplace('files/', 'login/files/',$opis);  
 
	$slikax=$_REQUEST["photo1"];
	$slikax=($_FILES['photo1']['name']); 
	if($slikax!=""){$slika=$random_digit.$slikax;}
	$target = "shop/".$slika; 
	$target1 = "magazin/".$slika; 

	$onSale= $_POST['onSale'];
	
	if(isset($_POST['onSale'])){
		$onSale="onSale";
		
	}else{
		$onSale="nonSale";
	}
	

	

$sql="SELECT * FROM shop_artikli WHERE naziv LIKE '$naziv' and id!='$id'";
$result=mysqli_query($con,$sql);
$count=mysqli_num_rows($result);
if($count>0){
	$_SESSION['msg2'] = 'You can\'t choose this month and year for magazine because it is already used!';
}else{
	
	if($onSale=="onSale"){
		
	 $discount=$_POST['discount'];
	 
	 $dateFROM=$_POST['dateFromID'];
	 $dateTO=$_POST['dateToID'];
	 
	 $onSaleC1=$_POST['onSaleC1'];
	 $onSaleC2=$_POST['onSaleC2'];
	 $onSaleC3=$_POST['onSaleC3'];
	 
	 if($dateFROM>$dateTO ){
		 $_SESSION["msg"] = "Date FROM must be smaller than date TO! "; 
	 }else{
		 
			if(isset($_POST['onSaleC1'])){
				$onSaleC1=1;
			  }else{
				$onSaleC1=0;
			}
			if(isset($_POST['onSaleC2'])){
				$onSaleC2=1;
			  }else{
				$onSaleC2=0;
			}
			if(isset($_POST['onSaleC3'])){
				$onSaleC3=1;
			  }else{
				$onSaleC3=0;
			}

		
		
		
		 $akcija = mysqli_query($con,"UPDATE `shop_artikli` set naziv='$naziv', opis='$opis', cijena='$cijena', cijena2='$cijena2' , cijena3='$cijena3', grupa='$grupa', discount='$discount',discountDateFrom='$dateFROM',discountDateTo='$dateTO',cijenaSale='$onSaleC1',cijenaSale2='$onSaleC2',cijenaSale3='$onSaleC3' where id='$id'");

			if($akcija == true){		
				if($slikax!=""){
					mysqli_query($con,"UPDATE `shop_artikli` set foto='$slika' where id='$id'");
					$akc = mysqli_query($con,"UPDATE `magazin` set cover='$slika' where id='$magID'");
					$slikaOld="magazin/".$slikaOld;
					unlink($slikaOld);
					$slikaOld1="shop/".$slikaOld;
					unlink($slikaOld1);
					$types = array('image/jpeg','image/jpg', 'image/gif', 'image/png', 'application/pdf');
					if (in_array($_FILES['photo1']['type'], $types)) {
						/* move_uploaded_file($_FILES['photo1']['tmp_name'], $target); */
						
						/* compresuj i upload sliku */
						
						$upload = $_FILES['photo1']['tmp_name']; 
						$target2 = "shop/".$slika; 
						$degrees = orientationImage($upload);
						compress_image($upload,$target2,50);
						$target = $target2;
						if($degrees != 0){
							rotateImage($target2,$degrees);
						}
						
						$target3 = "magazine/".$slika; 
						$degrees = orientationImage($upload);
						compress_image($upload,$target3,50);
						$target = $target3;
						if($degrees != 0){
							rotateImage($target3,$degrees);
						}
						

						
					}
				}
				$user=$_SESSION['myusername'];
				$date=date("Y-m-d h:i:sa");
				$function="Edited product: ".$naziv;
				$userLog=$date.", ".$user.", ".$function."\n";				
				$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
				fwrite($myfile, $userLog);			
				$today = date('Y-m-d');
				mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Edited product: ".$naziv."','".$today."')");
				$_SESSION['msg'] = 'Product updated';		
			}else{
				echo("Error description: " . mysqli_error($con));
				$_SESSION['msg2'] = mysqli_error($con);
				$user=$_SESSION['myusername'];
				$date=date("Y-m-d h:i:sa");
				$function="Error editing product ".$naziv.": " . mysqli_error($con);
				$userLog=$date.", ".$user.", ".$function."\n";				
				$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
				fwrite($myfile, $userLog);
			}
				 
		 
		 
	 }
	 
		
}else{
	

	$akcija = mysqli_query($con,"UPDATE `shop_artikli` set naziv='$naziv', opis='$opis', cijena='$cijena', cijena2='$cijena2' , cijena3='$cijena3', grupa='$grupa', discount=NULL,discountDateFrom='$dateFROM',discountDateTo='$dateTO',cijenaSale='$onSaleC1',cijenaSale2='$onSaleC2',cijenaSale3='$onSaleC3' where id='$id'");


	if($akcija == true){		
		if($slikax!=""){
			mysqli_query($con,"UPDATE `shop_artikli` set foto='$slika' where id='$id'");
			$akc = mysqli_query($con,"UPDATE `magazin` set cover='$slika' where id='$magID'");
			$slikaOld="magazin/".$slikaOld;
			unlink($slikaOld);
			$slikaOld1="shop/".$slikaOld;
			unlink($slikaOld1);
			$types = array('image/jpeg','image/jpg', 'image/gif', 'image/png', 'application/pdf');
			if (in_array($_FILES['photo1']['type'], $types)) {
				/* move_uploaded_file($_FILES['photo1']['tmp_name'], $target); */
				
				/* compresuj i upload sliku */
				
				$upload = $_FILES['photo1']['tmp_name']; 
				$target2 = "shop/".$slika; 
				$degrees = orientationImage($upload);
				compress_image($upload,$target2,50);
				$target = $target2;
				if($degrees != 0){
					rotateImage($target2,$degrees);
				}
				
				$target3 = "magazine/".$slika; 
				$degrees = orientationImage($upload);
				compress_image($upload,$target3,50);
				$target = $target3;
				if($degrees != 0){
					rotateImage($target3,$degrees);
				}
				

				
			}
		}
		$user=$_SESSION['myusername'];
		$date=date("Y-m-d h:i:sa");
		$function="Edited product: ".$naziv;
		$userLog=$date.", ".$user.", ".$function."\n";				
		$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
		fwrite($myfile, $userLog);			
		$today = date('Y-m-d');
		mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Edited product: ".$naziv."','".$today."')");
		$_SESSION['msg'] = 'Product updated';		
	}else{
		echo("Error description: " . mysqli_error($con));
		$_SESSION['msg2'] = mysqli_error($con);
		$user=$_SESSION['myusername'];
		$date=date("Y-m-d h:i:sa");
		$function="Error editing product ".$naziv.": " . mysqli_error($con);
		$userLog=$date.", ".$user.", ".$function."\n";				
		$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
		fwrite($myfile, $userLog);
	}
	
	
	
	
}
	
}
?>

