<!DOCTYPE html>
<html lang="en-US"> 
<head>
<title></title>
<meta charset="UTF-8" />
<style media="screen">
  html, body  {
    height:100%;
  }
  
  body {
    background-color: #141414;
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
<script src="swfobject.js"></script>
<script src="swfaddress.js"></script>
<script src="javascripts/hijax-redirect.js"></script>
<script>
    var swfVersionStr = "11.1.0";
    var xiSwfUrlStr = "playerProductInstall.swf";
    var flashvars = {};
    var params = {};
    params.quality = "high";
    params.bgcolor = "#141414";
    params.allowscriptaccess = "sameDomain";
    params.allowfullscreen = "true";
    var attributes = {};
    attributes.id = "Main";
    attributes.name = "Main";
    attributes.align = "middle";
    swfobject.embedSWF("Main.swf", "flashContent", "100%", "100%", swfVersionStr, xiSwfUrlStr, flashvars, params, attributes);
    swfobject.createCSS("#flashContent", "display:block;text-align:left;");
</script>
</head>

<body>
<section id="flashContent"></section>

<noscript>

</noscript>     
</body>
</html>