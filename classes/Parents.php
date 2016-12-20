<?php

/**
 * Класс "родитель"
 */
class Parents extends Person {

	public $work;

	function __construct() {
		parent::__construct();
	}

	public function getAssocArray() {
		return get_object_vars($this);
	}

}

?>
