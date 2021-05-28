<?php
include '../bootstrap.php';

// These parameters are just for the example site
$example_name = 'View product pricing options';
include 'inc.header.php';
?>

<?php
// Do we have an incoming search request? Then let's run the API endpoint
if(!empty($_GET['product_id'])) {
	// Let's get the identifier we want to look up
	$product_id = trim($_GET['product_id']);

	// Initialise our API object
	$tc = new \ThriveCart\Api($access_token);

	// Now let's make our API request
	try {
		$response = $tc->getProductPricing($product_id, array(
			//
		));

		// Let's output these results - they could be formatted in a table, a list, etc
		echo '<pre class="output-debug">';
			print_r($response);
		echo '</pre>';
	} catch(\ThriveCart\Exception $e) {
		echo '<div class="notification is-danger is-light">There was an error while looking up an individual product: '.$e->getMessage().'</div>';
	}
} else {
	echo '<div class="notification is-danger is-light">This example can only be accessed by providing a <code>product_id</code> parameter to look up a single product! Check out the <a href="example_list_products.php?access_token='.$access_token.'">list products</a> example for a demonstration!</div>';
}

// Display our 'go back' link
echo '<hr/>';
echo '<p><a href="index.php?access_token='.$access_token.'">&laquo; Go back</a> to the examples list.</p>';
?>

<?php
include 'inc.footer.php';
?>