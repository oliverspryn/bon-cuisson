<?php
//Fetch the home page data
	$homeGrabber = mysql_query("SELECT * FROM `home` WHERE `id` = '1'", $db);
	$home = mysql_fetch_array($homeGrabber);
?>
<div class="homeBanner">
<p><?php echo escape($home['line1']); ?></p>
<img alt="Banner image one" src="<?php echo ROOT; ?>data/home/<?php echo escape($home['image1']); ?>" />
</div>

<div class="homeBanner">
<p><?php echo escape($home['line2']); ?></p>
<img alt="Banner image two" src="<?php echo ROOT; ?>data/home/<?php echo escape($home['image2']); ?>" />
</div>

<div class="homeBanner">
<p><?php echo escape($home['line3']); ?></p>
<img alt="Banner image three" src="<?php echo ROOT; ?>data/home/<?php echo escape($home['image3']); ?>" />
</div>