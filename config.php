<?php
require('vendor/autoload.php');

if(false) {
	$provider = new \League\OAuth2\Client\Provider\GenericProvider([
	    'clientId'                => 'example-client-1',
	    'clientSecret'            => 'examplepass',
	    'redirectUri'             => 'http://localhost/thrivecart-api-demo/oauth_example.php', // URL to be redirected to after OAuth acceptance
	    'urlAuthorize'            => 'https://thrivecart.com/authorization/new',
	    'urlAccessToken'          => 'https://thrivecart.com/authorization/token',
	    'urlResourceOwnerDetails' => 'https://thrivecart.com/authorization/me',
	]);
} else {
	$provider = new \League\OAuth2\Client\Provider\GenericProvider([
	    'clientId'                => 'example-client-1',
	    'clientSecret'            => 'examplepass',
	    'redirectUri'             => 'http://localhost/thrivecart-api-demo/oauth_example.php', // URL to be redirected to after OAuth acceptance
	    'urlAuthorize'            => 'http://dev-thrivecart.com/authorization/new',
	    'urlAccessToken'          => 'http://dev-thrivecart.com/authorization/token',
	    'urlResourceOwnerDetails' => 'http://dev-thrivecart.com/authorization/me',
	]);
}