<?php

class Router {
    private array $routes = [];

    public function get($uri, $action) {
        $this->routes['GET'][$uri] = $action;
    }

    public function dispatch($uri) {
        $uriPath = parse_url($uri, PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$method][$uriPath])) {
            [$controller, $methodName] = explode('@', $this->routes[$method][$uriPath]);
            require_once "../app/Controllers/$controller.php";
            $controller = new $controller();
            $controller->$methodName();
            return;
        }

        foreach ($this->routes[$method] as $route => $action) {
            $pattern = preg_replace('#\{[a-zA-Z_]+\}#', '([0-9]+)', $route);
            $pattern = "#^$pattern$#";

            if (preg_match($pattern, $uriPath, $matches)) {
                array_shift($matches); 
                [$controller, $methodName] = explode('@', $action);
                require_once "../app/Controllers/$controller.php";
                $controller = new $controller();
                $controller->$methodName(...$matches);
                return;
            }
        }

        http_response_code(404);
        echo "404";
    }
}