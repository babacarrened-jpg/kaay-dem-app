<?php
// app/config/config.php

// Paramètres de l'application
define('APP_NAME', 'Kaay Dem !');
define('APP_VERSION', '1.0.0');

// URLs de base (à modifier selon l'environnement : ex 'http://localhost/kaay-dem-app/public')
// Par défaut, détection automatique simple
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$domain = $_SERVER['HTTP_HOST'];
$script = dirname($_SERVER['SCRIPT_NAME']);
define('BASE_URL', $protocol . "://" . $domain . $script . '/');

// Configuration de la Base de Données
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'kaay_dem');

// Dossiers chemins absolus
define('APP_ROOT', dirname(dirname(__FILE__)));
define('URL_ROOT', BASE_URL);
define('PUBLIC_ROOT', dirname(dirname(dirname(__FILE__))) . '/public');
