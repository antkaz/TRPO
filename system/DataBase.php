<?php

/**
 * Работа с базой данных
 *
 * DataBase позволяет работать с базой данных
 * @author Антон Казаринов
 */
class DataBase {

	/**
	 *
	 * @var DataBase Singleton
	 */
	private static $db;

	/**
	 *
	 * @var string Имя хоста
	 */
	private $host;

	/**
	 *
	 * @var string Логин для подключения к серверу MySql
	 */
	private $login;

	/**
	 *
	 * @var string Пароль для подключения к серверу MySql
	 */
	private $password;

	/**
	 *
	 * @var string Имя базы данных
	 */
	private $dbName;

	/**
	 *
	 * @var boolean Флаг подключения к серверу MySql
	 */
	private $mysqlConnect = false;

	/**
	 *
	 * @var boolean Флаг подключения к базе данных
	 */
	private $dbConnect = false;

	/**
	 * Конструктор для базы данных
	 *
	 * Задает необходимые параметры для подключения к базе данных.
	 * Если параметры не переданы, по умолчанию задаются из файла settings.php
	 *
	 * @global type $DBCONFIG Конфигурации
	 * @param string $host Сервер базы данных
	 * @param string $login Логин
	 * @param string $password Пароль
	 * @param string $dbName Имя база данных
	 */
	private function __construct($host = '', $login = '', $password = '', $dbName = '') {
		global $DBCONFIG;

		if ($host) {
			$this->host = $host;
			$this->login = $login;
			$this->password = $password;
			$this->dbName = $dbName;
		} else {
			$this->host = $DBCONFIG['host'];
			$this->login = $DBCONFIG['login'];
			$this->password = $DBCONFIG['password'];
			$this->dbName = $DBCONFIG['dbName'];
		}
		$this->connect();
	}

	/**
	 * Создать копию экземпляра класса
	 *
	 * Не реализован
	 */
	private function __clone() {

	}

	/**
	 * Получить подключение к базе данных
	 *
	 * Если подключение уже создано, то возвращает его, иначе создает новый объект DataBase и возвращает его
	 *
	 * @return DataBase
	 */
	static public function getDB() {
		if (null === self::$db) {
			self::$db = new self();
		}
		return self::$db;
	}

	/**
	 * Connect to the database MySQL
	 *
	 * Устанавливает соединение с базой данных. В случае неудачи,
	 * connect() возвращает сообщение об ошибке
	 */
	public function connect() {
		if (!$this->mysqlConnect) {
			$this->mysqlConnect = @mysql_pconnect($this->host, $this->login, $this->password);

			if ($this->mysqlConnect) {
				$this->dbConnect = @mysql_select_db($this->dbName, $this->mysqlConnect);
				if (!$this->dbConnect) {
					$this->query("CREATE DATABASE `$this->dbName` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;");
					$this->dbConnect = @mysql_select_db($this->dbName, $this->mysqlConnect);
					if (!$this->dbConnect) {
						Messages::fatalError($this->error());
					}
				}
				$this->query("SET NAMES utf8");
			} else {
				$message = "Could not connect to MySQL";
				Messages::fatalError($message);
				die();
			}
		}
	}

	/**
	 * Close to database MySQL connection
	 *
	 * Закрывает соединение с сервером MySQL
	 */
	public function close() {
		if ($this->mysqlConnect)
			mysql_close($this->mysqlConnect);
	}

	/**
	 * Query to the database MySQL
	 *
	 * Посылает запрос MySQL
	 *
	 * @param string $query Текст запроса
	 * @param boolean $debug Вывод ошибок при некоректном запросе. По умолчанию FALSE
	 * @return resource Для запросов SELECT, SHOW, DESCRIBE, EXPLAIN и других запросов, возвращающих результат из нескольких рядов,
	 * 					возвращает дескриптор результата запроса (resource), или сообщение об ошибке, если передан параметр $debug, иначе FALSE.
	 * 					Для других типов SQL-запросов, INSERT, UPDATE, DELETE, DROP и других,
	 * 					возвращает TRUE в случае успеха или сообщение об ошибке, если передан параметр $debug, иначе FALSE.
	 */
	public function query($query, $debug = false) {
		$result = @mysql_query($query, $this->mysqlConnect);

		if (!$result && $debug) {
			Messages::errorMsg($this->error());
		}

		return $result;
	}

	/**
	 * Возвращает данные результата запроса
	 *
	 * Возвращает содержимое одного поля из набора результата MySQL.
	 * @param resource $result результат метода mysql_query() (DataBase::query())
	 * @param type $row Номер получаемого ряда из результата. Нумерация рядов начинается с 0.
	 * @param type $field Имя или смещение получаемого поля.
	 * 					Может быть как смещением поля, именем поля, так и именем поля вместе с таблицей (таблица.поле).
	 * 					Если для поля был указан псевдоним ('select foo as bar from...'), используйте его вместо имени самого поля.
	 * 					Если не указан, возвращается первое поле.
	 * $return Содержимое одного поля из набора результата MySQL в случае успеха, или FALSE в случае ошибки.
	 */
	public function result($result, $row = 0, $field = 0) {
		return @mysql_result($result, $row, $field);
	}

	/**
	 * Возвращает количество рядов результата запроса
	 *
	 * Возвращает количество рядов результата запроса. Эта команда работает только с запросами SELECT или SHOW, возвращающих актуальный результат запроса
	 *
	 * @param resource $result результат метода mysql_query() (DataBase::query())
	 * @return int Количество рядов в результате запроса в случае успеха или FALSE в случае возникновения ошибки
	 */
	public function numRows($result) {
		return @mysql_num_rows($result);
	}

	/**
	 * Возвращает ряд результата запроса в качестве ассоциативного массива
	 *
	 * Возвращает ассоциативный массив, соответсвующий полученному ряду и сдвигает вперед внутренний указатель результата
	 *
	 * @param resource $result результат метода mysql_query() (DataBase::query())
	 * @return array() Возвращает ряд результата запроса в качестве ассоциативного массива
	 */
	public function fetchAssoc($result) {
		return @mysql_fetch_assoc($result);
	}

	/**
	 * Обрабатывает ряд результата запроса и возвращает массив с числовыми индексами
	 *
	 * Возвращает массив с числовыми индексами, содержащий данные обработанного ряда, и сдвигает внутренний указатель результата вперед
	 *
	 * @param resource $result результат метода mysql_query() (DataBase::query())
	 * @return array() Возвращает массив строк с числовыми индексами, содержащий данные обработанного ряда, или FALSE, если рядов не осталось
	 */
	public function fetchRow($result) {
		return @mysql_fetch_row($result);
	}

	/**
	 * Обрабатывает ряд результата запроса и возвращает объект
	 *
	 * Возвращает объект со свойствами, соответствующими колонкам в обработанном ряду и сдвигает внутренний указатель результата вперед
	 *
	 * @param resource $result результат метода mysql_query() (DataBase::query())
	 * @param string $className Имя класса. Будет создан экземпляр указанного класса, заполнен свойствами и возвращен. Если не указан, возвращается экземпляр stdClass.
	 * @return object Возвращает объект (object) со строковыми свойствами, соответствующими полученному ряду, или FALSE, если рядов больше нет.
	 */
	public function fetchObject($result, $className = 'stdClass') {
		return @mysql_fetch_object($result, $className);
	}

	/**
	 * Возвращает массив объктов
	 *
	 * Возвращает массив объектов из таблицы $tableName базы данных класса $className.
	 *
	 * @param string $tableName Имя таблицы
	 * @param string $className Имя класса, к которому принадлежат объекты
	 * @param bool $debug показ ошибок при работе с базой данных
	 * @return array() массив объектов
	 */
	public function loadObjectList($tableName, $className = 'stdClass', $debug = false) {
		$tableName = mysql_real_escape_string($tableName);
		$array = array();

		$query = "SELECT * FROM `$tableName`";
		$result = $this->query($query, $debug);
		while ($row = $this->fetchObject($result, $className)) {
			$array[] = $row;
		}

		return $array;
	}

	/**
	 * MySQL error
	 *
	 * Возвращает текст ошибки последней операции с MySQL
	 *
	 * @return string Возвращает текст ошибки выполнения последней функции MySQL
	 */
	public function error() {
		return @mysql_error($this->mysqlConnect);
	}

	/**
	 * Возвращает идентификатор, сгенерированный при последнем INSERT-запросе
	 *
	 * Возвращает идентификатор, сгенерированный колонкой с AUTO_INCREMENT последним запросом (обычно INSERT)
	 *
	 * @return int Идентификатор последней записи, сгенерированной INSERT-запросом
	 */
	public function insertId() {
		return @mysql_insert_id($this->mysqlConnect);
	}

	/**
	 * Добавляет запись в таблицу
	 *
	 * Добавляет запись в таблицу базы данных. Возвращает идентификатор добавленной записи. В случае ошибки возвращает 0
	 *
	 * @param strind $tableName Имя таблицы, в которую нужно добавить запись
	 * @param array $assocArray ассоциативный массив, в котором ключ является полем таблицы, а значение - значением данного поля
	 * @param boolean $debug Вывод ошибок при некоректном запросе. По умолчанию FALSE
	 * @return int идентификатор данной записи
	 */
	public function insert($tableName, $assocArray, $debug = false) {
		$fields = "`id`";
		$tableName = mysql_real_escape_string($tableName);
		$values = "''";

		foreach ($assocArray as $field => $value) {
			$field = mysql_real_escape_string(stripslashes($field));
			$value = mysql_real_escape_string(stripslashes($value));

			$fields .= ", `$field`";
			$values .= ", '$value'";
		}

		$query = "INSERT INTO `$tableName` ($fields) VALUES ($values)";
		if ($this->query($query, $debug)) {
			return $this->insertId();
		}

		return 0;
	}

	/**
	 * Вносит изменения в указанную запись
	 *
	 * Вносит изменения в указанную запись. В случае успеха выполнения возвращает TRUE, иначе - сообщение об ошибке и FALSE
	 *
	 * @param int $id Идентификатор записи, которую нужно изменить
	 * @param string $tableName Имя таблицы, в которой находится указанная запись
	 * @param array $assocArray ассоциативный массив, в котором ключ является полем таблицы, а значение - значением данного поля
	 * @param boolean $debug Вывод ошибок при некоректном запросе. По умолчанию FALSE
	 * @return boolean TRUE в случае успеха, иначе - FALSE
	 */
	public function update($id, $tableName, $assocArray, $debug = false) {
		$id = intval($id);
		$tableName = mysql_real_escape_string($tableName);
		$fields = "`id` = '$id'";

		foreach ($assocArray as $field => $value) {
			$field = mysql_real_escape_string(stripslashes($field));
			$value = mysql_real_escape_string(stripslashes($value));

			$fields .= ", `$field` = '$value'";
		}

		$query = "UPDATE `$tableName` SET $fields WHERE `id`='$id'";
		if ($this->query($query, $debug)) {
			return true;
		}
		return false;
	}

	/**
	 * Удаляет запись из таблицы
	 *
	 * Удаляет запись из таблицы базы данных. В случае успешного удаления возвращает TRUE, иначе - FALSE
	 *
	 * @param int $id Идентификатор записи, которую необходимо удалить
	 * @param string $tableName Имя таблицы, из которой необходимо удалить запись
	 * @param boolean $debug Вывод ошибок при некоректном запросе. По умолчанию FALSE
	 * @return boolean В случае успеха возвращает TRUE, иначе - FALSE
	 */
	public function delete($id, $tableName, $debug = false) {
		$id = intval($id);
		$tableName = mysql_real_escape_string($tableName);

		$query = "DELETE FROM `$tableName` WHERE `id`='$id'";
		if ($id && $this->query($query, $debug)) {
			return true;
		} else {
			//error
			return false;
		}
	}

	/**
	 * Возвращает ряд таблицы в качестве ассоциативного массива
	 *
	 * Возвращает первый ряд из таблицы $tableName, удовлетворяющий номеру $id.
	 *
	 * @param string $tableName Имя таблицы
	 * @param int $id Идентификатор строки
	 * @param bool $debug Вывод ошибок при некоректном запросе. По умолчанию FALSE
	 * @return array() Ассоциативный массив
	 */
	public function getRow($tableName, $id, $debug = false) {
		$id = intval($id);
		$tableName = mysql_real_escape_string($tableName);

		$query = "SELECT * FROM `$tableName` WHERE `id`='$id'";
		$result = $this->fetchAssoc($this->query($query, $debug));
		return $result;
	}

	/**
	 * Возвращает ряд из таблицы в качестве объекта
	 *
	 * Возвращает ряд из таблицы $tableName с уникальным идентификатором $id, в качестве объекта класса $className
	 *
	 * @param string $tableName Имя таблицы
	 * @param int $id Идентификатор строки
	 * @param string $className Имя класса объекта. По умолчанию stdClass
	 * @param bool $debug Вывод ошибок при некоректном запросе. По умолчанию FALSE
	 * @return object Объект
	 */
	public function getObject($tableName, $id, $className = 'stdClass', $debug = false) {
		$id = intval($id);
		$tableName = mysql_real_escape_string($tableName);

		$query = "SELECT * FROM `$tableName` WHERE `id`='$id'";
		$result = $this->query($query, $debug);
		$object = $this->fetchObject($result, $className);
		return $object;
	}

}

?>