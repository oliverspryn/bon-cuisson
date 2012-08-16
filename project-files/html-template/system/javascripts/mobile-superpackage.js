(function($) {
	$(document).bind('mobileinit', function() {
		$.mobile.defaultPageTransition = 'slide';
		$.mobile.selectmenu.prototype.options.nativeMenu = false;
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
	
/**
 * Send a review to the sever
 * ---------------------------
*/
	
	$(document).bind('pageinit', function() {	
		$('button.submit').click(function() {
		//Grab the data
			var reviewer = $('section.form input#reviewer').val();
			var rating = parseInt($('section.form select#rating option:selected').attr('value'));
			var review = $('section.form textarea#review').val();
			
		//Validate the requried fields
			if (reviewer == "" || review == "") {
				alert("We will need both a name and a quick review!");
				return false;
			}
			
		//Inject the review into the list
			var HTML = '<span class="reviewer">' + reviewer + '</span>\n';
			
			if (rating != 0) {
				HTML += '<ul class="rating">';
				
				for (var i = 1; i <= 5; i++) {
					if (i <= rating) {
						HTML += '<li class="selected"></li>';
					} else {
						HTML += '<li></li>';
					}
				}
				
				HTML += '</ul>';
			}
			
			HTML += '<span class="review">' + review + '</span>';
			HTML += '<span class="date">-- on ';
			
			var date = new Date();
			var month = date.getMonth();
			var day = date.getDate();
			var year = date.getFullYear();
			var months = new Array("January", "February", "March", "April", "May", "June",
								   "July", "August", "September", "October", "November", "December");
			
			HTML += '<time datetime="' + year + '-' + month + '-' + day + '">' + months[month] + ' ' + day + ', ' + year + '</time>';
			HTML += '</span>';
			
			$('ul.reviews').append('<li>' + HTML + '</li>');
			
		//Clear the form
			$('section.form input#reviewer').val('');
			$('section.form select#rating option:selected').prop('selected', false);
			$('section.form select#rating').selectmenu('refresh', true);
			$('section.form textarea#review').val('');
			
		//Send the data to the server
			$.ajax({
				'url' : 'system/server/processors/reviews.php',
				'type' : 'POST',
				'data' : {
					'reviewer' : reviewer,
					'rating' : rating,
					'review' : review
				}
			});
		});
	});
})(jQuery);