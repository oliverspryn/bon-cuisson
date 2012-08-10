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
		
	/**
	 * Build the menu item
	 * ---------------------------------
	*/
		echo "
<li>
";

	//Don't link to an internal page if no description is avaliable
		if ($foodMenu['description'] != "") {
			echo "<a href=\"" . $URL . "\">
";
		}
		
		echo "<h3>" . strip($foodMenu['name']) . "</h3>
<p class=\"description\">" . strip($foodMenu['description']) . "</p>
<p class=\"price\">";

	//Display pricing variations, or just the standard, depending on what information is avaliable
		if ($foodMenu['variations'] != "") {
			$variations = json_decode(strip($foodMenu['variations']));
			
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
			echo "$ " . intval(strip($foodMenu['price']));
			
			if ($foodMenu['perUnit'] != "") {
				echo " " . strip($foodMenu['perUnit']);
			}
		}
		
		echo "</p>
";

	//Conditionally display an image, if one is avaliable
		if ($foodMenu['imageURL'] != "") {
			echo "<img alt=\"" . strip($foodMenu['name']) . " image\" src=\"" . strip($foodMenu['imageURL']) . "\"/>
";
		}
		
	//Don't link to an internal page if no description is avaliable
		if ($foodMenu['description'] != "") {
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
		if ($foodMenu['description'] != "") {
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
			if ($foodMenu['imageURL'] != "") {
				$internalPage .= "<ul>
	<li><img alt=\"" . strip($foodMenu['name']) . " image\" src=\"" . strip($foodMenu['imageURL']) . "\"/></li>
	<li>
	";
			}
		
			$internalPage .= "<h3>" . strip($foodMenu['name']) . "</h3>
";

		//Display pricing variations, or just the standard price, depending on what information is avaliable
			if ($foodMenu['variations'] != "") {
				$variations = json_decode(strip($foodMenu['variations']));
				
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
				$internalPage .= "<p class=\"price\">$ " . intval(strip($foodMenu['price']));
				
				if ($foodMenu['perUnit'] != "") {
					$internalPage .= " " . strip($foodMenu['perUnit']);
				}
				
				$internalPage .= "</p>
";
			}

		//Display the tagline, if one is avaliable
			if ($foodMenu['tagline'] != "") {
				$internalPage .= "<p class=\"tagline\">~ " . strip($foodMenu['tagline']) . "</p>
";
			}
			
		//Display the image in its own column, if one is avaliable
			if ($foodMenu['imageURL'] != "") {
				$internalPage .= "</li>
</ul>

";
			}
		
			$internalPage .= "<p class=\"description\">" . strip($foodMenu['description']) . "</p>
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
?>