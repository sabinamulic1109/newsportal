<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'config.php';?>
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
	<!-- Page Loader -->
	<div class="preloader">
        <div id="loaderImage"></div>
    </div>
	
<?php include 'header2.php';?>
	
	 
	
	 
	<?php
$idP=$_GET["id"];	
 
$result = mysqli_query($con,"SELECT * from tekst where id='$idP'");
$row = mysqli_fetch_array($result);

$idT=$row["id"];
$nasvloT=$row["naslov"];
$podnasvloT=$row["podnaslov"];
$fotoT=$row["foto"];
$opisT=$row["opis"];

	
	
	?>
	 
	
 	
	
	<div id="blog" class="padding-top ">
		<div class="container" align="left">
			<div class="row text-center section-title" align="left">
				<div class="col-sm-12 col-sm-offset-0"><br>
<br>
<br>
<br>

<h3 class="wow fadeInDown" data-wow-duration="700ms" data-wow-delay="300ms" align="left"><?php echo $nasvloT;?></h3>
<hr class="title-border" align="left">
<p class="wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms" align="left">

<?php if($fotoT!=""){echo '<img src="images/',$fotoT,'" align="left" style="padding:15px;">';} ?>


<div style="text-align:left"><?php echo $opisT;?></div></p>
				</div>				
			</div>
			 
		</div>
	</div><!--/#blog--> 	
	
 	

	

	 
	 <br>
<br>

 
  
	
	<?php include 'footer.php'; ?> <!--/#footer--> 
	
	<!--/#scripts--> 
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>	
	<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
  	<script type="text/javascript" src="js/gmaps.js"></script>
  	<script type="text/javascript" src="js/jquery.parallax.js"></script>
	<script type="text/javascript" src="js/jquery.isotope.min.js"></script>
	<script type="text/javascript" src="js/jquery.easypiechart.min.js"></script>
	<script type="text/javascript" src="js/jquery.appear.js"></script>
	<script type="text/javascript" src="js/jquery.inview.min.js"></script>
	<script type="text/javascript" src="js/wow.min.js"></script>
	<script type="text/javascript" src="js/jquery.countTo.js"></script>
	<script type="text/javascript" src="js/smooth-scroll.js"></script>
	<script type="text/javascript" src="js/canvas.js"></script>
	<script type="text/javascript" src="js/preloader.js"></script>
    <script type="text/javascript" src="js/main.js"></script>   
</body>
</html>