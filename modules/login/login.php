<?

require_once 'helper.php';

$session = Session::getSession();
$url = $_SERVER['REQUEST_URI'];
$path = dirname(__FILE__);
$user = User::GetUser();

if ($user->id) {
	if (isset($_POST['logoutSubmit'])) {
		$user->logOut();
		print "<meta http-equiv=\"refresh\" content=\"0;URL=$url\">";
	}
} else {
	if (isset($_POST['loginSubmit'])) {
		$login = $_POST['login'];
		$password = $_POST['password'];

		$help = helpLogin::getHelper($login, $password);
		$message = $help->helper();
		if ($message == '') {
			$session->saveSession('login', $login);
			print "<meta http-equiv=\"refresh\" content=\"0;URL=$url\">";
		} else {
			Messages::errorMsg($message);
		}
	}
}

require_once 'view/form.php';
?>