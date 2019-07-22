<!DOCTYPE html>
<html>
<head>
<title>ThriveCart API Demo</title>
<link rel="stylesheet" href="assets/bulma.css" />
<link rel="stylesheet" href="assets/style.css" />
</head>
<body>

<main>
	<section class="container">
		<h1 class="title">ThriveCart API</h1>
	</section>

	<section class="container">
		<div class="content">
			<p>Welcome to the ThriveCart API demo.</p>
			<p>Depending on your application's setup, you have two choices - you can either 'roll your own' integration and use any OAuth library to get an access token from our OAuth endpoint, or, you can use our PHP library to make it even easier.</p>
			<p>Click one of the two buttons below to see a demonstration, and view the relevant file's source code to follow along.</p>

			<h4 class="subtitle is-5">Requirements</h4>
			<ul>
				<li>PHP OAuth library (our example is built with <a href="https://github.com/thephpleague/oauth2-client">league/oauth2-client</a>)</li>
				<li>Active ThriveCart account (both Standard and Pro have this functionality)</li>
			</ul>

			<h4 class="subtitle is-5">Get started with the OAuth demo</h4>
			<p><a class="button" href="oauth_example.php">Click here to connect your ThriveCart account</a></p>

			<h4 class="subtitle is-5">Get started with the PHP library demo</h4>
			<p><a class="button" href="lib_example.php">Click here to connect your ThriveCart account</a></p>
		</div>
	</section>
</main>

</body>
</html>