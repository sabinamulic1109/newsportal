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
	$address=$_POST["address"]; 
	$addressad=$_POST["addressad"]; 
	$zip=$_POST["zip"];  
	$city=$_POST["city"]; 
	$state=$_POST["state"]; 
	$country=$_POST["country"]; 
	
	$shfname=$_POST["shfname"];
	$shlname=$_POST["shlname"];
	$shemail=$_POST["shemail"]; 
	$shphone=$_POST["shphone"]; 
	$shaddress=$_POST["shaddress"]; 
	$shaddressad=$_POST["shaddressad"]; 
	$shzip=$_POST["shzip"];  
	$shcity=$_POST["shcity"]; 
	$shstate=$_POST["shstate"]; 
	$shcountry=$_POST["shcountry"]; 




 
 
	$fname = replace($fname);	
	$lname = replace($lname);
	$email = replace($email);
	$phone = replace($phone);
	$address = replace($address);
	$addressad = replace($addressad);
	$zip = replace($zip);
	$city = replace($city);
	$state = replace($state);
	$country = replace($country);

 
	$shfname = replace($shfname);	
	$shlname = replace($shlname);
	$shemail = replace($shemail);
	$shphone = replace($shphone);
	$shaddress = replace($shaddress);
	$shaddressad = replace($shaddressad);
	$shzip = replace($shzip);
	$shcity = replace($shcity);
	$shstate = replace($shstate);
	$shcountry = replace($shcountry);

	$customerFull= $fname." ".$lname; 




		$sql="SELECT * FROM customers WHERE customer_email='$email' and customer_id != $id";
		$result=mysqli_query($con,$sql);
		$count=mysqli_num_rows($result);
		if($count>0){
			$_SESSION['msg2'] = 'You can\'t edit this customer because this email address belongs to another customer!';
		}else{

		$akcija = mysqli_query($con,"UPDATE `customers` set customer_full_name='$customerFull',customer_first_name='$fname', customer_last_name='$lname', customer_email='$email', customer_phone='$phone', customer_city='$city', customer_zip='$zip', customer_stateprovince='$state', customer_country='$country' , customer_address_line_1='$address' , customer_address_line_2='$addressad' 
		,ship_customer_first_name='$shfname', ship_customer_last_name='$shlname', 	ship_customer_email='$shemail', 	ship_customer_phone='$shphone', ship_customer_city='$shcity', ship_customer_zip='$shzip', ship_customer_stateprovince='$shstate', ship_customer_country='$shcountry' , ship_customer_address_line_1='$shaddress' , ship_customer_address_line_2='$shaddressad' 
		where customer_id='$id'");
		if($akcija == true){		
			
			

			$user=$_SESSION['myusername'];
			$date=date("Y-m-d h:i:sa");
			$function="Edited Authorize Customer: ".$customerFull;
			$userLog=$date.", ".$user.", ".$function."\n";				
			$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
			fwrite($myfile, $userLog);			
			$today = date('Y-m-d');
			mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Edited Authorize Customer: ".$customerFull."','".$today."')");
			$_SESSION['msg'] = 'Authorize Customer updated';		
		}else{
			echo("Error description: " . mysqli_error($con));
			$_SESSION['msg2'] = mysqli_error($con);
			$user=$_SESSION['myusername'];
			$date=date("Y-m-d h:i:sa");
			$function="Error editing Authorize Customer ".$customerFull.": " . mysqli_error($con);
			$userLog=$date.", ".$user.", ".$function."\n";				
			$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
			fwrite($myfile, $userLog);
		}
		
	}
	
}


?>

