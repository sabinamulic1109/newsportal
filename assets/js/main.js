jQuery(document).ready(function ($) {
    "use strict";

    // Preloader
    // ------------------------------------------------------
      $(window).on('load', function () {
        anime.timeline({
                targets: '.preloader',
                easing: 'easeOutExpo',
            })
            .add({
                height: ['100vh', '0vh'],
                duration: 700,
                delay: 2000,
            })
            .add({
                offset: '-=400',
                complete: function (anim) {
                    document.querySelector('.preloader').remove();
                }
            })
            .add({
                offset: '-=1300',
                targets: '#site-wrapper',
                top: 0,
                duration: 700,
            })

        anime.timeline({
                easing: 'easeOutExpo',
            })
            .add({
                targets: '.preloader .txt',
                delay: 100,
                opacity: 1,
                duration: 700,
                translateY: ["30px", "0px"],
            })
            .add({
                targets: '.preloader .progress',
                offset: '-=400',
                opacity: 1,
                duration: 700,
            })
            .add({
                targets: ".preloader .progress .bar-loading",
                offset: '-=400',
                duration: 2000,
                width: ["0", "100%"],
            })
            .add({
                targets: '.preloader .loading',
                offset: '-=900',
                opacity: 0,
                duration: 1000,
                translateY: ["0", "-100px"],
            })
    }); 

    // Main Sliders
    // ------------------------------------------------------

    $(".owl-carousel").each(function (index) {
        var items = $(this).data('items'),
            autoplay = $(this).data('autoplay'),
            margin = $(this).data('margin'),
            loop = $(this).data('loop'),
            center = $(this).data('center'),
            dots = $(this).data('dots'),
            nav = $(this).data('nav');
        $(this).owlCarousel({
            items: items,
            autoplay: autoplay,
            margin: margin,
            autoplayHoverPause: true,
            smartSpeed: 450,
            loop: loop,
            center: center,
            dots: dots,
            dotsEach: true,
            nav: nav,
            responsive: {
                0: {
                    items: 1
                },
                640: {
                    items: 1
                },
                960: {
                    items: 2
                },
                1200: {
                    items: 3
                },
                1600: {
                    items: items
                }
            }
        });
    });

    // Contact Form Validate JS
    // ------------------------------------------------------

/*     if ($('.pr__contact').length) {
        $('.pr__contact').validate({ // Initialize the plugin
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                subject: {
                    required: true
                },
                message: {
                    required: true
                }
            },

        }); 
   }  */




}); 


/* CUSTOM JS */







    /* global $ */
    $(document).ready(function(){

        $('.pr__contact').validate({ // Initialize the plugin
            onfocusout: false,
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                subject: {
                    required: true
                },
                message: {
                    required: true
                },
            },
    
            submitHandler: function(form) {

                 
                        $.ajax({
                            dataType:'text',
                            url:'mail.php',
                            type: 'POST',
                            data: $('#contactForm').serialize(),
                            beforeSend:function(xhr) {
                
                               $('#submit').html('<div class="loaderCstm"></div>');
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Thank you for contacting Geosoft Digital Agency',
                                    'Someone will contact you soon!',
                                    )
                                    $('#contactForm').find('input[type="text"]').val('');
                                    $('#contactForm').find('input[type="email"]').val('');
                                    $('#contactForm').find('select').val('');
                                    $('#contactForm').find('textarea').val('');
                            }, 
                
                            error: function(){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!',
                                  })
                              },
                            complete: function() {
                                $('#submit').html('Send a message');
                            }
                        })
                       
               

          }
        }); 

       
    });  



  $(document).ready(function(){
  
  

        $('.pr__application').validate({ // Initialize the plugin
            onfocusout: false,
            rules: {
                name2: {
                    required: true
                },
                email2: {
                    required: true,
                    email: true
                },
         
            },

            submitHandler: function(form) {
            
                var fd = new FormData(form);
           
                    
                        $.ajax({
                            dataType:'text',
                            url:'apply.php',
                            type: 'POST',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: fd,
                     
                            beforeSend:function(xhr) {
                
                               $('#appsubmit').html('<div class="loaderCstm"></div>');
                            },
                            success: function(response) {
                              
                                Swal.fire(
                                    'Thank you for contacting Geosoft Digital Agency',
                                    'Someone will contact you soon!',
                                    )
                                    $('#applicationForm').find('input[type="text"]').val('');
                                    $('#applicationForm').find('input[type="email"]').val('');
                                    $('#applicationForm').find('select').val('Select a position');
                                    $('#applicationForm').find('input[type="file"]').val('');
                            }, 
                
                            error: function(){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!',
                                  })
                              },
                            complete: function() {
                                $('#appsubmit').html('Submit Application');
                            }
                        })
                  
                        return false; 

          }
        }); 

       
    });  












    
    $(document).ready(function(){
        $('#language_custom-select').change(function() {
        var optionValue =  $('#language_custom-select').val();
        $.ajax({
            url:'switch.php',
            method: 'POST',
            data: {selected: optionValue},
        }).done(function(data) {
            window.location.reload();
        })
    }) 


    });  
    $(document).ready(function(){
        $('#language_custom-select2').change(function() {
        var optionValue =  $('#language_custom-select2').val();
        $.ajax({
            url:'switch.php',
            method: 'POST',
            data: {selected: optionValue},
        }).done(function(data) {
            window.location.reload();
        })
    }) 


    });  





/*    const links = document.querySelectorAll(".mobile-links")
   const navMobile = document.querySelector("#navbar-mobile");
   const canvas = document.querySelector(".uk-offcanvas-bar");
    links.forEach(link => link.addEventListener('click', () => {
        navMobile.style.display = 'none';
        navMobile.classList.remove("uk-offcanvas-overlay");
        navMobile.classList.remove("uk-open");
        canvas.classList.remove("uk-offcanvas-none");

    }))  */


   
    $(document).ready(function () {
        //HELLO MAP PART
        $(".divWorldLeftInfo").hover(
            function () {
                if ($(this).attr("tag") != "clicked") {
                    $(this).css("background", "rgba(40, 41, 42, 0.7)");
                    $("#divLeftHidden").slideDown();
                    $(this).find("span.h_location2").removeClass("h_location2").addClass("h_location");

                    if ($(window).width() <= 768)
                        return;

                    var left = $(this).find(".pinCalifornia").offset().left;
                    var bkgPositionX = left - 183;                        
                    $(".headerHelloMapBody").css("background-position", bkgPositionX + "px -140px");                                                
                }
            }, function () {
                if ($(this).attr("tag") != "clicked") {
                    $(this).css("background", "transparent");
                    $("#divLeftHidden").css("display", "none");
                    $(this).find("span.h_location").removeClass("h_location").addClass("h_location2");

                    if ($(window).width() <= 768)
                        return;

                    if ($(".divWorldRightInfo").attr("tag") != "clicked") {
                        $(".headerHelloMapBody").css("background-position", "0px 0px");                            
                    }
                    else {
                        var left = $(".pinSarajevo").offset().left;
                        var bkgPositionX = left - 955;
                        $(".headerHelloMapBody").css("background-position", bkgPositionX + "px -65px");
                    }
                }
            });

        $(".divWorldLeftInfo").click(function () {
            if ($(this).attr("tag") != "clicked") {
                $(this).css("background", "rgba(40, 41, 42, 0.7)");
                $("#divRightHidden").slideDown();
                $(this).attr("tag", "clicked");
                $(this).find("span.h_location2").removeClass("h_location2").addClass("h_location");

                $(".divWorldRightInfo").css("background", "transparent");
                $(".divWorldRightInfo").removeAttr("tag");
                $("#divRightHidden").css("display", "none");
                $(".divWorldRightInfo").find("span.h_location").removeClass("h_location").addClass("h_location2");

                if ($(window).width() <= 768)
                    return;

                var left = $(this).find(".pinCalifornia").offset().left;
                var bkgPositionX = left - 183;
                $(".headerHelloMapBody").css("background-position", bkgPositionX + "px -140px");
            }
            else {
                $(this).css("background", "transparent");
                $(this).removeAttr("tag");
                $("#divLeftHidden").css("display", "none");
                $(this).find("span.h_location").removeClass("h_location").addClass("h_location2");

                $(".headerHelloMapBody").css("background-position", "0px 0px");
            }
        });

        //RIGHT PART
        $(".divWorldRightInfo").hover(
         function () {
             if ($(this).attr("tag") != "clicked") {
                 $(this).css("background", "rgba(40, 41, 42, 0.7)");
                 $("#divRightHidden").slideDown();
                 $(this).find("span.h_location2").removeClass("h_location2").addClass("h_location");

                 if ($(window).width() <= 768)
                     return;

                 var left = $(this).find(".pinSarajevo").offset().left;
                 var bkgPositionX = left - 955;
                 $(".headerHelloMapBody").css("background-position", bkgPositionX + "px -65px");
             }
         }, function () {
             if ($(this).attr("tag") != "clicked") {
                 $(this).css("background", "transparent");
                 $("#divRightHidden").css("display", "none");
                 $(this).find("span.h_location").removeClass("h_location").addClass("h_location2");

                 if ($(window).width() <= 768)
                     return;

                 if ($(".divWorldLeftInfo").attr("tag") != "clicked") {
                     $(".headerHelloMapBody").css("background-position", "0px 0px");                         
                 }
                 else {
                     var left = $(".pinCalifornia").offset().left;
                     var bkgPositionX = left - 183;

                     $(".headerHelloMapBody").css("background-position", bkgPositionX + "px -140px");
                 }
             }
         });

        $(".divWorldRightInfo").click(function () {
            if ($(this).attr("tag") != "clicked") {                    
                $(this).css("background", "rgba(40, 41, 42, 0.7)");
                $(this).attr("tag", "clicked");
                $("#divRightHidden").slideDown();
                $(this).find("span.h_location2").removeClass("h_location2").addClass("h_location");

                $(".divWorldLeftInfo").css("background", "transparent");
                $(".divWorldLeftInfo").removeAttr("tag");
                $("#divLeftHidden").css("display", "none");
                $(".divWorldLeftInfo").find("span.h_location").removeClass("h_location").addClass("h_location2");

                if ($(window).width() <= 768)
                    return;

                var left = $(this).find(".pinSarajevo").offset().left;
                var bkgPositionX = left - 955;
                $(".headerHelloMapBody").css("background-position", bkgPositionX + "px -65px");
            }
            else {
                $(this).css("background", "transparent");
                $(this).removeAttr("tag");
                $("#divRightHidden").css("display", "none");
                $(this).find("span.h_location").removeClass("h_location").addClass("h_location2");

                if ($(window).width() <= 768)
                    return;

                $(".headerHelloMapBody").css("background-position", "0px 0px");
            }
        });
    });

    