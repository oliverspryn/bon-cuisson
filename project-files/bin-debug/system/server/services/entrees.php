<?php
//Include the system core
	require_once("../root.php");
	
//Output this file as XML
	header("Content-type: text/xml");
	
//Fetch the entree menu
	$now = strtotime("now");
	$oneMonth = strtotime("+1 month");
	$entreeGrabber = mysql_query("SELECT * FROM `entrees` WHERE `serving` > '{$now}' AND `serving` < '{$oneMonth}' AND `visible` = '1' ORDER BY `serving` ASC", $db);
	$XML = "<root>";
	
	while ($entree = mysql_fetch_array($entreeGrabber)) {
		$XML .= "<item>";
		$XML .= "<id>" . strip($entree['id']) . "</id>";
		$XML .= "<visible>" . strip($entree['visible']) . "</visible>";
		$XML .= "<showIcon>" . strip($entree['showIcon']) . "</showIcon>";
		$XML .= "<serving>" . strip($entree['serving']) . "</serving>";
		$XML .= "<type>" . strip($entree['type']) . "</type>";
		$XML .= "<price>" . strip($entree['price']) . "</price>";
		$XML .= "<name>" . strip($entree['name']) . "</name>";
		$XML .= "<description>" . strip($entree['description']) . "</description>";
		$XML .= "<imageURL>" . strip($entree['imageURL']) . "</imageURL>";
		$XML .= "</item>";
	}
	
	$XML .= "</root>";
	
	echo $XML;
?>