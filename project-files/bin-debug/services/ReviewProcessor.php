<?php
//Include the core library
	require_once("root.php");

//Process a review submission request
	if (isset($_POST['reviewer']) && is_numeric($_POST['rating']) && isset($_POST['review'])) {
		echo "yay";
		$timestamp = strtotime("now");
		$reviewer = mysql_real_escape_string($_POST['reviewer']);
		$rating = mysql_real_escape_string($_POST['rating']);
		$review = mysql_real_escape_string($_POST['review']);
		
		mysql_query("INSERT INTO reviews (
						`id`, `timestamp`, `name`, `rating`, `review`
					) VALUES (
						NULL, '{$timestamp}', '{$reviewer}', '{$rating}', '{$review}'
					)", $db) or die("Query insertion failed");
					
		exit;
	}
?>