<?php

/**
 * Выводит все возможные ошибки, которые могут возникнуть при работе приложения
 *
 * @author Антон
 */
class Messages {

	/**
	 * Сообщение об ошибке
	 *
	 * Выводит сообщение об ошибке в виде HTML кода. Работа приложения не завершается.
	 * Сообщение помещается в блок <div> c наименованием класса "errorMsg"
	 *
	 * @param string $message Текст сообщения об ошибке
	 */
	static public function errorMsg($message) {
		echo "<div class=\"errorMsg\"><p>$message</p></div>";
	}

	/**
	 * Фатальная ошибка
	 *
	 * Выводит сообщение об ошибке в виде HTML кода с завершением работы приложения.
	 * Сообщение помещается в блок <div> c наименованием класса "errorMsg"
	 *
	 * @param string $message Текст сообщения об ошибке
	 */
	static public function fatalError($message) {
		echo "<div class=\"errorMsg\"><p>Fatal Error: $message</p></div>";
		exit();
	}

	/**
	 * Сообщение об успешном выполнении операции
	 * Сообщение помещается в блок <div> c наименованием класса "successMsg"
	 *
	 * @param string $message Текст сообщения
	 */
	static public function successMsg ($message) {
		echo "<div class=\"successMsg\"><p>$message</p></div>";
	}
}

?>