<?php
// app/models/Notification.php

class Notification {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Créer une notification pour un utilisateur
     */
    public function create(int $userId, string $title, string $message, string $type = 'info', string $link = null): bool {
        $this->db->query('INSERT INTO notifications (utilisateur_id, titre, message, type, lien) VALUES (:user_id, :titre, :message, :type, :lien)');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':titre', $title);
        $this->db->bind(':message', $message);
        $this->db->bind(':type', $type);
        $this->db->bind(':lien', $link);
        return $this->db->execute();
    }
}
