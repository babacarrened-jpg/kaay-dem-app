<?php
// app/models/Trajet.php

class Trajet {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Rechercher des trajets selon des critères
     */
    public function search($depart, $arrivee, $date) {
        // Requête de base pour récupérer les trajets planifiés avec places dispo
        $sql = "SELECT t.*, u.nom as conducteur_nom, u.prenom as conducteur_prenom, u.photo_profil, v.marque, v.modele 
                FROM trajets t
                JOIN utilisateurs u ON t.conducteur_id = u.id
                JOIN vehicules v ON t.vehicule_id = v.id
                WHERE t.statut = 'planifie' AND t.places_disponibles > 0";
        
        $params = [];

        // Filtres dynamiques
        if(!empty($depart)) {
            $sql .= " AND t.ville_depart LIKE :depart";
            $params[':depart'] = "%$depart%";
        }
        
        if(!empty($arrivee)) {
            $sql .= " AND t.ville_arrivee LIKE :arrivee";
            $params[':arrivee'] = "%$arrivee%";
        }

        if(!empty($date)) {
            $sql .= " AND t.date_trajet = :date";
            $params[':date'] = $date;
        }

        $sql .= " ORDER BY t.date_trajet ASC, t.heure_depart ASC";

        $this->db->query($sql);

        // Lier les paramètres
        foreach($params as $param => $value) {
            $this->db->bind($param, $value);
        }

        return $this->db->resultSet();
    }

    /**
     * Obtenir les détails d'un trajet par ID
     */
    public function getById($id) {
        $this->db->query("SELECT t.*, u.nom as conducteur_nom, u.prenom as conducteur_prenom, u.telephone as conducteur_tel, u.photo_profil, v.marque, v.modele, v.couleur, v.immatriculation
                          FROM trajets t
                          JOIN utilisateurs u ON t.conducteur_id = u.id
                          JOIN vehicules v ON t.vehicule_id = v.id
                          WHERE t.id = :id");
        $this->db->bind(':id', $id);

        return $this->db->single();
    }
}
