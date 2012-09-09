<?php
//Fetch the reviews
	$history = strtotime("-1 month");
	$reviewsGrabber = mysql_query("SELECT * FROM `reviews` WHERE `timestamp` > '{$history}' ORDER BY `timestamp` ASC LIMIT 25", $db);
	
//Display the header text, if some is avaliable
	if ($page['pageTop'] != "") {
		echo "<p class=\"headerText\">" . nl2br(strip($page['pageTop'])) . "</p>
	
";
	}
	
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
<select id="rating" name="rating">
<option value="0">Select rating...</option>
<option value="1">One Star</option>
<option value="2">Two Stars</option>
<option value="3">Three Stars</option>
<option value="4">Four Stars</option>
<option value="5">Five Stars</option>
</select>
<br>

<label for="review">Review:</label>
<textarea id="review" name="review"></textarea>
<br>

<button class="submit" data-theme="b">Share</button>
</section><?php
//Display the footer text, if some is avaliable
	if ($page['pageBottom'] != "") {
		echo "
		
<p class=\"footerText\">" . nl2br(strip($page['pageBottom'])) . "</p>";
	}
?>