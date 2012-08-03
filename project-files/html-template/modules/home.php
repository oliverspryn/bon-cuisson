<?php
//Fetch the home page data
	$homeGrabber = mysql_query("SELECT * FROM `home` WHERE `id` = '1'", $db);
	$home = mysql_fetch_array($homeGrabber);
?>
<h2><?php echo escape($page['title']); ?></h2>

<div class="homeBanner right" style="background-image: url(<?php echo ROOT; ?>data/home/<?php echo escape($home['image1']); ?>)">
<p><?php echo escape($home['line1']); ?></p>
</div>

<div class="homeBanner left" style="background-image: url(<?php echo ROOT; ?>data/home/<?php echo escape($home['image2']); ?>)">
<p><?php echo escape($home['line2']); ?></p>
</div>

<div class="homeBanner right" style="background-image: url(<?php echo ROOT; ?>data/home/<?php echo escape($home['image3']); ?>)">
<p><?php echo escape($home['line3']); ?></p>
</div>