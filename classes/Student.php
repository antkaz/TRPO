<?php

/**
 * Класс "студент"
 *
 * @author Антон
 */
class Student extends Person {

	public $parentMother;
	public $parentFather;
	public $class;

	function __construct() {
		parent::__construct();
	}

	public function getAssocArray() {
		return get_object_vars($this);
	}

}

?>
