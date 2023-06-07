<!DOCTYPE html>
<html lang="en">
<head>

<?php include 'config.php'; ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!--title-->
    <title>Login</title>
	<meta name="description" content="<?php echo $opisXV;?>">
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
	


<?php include 'cms/header.php'; ?>

 	
		
	<div id="service" class="padding-top">		
		<div class="container text-center">
			<div class="row section-title" style="margin-bottom:10px;padding-bottom:10px">
				<div style="text-align:center;">
					<p class="wow fadeInUp" data-wow-duration="700ms" data-wow-delay="300ms">
		
			<div class="col-sm-10 col-md-8 col-lg-4" style="position:absolute; top:50%;left:50%;transform:translate(-50%,-50%);margin-bottom:70px;">
			<img src="cms/images/geologo.png" style="width:50%;margin-bottom: 20px">
			<h3 class="wow fadeInDown" data-wow-duration="700ms" data-wow-delay="300ms">Login</h3>
					<hr class="title-border">
			
				<form class="wpcf7-form chronoform " method="post" action="check.php" >
				
			<input type="text" name="username"   placeholder="Username" style="width:100%; height:50px; border:#E1E1E1 solid 1px; margin:5px 0px; padding:5px;" /><br>
			<input type="password" name="password" placeholder="Password"  style="width:100%; height:50px; border:#E1E1E1 solid 1px; margin:5px 0px; padding:5px;" /><br>
									 
			 <input type="submit" class="btn btn-default form-control A" value="Login" style="height:80px; margin:5px 0px; padding:5px; background-color:#941046!important;"/>
								 
					</form>		
				
				
				<?php
					if(isset($_GET['msg'])){
					$msg=$_GET['msg'];
					
					if($msg==1){
						
						echo '<div class="alert alert-danger" role="alert">Wrong input!</div>';
						
					}else{
						echo '<div class="alert alert-danger" role="alert">You must be logged in!</div>';
					}
					}
				?>
						
					
				</div>
					</p>
				</div>				
			</div>
		 
		</div>
	</div><!--/#about us-->		
	
	
	
	
	
	 
	
<?php include 'cms/footer.php'; ?>
	
	<!--/#scripts--> 
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>	
  	<script type="text/javascript" src="js/jquery.parallax.js"></script>
	<script type="text/javascript" src="js/jquery.isotope.min.js"></script>
	<script type="text/javascript" src="js/jquery.easypiechart.min.js"></script>
	<script type="text/javascript" src="js/jquery.appear.js"></script>
	<script type="text/javascript" src="js/jquery.inview.min.js"></script>
	<script type="text/javascript" src="js/wow.min.js"></script>
	<script type="text/javascript" src="js/jquery.countTo.js"></script>
	<script type="text/javascript" src="js/smooth-scroll.js"></script>
	<script type="text/javascript" src="js/canvas.js"></script>
    <script type="text/javascript" src="js/main.js"></script>   
</body>
</html>