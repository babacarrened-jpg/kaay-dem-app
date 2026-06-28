<?php
// app/models/Signalement.php

class Signalement {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Récupère tous les signalements avec infos auteur + concerné + trajet
     * Filtrage optionnel par statut et/ou motif
     */
    public function getAllForAdmin(?string $filtreStatut = null, ?string $filtreMotif = null): array {
        $sql = "SELECT
                    s.id,
                    s.motif,
                    s.description,
                    s.statut,
                    s.date_creation,
                    s.trajet_id,
                    auteur.id       AS auteur_id,
                    auteur.prenom   AS auteur_prenom,
                    auteur.nom      AS auteur_nom,
                    concerne.id     AS concerne_id,
                    concerne.prenom AS concerne_prenom,
                    concerne.nom    AS concerne_nom,
                    t.ville_depart,
                    t.ville_arrivee
                FROM signalements s
                JOIN utilisateurs auteur   ON auteur.id   = s.auteur_id
                JOIN utilisateurs concerne ON concerne.id = s.concerne_id
                LEFT JOIN trajets t        ON t.id        = s.trajet_id";

        $conditions = [];
        if ($filtreStatut !== null && $filtreStatut !== '') {
            $conditions[] = "s.statut = :statut";
        }
        if ($filtreMotif !== null && $filtreMotif !== '') {
            $conditions[] = "s.motif LIKE :motif";
        }

        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }

        $sql .= " ORDER BY s.date_creation DESC";

        $this->db->query($sql);

        if ($filtreStatut !== null && $filtreStatut !== '') {
            $this->db->bind(':statut', $filtreStatut);
        }
        if ($filtreMotif !== null && $filtreMotif !== '') {
            $this->db->bind(':motif', '%' . $filtreMotif . '%');
        }

        return $this->db->resultSet();
    }

    /**
     * Récupère un signalement par son ID avec toutes les infos
     */
    public function getById(int $id): ?object {
        $this->db->query("SELECT
                    s.*,
                    auteur.prenom   AS auteur_prenom,
                    auteur.nom      AS auteur_nom,
                    auteur.email    AS auteur_email,
                    concerne.prenom AS concerne_prenom,
                    concerne.nom    AS concerne_nom,
                    concerne.email  AS concerne_email,
                    t.ville_depart,
                    t.ville_arrivee,
                    t.date_trajet
                FROM signalements s
                JOIN utilisateurs auteur   ON auteur.id   = s.auteur_id
                JOIN utilisateurs concerne ON concerne.id = s.concerne_id
                LEFT JOIN trajets t        ON t.id        = s.trajet_id
                WHERE s.id = :id");
        $this->db->bind(':id', $id);
        $result = $this->db->single();
        return $result ?: null;
    }

    /**
     * Statistiques globales des signalements
     */
    public function getStatsGlobales(): object {
        $this->db->query("
            SELECT
                COUNT(*)                          AS total,
                SUM(statut = 'nouveau')           AS nb_nouveaux,
                SUM(statut = 'en_cours')          AS nb_en_cours,
                SUM(statut = 'traite')            AS nb_traites
            FROM signalements
        ");
        return $this->db->single() ?: (object)[
            'total'        => 0,
            'nb_nouveaux'  => 0,
            'nb_en_cours'  => 0,
            'nb_traites'   => 0,
        ];
    }

    /**
     * Met à jour le statut d'un signalement
     */
    public function updateStatut(int $id, string $statut): bool {
        $this->db->query('UPDATE signalements SET statut = :statut WHERE id = :id');
        $this->db->bind(':statut', $statut);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Supprime un signalement par son ID
     */
    public function deleteById(int $id): bool {
        $this->db->query('DELETE FROM signalements WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Compte le nombre total de signalements
     */
    public function countAll(): int {
        $this->db->query('SELECT COUNT(*) as total FROM signalements');
        $row = $this->db->single();
        return (int)($row->total ?? 0);
    }

    /**
     * Compte les signalements par statut
     */
    public function countByStatut(string $statut): int {
        $this->db->query('SELECT COUNT(*) as total FROM signalements WHERE statut = :statut');
        $this->db->bind(':statut', $statut);
        $row = $this->db->single();
        return (int)($row->total ?? 0);
    }
}