<?php
session_start(); 
/* if($_SESSION['myusername']==''){
echo header("location:index.php?msg=2");
} */
?><!DOCTYPE html>
<html lang="en">
<head>
<?php include 'config.php';?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
 
	<!--title-->
   
   
   
<title><?php echo $naslovXV;?></title>
<meta name="description" content="<?php echo $opisXV;?>">
<meta name="keywords" content="<?php echo $kljucneXV;?>">


<meta property="og:title" content="<?php echo $naslovXV;?>" /> 
<meta property="og:description" content="<?php echo $opisXV;?>"/> 
 <link rel="shortcut icon" type="image/x-icon" href="cms/images/geologo.png">   
	
	<!--CSS-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/font.css" rel="stylesheet">
	<link href="css/prettyPhoto.css" rel="stylesheet">	
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">	
	
	<style>
	@media only screen and (max-width:500px){
		#service{
			overflow-x:hidden;
		}
	}
	
	</style>
	
    <!--[if lt IE 9]>
	    <script src="js/html5shiv.js"></script>
	    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
	
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="cms/js/summernote-lite.js"></script>
	<script type="text/javascript" src="js/sweetalert.min.js"></script>
	
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">  -->

<style>
</style>  
</head><!--/head-->
<body>
	
<?php include 'cms/header.php';?>
	
	 
	
	<div id="service" class=" padding-bottom">		
		<div class="container text-center">
			<div class="row"><br>
			<div class="col-md-2">					
					
					<div class="service-text" align="left">
					
					<?php include 'cms/cmsnavbar.php';?>
						
					</div>					
				</div>
				<div class="col-md-9 wow fadeInUp" id="glavni" data-wow-duration="700ms" data-wow-delay="200ms" style="visibility:hidden">					
					
					<div class="service-text">
					<?php 
					$cms=$_GET["cms"]; 
					if($cms!="welcome"){?>
							

						<button onclick="goBack()" style=" <?php if($cms!="photo"){ ?>margin-top:0px; <?php }else{ ?>margin-top:80px; <?php }?>   background: none; border: none; color: #941046;"><i class="fa fa-arrow-left"></i> <b>Back</b></button>
					<?php } ?>
<script>
function goBack() {
  window.history.back();
}
function goBack1() {
  window.history.back();
  window.history.back();
}
</script>

				
	<?php 
	
	$cms=$_GET["cms"]; 
	if($cms=="welcome"){ include 'cmswelcome.php';  }
	if($cms=="settings"){ include 'cmssettings.php';  }
	if($cms=="menu"){ include 'cmsmenu.php';  }
	if($cms=="menu2"){ include 'cmsmenu2.php';  }
	if($cms=="submenu"){ include 'cmssubmenu.php';  }
	if($cms=="submenu2"){ include 'cmssubmenu2.php';  }
	if($cms=="slider"){ include 'cmsslider.php';  }
	if($cms=="slider2"){ include 'cmsslider2.php';  }
	if($cms=="content"){ include 'cmscontent.php';  }
	if($cms=="content2"){ include 'cmscontent2.php';  }
	if($cms=="news"){ include 'cmsnews.php';  }
	if($cms=="news2"){ include 'cmsnews2.php';  }
	if($cms=="oglasi"){ include 'cmsoglasi.php';  }
	if($cms=="oglasi2"){ include 'cmsoglasi2.php';  }
	if($cms=="gallery"){ include 'cmsgallery.php';  }
	if($cms=="gallery2"){ include 'cmsgallery2.php';  }
	if($cms=="reservations"){ include 'cmsreservations.php';  }
	if($cms=="messages"){ include 'cmsmessages.php';  }
	if($cms=="messages2"){ include 'cmsmessages2.php';  }
	if($cms=="users"){ include 'cmsusers.php';  }
	if($cms=="edituser"){ include 'edituser.php';  }
	if($cms=="userlog"){ include 'userlog.php';  }
	if($cms=="testimonials"){ include 'cmstestimonials.php';  }
	if($cms=="testimonials2"){ include 'cmstestimonials2.php';  }
	if($cms=="addtestimonial"){ include 'addtestimonial.php';  }
	if($cms=="faq"){ include 'cmsfaq.php';  }
	if($cms=="social"){ include 'social.php';  }
	if($cms=="mailsettings"){ include 'mailsettings.php';  }
	if($cms=="mymessages"){ include 'mymessages.php';  }
	if($cms=="receivedmsg"){ include 'receivedmsg.php';  }
	if($cms=="sentmsg"){ include 'sentmsg.php';  }
	if($cms=="support"){ include 'support.php';  }
	if($cms=="files"){ include 'cmsfiles.php';  }
	if($cms=="backup"){ include 'cmsbackup.php';  }
	if($cms=="header"){ include 'cmsheader.php';  }
	if($cms=="analytics"){ include 'cmsanalytics.php';  }
	
	
	if($cms=="products"){ include 'cmsproducts.php';  }
	if($cms=="products2"){ include 'cmsproducts2.php';  }
	if($cms=="products3"){ include 'cmsproducts3.php';  }
	if($cms=="products4"){ include 'cmsproducts4.php';  }
	if($cms=="products5"){ include 'cmsproducts5.php';  }
	
	if($cms=="ordersAuth"){ include 'cmsordersAuth.php';  }
	if($cms=="ordersAuth2"){ include 'cmsordersAuth2.php';  }
	
	if($cms=="ordersPP"){ include 'cmsordersPP.php';  }
	if($cms=="ordersPP2"){ include 'cmsordersPP2.php';  }
	
	if($cms=="customersAuth"){ include 'cmscustomersAuth.php';  }
	if($cms=="customersAuth2"){ include 'cmscustomersAuth2.php';  }
	if($cms=="customersAuth3"){include 'cmscustomersAuth3.php';  }
	
	if($cms=="customersPP"){ include 'cmscustomersPP.php';  }
	if($cms=="customersPP2"){ include 'cmscustomersPP2.php';  }
	if($cms=="customersPP3"){ include 'cmscustomersPP3.php';  }
	
	if($cms=="photo"){ include 'directphoto.php';  }
	if($cms=="socialmediaconnect"){ include 'socialmediaconnect.php';  }
	?>				
					
					
					</div>					
				</div>
				 
			</div>
		 
		</div>
	</div><!--/#about us-->		
	
	 

	 
	
 	
	<?php include 'cms/footer.php'; ?> <!--/#footer--> 
	
	<!--/#scripts--> 	
	<script type="text/javascript" src="js/sweetalert.min.js"></script>
	<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
  	<script type="text/javascript" src="js/jquery.parallax.js"></script>
	<script type="text/javascript" src="js/jquery.appear.js"></script>
	<script type="text/javascript" src="js/jquery.inview.min.js"></script>
	<script type="text/javascript" src="js/wow.min.js"></script>
	<script type="text/javascript" src="js/smooth-scroll.js"></script>
	<script type="text/javascript" src="js/canvas.js"></script>
    <script type="text/javascript" src="js/main.js"></script> 
	<script type="text/javascript" src="cms/js/materialize.js"></script> 
	
	<script>
	 $('.sidebar-collapse').sideNav({
		edge: 'left'  
  });
	</script>
</body>

</html>