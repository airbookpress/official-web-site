/* global screenReaderText */
/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 *
 * @version 1.0.1
 */

( function($) {


	// Fade content in, if page loaded.
	$( window ).load( function() {

		// hide load overlay content
		$( '.load-overlay' ).delay( 500 ).animate( {
			'opacity': 0,
			'duration': 'slow'
		}, 1500 );

		// Show content
		$( '#container' ).delay( 500 ).animate( {
			'opacity': 1,
			'duration': 'slow'
		}, 1500 );

	});


	// Overlay (main menu + widget area) open/close
	$('#overlay-open').on( 'click', function () {
		$('#overlay-wrap').fadeIn('fast', 'linear');
		$('html').addClass('overlay-show');
		$('body').addClass('overlay-show');
    });

    $('#overlay-close').on( 'click', function () {
	    $('#overlay-wrap').fadeOut('fast', 'linear');
		$('html').removeClass('overlay-show');
		$('body').removeClass('overlay-show');
    });

    // Toggle blog front page post title
    $('.blog .hentry').hover(function () {
	    if ( $(window).width() >= 1025) {
			//Add your javascript for large screens here
			$(this).find('.entry-header').slideToggle(200);
		}
		else {
	}
	});


	// Site Navigation Hovers
	$('.home-link').on( 'hover', function () {
		$('body').toggleClass('show-nav');
    });

    $('#overlay-open').on( 'hover', function () {
		$('body').toggleClass('show-nav');
    });


	// Scroll Left Button on Front page
	var distance = 900;
	$("#scroll-left-btn").click(function() {
	    $("html:not(:animated), body:not(:animated)").animate(
	        {scrollLeft: "+="+distance}, 600
	    );
	});


	// Smooth Scroll
	$(function() {
	  $('a[href*=#]:not([href=#])').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        $('html,body').animate({
	          scrollTop: target.offset().top
	        }, 600);
	        return false;
	      }
	    }
	  });
	});


} )( jQuery );
