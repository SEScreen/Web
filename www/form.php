<?php
function getUrl($port=8080) {
  $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
  $url .= ( $port != 80 ) ? ":".$port : "";
  return $url;
}
?>
<html>
<head>
<meta charset="UTF-8">
</head>
<body>
<FORM ACTION="<?=getUrl();?>/upload" ENCTYPE="multipart/form-data" METHOD="POST">
<input type="file" name="file" id="file"/>
<input type="text" name="apikey" id="apikey"/>
<input type="submit"/>
<FORM>
</body>
</html>