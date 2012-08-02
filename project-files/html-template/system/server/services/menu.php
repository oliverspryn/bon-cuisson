<?php
//Include the system core
	require_once("../root.php");
	
//Output this file as XML
	header("Content-type: text/xml");
	
//Fetch the menu
	$menuGrabber = mysql_query("SELECT * FROM `pages` WHERE `visible` = '1' ORDER BY `position` ASC", $db);
	$XML = "<menu>";
	
	while ($menu = mysql_fetch_array($menuGrabber)) {
		$XML .= "<item>";
		$XML .= "<id>" . $menu['id'] . "</id>";
		$XML .= "<visible>" . $menu['visible'] . "</visible>";
		$XML .= "<position>" . $menu['position'] . "</position>";
		$XML .= "<URL>" . $menu['URL'] . "</URL>";
		$XML .= "<type>" . $menu['type'] . "</type>";
		$XML .= "<title>" . $menu['title'] . "</title>";
		$XML .= "<content>" . $menu['content'] . "</content>";
		$XML .= "<category>" . $menu['category'] . "</category>";
		$XML .= "</item>";
	}
	
	$XML .= "</menu>";
	
	echo $XML;
?>