<?php 
session_start(); 
header('Location: '.$_SERVER['HTTP_REFERER']);
?>
<?php 
include 'config.php';

$facebookCheck=2;
$instagramCheck=2;
$twitterCheck=2;
$snapchatCheck=2;
$youtubeCheck=2;
$googleplusCheck=2;
$linkedinCheck=2;
$pinterestCheck=2;


$facebookLink="#";
$instagramLink="#"; 
$twitterLink="#"; 
$snapchatLink="#"; 
$youtubeLink="#"; 
$googleplusLink="#"; 
$linkedinLink="#"; 
$pinterestLink="#";  



		if(isset($_POST['facebook'])){
			$facebookCheck = 1;
			$facebookLink=$_POST['facebookLink'];
		}else{
			$facebookCheck = 0;
			$facebookLink="-";
		}
		
		if(isset($_POST['instagram'])){
			$instagramCheck = 1;
			$instagramLink=$_POST['instagramLink'];
		}else{
			$instagramCheck = 0;
			$instagramLink="-";
		}
		
		if(isset($_POST['twitter'])){
			$twitterCheck = 1;
			$twitterLink=$_POST['twitterLink'];
		}else{
			$twitterCheck = 0;
			$twitterLink="-";
		}
		
		if(isset($_POST['snapchat'])){
			$snapchatCheck = 1;
			$snapchatLink=$_POST['snapchatLink'];
		}else{
			$snapchatCheck = 0;
			$snapchatLink="-";
		}
		
		if(isset($_POST['youtube'])){
			$youtubeCheck = 1;
			$youtubeLink=$_POST['youtubeLink'];
		}else{
			$youtubeCheck = 0;
			$youtubeLink="-";
		}
		
		if(isset($_POST['googleplus'])){
			$googleplusCheck = 1;
			$googleplusLink=$_POST['googleplusLink'];
		}else{
			$googleplusCheck = 0;
			$googleplusLink="-";
		}
		
		if(isset($_POST['linkedin'])){
			$linkedinCheck = 1;
			$linkedinLink=$_POST['linkedinLink'];
		}else{
			$linkedinCheck = 0;
			$linkedinLink="-";
		}
		
		if(isset($_POST['pinterest'])){
			$pinterestCheck = 1;
			$pinterestLink=$_POST['pinterestLink'];
		}else{
			$pinterestCheck = 0;
			$pinterestLink="-";
		}
/*
echo "<script type='text/javascript'>alert('FB check: $facebookCheck');</script>";
echo "<script type='text/javascript'>alert('FB Link: $facebookLink');</script>";		

echo "<script type='text/javascript'>alert('IG check: $instagramCheck');</script>";
echo "<script type='text/javascript'>alert('IG Link: $instagramLink');</script>";	

echo "<script type='text/javascript'>alert('TW check: $twitterCheck');</script>";
echo "<script type='text/javascript'>alert('TW Link: $twitterLink');</script>";	

echo "<script type='text/javascript'>alert('SC check: $snapchatCheck');</script>";
echo "<script type='text/javascript'>alert('SC Link: $snapchatLink');</script>";	

echo "<script type='text/javascript'>alert('YT check: $youtubeCheck');</script>";
echo "<script type='text/javascript'>alert('YT Link: $youtubeLink');</script>";	

echo "<script type='text/javascript'>alert('G+ check: $googleplusCheck');</script>";
echo "<script type='text/javascript'>alert('G+ Link: $googleplusLink');</script>";	

echo "<script type='text/javascript'>alert('LI check: $linkedinCheck');</script>";
echo "<script type='text/javascript'>alert('LI Link: $linkedinLink');</script>";	

echo "<script type='text/javascript'>alert('PI check: $pinterestCheck');</script>";
echo "<script type='text/javascript'>alert('PI Link: $pinterestLink');</script>";	*/



if($facebookCheck==2 || $instagramCheck==2 || $twitterCheck==2 || $snapchatCheck==2 || $youtubeCheck==2 || $googleplusCheck==2 || $linkedinCheck==2 || $pinterestCheck==2 || 
   $facebookLink=="#" || $instagramLink=="#" || $twitterLink=="#" || $snapchatLink=="#" || $youtubeLink=="#" || $googleplusLink=="#" || $linkedinLink=="#" || $pinterestLink=="#"){
	   
	 //  echo "<script type='text/javascript'>alert('Something went wrong. Please try again!');</script>";	
	   
   }
else{
		//echo "<script type='text/javascript'>alert('Sve dobro');</script>";
		$akcija = mysqli_query($con,"UPDATE `socialmedia` set fbC='$facebookCheck', fbL='$facebookLink', igC='$instagramCheck', igL='$instagramLink', twC='$twitterCheck', twL='$twitterLink', scC='$snapchatCheck', scL='$snapchatLink', ytC='$youtubeCheck', ytL='$youtubeLink', gpC='$googleplusCheck', gpL='$googleplusLink', liC='$linkedinCheck', liL='$linkedinLink', piC='$pinterestCheck', piL='$pinterestLink' where id=1");

}	
		

//echo "UPDATE `socialMedia` set fbC='$facebookCheck', fbL='$facebookLink', igC='$instagramCheck', igL='$instagramLink', twC='$twitterCheck', twL='$twitterLink', scC='$snapchatCheck', scL='$snapchatLink', ytC='$youtubeCheck', ytL='$youtubeLink', gpC='$googleplusCheck', gpL='$googleplusLink', liC='$linkedinCheck', liL='$linkedinLink', piC='$pinterestCheck', piL='$pinterestLink'";

if($akcija == true){
	$today = date('Y-m-d');
	mysqli_query($con,"INSERT INTO `userlog` VALUES (0,'".$_SESSION['myusername']."','Changed Social media links','".$today."')");
	$user1=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Changed Social media links";
	$userLog=$date.", ".$user1.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
	$_SESSION['msg'] = 'Social media links updated';
	$msg='<div class="alert alert-success">
	  <strong>'.$_SESSION['msg'].'</strong>
	</div>'; 
}else{
	$user1=$_SESSION['myusername'];
	$date=date("Y-m-d h:i:sa");
	$function="Error changing Social media links: " . mysqli_error($con);
	$userLog=$date.", ".$user1.", ".$function."\n";				
	$myfile = fopen("userLog.txt", "a") or die("Unable to open file!");
	fwrite($myfile, $userLog);
	$_SESSION['msg2'] = $function;
	$msg='<div class="alert alert-warning">
	  <strong>'.$_SESSION['msg2'].'</strong>
	</div>'; 
}




?>

