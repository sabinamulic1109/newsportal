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
.testimonialimg{
	float:left;
	width:40%;
	padding:10px
}
.testimonial{
	float:left;
	width:55%;
	text-align:left;
	padding:10px 0

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

<h3 class="wow fadeInDown" data-wow-duration="700ms" data-wow-delay="300ms" align="left">Testimonials</h3>
<hr class="title-border" align="left">
<div class="col-sm-6 col-sm-offset-3">
		<a href="leavetestimonial.php"><button>Leave a testimonial</button></a>  
</div>
		  
 		  				
  	<?php 
	$sql = "SELECT * from testimonials where approved = 1 order by id desc"; 
	$result = mysqli_query ($con,$sql); 
	while($row = mysqli_fetch_array($result)){
	?>
	<div class="col-sm-12" style="padding:20px">
		<img class="testimonialimg" src="<?php echo $row['picture']; ?>"/>
		<p class="testimonial"> <?php echo $row['testimonial']; ?><br><small><?php echo $row['authorname'].' '.$row['authorlastname'].','.$row['date']; ?></small></p>
		
	</div>
	<?php 
	}
	?>
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
</body>
</html>