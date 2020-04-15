<!DOCTYPE html>
<html>
<head>
<title><?php echo $example_name; ?> &laquo; ThriveCart API Demo</title>
<link rel="stylesheet" href="../assets/bulma.css" />
<link rel="stylesheet" href="../assets/style.css" />
</head>
<body>

<main>
	<section class="container">
		<h1 class="title">ThriveCart API &raquo; <?php echo $example_name; ?></h1>
	</section>

	<section class="container">
		<div class="content">
			<?php
			if(!isset($_GET['access_token']) || empty($_GET['access_token'])) die('<p>Error! No access token provided!</p><a class="button" href="../index.php">Click here to connect to ThriveCart</a>');

			$access_token = trim($_GET['access_token']);
			?>