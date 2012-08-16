<?php
//Include the system core
	require_once("system/server/root.php");
		
//Fetch all of the menu items
	$menuGrabber = mysql_query("SELECT id, visible, position, URL, type, title, content, category, menuTotal+entreesTotal as count FROM (SELECT pages.*, COUNT(menu.type) AS menuTotal, COUNT(entrees.id) AS entreesTotal FROM `pages` LEFT JOIN (menu) ON pages.category = menu.type LEFT JOIN (entrees) ON pages.type = 'lunch' WHERE pages.visible = '1' GROUP BY pages.id ORDER BY position ASC) subquery", $db);
	
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
	
	//if ($detect->isMobile()) {
		require_once("mobile/index.php");
		exit;
	//}
?>
<!DOCTYPE html>
<html lang="en-US"> 
<head>
<title><?php echo strip($page['title']); ?></title>
<meta charset="UTF-8" />
<meta name="HandheldFriendly" content="true">
<meta name="apple-touch-fullscreen" content="yes" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<link rel="shortcut icon" href="<?php echo ROOT; ?>system/images/favicon.ico" />
<link rel="apple-touch-icon" href="<?php echo ROOT; ?>system/images/mobile-app/favicon-57.jpg" />
<link rel="apple-touch-icon" sizes="72×72" href="<?php echo ROOT; ?>system/images/mobile-app/favicon-72.jpg" />
<link rel="apple-touch-icon" sizes="114×114" href="<?php echo ROOT; ?>system/images/mobile-app/favicon-114.jpg" )" />
<link rel="apple-touch-startup-image" href="<?php echo ROOT; ?>system/images/mobile-app/startup-large-landscape.jpg" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)" />
<link rel="apple-touch-startup-image" href="<?php echo ROOT; ?>system/images/mobile-app/startup-large-portrait.jpg" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)" />
<link rel="apple-touch-startup-image" href="<?php echo ROOT; ?>system/images/mobile-app/startup-small-landscape.jpg"  media="screen and (max-device-width: 320px) and (orientation:landscape)" />
<link rel="apple-touch-startup-image" href="<?php echo ROOT; ?>system/images/mobile-app/startup-small-portrait.jpg"  media="screen and (max-device-width: 320px) and (orientation:portrait)" />

<link href="<?php echo ROOT; ?>system/stylesheets/desktop.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="<?php echo ROOT; ?>system/javascripts/swfobject.js"></script>
<script src="<?php echo ROOT; ?>system/javascripts/swfaddress.js"></script>
<script src="<?php echo ROOT; ?>system/javascripts/desktop-superpackage.js"></script>
<script src="<?php echo ROOT; ?>system/javascripts/hijax-redirect.js"></script>
<script src="<?php echo ROOT; ?>system/javascripts/config.js"></script>
</head>

<body id="container">
<header>
<h1><?php echo strip($config['companyName']); ?></h1>
<a href="<?php echo ROOT; ?>"><img alt="<?php echo strip($config['companyName']); ?>" src="<?php echo ROOT; ?>system/images/logo.png" /></a>

<ul class="contact">
<li><?php echo strip($config['address']); ?></li>
<li>Tele: <?php echo strip($config['phone']); ?></li>
<li><a href="mailto:<?php echo htmlentities(strip($config['email'])); ?>" target="_blank"><?php echo strip($config['email']); ?></a></li>
</ul>

<nav class="navigation">
<ul>
<?php
//Generate the menu
	while ($menu = mysql_fetch_array($menuGrabber)) {
		if ($URL == strip($menu['URL']) || ($URL == "" && $menu['position'] == "1")) {
			echo "<li><a class=\"selected\" href=\"" . ROOT . strip($menu['URL']) . "\">" . strip($menu['title']) . "</a></li>\n";
		} else {
			echo "<li><a href=\"" . ROOT . strip($menu['URL']) . "\">" . strip($menu['title']) . "</a></li>\n";
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
				
			case "menu" : 
				require_once("modules/food-menu.php");
				break;
				
			case "reviews" : 
				require_once("modules/reviews.php");
				break;
		}
	}
?>

</section>
</body>
</html>