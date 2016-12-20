<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Helper
 *
 * @author Антон
 */
abstract class Helper extends System {

	protected $tableName = '';
	protected $status = 'success';
	protected $data = array();
	public $url;
	public $error = '';
	public $success = '';

	function __construct() {
		parent::__construct();
	}

	//зугружает список таблицы в виде объектов
	function loadList($className = 'stdClass', $debug = false) {
		return $this->db->loadObjectList($this->tableName, $className, $debug);
	}

	//Удаляет запись из таблицы по id
	function delete($id, $debug = false) {
		$this->db->delete($id, $this->tableName, $debug);
		print "<meta http-equiv=\"refresh\" content=\"0;URL=$this->url\">";
	}

	//добавляет в таблицу запись, передаваемую в виде ассоциативного массива.
	function add($debug = false) {
		if (!$this->db->insert($this->tableName, $this->data, $debug)) {
			$this->status = 'error';
			$this->error = 'Ошибка при добавлении в базу данных';
		} else {
			$this->success = "Запись успешно добавлена\n";
		}
		return $this->status;
	}

	//редактировать запись по id
	function edit($id, $debug = false) {
		if (!$this->db->update($id, $this->tableName, $this->data, $debug)) {
			$this->status = 'error';
			$this->error = 'Ошибка при изменении записи в базе данных';
		} else {
			$this->success = "Запись успешно изменена\n";
		}
		return $this->status;
	}

	//получить данные о записи
	public function getData() {
		return $this->data;
	}

	//утсановить данные в ассоциативный массив из базы данных по id
	public function setDataDB($id, $debug = false) {
		$this->data = $this->db->getRow($this->tableName, $id, $debug);
	}

	//получить объект из базы данных по id
	public function getObject($id) {
		return $this->db->getObject($this->tableName, $id);
	}

}

?>