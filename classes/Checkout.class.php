<?php 
include_once('Discount.class.php');

/**
 * class Checkout
 *
 * @description Manages our basket and checkout process
 */
class Checkout {
	private $basket = array();
	private $discounts = array();

	/**
	 * public __construct
	 *
	 * @description initialise our checkout
	 */
	public function __construct() {
		if ( isset( $_COOKIE['basket'] ) && !empty( $_COOKIE['basket'] ) ) {
			$this->basket = json_decode( $_COOKIE['basket'] );
		}

		$this->discounts[] = new Discount( 'bogof', 111, 'Buy One Get One Free' );
		$this->discounts[] = new Discount( '10% off', 222, '10% off when you spend £20' );
		$this->discounts[] = new Discount( '1pound off', 333, '£1 off when you buy 4' );

		/*- code: 111, name: strawberry, price per item: £2, discount: buy one get one free. (Every second strawberry is free)
		- code: 222, name: apple, price per item: £1.5, discount: 10% off from apple price if basket total is or bigger than £20
		- code: 333, name: pear, price per item: £4, discount: £1 off basket total if more than 4 pears bought
		Other products:
		- code: 444, name: cherry, price per item: £1
		- code: 555, name: peach, price per item: £5*/
	}

	/**
	 * public getBasket
	 *
	 * @description get our basket
	 */
	public function getBasket() {
		return $this->basket;
	}

	/**
	 * public getProductDiscount
	 *
	 * @description get the discount for a particular product
	 */
	public function getProductDiscount( $productCode ) {
		foreach( $this->discounts as $discount ) {
			if ( $discount->getProductCode() == $productCode ) {
				return $discount;
			}
		}
		return false;
	}

	/**
	 * public addToBasket
	 *
	 * @description add a product to our basket
	 */
	public function addToBasket( &$product ) {
		if ( isset( $product ) && is_object( $product ) ) {
			$this->basket[] = $product;
			setcookie( 'basket' , json_encode( $product ), time()+3600);  /* expire in 1 hour */
		}
	}
}
