<?php
	include_once('classes/Checkout.class.php');
	include_once('classes/ProductManager.class.php');

	$Checkout = new Checkout();
	$ProductManager = new ProductManager();

	// Add the product to our basket
	$Checkout->addToBasket( $ProductManager->getProduct( $_POST['code'] ) );

	header("Location: index.php");
