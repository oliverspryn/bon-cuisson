<?php
//Include the core library
	require_once("../root.php");

//Process a review submission request
	if (isset($_POST['reviewer']) && is_numeric($_POST['rating']) && isset($_POST['review'])) {
		$timestamp = strtotime("now");
		$reviewer = escape($_POST['reviewer']);
		$rating = escape($_POST['rating']);
		$review = escape($_POST['review']);
		
		mysql_query("INSERT INTO `reviews` (
						`id`, `timestamp`, `name`, `rating`, `review`
					) VALUES (
						NULL, '{$timestamp}', '{$reviewer}', '{$rating}', '{$review}'
					)", $db);
	}
?>