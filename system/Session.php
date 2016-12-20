<?php

/**
 * Singleton Session
 *
 * Класс для работы с сессией
 * @author Антон
 */
class Session {

	/**
	 *
	 * @var Session Singleton
	 */
	private static $session;

	/**
	 * старт сессии
	 */
	private function __construct() {
		@session_start();
	}

	/**
	 * Старт сессии
	 *
	 * Если объект Session не создан, то создается объект и запускается сессия, иначе возвращается текущая сессия
	 * @return Session Объект класса Session
	 */
	static public function getSession() {
		if (null === self::$session) {
			self::$session = new self();
		}
		return self::$session;
	}

	/**
	 * Сохранить сессию
	 *
	 * Заносит в сессию с именем $sessionName значение $value
	 *
	 * @param string $sessionName имя сессии
	 * @param string $value значение
	 */
	public function saveSession($sessionName, $value) {
		$_SESSION[$sessionName] = $value;
	}

	/**
	 * Загрузить сессию
	 *
	 * Загружает сессию с именем $sessionName. Если сессия существует, то возвращает значение, иначе возвращает FALSE
	 * @param string $sessionName Имя сесии
	 * @return string Значение сессии
	 */
	public function loadSession($sessionName) {
		return $_SESSION[$sessionName];
	}

	/**
	 * освобождает переменную сессии
	 *
	 * Если переменная существует в сессии, то она очищается.
	 * @param string $sessionName имя переменной в сессии
	 */
	public function deleteSession($sessionName) {
		if (isset($_SESSION[$sessionName])) {
			$_SESSION[$sessionName] = '';
		}
	}

	/**
	 * Уничтожает текущую сессию
	 */
	public function destroySession() {
		@session_destroy();
	}
}

?>