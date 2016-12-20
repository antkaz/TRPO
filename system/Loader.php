<?php

/**
 * Class Loader. Содержит статические методы для подключения модулей
 *
 * @author Антон
 */
class Loader {

	/**
	 * Подключает шаблон
	 *
	 * ПОдключает шаблон сайта. В качестве параметра принимает имя шаблона. Если шаблон не найден,
	 * то срабатывает фатальная ошибка.
	 * @param string $templateName Имя шаблона
	 * @return type
	 */
	static public function loadTemplate($templateName) {
		$message = '';
		$path = ROOT . "/templates/" . $templateName;
		$index = $path . "/index.php";

		if (is_dir($path)) {
			if (is_file($index)) {
				require_once $index;
				return;
			} else {
				$message = "Файл " . $templateName . ".php подключаемого шаблона не найден. Директория: " . $path;
			}
		} else {
			$message = "Подключаемый шаблон не найден. Директория: " . $path;
		}

		if ($message) {
			Messages::fatalError($message);
		}
	}

	/**
	 * Подключает модуль
	 *
	 * Подключает модуль в том месте, где вызывается метод. В качестве параметра принимает имя модуля.
	 * Если модуль отсутствует, то выводится сообщение об ошибке.
	 *
	 * @param string $moduleName Имя подключаемого модуля
	 */
	static public function loadModule($moduleName) {
		$message = '';
		$path = ROOT . "/modules/" . $moduleName;
		$index = $path . "/" . $moduleName . ".php";


		if (is_dir($path)) {
			if (is_file($index)) {
				include $index;
				return;
			} else {
				$message = "Файл " . $moduleName . ".php подключаемого модуля не найден. Директория: " . $path;
			}
		} else {
			$message = "Подключаемый модуль не найден. Директория: " . $path;
		}

		if ($message) {
			Messages::errorMsg($message);
		}
	}

	/**
	 * Подключает компонент
	 *
	 * Подключает компонент, имя которого передается через GET параметр.
	 * Если компонент отсутствует, то выводится сообщение об ошибке.
	 *
	 * @param string $componentName Имя подключаемого компонента
	 */
	static public function loadComponent() {
		$message = '';
		if (isset($_GET['com'])) {
			$componentName = $_GET['com'];
			$path = ROOT . "/components/" . $componentName;
			$index = $path . "/" . $componentName . ".php";

			if (is_dir($path)) {
				if (is_file($index)) {
					require_once $index;
					return;
				} else {
					$message = "Файл " . $componentName . ".php компонента не найден. Директория: " . $path;
				}
			} else {
				$message = "Подключаемый компонент не найден. Директория: " . $path;
			}

			if ($message) {
				Messages::errorMsg($message);
			}
		} else {
			$path = ROOT . "/components/home";
			$index = $path . "/home.php";

			if (is_dir($path)) {
				if (is_file($index)) {
					require_once $index;
					return;
				} else {
					$message = "Файл home.php компонента не найден. Директория: " . $path;
				}
			} else {
				$message = "Подключаемый компонент не найден. Директория: " . $path;
			}

			if ($message) {
				Messages::errorMsg($message);
			}
		}
	}

	/**
	 * Подключает View-файл php
	 *
	 * Подключает View-файл php. В качестве параметра принимает имя файла, который необходимо подключить
	 * и полный путь директории, в которой находится View-файл
	 * В случае неудачи формируется сообщение об ошибке.
	 *
	 * @param string $viewName Имя подключаемого файла
	 * @param string $path Директория, в которой находится файл
	 */
	static public function loadView($viewName, $path) {
		$message = '';
		$path = $path . "/view/" . $viewName . ".php";
		if (is_file($path)) {
			include $path;
		} else {
			$message = "View-файл отсутствует. Директроия: " . $path;
			Messages::errorMsg($message);
		}
	}

}

?>