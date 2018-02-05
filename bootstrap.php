<?php
if (session_id() == '') {session_start();}
include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
mb_internal_encoding("UTF-8");
//error_reporting(E_ALL);
ini_set("display_errors", 1);

set_include_path(get_include_path() . PATH_SEPARATOR . DIR_CORE .  PATH_SEPARATOR . DIR_CONTROLLERS . PATH_SEPARATOR . DIR_MODELS . PATH_SEPARATOR .DIR_APPLICATION);
spl_autoload_extensions(".class.php");
spl_autoload_register();

$start = new Start();
$start->run();

