<?php
include '../bootstrap.php';

// These parameters are just for the example site
$example_name = 'View connected account info';
include 'inc.header.php';
?>

<?php
// Initialise our API object
$tc = new \ThriveCart\Api($access_token);

// Now let's make our API request
try {
	$response = $tc->ping(); // Get the info about this account

	// Let's output these results - they could be formatted in a table, a list, etc
	echo '<pre class="output-debug">';
		print_r($response);
	echo '</pre>';
} catch(\ThriveCart\Exception $e) {
	echo '<div class="notification is-danger is-light">There was an error while checking this access token: '.$e->getMessage().'</div>';
}

// Display our 'go back' link
echo '<hr/>';
echo '<p><a href="index.php?access_token='.$access_token.'">&laquo; Go back</a> to the examples list.</p>';
?>

<?php
include 'inc.footer.php';
?>