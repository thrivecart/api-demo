<?php
// This file is a demonstration of how the connection is performed
// This is extremely similar to the base examples provided by the league/oauth2-client library
// and the concept is transferrable to any Oauth implementation

// This single file handles all of the connection - reporting errors, redirecting to go and get permission, and then storing the access token if successful
// Let's get started!

// First, let's include our common code
include 'bootstrap.php';

// Now let's decide what to do - the 3 options are:
// 1. If there is an error, we'll display that to the user (this happens if they click the 'cancel' button and do not grant permission, etc)
// 2. If there is no code returned, we will redirect to ThriveCart to get access to someone's account
// 3. If there is a code returned, we will validate it, and then store it and move on

// If we don't have an authorization code then get one
if(isset($_GET['error'])) { // Option 1 above
  switch($_GET['error']) {
    case 'access_denied':
      die('You did not grant access to your account. <a href="index.php">Click here to start again</a>.');
      break;
    default:
      die('An unknown error occurred!: '.$_GET['error']);
      break;
  }
} else if (!isset($_GET['code'])) { // Option 2 above; let's redirect to ThriveCart to get access

    // Fetch the authorization URL from the provider; this returns the
    // urlAuthorize option and generates and applies any necessary parameters
    // (e.g. state).
    $authorizationUrl = $provider->getAuthorizationUrl();

    // Get the state generated for you and store it to the session
    $_SESSION['oauth2state'] = $provider->getState();

    // Redirect the user to the authorization URL
    header('Location: ' . $authorizationUrl);
    exit;

// Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || (isset($_SESSION['oauth2state']) && $_GET['state'] !== $_SESSION['oauth2state'])) {

    if (isset($_SESSION['oauth2state'])) {
        unset($_SESSION['oauth2state']);
    }

    exit('Invalid state');

} else {
    try {

        // Try to get an access token using the authorization code grant.
        $accessToken = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);

        // We have an access token, which we may use in authenticated
        // requests against the service provider's API.
        echo 'Access Token: ' . $accessToken->getToken() . "<br>";

        // Using the access token, we may look up details about the
        // resource owner.
        $resourceOwner = $provider->getResourceOwner($accessToken);

        echo 'Owner information:<br />';
        echo '<pre class="output-debug">';
        var_export($resourceOwner->toArray());
        echo '</pre>';

        echo '<a href="oauth_request.php?access_token='.$accessToken->getToken().'">Click here to store this and make requests with it</a>';

    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

        // Failed to get the access token or user details.
        echo '<pre class="output-debug">';
        print_r($e);
        exit('Error: '.$e->getMessage());

    }
}