<?php

$path = dirname(__FILE__);
$user = User::GetUser();

require_once 'helper.php';
$result = '';
$helper = new helpStedents();

$listMother = $helper->getMotherList();
$listFather = $helper->getFatherList();
$letterClass = array('А', 'Б', 'В', 'Г', 'Д', 'E');
$url = $_SERVER['REQUEST_URI'];

if ($_POST['filter']) {
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$patronymic = $_POST['patronymic'];
	$class = $_POST['class'];
	$list = $helper->filterList($name, $surname, $patronymic, $class);
} else {
	$list = $helper->loadList('Student');
}

switch ($_GET['action']) {
	case 'edit' :
		if ($user->id) {
			$id = $_GET['id'];
			if (!isset($_POST['editStudent'])) {
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
				$father = $data['parentFather'];
				$mother = $data['parentMother'];
				$address = $data['address'];
				$class = $data['class'];
			} else {
				if (isset($_POST['editStudent'])) {
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
					$mother = $_POST['mother'];
					$father = $_POST['father'];
					$class = $_POST['class'];
					$result = $helper->check($name, $surname, $patronymic, $sex, $day, $month, $year, $address, $phoneCode, $phoneNumber, $mother, $father, $class);
					if ($result == 'success') {
						$result = $helper->edit($_GET['id']);
					}
				}
			}
			require_once 'view/edit.php';
		} else {
			require_once 'view/default.php';
		}
		break;

	case 'add' :
		if ($user->id) {
			if (isset($_POST['addStudent'])) {
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
				$mother = $_POST['mother'];
				$father = $_POST['father'];
				$class = $_POST['class'];
				$result = $helper->check($name, $surname, $patronymic, $sex, $day, $month, $year, $address, $phoneCode, $phoneNumber, $mother, $father, $class);
				if ($result == 'success') {
					$result = $helper->add();
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

	case 'deleteClass' :
		if ($user->id) {
			$id = $_GET['idClass'];
			$helper->deleteClass($id);
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