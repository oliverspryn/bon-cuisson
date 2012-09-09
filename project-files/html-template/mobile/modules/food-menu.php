<?php
//Fetch the food menu data
	$type = escape($page['category']);
	$menuGrabber = mysql_query("SELECT * FROM `menu` WHERE `visible` = '1' AND `type` = '{$type}' ORDER BY `position` ASC", $db);
	
	$internalPage = "";
	
//Display the header text, if some is avaliable
	if ($page['pageTop'] != "") {
		echo "<p class=\"headerText\">" . nl2br(strip($page['pageTop'])) . "</p>
	
";
	}
	
//Construct the menu items
	echo "<ul class=\"foodMenu\" data-role=\"listview\">";

	while ($menu = mysql_fetch_array($menuGrabber)) {
	//Allow only letters, with dashes in place of spaces, and all lowercase letters in the URL
		$URL = "#" . preg_replace("/[^a-zA-Z\-]+/", "", strtolower(str_replace(" ", "-", strip($menu['name']))));
		
	/**
	 * Build the menu item
	 * ---------------------------------
	*/
		echo "
<li>
";

	//Don't link to an internal page if no description is avaliable
		if ($menu['description'] != "") {
			echo "<a href=\"" . $URL . "\">
";
		}
		
		echo "<h3>" . strip($menu['name']) . "</h3>
<p class=\"description\">" . strip($menu['description']) . "</p>
<p class=\"price\">";

	//Display pricing variations, or just the standard, depending on what information is avaliable
		if ($menu['variations'] != "") {
			$variations = json_decode(strip($menu['variations']));
			
		/**
		 * We can navigate the above object like a multi-dimensional array:
		 *  - first object within the array is the price
		 *  - second object within the array is the size
		 *  - third object within the array is the suggested serving audience
		*/
			
			for ($i = 0; $i <= sizeof($variations) - 1; $i ++) {
				if ($i != sizeof($variations) - 1) {
					echo "$ " . intval(strip($variations[$i]['0'])) . " " . strip($variations[$i]['1']) . ", ";
				} else {
					echo "$ " . intval(strip($variations[$i]['0'])) . " " . strip($variations[$i]['1']);
				}
			}
		} else {
			echo "$ " . intval(strip($menu['price']));
			
			if ($menu['perUnit'] != "") {
				echo " " . strip($menu['perUnit']);
			}
		}
		
		echo "</p>
";

	//Conditionally display an image, if one is avaliable
		if ($menu['imageURL'] != "") {
			echo "<img alt=\"" . htmlentities(strip($menu['name'])) . " image\" src=\"" . strip($menu['imageURL']) . "\"/>
";
		}
		
	//Don't link to an internal page if no description is avaliable
		if ($menu['description'] != "") {
			echo "</a>
";
		}
		
		
		echo "</li>
";
		
	/**
	 * Build the internal page
	 * ---------------------------------
	*/
		
	//Don't create an internal page if no description is avaliable
		if ($menu['description'] != "") {
			$internalPage .= "
<section class=\"menuData\" data-role=\"page\" id=\"" . ltrim($URL, "#") . "\">
<header data-role=\"header\">
<a data-icon=\"arrow-l\" data-iconpos=\"left\" data-rel=\"back\" href=\"#\">Back</a>
<h1>" . strip($page['title']) . "</h1>
<a data-icon=\"home\" data-iconpos=\"notext\" data-transition=\"fade\" href=\"" . ROOT . "\"></a>
</header>

<section data-role=\"content\">
";

		//Display the image in its own column, if one is avaliable
			if ($menu['imageURL'] != "") {
				$internalPage .= "<ul>
<li><img alt=\"" . htmlentities(strip($menu['name'])) . " image\" src=\"" . strip($menu['imageURL']) . "\"/></li>
<li>
";
			}
		
			$internalPage .= "<h3>" . strip($menu['name']) . "</h3>
";

		//Display pricing variations, or just the standard price, depending on what information is avaliable
			if ($menu['variations'] != "") {
				$variations = json_decode(strip($menu['variations']));
				
			/**
			 * We can navigate the above object like a multi-dimensional array:
			 *  - first object within the array is the price
			 *  - second object within the array is the size
			 *  - third object within the array is the suggested serving audience
			*/
				
				for ($i = 0; $i <= sizeof($variations) - 1; $i ++) {
					$internalPage .= "<p class=\"variation\">$ " . intval(strip($variations[$i]['0'])) . " " . strip($variations[$i]['1']) . " (" . strip($variations[$i]['2']) . ")</p>
";
				}
			} else {
				$internalPage .= "<p class=\"price\">$ " . intval(strip($menu['price']));
				
				if ($menu['perUnit'] != "") {
					$internalPage .= " " . strip($menu['perUnit']);
				}
				
				$internalPage .= "</p>
";
			}

		//Display the tagline, if one is avaliable
			if ($menu['tagline'] != "") {
				$internalPage .= "<p class=\"tagline\">~ " . strip($menu['tagline']) . "</p>
";
			}
			
		//Display the image in its own column, if one is avaliable
			if ($menu['imageURL'] != "") {
				$internalPage .= "</li>
</ul>

";
			}
		
			$internalPage .= "<p class=\"description\">" . strip($menu['description']) . "</p>
</section>
		
<footer>
<ul>
<li><a href=\"tel:" . preg_replace("/[^0-9]/", "", strip($config['phone'])) . "\">" . strip($config['phone']) . "</a></li>
<li><a href=\"mailto:" . strip($config['email']) . "\" target=\"_blank\">" . strip($config['email']) . "</a></li>
</ul>
</footer>
</section>
";
		}

	}

	echo "</ul>";
	
//Display the footer text, if some is avaliable
	if ($page['pageBottom'] != "") {
		echo "
		
<p class=\"footerText\">" . nl2br(strip($page['pageBottom'])) . "</p>";
	}
?>