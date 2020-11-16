<?php
include '../bootstrap.php';

// These parameters are just for the example site
$example_name = 'View available products';
include 'inc.header.php';
?>

<?php
// Initialise our API object
$tc = new \ThriveCart\Api($access_token);

// Now let's make our API request
try {
	$response = $tc->getProducts(array( // Get the list of products this token has access to
		//
	));

	// Let's output these results - they could be formatted in a table, a list, etc
	echo '<pre class="output-debug">';
		print_r($response);
	echo '</pre>';

	// Output a list of links to these individual products
	if(!empty($response)) {
		echo '<h6>View single product</h6>';
		echo '<ul>';
			$i = 0;
			foreach($response as $product) {
				if($i >= 5) continue;
				
				echo '<li>';
					echo '<a href="example_view_product.php?access_token='.$access_token.'&product_id='.$product['product_id'].'">View product &quot;<b>'.$product['name'].'</b>&quot;</a>';
				echo '</li>';

				$i++;
			}
		echo '</ul>';
	}
} catch(\ThriveCart\Exception $e) {
	echo '<div class="notification is-danger is-light">There was an error while loading a list of products: '.$e->getMessage().'</div>';
}

// Display our 'go back' link
echo '<hr/>';
echo '<p><a href="index.php?access_token='.$access_token.'">&laquo; Go back</a> to the examples list.</p>';
?>

<?php
include 'inc.footer.php';
?>