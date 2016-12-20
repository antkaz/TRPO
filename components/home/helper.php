<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of helper
 *
 * @author Антон
 */
class helpHome extends Helper {

	public function __construct() {
		parent::__construct();
	}

	//список лучших учеников
	function loadList() {
		$array = array();

		$query = "SELECT t1.*, t2.name, t2.surname, t2.patronymic, t2.class
			FROM `data_rating` AS t1 LEFT JOIN `data_students` AS t2
			ON t1.id_student = t2.id
			WHERE `rating` = 5
			ORDER BY `rating` DESC";
		$result = $this->db->query($query);
		while ($item = $this->db->fetchObject($result)) {
			$array[] = $item;
		}

		return $array;
	}

	//список плохих учеников
	public function loadListFail() {
		$array = array();

		$query = "SELECT t1.*, t2.name, t2.surname, t2.patronymic, t2.class
			FROM `data_rating` AS t1 LEFT JOIN `data_students` AS t2
			ON t1.id_student = t2.id
			WHERE `math` <= 2 OR `rus` <= 2 OR `history` <= 2 OR `english` <= 2 OR `physic_cult` <= 2
			ORDER BY `rating` DESC";

		$result = $this->db->query($query);
		while ($item = $this->db->fetchObject($result)) {
			$array[] = $item;
		}

		return $array;
	}

}

?>