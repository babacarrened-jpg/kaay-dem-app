<?php
// app/models/Avis.php

require_once __DIR__ . '/../interfaces/EvaluableInterface.php';

class Avis implements EvaluableInterface {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function addRating(int $trajetId, int $auteurId, int $destinataireId, int $note, string $commentaire = ''): bool {
        $this->db->query('INSERT INTO avis (trajet_id, auteur_id, destinataire_id, note, commentaire) VALUES (:trajet_id, :auteur_id, :destinataire_id, :note, :commentaire)');
        $this->db->bind(':trajet_id', $trajetId);
        $this->db->bind(':auteur_id', $auteurId);
        $this->db->bind(':destinataire_id', $destinataireId);
        $this->db->bind(':note', $note);
        $this->db->bind(':commentaire', $commentaire);
        return $this->db->execute();
    }

    public function getAverageRating(int $destinataireId): float {
        $this->db->query('SELECT AVG(note) as moyenne FROM avis WHERE destinataire_id = :destinataire_id');
        $this->db->bind(':destinataire_id', $destinataireId);
        $row = $this->db->single();
        return (float)($row->moyenne ?? 0);
    }

    /**
     * Vérifie si un auteur a déjà noté un trajet précis
     * (empêche de noter deux fois le même trajet)
     */
    public function dejaNote(int $trajetId, int $auteurId): bool {
        $this->db->query('SELECT id FROM avis WHERE trajet_id = :trajet_id AND auteur_id = :auteur_id');
        $this->db->bind(':trajet_id', $trajetId);
        $this->db->bind(':auteur_id', $auteurId);
        return (bool)$this->db->single();
    }

    /**
     * Récupère tous les avis reçus par un destinataire (ex: profil conducteur)
     */
    public function getByDestinataire(int $destinataireId): array {
        $this->db->query("SELECT a.*, u.nom as auteur_nom, u.prenom as auteur_prenom
                          FROM avis a
                          JOIN utilisateurs u ON u.id = a.auteur_id
                          WHERE a.destinataire_id = :destinataire_id
                          ORDER BY a.date_creation DESC");
        $this->db->bind(':destinataire_id', $destinataireId);
        return $this->db->resultSet();
    }

    /**
     * Récupère tous les avis avec infos auteur + destinataire + trajet
     * Utilisé par l'admin uniquement.
     *
     * @param int|null $filtreNote  si non null, filtre sur cette note exacte
     */
    public function getAllForAdmin(?int $filtreNote = null): array {
        $sql = "SELECT
                    a.id,
                    a.note,
                    a.commentaire,
                    a.date_creation,
                    a.trajet_id,
                    auteur.id       AS auteur_id,
                    auteur.prenom   AS auteur_prenom,
                    auteur.nom      AS auteur_nom,
                    dest.id         AS destinataire_id,
                    dest.prenom     AS destinataire_prenom,
                    dest.nom        AS destinataire_nom,
                    t.ville_depart,
                    t.ville_arrivee
                FROM avis a
                JOIN utilisateurs auteur ON auteur.id = a.auteur_id
                JOIN utilisateurs dest   ON dest.id   = a.destinataire_id
                LEFT JOIN trajets t      ON t.id      = a.trajet_id";

        if ($filtreNote !== null) {
            $sql .= " WHERE a.note = :note";
        }

        $sql .= " ORDER BY a.date_creation DESC";

        $this->db->query($sql);

        if ($filtreNote !== null) {
            $this->db->bind(':note', $filtreNote);
        }

        return $this->db->resultSet();
    }

    /**
     * Statistiques globales des avis pour le bloc synthèse admin
     */
    public function getStatsGlobales(): object {
        $this->db->query("
            SELECT
                COUNT(*)           AS total,
                ROUND(AVG(note),1) AS note_moyenne,
                SUM(note = 5)      AS nb_5,
                SUM(note = 4)      AS nb_4,
                SUM(note = 3)      AS nb_3,
                SUM(note = 2)      AS nb_2,
                SUM(note = 1)      AS nb_1
            FROM avis
        ");
        return $this->db->single() ?: (object)[
            'total'        => 0,
            'note_moyenne' => 0,
            'nb_5'         => 0,
            'nb_4'         => 0,
            'nb_3'         => 0,
            'nb_2'         => 0,
            'nb_1'         => 0,
        ];
    }

    /**
     * Supprime un avis par son id
     */
    public function deleteById(int $id): bool {
        $this->db->query('DELETE FROM avis WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}