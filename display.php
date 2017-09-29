<?php
require_once 'inc/common.functions.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>All the &hearts;</title>
  <link rel="stylesheet" href="css/display.css" />
</head>
<body>
  <h1>emfluence &hearts;</h1>
  <section class="submissions">
  <?php

  $files = glob( __DIR__ . "/submissions/*.json");
  $files = array_reverse($files);
  foreach( $files as $filename ) {
    $submission = file_get_contents($filename);
    if(FALSE === $submission) throw new Exception('Could not read submission ' . $filename . '. Maybe a permissions issue.');
    $submission = json_decode($submission, TRUE);
    ?>
    <article class="<?php echo strtolower(htmlspecialchars($submission['category_slug'])); ?>">
      <h3>Shout-out to <?php echo strip_tags($submission['to_name']); ?></h3>
      <div class="message"><?php echo emfl_sanitize_html($submission['message']); ?></div>
      <?php if(!empty($submission['from_name'])) { ?>
        <p class="from">&mdash; <?php echo strip_tags($submission['from_name']); ?></p>
      <?php } ?>
      <div class="cat"><?php echo strip_tags($submission['category_slug']); ?></div>
    </article>
    <?php
  }
  ?>
  </section>
  <footer>Submit a shout-out here: <?php echo (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['SERVER_NAME'] . str_replace('display.php', '', $_SERVER['REQUEST_URI']); ?></footer>
<script>
  setTimeout(function() { document.location = document.location; }, 1000*10);
</script>
  <link
          rel='stylesheet' id='google-fonts-css'  href='https://fonts.googleapis.com/css?family=Open+Sans%3A300%2C400%2C700%2C900%7CNunito+Sans%3A300%2C400%2C600%2C700%7CMontserrat%3A300%2C400%2C700%2C800%7CMontserrat+Alternates%3A400%2C700&#038;ver=4.8.1' type='text/css' media='all' />
</body>
</html>
