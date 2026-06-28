<?php
class Activite {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function loguer($type, $description, $user_id = null) {
        $this->db->query("
            INSERT INTO activites (type, description, user_id, created_at)
            VALUES (:type, :description, :user_id, NOW())
        ");
        $this->db->bind(':type', $type);
        $this->db->bind(':description', $description);
        $this->db->bind(':user_id', $user_id);
        return $this->db->execute();
    }

    public function getLast($limit = 100) {
        $this->db->query("
            SELECT a.*, u.prenom, u.nom
            FROM activites a
            LEFT JOIN utilisateurs u ON a.user_id = u.id
            ORDER BY a.created_at DESC
            LIMIT :limit
        ");
        $this->db->bind(':limit', (int)$limit);
        return $this->db->resultSet();
    }
}