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
}