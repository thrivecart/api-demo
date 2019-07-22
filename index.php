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
			<p>Depending on your application's setup, you can either 'roll your own' and base your integration using any PHP Oauth library, or you can follow along with our built-in PHP library as in this demo.</p>

			<h4 class="subtitle is-5">Requirements</h4>
			<ul>
				<li>PHP OAuth library (our example is built with <a href="https://github.com/thephpleague/oauth2-client">league/oauth2-client</a>)</li>
				<li>Active ThriveCart account (both Standard and Pro have this functionality)</li>
			</ul>

			<h4 class="subtitle is-5">Installation</h4>
			<pre>composer install marcfowler/thrivecart-php-api</pre>

			<h4 class="subtitle is-5">Usage</h4>
			<p>See the readme for examples, or view the oauth_example.php source code.</p>

			<h4 class="subtitle is-5">Get started with the demo</h4>
			<p><a class="button" href="oauth_example.php">Click here to connect your ThriveCart account</a></p>
		</div>
	</section>
</main>

</body>
</html>