
<?php
	
    include "switch.php";
       
   
       define ('URLROOT', 'https://geosoft-studio.com/');
   
   
   
   
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
         <!--   PRELOADER CONTACT -->
     <!--     <div id="preloaderContact">
           <div id="status">&nbsp;</div>
         </div>   -->
       <!-- PRELOADER END CONTACT-->
   
           <div class="pr__mobile__nav uk-offcanvas" id="navbar-mobile" data-uk-offcanvas="overlay: true; flip: true; mode: none">
               <div class="uk-offcanvas-bar">
   
                   <button class="uk-offcanvas-close uk-close uk-icon" type="button" data-uk-close="ratio: 2;"><svg width="28" height="28" viewBox="0 0 14 14" xmlns=""></svg></button> 
   
                   <nav class="menu" data-uk-scrollspy-nav="offset: 0; closest: li; scroll: true">
                       <ul data-uk-scrollspy="target: &gt; li; cls:uk-animation-slide-right; delay: 100; repeat: true;">
                           <li class="uk-active " style="visibility: hidden;"><a class="smooth-scroll uk-offcanvas-close mobile-links" href="#pr__hero"><?php echo $menu['home']; ?></a></li>
                           <li class="" style="visibility: hidden;"><a class="smooth-scroll uk-offcanvas-close mobile-links" href="#pr__services"><?php echo $menu['services']; ?></a></li>
                           <li class="" style="visibility: hidden;"><a class="smooth-scroll uk-offcanvas-close mobile-links" href="#pr__works"><?php echo $menu['works']; ?></a></li>
                           <li class="" style="visibility: hidden;"><a class="smooth-scroll uk-offcanvas-close mobile-links" href="#pr__about"><?php echo $menu['about']; ?></a></li>
                           <li class="" style="visibility: hidden;"><a class="smooth-scroll uk-offcanvas-close mobile-links" href="#career"><?php echo $menu['career']; ?></a></li>
                           <li class="" style="visibility: hidden;"><a class="smooth-scroll uk-offcanvas-close mobile-links" href="#work-with-us"><?php echo $menu['contact']; ?></a></li>
                       </ul>
                   </nav>
                   <div class="lang langMobile" style="opacity: 1; transform: translateX(0px);">
                                    <div data-uk-form-custom="target: true" class="uk-form-custom">
                                        <select class="custom-select custom-select-mobile"  id="language_custom-select2">
                                            <option class="custom-option" hidden> <?php echo $_SESSION['lang']?></option>
                                            <option class="custom-option" value="En"> En</option>
                                            <option class="custom-option" value="De"> De </option>
											<option class="custom-option" value="Hr">Hr</option>
                                        </select>
			
                                        <span><?php echo $_SESSION['lang']?></span>
                                        <i class="icon pr-chevron-down"></i>
                                    </div>
                                </div>
               </div><!-- Off Canvas Bar End -->
           </div><!-- Mobile Nav End -->
   
           <div class="pr__wrapper" id="site-wrapper" style="top: 0px;">
   
               <div class="pr__hero__wrap pr__dark"  id="site-hero">
   
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
                               <div class="navbar pr-font-second">
                                   <nav class="menu bigZ" data-uk-scrollspy-nav="offset: 0; closest: li; scroll: true">
                                       <ul>
                                           <li class="uk-active" style="opacity: 1; transform: translateX(0px);"><a href="#pr__hero"><?php echo $menu['home']; ?></a></li>
                                           <li class="" style="opacity: 1; transform: translateX(0px);"><a class="smooth-scroll" href="#pr__services"><?php echo $menu['services']; ?></a></li>
                                           <li class="" style="opacity: 1; transform: translateX(0px);"><a class="smooth-scroll"  href="#pr__works"><?php echo $menu['works']; ?></a></li>
                                           <li class="" style="opacity: 1; transform: translateX(0px);"><a class="smooth-scroll"  href="#pr__about"><?php echo $menu['about']; ?></a></li>
                                           <li class="" style="opacity: 1; transform: translateX(0px);"><a class="smooth-scroll"  href="#work-with-us"><?php echo $menu['contact']; ?></a></li>
                                       </ul>
                                   </nav>
                                   <div class="lang" style="opacity: 1; transform: translateX(0px);">
                                       <div data-uk-form-custom="target: true" class="uk-form-custom">
                                           <select class="custom-select"  id="language_custom-select">
                                               <option class="custom-option" hidden> <?php echo $_SESSION['lang']?></option>
                                               <option class="custom-option" value="En"> En</option>
                                               <option class="custom-option" value="De"> De </option>
                                               <option class="custom-option" value="Hr">Hr</option>
                                           </select>
                           <!-- 				<script>
                                            function changeLang(){
                                                   var e = document.getElementById("language_custom-select");
                                                   var lng = e.options[e.selectedIndex].value;
                                                   alert(lng)
                                                   window.sessionStorage.setItem("lang", lng);
                                                   window.location.reload();
                                            }
                                           </script> -->
                                           <span><?php echo $_SESSION['lang']?></span>
                                           <i class="icon pr-chevron-down"></i>
                                       </div>
                                   </div>
                               </div>
                               <div class="navbar-tigger" data-uk-toggle="target: #navbar-mobile">
                                   <span></span>
                                   <span></span>
                                   <span></span>
                               </div>
                           </div>
                       </div>
  
                   <hr class="pr__vr__section">
               </div><!-- Site Content End -->
   
        <?php include "include/footer.php" ?>