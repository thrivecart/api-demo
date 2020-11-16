<?php
include '../bootstrap.php';

// These parameters are just for the example site
$example_name = 'Customer info';
include 'inc.header.php';
?>

<?php

// Do we have an incoming customer email address? Then let's run the API endpoint
if(!empty($_POST['email'])) {
	// Let's get the email we want to search by
	$customer_email = trim($_POST['email']);

	// Initialise our API object
	$tc = new \ThriveCart\Api($access_token);

	// Now let's make our API request
	try {
		$customer = $tc->customer(array(
			'email' => $customer_email,
		));

		// We've got our customer information, so let's insert a table of all the info we have for this customer
		if(!empty($customer['customer'])) {
			echo '<h4>Customer information</h4>';
			echo '<table class="table is-bordered is-striped is-hoverable is-fullwidth">';
				foreach($customer['customer'] as $key => $value) {
					echo '<tr>';
						echo '<td>';
							echo $key;
						echo '</td>';

						echo '<td>';
							if(is_array($value)) { // The value may be an array of sub-keys, for instance in the case of an address or shipping address
								echo '<pre class="output-debug">';
									print_r($value);
								echo '</pre>';
							} else {
								echo $value;
							}
						echo '</td>';
					echo '</tr>';
				}
			echo '</table>';
		}

		// Now let's show a list of all their one-time purchases
		if(!empty($customer['purchases'])) {
			echo '<h4>One-time purchases</h4>';
			echo '<table class="table is-bordered is-striped is-hoverable is-fullwidth">';
				echo '<thead>';
					echo '<tr>';
						echo '<td>Order ID</td>';
						echo '<td>Item type</td>';
						echo '<td>Item ID</td>';
						echo '<td>Item name</td>';
						echo '<td>Payment processor</td>';
						echo '<td>Amount</td>';
						echo '<td>Status</td>';
						echo '<td>Action</td>';
					echo '</tr>';
				echo '</thead>';

				echo '<tbody>';
					foreach($customer['purchases'] as $purchase) {
						echo '<tr>';
							echo '<td>'.$purchase['order_id'].'</td>';
							echo '<td>'.$purchase['item_type'].'</td>';
							echo '<td>'.$purchase['item_id'].'</td>';
							echo '<td>'.$purchase['item_name'].'</td>';
							echo '<td>'.$purchase['processor'].'</td>';
							echo '<td>'.($purchase['amount'] / 100).' '.$purchase['currency'].'</td>'; // @note All amounts are in cents/pennies
							echo '<td>'.$purchase['status'].'</td>';
							echo '<td>';
								if(in_array($purchase['status'], array('paid', 'partially_refunded'))) {
									echo '<a href="example_refund.php?'.http_build_query(array(
										'access_token' => $access_token,
										'order_id' => $purchase['order_id'],
										'reference' => $purchase['reference'],
									)).'">Refund</a>';
								} else {
									echo 'N/A';
								}
							echo '</td>';
						echo '</tr>';
					}
				echo '</tbody>';
			echo '</table>';
		}

		// And a list of all their subscriptions, along with the status
		if(!empty($customer['subscriptions'])) {
			echo '<h4>Subscriptions</h4>';
			echo '<table class="table is-bordered is-striped is-hoverable is-fullwidth">';
				echo '<thead>';
					echo '<tr>';
						echo '<td>Order ID</td>';
						echo '<td>Item type</td>';
						echo '<td>Item ID</td>';
						echo '<td>Item name</td>';
						echo '<td>Payment processor</td>';
						echo '<td>Status</td>';
						echo '<td>Billing frequency</td>';
						echo '<td>Amount</td>';
						echo '<td>Actions</td>';
					echo '</tr>';
				echo '</thead>';

				echo '<tbody>';
					foreach($customer['subscriptions'] as $subscription) {
						echo '<tr>';
							echo '<td>'.$subscription['order_id'].'</td>';
							echo '<td>'.$subscription['item_type'].'</td>';
							echo '<td>'.$subscription['item_id'].'</td>';
							echo '<td>'.$subscription['item_name'].'</td>';
							echo '<td>'.$subscription['processor'].'</td>';
							echo '<td>'.$subscription['status'].'</td>';
							echo '<td>'.$subscription['frequency'].'</td>';
							echo '<td>'.($subscription['amount'] / 100).' '.$subscription['currency'].'</td>'; // @note All amounts are in cents/pennies
							echo '<td>';
								// Is this subscription active, or paused? Then we can cancel it
								if(in_array($subscription['status'], array('active', 'paused'))) {
									echo '<a href="example_subscription_cancel.php?'.http_build_query(array(
										'access_token' => $access_token,
										'order_id' => $subscription['order_id'],
										'subscription_id' => $subscription['subscription_id'],
									)).'">Cancel</a>&nbsp;';
								}

								// Is this subscription paused? Then we can resume it
								if(in_array($subscription['status'], array('paused'))) {
									echo '<a href="example_subscription_resume.php?'.http_build_query(array(
										'access_token' => $access_token,
										'order_id' => $subscription['order_id'],
										'subscription_id' => $subscription['subscription_id'],
									)).'">Resume</a>&nbsp;';
								}

								// Is this subscription active? Then we can pause it
								if(in_array($subscription['status'], array('active'))) {
									echo '<a href="example_subscription_pause.php?'.http_build_query(array(
										'access_token' => $access_token,
										'order_id' => $subscription['order_id'],
										'subscription_id' => $subscription['subscription_id'],
									)).'">Pause</a>';
								}
							echo '</td>';
						echo '</tr>';
					}
				echo '</tbody>';
			echo '</table>';

			// Now let's go through each of those subscriptions, and show all of their payments
			foreach($customer['subscriptions'] as $subscription) {
				echo '<h6>&raquo; Subscription: '.$subscription['item_name'].'</h6>';
				echo '<table class="table is-bordered is-striped is-hoverable is-fullwidth">';
					echo '<thead>';
						echo '<tr>';
							echo '<td>Event type</td>';
							echo '<td>Date</td>';
							echo '<td>Amount</td>';
							echo '<td>Actions</td>';
						echo '</tr>';
					echo '</thead>';

					echo '<tbody>';
						foreach($subscription['events'] as $event) {
							if(in_array($event['event_type'], array('charge', 'rebill', 'refund'))) { // We will display any charge, rebill, or refund events in this list
								echo '<tr>';
									echo '<td>'.$event['event_type'].'</td>';
									echo '<td>'.$event['date'].'</td>';
									echo '<td>'.($event['amount'] / 100).' '.$subscription['currency'].'</td>'; // @note All amounts are in cents/pennies
									echo '<td>';
										// Is this the initial/up-front payment? Then we can refund it
										if(in_array($event['event_type'], array('charge'))) {
											echo '<a href="example_refund.php?'.http_build_query(array(
												'access_token' => $access_token,
												'order_id' => $subscription['order_id'],
												'reference' => $event['reference'],
											)).'">Refund</a>&nbsp;';
										}

										// Is this a rebill? Then we can refund it - this is slightly different
										if(in_array($event['event_type'], array('rebill'))) {
											echo '<a href="example_refund.php?'.http_build_query(array(
												'access_token' => $access_token,
												'order_id' => $subscription['order_id'],
												'reference' => $event['reference'],
											)).'">Refund</a>&nbsp;';
										}
									echo '</td>';
								echo '</tr>';
							}
						}
					echo '</tbody>';
				echo '</table>';
			}
		}

		// And finally, let's output everything so you can see all of what is returned
		echo '<h4>Raw info</h4>';
		echo '<pre style="max-height: 30em;">';
			print_r($customer);
		echo '</pre>';

	} catch(\ThriveCart\Exception $e) {
		echo '<div class="notification is-danger is-light">There was an error while loading information about this customer: '.$e->getMessage().'</div>';
	}
}

// We have no incoming search request, so let's output a simple form to search for a customer's email or info
if(empty($_POST['email'])) {
	echo '<article class="message is-info"><div class="message-body">';
		echo 'In this example, we will be identifying all of the information that ThriveCart has about a specific customer, as identified by their email address. Enter the email address of a customer in your account to view all of their info.';
	echo '</div></article>';

	echo '<form action="example_customer.php?access_token='.$access_token.'" method="post">';
		echo '<div class="field">';
			echo '<label class="label">Enter a customer email address..</label>';
			echo '<div class="control">';
				echo '<input class="input" type="text" placeholder="customer@example.com" name="email" />';
			echo '</div>';
		echo '</div>';

		echo '<div class="field is-grouped">';
			echo '<div class="control">';
				echo '<button class="button is-link">View customer info</button>';
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