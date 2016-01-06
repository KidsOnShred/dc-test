<?php 
include_once('Discount.class.php');
include_once('CheckoutItem.class.php');

/**
 * class Checkout
 *
 * @description Manages our basket and checkout process
 */
class Checkout {
	private $basket = array();
	private $discounts = array();
	private $basketTotalPrice;

	/**
	 * public __construct
	 *
	 * @description initialise our checkout
	 */
	public function __construct() {
		// Retrieve our basket
		if ( isset( $_COOKIE['basket'] ) && !empty( $_COOKIE['basket'] ) ) {
			$this->basket = unserialize( $_COOKIE['basket'] );
		}

		// Work out the total price
		$this->basketTotalPrice = 0.0;
		foreach( $this->basket as $item ) {
			$this->basketTotalPrice += $item->getTotalPrice();
		}

		$this->discounts[111] = new Discount( 'bogof', 111, 'Buy One Get One Free' );
		$this->discounts[222] = new Discount( '10% off', 222, '10% off when you spend £20' );
		$this->discounts[333] = new Discount( '1pound off', 333, '£1 off when you buy more than 4' );

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
	 * public getBasket
	 *
	 * @description get our basket total price
	 */
	public function getBasketTotal() {
		return $this->basketTotalPrice;
	}

	/**
	 * public getProductDiscount
	 *
	 * @description get the discount for a particular product
	 */
	public function getProductDiscount( $productCode ) {
		// foreach( $this->discounts as $discount ) {
		// 	if ( $discount->getProductCode() == $productCode ) {
		// 		return $discount;
		// 	}
		// }
		if ( isset( $this->discounts[$productCode] ) ) {
			return $this->discounts[$productCode];
		}
		return false;
	}

	/**
	 * public addToBasket
	 *
	 * @description add a product to our basket
	 */
	public function addToBasket( &$product ) {
		// Check our product is valid
		if ( isset( $product ) && is_object( $product ) ) {
			// Check out basket for existing products
			if ( is_integer( $this->findCheckoutItem( $product->getCode() ) ) ) {
				$this->basket[$this->findCheckoutItem( $product->getCode() )]->addItem( $product->getCode() );
			// None found so add new
			} else {
				$this->basket[] = new CheckoutItem( $product );
			}

			// Save basket as cookie
			setcookie( 'basket' , serialize( $this->basket ), time()+3600);  /* expire in 1 hour */
		}
	}

	/**
	 * public findCheckoutItem
	 *
	 * @description finds a product in our basket and returns its index
	 */
	public function findCheckoutItem( $productCode ) {
		foreach ( $this->basket as $i => $item ) {
			if ( $item->getCode() == $productCode ) {
				return $i;
			}
		}
		return false;
	}

	/**
	 * public calculateDiscount
	 *
	 * @description calculates the discounts for products and applies to total price
	 */
	public function calculateDiscount() {
		
		$discount = 0.0;
		//Check each basket item and check if it has a discount
		foreach ( $this->basket as $i => $item ) {
			if ( isset( $this->discounts[$item->getCode()] ) ) {
				$discount += $this->discounts[$item->getCode()]->applyDiscount( $this->getBasketTotal(), $item );
			}
		}

		return $discount;
	}
}
