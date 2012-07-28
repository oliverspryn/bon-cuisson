<!DOCTYPE html>
<html lang="en-US"> 
<head>
<title>${title}</title>
<meta charset="UTF-8" />
<link rel="stylesheet" href="history/history.css" />
<style media="screen">
  html, body  {
    height:100%;
  }
  
  body {
    background-color: ${bgcolor};
    margin:0;
    padding:0;
    overflow:auto;
    text-align:center;
  }   
  
  object:focus {
    outline:none;
  }
  
  #flashContent {
    display:none;
  }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="javascripts/hijax-redirect.js"></script>
<script src="history/history.js"></script>
<script src="swfobject.js"></script>
<script src="swfaddress.js"></script>
<script>
    var swfVersionStr = "${version_major}.${version_minor}.${version_revision}";
    var xiSwfUrlStr = "${expressInstallSwf}";
    var flashvars = {};
    var params = {};
    params.quality = "high";
    params.bgcolor = "${bgcolor}";
    params.allowscriptaccess = "sameDomain";
    params.allowfullscreen = "true";
    var attributes = {};
    attributes.id = "${application}";
    attributes.name = "${application}";
    attributes.align = "middle";
    swfobject.embedSWF("${swf}.swf", "flashContent", "${width}", "${height}", swfVersionStr, xiSwfUrlStr, flashvars, params, attributes);
    swfobject.createCSS("#flashContent", "display:block;text-align:left;");
</script>
</head>

<body>
<div id="flashContent">
<p>To view this page ensure that Adobe Flash Player version ${version_major}.${version_minor}.${version_revision} or greater is installed.</p>

<script> 
  var pageHost = ((document.location.protocol == "https:") ? "https://" : "http://"); 
  document.write("<a href='http://www.adobe.com/go/getflashplayer'><img src='" + pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif' alt='Get Adobe Flash player' /></a>" ); 
</script> 
</div>

<noscript>
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="${width}" height="${height}" id="${application}">
<param name="movie" value="${swf}.swf" />
<param name="quality" value="high" />
<param name="bgcolor" value="${bgcolor}" />
<param name="allowScriptAccess" value="sameDomain" />
<param name="allowFullScreen" value="true" />

<!--[if !IE]>-->
<object type="application/x-shockwave-flash" data="${swf}.swf" width="${width}" height="${height}">
<param name="quality" value="high" />
<param name="bgcolor" value="${bgcolor}" />
<param name="allowScriptAccess" value="sameDomain" />
<param name="allowFullScreen" value="true" />
<!--<![endif]-->

<!--[if gte IE 6]>-->
<p>Either scripts and active content are not permitted to run or Adobe Flash Player version ${version_major}.${version_minor}.${version_revision} or greater is not installed.</p>
<!--<![endif]-->

<a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash Player" /></a>
<!--[if !IE]>-->
</object>
<!--<![endif]-->
</object>
</noscript>     
</body>
</html>
