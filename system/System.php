<?php

/**
 * Description of System
 *
 * @author Антон
 */
abstract class System {

	/**
	 *
	 * @var DataBase
	 */
	protected $db;

	/**
	 *
	 * @var Session
	 */
	protected $session;

	function __construct() {
		$this->db = DataBase::getDB();
		$this->session = Session::getSession();
	}

}

?>