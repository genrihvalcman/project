<?php

if (session_id() == '') {
    session_start();
}
include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
mb_internal_encoding("UTF-8");
//error_reporting(E_ALL);
ini_set("display_errors", 1);

set_include_path(get_include_path() . PATH_SEPARATOR . DIR_CORE . PATH_SEPARATOR . CNTRL_DIR . PATH_SEPARATOR . CNTRL_DIR_CONTROLLERS . PATH_SEPARATOR . CNTRL_DIR_TPL . PATH_SEPARATOR . DIR_APPLICATION);
spl_autoload_extensions(".class.php");
spl_autoload_register();


$uri = $_SERVER["REQUEST_URI"];
if (($pos = strpos($uri, "?")) !== false) {
    $uri = substr($uri, 0, strpos($uri, "?"));
}

$routes = explode("/", $uri);


if (empty($routes[2])) {
    $routes[2] = 'main';
}
if (empty($routes[3])) {
    $routes[3] = 'index';
}


$controller_name = $routes[2] . "_control";
$action_name = "action_" . $routes[3];

try {
    if (class_exists($controller_name)) {
        $controller = new $controller_name();
    }
    if (method_exists($controller, $action_name)) {
        $controller->$action_name();
        $controller->getView()->display();
        
    } else {
        throw new Exception();
    }
} catch (Exception $e) {
    $controller = new error404_control;
    $controller->action_index();
    $controller->getView()->display();
}

