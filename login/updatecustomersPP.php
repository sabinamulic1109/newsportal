<?php 
session_start(); 
/*ini_set('memory_limit','-1');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);*/
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php 
include 'functions.php';
include 'config.php';
include 'replace.php';

$id=$_GET["id"];




if(isset($_POST['Submit'])){




	
	$fname=$_POST["fname"];
	$lname=$_POST["lname"];
	$email=$_POST["email"]; 
	$phone=$_POST["phone"]; 
	$country=$_POST["country"]; 
	
	$shname=$_POST["shname"]; 
	$shaddress=$_POST["shaddress"]; 
	$shzip=$_POST["shzip"];  
	$shcity=$_POST["shcity"]; 
	$shstate=$_POST["shstate"]; 
	$shcountry=$_POST["shcountry"]; 




 
 
	$fname = replace($fname);	
	$lname = replace($lname);
	$email = replace($email);
	$phone = replace($phone);
	$country = replace($country);

 
	$shname = replace($shname);	
	$shaddress = replace($shaddress);
	$shzip = replace($shzip);
	$shcity = replace($shcity);
	$shstate = replace($shstate);
	$shcountry = replace($shcountry);

	$customerFull= $fname." ".$lname; 




		$sql="SELECT * FROM customersPP WHERE customer_email='$email' and customer_id != $id";
		$result=mysqli_query($con,$sql);
		$count=mysqli_num_rows($result);
		if($count>0){
			$_SESSION['msg2'] = 'You can\'t edit this customer because this email address belongs to another customer!';
		}else{

		$akcija = mysqli_query($con,"UPDATE `customersPP` set customer_full_name='$customerFull',customer_first_name='$fname', customer_last_name='$lname', customer_email='$email', customer_phone='$phone', customer_country='$country' 
		, ship_customer_full_name='$shname', ship_customer_city='$shcity', ship_customer_zip='$shzip', ship_customer_stateprovince='$shstate', ship_customer_country='$shcountry' , ship_customer_address_line_1='$shaddress' 
		where customer_id='$id'");
		if($akcija == true){		
			
			

			$user=$_SESSION['myusername'];
			$date=date("Y-m-d h:i:sa");
			$function="Edited Paypal Customer: ".$customerFull;
			$userLog=$date.", ".$user.", ".$function."\n";				
			$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
			fwrite($myfile, $userLog);			
			$today = date('Y-m-d');
			mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Edited Paypal Customer: ".$customerFull."','".$today."')");
			$_SESSION['msg'] = 'Paypal Customer updated';		
		}else{
			echo("Error description: " . mysqli_error($con));
			$_SESSION['msg2'] = mysqli_error($con);
			$user=$_SESSION['myusername'];
			$date=date("Y-m-d h:i:sa");
			$function="Error editing Paypal Customer ".$customerFull.": " . mysqli_error($con);
			$userLog=$date.", ".$user.", ".$function."\n";				
			$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
			fwrite($myfile, $userLog);
		}
		
	}
	
}


?>

