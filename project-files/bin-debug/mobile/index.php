<!DOCTYPE html>
<html lang="en-US"> 
<head>
<title><?php echo strip($page['title']); ?></title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
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

<link href="<?php echo ROOT; ?>system/stylesheets/mobile.css" rel="stylesheet" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="<?php echo ROOT; ?>system/javascripts/mobile-superpackage.js"></script>
<script src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>
</head>

<body>
<section data-role="page">
<header data-role="header">
<?php
//Display a back button, if this isn't the start page
	if ($page['position'] != "1") {
		echo "<a data-direction=\"back\" data-icon=\"arrow-l\" data-iconpos=\"left\" data-rel=\"back\" href=\"#\">Back</a>\n";
	}
?>
<h1><?php echo strip($page['title']); ?></h1>
<?php
//Display a home button, if this isn't the start page
	if ($page['position'] != "1") {
		echo "<a data-icon=\"home\" data-iconpos=\"notext\" data-transition=\"fade\" href=\"" . ROOT . "\"></a>\n";
	}
?>
</header>

<section class="content" data-role="content">
<?php
//Fetch the appropriate module processor for the requested page type
	if ($page) {
		switch ($page['type']) {
			case "home" : 
				require_once("mobile/modules/home.php");
				break;
				
			case "menu" : 
				require_once("mobile/modules/food-menu.php");
				break;
				
			case "reviews" : 
				require_once("mobile/modules/reviews.php");
				break;
		}
	}
?>


<nav class="mainMenu">
<ul data-inset="true" data-role="listview">
<li data-role="list-divider">Our Menu</li>
<?php
//Generate the menu
	while ($menu = mysql_fetch_array($menuGrabber)) {
		if ($menu['count'] > 0) {
			echo "<li><a class=\"multi-page-link\" href=\"" . ROOT . strip($menu['URL']) . "\">" . strip($menu['title']) .  "<span class=\"ui-li-count\">" . $menu['count'] . "</span></a></li>\n";
		} else {
			echo "<li><a href=\"" . ROOT . strip($menu['URL']) . "\">" . strip($menu['title']) .  "</a></li>\n";
		}
	}
?>
</ul>
</nav>
</section>

<footer>
<ul>
<li><a href="tel:<?php echo preg_replace("/[^0-9]/", "", strip($config['phone'])); ?>"><?php echo strip($config['phone']); ?></a></li>
<li><a href="mailto:<?php echo strip($config['email']); ?>" target="_blank"><?php echo strip($config['email']); ?></a></li>
</ul>
</footer>
</section>
<?php
//Some pages may wish to embed internal pages for quick access, the generated output will be included here
	if (isset($internalPage)) {
		echo $internalPage;
	}
?>
</body>
</html>