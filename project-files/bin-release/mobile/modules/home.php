<?php
//Fetch the home page data
	$homeGrabber = mysql_query("SELECT * FROM `home` WHERE `id` = '1'", $db);
	$home = mysql_fetch_array($homeGrabber);
?>
<div class="homeBanner">
<p><?php echo strip($home['line1']); ?></p>
<img alt="Banner image one" src="<?php echo strip($home['image1']); ?>" />
</div>

<div class="homeBanner">
<p><?php echo strip($home['line2']); ?></p>
<img alt="Banner image two" src="<?php echo strip($home['image2']); ?>" />
</div>

<div class="homeBanner">
<p><?php echo strip($home['line3']); ?></p>
<img alt="Banner image three" src="<?php echo strip($home['image3']); ?>" />
</div>