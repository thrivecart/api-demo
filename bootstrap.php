<?php
// Include composer
include 'vendor/autoload.php';

// @important You do not need to use OAuth if you are developing an app that is only meant to integrate with your own account!
// If your app is designed for your own account, you can create an API token from the Settings area and use that as your access token
// Set up our identity provider, giving it the clientId, clientSecret and redirectUri
// Remember that you must have registered this redirect URL inside of your app's settings, or we won't redirect the user back to it
$provider = new \ThriveCart\Oauth([
	'clientId' => 'thrivecart-demo-app', // Your application's client ID
	'clientSecret' => 'sk_50d7afb5507a02467bde23d7ee4a0c54', // Your application's client secret
	'redirectUri' => 'http://localhost/thrivecart-api-demo/oauth_example.php', // URL to be redirected to after OAuth acceptance
]);

// @note Remove this line to switch to live mode, but remember, you will be performing real actions (refunds, cancellations, etc)
\ThriveCart\Api::setMode('test');