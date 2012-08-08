(function($) {
	$(document).delegate('.ui-page', 'pageinit', function() {
	/**
	 * This code will load all of the internal pages within the DOM of an HTML element
	 * and transition the first one into place, just as the "standard" way of loading
	 * a page, but it includes all internal pages
	*/
	
		$(this).find('a.multi-page-link').bind('click', function(event) {
			event.preventDefault();
			event.stopPropagation();
			
			var URL = $(this).attr('href');
			
		//Show the loading spinner
			$.mobile.showPageLoadingMsg();
			
		//Perform the AJAX request
			$.ajax({
				dataType : 'html',
				url : URL,
				success : function(data) {
				//Find all of the pages and dialogs in the DOM
					var loadedPageElements = $(data).filter('section[data-role="page"], section[data-role="dialog"]').appendTo('body');
					
				//Make sure that the given psuedo page does not already exist before adding it
					//$.each(loadedPageElements, function() {
					//	var current = $(this);
					//	
					//	if (current.attr('id') && $(current.attr('id')).length == 0) {
					//		current.appendTo('body');
					//	}
					//});
					
				//Hide the loading spinner
					$.mobile.hidePageLoadingMsg();
					
				//Navigate the the first pseudo-page that was added to the DOM
					$.mobile.changePage(URL);
				}
			});
		});
	});
})(jQuery);