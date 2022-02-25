jQuery(document).ready(function($) {

	// 'use strict';

  //***************************
    // Url base class add
    //***************************

  var path = window.location.pathname.split("/").pop();      
  var target = jQuery('a[href="'+path+'"]');
  target.addClass('mm-active');

  $('.mm-active').parents('ul').addClass('mm-show');
  $('.mm-show').parents('li').addClass('mm-active');

  // end

});




