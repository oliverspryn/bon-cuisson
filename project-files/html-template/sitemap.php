<?php
//Include the system core and classes
	require_once("system/server/root.php");
	
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
<loc>" . ROOT . strip($page['URL']) . "</loc>\n";

	//Different modules should recieve differing levels of priority and changefreq
		switch ($page['type']) {
			case "home" : 
				echo "<priority>0.5</priority>
<changefreq>monthly</changefreq>\n";
				break;
				
			case "menu" : 
			case "lunch" : 
				echo "<priority>0.8</priority>
<changefreq>weekly</changefreq>\n";
				break;
				
			case "reviews" : 
				echo "<priority>0.7</priority>
<changefreq>weekly</changefreq>\n";
				break;
		}

		echo "</url>\n";
	}
?>
</urlset>