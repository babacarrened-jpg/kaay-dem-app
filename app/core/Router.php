<?php
// app/core/Router.php

class Router {
    protected $routes = [];

    public function add($method, $uri, $controller, $action) {
        $uriPattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<\1>[a-zA-Z0-9_-]+)', $uri);
        $uriPattern = '#^' . $uriPattern . '$#';
        
        $this->routes[] = [
            'method' => strtoupper($method),
            'uri' => $uri,
            'pattern' => $uriPattern,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function get($uri, $controller, $action) {
        $this->add('GET', $uri, $controller, $action);
    }

    public function post($uri, $controller, $action) {
        $this->add('POST', $uri, $controller, $action);
    }

    public function dispatch($uri, $method) {
        if (!empty($_GET['url'])) {
            $uri = '/' . trim($_GET['url'], '/');
        } else {
            $uri = parse_url($uri, PHP_URL_PATH);
        }
        
        $scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        if ($scriptName !== '/' && strpos($uri, $scriptName) === 0) {
            $uri = substr($uri, strlen($scriptName));
        }

        $uri = '/' . trim($uri, '/');
        $uri = $uri === '/' ? '/' : $uri;

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($route['pattern'], $uri, $matches)) {
                
                $controllerClass = $route['controller'];
                $action = $route['action'];
                
                if (!class_exists($controllerClass)) {
                    require "../app/controllers/{$controllerClass}.php";
                }
                $controller = new $controllerClass();
                
                $params = [];
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $params[$key] = $value;
                    }
                }
                
                call_user_func_array([$controller, $action], $params);
                return;
            }
        }
        
        $this->abort(404);
    }

    protected function abort($code = 404) {
        http_response_code($code);
        $viewFile = "../app/views/errors/{$code}.php";
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            echo "<h1>{$code}</h1><p>La page demandée est introuvable.</p>";
        }
        exit;
    }
}