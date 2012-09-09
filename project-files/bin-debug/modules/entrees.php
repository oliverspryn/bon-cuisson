<?php
//Fetch the entree data
	$now = strtotime("now");
	$oneMonth = strtotime("+1 month");
	$entreeGrabber = mysql_query("SELECT * FROM `entrees` WHERE `serving` > '{$now}' AND `serving` < '{$oneMonth}' AND `visible` = '1' ORDER BY `serving` ASC", $db);
	
//Display a title for SEO
	echo "<h2>" . strip($page['title']) . "</h2>
";

//Display the header text, if some is avaliable
	if ($page['pageTop'] != "") {
		echo "<p class=\"headerText\">" . nl2br(strip($page['pageTop'])) . "</p>
	
";
	}

//Were any entree items fetched?
	if (mysql_num_rows($entreeGrabber)) {
		echo "<span class=\"servingHeader\">Serving on:</span>";	
	}
	
//Construct the entree items
	echo "
	
<ul class=\"entrees\">";
	
	while ($entree = mysql_fetch_array($entreeGrabber)) {
	//Construct the pricing
		$prices = json_decode(strip($entree['price']));
		$returnString = "";
		
		for ($i = 0; $i <= sizeof($prices) - 1; $i++) {
			$returnString .= strip($entree['type']);
			
			/**
			 * We can navigate the above object like a multi-dimensional array:
			 *  - first object within the array is the suggested serving size
			 *  - second object within the array is the price
			*/
			
			if ($prices[$i][0] != "0") {
				$returnString .= " for " . $prices[$i][0] . " - $" . intval($prices[$i][1]);
			} else {
				$returnString .= " - $" . intval($prices[$i][1]);
			}
			
			if ($i != sizeof($prices) - 1) {
				$returnString .= "&nbsp;&nbsp;&nbsp;&nbsp;";
			}
		}
		
	//Should a Fleur de lis icon show?
		if ($entree['showIcon'] == "1") {
			echo "
<li class=\"icon\">
";
		} else {
			echo "
<li>
";
		}
		
	//Format the serving date
		echo "<span class=\"serving\">
" . date("l", strip($entree['serving'])) . "<br>
" . strip($entree['type']) . "<br>
" . date("n-j-y", strip($entree['serving'])) . "
</span>

";
		
	//Display the entree name
		echo "<span class=\"name\">" . strip($entree['name']) . "</span>
";
		
	//Display the image and description
		if ($entree['imageURL'] != "") {
			echo "
<ul class=\"details\">
<li><img alt=\"" . htmlentities(strip($entree['name'])) . " image\" src=\"" . strip($entree['imageURL']) . "\" /></li>
<li>
";

		//Don't show a description if no description is avaliable
			if ($entree['description'] != "") {
				echo "<span class=\"description image\">" . strip($entree['description']) . "</span>
";
			}
		
			echo "<span class=\"prices image\">" . $returnString . "</span>
</li>
</ul>
</li>
";
		} else {
		//Don't show a description if no description is avaliable
			if ($entree['description'] != "") {
				echo "<span class=\"description\">" . strip($entree['description']) . "</span>
";
			}
			
			echo "<span class=\"prices\">" . $returnString . "</span>
</li>
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