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
    public function search($depart, $arrivee, $date, $prix_min = null, $prix_max = null, $places_min = null, $places_max = null, $page = 1, $limit = 10) {
        // Requête de base pour récupérer les trajets planifiés avec places dispo
        $whereSql = "FROM trajets t
                JOIN utilisateurs u ON t.conducteur_id = u.id
                JOIN vehicules v ON t.vehicule_id = v.id
                WHERE t.statut = 'planifie' AND t.places_disponibles > 0";
        
        $params = [];

        if(!empty($depart)) {
            $whereSql .= " AND t.ville_depart LIKE :depart";
            $params[':depart'] = "%$depart%";
        }
        
        if(!empty($arrivee)) {
            $whereSql .= " AND t.ville_arrivee LIKE :arrivee";
            $params[':arrivee'] = "%$arrivee%";
        }

        if(!empty($date)) {
            $whereSql .= " AND t.date_trajet = :date";
            $params[':date'] = $date;
        }

        if(!empty($prix_min)) {
            $whereSql .= " AND t.prix_par_place >= :prix_min";
            $params[':prix_min'] = $prix_min;
        }

        if(!empty($prix_max)) {
            $whereSql .= " AND t.prix_par_place <= :prix_max";
            $params[':prix_max'] = $prix_max;
        }

        if(!empty($places_min)) {
            $whereSql .= " AND t.places_disponibles >= :places_min";
            $params[':places_min'] = $places_min;
        }

        if(!empty($places_max)) {
            $whereSql .= " AND t.places_disponibles <= :places_max";
            $params[':places_max'] = $places_max;
        }

        $page = max(1, (int)$page);
        $limit = max(1, min(50, (int)$limit));
        $offset = ($page - 1) * $limit;

        $countSql = "SELECT COUNT(*) as total " . $whereSql;
        $resultSql = "SELECT t.*, u.nom as conducteur_nom, u.prenom as conducteur_prenom, u.photo_profil, v.marque, v.modele " . $whereSql . " ORDER BY t.date_trajet ASC, t.heure_depart ASC LIMIT :limit OFFSET :offset";

        $this->db->query($countSql);
        foreach($params as $param => $value) {
            $this->db->bind($param, $value);
        }
        $totalRow = $this->db->single();
        $total = $totalRow ? (int)$totalRow->total : 0;

        $this->db->query($resultSql);
        foreach($params as $param => $value) {
            $this->db->bind($param, $value);
        }
        $this->db->bind(':limit', $limit);
        $this->db->bind(':offset', $offset);

        $trajets = $this->db->resultSet();

        return [
            'trajets' => $trajets,
            'pagination' => [
                'currentPage' => $page,
                'perPage' => $limit,
                'total' => $total,
                'totalPages' => (int)ceil($total / $limit)
            ]
        ];
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

    /**
     * Récupérer les trajets d'un conducteur
     */
    public function getByConducteur($conducteurId) {
        $this->db->query("SELECT t.*, u.nom as conducteur_nom, u.prenom as conducteur_prenom, v.marque, v.modele
                          FROM trajets t
                          JOIN utilisateurs u ON t.conducteur_id = u.id
                          JOIN vehicules v ON t.vehicule_id = v.id
                          WHERE t.conducteur_id = :conducteur_id
                          ORDER BY t.date_trajet ASC, t.heure_depart ASC");
        $this->db->bind(':conducteur_id', $conducteurId);

        return $this->db->resultSet();
    }

    /**
     * Récupérer tous les trajets pour l'admin
     */
    public function getAll(array $filters = []) {
        $sql = "SELECT t.*, u.nom as conducteur_nom, u.prenom as conducteur_prenom, u.telephone as conducteur_tel, v.marque, v.modele, v.couleur, v.immatriculation
                          FROM trajets t
                          JOIN utilisateurs u ON t.conducteur_id = u.id
                          JOIN vehicules v ON t.vehicule_id = v.id
                          WHERE 1=1";

        $params = [];

        if(!empty($filters['statut'])) {
            $sql .= " AND t.statut = :statut";
            $params[':statut'] = $filters['statut'];
        }

        if(!empty($filters['conducteur_id'])) {
            $sql .= " AND t.conducteur_id = :conducteur_id";
            $params[':conducteur_id'] = (int)$filters['conducteur_id'];
        }

        if(!empty($filters['ville_depart'])) {
            $sql .= " AND t.ville_depart LIKE :ville_depart";
            $params[':ville_depart'] = '%' . $filters['ville_depart'] . '%';
        }

        if(!empty($filters['ville_arrivee'])) {
            $sql .= " AND t.ville_arrivee LIKE :ville_arrivee";
            $params[':ville_arrivee'] = '%' . $filters['ville_arrivee'] . '%';
        }

        $sql .= " ORDER BY t.date_trajet ASC, t.heure_depart ASC";

        $this->db->query($sql);
        foreach($params as $param => $value) {
            $this->db->bind($param, $value);
        }

        return $this->db->resultSet();
    }
}
