<?php
//Include the system core
	require_once("../root.php");
	
//Output this file as XML
	header("Content-type: text/xml");
	
//Fetch the menu
	$now = strtotime("now");
	$oneMonth = strtotime("+1 month");
	$menuGrabber = mysql_query("SELECT * FROM `entrees` WHERE `serving` > '{$now}' AND `serving` < '{$oneMonth}' ORDER BY `serving` ASC", $db);
	$XML = "<root>";
	
	while ($menu = mysql_fetch_array($menuGrabber)) {
		$XML .= "<item>";
		$XML .= "<id>" . strip($menu['id']) . "</id>";
		$XML .= "<serving>" . strip($menu['serving']) . "</serving>";
		$XML .= "<type>" . strip($menu['type']) . "</type>";
		$XML .= "<price>" . strip($menu['price']) . "</price>";
		$XML .= "<name>" . strip($menu['name']) . "</name>";
		$XML .= "<description>" . strip($menu['description']) . "</description>";
		$XML .= "<imageURL>" . strip($menu['imageURL']) . "</imageURL>";
		$XML .= "</item>";
	}
	
	$XML .= "</root>";
	
	echo $XML;
?>