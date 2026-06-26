<?php
// app/core/Router.php

class Router {
    protected $routes = [];

    /**
     * Ajoute une route au routeur
     */
    public function add($method, $uri, $controller, $action) {
        // Nettoyer les slashes et préparer la regex pour les paramètres dynamiques
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

    /**
     * Raccourcis pour les méthodes HTTP
     */
    public function get($uri, $controller, $action) {
        $this->add('GET', $uri, $controller, $action);
    }

    public function post($uri, $controller, $action) {
        $this->add('POST', $uri, $controller, $action);
    }

    /**
     * Démarre le routage en analysant l'URL actuelle
     */
    public function dispatch($uri, $method) {
        // Nettoyer l'URI (supprimer les query strings)
        $uri = parse_url($uri, PHP_URL_PATH);
        
        // Retirer le dossier de base pour la compatibilité Windows/XAMPP
        $scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        if ($scriptName !== '/' && strpos($uri, $scriptName) === 0) {
            $uri = substr($uri, strlen($scriptName));
        }
        $uri = empty($uri) ? '/' : $uri;

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && preg_match($route['pattern'], $uri, $matches)) {
                
                // Instancier le contrôleur
                $controllerClass = $route['controller'];
                $action = $route['action'];
                
                require_once "../app/controllers/{$controllerClass}.php";
                $controller = new $controllerClass();
                
                // Extraire les paramètres nommés de l'URL
                $params = [];
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $params[$key] = $value;
                    }
                }
                
                // Appeler l'action avec les paramètres
                call_user_func_array([$controller, $action], $params);
                return;
            }
        }
        
        // Route non trouvée
        $this->abort(404);
    }

    /**
     * Gère les erreurs (404, 403, 500)
     */
    protected function abort($code = 404) {
        http_response_code($code);
        require_once "../app/views/errors/{$code}.php";
        exit;
    }
}
