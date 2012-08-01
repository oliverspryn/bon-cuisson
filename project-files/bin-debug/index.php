<?php
//Include the system core
	require_once("services/root.php");
	
//Fetch all of the menu items
	$menuGrabber = mysql_query("SELECT * FROM `pages` WHERE `visible` = '1' ORDER BY `position` ASC", $db);
	
	if (isset($_GET['url']) && $_GET['url'] != "") {
		$URL = urldecode($_GET['url']);
	} else {
		$URL = "";
	}
?>
<!DOCTYPE html>
<html lang="en-US"> 
<head>
<title></title>
<meta charset="UTF-8" />
<link href="stylesheets/style.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="javascripts/swfobject.js"></script>
<script src="javascripts/swfaddress.js"></script>
<script src="javascripts/hijax-redirect.js"></script>
<script src="javascripts/config.js"></script>
</head>

<body id="content">
<header>
<h1><?php echo escape($config['companyName']); ?></h1>
<a href="<?php echo ROOT; ?>"><img alt="<?php echo escape($config['companyName']); ?>" src="images/logo.png" /></a>

<ul class="contact">
<li><?php echo escape($config['address']); ?></li>
<li>Tele: <?php echo escape($config['phone']); ?></li>
<li><a href="mailto:<?php echo htmlentities(escape($config['email'])); ?>" target="_blank"><?php echo escape($config['email']); ?></a></li>
</ul>

<nav class="navigation">
<ul>
<?php
	while ($menu = mysql_fetch_array($menuGrabber)) {
		if ($URL == escape($menu['URL']) || ($URL == "" && $menu['position'] == "1")) {
			echo "<li><a class=\"selected\" href=\"" . ROOT . escape($menu['URL']) . "\">" . escape($menu['title']) . "</a></li>\n";
		} else {
			echo "<li><a href=\"" . ROOT . escape($menu['URL']) . "\">" . escape($menu['title']) . "</a></li>\n";
		}
	}
?>
</ul>
</nav>
</header>
</body>
</html>