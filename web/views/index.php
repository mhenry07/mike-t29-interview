<?php
header('Content-Type: text/html; charset=utf-8');
// note: $model is an instance of \MikeT29\Models\IndexViewModel
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Mike Henry">

  <title>Three29 Test - Mike Henry</title>
  <?php foreach ($model->stylesheets as $stylesheet) { ?>
    <link rel="stylesheet" href="<?= htmlspecialchars($stylesheet) ?>">
  <?php } ?>
	<style>
		#div1 {
		  background-image: url("<?= htmlspecialchars($model->cover_image) ?>");
		}
		#div2 {
		  background-image: url("<?= htmlspecialchars($model->random_image) ?>");
		}
	</style>
  <script defer src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <?php foreach ($model->scripts as $script) { ?>
    <script defer src="<?= htmlspecialchars($script) ?>"></script>
  <?php } ?>
</head>
<body>
<div id="wrapper">
	<div id="div1" class="divitem <?= $model->toggled_classes['div1'] ?>">
	</div>
	<div id="div2" class="divitem <?= $model->toggled_classes['div2'] ?>">
	</div>
	<div id="div3" class="divitem <?= $model->toggled_classes['div3'] ?>">
	</div>
	<div id="div4" class="divitem <?= $model->toggled_classes['div4'] ?>">
    <span class="numbers">
      <?= htmlspecialchars($model->number_string) ?>
    </span>
	</div>
</div>
</body>
</html>
