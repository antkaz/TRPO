<?php

$path = dirname(__FILE__);
$url = $_SERVER['REQUEST_URI'];
$user = User::GetUser();

require_once 'helper.php';
$helper = new helpParents();
$result = '';

if (isset($_POST['filter'])) {
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$patronymic = $_POST['patronymic'];
	$list = $helper->filterList($name, $surname, $patronymic);
} else {
	$list = $helper->loadList('Parents');
}

switch ($_GET['action']) {
	case 'edit' :
		if ($user->id) {
			$id = $_GET['id'];
			if (!isset($_POST['editParent'])) {
				$helper->setDataDB($id);
				$data = $helper->getData();
				$name = $data['name'];
				$surname = $data['surname'];
				$patronymic = $data['patronymic'];
				$sex = $data['sex'];
				$birth = explode('-', $data['birth']);
				$day = $birth[2];
				$month = $birth[1];
				$year = $birth[0];
				$phoneCode = $data['phoneCode'];
				$phoneNumber = $data['phoneNumber'];
				$address = $data['address'];
				$work = $data['work'];
			} else {
				$name = $_POST['name'];
				$surname = $_POST['surname'];
				$patronymic = $_POST['patronymic'];
				$sex = $_POST['sex'];
				$day = (int) $_POST['day'];
				$month = (int) $_POST['month'];
				$year = (int) $_POST['year'];
				$address = $_POST['address'];
				$phoneCode = $_POST['phone-code'];
				$phoneNumber = $_POST['phone-number'];
				$work = $_POST['work'];
				$result = $helper->check($name, $surname, $patronymic, $sex, $day, $month, $year, $address, $phoneCode, $phoneNumber, $work);
				if ($result == 'success') {
					$result = $helper->edit($_GET['id']);
				}
			}
			require_once 'view/edit.php';
		} else {
			require_once 'view/default.php';
		}
		break;

	case 'add' :
		if ($user->id) {
			if (isset($_POST['addParent'])) {
				$name = $_POST['name'];
				$surname = $_POST['surname'];
				$patronymic = $_POST['patronymic'];
				$sex = $_POST['sex'];
				$day = (int) $_POST['day'];
				$month = (int) $_POST['month'];
				$year = (int) $_POST['year'];
				$address = $_POST['address'];
				$phoneCode = $_POST['phone-code'];
				$phoneNumber = $_POST['phone-number'];
				$work = $_POST['work'];
				$result = $helper->check($name, $surname, $patronymic, $sex, $day, $month, $year, $address, $phoneCode, $phoneNumber, $work);
				if ($result == 'success') {
					$result = $helper->add(true);
				}
			}
			require_once 'view/add.php';
		} else {
			require_once 'view/default.php';
		}
		break;

	case 'delete' :
		if ($user->id) {
			$id = $_GET['id'];
			$helper->delete($id);
		} else {
			require_once 'view/default.php';
		}
		break;

	default :
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$item = $helper->getObject($id);
		} else {
			$id = 0;
		}
		require_once 'view/default.php';
}
?>
