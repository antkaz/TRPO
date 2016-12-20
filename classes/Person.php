<?php

abstract class Person {

	public $id;
	public $name;
	public $surname;
	public $patronymic;
	public $sex;
	public $birth;
	public $address;
	public $phoneCode;
	public $phoneNumber;

	function __construct() {

	}

	/**
	 * Возвращает свойства указанного объекта
	 *
	 * Возвращает нестатические свойства объекта
	 *
	 * @return array Возвращает ассоциативный массив нестатических свойств объекта object.
	 * Если свойству не было присвоено значение, оно будет возвращено со значением NULL.
	 */
	abstract public function getAssocArray();
}

?>