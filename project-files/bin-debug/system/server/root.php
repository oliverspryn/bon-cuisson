<?php
//Connect to the database server
	$username = "root";
	$password = "Oliver99";
	$server = "localhost";
	$port = "3306";
	$databaseName = "boncuissondev";

	$db = mysql_connect($server . ":" . $port, $username, $password);
	mysql_select_db($databaseName, $db);
	
//Define the root information for the site
	define('ROOT', 'http://localhost/Bon%20Cuisson/project-files/bin-debug/');
	
//Grab the data from the configuration table and for use sitewide
	$configGrabber = mysql_query("SELECT * FROM `config` WHERE `id` = '1'", $db);
	$config = mysql_fetch_array($configGrabber);
	
//Simplify the name of some commonly used functions
	function escape($dbValue) {
		return stripslashes($dbValue);
	}
?>