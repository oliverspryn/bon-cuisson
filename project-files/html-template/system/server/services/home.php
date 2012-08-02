<?php
//Include the system core
	require_once("../root.php");
	
//Output this file as XML
	header("Content-type: text/xml");
	
//Fetch page data for the home page
	$homeGrabber = mysql_query("SELECT * FROM `home` WHERE `id` = '1'", $db);
	$home = mysql_fetch_array($homeGrabber);
	
	$XML = "<home>";
	$XML .= "<id>" . $home['id'] . "</id>";
	$XML .= "<line1>" . $home['line1'] . "</line1>";
	$XML .= "<line2>" . $home['line2'] . "</line2>";
	$XML .= "<line3>" . $home['line3'] . "</line3>";
	$XML .= "<image1>" . $home['image1'] . "</image1>";
	$XML .= "<image2>" . $home['image2'] . "</image2>";
	$XML .= "<image3>" . $home['image3'] . "</image3>";
	$XML .= "</home>";
	
	echo $XML;
?>