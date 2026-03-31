<?php

class Router {
    private array $routes = [];

    public function get($uri, $action) {
        $this->routes['GET'][$uri] = $action;
    }

    public function dispatch($uri) {
        $uri = parse_url($uri, PHP_URL_PATH);

        $method = $_SERVER['REQUEST_METHOD'];

        if (!isset($this->routes[$method][$uri])) {
            http_response_code(404);
            echo "404";
            return;
        }

        [$controller, $methodName] = explode('@', $this->routes[$method][$uri]);

        require_once "../app/Controllers/$controller.php";

        $controller = new $controller();
        $controller->$methodName();
    }
}
