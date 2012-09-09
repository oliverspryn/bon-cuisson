<?php
//Fetch the food menu data
	$type = escape($page['category']);
	$menuGrabber = mysql_query("SELECT * FROM `menu` WHERE `visible` = '1' AND `type` = '{$type}' ORDER BY `position` ASC", $db);
	
//Display a title for SEO
	echo "<h2>" . strip($page['title']) . "</h2>

";

//Display the header text, if some is avaliable
	if ($page['pageTop'] != "") {
		echo "<p class=\"headerText\">" . nl2br(strip($page['pageTop'])) . "</p>
	
";
	}
	
//Construct the menu items
	echo "<ul class=\"foodMenu\">";
	
	while ($menu = mysql_fetch_array($menuGrabber)) {
	//Should a Fleur de lis icon show?
		if ($menu['showIcon'] == "1") {
			echo "
<li class=\"icon\">
";
		} else {
			echo "
<li>
";
		}
		
	//Can we just show the price or do we need to show menu item variants?
		if ($menu['variations'] == "") {
			echo "<span class=\"price\">$ " . intval(strip($menu['price']));
			
			if ($menu['perUnit'] != "") {
				echo " " . strip($menu['perUnit']);
			}
			
			echo "</span>";
		} else {
			$variations = json_decode(strip($menu['variations']));
			
		/**
		 * We can navigate the above object like a multi-dimensional array:
		 *  - first object within the array is the price
		 *  - second object within the array is the size
		 *  - third object within the array is the suggested serving audience
		*/
			
			echo "<ul class=\"variations\">
";
			
			for ($i = 0; $i <= sizeof($variations) - 1; $i++) {
				echo "<li class=\"price\">$ " . intval(strip($variations[$i]['0'])) . " " . strip($variations[$i]['1']) . "</li>
<li class=\"serves\">" . strip($variations[$i]['2']) . "</li>
";
			}
			
			echo "</ul>
";
		}
		
	//Display the menu item name and tagline
		if ($menu['tagline'] == "") {
			echo "
<span class=\"name\">" . strip($menu['name']) . "</span>
";
		} else {
			echo "
<span class=\"name\">" . strip($menu['name']) . " : </span>
<span class=\"tagline\">" . strip($menu['tagline']) . "</span>
";
		}
		
	//Display the image and description
		if ($menu['imageURL'] != "") {
			echo "
<ul class=\"details\">
<li><img alt=\"" . htmlentities(strip($menu['name'])) . " image\" src=\"" . strip($menu['imageURL']) . "\" /></li>
<li>";

		//Don't show a description if no description is avaliable
			if ($menu['description'] != "") {
				echo "<span class=\"description image\">" . strip($menu['description']) . "</span>";
			}
		
			echo "</li>
</ul>
</li>
";
		} else {
		//Don't show a description if no description is avaliable
			if ($menu['description'] != "") {
				echo "<span class=\"description\">" . strip($menu['description']) . "</span>
";
			}
			
			echo "</li>
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