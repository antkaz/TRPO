<?php

/**
 * Description of helper
 *
 * @author Антон
 */
class helpStedents extends Helper {

	public $month = array('Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентяюрь', 'Октябрь', 'Ноябрь', 'Декабрь');

	function __construct() {
		parent::__construct();
		$this->tableName = 'data_students';
		$this->url = '?com=students';

		$query = "DESCRIBE `$this->tableName`";
		if (!$this->db->query($query)) {
			$this->db->query("
				CREATE TABLE IF NOT EXISTS `data_students` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `name` char(20) NOT NULL,
				  `surname` char(40) NOT NULL,
				  `patronymic` char(40) NOT NULL,
				  `sex` tinyint(1) NOT NULL,
				  `birth` date NOT NULL,
				  `address` char(100) DEFAULT NULL,
				  `phoneCode` int(20) DEFAULT NULL,
				  `phoneNumber` int(11) NOT NULL,
				  `parentMother` int(11) DEFAULT NULL,
				  `parentFather` int(11) DEFAULT NULL,
				  `class` varchar(3) NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
			");
		}
	}

	//установить данные
	public function setData($name, $surname, $patronymic, $sex, $day, $month, $year, $address, $phoneCode, $phoneNumber, $mother, $father, $class) {
		$this->data['name'] = htmlspecialchars(trim($name));
		$this->data['surname'] = htmlspecialchars(trim($surname));
		$this->data['patronymic'] = htmlspecialchars(trim($patronymic));
		$this->data['sex'] = $sex;
		$this->data['birth'] = $year . "-" . $month . "-" . $day;
		$this->data['address'] = htmlspecialchars(trim($address));
		$this->data['phoneCode'] = htmlspecialchars(trim($phoneCode));
		$this->data['phoneNumber'] = htmlspecialchars(trim($phoneNumber));
		$this->data['parentMother'] = $mother;
		$this->data['parentFather'] = $father;
		$this->data['class'] = $class;
	}

	//получить список отцов
	public function getFatherList() {
		$array = array();

		$list = $this->db->loadObjectList('data_parents', 'Parents');
		foreach ($list as $item) {
			if ($item->sex == 1) {
				$array [] = $item;
			}
		}

		return $array;
	}

	//получить список матерей
	public function getMotherList() {
		$array = array();

		$list = $this->db->loadObjectList('data_parents', 'Parents');
		foreach ($list as $item) {
			if ($item->sex == 0) {
				$array [] = $item;
			}
		}

		return $array;
	}

	//получить объект "родитель"
	public function getParent($id) {
		return $this->db->getObject('data_parents', $id);
	}

	//отобразить отфильтрованный список
	public function filterList($name, $surname, $patronymic, $class) {
		$array = array();
		$name = htmlspecialchars(trim($name));
		$name = mysql_real_escape_string($name);
		$surname = htmlspecialchars(trim($surname));
		$surname = mysql_real_escape_string($surname);
		$patronymic = htmlspecialchars(trim($patronymic));
		$patronymic = mysql_real_escape_string($patronymic);
		if (!$class) {
			$class = '';
		}

		$query = "SELECT * FROM `$this->tableName`
				WHERE `name` LIKE '%$name%'
					AND `surname` LIKE '%$surname%'
					AND `patronymic` LIKE '%$patronymic%'
					AND `class` LIKE '%$class%'";
		$result = $this->db->query($query);
		while ($item = $this->db->fetchObject($result)) {
			$array[] = $item;
		}

		return $array;
	}

	//получить рейтинг по id
	public function getRating($id) {
		$item = $this->db->getObject('data_rating', $id);
		return $item;
	}

	//добавить ученика и информацию о его рейтинге
	function add($debug = false) {
		if (!$this->db->insert($this->tableName, $this->data, $debug)) {
			$this->status = 'error';
			$this->error = 'Ошибка при добавлении в базу данных';
		} else {
			$array['id_Student'] = $this->db->insertId();
			$this->db->insert('data_rating', $array);
			$this->success = "Запись успешно добавлена\n";
		}
		return $this->status;
	}

	//удаличть ученика, его родителей и информацию о рейтинге
	function delete($id, $debug = false, $refresh = true) {
		$item = $this->db->getObject($this->tableName, $id, 'Student');


		if (!empty($item->parentMother)) {
			$this->db->delete($item->parentMother, 'data_parents');
		}
		if (!empty($item->parentFather)) {
			$this->db->delete($item->parentFather, 'data_parents');
		}
		$query = "DELETE FROM `data_rating` WHERE `id_student`='$id'";
		$this->db->query($query);
		$this->db->delete($id, $this->tableName, $debug);

		if ($refresh) {
			print "<meta http-equiv=\"refresh\" content=\"0;URL=$this->url\">";
		}
	}

	//удалить список класса
	function deleteClass($idClass) {
		$list = $this->filterList('', '', '', $idClass);

		foreach ($list as $item) {
			$this->delete($item->id, false, false);
		}

		print "<meta http-equiv=\"refresh\" content=\"0;URL=$this->url\">";
	}

	//проверка
	public function check($name, $surname, $patronymic, $sex, $day, $month, $year, $address, $phoneCode, $phoneNumber, $mother, $father, $class) {
		$this->setData($name, $surname, $patronymic, $sex, $day, $month, $year, $address, $phoneCode, $phoneNumber, $mother, $father, $class);

		if (empty($this->data['name']) || empty($this->data['surname']) || empty($this->data['patronymic']) || !isset($this->data['sex']) || empty($day) || empty($month) || empty($year) || empty($this->data['address']) || empty($this->data['class'])) {
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

	//проверка имени
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

};
?>