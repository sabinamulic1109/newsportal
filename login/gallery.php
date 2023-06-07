<!DOCTYPE html>
<html lang="en">
<head>

<? include 'config.php'; ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!--title-->
    <title><? echo $naslovXV;?></title>
	    <meta name="description" content="<? echo $opisXV;?>">
    <meta name="author" content="Vicit.world">
	
	<!--CSS-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/font.css" rel="stylesheet">
	<link href="css/prettyPhoto.css" rel="stylesheet">	
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">	
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">

	
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
	


<? include 'header2.php'; ?>


	  	
	
 
	
	 
	<div id="recent-works" class="padding-top padding-bottom off-white">
		<div class="container" >
			<div class="row text-center section-title">
				<div class="col-sm-6 col-sm-offset-3">
					<h3 class="wow fadeInDown" data-wow-duration="700ms" data-wow-delay="300ms">Gallery</h3>
					<hr class="title-border">
					 
				</div>				
			</div>
		</div>
		<div class="portfolio-wrapper wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms">
			 
				 
			
			<ul class="portfolio-items">
			<?php

$sql = "SELECT * from slike order by id "; 
$result = mysqli_query ($con,$sql); 
while($row = mysqli_fetch_array($result)){

$idF=$row["id"];
$fotoF=$row["foto"];
$naslovF=$row["naslov"];
$galerijaF=$row["galerija"];
    


echo '<li class="gl',$galerijaF,'">
					<div class="portfolio-content">
						<img class="img-responsive" src="galerija/',$fotoF,'" alt="">
						<div class="overlay">								
							<a class="folio-detail" href="galerija/',$fotoF,'" data-gallery="prettyPhoto"><i class="fa fa-camera"></i></a>
							<a class="folio-link" href="#"><i class="fa fa-long-arrow-right"></i></a>						</div>
					</div>	
				</li> ';
					
}
?>			
				
			
							
			</ul>	
			
			
		 
		</div>
	</div><!--/#portfolio-->	
	
	
	
	
	
	
	
	
	
	
	
	 
	
<? include 'footer.php'; ?>
	
	<!--/#scripts--> 
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>	
	<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
	<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=true"></script>
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