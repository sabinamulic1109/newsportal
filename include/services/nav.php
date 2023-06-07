<div class="navbar pr-font-second">
                                <nav class="menu bigZ" data-uk-scrollspy-nav="offset: 0; closest: li; scroll: true">
                                    <ul>
                                        <li class="servNav" style="opacity: 1; transform: translateX(0px);"><a class="mapaFix" href="<?php echo URLROOT2;?>/index.php"><?php echo $menu['home']; ?></a></li>
                                        <li class="servNav" style="opacity: 1; transform: translateX(0px);"><a class="mapaFix" href="<?php echo URLROOT2;?>/services.php"><?php echo $menu['services']; ?></a></li>
                                        <li class="servNav" style="opacity: 1; transform: translateX(0px);"><a class="mapaFix" href="<?php echo URLROOT2;?>/work.php"><?php echo $menu['works']; ?></a></li>
                                        <li class="servNav" style="opacity: 1; transform: translateX(0px);"><a class="mapaFix" href="<?php echo URLROOT2;?>/index.php#pr__about"><?php echo $menu['about']; ?></a></li>
                                        <li class="servNav" style="opacity: 1; transform: translateX(0px);"><a class="mapaFix" href="<?php echo URLROOT2;?>/careers.php"><?php echo $menu['career']; ?></a></li>
                                        <li class="servNav" style="opacity: 1; transform: translateX(0px);"><a class="mapaFix" class="smooth-scroll" href="#site-footer"><?php echo $menu['contact']; ?></a></li>
                                    </ul>
                                </nav>
                                <div class="lang" style="opacity: 1; transform: translateX(0px);">
                                    <div data-uk-form-custom="target: true" class="uk-form-custom">
                                    <select class="custom-select"  id="language_custom-select">
                                            <option class="custom-option" hidden> <?php echo $_SESSION['lang']?></option>
                                            <option class="custom-option" value="En"> En</option>
                                           <!-- <option class="custom-option" value="De"> Ge </option>-->
											<option class="custom-option" value="Hr">Hr</option>
                                        </select>
                                        <span>En</span>
                                        <i class="icon pr-chevron-down"></i>
                                    </div>
                                </div>
                            </div>

<!--                             <script>
    const servNav = document.querySelectorAll(".servNav")

        if(servNav) {
            servNav.forEach(nav => {
                nav.classList.remove("uk-active")
                console.log(nav)
            })
        }

        </script> -->