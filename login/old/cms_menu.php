<?php
session_start(); 
if($_SESSION['myusername']==''){
echo header("location:index.php");
}
?><!DOCTYPE html>
<html lang="en">
<head>
<?php include 'config.php';?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
	<!--title-->
   
   
   
<title><?php echo $naslovXV;?></title>
<meta name="description" content="<? echo $opisXV;?>">
<meta name="keywords" content="<? echo $kljucneXV;?>">


<meta property="og:title" content="<? echo $naslovXV;?>" /> 
<meta property="og:description" content="<? echo $opisXV;?>"/> 
    
	
	<!--CSS-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/font.css" rel="stylesheet">
	<link href="css/prettyPhoto.css" rel="stylesheet">	
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">	
	
    <!--[if lt IE 9]>
	    <script src="js/html5shiv.js"></script>
	    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<body>
	<!-- Page Loader -->
	<div class="preloader">
        <div id="loaderImage"></div>
    </div>
	
<?php include 'header2.php';?>
	
	 
	
	<div id="service" class="padding-top padding-bottom">		
		<div class="container text-center">
			<div class="row">
				<div class="col-md-3 col-sm-6 wow zoomIn" data-wow-duration="700ms" data-wow-delay="300ms">					
					
					<div class="service-text" align="left">
					
					<?php include 'cmsnav.php';?>
						
					</div>					
				</div>
				<div class="col-md-8 col-sm-6 wow zoomIn" data-wow-duration="700ms" data-wow-delay="400ms">					
					
					<div class="service-text">
						





<?php  include 'cmsmenu.php'; ?>












					</div>					
				</div>
				 
			</div>
		 
		</div>
	</div><!--/#about us-->		
	
	 

	 
	
 	
	<?php include 'footer.php'; ?> <!--/#footer--> 
	
	<!--/#scripts--> 
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>	
	<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
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