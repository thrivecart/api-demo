<?php
include 'bootstrap.php';

if(!isset($_GET['access_token'])) die('No token provided: <a href="oauth.php">Click here to start the flow</a>');

$access_token = trim($_GET['access_token']);

// Create the token
$accessToken = new \League\OAuth2\Client\Token\AccessToken(array('access_token' => $access_token));

// Make the customised revoke request
echo '<br /><br />Revoke response<br /><pre>';
$request = $provider->getAuthenticatedRequest(
    'POST',
    'https://thrivecart.com/authorization/revoke',
    $accessToken,
    array(
      'body' => json_encode(array('token' => $access_token)),
      'headers' => array(
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
      ),
    )
);

$client = new GuzzleHttp\Client();
$response = $client->send($request);

print_r((string)$response->getBody());
// print_r($response->getHeaders());