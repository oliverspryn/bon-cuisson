<?php
//Include the system core and classes
	require_once("system/server/root.php");
	
//Output as a text file
	header("Content-type: text/plain");
	
//Do not allow spiders to crawl hidden pages
	$visible = "";
	$pageGraber = mysql_query("SELECT * FROM `pages` WHERE `visible` = '0' ORDER BY `position` ASC", $db);
	
	while($page = mysql_fetch_array($pageGraber)) {
		$visible .= "Disallow: /" . strip($page['URL']) . "/\n";
	}
?>
User-agent: *
<?php 
	if ($visible == "") {
		echo "Disallow: \n";
	} else {
		echo $visible;
	}
?>
Allow: /
Sitemap: <?php echo ROOT; ?>sitemap.xml