<?php
//Include the system core and classes
	require_once("services/root.php");
	
//Output as an XML file
	header("Content-type: text/xml");
	
//The question marks are confusing the PHP server, so echo it manually
	echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php
//Grab all of the dynamically created pages
	$pageGraber = mysql_query("SELECT * FROM `pages` WHERE `visible` = '1' ORDER BY `position` ASC", $db);
	
	while($page = mysql_fetch_array($pageGraber)) {
		echo "<url>
<loc>" . ROOT . $page['URL'] . "</loc>
<priority>1.000</priority>
</url>\n";
	}
?>
</urlset>