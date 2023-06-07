

<?php

define ('URLROOT2', 'https://geosoft-studio.com'); 

?>



<!DOCTYPE html>
<html lang="zxx" class=""><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   <title><?php echo $pageTitle; ?></title>

   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="msapplication-TileColor" content="#E9204F">
   <meta name="theme-color" content="#E9204F">
   <meta property="og:image" content="https://geosoft-studio.com/assets/images/logos/geosoftStudio_2.png" />	
   
   <h1 hidden><?php echo $pageTitle; ?></h1>
   
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

   <?php include "include/services/mobilenav.php" ?>

        <div class="pr__wrapper" id="site-wrapper" style="top: 0px;">

            <div class="pr__hero__wrap pr__dark serviceHeader" style="background-image: url(&#39;assets/images/works/geoplus/geoplus.png&#39;); background-repeat: no-repeat; background-size: 100% 100%;" id="site-hero">

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
                            <?php include "include/services/nav.php" ?>
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
                    <h2 class="page-title  uk-heading-primary"><?php echo $geoplus['title']; ?><span class="service__header--span"><?php echo $geoplus['titleSpan']; ?></span></h2>
                    <ul class="breadcrumbs uk-breadcrumb">
                        <li><a href="#"> <?php echo $geoplus['subTitle']; ?></a></li>
                        
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


                                            <p><?php echo $geoplus['body']; ?>
                                            </p>


                                            </div>
                                              </div>
                                              <h5 class="uk-h4"><?php echo $geoplus['galleryTitle']; ?></h5>
                                             <div class="galerija row ">
                                               
                                            <a href="assets/images/works/geoplus/geoplus_1.png" class="big col-xl-4 col-lg-6 col-sm-12"> <img  class="galerija--img" src="assets/images/works/geoplus/thumb/geoplus_1.jpg" alt=""  /></a>
                                            <a href="assets/images/works/geoplus/geoplus_2.png" class="big col-xl-4 col-lg-6 col-sm-12"><img class="galerija--img"  src="assets/images/works/geoplus/thumb/geoplus_2.jpg" alt=""  /></a>
                                            <a href="assets/images/works/geoplus/geoplus_3.png" class="big col-xl-4 col-lg-6 col-sm-12"><img class="galerija--img"  src="assets/images/works/geoplus/thumb/geoplus_3.jpg" alt=""  /></a>
                                            <a href="assets/images/works/geoplus/geoplus_4.png" class="big col-xl-4 col-lg-6 col-sm-12"><img class="galerija--img"  src="assets/images/works/geoplus/thumb/geoplus_4.jpg" alt=""  /></a>
                                            <a href="assets/images/works/geoplus/geoplus_5.png" class="big col-xl-4 col-lg-6 col-sm-12"><img class="galerija--img"  src="assets/images/works/geoplus/thumb/geoplus_5.jpg" alt=""  /></a>
                                            <a href="assets/images/works/geoplus/geoplus_6.png" class="big col-xl-4 col-lg-6 col-sm-12"><img class="galerija--img"  src="assets/images/works/geoplus/thumb/geoplus_6.jpg" alt=""  /></a>
                                            <a href="assets/images/works/geoplus/geoplus_7.png" class="big col-xl-4 col-lg-6 col-sm-12"><img class="galerija--img"  src="assets/images/works/geoplus/thumb/geoplus_7.jpg" alt=""  /></a>
                                            <a href="assets/images/works/geoplus/geoplus_8.png" class="big col-xl-4 col-lg-6 col-sm-12"><img class="galerija--img"  src="assets/images/works/geoplus/thumb/geoplus_8.jpg" alt=""  /></a>
                                            <a href="assets/images/works/geoplus/geoplus_9.png" class="big col-xl-4 col-lg-6 col-sm-12"><img class="galerija--img"  src="assets/images/works/geoplus/thumb/geoplus_5.jpg" alt=""  /></a>

                                           </div>


                                                
                                    </div>
                                 
                            </article>
                        </main>
                        <?php include "include/components/relatedprojects.php" ?>
                    </div>
		




                    

             <div class="uk-width-1-4@l">
             <aside class="pr-sidebar widget-area" id="site-sidebar">
                            <div style="z-index: 1;" data-uk-sticky="offset: 120; bottom: true">
                                <section class="widget widget_nav_menu">
                                    <h2 class="widget-title"><?php echo $workSidebar['title']; ?></h2>
                                    <ul class="content">
                                        <li> 
                                            <h5><?php echo $workSidebar['clientTitle']; ?></h5>
                                            <p><?php echo $geoplus['clientName']; ?></p>
                                        </li>
                                        <li> 
                                            <h5><?php echo $workSidebar['typeTitle']; ?></h5>
                                            <p><?php echo $geoplus['type']; ?></p>
                                        </li>
                                        <li> 
                                            <h5><?php echo $workSidebar['dateTitle']; ?></h5>
                                            <p><?php echo $geoplus['date']; ?></p>
                                        </li>
                                        <li> 
                                            <h5><?php echo $workSidebar['webTitle']; ?></h5>
                                            <p><?php echo $geoplus['websiteLink']; ?></p>
                                        </li>
                                
                                    
                                    </ul>
                                </section>
                            </div>
                        </aside>
        </div>
        </div>
      </div>
     </div>
</div>