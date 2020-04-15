<?php
include '../bootstrap.php';

// @note these parameters are just for the example site
$example_name = 'List of examples';
include 'inc.header.php';
?>

<h6>Examples</h6>
<ul>
	<li><a href="example_customer.php?access_token=<?php echo $_GET['access_token']; ?>">View customer, purchase &amp; subscription info</a> <span class="tag is-primary">Start here!</span></li>
	<li><a href="example_order_search.php?access_token=<?php echo $_GET['access_token']; ?>">Search for orders by customer</a></li>
	<li><a href="example_refund.php?access_token=<?php echo $_GET['access_token']; ?>">Refund a transaction</a></li>
	<li><a href="example_subscription_cancel.php?access_token=<?php echo $_GET['access_token']; ?>">Cancel a subscription</a></li>
	<li><a href="example_subscription_pause.php?access_token=<?php echo $_GET['access_token']; ?>">Pause a subscription</a></li>
	<li><a href="example_subscription_resume.php?access_token=<?php echo $_GET['access_token']; ?>">Resume a subscription</a></li>
</ul>

<?php
// @note Include for the example site
include 'inc.footer.php';
?>