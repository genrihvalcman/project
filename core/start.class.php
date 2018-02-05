<?php

class Start  {

      function run() {
        $requestedPath = $_SERVER['REQUEST_URI'];
        $router = Route::getInstance();
        $request = Request::getInstance();
        if(empty($_COOKIE['siteLang'])){setcookie ("siteLang", SITE_LANG);}
        if($request->lang){$_COOKIE['siteLang'] = $request->lang;}
        $router->setRoute($requestedPath);
        list($controllerName, $actionName) = $router->getControllerRequested();
        if(empty($controllerName)){$controllerName = 'Error404';}
        if(empty($actionName)){$actionName = 'index';}
        $controllerName = $controllerName . '_Controller';
        $actionName = 'action_' . $actionName;
            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                
            }
            if (method_exists($controller, $actionName)) {
                $controller->$actionName();
                $controller->getView()->display();
            } 
    }

}
