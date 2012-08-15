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
<span class=\"title\">" . strip($review['name']) . "</span>

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
			
<span class=\"review\">" . strip($review['review']) . "</span>
</li>
";
		}
		
		echo "</ul>";
	} else {
		
	}
?>