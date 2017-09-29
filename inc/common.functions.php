<?php

function emfl_sanitize_html($input) {
  require_once 'vendor/htmlpurifier/HTMLPurifier.auto.php';
  $config = HTMLPurifier_Config::createDefault();
  $config->set('HTML.Allowed', 'p,b,strong,a[href],i,em,iframe,img');
  $config->set('HTML.AllowedAttributes', array('a.href', 'img.src', 'img.style', '*.class', '*.alt', '*.title', '*.border', 'a.target', 'a.rel','iframe.src'));
  $config->set('AutoFormat.AutoParagraph', true);
  $config->set('AutoFormat.RemoveEmpty.Predicate', array('iframe' => array ('src')));
  $config->set('HTML.SafeIframe', TRUE);
  $config->set('URI.SafeIframeRegexp', '%^https://(www.youtube.com/embed/|player.vimeo.com/video/|giphy.com/embed/)%');
  $purifier = new HTMLPurifier($config);
  return $purifier->purify($input);
}
