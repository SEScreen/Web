<?php
function getUrl($port=8080) {
  $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
  $url .= ( $port != 80 ) ? ":".$port : "";
  return $url;
}
?>