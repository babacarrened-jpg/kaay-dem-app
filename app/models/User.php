<?php
// app/models/User.php

require_once __DIR__ . '/../interfaces/RepositoryInterface.php';

class User implements RepositoryInterface {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Enregistrer un nouvel utilisateur
     */
    public function register($data) {
        $this->db->query('INSERT INTO utilisateurs (nom, prenom, email, telephone, mot_de_passe) VALUES (:nom, :prenom, :email, :telephone, :mot_de_passe)');
        
        $this->db->bind(':nom', $data['nom']);
        $this->db->bind(':prenom', $data['prenom']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':telephone', $data['telephone']);
        $this->db->bind(':mot_de_passe', $data['mot_de_passe']);

        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Connexion d'un utilisateur
     */
    public function login($email, $password) {
        $this->db->query('SELECT * FROM utilisateurs WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if($row) {
            $hashed_password = $row->mot_de_passe;
            if(password_verify($password, $hashed_password)) {
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Trouver un utilisateur par son email
     */
    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM utilisateurs WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Obtenir les détails d'un utilisateur par son ID
     */
    public function getUserById($id) {
        $this->db->query('SELECT * FROM utilisateurs WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    public function getPendingConducteurRequests(): array {
        $this->db->query('SELECT d.id, d.utilisateur_id, d.statut, d.date_demande, u.nom as utilisateur_nom, u.prenom as utilisateur_prenom FROM demandes_conducteur d JOIN utilisateurs u ON d.utilisateur_id = u.id WHERE d.statut = :statut ORDER BY d.date_demande DESC');
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
    // Vérifier si une demande en attente existe déjà
    $this->db->query('SELECT id FROM demandes_conducteur 
                      WHERE utilisateur_id = :user_id AND statut = "en_attente"');
    $this->db->bind(':user_id', $userId);
    $this->db->single();
    if($this->db->rowCount() > 0) return false;

    $this->db->query('INSERT INTO demandes_conducteur 
                      (utilisateur_id, permis_recto, permis_verso, statut, date_demande) 
                      VALUES (:user_id, :recto, :verso, "en_attente", NOW())');
    $this->db->bind(':user_id', $userId);
    $this->db->bind(':recto', $permisRecto);
    $this->db->bind(':verso', $permisVerso);
    return $this->db->execute();
}
    
}
