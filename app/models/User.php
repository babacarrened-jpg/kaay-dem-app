<?php
// app/models/User.php

require_once __DIR__ . '/../interfaces/RepositoryInterface.php';

class User implements RepositoryInterface {
    
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function register($data) {
        $this->db->query('INSERT INTO utilisateurs (nom, prenom, email, telephone, mot_de_passe) VALUES (:nom, :prenom, :email, :telephone, :mot_de_passe)');
        $this->db->bind(':nom', $data['nom']);
        $this->db->bind(':prenom', $data['prenom']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telephone', $data['telephone']);
        $this->db->bind(':mot_de_passe', $data['mot_de_passe']);
        return $this->db->execute();
    }

    public function login($email, $password) {
        $this->db->query('SELECT * FROM utilisateurs WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();
        if($row && password_verify($password, $row->mot_de_passe)) {
            return $row;
        }
        return false;
    }

    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM utilisateurs WHERE email = :email');
        $this->db->bind(':email', $email);
        $this->db->single();
        return $this->db->rowCount() > 0;
    }

    public function getUserById($id) {
        $this->db->query('SELECT * FROM utilisateurs WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getPendingConducteurRequests(): array {
        $this->db->query('SELECT d.id, d.utilisateur_id, d.statut, d.date_demande, d.permis_recto, d.permis_verso, u.nom as utilisateur_nom, u.prenom as utilisateur_prenom FROM demandes_conducteur d JOIN utilisateurs u ON d.utilisateur_id = u.id WHERE d.statut = :statut ORDER BY d.date_demande DESC');
        $this->db->bind(':statut', 'en_attente');
        return $this->db->resultSet();
    }

    public function validateConducteur(int $userId, int $adminId = 0): bool {
        $this->db->query('UPDATE utilisateurs SET est_conducteur_valide = 1, role = :role WHERE id = :id');
        $this->db->bind(':role', 'conducteur');
        $this->db->bind(':id', $userId);
        $updated = $this->db->execute();

        if ($updated) {
            $this->db->query('SELECT id FROM demandes_conducteur WHERE utilisateur_id = :user_id ORDER BY id DESC LIMIT 1');
            $this->db->bind(':user_id', $userId);
            $row = $this->db->single();

            if ($row) {
                $this->db->query('UPDATE demandes_conducteur SET statut = :statut, admin_id = :admin_id, date_traitement = NOW() WHERE id = :id');
                $this->db->bind(':statut', 'validee');
                $this->db->bind(':admin_id', $adminId);
                $this->db->bind(':id', $row->id);
                $this->db->execute();
            } else {
                $this->db->query('INSERT INTO demandes_conducteur (utilisateur_id, statut, admin_id, date_traitement) VALUES (:user_id, :statut, :admin_id, NOW())');
                $this->db->bind(':user_id', $userId);
                $this->db->bind(':statut', 'validee');
                $this->db->bind(':admin_id', $adminId);
                $this->db->execute();
            }
        }

        return $updated;
    }

    public function refuseConducteur(int $userId, int $adminId = 0): bool {
        $this->db->query('UPDATE utilisateurs SET est_conducteur_valide = 0 WHERE id = :id');
        $this->db->bind(':id', $userId);
        $updated = $this->db->execute();

        if ($updated) {
            $this->db->query('SELECT id FROM demandes_conducteur WHERE utilisateur_id = :user_id ORDER BY id DESC LIMIT 1');
            $this->db->bind(':user_id', $userId);
            $row = $this->db->single();

            if ($row) {
                $this->db->query('UPDATE demandes_conducteur SET statut = :statut, admin_id = :admin_id, date_traitement = NOW() WHERE id = :id');
                $this->db->bind(':statut', 'rejetee');
                $this->db->bind(':admin_id', $adminId);
                $this->db->bind(':id', $row->id);
                $this->db->execute();
            } else {
                $this->db->query('INSERT INTO demandes_conducteur (utilisateur_id, statut, admin_id, date_traitement) VALUES (:user_id, :statut, :admin_id, NOW())');
                $this->db->bind(':user_id', $userId);
                $this->db->bind(':statut', 'rejetee');
                $this->db->bind(':admin_id', $adminId);
                $this->db->execute();
            }
        }

        return $updated;
    }

    public function findById(int $id) {
        return $this->getUserById($id);
    }

    public function findAll(): array {
        $this->db->query('SELECT * FROM utilisateurs ORDER BY id DESC');
        return $this->db->resultSet();
    }

    public function getConducteurs(): array {
        $this->db->query("SELECT id, nom, prenom FROM utilisateurs WHERE role = 'conducteur' ORDER BY nom ASC, prenom ASC");
        return $this->db->resultSet();
    }

    public function save(array $data): bool {
        if (!empty($data['id'])) {
            $this->db->query('UPDATE utilisateurs SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone WHERE id = :id');
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':nom', $data['nom']);
            $this->db->bind(':prenom', $data['prenom']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':telephone', $data['telephone']);
            return $this->db->execute();
        }

        $this->db->query('INSERT INTO utilisateurs (nom, prenom, email, telephone, mot_de_passe) VALUES (:nom, :prenom, :email, :telephone, :mot_de_passe)');
        $this->db->bind(':nom', $data['nom']);
        $this->db->bind(':prenom', $data['prenom']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telephone', $data['telephone']);
        $this->db->bind(':mot_de_passe', $data['mot_de_passe']);
        return $this->db->execute();
    }

    public function delete(int $id): bool {
        $this->db->query('DELETE FROM utilisateurs WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function demanderConducteur(int $userId, string $permisRecto, string $permisVerso): bool {
        $this->db->query('SELECT id FROM demandes_conducteur WHERE utilisateur_id = :user_id AND statut = "en_attente"');
        $this->db->bind(':user_id', $userId);
        $this->db->single();
        if($this->db->rowCount() > 0) return false;

        $this->db->query('INSERT INTO demandes_conducteur (utilisateur_id, permis_recto, permis_verso, statut, date_demande) VALUES (:user_id, :recto, :verso, "en_attente", NOW())');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':recto', $permisRecto);
        $this->db->bind(':verso', $permisVerso);
        return $this->db->execute();
    }

    /**
     * Récupère la dernière demande "devenir conducteur" d'un utilisateur
     * (en_attente / validee / rejetee), ou null s'il n'en a jamais fait.
     */
    public function getDemandeConducteur(int $userId) {
        $this->db->query('SELECT * FROM demandes_conducteur WHERE utilisateur_id = :user_id ORDER BY id DESC LIMIT 1');
        $this->db->bind(':user_id', $userId);
        return $this->db->single();
    }

    public function countByRole(string $role): int {
        $this->db->query("SELECT COUNT(*) as total FROM utilisateurs WHERE role = :role");
        $this->db->bind(':role', $role);
        $row = $this->db->single();
        return $row ? (int)$row->total : 0;
    }
        /**
     * Recherche d'utilisateurs
     */
    public function search(string $term): array {
        $term = '%' . $term . '%';
        $this->db->query('SELECT * FROM utilisateurs 
                          WHERE nom LIKE :term 
                             OR prenom LIKE :term 
                             OR email LIKE :term 
                             OR telephone LIKE :term
                          ORDER BY id DESC');
        $this->db->bind(':term', $term);
        return $this->db->resultSet();
    }

    /**
     * Suspend un utilisateur
     */
    public function suspend(int $id): bool {
        $this->db->query('UPDATE utilisateurs SET statut = :statut WHERE id = :id');
        $this->db->bind(':statut', 'suspendu');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Réactive un utilisateur
     */
    public function unsuspend(int $id): bool {
        $this->db->query('UPDATE utilisateurs SET statut = :statut WHERE id = :id');
        $this->db->bind(':statut', 'actif');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Met à jour un utilisateur (par l'admin)
     */
    public function updateByAdmin(int $id, array $data): bool {
        $this->db->query('UPDATE utilisateurs 
                          SET nom = :nom, prenom = :prenom, email = :email, 
                              telephone = :telephone, role = :role 
                          WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':nom', $data['nom']);
        $this->db->bind(':prenom', $data['prenom']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telephone', $data['telephone']);
        $this->db->bind(':role', $data['role']);
        return $this->db->execute();
    }

    /**
     * Compte par statut
     */
    public function countByStatut(string $statut): int {
        $this->db->query("SELECT COUNT(*) as total FROM utilisateurs WHERE statut = :statut");
        $this->db->bind(':statut', $statut);
        $row = $this->db->single();
        return $row ? (int)$row->total : 0;
    }

        public function getCountByStatut(string $statut): int {
        $this->db->query("SELECT COUNT(*) as total FROM utilisateurs WHERE statut = :statut");
        $this->db->bind(':statut', $statut);
        $row = $this->db->single();
        return $row ? (int)$row->total : 0;
    }


}