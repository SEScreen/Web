<html>
<body>
<?php
function getUrl($port=8080) {
  $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
  $url .= ( $port != 80 ) ? ":".$port : "";
  return $url;
}
echo getUrl(8080)."/i/тест";
?>
<br>

<!-- Include required JS files -->
<script type="text/javascript" src="js/shCore.js"></script>
 
<!--
    At least one brush, here we choose JS. You need to include a brush for every 
    language you want to highlight
-->
<script type="text/javascript" src="js/shBrushPhp.js"></script>
 
<!-- Include *at least* the core style and default theme -->
<link href="css/shCore.css" rel="stylesheet" type="text/css" />
<link href="css/shThemeDefault.css" rel="stylesheet" type="text/css" />
 
<!-- You also need to add some content to highlight, but that is covered elsewhere. -->
<pre class="brush: php html">
function getUrl($port=8080) {
  $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
  $url .= ( $port != 80 ) ? ":".$port : "";
  return $url;
}
<a href="<?=getUrl()?>/i/...">link</a> 
</pre>
 
<!-- Finally, to actually run the highlighter, you need to include this JS on your page -->
<script type="text/javascript">
     SyntaxHighlighter.all()
</script>


</body>
</html>
