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

			<p>You can interact with the ThriveCart API in one of two ways:</p>

			<ul>
				<li>In your own account, using an API key</li>
				<li>In someone else's account, using an access token obtained via OAuth</li>
			</ul>

			<p>If you're developing within your own account, you can simply head to the Settings area inside of ThriveCart, then click on "API & webhooks", and then "API tokens". If you're developing an application designed for other users to consume, you'll first want to go and <a href="https://developers.thrivecart.com/apps/">create your application</a> and get your credentials.</p>

			<p>Learn more about <a href="https://developers.thrivecart.com/documentation/intro/authentication-via-api-key/">authenticating via API key</a>, or <a href="https://developers.staging.thrivecart.com/documentation/intro/authentication-via-oauth">authenticating via OAuth</a>.</p>

			<p>Note: your use of the API will be rate limited to 60 requests per minute, per account that you are connected to. This should be more than enough for normal usage, but if you are frequently going over this limit, please contact us and we can review. Note that we do not increase rate limits preemptively.</p>

			<p><a href="https://apidocs.thrivecart.com/">View our full API reference</a> to see examples in languages other than PHP.</p>

			<h4 class="subtitle is-5">Requirements</h4>
			<ul>
				<li>Active ThriveCart account</li>
				<li>Client ID and secret key (<a href="https://developers.thrivecart.com/">See the developer site</a>)</li>
			</ul>

			<h4 class="subtitle is-5">Installation</h4>
			<pre>composer install thrivecart/php-api</pre>

			<hr />

			<h4 class="subtitle is-5">Setup when using your own API key</h4>
			<p><a class="button" href="apikey_example.php">Click here to enter your API key</a></p>

			<hr />

			<h4 class="subtitle is-5">Setup when using OAuth</h4>
			<p>Open the <code>bootstrap.php</code> file and add in your client ID, client secret, and the redirect URL you want customers to be taken to after they grant access to your app. As noted, this redirect URL must be registered in your app's settings on <a href="https://developers.thrivecart.com/">the ThriveCart developer site</a>.</p>
			<p>We recommend viewing the <code>oauth_example.php</code> source code for help establishing your OAuth access to interact with an account.</p>

			<h4 class="subtitle is-5">Get started with the OAuth demo</h4>
			<p><a class="button" href="oauth_example.php">Click here to connect your ThriveCart account</a></p>
		</div>
	</section>
</main>

</body>
</html>