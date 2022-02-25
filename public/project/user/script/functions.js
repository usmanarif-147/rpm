jQuery(document).ready(function($) {

	'use strict';
    //***************************
    // Sticky Header Function
    //***************************
	  jQuery(window).scroll(function() {
	      if (jQuery(this).scrollTop() > 30){  
	          jQuery('body').addClass("st-sticky");
	      }
	      else{
	          jQuery('body').removeClass("st-sticky");
	      }
	  });

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

// End
});