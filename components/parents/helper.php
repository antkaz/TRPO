<?php

/**
 * Description of helper
 *
 * @author Антон
 */
class helpParents extends Helper {

	public $url;
	public $month = array('Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентяюрь', 'Октябрь', 'Ноябрь', 'Декабрь');

	function __construct() {
		parent::__construct();
		$this->tableName = 'data_parents';
		$this->url = '?com=parents';

		$query = "DESCRIBE `$this->tableName`";
		if (!$this->db->query($query)) {
			$this->db->query("
				CREATE TABLE IF NOT EXISTS `data_parents` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `name` char(20) NOT NULL,
				  `surname` char(40) NOT NULL,
				  `patronymic` char(50) NOT NULL,
				  `sex` tinyint(1) NOT NULL,
				  `birth` date NOT NULL,
				  `address` char(100) NOT NULL,
				  `phoneCode` int(11) NOT NULL,
				  `phoneNumber` int(10) NOT NULL,
				  `work` char(255) NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

			");
		}
	}

	//установить данные в ассоциативный массив
	public function setData($name, $surname, $patronymic, $sex, $day, $month, $year, $address, $phoneCode, $phoneNumber, $work) {
		$this->data['name'] = htmlspecialchars(trim($name));
		$this->data['surname'] = htmlspecialchars(trim($surname));
		$this->data['patronymic'] = htmlspecialchars(trim($patronymic));
		$this->data['sex'] = $sex;
		$this->data['birth'] = $year . "-" . $month . "-" . $day;
		$this->data['address'] = htmlspecialchars(trim($address));
		$this->data['phoneCode'] = htmlspecialchars(trim($phoneCode));
		$this->data['phoneNumber'] = htmlspecialchars(trim($phoneNumber));
		$this->data['work'] = htmlspecialchars(trim($work));
	}

	//отфильтрованный список
	public function filterList($name, $surname, $patronymic) {
		$name = htmlspecialchars(trim($name));
		$name = mysql_real_escape_string($name);
		$surname = htmlspecialchars(trim($surname));
		$surname = mysql_real_escape_string($surname);
		$patronymic = htmlspecialchars(trim($patronymic));
		$patronymic = mysql_real_escape_string($patronymic);

		$query = "SELECT * FROM `$this->tableName`
			WHERE `name` LIKE '%$name%'
				AND `surname` LIKE '%$surname%'
				AND `patronymic` LIKE '%$patronymic%'";
		$result = $this->db->query($query);
		while ($item = $this->db->fetchObject($result)) {
			$array[] = $item;
		}

		return $array;
	}

	//првоерка введенных данных
	function check($name, $surname, $patronymic, $sex, $day, $month, $year, $address, $phoneCode, $phoneNumber, $work) {
		$this->setData($name, $surname, $patronymic, $sex, $day, $month, $year, $address, $phoneCode, $phoneNumber, $work);

		if (empty($this->data['name']) || empty($this->data['surname']) || empty($this->data['patronymic']) || !isset($this->data['sex']) || empty($day) || empty($month) || empty($year) || empty($this->data['address']) || empty($this->data['work'])) {
			$this->error .= "Не все поля заполнены\n";
			$this->status = 'error';
			return $this->status;
		}

		if (!$this->validateSurname()) {
			$this->status = 'error';
		}

		if (!$this->validateName()) {
			$this->status = 'error';
		}

		if (!$this->validatePatronymic()) {
			$this->status = 'error';
		}

		if (!$this->validateAddress()) {
			$this->status = 'error';
		}

		if ($phoneCode != '' || $phoneNumber != '') {
			if (!$this->validatePhone()) {
				$this->status = 'error';
			}
		}

		return $this->status;
	}

	//проврека имени
	private function validateName() {
		if (!preg_match("/^[a-zA-ZабвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ]+$/", $this->data['name'])) {
			$this->error .= "Имя может состоять только из русских и латинских букв<br />\n";
			return false;
		}
		return true;
	}

	//проверка фамилии
	private function validateSurname() {
		if (!preg_match("/^[a-zA-ZабвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ]+$/", $this->data['surname'])) {
			$this->error .= "Фамилия может состоять только из русских и латинских букв<br />\n";
			return false;
		}
		return true;
	}

	//проверка отчества
	private function validatePatronymic() {
		if (!preg_match("/^[a-zA-ZабвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ]+$/", $this->data['patronymic'])) {
			$this->error .= "Отчество может состоять только из русских и латинских букв<br />\n";
			return false;
		}
		return true;
	}

	//проверка адреса
	private function validateAddress() {
		if (!preg_match("/^[a-zA-ZабвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ0-9\.\,\-\/_ ]+$/", $this->data['address'])) {
			$this->error .= "Поле \"Адрес\" содержит недопустимые символы<br />\n";
			return false;
		}
		return true;
	}

	//проверка телефона
	private function validatePhone() {
		if ($this->data['phoneCode'] != '' && $this->data['phoneNumber'] != '') {
			if (!(preg_match("/^\d{3,5}$/", $this->data['phoneCode']) && preg_match("/^\d{5,7}$/", $this->data['phoneNumber']) && (strlen($this->data['phoneCode']) + strlen($this->data['phoneNumber']) == 10))) {
				$this->error .= "Номер телефона может состоять только из цифр длинной в 10 символов<br />\n";
				return false;
			}
		} else {
			$this->error .= "Номер телефона не указан или указан не полностью";
			return false;
		}
		return true;
	}

}

?>