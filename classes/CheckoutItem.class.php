<?php
include_once('Product.class.php');

/**
 * class CheckoutItem
 *
 * @description Holds collections of same types of product
 */
class CheckoutItem extends Product {
	private $quantity;
	private $totalPrice;

	/**
	 * public __construct
	 *
	 * @description initialise our checkout
	 */
	public function __construct( &$product ) {
		// If we are being created then there is only 1 of us
		parent::__construct( $product->getCode(), $product->getName(), $product->getPrice());
		$this->quantity = 1;
		$this->totalPrice = parent::getPrice();
	}

	/**
	 * public addItem
	 *
	 * @description increase the quantity of the item
	 */
	 public function addItem() {
		$this->quantity++;
		$this->totalPrice += $this->price;
	 }

	/**
	 * public getCode
	 *
	 * @description return the code of the product
	 */
	 public function getCode() {
	 	return $this->code;
	 }

	/**
	 * public getName
	 *
	 * @description return the name of the product
	 */
	 public function getName() {
	 	return $this->name;
	 }

	 /**
	 * public getPrice
	 *
	 * @description return the price of the product
	 */
	 public function getPrice() {
	 	return $this->price;
	 }

	 /**
	 * public getQuantity
	 *
	 * @description return the total quantity of a checkout item
	 */
	 public function getQuantity() {
	 	return $this->quantity;
	 }

	 /**
	 * public getTotalPrice
	 *
	 * @description return the total price of the checkout item
	 */
	 public function getTotalPrice() {
	 	return $this->totalPrice;
	 }
}