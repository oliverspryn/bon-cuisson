<?php
//Include the system core
	require_once("../root.php");
	
//Output this file as XML
	header("Content-type: text/xml");
	
//Fetch the navigation menu
	$menuGrabber = mysql_query("SELECT * FROM `pages` WHERE `visible` = '1' ORDER BY `position` ASC", $db);
	$XML = "<root>";
	
	while ($menu = mysql_fetch_array($menuGrabber)) {
		$XML .= "<item>";
		$XML .= "<id>" . strip($menu['id']) . "</id>";
		$XML .= "<visible>" . strip($menu['visible']) . "</visible>";
		$XML .= "<position>" . strip($menu['position']) . "</position>";
		$XML .= "<URL>" . strip($menu['URL']) . "</URL>";
		$XML .= "<type>" . strip($menu['type']) . "</type>";
		$XML .= "<title>" . strip($menu['title']) . "</title>";
		$XML .= "<category>" . strip($menu['category']) . "</category>";
		$XML .= "<pageTop>" . strip($menu['pageTop']) . "</pageTop>";
		$XML .= "<pageBottom>" . strip($menu['pageBottom']) . "</pageBottom>";
		$XML .= "</item>";
	}
	
	$XML .= "</root>";
	
	echo $XML;
?>