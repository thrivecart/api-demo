<?php
require('config.php');
?><!DOCTYPE html>
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
			<?php
			if(!isset($_GET['access_token'])) die('<p>Error! No access token provided!</p><a class="button" href="index.php">Click here to connect to ThriveCart</a>');

			$access_token = trim($_GET['access_token']);

			// Try to get an access token using the authorization code grant.
			$accessToken = new \League\OAuth2\Client\Token\AccessToken(array('access_token' => $access_token));

			// Using the access token, we may look up details about the account and the connected user
			try {
			  $resourceOwner = $provider->getResourceOwner($accessToken);
			} catch(Exception $e) {
				switch($e->getMessage()) {
					case 'invalid_token':
						die('<p>Error! You have revoked access to your ThriveCart account. Click the button below to re-connect.</p><a class="button" href="index.php">Click here to connect to ThriveCart</a>');
						break;
					default:
						die('<p>An unknown error occurred: '.$e->getMessage().'</p><a class="button" href="index.php">Click here to connect to ThriveCart</a>');
						break;
				}
			}

			echo '<h3>Connection successful!</h3>';
			echo '<p>You should store the access token <pre>'.$accessToken.'</pre> and use it to make future requests. This token will not expire, but the user can revoke it from within ThriveCart. For now, let\'s load a list of the products this user has access to.</p>';

			echo '<hr/>';

			echo '<h6>Account/user information</h6>';
			echo '<pre>';
			var_export($resourceOwner->toArray());
			echo '</pre>';

			echo '<h6>List of products in the account</h6>';
			echo '<pre>';
			$request = $provider->getAuthenticatedRequest(
			    'GET',
			    'http://dev-thrivecart.com/api/external/products',
			    $accessToken
			);

			$client = new GuzzleHttp\Client();
			$response = $client->send($request);

			// print_r($response->getBody());
			print_r(json_decode($response->getBody()));
			// print_r($response->getHeaders());

			echo '</pre>';

			echo '<h6>Revoke access</h6>';
			echo '<a href="oauth_revoke.php?access_token='.$access_token.'">Click here to revoke access to this account</a>';
			?>
		</div>
	</section>
</main>
</body>
</html>