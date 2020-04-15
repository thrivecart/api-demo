<?php
include '../bootstrap.php';

// These parameters are just for the example site
$example_name = 'Order search';
include 'inc.header.php';
?>

<?php

// Do we have an incoming search request? Then let's run the API endpoint
if(!empty($_POST['query'])) {
	// Let's get the email we want to search by
	$query = trim($_POST['query']);

	// Initialise our API object
	$tc = new \ThriveCart\Api($access_token);

	// How many results per page?
	$perPage = 10; // @note Maximum of 25 results per page

	// What page are we viewing?
	$page = 1; // @note 1 through N

	// Now let's make our API request
	try {
		$response = $tc->transactions(array(
			// Filters
			'query' => $query,
			'transactionType' => 'any', // @note This can be 'any', 'charge', 'refund', 'rebill', 'cancel' - the returned list of transactions will include a transaction_type that has one of these values also

			// Pagination
			'page' => $page,
			'perPage' => $perPage,
		));

		// Let's output these results - they could be formatted in a table, a list, etc
		echo '<pre>';
			print_r($response['transactions']);
		echo '</pre>';

		// Are there more pages of results?
		if(!empty($response['meta']['total']) && $response['meta']['total'] >= $perPage) {
			$total_pages = ceil($response['meta']['total'] / $perPage);
			$remaining_pages = $total_pages - $page;

			echo '<hr/>';
			echo '<p>There are <b>'.$remaining_pages.' more page(s)</b> of results.</p>';
		}
	} catch(\ThriveCart\Exception $e) {
		echo '<div class="notification is-danger is-light">There was an error while searching through your transactions: '.$e->getMessage().'</div>';
	}
}

// We have no incoming search request, so let's output a simple form to search for a customer's email or info
if(empty($_POST['query'])) {
	echo '<article class="message is-info"><div class="message-body">';
		echo 'In this example, we can search through our list of transactions much like how the Transactions page inside of ThriveCart operates. Enter a search query to begin.<br/><b>Important:</b> a <i>much</i> easier-to-use endpoint for information on a specific, individual customer can be found in the <a href="example_customer.php?access_token='.$access_token.'">customer info</a> example.';
	echo '</div></article>';

	echo '<form action="example_order_search.php?access_token='.$access_token.'" method="post">';
		echo '<div class="field">';
			echo '<label class="label">Enter a search query or email address..</label>';
			echo '<div class="control">';
				echo '<input class="input" type="text" placeholder="customer@example.com" name="query" />';
			echo '</div>';
		echo '</div>';

		echo '<div class="field is-grouped">';
			echo '<div class="control">';
				echo '<button class="button is-link">Search for orders</button>';
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