<?php
//Fetch the reviews
	$history = strtotime("-1 month");
	$reviewsGrabber = mysql_query("SELECT * FROM `reviews` WHERE `timestamp` > '{$history}' ORDER BY `timestamp` ASC LIMIT 25", $db);
	
//Display a title for SEO
	echo "<h2>" . strip($page['title']) . "</h2>

";

//Display the list of comments
	if (mysql_num_rows($reviewsGrabber)) {
		echo "<ul class=\"reviews\">";
		
		while ($review = mysql_fetch_array($reviewsGrabber)) {
			$rating = strip($review['rating']);
			
			echo "
<li>
<span class=\"reviewer\">" . strip($review['name']) . "</span>
";

			if ($rating != 0) {
				echo "
<ul class=\"rating\">
";

				for ($i = 1; $i <= 5; $i++) {
					if ($i <= $rating) {
						echo "<li class=\"selected\"></li>
";
					} else {
						echo "<li></li>
";
					}
				}
			
				echo "</ul>

";
			}
			
			echo "<span class=\"review\">" . strip($review['review']) . "</span>
<span class=\"date\">-- on <time datetime=\"" . date("Y-m-d", strip($review['timestamp'])) . "\">" . date("F j, Y", strip($review['timestamp'])) . "</time></span>
</li>
";
		}
		
		echo "</ul>";
	} else {
		echo "<section class=\"empty\"><p>We don't currently have any reviews, but you can be the first to leave one!</p></section>";
	}
?>


<h3 class="reviewTitle">I would love to hear from you:</h3>

<section class="form">
<label for="reviewer">Name:</label>
<input id="reviewer" name="reviewer" type="text" />
<br>

<label for="rating">Rating:</label>
<input id="rating" name="rating" type="hidden" value="0" />
<ul class="live rating" id="rating">
<li></li>
<li></li>
<li></li>
<li></li>
<li></li>
</ul>
<br>

<label for="review">Review:</label>
<textarea id="review" name="review"></textarea>
<br>

<button class="submit">Share</button>
</section>