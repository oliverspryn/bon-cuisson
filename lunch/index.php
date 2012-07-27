<?php
//Include the mobile detection library
	require_once("../Mobile_Detect.php");
	
	$detect = new Mobile_Detect();
	
	if ($detect->isMobile() || $detect->isTablet()) {
		header("Location: http://gccsga.sytes.net:256/Bon%20Cuisson//mobile/#page33");
	} else {
		header("Location: http://gccsga.sytes.net:256/Bon%20Cuisson/#/lunch");
	}
?>