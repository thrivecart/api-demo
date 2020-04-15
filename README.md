# thrivecart-api-demo
Clone the repository, run `composer install` and then run it locally to view and use the demo, and get started with the `oauth_example.php` file.

You can also see [thrivecart-php-api](https://github.com/MarcFowler/thrivecart-php-api/) repository for the underlying library.

We also provide [Postman-powered examples of all API requests](https://documenter.getpostman.com/view/11065483/Szf26qmb?version=latest#intro) which can be read to see examples in languages other than PHP. Note that authorisation via the Bearer header is required.

# ThriveCart API
All responses will always be JSON-encoded. If an `error` key exists, it will contain details of the error in question which you can use.

See `index.php`, `oauth_example.php` and `oauth_request.php` for examples on connecting and gaining permission to access a ThriveCart user's account.

Permission is granted using OAuth 2. Our access tokens do not require refreshing. A user can revoke your platform's access from inside their ThriveCart account, so you will need to handle the permissions being revoked.

## Getting your client ID & client secret
The ThriveCart API is currently by invitation only. You can [contact us at support](https://support.thrivecart.com) to request access.

Your use of the API will be monitored, and is rate-limited to 60 requests per minute, per account that your application is connected to. This should be more than enough for normal usage, but you can contact us to discuss and request an increase if needed.

## Switching out of test mode
By default, this example suite (not the underlying SDK) runs in test mode. This is specified in the `bootstrap.php` file. When you're ready with your integration, remove that line to switch to live mode.

To enable browsing test mode transactions in your ThriveCart dashboard, go to Settings -> Account-wide -> Finances, and toggle the option to switch between live and test modes. Then, at the bottom of your Transactions list, you will be able to switch between these two modes. Actions performed in test mode do not use real funds, and rely on Stripe's test mode. Authorize.net and PayPal do not provide usable test modes, but your interaction with them via API will be the same.

## Exceptions
The library will throw Exceptions which you can intercept and handle as normal. See below for some examples. The message obtained by `getMessage();` is user-readable and safe to display to users.

# Example usage in PHP
```php
<?php
require 'vendor/autoload.php'; // Include Composer

$tc = new \ThriveCart\Api('30d91fbae081c8ca9ab0e41990d0227d20d63a3c'); // Pass our access token into the API to get started; see OAuth examples for details on how to connect

// Get a list of all products in the account
try {
	$products = $tc->getProducts(array(
		'status' => 'live', // Change to 'test' for test-mode products, or omit entirely for all products
	));
	print_r($products);
} catch(\ThriveCart\Exception $e) {
	die('An error occurred: '.$e->getMessage());
}

// Get a single product in the account, identified by ID
try {
	$product = $tc->getProduct(123456789);
} catch(\ThriveCart\Exception $e) {
	switch ($e->getCode()) {
		case '404':
			die('The requested product cannot not found.');
			break;

		default:
			die('Unknown error: '.$e->getMessage());
			break;
	}
}

// Switch to operating in test mode
\ThriveCart\Api::setMode('test');

try {
	$customer = $tc->customer(array(
		'email' => 'examplecustomer@thrivecart.com', // Pass in a customer email to load their details, as well as purchases and subscriptions
	));
} catch(\ThriveCart\Exception $e) {
	die('An error occurred: '.$e->getMessage());
}
```