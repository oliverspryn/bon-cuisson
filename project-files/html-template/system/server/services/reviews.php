<?php
//Include the system core
	require_once("../root.php");
	
//Output this file as XML
	header("Content-type: text/xml");
	
//Fetch the list of reviews
	$history = strtotime("-1 month");
	$reviewsGrabber = mysql_query("SELECT * FROM `reviews` WHERE `timestamp` > '{$history}' ORDER BY `timestamp` ASC LIMIT 25", $db);
	$XML = "<root>";
	
	while ($review = mysql_fetch_array($reviewsGrabber)) {
		$XML .= "<item>";
		$XML .= "<id>" . strip($review['id']) . "</id>";
		$XML .= "<timestamp>" . strip($review['timestamp']) . "</timestamp>";
		$XML .= "<name>" . strip($review['name']) . "</name>";
		$XML .= "<rating>" . strip($review['rating']) . "</rating>";
		$XML .= "<review>" . strip($review['review']) . "</review>";
		$XML .= "</item>";
	}
	
	$XML .= "</root>";
	
	echo $XML;
?>