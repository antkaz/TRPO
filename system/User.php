<?php

/**
 * Description of User
 *
 * @author Антон
 */
class User extends System {

	/**
	 *
	 * @var User Singleton
	 */
	private static $user;

	/**
	 *
	 * @var string имя базы данных пользвоателей
	 */
	private $tableName;

	/**
	 *
	 * @var int идентификатор пользователя
	 */
	public $id = null;

	/**
	 *
	 * @var string Логин пользователя
	 */
	public $login = null;

	/**
	 *
	 * @var string Пароль пользователя
	 */
	public $password = null;

	/**
	 *
	 * @var string E-mail
	 */
	public $email = null;
	/**
	 * Конструктор
	 *
	 * проверяет, существует ли таблица пользователей. При ее отсутсвии создает таблицу и заносит туда пользователя с логином и паролем admin.
	 * По возможности загружает пользователя из сессии
	 */
	function __construct() {
		parent::__construct();
		$this->tableName = 'data_users';

		$query = "DESCRIBE `$this->tableName`";
		if (!$this->db->query($query)) {
			$this->db->query("
				CREATE TABLE IF NOT EXISTS `data_users` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `login` char(50) NOT NULL,
				  `password` char(50) NOT NULL,
				  `email` char(100) NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
			");
			$array = array('login' => 'admin', 'password' => 'admin');
			$this->db->insert($this->tableName, $array);
		}

		$this->loadProfile();
	}

	/**
	 *
	 * @return \User
	 */
	static function GetUser() {
		if (null === self::$user) {
			self::$user = new self();
		}
		return self::$user;
	}

	/**
	 * Загрузка профиля
	 *
	 * Загружается профиль из сессии. Если в сессии есть пользователь, то устанавливаются его данные.
	 */
	public function loadProfile() {
		if ($session = $this->session->loadSession('login')) {
			$query = "SELECT * FROM `data_users` WHERE `login` = '$session'";
			$result = $this->db->query($query);
			if ($this->db->numRows($result)) {
				$item = $this->db->fetchObject($result);
				$this->id = $item->id;
				$this->login = $item->login;
				$this->password = $item->password;
				$this->email = $item->email;
			}
		}
	}

	/**
	 * Сохраняет пользователя в сессии
	 *
	 * @param string $sessionName значение для сохранения
	 */
	public function saveProfile($sessionName) {
		$_SESSION['user'] = $sessionName;
	}

	/**
	 * уничтожает сессию, тем самым удаляет пользователя из нее и присваивает объекту user значение null
	 */
	public function logOut() {
		$this->session->destroySession();
		self::$user = null;
	}

}

?>