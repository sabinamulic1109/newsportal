<div class="pr__mobile__nav uk-offcanvas" id="navbar-mobile" data-uk-offcanvas="overlay: true; flip: true; mode: none">
            <div class="uk-offcanvas-bar">
    
                <button class="uk-offcanvas-close uk-close uk-icon" type="button" data-uk-close="ratio: 2;"><svg width="28" height="28" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg"></svg></button>

                <nav class="menu" data-uk-scrollspy-nav="offset: 0; closest: li; scroll: true">
                    <ul data-uk-scrollspy="target: &gt; li; cls:uk-animation-slide-right; delay: 100; repeat: true;">
                        <li class="" style="visibility: hidden;"><a class="mobile-links mapaFix" href="<?php echo URLROOT2;?>/index.php"><?php echo $menu['home']; ?></a></li>
                        <li class="" style="visibility: hidden;"><a class="mobile-links mapaFix" href="<?php echo URLROOT2;?>/services.php"><?php echo $menu['services']; ?></a></li>
                        <li class="" style="visibility: hidden;"><a class="mobile-links mapaFix" href="<?php echo URLROOT2;?>/work.php"><?php echo $menu['works']; ?></a></li>
                        <li class="" style="visibility: hidden;"><a class="mobile-links mapaFix" href="<?php echo URLROOT2;?>/index.php#pr__about"><?php echo $menu['about']; ?></a></li>
                        <li class="" style="visibility: hidden;"><a class="mobile-links mapaFix" href="<?php echo URLROOT2;?>/careers.php"><?php echo $menu['career']; ?></a></li>
                        <li class="" style="visibility: hidden;"><a class="smooth-scroll mobile-links mapaFix" href="#site-footer"><?php echo $menu['contact']; ?></a></li>
                        <li>
                        <div class="lang langMobile" style="opacity: 1; transform: translateX(0px);">
                                    <div data-uk-form-custom="target: true" class="uk-form-custom">
                                        <select class="custom-select custom-select-mobile"  id="language_custom-select2">
                                            <option class="custom-option" hidden> <?php echo $_SESSION['lang']?></option>
                                            <option class="custom-option" value="En"> En</option>
                                           <!-- <option class="custom-option" value="De"> De </option>-->
											 <option class="custom-option" value="Hr">Hr</option>
                                        </select>
			
                                        <span><?php echo $_SESSION['lang']?></span>
                                        <i class="icon pr-chevron-down"></i>
                            </div>
                        </div>




                        </li>
                    </ul>
                </nav>
  
            </div><!-- Off Canvas Bar End -->
        </div><!-- Mobile Nav End -->