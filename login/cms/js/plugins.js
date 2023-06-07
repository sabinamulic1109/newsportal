/*================================================================================
  Item Name: Materialize - Material Design Admin Template
  Version: 3.1
  Author: GeeksLabs
  Author URL: http://www.themeforest.net/user/geekslabs
================================================================================*/

$(function() {

  "use strict";

  var window_width = $(window).width();


  // Materialize sideNav  

  //Main Left Sidebar Menu
  $('.sidebar-collapse').sideNav({
    edge: 'left', // Choose the horizontal origin    
  });

  //Trending chart for small screen
  if(window_width <= 480){    
    $("#trending-line-chart").attr({
      height: '200'
    });
  }
  
  /*
  * Advanced UI 
  */
  
  
         
    



}); // end of document ready