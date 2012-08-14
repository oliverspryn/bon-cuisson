<?php
//Include the system core
	require_once("../root.php");
	
//Output this file as XML
	header("Content-type: text/xml");
	
//Fetch the menu
	$menuGrabber = mysql_query("SELECT * FROM `reviews` ORDER BY `id` ASC LIMIT 25", $db);
	$XML = "<root>";
	
	while ($menu = mysql_fetch_array($menuGrabber)) {
		$XML .= "<item>";
		$XML .= "<id>" . strip($menu['id']) . "</id>";
		$XML .= "<timestamp>" . strip($menu['timestamp']) . "</timestamp>";
		$XML .= "<name>" . strip($menu['name']) . "</name>";
		$XML .= "<rating>" . strip($menu['rating']) . "</rating>";
		$XML .= "<review>" . strip($menu['review']) . "</review>";
		$XML .= "</item>";
	}
	
	$XML .= "</root>";
	
	echo $XML;
?>