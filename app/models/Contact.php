<?php
// app/models/Contact.php
opcache_reset();

class Contact {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Enregistre un message de contact en base
     */
    public function sauvegarder(string $nom, string $email, string $message): bool {
        $this->db->query('INSERT INTO messages_contact (nom, email, message) VALUES (:nom, :email, :message)');
        $this->db->bind(':nom',     $nom);
        $this->db->bind(':email',   $email);
        $this->db->bind(':message', $message);
        return $this->db->execute();
    }

    /**
     * Récupère tous les messages (du plus récent au plus ancien)
     */
    public function getTous(): array {
        $this->db->query('SELECT * FROM messages_contact ORDER BY date_envoi DESC');
        return $this->db->resultSet();
    }

    /**
     * Récupère uniquement les messages non lus
     */
    public function getNonLus(): array {
        $this->db->query('SELECT * FROM messages_contact WHERE lu = FALSE ORDER BY date_envoi DESC');
        return $this->db->resultSet();
    }

    /**
     * Compte les messages non lus (pour badge dans le dashboard)
     */
    public function compterNonLus(): int {
        $this->db->query('SELECT COUNT(*) AS total FROM messages_contact WHERE lu = FALSE');
        $result = $this->db->single();
        return (int) ($result->total ?? 0);
    }

    /**
     * Récupère les N derniers messages (pour le flux d'activité)
     */
    public function getDerniers(int $limit = 5): array {
        $this->db->query('SELECT * FROM messages_contact ORDER BY date_envoi DESC LIMIT :limit');
        $this->db->bind(':limit', $limit);
        return $this->db->resultSet();
    }

    /**
     * Marque un message comme lu
     */
    public function marquerLu(int $id): bool {
        $this->db->query('UPDATE messages_contact SET lu = TRUE WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}