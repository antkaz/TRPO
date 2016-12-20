<?php
//header('Content-Type: text/html; charset=utf-8');

require_once 'includes.php';

$db = DataBase::getDB();
$session = Session::getSession();

Loader::loadTemplate('shutterpress');

$db->close();
?>