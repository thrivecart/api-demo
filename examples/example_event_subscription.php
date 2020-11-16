<?php
include '../bootstrap.php';

// These parameters are just for the example site
$example_name = 'Create event subscription';
include 'inc.header.php';
?>

<?php
// Do we have a confirmation to perform this action? Then let's run the API endpoint
if(!empty($_GET['action']) && $_GET['action'] === 'subscribe') {
	// Which events do we want to subscribe to? See documentation for more info
	$event_name = '*';

	// What is the URL we want to receive these events?
	$target_url = trim(urldecode($_GET['target_url']));

	// Initialise our API object
	$tc = new \ThriveCart\Api($access_token);

	// Now let's make our API request
	try {
		$response = $tc->createEventSubscription($event_name, $target_url, array(
			//
		));

		// Let's output these results - they could be formatted in a table, a list, etc
		echo '<pre class="output-debug">';
			print_r($response);
		echo '</pre>';
	} catch(\ThriveCart\Exception $e) {
		echo '<div class="notification is-danger is-light">There was an error while creating your event subscription: '.$e->getMessage().'</div>';
	}

	// Okay, link to unsubscribe?
	echo '<div class="">';
		echo '<a href="example_event_unsubscribe.php?access_token='.$access_token.'&target_url='.urlencode($target_url).'">Click here to unsubscribe</a> this URL.';
	echo '</div>';
} else {
	// Generate a random URL to receive these endpoints
	$target_url = implode('', array(
		(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://'),
		$_SERVER['HTTP_HOST'],
		str_replace(basename($_SERVER['REQUEST_URI']), '', $_SERVER['REQUEST_URI']),
		'target_url.php?uniqid=' . bin2hex(random_bytes(8)),
	));

	echo '<div class="notification is-danger is-light">This example will create an event subscription for all events. Check out the <a href="https://developers.thrivecart.com/documentation/event_subscription/intro/">developer documentation</a> to learn more about event subscriptions, and if you are ready to continue, <a href="example_event_subscription.php?access_token='.$access_token.'&action=subscribe&target_url='.urlencode($target_url).'">click here to continue</a>!</div>';
}

// Display our 'go back' link
echo '<hr/>';
echo '<p><a href="index.php?access_token='.$access_token.'">&laquo; Go back</a> to the examples list.</p>';
?>

<?php
include 'inc.footer.php';
?>