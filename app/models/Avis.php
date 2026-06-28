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
}