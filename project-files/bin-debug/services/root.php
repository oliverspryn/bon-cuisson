<?php
//Connect to the database server
	$username = "root";
	$password = "Oliver99";
	$server = "localhost";
	$port = "3306";
	$databaseName = "boncuissondev";

	$db = mysql_connect($server . ":" . $port, $username, $password);
	mysql_select_db($databaseName, $db);
?>