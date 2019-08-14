// Call To Actions Animations
$(function() {
  $(".cta-title").css("opacity","0");

  $(".cta-block").hover(function () {
    $(this).find(".text .cta-title").stop().animate({
      opacity: 1
    }, 250);
    $(this).find(".link .link-text").stop().animate({
      opacity: 0
    }, 250);
  },
  function () {
    $(this).find(".text .cta-title").stop().animate({
      opacity: 0
    }, 250);
    $(this).find(".link .link-text").stop().animate({
      opacity: 1
    }, 250);
  });
});


// Homepage
var contentHeight = $(window).height(),
		contentHeight404 = contentHeight - 300,
		width = window.innerWidth;

function setLandingHeight() {
	$('.landing-page-content').css("height", contentHeight+"px");
	$('#error').css("height", contentHeight404+"px");
	if(width >= 768 ) {
		$('.home #wrapper').css("padding-top", (contentHeight - 145)+"px");
	}
	if(width > 768) {
		$('.home #wrapper').css("padding-top", contentHeight+"px");
	}

}

// On Document Ready
$(document).ready(function(){

	// Mobile Trigger 
	var trigger =  $('.trigger'),
			header = $('#mobile-header');

  trigger.click(function() {
  	// Open Close Main Navigation
    header.toggleClass('open');
    // Add Menu Trigger Animation Class
    $(this).toggleClass('open');
  });


  // Click to scroll fun
	$("#scroll").click(function() {
	    $("html, body").animate({
	        scrollTop: $("#header").offset().top
	    }, 750);
	});


	var headerheight = $('.header-wrap').height();

	$(window).scroll(function () {
		var header = $(".home #header"),
		    scroll = $(window).scrollTop();

		// Sticky Header
		if(width > 768 ) { 
			if (scroll >= contentHeight) {
				header.addClass('fixed');
				$('.home .container').css('padding-top', 155);
			}
			else {
				header.removeClass('fixed');
				$('.home .container').css('padding-top', 0);
			}
		}

	});

	// Contact Page
	$("#form_eqxtu").submit(function() {
		$('.office-hours').css('display', 'none');
		$('.address-container').css('display', 'none');
		$('#form_eqxtu').css('display', 'none');
		$('#form-and-hours .background-wrap').addClass('thanks');
	});

	// Header size helpers.
	if(width >= 768) { // Only add padding over tablet size
		
		if($('body').hasClass('home')) {
			$('#main-page-content').css('height', headerHeight+"px");
		}
		if($('body').hasClass('page-template-floor-plans')) {
			$('#floorplans .categories').css('height', headerHeight+"px");
			$('#floorplans .stripes').css('height', headerHeight+"px");
		}
		if($('body').hasClass('page-amenities')) {
			$('#main-page-content').css('height', headerHeight+"px");
			$('#list-background-image').css('padding-top', headerHeight+"px");
		}
		if($('body').hasClass('page-features')) {
			$('#main-page-content').css('height', headerHeight+"px");
			$('#list-background-image').css('padding-top', headerHeight+"px");
		}
		if($('body').hasClass('page-area')) {
			var mapHeight = $('#map-container').height();
			$('#main-page-content').css('padding-top', mapHeight+"px");
		}
		if($('body').hasClass('page-contact')) {
			$('#main-page-content').css('height', headerHeight+"px");
			$('#form-and-hours').css('padding-top', headerHeight+"px");
		}
	}

	$("#mobile-specials-button").on({
	  click:function(){
	    $("#mobile-specials-container").toggleClass("show");
	  }
	});

	$("#specials-button").on({
	  click:function(){
	    $("#specials-container").toggleClass("show");
	  }
	});

	// Run functions
  setLandingHeight();
});


// On Window resize
$(window).on({
  resize:function(){
    setLandingHeight();
  }
})