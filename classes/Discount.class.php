<?php /**
 * class Product
 *
 * @description Holds discount information
 */
class Discount {
	private $type;
	private $productCode;
	private $description;

	/**
	 * public __construct
	 *
	 * @description initialise our discount object
	 */
	public function __construct($type, $productCode, $description) {
		$this->type = $type;
		$this->productCode = $productCode;
		$this->description = $description;
	}

	/**
	 * public getProductCode
	 *
	 * @description return the code of the product
	 */
	 public function getProductCode() {
	 	return $this->productCode;
	 }

	 /**
	 * public getDescription
	 *
	 * @description return the discount description
	 */
	 public function getDescription() {
	 	return $this->description;
	 }

	 /**
	 * public applyDiscount
	 *
	 * @description apply discount to any qualifying items
	 */
	 public function applyDiscount( $basketTotal, $item ) {
	 	$discount = 0.0;

	 	// Rules would normally come from a database
	 	switch ( $item->getCode() ) {
	 		// name: strawberry, price per item: £2, discount: buy one get one free. (Every second strawberry is free)
	 		case 111:
	 			$discount += $item->getPrice() * floor( $item->getQuantity() / 2 ) ;
	 			break;
	 		// name: apple, price per item: £1.5, discount: 10% off from apple price if basket total is or bigger than £20
	 		case 222:
	 			if ( $basketTotal >= 20 ) {
	 				$discount += $item->getTotalPrice() / 10;
	 			}
	 			break;
	 		// name: pear, price per item: £4, discount: £1 off basket total if more than 4 pears bought
	 		case 333:
	 			if ( $item->getQuantity() > 4 ) {
	 				$discount += 1.0;
	 			}
	 			break;
	 	}

	 	return $discount;
	 }
}