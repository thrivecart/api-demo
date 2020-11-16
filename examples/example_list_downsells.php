<?php
include '../bootstrap.php';

// These parameters are just for the example site
$example_name = 'View available downsells';
include 'inc.header.php';
?>

<?php
// Initialise our API object
$tc = new \ThriveCart\Api($access_token);

// Now let's make our API request
try {
	$response = $tc->getDownsells(array( // Get the list of downsells this token has access to
		//
	));

	// Let's output these results - they could be formatted in a table, a list, etc
	echo '<pre class="output-debug">';
		print_r($response);
	echo '</pre>';

	// Output a list of links to these individual downsells
	if(!empty($response)) {
		echo '<h6>View single downsell</h6>';
		echo '<ul>';
			$i = 0;
			foreach($response as $downsell) {
				if($i >= 5) continue;

				echo '<li>';
					echo '<a href="example_view_downsell.php?access_token='.$access_token.'&downsell_id='.$downsell['downsell_id'].'">View downsell &quot;<b>'.$downsell['name'].'</b>&quot;</a>';
				echo '</li>';

				$i++;
			}
		echo '</ul>';
	}
} catch(\ThriveCart\Exception $e) {
	echo '<div class="notification is-danger is-light">There was an error while loading a list of downsells: '.$e->getMessage().'</div>';
}

// Display our 'go back' link
echo '<hr/>';
echo '<p><a href="index.php?access_token='.$access_token.'">&laquo; Go back</a> to the examples list.</p>';
?>

<?php
include 'inc.footer.php';
?>