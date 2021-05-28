<?php
include '../bootstrap.php';

// These parameters are just for the example site
$example_name = 'Read affiliate commissions';
include 'inc.header.php';
?>

<?php

// Do we have a product ID?
if(!empty($_POST['product_id'])) {
	// Get the product ID
	$product_id = trim($_POST['product_id']);

	// Do we also want to refine by a particular affiliate?
	$affiliate_id = trim($_POST['affiliate_id']);

	// Initialise our API object
	$tc = new \ThriveCart\Api($access_token);

	// Now let's make our API request
	try {
		$response = $tc->getProductPricing($product_id, array(
			'affiliate_id' => $affiliate_id,
		));

		// Let's output the result of the operation
		echo '<article class="message is-info"><div class="message-body">';
			echo 'In each pricing option below, if affiliate promotion is enabled for the product, a key named <code>affiliate_commissions</code> will be set which breaks down the relevant commissions should a customer purchase that pricing option. If this key is not set, affiliate promotion is not enabled on the product.';
		echo '</div></article>';

		echo '<pre class="output-debug">';
			print_r($response);
		echo '</pre>';
	} catch(\ThriveCart\Exception $e) {
		echo '<div class="notification is-danger is-light">There was an error while reading affiliate commissions: '.$e->getMessage().'</div>';
	}
}

// We have no incoming search request, so let's output a simple form to search for a customer's email or info
if(empty($_POST['product_id'])) {
	echo '<article class="message is-info"><div class="message-body">';
		echo 'In this example, we will view the commissions that an affiliate will earn if they refer a sale for a product. Note that the product must have affiliate promotion enabled in it\'s settings or no commission-related info will be returned.';
	echo '</div></article>';

	echo '<form action="example_affiliate_get_commissions.php?access_token='.$access_token.'" method="post">';
		echo '<div class="field">';
			echo '<label class="label">Enter the numeric product ID</label>';
			echo '<div class="control">';
				echo '<input class="input" type="number" placeholder="512" name="product_id" />';
			echo '</div>';
		echo '</div>';

		echo '<div class="field">';
			echo '<label class="label">(Optional) Enter an affiliate\'s email address, affiliate ID, or their numeric user ID to return info specific to them, as they may have custom commission settings</label>';
			echo '<div class="control">';
				echo '<input class="input" type="text" placeholder="12345 / some_affiliate_id / myaffiliate@example.com" name="affiliate_id" />';
			echo '</div>';
		echo '</div>';

		echo '<div class="field is-grouped">';
			echo '<div class="control">';
				echo '<button class="button is-link">Get pricing details</button>';
			echo '</div>';
		echo '</div>';

	echo '</form>';
}

// Display our 'go back' link
echo '<hr/>';
echo '<p><a href="index.php?access_token='.$access_token.'">&laquo; Go back</a> to the examples list.</p>';
?>

<?php
include 'inc.footer.php';
?>