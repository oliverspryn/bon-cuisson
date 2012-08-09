<?php
//Fetch the food menu data
	$type = escape($page['category']);
	$foodMenuGrabber = mysql_query("SELECT * FROM `menu` WHERE `visible` = '1' AND `type` = '{$type}' ORDER BY `position` ASC", $db);
	
	$internalPage = "";
	
//Construct the menu items
	echo "<ul class=\"foodMenu\" data-role=\"listview\">";

	while ($foodMenu = mysql_fetch_array($foodMenuGrabber)) {
	//Allow only letters, with dashes in place of spaces, and all lowercase letters in the URL
		$URL = "#" . preg_replace("/[^a-zA-Z\-]+/", "", strtolower(str_replace(" ", "-", strip($foodMenu['name']))));
		
		
	//Build the menu item
		if ($foodMenu['imageURL'] != "") {
			echo "
<li>
<a href=\"" . $URL . "\">
<h3>" . strip($foodMenu['name']) . "</h3>
<p class=\"description\">" . strip($foodMenu['description']) . "</p>
<p class=\"price\">$ " . intval(strip($foodMenu['price'])) . "</p>
<img alt=\"" . strip($foodMenu['name']) . " image\" src=\"" . strip($foodMenu['imageURL']) . "\"/>
</a>
</li>
";
		} else {
			echo "
<li>
<a href=\"" . $URL . "\">
<h3>" . strip($foodMenu['name']) . "</h3>
<p class=\"description\">" . strip($foodMenu['description']) . "</p>
<p class=\"price\">$ " . intval(strip($foodMenu['price'])) . "</p>
</a>
</li>
";
		}
		
	//Build a seperate "page" that the above item will link to
		$internalPage .= "
<section class=\"menuData\" data-role=\"page\" id=\"" . ltrim($URL, "#") . "\">
<header data-role=\"header\">
<a data-icon=\"arrow-l\" data-iconpos=\"left\" data-rel=\"back\" href=\"#\">Back</a>
<h1>" . strip($page['title']) . "</h1>
<a data-icon=\"home\" data-iconpos=\"notext\" data-transition=\"fade\" href=\"" . ROOT . "\"></a>
</header>

<section data-role=\"content\">
";

		if ($foodMenu['imageURL'] != "") {
			$internalPage .= "<ul>
<li><img alt=\"" . strip($foodMenu['name']) . " image\" src=\"" . strip($foodMenu['imageURL']) . "\"/></li>
<li>
<h3>" . strip($foodMenu['name']) . "</h3>
<p class=\"price\">$ " . intval(strip($foodMenu['price'])) . "</p>
";

			if ($foodMenu['description'] != "") {
				$internalPage .= "<p class=\"tagline\">" . strip($foodMenu['tagline']) . "</p>
";
			}
			
			$internalPage .= "<p class=\"description\">" . strip($foodMenu['description']) . "</p>
</li>
</ul>
";
		} else {
			$internalPage .= "<h3>" . strip($foodMenu['name']) . "</h3>
<p class=\"tagline\">" . strip($foodMenu['tagline']) . "</p>
";

			if ($foodMenu['description'] != "") {
				$internalPage .= "<p class=\"tagline\">" . strip($foodMenu['tagline']) . "</p>
";
			}
			
			$internalPage .= "
<p class=\"description\">" . strip($foodMenu['description']) . "</p>
";
		}
		
		$internalPage .= "</section>
</section>
";

	}

	echo "</ul>";
?>