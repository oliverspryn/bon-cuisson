(function($) {
	$(document).bind('mobileinit', function() {
		$.mobile.defaultPageTransition = 'slide';
	});
	
/**
 * This code will load all of the internal pages within the DOM of an HTML element
 * and transition the first one into place, just as the "standard" way of loading
 * a page, but it includes all internal pages
*/

	$(document).bind('pageload', function(event, ui) {
	//Find all of the pages and dialogs in the DOM
		var response = ui.xhr.responseText;
		var data = $(response).filter('section[data-role="page"], section[data-role="dialog"]');
	
	//Make sure that the given psuedo page does not already exist before adding it
	//Skip the first matched element, since jQM automatically inserted it for us
		for (var i = 1; i <= data.length - 1; i++) {
			var current = data.eq(i);
			
			if (current.attr('id') && !document.getElementById(current.attr('id'))) {
				current.appendTo('body');
			}
		}
	});
})(jQuery);