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
			<p>Depending on your setup, you can either 'roll your own' and base your integration using any PHP Oauth library, or you can follow along with our PHP SDK as in this demo.</p>
			<p><a href="https://documenter.getpostman.com/view/11065483/Szf26qmb?version=latest#intro">Postman-powered documentation is available</a> to see examples in languages other than PHP.</p>

			<h4 class="subtitle is-5">Requirements</h4>
			<ul>
				<li>Active ThriveCart account</li>
				<li>Client ID and secret key</li>
			</ul>

			<h4 class="subtitle is-5">Installation</h4>
			<pre>composer install marcfowler/thrivecart-php-api</pre>

			<h4 class="subtitle is-5">Setup</h4>
			<p>Open the <code>bootstrap.php</code> file and add in your client ID, client secret, and redirect URI. These were provided to you when we established your access to this API.</p>
			<p><b>Important</b>: you will not be able to use the API without these credentials.</p>

			<h4 class="subtitle is-5">Usage</h4>
			<p>We recommend viewing the <code>oauth_example.php</code> source code for help establishing your API token to interact with your account.</p>

			<h4 class="subtitle is-5">Get started with the demo</h4>
			<p><a class="button" href="oauth_example.php">Click here to connect your ThriveCart account</a></p>
		</div>
	</section>
</main>

</body>
</html>