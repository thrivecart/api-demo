<?php
include '../bootstrap.php';

// These parameters are just for the example site
$example_name = 'Create a new affiliate';
include 'inc.header.php';
?>

<?php

// Do we have the incoming information?
if(!empty($_POST['email'])) {
	// Let's get the requested affiliate ID
	$affiliate_email = trim($_POST['email']);

	// Let's get the requested affiliate ID
	$affiliate_name = trim($_POST['name']);

	// Let's get the requested affiliate ID
	$affiliate_id = trim($_POST['affiliate_id']);

	// Get the product ID
	$product_id = trim($_POST['product_id']);

	// Initialise our API object
	$tc = new \ThriveCart\Api($access_token);

	// Now let's make our API request
	try {
		$response = $tc->createAffiliate(array(
			'email' => $affiliate_email,
			'name' => $affiliate_name,
			'affiliate_id' => $affiliate_id,
			'product_id' => $product_id,
			'auto_approve' => !empty($_POST['auto_approve']),
		));

		// Let's output the result of the operation
		echo '<pre class="output-debug">';
			print_r($response);
		echo '</pre>';
	} catch(\ThriveCart\Exception $e) {
		echo '<div class="notification is-danger is-light">There was an error while creating a new affiliate: '.$e->getMessage().'</div>';
	}
}

// We have no incoming request, so let's output a simple form to collect info on the affiliate
if(empty($_POST['email'])) {
	echo '<article class="message is-info"><div class="message-body">';
		echo 'In this example, we will create a new affiliate in the ThriveCart platform and add them to a product. If they already exist in the system (based on the email address), they will have an application created for your product.';
	echo '</div></article>';

	echo '<form action="example_affiliate_create.php?access_token='.$access_token.'" method="post">';
		echo '<div class="field">';
			echo '<label class="label">Enter the affiliate\'s email address (will be used to sign in)</label>';
			echo '<div class="control">';
				echo '<input class="input" type="text" placeholder="myaffiliate@example.com" name="email" />';
			echo '</div>';
		echo '</div>';

		echo '<div class="field">';
			echo '<label class="label">Enter the affiliate\'s name</label>';
			echo '<div class="control">';
				echo '<input class="input" type="text" placeholder="Amanda Affiliate" name="name" />';
			echo '</div>';
		echo '</div>';

		echo '<div class="field">';
			echo '<label class="label">Enter the affiliate\'s preferred affiliate ID (this may be modified by the system if unavailable)</label>';
			echo '<div class="control">';
				echo '<input class="input" type="text" placeholder="amandaaffiliate123" name="affiliate_id" />';
			echo '</div>';
		echo '</div>';

		echo '<div class="field">';
			echo '<label class="label">Enter the numeric product ID</label>';
			echo '<div class="control">';
				echo '<input class="input" type="number" placeholder="512" name="product_id" />';
			echo '</div>';
		echo '</div>';

		echo '<div class="field">';
			echo '<label class="label">Auto-approve the application?</label>';
			echo '<div class="control">';
				echo '<input type="checkbox" value="1" name="auto_approve" />';
			echo '</div>';
		echo '</div>';

		echo '<div class="field is-grouped">';
			echo '<div class="control">';
				echo '<button class="button is-link">Create affiliate</button>';
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