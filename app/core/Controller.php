<?php
// app/core/Controller.php

abstract class Controller {
    
    /**
     * Permet de charger un modèle
     */
    public function model($modelName) {
        require_once "../app/models/" . $modelName . ".php";
        return new $modelName();
    }

    /**
     * Permet d'afficher une vue avec des données
     */
    public function view($viewName, $data = []) {
        // Extraire les données pour les rendre accessibles comme variables dans la vue
        extract($data);
        
        // Charger la vue principale
        $viewFile = "../app/views/" . $viewName . ".php";
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("La vue " . $viewName . " n'existe pas.");
        }
    }

    /**
     * Rendu avec le layout principal
     */
    public function render($viewName, $data = [], $layout = 'base') {
        extract($data);
        
        // On met le contenu de la vue dans un tampon
        ob_start();
        $viewFile = "../app/views/" . $viewName . ".php";
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("La vue " . $viewName . " n'existe pas.");
        }
        $content = ob_get_clean();
        
        // On charge le layout qui va injecter la variable $content
        require_once "../app/views/layouts/" . $layout . ".php";
    }

    /**
     * Redirection HTTP
     */
    public function redirect($url) {
        // Remplacer BASE_URL par la constante de config
        header("Location: " . BASE_URL . $url);
        exit;
    }

    /**
     * Récupérer les données POST sécurisées
     */
    public function getPostData() {
        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = htmlspecialchars(strip_tags(trim($value)));
        }
        return $data;
    }
}
