<?php

abstract class URL {
    

    protected function getControllerAndAction() {
        $url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $routes = explode('/', trim($url_path, ' /'));
        $params = array();
        $controller_name = array_shift($routes);
        $action_name = array_shift($routes);
        if (empty($controller_name)) {
            $controller_name = 'index';
        }
        if (empty($action_name)) {
            $action_name = 'index';
        }
        // добавляем префиксы
        $controller_name = $controller_name . '_Controller';
        $action_name = 'action_' . $action_name;
        for ($i = 0; $i < count($routes); $i++) {
            $params[] = $routes[+$i];
        }     
        return array($controller_name, $action_name);
    }
    
    function ErrorPage404() {
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        echo'404';
    }

}
