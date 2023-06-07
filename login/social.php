<?php

session_start(); 

include 'config.php';
if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
}
if($roles['settings'] == 0){
echo '<script>window.location.href = "cms.php?cms=welcome"</script>';	
}

$sql1 = "SELECT * FROM socialmedia WHERE id=1"; 
$result1 = mysqli_query ($con,$sql1); 
$row1 = mysqli_fetch_array($result1);
 

$facebookCheck=$row1["fbC"];
$instagramCheck=$row1["igC"];
$twitterCheck=$row1["twC"];
$snapchatCheck=$row1["scC"];
$youtubeCheck=$row1["ytC"];
$googleplusCheck=$row1["gpC"];
$linkedinCheck=$row1["liC"];
$pinterestCheck=$row1["piC"];


$facebookLink=$row1["fbL"];
$instagramLink=$row1["igL"]; 
$twitterLink=$row1["twL"];
$snapchatLink=$row1["scL"]; 
$youtubeLink=$row1["ytL"];
$googleplusLink=$row1["gpL"]; 
$linkedinLink=$row1["liL"]; 
$pinterestLink=$row1["piL"]; 

if(isset($_SESSION['msg'])){	/*$msg2='<div class="alert alert-success">	<strong>'.$_SESSION['msg'].'</strong>	</div>'; 	echo $msg2;*/	$msg=$_SESSION['msg'];	echo '<script language="JavaScript" type="text/javascript">swal("'.$msg.'");</script>';	unset($_SESSION['msg']);	$msg="";}if(isset($_SESSION['msg2'])){	/*$msg2='<div class="alert alert-warning">	<strong>'.$_SESSION['msg2'].'</strong>	</div>'; 	echo $msg2;*/	$msg=$_SESSION['msg2'];	echo '<script language="JavaScript" type="text/javascript">swal("'.$msg.'");</script>';	unset($_SESSION['msg2']);	$msg="";}?>



<div class="col-sm-12">
	<h2>Check and paste link to your social media</h2>  
</div><div class="col-sm-8 col-sm-offset-2">
<form action="updatesocial.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
		


<div class="col-sm-12" style="margin-bottom:20px;" >
			<input type="checkbox" id="facebook" name="facebook" <?php if($facebookCheck == 1){ ?> checked <?php } ?>/>
			<label style="width: 120px!important;" for="facebook" >Facebook</label>
			<input id="facebookDodatno" name="facebookLink" class="form-control socialMediaInputs" placeholder="Link" type="text" <?php if($facebookCheck == 1){ ?> style=" width:50%;margin-left:25%;visibility:visible;position:relative;" <?php }else{ ?> style=" width:50%;margin-left:25%;visibility:hidden;position:absolute;" <?php }?>  value="<?php echo $facebookLink; ?>"  maxlength="100">
</div>	

<div class="col-sm-12" style="margin-bottom:20px;" >
			<input type="checkbox" id="instagram" name="instagram" <?php if($instagramCheck == 1){ ?> checked <?php } ?> />
			<label style="width: 120px!important;" for="instagram" >Instagram</label>
			<input id="instagramDodatno" name="instagramLink" class="form-control socialMediaInputs" placeholder="Link" type="text" <?php if($instagramCheck == 1){ ?> style=" width:50%;margin-left:25%;visibility:visible;position:relative;" <?php }else{ ?> style=" width:50%;margin-left:25%;visibility:hidden;position:absolute;" <?php }?>  value="<?php echo $instagramLink; ?>"  maxlength="100">
</div>	

<div class="col-sm-12" style="margin-bottom:20px;">
			<input type="checkbox" id="twitter" name="twitter" <?php if($twitterCheck == 1){ ?> checked <?php } ?>/>
			<label style="width: 120px!important;" for="twitter" >Twitter</label>
			<input id="twitterDodatno" name="twitterLink" class="form-control socialMediaInputs" placeholder="Link" type="text" <?php if($twitterCheck == 1){ ?> style=" width:50%;margin-left:25%;visibility:visible;position:relative;" <?php }else{ ?> style=" width:50%;margin-left:25%;visibility:hidden;position:absolute;" <?php }?>  value="<?php echo $twitterLink; ?>"  maxlength="100">
</div>	

<div class="col-sm-12" style="margin-bottom:20px;">
			<input type="checkbox" id="snapchat" name="snapchat" <?php if($snapchatCheck == 1){ ?> checked <?php } ?>/>
			<label style="width: 120px!important;" for="snapchat" >Snapchat</label>
			<input id="snapchatDodatno" name="snapchatLink" class="form-control socialMediaInputs" placeholder="Link" type="text" <?php if($snapchatCheck == 1){ ?> style=" width:50%;margin-left:25%;visibility:visible;position:relative;" <?php }else{ ?> style=" width:50%;margin-left:25%;visibility:hidden;position:absolute;" <?php }?>  value="<?php echo $snapchatLink; ?>"  maxlength="100">
</div>	

<div class="col-sm-12" style="margin-bottom:20px;">
			<input type="checkbox" id="youtube" name="youtube" <?php if($youtubeCheck == 1){ ?> checked <?php } ?> />
			<label style="width: 120px!important;" for="youtube" >Youtube</label>
			<input id="youtubeDodatno" name="youtubeLink" class="form-control socialMediaInputs" placeholder="Link" type="text" <?php if($youtubeCheck == 1){ ?> style=" width:50%;margin-left:25%;visibility:visible;position:relative;" <?php }else{ ?> style=" width:50%;margin-left:25%;visibility:hidden;position:absolute;" <?php }?>  value="<?php echo $youtubeLink; ?>"  maxlength="100">
</div>	

<div class="col-sm-12" style="margin-bottom:20px;">
			<input type="checkbox" id="googleplus" name="googleplus" <?php if($googleplusCheck == 1){ ?> checked <?php } ?>/>
			<label style="width: 120px!important;" for="googleplus" >Google +</label>
			<input id="googleplusDodatno" name="googleplusLink" class="form-control socialMediaInputs" placeholder="Link" type="text" <?php if($googleplusCheck == 1){ ?> style=" width:50%;margin-left:25%;visibility:visible;position:relative;" <?php }else{ ?> style=" width:50%;margin-left:25%;visibility:hidden;position:absolute;" <?php }?>  value="<?php echo $googleplusLink; ?>"  maxlength="100">
</div>	

<div class="col-sm-12" style="margin-bottom:20px;">
			<input type="checkbox" id="linkedin" name="linkedin" <?php if($linkedinCheck == 1){ ?> checked <?php } ?>/>
			<label style="width: 120px!important;" for="linkedin" >LinkedIn</label>
			<input id="linkedinDodatno" name="linkedinLink" class="form-control socialMediaInputs" placeholder="Link" type="text" <?php if($linkedinCheck == 1){ ?> style=" width:50%;margin-left:25%;visibility:visible;position:relative;" <?php }else{ ?> style=" width:50%;margin-left:25%;visibility:hidden;position:absolute;" <?php }?>  value="<?php echo $linkedinLink; ?>" maxlength="100">
</div>	


<div class="col-sm-12" style="margin-bottom:20px;">
			<input type="checkbox" id="pinterest" name="pinterest" <?php if($pinterestCheck == 1){ ?> checked <?php } ?>/>
			<label style="width: 120px!important;" for="pinterest" >Pinterest</label>
			<input id="pinterestDodatno" name="pinterestLink" class="form-control socialMediaInputs" placeholder="Link" type="text" <?php if($pinterestCheck == 1){ ?> style=" width:50%;margin-left:25%;visibility:visible;position:relative;" <?php }else{ ?> style=" width:50%;margin-left:25%;visibility:hidden;position:absolute;" <?php }?>  value="<?php echo $pinterestLink; ?>"  maxlength="100">
</div>	


 
<div align="right"><input type="submit" name="Submit" value="       SAVE      " class="submitBtn"></div>
	  
</form>
</div>
<script>

$('#facebook').click(function() {
    if( $(this).is(':checked')) {	
		 var div = document.getElementById('facebookDodatno');
		div.style.visibility = 'visible';
		div.style.position = 'relative';
		div.required = true;
    }
    else {
       		var div = document.getElementById('facebookDodatno');
        div.style.visibility = 'hidden';
		div.style.position = 'absolute';
		div.required = false;
		 }
});

$('#instagram').click(function() {
    if( $(this).is(':checked')) {	
		 var div = document.getElementById('instagramDodatno');
		div.style.visibility = 'visible';
		div.style.position = 'relative';
		div.required = true;
    }
    else {
       	var div = document.getElementById('instagramDodatno');
        div.style.visibility = 'hidden';
		div.style.position = 'absolute';
		div.required = false;
		 }
});

$('#twitter').click(function() {
    if( $(this).is(':checked')) {	
		 var div = document.getElementById('twitterDodatno');
		div.style.visibility = 'visible';
		div.style.position = 'relative';
		div.required = true;
    }
    else {
       		var div = document.getElementById('twitterDodatno');
        div.style.visibility = 'hidden';
		div.style.position = 'absolute';
		div.required = false;
		 }
});


$('#snapchat').click(function() {
    if( $(this).is(':checked')) {	
		 var div = document.getElementById('snapchatDodatno');
		div.style.visibility = 'visible';
		div.style.position = 'relative';
		div.required = true;
    }
    else {
       		var div = document.getElementById('snapchatDodatno');
        div.style.visibility = 'hidden';
		div.style.position = 'absolute';
		div.required = false;
		 }
});

$('#youtube').click(function() {
    if( $(this).is(':checked')) {	
		 var div = document.getElementById('youtubeDodatno');
		div.style.visibility = 'visible';
		div.style.position = 'relative';
		div.required = true;
    }
    else {
       		var div = document.getElementById('youtubeDodatno');
        div.style.visibility = 'hidden';
		div.style.position = 'absolute';
		div.required = false;
		 }
});

$('#googleplus').click(function() {
    if( $(this).is(':checked')) {	
		 var div = document.getElementById('googleplusDodatno');
		div.style.visibility = 'visible';
		div.style.position = 'relative';
		div.required = true;
    }
    else {
       		var div = document.getElementById('googleplusDodatno');
        div.style.visibility = 'hidden';
		div.style.position = 'absolute';
		div.required = false;
		 }
});

$('#linkedin').click(function() {
    if( $(this).is(':checked')) {	
		 var div = document.getElementById('linkedinDodatno');
		div.style.visibility = 'visible';
		div.style.position = 'relative';
		div.required = true;
    }
    else {
       		var div = document.getElementById('linkedinDodatno');
        div.style.visibility = 'hidden';
		div.style.position = 'absolute';
		div.required = false;
		 }
});

$('#pinterest').click(function() {
    if( $(this).is(':checked')) {	
		 var div = document.getElementById('pinterestDodatno');
		div.style.visibility = 'visible';
		div.style.position = 'relative';
		div.required = true;
    }
    else {
       		var div = document.getElementById('pinterestDodatno');
        div.style.visibility = 'hidden';
		div.style.position = 'absolute';
		div.required = false;
		 }
});
</script>