<?php

require_once "app/appheader.php";

class Router {
    private $routes = [];

    public function get($uri, $action) {
        $this->routes['GET'][$uri] = $action;
    }

    public function post($uri, $action) {
        $this->routes['POST'][$uri] = $action;
    }

    public function dispatch($uri, $method) {
        $uri = trim(parse_url($uri, PHP_URL_PATH), '/');

        if (!isset($this->routes[$method][$uri])) {
            http_response_code(404);
            $uri='404';
        }

        $action = $this->routes[$method][$uri];

        list($controllerName, $methodName) = explode('@', $action);
        
        require_once __DIR__ . "/../app/$controllerName.php";

        $controller = new $controllerName(); // is a controller class
        $controller->checkRememberMe();
        $controller->$methodName();
    }
}

?>
