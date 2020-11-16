<?php
include '../bootstrap.php';

// These parameters are just for the example site
$example_name = 'View affiliate';
include 'inc.header.php';
?>

<?php
// Do we have an incoming search request? Then let's run the API endpoint
if(!empty($_GET['affiliate_id'])) {
	// Let's get the identifier we want to look up
	$affiliate_id = trim($_GET['affiliate_id']);

	// Initialise our API object
	$tc = new \ThriveCart\Api($access_token);

	// Now let's make our API request
	try {
		$response = $tc->affiliate(array(
			'affiliate_id' => $affiliate_id, // You can pass in the numeric user ID, the affiliate_id included in their affiliate links, or their email address
		));

		// Let's output these results - they could be formatted in a table, a list, etc
		echo '<pre class="output-debug">';
			print_r($response);
		echo '</pre>';
	} catch(\ThriveCart\Exception $e) {
		echo '<div class="notification is-danger is-light">There was an error while looking up an individual affiliate: '.$e->getMessage().'</div>';
	}
} else {
	echo '<div class="notification is-danger is-light">This example can only be accessed by providing a <code>affiliate_id</code> parameter to look up a single affiliate! Check out the <a href="example_affiliates.php?access_token='.$access_token.'">search affiliates</a> example for a demonstration!</div>';
}

// Display our 'go back' link
echo '<hr/>';
echo '<p><a href="index.php?access_token='.$access_token.'">&laquo; Go back</a> to the examples list.</p>';
?>

<?php
include 'inc.footer.php';
?>