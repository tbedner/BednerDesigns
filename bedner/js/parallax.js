$(document).ready(function() {
   
	$('a.home').click(function(){
    	$('html, body').animate({
    		scrollTop:0
    	}, 1000, function() {
	    	parallaxScroll(); // Callback is required for iOS
		});
    	return false;
	});
    $('a.whatwedo').click(function(){
    	$('html, body').animate({
    		scrollTop:$('#whatwedo').offset().top
    	}, 1000, function() {
	    	parallaxScroll(); // Callback is required for iOS
		});
    	return false;
    });
	$('a.about').click(function(){
    	$('html, body').animate({
    		scrollTop:$('#about').offset().top
    	}, 1000, function() {
	    	parallaxScroll(); // Callback is required for iOS
		});
    	return false;
	});
/*    $('a.service').click(function(){
    	$('html, body').animate({
    		scrollTop:$('#service').offset().top
    	}, 1000, function() {
	    	parallaxScroll(); // Callback is required for iOS
		});
    	return false;
    }); */
    $('a.portfolio').click(function(){
    	$('html, body').animate({
    		scrollTop:$('#portfolio').offset().top
    	}, 1000, function() {
	    	parallaxScroll(); // Callback is required for iOS
		});
    	return false;
    });
     $('a.contact').click(function(){
    	$('html, body').animate({
    		scrollTop:$('#contact').offset().top
    	}, 1000, function() {
	    	parallaxScroll(); // Callback is required for iOS
		});
    	return false;
    });


});

/* Scroll the background layers */
function parallaxScroll(){
	var scrolled = $(window).scrollTop();
}

