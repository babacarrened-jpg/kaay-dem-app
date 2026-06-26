<?php
// app/core/Database.php

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    
    private $dbh; // Database Handler
    private $stmt;
    private $error;

    public function __construct() {
        // DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';charset=utf8mb4';
        
        $options = array(
            PDO::ATTR_PERSISTENT => true, // Connexion persistante
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Mode d'erreur (Exceptions)
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ // Récupérer sous forme d'objets
        );

        // Instanciation de PDO
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            echo "Erreur de connexion : " . $this->error;
            exit;
        }
    }

    // Préparer une requête avec statement
    public function query($sql) {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Lier les valeurs aux paramètres (bind)
    public function bind($param, $value, $type = null) {
        if(is_null($type)) {
            switch(true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Exécuter la requête
    public function execute() {
        return $this->stmt->execute();
    }

    // Récupérer un ensemble de résultats sous forme de tableau d'objets
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll();
    }

    // Récupérer un seul enregistrement sous forme d'objet
    public function single() {
        $this->execute();
        return $this->stmt->fetch();
    }

    // Récupérer le nombre de lignes affectées
    public function rowCount() {
        return $this->stmt->rowCount();
    }
    
    // Obtenir le dernier ID inséré
    public function lastInsertId() {
        return $this->dbh->lastInsertId();
    }
}
