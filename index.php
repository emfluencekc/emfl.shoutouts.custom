<?php

require_once 'inc/common.functions.php';
require_once 'inc/submit.functions.php';

emfl_init();

if(!empty($_GET['shouted'])) {
  require 'inc/submit.success.php';
  die();
}

$required = array('message', 'to_name', 'category_slug');
$has_valid_submission = FALSE;
if(!empty($_POST)) {
  $missing = array();
  foreach($required as $field_name) {
    if(empty($_POST[$field_name]) || ('' === trim($_POST[$field_name]))) $missing[] = $field_name;
  }
  if(empty($missing)) $has_valid_submission = TRUE;
}
if($has_valid_submission) {
  emfl_store_submission($_POST['from_name'], $_POST['to_name'], $_POST['category_slug'], $_POST['message']);
  $protocol = empty($_SERVER['HTTPS']) ? 'http://' : 'https://';
  header('Location: ' . $protocol . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . '?shouted=out');
  die();
}

require 'inc/submit.form.php';
die();
