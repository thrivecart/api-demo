<?php
include '../bootstrap.php';

// These parameters are just for the example site
$example_name = 'Approve a pending affiliate application';
include 'inc.header.php';
?>

<?php

// Do we have an affiliate ID?
if(!empty($_POST['affiliate_id'])) {
	// Let's get the email we want to search by
	$affiliate_id = trim($_POST['affiliate_id']);

	// Initialise our API object
	$tc = new \ThriveCart\Api($access_token);

	// Now let's make our API request
	try {
		$response = $tc->approveAffiliate($affiliate_id, array(
			'product_ids' => json_encode(array(
				$_POST['product_id'],
			)),
			'trigger_emails' => true,
		));

		// Let's output the result of the operation
		echo '<pre class="output-debug">';
			print_r($response);
		echo '</pre>';
	} catch(\ThriveCart\Exception $e) {
		echo '<div class="notification is-danger is-light">There was an error while approving this affiliate: '.$e->getMessage().'</div>';
	}
}

// We have no incoming search request, so let's output a simple form to search for a customer's email or info
if(empty($_POST['affiliate_id'])) {
	echo '<article class="message is-info"><div class="message-body">';
		echo 'In this example, we will approve an affiliate whose application for a product is already pending.';
	echo '</div></article>';

	echo '<form action="example_affiliate_approve.php?access_token='.$access_token.'" method="post">';
		echo '<div class="field">';
			echo '<label class="label">Enter an affiliate\'s email address, affiliate ID, or their numeric user ID</label>';
			echo '<div class="control">';
				echo '<input class="input" type="text" placeholder="12345 / some_affiliate_id / myaffiliate@example.com" name="affiliate_id" />';
			echo '</div>';
		echo '</div>';

		echo '<div class="field">';
			echo '<label class="label">Enter the numeric product ID to approve them for (<b>Remember</b>: they must already have a pending approval for this product)</label>';
			echo '<div class="control">';
				echo '<input class="input" type="number" placeholder="512" name="product_id" />';
			echo '</div>';
		echo '</div>';

		echo '<div class="field is-grouped">';
			echo '<div class="control">';
				echo '<button class="button is-link">Approve affiliate</button>';
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