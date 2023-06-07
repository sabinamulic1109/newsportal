(function ($) {
	"use strict";

    jQuery(document).ready(function($){
		
		// Wow JS Active Code
		new WOW().init();
		
		// Counter Up JS Active Code
		$('.count').counterUp({
		    delay: 10,
		    time: 5000
		});
		
		// About Area Height Fix
		var height = $('.about-content').height();
        $('.about-profile img').css('height', height + 'px');

		

		// Owl Carousel Active Code
		$(".testimonial-list").owlCarousel({
			items: 1,
			loop: true,
			autoplay: true,
			smartSpeed: 1000
		});

        // Jquery Smooth Scroll        
        $('li.smooth-menu a').bind('click', function(event) {
            var $anchor = $(this);
            var headerH = '60';

        $('html, body').stop().animate({
            scrollTop : $($anchor.attr('href')).offset().top - headerH + 'px'}, 1200, 'easeInOutExpo');
            event.preventDefault();
		});

		// Jquery Function for Hide "in" Class
        $('.main-menu li a').on('click', function(){
            $('.navbar-collapse').removeClass('in');  
		});

			

    });

	// Add fixedMenu
	$(window).on('scroll', function () {
		if ($(window).scrollTop() > 250) {
			$('#header-area').addClass('fixedMenu-bg');
		} else {
			$('#header-area').removeClass('fixedMenu-bg');
		}
	});

	// Remove Preloader After Load Full Site 
	$(window).on('load', function() {
		$('.hazard-preloader-wrap').fadeOut(500);
	});

}(jQuery));