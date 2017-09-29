<?php
require_once 'inc/common.functions.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Shout-outs</title>
  <link rel="stylesheet" href="css/display.css" />
</head>
<body>
  <h1>emfluence love you</h1>
  <section class="submissions">
  <?php

  $files = glob( __DIR__ . "/submissions/*.json");
  $files = array_reverse($files);
  foreach( $files as $filename ) {
    $submission = file_get_contents($filename);
    if(FALSE === $submission) throw new Exception('Could not read submission ' . $filename . '. Maybe a permissions issue.');
    $submission = json_decode($submission, TRUE);
    ?>
    <article class="<?php echo htmlspecialchars($submission['category_slug']); ?>">
      <h3>Shout-out to <?php echo emfl_sanitize_html($submission['to_name']); ?></h3>
      <p class="message"><?php echo emfl_sanitize_html($submission['message']); ?></p>
      <?php if(!empty($submission['from_name'])) { ?>
      <p class="from">From <?php echo emfl_sanitize_html($submission['from_name']); ?></p>
      <?php } ?>
    </article>
    <?php
  }
  ?>
  </section>
<script>
  setTimeout(function() { document.location = document.location; }, 1000*10);
</script>
</body>
</html>
