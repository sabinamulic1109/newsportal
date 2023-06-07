<!DOCTYPE html>
<html lang="en">
<head>
<?php session_start(); 
	include 'config.php';?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<!--title-->
	<title><?php echo $naslovXV;?></title>
	<meta name="description" content="<?php echo $opisXV;?>">
	<meta name="keywords" content="<?php echo $kljucneXV;?>">
	<meta property="og:title" content="<?php echo $naslovXV;?>" /> 
	<meta property="og:description" content="<?php echo $opisXV;?>"/> 
	<meta property="og:image" content="<?php echo $domenaXV;?>/images/fb.jpg" />	
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">

	<!--CSS-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/font.css" rel="stylesheet">
	<link href="css/prettyPhoto.css" rel="stylesheet">	
	<link href="css/main.css" rel="stylesheet">
 	
    <!--[if lt IE 9]>
	    <script src="js/html5shiv.js"></script>
	    <script src="js/respond.min.js"></script>
    <![endif]-->           
</head><!--/head-->
<body>

<style type="text/css">
.nn{
display:inline-block;
padding-left:10px;
padding-right:10px;
border:#941046 solid 1px;
color:#941046;
}
.imgShow button{
	background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;
    outline:none;
}
.imgShow img{
	box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}
.imgShow i{
	color:#a82626;
	font-size:24px;
	padding:5px;
}
#delete{
	display:none;
	position:absolute;
	z-index:1;
}
</style>

<?php /*include 'header2.php';*/ ?>

	 
	
 	
	
	<div id="blog" class="padding-top ">
		<div class="container" align="left">
			<div class="row text-center section-title" align="left">
				<div class="col-sm-12 col-sm-offset-0"><br>
<br>
<br>
<br>

<h3 class="wow fadeInDown" data-wow-duration="700ms" data-wow-delay="300ms" align="left">Leave a testimonial</h3>
<hr class="title-border" align="left">
<?php
if(isset($_SESSION['msg'])){
	$msg2='<div class="alert alert-success">
	<strong>'.$_SESSION['msg'].'</strong>
	</div>'; 
	echo $msg2;
	unset($_SESSION['msg']);
}

if(isset($_SESSION['msg2'])){
	$msg2='<div class="alert alert-warning">
	<strong>'.$_SESSION['msg2'].'</strong>
	</div>'; 
	echo $msg2;
	unset($_SESSION['msg2']);
}

?>
<form action="sendtestimonial.php" method="post" enctype="multipart/form-data" name="form1" id="form1">

	<input type="text" name="firstname"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Your name" required > 
	<input type="text" name="lastname"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Your lastname" required > 
	<input type="email" name="email"   style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Your email" required > 
			
	<textarea name="tekst"  style="width:100%; height:250px; padding:5px; margin:5px; border:#CCCCCC solid 1px; border:#941046 solid 1px; padding:5px; margin:5px 0;" placeholder="Your testimonial" maxlength="500"></textarea>
	Photo
	<input type="file" name="photo1" id="file"  style="width:100%; height:40px;  border:#941046 solid 1px; padding:5px; margin:5px 0;" onchange="loadFile(event)">  

	<div class="imgShow">
		<span name="delPic" id="delete" onclick="hide()"><i class="fa fa-times" title="Dismiss"></i></span>
		<img id="output" width="100%" height="auto" style="margin-bottom:5px;">
	</div>
	<input type="submit" name="Submit" value="       INSERT      " style="width:100%; height:40px; border:#941046 solid 1px; padding:5px; margin:5px 0;"> 

	</form>		  		  

				</div>				
			</div>
			 
		</div>
	</div><!--/#blog--> 	

	 <br>
<br>
	<?php /*include 'footer.php';*/ ?> <!--/#footer-->
	<!--/#scripts--> 
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>		
	<script type="text/javascript" src="js/wow.min.js"></script>
	<script type="text/javascript" src="js/smooth-scroll.js"></script>
    <script type="text/javascript" src="js/main.js"></script> 
	<script>
	  var loadFile = function(event) {
		var output = document.getElementById('output');
		output.src = URL.createObjectURL(event.target.files[0]);
		document.getElementById('delete').style.display="block";
		document.getElementById('output').style.display="block";
	  };
	  
	  function hide(){
		  document.getElementById('output').style.display="none";
		  document.getElementById('delete').style.display="none";
		  
		  var file = document.getElementById("file");
		  file.value = file.defaultValue;
	  }
	</script>	
</body>
</html>