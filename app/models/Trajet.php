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
        $whereSql = "FROM trajets t
                JOIN utilisateurs u ON t.conducteur_id = u.id
                JOIN vehicules v ON t.vehicule_id = v.id
                WHERE t.statut = 'planifie' AND t.places_disponibles > 0";

        $params = [];

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

        $resultSql = "SELECT t.*, u.nom as conducteur_nom, u.prenom as conducteur_prenom, u.photo_profil, v.marque, v.modele " . $whereSql . " ORDER BY t.date_trajet ASC, t.heure_depart ASC";

        $this->db->query($resultSql);
        foreach($params as $param => $value) {
            $this->db->bind($param, $value);
        }

        $trajets = $this->db->resultSet();

        $normalizedDepart = $this->normalizeText($depart);
        $normalizedArrivee = $this->normalizeText($arrivee);

        $filteredTrajets = array_values(array_filter($trajets, function($trajet) use ($normalizedDepart, $normalizedArrivee) {
            if($normalizedDepart !== '' && !$this->matchesCity($trajet->ville_depart, $normalizedDepart)) {
                return false;
            }

            if($normalizedArrivee !== '' && !$this->matchesCity($trajet->ville_arrivee, $normalizedArrivee)) {
                return false;
            }

            return true;
        }));

        $total = count($filteredTrajets);
        $paginatedTrajets = array_slice($filteredTrajets, $offset, $limit);

        return [
            'trajets' => $paginatedTrajets,
            'pagination' => [
                'currentPage' => $page,
                'perPage' => $limit,
                'total' => $total,
                'totalPages' => (int)ceil($total / $limit)
            ]
        ];
    }

    private function normalizeText($value) {
        if($value === null) {
            return '';
        }

        $value = mb_strtolower((string)$value, 'UTF-8');
        $value = str_replace(['-', '_', ' '], '', $value);
        $value = iconv('UTF-8', 'ASCII//TRANSLIT', $value) ?: $value;
        $value = preg_replace('/[^a-z0-9]/', '', $value);

        return $value;
    }

    private function matchesCity($storedValue, $searchValue) {
        if($storedValue === null || $searchValue === '') {
            return true;
        }

        return strpos($this->normalizeText($storedValue), $searchValue) !== false;
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
     * Créer un nouveau trajet publié par un conducteur
     */
    public function create(array $data): bool {
        $this->db->query("INSERT INTO trajets
            (conducteur_id, vehicule_id, ville_depart, point_depart, ville_arrivee, point_arrivee,
             date_trajet, heure_depart, prix_par_place, places_disponibles, places_totales, description, statut)
            VALUES
            (:conducteur_id, :vehicule_id, :ville_depart, :point_depart, :ville_arrivee, :point_arrivee,
             :date_trajet, :heure_depart, :prix_par_place, :places_disponibles, :places_totales, :description, 'planifie')");

        $this->db->bind(':conducteur_id', $data['conducteur_id']);
        $this->db->bind(':vehicule_id', $data['vehicule_id']);
        $this->db->bind(':ville_depart', $data['ville_depart']);
        $this->db->bind(':point_depart', $data['point_depart'] ?: null);
        $this->db->bind(':ville_arrivee', $data['ville_arrivee']);
        $this->db->bind(':point_arrivee', $data['point_arrivee'] ?: null);
        $this->db->bind(':date_trajet', $data['date_trajet']);
        $this->db->bind(':heure_depart', $data['heure_depart']);
        $this->db->bind(':prix_par_place', $data['prix_par_place']);
        $this->db->bind(':places_disponibles', $data['places_totales']);
        $this->db->bind(':places_totales', $data['places_totales']);
        $this->db->bind(':description', $data['description'] ?: null);

        return $this->db->execute();
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