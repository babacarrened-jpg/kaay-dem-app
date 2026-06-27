<?php
// app/models/Vehicule.php

require_once __DIR__ . '/../interfaces/RepositoryInterface.php';

class Vehicule implements RepositoryInterface {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Récupérer tous les véhicules d'un conducteur
     */
    public function getByConducteur(int $conducteurId): array {
        $this->db->query('SELECT * FROM vehicules WHERE conducteur_id = :conducteur_id ORDER BY date_ajout DESC');
        $this->db->bind(':conducteur_id', $conducteurId);
        return $this->db->resultSet();
    }

    /**
     * Vérifie si un conducteur a au moins un véhicule enregistré
     */
    public function conducteurAUnVehicule(int $conducteurId): bool {
        $this->db->query('SELECT COUNT(*) as total FROM vehicules WHERE conducteur_id = :conducteur_id');
        $this->db->bind(':conducteur_id', $conducteurId);
        $row = $this->db->single();
        return $row && (int)$row->total > 0;
    }

    /**
     * Récupérer le premier véhicule d'un conducteur (par défaut)
     */
    public function getPremierVehicule(int $conducteurId) {
        $this->db->query('SELECT * FROM vehicules WHERE conducteur_id = :conducteur_id ORDER BY date_ajout ASC LIMIT 1');
        $this->db->bind(':conducteur_id', $conducteurId);
        return $this->db->single();
    }

    /**
     * Ajouter un nouveau véhicule pour un conducteur
     */
    public function ajouter(int $conducteurId, array $data): bool {
        $this->db->query('INSERT INTO vehicules (conducteur_id, marque, modele, couleur, immatriculation, nombre_places)
                          VALUES (:conducteur_id, :marque, :modele, :couleur, :immatriculation, :nombre_places)');
        $this->db->bind(':conducteur_id', $conducteurId);
        $this->db->bind(':marque', $data['marque']);
        $this->db->bind(':modele', $data['modele']);
        $this->db->bind(':couleur', $data['couleur']);
        $this->db->bind(':immatriculation', $data['immatriculation']);
        $this->db->bind(':nombre_places', (int)$data['nombre_places']);
        return $this->db->execute();
    }

    public function findById(int $id) {
        $this->db->query('SELECT * FROM vehicules WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function findAll(): array {
        $this->db->query('SELECT * FROM vehicules ORDER BY id DESC');
        return $this->db->resultSet();
    }

    public function save(array $data): bool {
        if (!empty($data['id'])) {
            $this->db->query('UPDATE vehicules SET marque = :marque, modele = :modele, couleur = :couleur, immatriculation = :immatriculation, nombre_places = :nombre_places WHERE id = :id');
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':marque', $data['marque']);
            $this->db->bind(':modele', $data['modele']);
            $this->db->bind(':couleur', $data['couleur']);
            $this->db->bind(':immatriculation', $data['immatriculation']);
            $this->db->bind(':nombre_places', (int)$data['nombre_places']);
            return $this->db->execute();
        }

        return $this->ajouter((int)$data['conducteur_id'], $data);
    }

    public function delete(int $id): bool {
        $this->db->query('DELETE FROM vehicules WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}