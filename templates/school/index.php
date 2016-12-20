<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<link type="text/css" href="/templates/school/css/style.css" rel="stylesheet" />
		<link type="text/css" href="/templates/school/css/jquery.arcticmodal-0.2.css" rel="stylesheet" />

		<script type="text/javascript" src="/templates/school/js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="/templates/school/js/jquery.arcticmodal-0.2.min.js"></script>
		<script type="text/javascript" src="/templates/school/js/script.js"></script>
		<script type="text/javascript" src="/templates/school/js/validate.js"></script>
		<script type="text/javascript" src="/templates/school/js/javascript.js" ></script>
	</head>
	<body id="body">
		<div id="block">
			<div id="header">
				<div id="top">
					<? Loader::loadModule('login'); ?>
				</div>
			</div>
			<div id="horisontal-menu">
				<? Loader::loadModule('menu'); ?>
			</div>
			<div id="main">
				<div id="content">
					<? Loader::loadComponent(); ?>
				</div>
			</div>
		</div>
	</body>
</HTML>
