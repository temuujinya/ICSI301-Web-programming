<!doctype html>

<html lang="en">
  <head>
    <title>Student App <?php if (isset($page_title)) {
    echo '- '.h($page_title);
} ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('static/stylesheet/bootstrap.css'); ?>" />
    <link rel="stylesheet" media="all" href="<?php echo url_for('static/stylesheet/main.css'); ?>" />
		<script src="<?php echo url_for('static/javascript/my.js'); ?>"></script>
  <!-- For datepicker-->
  <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css" rel="stylesheet" type="text/css">
  </head>

  <body>
	<?php include_once SHARED_PATH.'/main_navigation.php'; ?>
	<div class="container-fluid">
	<div class="row">



	<div class="col">



