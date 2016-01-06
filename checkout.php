<?php 
	include_once('classes/Checkout.class.php');

	setlocale(LC_MONETARY, 'en_GB.UTF-8');

	$Checkout = new Checkout();

	$discount = $Checkout->calculateDiscount();
?>
<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title>DC Test</title>
	<meta name="description" content="A technical test for DC">
	<meta name="author" content="Tom Illingworth">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
</head>

<body>
	<div class="row">
		<section class="col-sm-12">
			<h2>Basket</h2>
			<table class="table table-striped table-bordered">
				<tr>
					<th>Name</th>
					<th>Quantity</th>
					<th>Total Price</th>
				</tr>
				<?php
					$basket = $Checkout->getBasket();
					foreach( $basket as $i => $product ) {
				?>
						<tr>
						 	<td><?= $product->getName() ?></td>
						 	<td><?= $product->getQuantity() ?></td>
						 	<td><?= money_format('%n', $product->getTotalPrice()) ?></td>
						</tr>
				<?php
					}
				?>
				<tr><td colspan="3">Total Price: <?= money_format('%n', $Checkout->getBasketTotal()) ?></td></tr>
				<tr><td colspan="3">Discount: -<?= money_format('%n', $discount )?></td></tr>
				<tr><td colspan="3">To Pay: <?= money_format('%n', $Checkout->getBasketTotal() - $discount )?></td></tr>
			</table>
			<a href="/index.php" class="btn btn-primary">Back to shop</a>
		</section>
		
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</body>
</html>