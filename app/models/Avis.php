<?php
// app/models/Avis.php

class Avis {
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
}
