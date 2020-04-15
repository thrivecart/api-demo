<?php
include '../bootstrap.php';

// These parameters are just for the example site
$example_name = 'Resume subscription';
include 'inc.header.php';
?>

<?php

// To use this example, you need to pass in the order ID and subscription ID to resume
// See the customer info example to see how to obtain these parameters from a customer's list of purchases or subscriptions
if(empty($_GET['order_id']) || empty($_GET['subscription_id'])) {
	echo '<div class="notification is-danger is-light">You must provide an order ID and subscription ID to resume a subscription. These can be found in the responses from order searching, or from pulling up a customer\'s info. Navigate to the customer example for a full demo of how to resume a subscription.</div>';
	return;
}

// Do we have confirmation? If not, let's confirm to issue this cancellation
if(!isset($_GET['confirm']) || empty($_GET['confirm'])) {
	echo '<div class="notification is-danger is-light">';
		echo '<p>Are you sure you want to resume this subscription?</p>';
		echo '<a class="button is-danger" href="example_subscription_resume.php?'.http_build_query(array(
			'access_token' => $_GET['access_token'],
			'order_id' => $_GET['order_id'],
			'subscription_id' => $_GET['subscription_id'],
			'confirm' => true,
		)).'">Yes, resume this subscription</a>';
	echo '</div>';
	return;
}

// Do we have all the parameters? Then let's run the API endpoint
$order_id = trim($_GET['order_id']);
$subscription_id = trim($_GET['subscription_id']);

// Initialise our API object
$tc = new \ThriveCart\Api($access_token);

// Now let's make our API request
try {
	$response = $tc->resumeSubscription(array(
		'order_id' => $order_id,
		'subscription_id' => $subscription_id,
	));

	// And finally, let's output everything so you can see all of what is returned
	echo '<h4>Raw response</h4>';
	echo '<pre style="max-height: 20em;">';
		print_r($response);
	echo '</pre>';

} catch(\ThriveCart\Exception $e) {
	echo '<div class="notification is-danger is-light">There was an error trying to resume this subscription: '.$e->getMessage().'</div>';
}

// Display our 'go back' link
echo '<hr/>';
echo '<p><a href="index.php?access_token='.$access_token.'">&laquo; Go back</a> to the examples list.</p>';
?>

<?php
include 'inc.footer.php';
?>