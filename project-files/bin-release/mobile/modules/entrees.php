<?php
//Fetch the entree data
	$now = strtotime("now");
	$oneMonth = strtotime("+1 month");
	$entreeGrabber = mysql_query("SELECT * FROM `entrees` WHERE `serving` > '{$now}' AND `serving` < '{$oneMonth}' AND `visible` = '1' ORDER BY `serving` ASC", $db);
	
	$internalPage = "";
	
//Display the header text, if some is avaliable
	if ($page['pageTop'] != "") {
		echo "<p class=\"headerText\">" . nl2br(strip($page['pageTop'])) . "</p>
	
";
	}
	
//Construct the entree items
	echo "<ul class=\"entrees\" data-role=\"listview\">";

	while ($entree = mysql_fetch_array($entreeGrabber)) {
	//Allow only letters, with dashes in place of spaces, and all lowercase letters in the URL
		$URL = "#" . preg_replace("/[^a-zA-Z\-]+/", "", strtolower(str_replace(" ", "-", strip($entree['name']))));
		
	/**
	 * Build the entree item
	 * ---------------------------------
	*/
		echo "
<li>
";

	//Don't link to an internal page if no description is avaliable
		if ($entree['description'] != "") {
			echo "<a href=\"" . $URL . "\">
";
		}
		
		echo "<h3>" . strip($entree['name']) . "</h3>
<p class=\"serving\">for " . strtolower($entree['type']) . " on " . date("D, n-j-y", $entree['serving']) . "</p>
<p class=\"description\">" . strip($entree['description']) . "</p>
";

	//Construct the pricing
		$prices = json_decode(strip($entree['price']));
	
		echo "<p class=\"price\">";
	
		for ($i = 0; $i <= sizeof($prices) - 1; $i++) {			
			/**
			 * We can navigate the above object like a multi-dimensional array:
			 *  - first object within the array is the suggested serving size
			 *  - second object within the array is the price
			*/
			
			if ($prices[$i][0] != "0") {
				echo $prices[$i][0] . " for $" . intval($prices[$i][1]);
			} else {
				echo "$" . intval($prices[$i][1]);
			}
			
			if ($i != sizeof($prices) - 1) {
				echo "&nbsp;&nbsp;&nbsp;&nbsp;";
			}
		}
		
		echo "</p>
";

	//Conditionally display an image, if one is avaliable
		if ($entree['imageURL'] != "") {
			echo "<img alt=\"" . htmlentities(strip($entree['name'])) . " image\" src=\"" . strip($entree['imageURL']) . "\"/>
";
		}
		
	//Don't link to an internal page if no description is avaliable
		if ($entree['description'] != "") {
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
		if ($entree['description'] != "") {
			$internalPage .= "
<section class=\"entreeData\" data-role=\"page\" id=\"" . ltrim($URL, "#") . "\">
<header data-role=\"header\">
<a data-icon=\"arrow-l\" data-iconpos=\"left\" data-rel=\"back\" href=\"#\">Back</a>
<h1>" . strip($page['title']) . "</h1>
<a data-icon=\"home\" data-iconpos=\"notext\" data-transition=\"fade\" href=\"" . ROOT . "\"></a>
</header>

<section data-role=\"content\">
";

		//Display the image in its own column, if one is avaliable
			if ($entree['imageURL'] != "") {
				$internalPage .= "<ul>
<li><img alt=\"" . htmlentities(strip($entree['name'])) . " image\" src=\"" . strip($entree['imageURL']) . "\"/></li>

<li>
";
			}
		
			$internalPage .= "<h3>" . strip($entree['name']) . "</h3>
<p class=\"serving\">for " . strtolower($entree['type']) . " on " . date("l, n-j-y", $entree['serving']) . "</p>
";

		//Construct the pricing
			$prices = json_decode(strip($entree['price']));
		
			$internalPage .= "<p class=\"price\">";
		
			for ($i = 0; $i <= sizeof($prices) - 1; $i++) {
				$internalPage .= strip($entree['type']);
				
				/**
				 * We can navigate the above object like a multi-dimensional array:
				 *  - first object within the array is the suggested serving size
				 *  - second object within the array is the price
				*/
				
				if ($prices[$i][0] != "0") {
					$internalPage .= " for " . $prices[$i][0] . " - $" . intval($prices[$i][1]);
				} else {
					$internalPage .= " - $" . intval($prices[$i][1]);
				}
				
				if ($i != sizeof($prices) - 1) {
					$internalPage .= "&nbsp;&nbsp;&nbsp;&nbsp;";
				}
			}
			
			$internalPage .= "</p>
";
			
		//Display the image in its own column, if one is avaliable
			if ($entree['imageURL'] != "") {
				$internalPage .= "</li>
</ul>

";
			}
		
			$internalPage .= "<p class=\"description\">" . strip($entree['description']) . "</p>
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