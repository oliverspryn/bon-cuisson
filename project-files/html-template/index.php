<?php
//Include the system core
	require_once("system/server/root.php");
		
//Fetch all of the menu items
	$menuGrabber = mysql_query("SELECT id, visible, position, URL, type, title, content, category, menuTotal+lunchesTotal as count FROM (SELECT pages.*, COUNT(menu.type) AS menuTotal, COUNT(lunches.id) AS lunchesTotal FROM `pages` LEFT JOIN (menu) ON pages.category = menu.type LEFT JOIN (lunches) ON pages.type = 'lunch' WHERE pages.visible = '1' GROUP BY pages.id ORDER BY position ASC) subquery", $db);
	
//Obtain a reference to the URL and page data
	if (isset($_GET['url']) && $_GET['url'] != "") {
		$URL = rtrim(urldecode($_GET['url']), "/");
		$SQLURL = escape($URL);
		$pageGrabber = mysql_query("SELECT * FROM `pages` WHERE `visible` = '1' AND `URL` = '{$SQLURL}'", $db);
		
		if (mysql_num_rows($pageGrabber)) {
			$page = mysql_fetch_array($pageGrabber);
		} else {
			$page = false;
		}
	} else {
		$URL = "";
		$pageGrabber = mysql_query("SELECT * FROM `pages` WHERE `visible` = '1' AND `position` = '1'", $db);
		
		if (mysql_num_rows($pageGrabber)) {
			$page = mysql_fetch_array($pageGrabber);
		} else {
			$page = false;
		}
	}
	
//Check and see if this is a mobile device
	require_once("system/server/third-party/Mobile_Detect.php");
	$detect = new Mobile_Detect();
	
	if ($detect->isMobile()) {
		require_once("mobile/index.php");
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en-US"> 
<head>
<title><?php echo escape($page['title']); ?></title>
<meta charset="UTF-8" />
<link href="<?php echo ROOT; ?>system/stylesheets/style.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="<?php echo ROOT; ?>system/javascripts/swfobject.js"></script>
<script src="<?php echo ROOT; ?>system/javascripts/swfaddress.js"></script>
<script src="<?php echo ROOT; ?>system/javascripts/hijax-redirect.js"></script>
<script src="<?php echo ROOT; ?>system/javascripts/config.js"></script>
</head>

<body id="container">
<header>
<h1><?php echo escape($config['companyName']); ?></h1>
<a href="<?php echo ROOT; ?>"><img alt="<?php echo escape($config['companyName']); ?>" src="<?php echo ROOT; ?>system/images/logo.png" /></a>

<ul class="contact">
<li><?php echo escape($config['address']); ?></li>
<li>Tele: <?php echo escape($config['phone']); ?></li>
<li><a href="mailto:<?php echo htmlentities(escape($config['email'])); ?>" target="_blank"><?php echo escape($config['email']); ?></a></li>
</ul>

<nav class="navigation">
<ul>
<?php
//Generate the menu
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

<section class="content">
<?php
//Fetch the appropriate module processor for the requested page type
	if ($page) {
		switch ($page['type']) {
			case "home" : 
				require_once("modules/home.php");
				break;
		}
	}
?>

</section>
</body>
</html>