<?php

$path = dirname(__FILE__);
$url = $_SERVER['REQUEST_URI'];
$user = User::GetUser();

require_once 'helper.php';
$helper = new helpHome();
$list = $helper->loadList();
$listFail = $helper->loadListFail();

require_once 'view/default.php';
?>