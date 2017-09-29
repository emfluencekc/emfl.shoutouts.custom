<?php

function emfl_sanitize_html($input) {
  require_once 'vendor/htmlpurifier/HTMLPurifier.auto.php';
  $config = HTMLPurifier_Config::createDefault();
  $purifier = new HTMLPurifier($config);
  return $purifier->purify($input);
}
