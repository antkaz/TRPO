<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
	<head>
		<title>ShutterPress</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="/templates/shutterpress/css/template.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="/templates/shutterpress/css/layout.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="/templates/shutterpress/css/modules.css" media="screen" />

		<script src="/templates/shutterpress/js/jquery-1.8.2.min.js" type="text/javascript"></script>
		<script src="/templates/shutterpress/js/validate.js" type="text/javascript"></script>
		<script src="/templates/shutterpress/js/javascript.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="wrapper">
			<div id="wrapper-top">
			</div>

			<div id="left">
				<div class="logo"><a href="/">АСУ Школы</a></div>

				<div class="modulemenu">
					<? Loader::loadModule('menu'); ?>
				</div>
				<div class="clear"></div>

				<div class="module">
					<h3 class="header">Авторизация</h3>
					<? Loader::loadModule('login'); ?>
				</div>
			</div>

			<div id="right">
				<div id="content">
					<? Loader::loadComponent(); ?>
				</div>
			</div>

			<div id="wrapper-bottom">
			</div>
		</div>
	</body>
</html>