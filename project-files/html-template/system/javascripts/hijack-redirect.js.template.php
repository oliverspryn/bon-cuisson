<?php
//Include the system core
	require_once("../server/root.php");
	
//Output this file as JavaScript
	header("Content-type: text/javascript");
?>
/**
 * Executes before the DOM is ready!!! 
 *
 * This code will parse a URL request like this:
 * 
 *     http://example.com/page
 * 
 * and redirect it to this:
 * 
 *     http://example.com/#/page
 * 
 * for usage by the Flash version of the site, if the user has the
 * required version of Flash player installed.
*/

	var baseURL = '<?php echo ROOT; ?>';
	var URL = document.location.href;
	var hijack = window.location.hash;
	
//If the hash URL is empty, then we need to redirect to the hashed URL
	if (baseURL.length < URL.length && hijack == '' && swfobject.hasFlashPlayerVersion('${version_major}.${version_minor}.${version_revision}')) {
		var newHash = URL.substr(baseURL.length, URL.length);
		document.location.href = baseURL + '#/' + newHash;
	}