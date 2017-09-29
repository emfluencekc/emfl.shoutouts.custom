<!DOCTYPE html>
<html>
<head>
  <title>Submit &hearts;</title>
  <link rel="stylesheet" href="css/submit.css" />
</head>
<body>
  <h1>Submit an emfluence shout-out!</h1>
  <form method="post">

    <div class="row">
      <label for="from_name">Your name</label>
      <input type="text" name="from_name" id="from_name" value="<?php echo htmlspecialchars(emfl_form_input_value('from_name')); ?>" />
    </div>

    <div class="row">
      <label for="to_name">Their name (required)</label>
      <input type="text" name="to_name" id="to_name" required="required" value="<?php echo htmlspecialchars(emfl_form_input_value('to_name')); ?>" />
    </div>

    <div class="row select">
      <label for="category_slug">Company value (required)</label>
      <select name="category_slug" id="category_slug" required="required">
        <option value="">Choose</option>
        <?php
        $name = 'category_slug';
        $values = array('Integrity', 'Respect', 'Excellence', 'Teamwork', 'Passion', 'Accountability', 'Fun');
        foreach($values as $value) {
          echo '<option ' . emfl_form_selected($name, $value) . '>' . $value . '</option>';
        }
        ?>
      </select>
    </div>

    <div class="row">
      <label for="message">Message (required)</label>
      <textarea name="message" id="message" required="required"><?php echo emfl_form_input_value('message'); ?></textarea>
    </div>

    <input type="submit" value="Submit" />
  </form>

  <section class="about">
    <h3>What can you do?</h3>
    <ul>
      <li><a href="https://giphy.com">giphy's</a> (use the embed code)</li>
      <li>&lt;b&gt;bold&lt;/b&gt;, &lt;i&gt;italic&lt;/i&gt;, &lt;a href=&quot;...&quot;&gt;links&lt;a&gt;</li>
      <li><a href="http://www.degraeve.com/reference/specialcharacters.php">HTML special characters</a> like &amp;hearts; = &hearts;</li>
    </ul>
  </section>
</body>
</html>