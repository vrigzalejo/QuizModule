$(function() {
	$(document).foundation({
		offcanvas: {
			open_method: 'move',
			close_on_click: true
		}
	});
	$.ajaxSetup({
		headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		}
	});
});