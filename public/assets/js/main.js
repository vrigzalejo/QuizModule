(function(){
	/**
	 * Menu settings
	 */
	$('#menuToggle, .menu-close').on('click', function(){
		$('#menuToggle').toggleClass('active');
		$('body').toggleClass('body-push-toleft');
		$('#theMenu').toggleClass('menu-open');
	});
	$.ajaxSetup({
		headers: {
		'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		}
	});			
	$(document).on('scroll', function() {
		if($(window).scrollTop() > 100) {
			$('.scroll-top-wrapper').addClass('show');
		} else {
			$('.scroll-top-wrapper').removeClass('show');
		}
	});
	$('.scroll-top-wrapper').on('click', scrollToTop);
	$.stellar({
		horizontalScrolling: false,
		verticalOffset: 40
	});
	$(document).ready(function() {
		$('html').niceScroll({
			touchbehavior: true
		});
	});
})(jQuery)
function scrollToTop() {
    verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
    element = $('body');
    offset = element.offset();
    offsetTop = offset.top;
    $('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
}
