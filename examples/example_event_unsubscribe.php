<?php
include '../bootstrap.php';

// These parameters are just for the example site
$example_name = 'Cancel an event subscription';
include 'inc.header.php';
?>

<?php
// Do we have a confirmation to perform this action? Then let's run the API endpoint
if(!empty($_GET['action']) && $_GET['action'] === 'unsubscribe') {
	// What is the URL we want to receive these events?
	$target_url = trim(urldecode($_GET['target_url']));

	// Initialise our API object
	$tc = new \ThriveCart\Api($access_token);

	// Now let's make our API request
	try {
		$response = $tc->cancelEventSubscription($target_url);

		// Let's output these results - they could be formatted in a table, a list, etc
		echo '<pre class="output-debug">';
			print_r($response);
		echo '</pre>';
	} catch(\ThriveCart\Exception $e) {
		echo '<div class="notification is-danger is-light">There was an error while removing this event subscription: '.$e->getMessage().'</div>';
	}
} else {
	$target_url = '';
	if(isset($_GET['target_url'])) {
		$target_url = trim(urldecode($_GET['target_url']));
	}

	echo '<div class="notification is-danger is-light">This example will remove an event subscription. Check out the <a href="https://developers.thrivecart.com/documentation/event_subscription/intro/">developer documentation</a> to learn more about event subscriptions, and if you are ready to continue, <a href="example_event_unsubscribe.php?access_token='.$access_token.'&action=unsubscribe&target_url='.urlencode($target_url).'">click here to continue</a>!</div>';
}

// Display our 'go back' link
echo '<hr/>';
echo '<p><a href="index.php?access_token='.$access_token.'">&laquo; Go back</a> to the examples list.</p>';
?>

<?php
include 'inc.footer.php';
?>