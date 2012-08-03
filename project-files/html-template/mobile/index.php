<!DOCTYPE html>
<html lang="en-US"> 
<head>
<title><?php echo escape($page['title']); ?></title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="<?php echo ROOT; ?>system/stylesheets/mobile.css" rel="stylesheet" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="http://code.jquery.com/mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>
</head>

<body>
<section data-role="page">
<header data-role="header">
<?php
//Display a back button, if this isn't the start page
	if ($page['position'] != "1") {
		echo "<a data-icon=\"arrow-l\" data-iconpos=\"left\" data-rel=\"back\" data-transition=\"slide\" href=\"#\">Back</a>\n";
	}
?>
<h1><?php echo escape($page['title']); ?></h1>
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
			echo "<li><a href=\"" . ROOT . escape($menu['URL']) . "\">" . escape($menu['title']) .  "<span class=\"ui-li-count\">" . $menu['count'] . "</span></a></li>\n";
		} else {
			echo "<li><a href=\"" . ROOT . escape($menu['URL']) . "\">" . escape($menu['title']) .  "</a></li>\n";
		}
	}
?>
</ul>
</nav>
</section>

<footer>
<ul>
<li><a href="tel:<?php echo preg_replace("/[^0-9]/", "", escape($config['phone'])); ?>"><?php echo escape($config['phone']); ?></a></li>
<li><a href="mailto:<?php echo escape($config['email']); ?>" target="_blank"><?php echo escape($config['email']); ?></a></li>
</ul>
</footer>
</section>
</body>
</html>