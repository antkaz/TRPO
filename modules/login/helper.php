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
class helpLogin {

	private static $help;
	private $login;
	private $password;
	private $error;

	function __construct($login, $password, $error = '') {
		$this->login = htmlspecialchars(trim($login));
		$this->password = htmlspecialchars(trim($password));
		$this->error = $error;
	}

	//если объект создан, возвращает его, иначе создает
	static public function getHelper($login, $password) {
		if (null === self::$help) {
			self::$help = new helpLogin($login, $password, $error = '');
		} else {
			$this->login = htmlspecialchars(trim($login));
			$this->password = htmlspecialchars(trim($password));
		}
		return self::$help;
	}

	//проверка на корректность воода.
	public function helper() {
		if ($this->login == '' || $this->password == '') {
			$this->error .= "Не все поля заполнены\n";
			return $this->error;
		}

		if (!$this->validateLogin()) {
			return $this->error;
		}

		if (!$this->validatePassword()) {
			return $this->error;
		}

		if (!$this->authentication()) {
			return $this->error;
		}

		return $this->error;
	}

	//проверка логина
	private function validateLogin() {
		if (!preg_match("/^\w{3,30}$/", $this->login)) {
			$this->error .= "Логин может состоять только из букв, цифр и знака подчеркивания длинной от 3 до 30 символов\n";
			return false;
		}
		return true;
	}

	//проверка пароля
	private function validatePassword() {
		if (!preg_match("/^\w{5,}$/", $this->password)) {
			$this->error .= "Пароль может состоять только из букв, цифр и знака подчеркивания длинной не менее 5 символов\n";
			return false;
		}
		return true;
	}

	//проверка в базе данных
	private function authentication() {
		$db = DataBase::getDB();
		$query = "SELECT * FROM `data_users` WHERE `login` = '$this->login' AND `password` = '$this->password'";
		$result = $db->query($query);

		if (!$db->result($result)) {
			$this->error .= "Неверно указан логин или пароль\n";
			return false;
		}
		return true;
	}

}

?>