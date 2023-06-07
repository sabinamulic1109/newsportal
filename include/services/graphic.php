


<?php


    
     define ('URLROOT2', 'https://geosoft-studio.com'); 

?>



<!DOCTYPE html>
<html lang="zxx" class=""><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Geosoft Studio | DIGITAL AGENCY</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="msapplication-TileColor" content="#E9204F">
        <meta name="theme-color" content="#E9204F">
		<meta property="og:image" content="https://geosoft-studio.com/assets/images/logos/geosoftStudio_2.png" />	
		
		<h1 hidden>GeoSOFT-STUDIO | DIGITAL AGENCY</h1>
		
		<meta name="description" content="GeoSOFT Studio is professional a full digital agency for web development, mobile development and graphic design." />
        <meta name="keywords" content="Web Design, Web Development, Hosting, Mobile Development, Graphic Design, Virtual Tour, SEO &amp; Marketing"/>
		<meta property="og:title" content="GeoSOFT Studio | DIGITAL AGENCY" />
        <meta property="og:description" content="GeoSOFT Studio is professional a full digital agency for web development, mobile development, graphic design and marketing." />
		<meta property="og:type" content="website">
        <meta property="og:site_name" content="GeoSOFT STUDIO">
		<meta property="og:url" content="https://geosoft-studio.com">
		
		
        <link rel="apple-touch-icon" sizes="180x180" href="./assets/images/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon-16x16.png">
        <link rel="stylesheet" href="./assets/css/normalize.min.css">
        <link rel="stylesheet" href="./assets/css/pr.animation.css">
        <link rel="stylesheet" href="./assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="./assets/css/uikit.min.css">
        <link rel="stylesheet" href="./assets/css/fonts.css">
        <link rel="stylesheet" href="./assets/css/pixeicons.css">
        <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="./assets/css/simple-lightbox.min.css">
        <link href="./assets/css/mapa.css" rel="stylesheet"> 
        <link href="./assets/css/style.css" rel="stylesheet">
        <script src="//apwdprodcdn.azureedge.net/content/P3-jqueryCDN.min.jgz?version=v8"></script>
        <script src="https://www.google.com/recaptcha/api.js?render=6LdOePQUAAAAAB3h1FC0GNsxFOz5P0zMAueX_S8u"></script>
    </head>
    <body class="home front-page" data-gr-c-s-loaded="true" >

    <div id="loader" class="preloader pr__dark">
            <span class="loading">
                <span class="txt"><?php echo $loader; ?></span>
                <span class="progress">
                    <span class="bar-loading"></span>
                </span>
            </span>
        </div><!-- Preloader End -->

        <?php include "mobilenav.php" ?>

        <div class="pr__wrapper" id="site-wrapper" style="top: 0px;">

            <div class="pr__hero__wrap pr__dark serviceHeader" style="background-image: url('/assets/images/graphic.jpg'); background-repeat: no-repeat; background-size: 1903px 1069px; background-position-y: calc(-193px);" id="site-hero">

                <header class="pr__header pr__dark uk-sticky" data-uk-sticky="top: 100vh; animation: uk-animation-slide-top;" >
                    <div class="uk-container">
                        <div class="inner">
                        <div class="logo" style="opacity: 1; transform: translateX(0px);">
                                <a href="./index.html">
                                    <div class="customLogo-div">
                                    <a target="_blank" href="#">
                                    <img src="assets/images/geologo.png" alt="Geosoft Logo">

                                          </a>
                                    </div>
                                </a>
                            </div>
                            <?php include "nav.php" ?>
                            <div class="navbar-tigger" data-uk-toggle="target: #navbar-mobile">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </header><div class="uk-sticky-placeholder" style="height: 170px; margin: 0px;" hidden=""></div><!-- Site Header End -->




<section class="pr__hero uk-section" id="pr__hero">
        <div class="uk-container">
            <div class="section-inner">
                <div class="hero-content">
                    <hr class="line pr__hr__secondary--white">
                    <h2 class="page-title  uk-heading-primary"><?php echo $graphic['title']; ?><span class="service__header--span"><?php echo $graphic['titleSpan']; ?></span></h2>
                    <ul class="breadcrumbs uk-breadcrumb">
                        <li><a href="#"> <?php echo $graphic['subTitle']; ?></a></li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </section><!-- Site Hero End -->

</div><!-- Hero Wrap End -->


<div class="pr__content" id="webDev">

    <div class="pr__primary uk-section uk-section-large has-sidebar" id="site-primary">
        <div class="outer">
            <div class="uk-container uk-position-relative">
                <div class="inner uk-grid uk-grid-large uk-grid-match" data-uk-grid="">
                    <div class="uk-width-expand">
                        <main class="pr__main" id="site-main">
                            <article class="uk-article page type-page">

                                <div class="outer">
                                    <div class="inner">
                                        <div class="entry-body">

                                            <p><?php echo $graphic['body']; ?>
                                            <p><?php echo $graphic['bodySecond']; ?> 
                                            </p>
                                            <div class="row subtitle_area">
			  <div class="col-12">
			  <h5 class="uk-h4"><?php echo $graphic['tools']; ?></h5>
			  </div>
		
		  </div>


		  <div class="row tools_row">
                    <div class="col-xl-3 col-lg-6 col-sm-12 tools_col">
                        <div class="geosoft_box">
                            <img src="assets/images/tools/adobeillustrator.png" alt="Adobe Illustrator">
                            <h3>Adobe Illustrator</h3>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-sm-12 tools_col">
                        <div class="geosoft_box">
                            <img src="assets/images/tools/adobephotoshop.png" alt="Adobe Photoshop">
                            <h3>Adobe Photoshop</h3>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-sm-12 tools_col">
                        <div class="geosoft_box">
                            <img src="assets/images/tools/adobexd.png" alt="Adobe XD">
                            <h3>Adobe XD</h3>
                        </div>
                    </div>
                   

                </div>

                       <div class="galerija row">
                                          
                                          <a href="assets/images/logo/advertisingKit.jpg" class="big col-xl-4 col-lg-6 col-sm-12 galerijaGraph"> <img  class="galerija--img" src="assets/images/logo/advertisingKit.jpg" alt="" title="Logo Example" /></a>
                                          <a href="assets/images/logo/apartmani.png" class="big col-xl-4 col-lg-6 col-sm-12 galerijaGraph"><img class="galerija--img"  src="assets/images/logo/apartmani.png" alt="" title="Logo Example" /></a>
                                          <a href="assets/images/logo/bicomAuto.jpg" class="big col-xl-4 col-lg-6 col-sm-12 galerijaGraph"><img class="galerija--img"  src="assets/images/logo/bicomAuto.jpg" alt="" title="Logo Example" /></a>
                                          <a href="assets/images/logo/bicomOptima.jpg" class="big col-xl-4 col-lg-6 col-sm-12 galerijaGraph"><img class="galerija--img"  src="assets/images/logo/bicomOptima.jpg" alt="" title="Logo Example" /></a>
                                          <a href="assets/images/logo/BoothSS.jpg" class="big col-xl-4 col-lg-6 col-sm-12 galerijaGraph"><img class="galerija--img"  src="assets/images/logo/BoothSS.jpg" alt="" title="Logo Example" /></a>
                                          <a href="assets/images/logo/cvjecara.jpg" class="big col-xl-4 col-lg-6 col-sm-12 galerijaGraph"><img class="galerija--img"  src="assets/images/logo/cvjecara.jpg" alt="" title="Logo Example" /></a>
                                          <a href="assets/images/logo/hifa.jpg" class="big col-xl-4 col-lg-6 col-sm-12 galerijaGraph"><img class="galerija--img"  src="assets/images/logo/hifa.jpg" alt="" title="Logo Example" /></a>
                                          <a href="assets/images/logo/magicTouch.jpg" class="big col-xl-4 col-lg-6 col-sm-12 galerijaGraph"><img class="galerija--img"  src="assets/images/logo/magicTouch.jpg" alt="" title="Logo Example" /></a>
                                          <a href="assets/images/logo/mob.jpg" class="big col-xl-4 col-lg-6 col-sm-12 galerijaGraph"><img class="galerija--img"  src="assets/images/logo/mob.jpg" alt="" title="Logo Example" /></a>
                                          <a href="assets/images/logo/tehnik.jpg" class="big col-xl-4 col-lg-6 col-sm-12 galerijaGraph"><img class="galerija--img"  src="assets/images/logo/tehnik.jpg" alt="" title="Logo Example" /></a>
                                          <a href="assets/images/logo/tehnik2.jpg" class="big col-xl-4 col-lg-6 col-sm-12 galerijaGraph"><img class="galerija--img"  src="assets/images/logo/tehnik2.jpg" alt="" title="Logo Example" /></a>
                                          <a href="assets/images/logo/cis.jpg" class="big col-xl-4 col-lg-6 col-sm-12 galerijaGraph"><img class="galerija--img"  src="assets/images/logo/cis.jpg" alt="" title="Logo Example" /></a>
                                        
   
       
                                              
                                  </div>
    
 
                <?php include "include/components/whatWeDo_GraphicDesign.php" ?>
                    

             <div class="uk-width-1-4@l">
             <?php include "include/components/sidebar.php" ?>
        </div>
        </div>
      </div>
     </div>
</div>