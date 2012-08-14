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
		$XML = "<root>";
		
		while ($menu = mysql_fetch_array($menuGrabber)) {
			$XML .= "<item>";
			$XML .= "<id>" . strip($menu['id']) . "</id>";
			$XML .= "<visible>" . strip($menu['visible']) . "</visible>";
			$XML .= "<position>" . strip($menu['position']) . "</position>";
			$XML .= "<type>" . strip($menu['type']) . "</type>";
			$XML .= "<price>" . strip($menu['price']) . "</price>";
			$XML .= "<perUnit>" . strip($menu['perUnit']) . "</perUnit>";
			$XML .= "<showIcon>" . strip($menu['showIcon']) . "</showIcon>";
			$XML .= "<name>" . strip($menu['name']) . "</name>";
			$XML .= "<tagline>" . strip($menu['tagline']) . "</tagline>";
			$XML .= "<description>" . strip($menu['description']) . "</description>";
			$XML .= "<variations>" . strip($menu['variations']) . "</variations>";
			$XML .= "<imageURL>" . strip($menu['imageURL']) . "</imageURL>";
			$XML .= "</item>";
		}
		
		$XML .= "</root>";
		
		echo $XML;
	}
?>