<?php

function emfl_init() {
  $folder_name = 'submissions';
  $dest_folder = realpath('./' . $folder_name);
  if(file_exists($dest_folder)) return;
  if(!mkdir( realpath('./') . '/' . $folder_name, 0750 )) throw new Exception(
      'Could not create submissions directory in project root. Please change file permissions to allow the creation of the directory here: ' . realpath('./')
  );
}

function emfl_store_submission($from_name, $to_name, $category_slug, $message) {
  $from_name = trim(strip_tags($from_name));
  $to_name = trim(strip_tags($to_name));
  $category_slug = trim(strip_tags($category_slug));
  $message = trim(emfl_sanitize_html($message));

  $folder_name = 'submissions';
  $dest_folder = realpath('./' . $folder_name);
  $filepath = $dest_folder . '/'
      . date('Y-m-d')
      . '_' . time()
      . '.json';
  // ensure that we're not overwriting an existing file
  $incr = 0;
  while(file_exists($filepath)) {
    $filepath = $dest_folder . '/'
        . date('Y-m-d')
        . '_' . time()
        . '_' . ++$incr
        . '.json';
  }
  $handle = fopen( $filepath, "w");
  if(FALSE === $handle) throw new Exception('Could not open new submission file here: ' . $filepath . '. Could be a permissions issue.');
  $timestamp = time();
  $wrote = fwrite($handle, json_encode(compact('from_name', 'to_name', 'category_slug', 'message', 'timestamp')));
  if(FALSE === $wrote) throw new Exception('Could not write to submission file here: ' . $filepath . '. Could be a permissions issue.');
  fclose($handle);
  chmod($filepath, 0750);

  return TRUE;
}

/**
 * Use in form select options.
 * Return the selected="selected" if $value = $_POST[$name].
 * @param string $name The select name.
 * @param string $value The option value
 * @return string
 */
function emfl_form_selected($name, $value) {
  if(empty($_POST[$name])) return '';
  if($value === $_POST[$name]) return 'selected="selected"';
  return '';
}

/**
 * Use in form input and textarea values.
 * Return the (sanitized) submitted value or nothing if not submitted.
 * @param string $name The element name per $_POST
 * @return string
 */
function emfl_form_input_value($name) {
  if(!empty($_POST[$name])) return emfl_sanitize_html($_POST[$name]);
  return '';
}
