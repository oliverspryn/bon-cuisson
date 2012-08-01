<?php
//Include the system core and classes
	require_once("services/root.php");
	
//Output as a text file
	header("Content-type: text/plain");
?>
User-agent: *
Allow: /
Disallow: 
Sitemap: <?php echo ROOT; ?>sitemap.xml