<footer class="pr__footer" id="site-footer">

    <div class="pr__footer__top uk-section uk-section-large">
        <div class="section-outer">
            <div class="uk-container">
                <div class="section-inner">
                    <div class="columns uk-grid" data-uk-grid="">
                        <div class="pr__cta column">
                            <div class="inner">
                                <h2 class="title uk-h1"><?php echo $footer['hello']; ?></h2>
                            </div>
                        </div>
                        <div class="pr__cta column">
                            <div class="inner">
                                <a id="pr__contact" href="pr__application__form" class="button uk-button uk-button-large uk-button-default" data-uk-toggle=""><?php echo $footer['contactButton']; ?></a>
                            </div>
                        </div>
                        <div class="pr__social column">
                            <div class="inner">
                                <a href="#" class="icon pr-logo-facebook"></a>
                                <a href="#" class="icon pr-logo-linkedin"></a>
                  
                            </div>
                        </div>
                    </div>
                </div><!-- Inner End-->
            </div><!-- Container End-->
        </div><!-- Outer End-->
    </div><!-- Footer Top End-->
    <div class="pr__footer__center uk-section uk-section-small novaMapa">
       
     <!--        <ul>
                <li <?php if($_SESSION['lang'] == "De") {?>  style="display:none;" <?php } ?>><a href="tel:00385996666556">Zagreb (Cro),  Saša<span class="phone">(+385) 99 6666 556 </span></a></li>
                <li <?php if($_SESSION['lang'] == "De") {?>  style="display:none;" <?php } ?>><a href="tel:0038763281058">Bihać (BiH), Elvis<span class="phone">(+387) 63 281 058</span></a></li>
                 <li <?php if($_SESSION['lang'] == "De") {?>  style="display:block;" <?php } else { ?>style="display:none;" <?php } ?> ><a href="#">Munich, Ger Zlata<span class="phone">+661 041 4755</span></a></li> 
            </ul> -->

            <div id="HelloPageContent" class="activeDisplayedPage">
    <div class="darkGrayBackground">
       
       <div class="wholeWidthContainer headerHelloMapBody bkgDefaultPosition">
           <div class="container" >
               <div class="row" style="height: 460px; justify-content:center;  ">
                   <!-- LEFT INFO -->
                   <div class="col-md-5 col-md-offset-2 divWorldLeftInfo" <?php if($_SESSION['lang'] == "De") {?>  style="display:none;" <?php } ?>>
                       <div class="row" style="justify-content:center;">
                           <div class="col-md-offset-1 mapBoxes">
                               <div class="row rowPosition" style="padding-top: 50px; justify-content:center;">
                                   <div class="col-md-1 col-md-offset-0 divPin">
                                       <span class="pinCalifornia h_location2"></span>
                                   </div>
                                   
                                   <ul class="footerUL" style="text-align:center">
                                   
                                   <li class="footerLI" <?php if($_SESSION['lang'] == "De") {?>  style="display:none;" <?php } ?>><a href="tel:00385996666556">Zagreb (Cro),  Saša<span class="phone">(+385) 99 6666 556 </span></a></li>

                                 </ul>
                                
                              
                               </div>
                            
                          
                           
                              
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-md-offset-1 col-md-12">
                               <div id="divLeftHidden" style="display: none; height: 190px;">
                                   <div class="row rowMail" style="justify-content:center; align-items:center;">
                                       <div class="col-md-1 col-md-offset-0 divMailIcon" style="padding-top: 6px;">
                                           <span class="h_mail"></span>
                                       </div>
                                       <div class="fontSize16 sourceSansProFont col-md-12 col-md-offset-0" style="text-align:center;"><a class="colorGreen" href="mailto:office@geosoft-studio.com"><span class="mapaSpan" style="color:#E9204F; font-weight:bold"><?php echo $mail; ?></span></a></div>
                                   </div>
                              
                                  
                                   <div class="footerAddInfo" style="color:#E9204F; font-weight:bold;">Zagreb</div>
                               <div class="footerAddInfo" style="color:#E9204F; font-weight:bold;">Croatia</div>
                               <div class="footerAddInfo" style="color:#E9204F; font-weight:bold;">ul.Petrovaradinska 1</div>
                               <div class="footerAddInfo"> <a  class="button uk-button uk-button-large uk-button-default footerBtnMap" onclick="showMap()" style="opacity: 1; transform: translateY(0px);margin-top:10px;"><?php echo $footer['mapButton']; ?></a></div>
                               </div>
                           </div>
                       </div>
                   </div> 
                   <!-- RIGHT INFO -->
                  <div class="col-md-5 divWorldRightInfo" <?php if($_SESSION['lang'] == "De") {?>  style="display:none;" <?php } ?>>
                       <div class="row" style="justify-content:center;">
                           <div class="col-md-offset-1 mapBoxes">
                               <div class="row rowPosition" style="padding-top: 50px; justify-content:center;">
                                   <div class="col-md-1 col-md-offset-0 divPin">
                                       <span class="pinSarajevo h_location2"></span>
                                   </div>
                                                            
                                <ul >
                                   
                                    <li class="footerLI" <?php if($_SESSION['lang'] == "De") {?>  style="display:none;" <?php } ?>><a href="tel:0038763281058">Bihać (BiH), Elvis<span class="phone">(+387) 63 281 058</span></a></li>
          
                                </ul>
                              
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-md-offset-1 col-md-12">
                               <div id="divRightHidden" style="display: none; height: 190px;">
                                   <div class="row rowMail">
                                       <div class="col-md-1 col-md-offset-0 divMailIcon" style="padding-top: 6px;">
                                           <span class="h_mail"></span>
                                       </div>
                                       <div class="fontSize16 sourceSansProFont col-md-12 col-md-offset-0" style="text-align:center;"><a class="colorGreen" href="mailto:office@geosoft-studio.com"><span class="mapaSpan" style="color:#E9204F;font-weight:bold;"><?php echo $mail; ?></span></a></div>
                                   </div>
                               <div class="footerAddInfo" style="color:#E9204F; font-weight:bold;">Bihać</div>
                               <div class="footerAddInfo" style="color:#E9204F; font-weight:bold;">Bosnia & Herzegovina</div>
                               <div class="footerAddInfo" style="color:#E9204F; font-weight:bold;">ul. Jablanska bb</div>
                               <div class="footerAddInfo" style="color:#E9204F; font-weight:bold;"> <a  class="button uk-button uk-button-large uk-button-default footerBtnMap" onclick="showMap2()" style="opacity: 1; transform: translateY(0px);margin-top:10px;"><?php echo $footer['mapButton']; ?></a></div>
                              
                           </div>
                       </div>
                   </div> 
                   <!-- NJEMACKI -->
                   <div class="col-md-4 col-md-offset-2 divWorldLeftInfo" <?php if($_SESSION['lang'] == "De") {?>  style="display:block;" <?php } else { ?>style="display:none;" <?php } ?> >
                       <div class="row" >
                           <div class="col-md-offset-1 mapBoxes">
                               <div class="row rowPosition" style="padding-top: 70px;">
                                   <div class="col-md-1 col-md-offset-0 divPin">
                                       <span class="pinCalifornia h_location2"></span>
                                   </div>
                                   <ul >
                                   
                                   <li <?php if($_SESSION['lang'] == "De") {?>  style="display:block;" <?php } else { ?>style="display:none;" <?php } ?> ><a href="#">Munich, Ger Zlata<span class="phone">+661 041 4755</span></a></li> 

                               </ul>
                               </div>
                            
                          
                           
                              
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-md-offset-1 col-md-12">
                               <div id="divLeftHidden" style="display: none; height: 170px;">
                                   <div class="row rowMail" style="justify-content:center; align-items:center;">
                                       <div class="col-md-1 col-md-offset-0 divMailIcon" style="padding-top: 6px;">
                                           <span class="h_mail"></span>
                                       </div>
                                       <div class="fontSize16 sourceSansProFont col-md-12 col-md-offset-0" style="text-align:center;"><a class="colorGreen" href="mailto:office@geosoft-studio.com"><span style="color:#E9204F;"><?php echo $mail; ?></span></a></div>
                                   </div>
                              
                                   <div class="footerAddInfo">ul.Petrovaradinska 1, Zagreb, Hr</div>
                       
                               </div>
                           </div>
                       </div>
                   </div>





               </div>
           </div>
       </div>
   </div>
   </div>
        
<!--  </div class="mapContainer">
<a class="button uk-button uk-button-default mapButton" onclick="showMap()" style="opacity: 1; transform: translateY(0px);"><?php echo $footer['mapButton']; ?></a>-->
<div id="ourMap" class="" style="display:none">
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d5563.5768782906!2d15.90861!3d45.795466!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4765d14ffcc31619%3A0x63abe6dce806e791!2sPetrovaradinska%20ul.%201%2C%2010000%2C%20Zagreb!5e0!3m2!1sen!2shr!4v1588268315612!5m2!1sen!2shr" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen ></iframe>
</div> 
<div id="ourMap2" class="" style="display:none">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2829.269961122147!2d15.879517741162788!3d44.83643531114592!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4761406291b04c89%3A0x984b305759fddeca!2sJablanska!5e0!3m2!1sbs!2sba!4v1590865476543!5m2!1sbs!2sba" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div> 
    <div class="pr__footer__bottom uk-section">
        <div class="section-outer">
            <div class="uk-container ">
      
            <div class="section-inner">
                                <div class="columns uk-grid" data-uk-grid="">
                                    <div class="pr__links column">
                                        <div class="inner">
                                            <a href="https://geosoft-studio.com/privacy.php"><?php echo $footer['privacy']; ?></a>
                                        </div>
                                    </div>
                                    <div class="pr__copyrights column uk-first-column">
                                        <div class="inner">
                                        <p>1990 - 2020 © <a href="index.php">Geosoft d.o.o.</a> <?php echo $footer['copyright']; ?></p> 
                                        </div>
                                    </div>
                                </div>

            
            </div><!-- Container End-->
        </div><!-- Outer End-->
    </div><!-- Footer Bottom End-->

</footer><!-- Site Footer End-->

</div><!-- Site Wrapper End -->

<?php include "components/application.php" ?>
                

        <!-- Needed Scripts -->
        <script src="./assets/js/jquery.min.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
        <script src="./assets/js/anime.min.js"></script>
        <script src="./assets/js/scroll.js"></script>
        <script src="./assets/js/pr.animation.js"></script>
        <script src="./assets/js/uikit.js"></script>
        <script src="./assets/js/owl.carousel.min.js"></script>
        <script src="./assets/js/validate.js"></script>
        <script src="./assets/js/main.js"></script>
        <script src="./assets/js/simple-lightbox.min.js"></script>
        <script src="./assets/js/rebbon.js"></script> 
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        <canvas width="1920" height="888" style="display: block; position: fixed; margin: 0px; padding: 0px; border: 0px; outline: 0px; left: 0px; top: 0px; width: 100%; height: 100%; z-index: -1;"></canvas>
    
        <script>
        (function() {
          var lightbox = new SimpleLightbox('.galerija a', { /* options */ });
       })();
   </script>

     <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LdOePQUAAAAAB3h1FC0GNsxFOz5P0zMAueX_S8u', {action: 'homepage'}).then(function(token) {
            document.getElementById("g-token").value = token;
            document.getElementById("g-token2").value = token;
            });
        });

        function showMap()
		{
			if(document.getElementById("ourMap").style.display=="block") {
				document.getElementById("ourMap").style.display="none";

            } 

			else {
				document.getElementById("ourMap").style.display="block";
                document.getElementById("ourMap2").style.display="none";
            }
		}

        function showMap2()
		{
			if(document.getElementById("ourMap2").style.display=="block") {
				document.getElementById("ourMap2").style.display="none";

            } 

            else {
				document.getElementById("ourMap2").style.display="block";
                document.getElementById("ourMap").style.display="none";
            }
		}
        </script>


</body></html>