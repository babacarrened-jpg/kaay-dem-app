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

        $page  = max(1, (int)$page);
        $limit = max(1, min(50, (int)$limit));
        $offset = ($page - 1) * $limit;

        $resultSql = "SELECT t.*, u.nom as conducteur_nom, u.prenom as conducteur_prenom, u.photo_profil, v.marque, v.modele " . $whereSql . " ORDER BY t.date_trajet ASC, t.heure_depart ASC";

        $this->db->query($resultSql);
        foreach($params as $param => $value) {
            $this->db->bind($param, $value);
        }

        $trajets = $this->db->resultSet();

        $normalizedDepart  = $this->normalizeText($depart);
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

        $total           = count($filteredTrajets);
        $paginatedTrajets = array_slice($filteredTrajets, $offset, $limit);

        return [
            'trajets'     => $paginatedTrajets,
            'pagination'  => [
                'currentPage' => $page,
                'perPage'     => $limit,
                'total'       => $total,
                'totalPages'  => (int)ceil($total / $limit)
            ]
        ];
    }

    private function normalizeText($value) {
        if($value === null) return '';
        $value = mb_strtolower((string)$value, 'UTF-8');
        $value = str_replace(['-', '_', ' '], '', $value);
        $value = iconv('UTF-8', 'ASCII//TRANSLIT', $value) ?: $value;
        $value = preg_replace('/[^a-z0-9]/', '', $value);
        return $value;
    }

    private function matchesCity($storedValue, $searchValue) {
        if($storedValue === null || $searchValue === '') return true;
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
     * Créer un nouveau trajet
     */
    public function create(array $data): bool {
        $this->db->query("INSERT INTO trajets
            (conducteur_id, vehicule_id, ville_depart, point_depart, ville_arrivee, point_arrivee,
             date_trajet, heure_depart, prix_par_place, places_disponibles, places_totales, description,
             climatisation, musique, fumeur, statut)
            VALUES
            (:conducteur_id, :vehicule_id, :ville_depart, :point_depart, :ville_arrivee, :point_arrivee,
             :date_trajet, :heure_depart, :prix_par_place, :places_disponibles, :places_totales, :description,
             :climatisation, :musique, :fumeur, 'planifie')");

        $this->db->bind(':conducteur_id',     $data['conducteur_id']);
        $this->db->bind(':vehicule_id',        $data['vehicule_id']);
        $this->db->bind(':ville_depart',       $data['ville_depart']);
        $this->db->bind(':point_depart',       $data['point_depart'] ?: null);
        $this->db->bind(':ville_arrivee',      $data['ville_arrivee']);
        $this->db->bind(':point_arrivee',      $data['point_arrivee'] ?: null);
        $this->db->bind(':date_trajet',        $data['date_trajet']);
        $this->db->bind(':heure_depart',       $data['heure_depart']);
        $this->db->bind(':prix_par_place',     $data['prix_par_place']);
        $this->db->bind(':places_disponibles', $data['places_totales']);
        $this->db->bind(':places_totales',     $data['places_totales']);
        $this->db->bind(':description',        $data['description'] ?: null);
        $this->db->bind(':climatisation',      !empty($data['climatisation']) ? 1 : 0);
        $this->db->bind(':musique',            !empty($data['musique']) ? 1 : 0);
        $this->db->bind(':fumeur',             !empty($data['fumeur']) ? 1 : 0);

        return $this->db->execute();
    }

    /**
     * Annuler un trajet
     */
    public function annuler(int $trajetId, int $conducteurId): bool {
        $this->db->query("SELECT t.statut,
                          (SELECT COUNT(*) FROM reservations r WHERE r.trajet_id = t.id AND r.statut = 'confirmee') as nb_confirmees
                          FROM trajets t WHERE t.id = :id AND t.conducteur_id = :conducteur_id");
        $this->db->bind(':id', $trajetId);
        $this->db->bind(':conducteur_id', $conducteurId);
        $trajet = $this->db->single();

        if (!$trajet || (int)$trajet->nb_confirmees > 0) return false;

        $this->db->query("UPDATE trajets SET statut = 'annule' WHERE id = :id AND conducteur_id = :conducteur_id");
        $this->db->bind(':id', $trajetId);
        $this->db->bind(':conducteur_id', $conducteurId);
        return $this->db->execute();
    }

    /**
     * Récupérer tous les trajets (admin)
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

    /**
     * Nombre de trajets créés par mois (12 derniers mois)
     */
    public function getTrajetsByMonth(): array {
        $this->db->query(
            "SELECT
                DATE_FORMAT(date_creation, '%Y-%m') AS mois,
                DATE_FORMAT(date_creation, '%b %Y')  AS mois_label,
                COUNT(*) AS total
             FROM trajets
             WHERE date_creation >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
             GROUP BY mois, mois_label
             ORDER BY mois ASC"
        );
        return $this->db->resultSet();
    }

    /**
     * Taux d'occupation moyen par mois
     */
    public function getTauxOccupationByMonth(): array {
        $this->db->query(
            "SELECT
                DATE_FORMAT(t.date_creation, '%Y-%m') AS mois,
                DATE_FORMAT(t.date_creation, '%b %Y')  AS mois_label,
                ROUND(
                    SUM(t.places_totales - t.places_disponibles) /
                    NULLIF(SUM(t.places_totales), 0) * 100
                , 1) AS taux_occupation
             FROM trajets t
             WHERE t.date_creation >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
               AND t.statut IN ('termine','en_cours','planifie')
             GROUP BY mois, mois_label
             ORDER BY mois ASC"
        );
        return $this->db->resultSet();
    }

    /**
     * Top conducteurs
     */
    public function getTopConducteurs(int $limit = 5): array {
        $this->db->query(
            "SELECT
                u.id,
                CONCAT(u.prenom, ' ', u.nom) AS conducteur,
                u.photo_profil,
                COUNT(t.id)                  AS nb_trajets,
                SUM(CASE WHEN t.statut = 'termine' THEN 1 ELSE 0 END) AS trajets_termines,
                ROUND(AVG(a.note), 1)        AS note_moyenne,
                SUM(t.places_totales - t.places_disponibles) AS passagers_transportes
             FROM utilisateurs u
             JOIN trajets t ON t.conducteur_id = u.id
             LEFT JOIN avis a ON a.destinataire_id = u.id
             WHERE u.role = 'conducteur'
             GROUP BY u.id, conducteur, u.photo_profil
             ORDER BY nb_trajets DESC, note_moyenne DESC
             LIMIT :limit"
        );
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    /**
     * Nombre total de trajets
     */
    public function countAll(): int {
        $this->db->query("SELECT COUNT(*) as total FROM trajets");
        $row = $this->db->single();
        return $row ? (int)$row->total : 0;
    }

    /**
     * Statistiques globales pour le dashboard admin
     */
    public function getStatsGlobales(): object {
        $this->db->query(
            "SELECT
                COUNT(*) AS total_trajets,
                SUM(CASE WHEN statut = 'termine'  THEN 1 ELSE 0 END) AS trajets_termines,
                SUM(CASE WHEN statut = 'annule'   THEN 1 ELSE 0 END) AS trajets_annules,
                SUM(CASE WHEN statut = 'planifie' THEN 1 ELSE 0 END) AS trajets_planifies,
                SUM(CASE WHEN statut = 'en_cours' THEN 1 ELSE 0 END) AS trajets_en_cours,
                SUM(places_totales)                                    AS total_places,
                SUM(places_totales - places_disponibles)               AS places_vendues,
                ROUND(SUM(places_totales - places_disponibles) /
                      NULLIF(SUM(places_totales),0) * 100, 1)         AS taux_occupation_global,
                ROUND(SUM((places_totales - places_disponibles) * prix_par_place), 0) AS revenu_total,
                ROUND(AVG((places_totales - places_disponibles) * prix_par_place), 0) AS revenu_moyen_par_trajet,
                ROUND(MAX((places_totales - places_disponibles) * prix_par_place), 0) AS revenu_max_trajet,
                ROUND(AVG(prix_par_place), 0) AS prix_moyen_place
             FROM trajets"
        );
        $global = $this->db->single();

        $this->db->query(
            "SELECT DATE_FORMAT(date_creation, '%b %Y') AS mois_label, COUNT(*) AS total
             FROM trajets
             GROUP BY DATE_FORMAT(date_creation, '%Y-%m'), mois_label
             ORDER BY total DESC LIMIT 1"
        );
        $global->mois_max = $this->db->single();

        $this->db->query(
            "SELECT DATE_FORMAT(date_creation, '%b %Y') AS mois_label, COUNT(*) AS total
             FROM trajets
             GROUP BY DATE_FORMAT(date_creation, '%Y-%m'), mois_label
             ORDER BY total ASC LIMIT 1"
        );
        $global->mois_min = $this->db->single();

        $this->db->query(
            "SELECT ROUND(COUNT(*) / NULLIF(COUNT(DISTINCT DATE_FORMAT(date_creation,'%Y-%m')),0), 1) AS moyenne_mensuelle
             FROM trajets"
        );
        $avg = $this->db->single();
        $global->moyenne_mensuelle = $avg ? $avg->moyenne_mensuelle : 0;

        $this->db->query(
            "SELECT
                DATE_FORMAT(date_creation, '%Y-%m') AS mois,
                DATE_FORMAT(date_creation, '%b %Y')  AS mois_label,
                ROUND(SUM((places_totales - places_disponibles) * prix_par_place), 0) AS revenu
             FROM trajets
             WHERE date_creation >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
             GROUP BY mois, mois_label
             ORDER BY mois ASC"
        );
        $global->revenu_by_month = $this->db->resultSet();

        return $global;
    }
}