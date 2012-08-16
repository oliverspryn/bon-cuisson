(function($) {
	$(document).ready(function() {
	/**
	 * Rating selector
	 * ---------------------------
	*/
	
	//Preview the rating selection as each item is hovered over
		$('ul.rating.live li').mouseenter(function() {
			var current = $(this);
			var index = current.index();
			
			for (var i = 0; i <= 4; i++) {
				var item = current.parent().children('li').eq(i);
				
				if (i <= index) {
					item.addClass('selected');
				} else {
					item.removeClass('selected');
				}
			}
        });
		
	//Apply the preview on mouse click
		$('ul.rating.live li').click(function() {
			var current = $(this);
			var index = current.index();
			
		//Apply the visual preview
			for (var i = 0; i <= 4; i++) {
				var item = current.parent().children('li').eq(i);
				
				if (i <= index) {
					item.addClass('selected chosen');
				} else {
					item.removeClass('selected chosen');
				}
			}
			
		//Update the hidden form element
			$('input#rating').val(index + 1);
        });
		
	//Remove the preview on mouse leave
		$('ul.rating.live').mouseleave(function() {
			var menuItems = $(this).children('li');
			
			for (var i = 0; i <= 4; i++) {
				var current = menuItems.eq(i);
				
				if (current.hasClass('chosen')) {
					current.addClass('selected');
				} else {
					current.removeClass('selected');
				}
			}
        });
		
	/**
	 * Send a review to the sever
	 * ---------------------------
	*/
	
		$('button.submit').click(function() {
		//Grab the data
			var reviewer = $('section.form input#reviewer').val();
			var rating = parseInt($('section.form input#rating').val());
			var review = $('section.form textarea#review').val();
			
		//Validate the requried fields
			if (reviewer == '' || review == '') {
				alert('We will need both a name and a quick review!');
				return false;
			}
			
		//Is this the first review? If so, hide the review empty container and provide an unordered list on which to append the review
			if ($('section.empty').length) {
				var empty = $('section.empty');
				empty.after('<ul class="reviews"></ul>');
				empty.remove();
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
			var months = new Array('January', 'February', 'March', 'April', 'May', 'June',
								   'July', 'August', 'September', 'October', 'November', 'December');
			
			HTML += '<time datetime="' + year + '-' + month + '-' + day + '">' + months[month] + ' ' + day + ', ' + year + '</time>';
			HTML += '</span>';
			
			$('ul.reviews').append('<li>' + HTML + '</li>');
			
		//Clear the form
			$('section.form input#reviewer').val('');
			$('section.form input#rating').val('0');
			$('section.form textarea#review').val('');
			
			var ratings = $('ul.rating.live li');
			
			for (var i = 0; i <= 4; i++) {
				ratings.eq(i).removeClass('selected chosen');
			}
			
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