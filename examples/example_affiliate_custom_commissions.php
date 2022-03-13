<?php
include '../bootstrap.php';

// These parameters are just for the example site
$example_name = 'Set custom commissions';
include 'inc.header.php';
?>

<?php

/*  Example commission object definitions

	- Pay a fixed amount, instantly
	{"type": "fixed", "payout_schedule": "instant", "upfront_amount": 1000, "bump_amount": 2000}

	- Pay a percentage, which is due to be paid manually after 7 days
	{"type": "percentage", "payout_schedule": "manual", "balance_delay": 7, "upfront_percentage": 10.31, "bump_percentage": 49.9994}
	
	- Pay a percentage, which has 10% paid out immediately, and then the remaining amounts after 90 days
	{"type": "percentage", "payout_schedule": "partial", "upfront_payout_percentage": 10, "balance_delay": 90, "upfront_percentage": 23, "bump_percentage": 25}

	- Pay on a particular day of the month
	{"type": "fixed", "payout_schedule": "accrue_date", "payment_date": 31, "upfront_amount": 1000, "bump_amount": 2000}

	- Pay once a certain number of sales are made
	{"type": "fixed", "payout_schedule": "accrue_sales", "required_sales": 16, "upfront_amount": 1000, "bump_amount": 2000}

	- Pay once a certain dollar value of commissions are earned ($5000)
	{"type": "percentage", "payout_schedule": "accrue_amount", "required_value": 500000, "upfront_percentage": 15, "bump_percentage": 15}

	- Pay out in bulk once $2500 in commissions are earned
	{"type": "percentage", "payout_schedule": "accrue_amount", "required_value": 250000, "upfront_percentage": 15, "bump_percentage": 15, "aggregate_type": "bulk"}

*/

// Do we have an affiliate ID?
if(!empty($_POST['affiliate_id'])) {
	// Let's get the email we want to search by
	$affiliate_id = trim($_POST['affiliate_id']);

	// Get the product ID
	$product_id = trim($_POST['product_id']);

	// Get the definition
	$commission_object = $_POST['commission_object'];

	// Initialise our API object
	$tc = new \ThriveCart\Api($access_token);

	// Now let's make our API request
	try {
		$response = $tc->setCustomCommissions($affiliate_id, array(
			'product_id' => $product_id,
			'commission_object' => $commission_object,
		));

		// Let's output the result of the operation
		echo '<pre class="output-debug">';
			print_r($response);
		echo '</pre>';
	} catch(\ThriveCart\Exception $e) {
		echo '<div class="notification is-danger is-light">There was an error while applying custom commissions to this affiliate: '.$e->getMessage().'</div>';
	}
}

// We have no incoming search request, so let's output a simple form to search for a customer's email or info
if(empty($_POST['affiliate_id'])) {
	echo '<article class="message is-info"><div class="message-body">';
		echo 'In this example, we will set up custom commissions for a particular product. Custom commissions always apply regardless of which pricing option is purchased. See the source code for some example blocks.';
	echo '</div></article>';

	echo '<form action="example_affiliate_custom_commissions.php?access_token='.$access_token.'" method="post">';
		echo '<div class="field">';
			echo '<label class="label">Enter an affiliate\'s email address, affiliate ID, or their numeric user ID</label>';
			echo '<div class="control">';
				echo '<input class="input" type="text" placeholder="12345 / some_affiliate_id / myaffiliate@example.com" name="affiliate_id" />';
			echo '</div>';
		echo '</div>';

		echo '<div class="field">';
			echo '<label class="label">Enter the numeric product ID</label>';
			echo '<div class="control">';
				echo '<input class="input" type="number" placeholder="512" name="product_id" />';
			echo '</div>';
		echo '</div>';

		echo '<div class="field">';
			echo '<label class="label">JSON object describing custom commissions to apply</label>';
			echo '<div class="control">';
				echo '<textarea class="input" name="commission_object" style="min-height:10em;"></textarea>';
			echo '</div>';
		echo '</div>';

		echo '<div class="field is-grouped">';
			echo '<div class="control">';
				echo '<button class="button is-link">Set custom commissions</button>';
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