<?php
//Fetch the food menu data
	$type = escape($page['category']);
	$menuGrabber = mysql_query("SELECT * FROM `menu` WHERE `type` = '{$type}'", $db);
	
//Display a title for SEO
	echo "<h2>" . escape($page['title']) . "</h2>

";
	
//Construct the menu items
	echo "<ul class=\"foodMenu\">";
	
	while ($menu = mysql_fetch_array($menuGrabber)) {
	//Show a Fleur de lis icon show?
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
			echo "<span class=\"price\">$ " . intval(escape($menu['price']));
			
			if ($menu['perUnit'] != "") {
				echo " " . escape($menu['perUnit']);
			}
			
			echo "</span>";
		} else {
			$variations = json_decode(escape($menu['variations']));
			
		/**
		 * We can navigate the above object like a multi-dimensional array:
		 *  - first object within the array is the price
		 *  - second object within the array is the size
		 *  - third object within the array is the suggested serving audience
		*/
			
			echo "<div class=\"variations\">
";
			
			for ($i = 0; $i <= sizeof($variations) - 1; $i++) {
				echo "<span class=\"price\">$ " . intval(escape($variations[$i]['0'])) . " " . escape($variations[$i]['1']) . "</span>
<span class=\"serves\">" . escape($variations[$i]['2']) . "</span>
";
			}
			
			echo "</div>
";
		}
		
	//Display the menu item name and tagline
		if ($menu['tagline'] == "") {
			echo "
<span class=\"name\">" . escape($menu['name']) . "</span>
";
		} else {
			echo "
<span class=\"name\">" . escape($menu['name']) . " : </span>
<span class=\"tagline\">" . escape($menu['tagline']) . "</span>
";
		}
		
	//Display the image and description
		if ($menu['imageURL'] != "") {
			echo "
<ul>
<li><img alt=\"" . escape($menu['name']) . " image\" src=\"" . escape($menu['imageURL']) . "\" /></li>
<li><span class=\"description image\">" . escape($menu['description']) . "</span></li>
</ul>
</li>
";
		} else {
			echo "<span class=\"description\">" . escape($menu['description']) . "</span>
</li>
";
		}
	}
	
	echo "</ul>";
?>