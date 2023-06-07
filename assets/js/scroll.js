  
/* SMOOTH SCROLL*/
jQuery(document).ready(function () {
    
  $("a.smooth-scroll").click(function(e) {
    e.preventDefault()
    //Get section ID like #about itd...
    var section_id = $(this).attr("href");
    $("html, body").animate({
      scrollTop:$(section_id).offset().top 
    }, 1250)
})
}) 
/* SMOOTH SCROLL END*/
