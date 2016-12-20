<?php

$path = dirname(__FILE__);
$url = $_SERVER['REQUEST_URI'];
$user = User::GetUser();

require_once 'helper.php';
$helper = new helpRating();
$helper->newStudents();
$helper->noStudents();
$result = '';
$letterClass = array('А', 'Б', 'В', 'Г', 'Д', 'E');

if ($_POST['filter']) {
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$patronymic = $_POST['patronymic'];
	$class = $_POST['class'];
	$parallel = $_POST['parallel'];
	$list = $helper->filterList($name, $surname, $patronymic, $class, $parallel);
} else {
	$list = $helper->loadList();
}

switch ($_GET['action']) {
	case 'edit' :
		if ($user->id) {
			$id = $_GET['id'];
			if (!isset($_POST['editRating'])) {
				$helper->setDataDB($id);
				$data = $helper->getData();
				$math = $data['math'];
				$rus = $data['rus'];
				$history = $data['history'];
				$english = $data['english'];
				$physic_cult = $data['physic_cult'];
			} else {
				$id = $_GET['id'];
				$math = $_POST['math'];
				$rus = $_POST['rus'];
				$history = $_POST['history'];
				$english = $_POST['english'];
				$physic_cult = $_POST['physic_cult'];
				$result = $helper->check($id, $math, $rus, $history, $english, $physic_cult);
				if ($result == 'success') {
					$result = $helper->edit($id);
				}
			}
			require_once 'view/edit.php';
		} else {
			require_once 'view/default.php';
		}
		break;

	default :
		require_once 'view/default.php';
}
?>
