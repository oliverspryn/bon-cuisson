<?php
//Include the system core
	require_once("../root.php");
	
//Check to see if we are given the required parameters
	if (isset($_GET['type']) && $_GET['type'] != "") {
	//Output this file as XML
		header("Content-type: text/xml");
		
	//Fetch the menu
		$type = strtolower(mysql_real_escape_string($_GET['type']));
		$menuGrabber = mysql_query("SELECT * FROM `menu` WHERE `visible` = '1' AND `type` = '{$type}' ORDER BY `position` ASC", $db);
		$XML = "<menu>";
		
		while ($menu = mysql_fetch_array($menuGrabber)) {
			$XML .= "<item>";
			$XML .= "<id>" . $menu['id'] . "</id>";
			$XML .= "<visible>" . $menu['visible'] . "</visible>";
			$XML .= "<position>" . $menu['position'] . "</position>";
			$XML .= "<type>" . $menu['type'] . "</type>";
			$XML .= "<price>" . $menu['price'] . "</price>";
			$XML .= "<perUnit>" . $menu['perUnit'] . "</perUnit>";
			$XML .= "<name>" . $menu['name'] . "</name>";
			$XML .= "<tagline>" . $menu['tagline'] . "</tagline>";
			$XML .= "<description>" . $menu['description'] . "</description>";
			$XML .= "<variations>" . $menu['variations'] . "</variations>";
			$XML .= "<imageURL>" . $menu['imageURL'] . "</imageURL>";
			$XML .= "</item>";
		}
		
		$XML .= "</menu>";
		
		echo $XML;
	}
?>