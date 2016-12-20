<?php

class helpRating extends Helper {

	function __construct() {
		parent::__construct();

		$this->tableName = 'data_rating';
		$this->url = '/?com=rating';

		$query = "DESCRIBE `$this->tableName`";
		if (!$this->db->query($query)) {
			$this->db->query("
				CREATE TABLE IF NOT EXISTS `data_rating` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `id_student` int(11) NOT NULL,
				  `math` int(1) NOT NULL,
				  `rus` int(1) NOT NULL,
				  `history` int(1) NOT NULL,
				  `english` int(1) NOT NULL,
				  `physic_cult` int(1) NOT NULL,
				  `rating` double NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;
			");
		}
	}

	//загрузка рейтинга из базы данных
	function loadList() {
		$array = array();
		$query = "SELECT t1.*, t2.name, t2.surname, t2.patronymic, t2.class
			FROM `data_rating` AS t1 LEFT JOIN `data_students` AS t2
			ON t1.id_student = t2.id
			ORDER BY `rating` DESC";
		$result = $this->db->query($query);
		if ($this->db->numRows($result)) {
			while ($item = $this->db->fetchObject($result)) {
				$array[] = $item;
			}
		}

		return $array;
	}

	//отфильтрованный рейтинг
	public function filterList($name, $surname, $patronymic, $class, $parallel) {
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

		if ($parallel) {
			$class = (int) $class;
			$query = "SELECT t1 . * , t2.name, t2.surname, t2.patronymic, CAST( t2.class AS SIGNED ) AS  `class`
				FROM  `data_rating` AS t1 LEFT JOIN `data_students` AS t2
				ON t1.id_student = t2.id
				WHERE `name` LIKE '%$name%'
					AND `surname` LIKE '%$surname%'
					AND `patronymic` LIKE '%$patronymic%'
					AND `class` = $class
				ORDER BY  `rating` DESC";
		} else {
			$query = "SELECT t1.*, t2.name, t2.surname, t2.patronymic, t2.class
				FROM `data_rating` AS t1 LEFT JOIN `data_students` AS t2
				ON t1.id_student = t2.id
				WHERE `name` LIKE '%$name%'
						AND `surname` LIKE '%$surname%'
						AND `patronymic` LIKE '%$patronymic%'
						AND `class` LIKE '%$class%'
				ORDER BY `rating` DESC";
		}
		$result = $this->db->query($query);
		while ($item = $this->db->fetchObject($result)) {
			$array[] = $item;
		}

		return $array;
	}

	//установка данных в ассоциативный массив
	function setData($idStudent, $math, $rus, $history, $english, $physic_cult) {
		$this->data['id_student'] = $idStudent;
		$this->data['math'] = $math;
		$this->data['rus'] = $rus;
		$this->data['history'] = $history;
		$this->data['english'] = $english;
		$this->data['physic_cult'] = $physic_cult;
		$this->data['rating'] = ($math + $rus + $history + $english + $physic_cult) / 5;
	}

	//получить список учеников
	function getStudentsList() {
		return $this->db->loadObjectList('data_students');
	}

	//получить обного ученика
	function getStudent($id) {
		$item = $this->db->getObject('data_students', $id);
		return $item;
	}

	//пополнение рейтинга для новых учеников
	function newStudents() {
		$array = array();
		$query = "SELECT * FROM `data_students` WHERE `id` NOT IN (SELECT `id_student` FROM `$this->tableName`)";
		$result = $this->db->query($query);
		if ($this->db->numRows($result)) {
			while ($item = $this->db->fetchAssoc($result)) {
				$array['id_student'] = $item['id'];
				$this->db->insert($this->tableName, $array);
			}
		}
	}

	//удаление рейтинга удаленных учеников
	function noStudents() {
		$query = "SELECT * FROM `$this->tableName` WHERE `id_student` NOT IN (SELECT `id` FROM `data_students`)";
		$result = $this->db->query($query);
		if ($this->db->numRows($result)) {
			while ($item = $this->db->fetchAssoc($result)) {
				$this->db->delete($item['id'], $this->tableName);
			}
		}
	}

	//проверка
	function check($id, $math, $rus, $history, $english, $physic_cult) {
		$this->setData($id, $math, $rus, $history, $english, $physic_cult);

		if (empty($this->data['id_student'])) {
			$this->error = 'Студент не выбран';
			$this->status = 'error';
			return $this->status;
		}

		if (!$this->validate()) {
			$this->status = 'error';
		}

		return $this->status;
	}

	//проверка оценок на корректность воода
	public function validate() {
		if (!(preg_match('/^[0-5]?$/', $this->data['math']) &&
				preg_match('/^[0-5]?$/', $this->data['rus']) &&
				preg_match('/^[0-5]?$/', $this->data['history']) &&
				preg_match('/^[0-5]?$/', $this->data['english']) &&
				preg_match('/^[0-5]?$/', $this->data['physic_cult']))) {
			$this->error = 'Поля могут содержать только оценки в интервале от 0 до 5';
			return false;
		}
		return true;
	}

}

?>