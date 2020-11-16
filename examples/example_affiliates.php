<?php
include '../bootstrap.php';

// These parameters are just for the example site
$example_name = 'Search affiliates';
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
		$response = $tc->affiliates(array(
			// Filters
			'query' => $query,
			// 'product_id' => 123, // Numeric product ID to search for only affiliates who have applied/are approved for that product

			// Pagination
			'page' => $page,
			'perPage' => $perPage,
		));

		// Let's output these results - they could be formatted in a table, a list, etc
		echo '<pre class="output-debug">';
			print_r($response['affiliates']);
		echo '</pre>';

		// Are there more pages of results?
		if(!empty($response['meta']['total']) && $response['meta']['total'] >= $perPage) {
			$total_pages = ceil($response['meta']['total'] / $perPage);
			$remaining_pages = $total_pages - $page;

			echo '<hr/>';
			echo '<p>There are <b>'.$remaining_pages.' more page(s)</b> of results.</p>';
		}

		// Let's also display a list of links to the 'example_affiliate.php' example, which shows how to look up a single, specific affiliate
		if(!empty($response['affiliates'])) {
			echo '<h6>View individual affiliate</h6>';
			echo '<ul>';
				foreach($response['affiliates'] as $affiliate) {
					echo '<li>';
						echo '<a href="example_affiliate.php?access_token='.$access_token.'&affiliate_id='.$affiliate['affiliate_id'].'">View affiliate &quot;<b>'.$affiliate['affiliate_id'].'</b>&quot;</a>';
					echo '</li>';
				}
			echo '</ul>';
		}
	} catch(\ThriveCart\Exception $e) {
		echo '<div class="notification is-danger is-light">There was an error while searching through your affiliates: '.$e->getMessage().'</div>';
	}
}

// We have no incoming search request, so let's output a simple form to search for a customer's email or info
if(empty($_POST['query'])) {
	echo '<article class="message is-info"><div class="message-body">';
		echo 'In this example, we can search through our list of affiliates much like how the My Affiliates page inside of ThriveCart operates. Enter a search query to begin.<br/><b>Important:</b> you can also see the <code>example_affiliate.php</code> example to view an individual affiliate.';
	echo '</div></article>';

	echo '<form action="example_affiliates.php?access_token='.$access_token.'" method="post">';
		echo '<div class="field">';
			echo '<label class="label">Enter a search query or email address..</label>';
			echo '<div class="control">';
				echo '<input class="input" type="text" placeholder="myaffiliate@example.com" name="query" />';
			echo '</div>';
		echo '</div>';

		echo '<div class="field is-grouped">';
			echo '<div class="control">';
				echo '<button class="button is-link">Search for affiliates</button>';
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