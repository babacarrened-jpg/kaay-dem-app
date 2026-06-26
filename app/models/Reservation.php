<?php
// app/models/Reservation.php

require_once __DIR__ . '/../interfaces/RepositoryInterface.php';
require_once __DIR__ . '/../enums/ReservationStatus.php';
require_once __DIR__ . '/../exceptions/PlacesInsuffisantesException.php';
require_once __DIR__ . '/../exceptions/ReservationConflictException.php';
require_once __DIR__ . '/../traits/Timestampable.php';

class Reservation implements RepositoryInterface {
    use Timestampable;

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Créer une nouvelle réservation
     */
    public function reserver($trajet_id, $passager_id, $places, $prix_total) {
        $this->db->query("START TRANSACTION");
        $this->db->execute();

        try {
            $this->db->query("SELECT places_disponibles, date_trajet FROM trajets WHERE id = :trajet_id FOR UPDATE");
            $this->db->bind(':trajet_id', $trajet_id);
            $trajet = $this->db->single();

            if ($trajet->places_disponibles < $places) {
                throw new PlacesInsuffisantesException();
            }

            $this->db->query("SELECT COUNT(*) as count_reservations FROM reservations r JOIN trajets t ON r.trajet_id = t.id WHERE r.passager_id = :passager_id AND r.statut IN ('en_attente', 'confirmee') AND t.date_trajet = :date_trajet AND t.id <> :trajet_id");
            $this->db->bind(':passager_id', $passager_id);
            $this->db->bind(':date_trajet', $trajet->date_trajet);
            $this->db->bind(':trajet_id', $trajet_id);
            $overlap = $this->db->single();

            if ($overlap->count_reservations > 0) {
                throw new ReservationConflictException();
            }

            $this->db->query("INSERT INTO reservations (trajet_id, passager_id, places_reservees, prix_total, statut) 
                              VALUES (:trajet_id, :passager_id, :places, :prix_total, :statut)");
            $this->db->bind(':trajet_id', $trajet_id);
            $this->db->bind(':passager_id', $passager_id);
            $this->db->bind(':places', $places);
            $this->db->bind(':prix_total', $prix_total);
            $this->db->bind(':statut', ReservationStatus::EN_ATTENTE->value);
            $this->db->execute();

            $this->db->query("UPDATE trajets SET places_disponibles = places_disponibles - :places WHERE id = :trajet_id");
            $this->db->bind(':places', $places);
            $this->db->bind(':trajet_id', $trajet_id);
            $this->db->execute();

            $this->db->query("COMMIT");
            $this->db->execute();

            return true;

        } catch (PlacesInsuffisantesException $e) {
            $this->db->query("ROLLBACK");
            $this->db->execute();
            return false;
        } catch (ReservationConflictException $e) {
            $this->db->query("ROLLBACK");
            $this->db->execute();
            throw $e;
        } catch (Exception $e) {
            $this->db->query("ROLLBACK");
            $this->db->execute();
            return false;
        }
    }

    /**
     * Récupérer les réservations d'un passager
     */
    public function getByPassager($passager_id) {
        $this->db->query("SELECT r.*, t.ville_depart, t.ville_arrivee, t.date_trajet, t.heure_depart, 
                                 u.nom as conducteur_nom, u.prenom as conducteur_prenom
                          FROM reservations r
                          JOIN trajets t ON r.trajet_id = t.id
                          JOIN utilisateurs u ON t.conducteur_id = u.id
                          WHERE r.passager_id = :passager_id
                          ORDER BY t.date_trajet DESC");
        $this->db->bind(':passager_id', $passager_id);
        
        return $this->db->resultSet();
    }

    public function findById(int $id) {
        $this->db->query('SELECT * FROM reservations WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function findAll(): array {
        $this->db->query('SELECT * FROM reservations ORDER BY id DESC');
        return $this->db->resultSet();
    }

    public function save(array $data): bool {
        if (!empty($data['id'])) {
            $this->db->query('UPDATE reservations SET statut = :statut, places_reservees = :places WHERE id = :id');
            $this->db->bind(':statut', $data['statut'] ?? ReservationStatus::EN_ATTENTE->value);
            $this->db->bind(':places', $data['places_reservees'] ?? 1);
            $this->db->bind(':id', $data['id']);
            return $this->db->execute();
        }

        $this->db->query('INSERT INTO reservations (trajet_id, passager_id, places_reservees, prix_total, statut) VALUES (:trajet_id, :passager_id, :places, :prix_total, :statut)');
        $this->db->bind(':trajet_id', $data['trajet_id']);
        $this->db->bind(':passager_id', $data['passager_id']);
        $this->db->bind(':places', $data['places_reservees']);
        $this->db->bind(':prix_total', $data['prix_total']);
        $this->db->bind(':statut', $data['statut'] ?? ReservationStatus::EN_ATTENTE->value);
        return $this->db->execute();
    }

    public function delete(int $id): bool {
        $this->db->query('DELETE FROM reservations WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
