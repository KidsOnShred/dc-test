<?php /**
 * class Product
 *
 * @description Holds product information
 */
class Product {
	protected $code;
	protected $name;
	protected $price;

	/**
	 * public __construct
	 *
	 * @description initialise our product
	 */
	public function __construct( $code, $name, $price ) {
		// Assign the data for the product
		$this->code = $code;
		$this->name = $name;
		$this->price = $price;
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
}