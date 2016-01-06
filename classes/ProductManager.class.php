<?php 
include_once('Product.class.php');

/**
 * class Product
 *
 * @description Manages our products
 */
class ProductManager {
	private $products = array();

	/**
	 * public __construct
	 *
	 * @description initialise our product manager
	 */
	public function __construct() {
		// Create our data and push to products array
		$this->products[] = new Product( 111, 'Strawberry', 2);
		$this->products[] = new Product( 222, 'Apple', 1.5);
		$this->products[] = new Product( 333, 'Pear', 4);
		$this->products[] = new Product( 444, 'Cherry', 1);
		$this->products[] = new Product( 555, 'Peach', 5);


		/*- code: 111, name: strawberry, price per item: £2, discount: buy one get one free. (Every second strawberry is free)
		- code: 222, name: apple, price per item: £1.5, discount: 10% off from apple price if basket total is or bigger than £20
		- code: 333, name: pear, price per item: £4, discount: £1 off basket total if more than 4 pears bought
		Other products:
		- code: 444, name: cherry, price per item: £1
		- code: 555, name: peach, price per item: £5*/
	}

	/**
	 * public getProducts()
	 *
	 * @description getter for $products
	 */
	public function getProducts() {
		return $this->products;
	}

	/**
	 * public getProduct()
	 *
	 * @description getter single product
	 */
	public function getProduct( $code ) {
		foreach( $this->products as $product ) {
			if ( $product->getCode() == $code ) {
				return $product;
			}
		}
		return false;
	}
}