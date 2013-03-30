<?php
//Include the system core
	require_once("../root.php");
	
//Output this file as XML
	header("Content-type: text/xml");
	
//Fetch the contact information
	$contactGrabber = mysql_query("SELECT * FROM `config` WHERE `id` = '1'", $db);
	$XML = "<root>";
	
	while ($contact = mysql_fetch_array($contactGrabber)) {
		$XML .= "<item>";
		$XML .= "<id>" . strip($contact['id']) . "</id>";
		$XML .= "<address>" . strip($contact['address']) . "</address>";
		$XML .= "<companyName>" . strip($contact['companyName']) . "</companyName>";
		$XML .= "<email>" . strip($contact['email']) . "</email>";
		$XML .= "<phone>" . strip($contact['phone']) . "</phone>";
		$XML .= "</item>";
	}
	
	$XML .= "</root>";
	
	echo $XML;
?>