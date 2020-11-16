<?php
// Include Composer
include 'vendor/autoload.php';



?><!DOCTYPE html>
<html>
<head>
<title>ThriveCart API Demo</title>
<link rel="stylesheet" href="assets/bulma.css" />
<link rel="stylesheet" href="assets/style.css" />
</head>
<body>

<main>
	<section class="container">
		<h1 class="title">ThriveCart API</h1>
	</section>

	<section class="container">
		<div class="content">
			<?php
			if(!isset($_GET['api_key']) || empty($_GET['api_key'])) {
				echo '<form action="apikey_example.php" method="get">';
					echo '<div class="field">';
						echo '<label class="label">Enter an API key from your ThriveCart account.</label>';
						echo '<div class="control">';
							echo '<input class="input" type="text" placeholder="XXXXXXXX-XXXXXXXX-XXXXXXXX-XXXXXXXX" name="api_key" />';
						echo '</div>';
					echo '</div>';

					echo '<div class="field is-grouped">';
						echo '<div class="control">';
							echo '<button class="button is-link">Check API key</button>';
						echo '</div>';
					echo '</div>';

				echo '</form>';
			} else {
				$api_key = trim($_GET['api_key']);

				// Initialise our API instance, passing it this api key
				$tc = new \ThriveCart\Api($api_key);

				// Let's get a list of all the live products in the account
				try {
					$account_info = $tc->ping();
				} catch(\ThriveCart\Exception $e) {
					echo '<h3>Connection error!</h3>';
					echo '<div class="notification is-danger is-light">';
						echo 'There was an error with your API key: '.$e->getMessage();
						echo '<br /><a href="apikey_example.php">Click here to go back</a>.';
					echo '</div>';

					return;
				}

				echo '<h3>Connection successful!</h3>';
				echo '<p>You can pass the API key <pre>'.$api_key.'</pre> to the SDK and use it to make your API requests. You can revoke it from within ThriveCart at any time and it will cease functioning.</p>';

				echo '<hr/>';

				echo '<h6>Account info</h6>';
				echo '<pre class="output-debug">';
					// Let's output the results from earlier
					print_r($account_info);
				echo '</pre>';

				echo '<h6>Examples</h6>';
				echo '<p><a href="examples/index.php?access_token='.$api_key.'">Click here to view the list of examples</a> and how to use the various API methods.</p>';
			}
			?>
		</div>
	</section>
</main>
</body>
</html>