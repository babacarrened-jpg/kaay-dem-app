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

    public function reserver($trajet_id, $passager_id, $places, $prix_total) {
        $this->db->query("START TRANSACTION");
        $this->db->execute();

        try {
            $this->db->query("SELECT t.places_disponibles, t.date_trajet, u.est_conducteur_valide
                              FROM trajets t
                              JOIN utilisateurs u ON t.conducteur_id = u.id
                              WHERE t.id = :trajet_id FOR UPDATE");
            $this->db->bind(':trajet_id', $trajet_id);
            $trajet = $this->db->single();

            if ($trajet->places_disponibles < $places) {
                throw new PlacesInsuffisantesException();
            }

            $status = ReservationStatus::EN_ATTENTE->value;

            $this->db->query("SELECT id FROM reservations WHERE passager_id = :passager_id AND trajet_id = :trajet_id AND statut IN ('en_attente', 'confirmee')");
            $this->db->bind(':passager_id', $passager_id);
            $this->db->bind(':trajet_id', $trajet_id);
            $existing = $this->db->single();

            if ($existing) {
                throw new ReservationConflictException();
            }

            $this->db->query("SELECT COUNT(*) as count_reservations FROM reservations r JOIN trajets t ON r.trajet_id = t.id WHERE r.passager_id = :passager_id AND r.statut IN ('en_attente', 'confirmee') AND t.date_trajet = :date_trajet AND t.id <> :trajet_id");
            $this->db->bind(':passager_id', $passager_id);
            $this->db->bind(':date_trajet', $trajet->date_trajet);
            $this->db->bind(':trajet_id', $trajet_id);
            $overlap = $this->db->single();

            if ($overlap->count_reservations > 0) {
                throw new ReservationConflictException();
            }

            $this->db->query("INSERT INTO reservations (trajet_id, passager_id, places_reservees, prix_total, statut) VALUES (:trajet_id, :passager_id, :places, :prix_total, :statut)");
            $this->db->bind(':trajet_id', $trajet_id);
            $this->db->bind(':passager_id', $passager_id);
            $this->db->bind(':places', $places);
            $this->db->bind(':prix_total', $prix_total);
            $this->db->bind(':statut', $status);
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
            throw $e;
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

    public function getPendingByConducteur($conducteur_id) {
        $this->db->query("SELECT r.*, t.ville_depart, t.ville_arrivee, t.date_trajet, t.heure_depart, t.places_totales, t.places_disponibles, u.nom as passager_nom, u.prenom as passager_prenom
                          FROM reservations r
                          JOIN trajets t ON r.trajet_id = t.id
                          JOIN utilisateurs u ON r.passager_id = u.id
                          WHERE t.conducteur_id = :conducteur_id AND r.statut = :statut
                          ORDER BY r.date_reservation DESC");
        $this->db->bind(':conducteur_id', $conducteur_id);
        $this->db->bind(':statut', ReservationStatus::EN_ATTENTE->value);
        return $this->db->resultSet();
    }

    public function getDetailForConducteur(int $reservation_id) {
        $this->db->query("SELECT r.*, t.conducteur_id, t.ville_depart, t.ville_arrivee, t.date_trajet, t.heure_depart, t.places_totales, t.places_disponibles, u.nom as passager_nom, u.prenom as passager_prenom
                          FROM reservations r
                          JOIN trajets t ON r.trajet_id = t.id
                          JOIN utilisateurs u ON r.passager_id = u.id
                          WHERE r.id = :reservation_id");
        $this->db->bind(':reservation_id', $reservation_id);
        return $this->db->single();
    }

    public function setStatus(int $reservation_id, string $status) {
        $this->db->query('START TRANSACTION');
        $this->db->execute();

        try {
            $this->db->query('SELECT trajet_id, places_reservees, statut FROM reservations WHERE id = :id FOR UPDATE');
            $this->db->bind(':id', $reservation_id);
            $res = $this->db->single();

            if(!$res) {
                $this->db->query('ROLLBACK');
                $this->db->execute();
                return false;
            }

            if($status === ReservationStatus::ANNULEE->value && in_array($res->statut, [ReservationStatus::EN_ATTENTE->value, ReservationStatus::CONFIRMEE->value], true)) {
                $this->db->query('UPDATE trajets SET places_disponibles = places_disponibles + :places WHERE id = :trajet_id');
                $this->db->bind(':places', $res->places_reservees);
                $this->db->bind(':trajet_id', $res->trajet_id);
                $this->db->execute();
            }

            $this->db->query('UPDATE reservations SET statut = :statut WHERE id = :id');
            $this->db->bind(':statut', $status);
            $this->db->bind(':id', $reservation_id);
            $this->db->execute();

            $this->db->query('COMMIT');
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            $this->db->query('ROLLBACK');
            $this->db->execute();
            return false;
        }
    }

    public function cancelByPassager(int $reservation_id, int $passager_id): bool {
        $this->db->query('START TRANSACTION');
        $this->db->execute();

        try {
            $this->db->query('SELECT trajet_id, places_reservees, statut FROM reservations WHERE id = :id AND passager_id = :passager_id FOR UPDATE');
            $this->db->bind(':id', $reservation_id);
            $this->db->bind(':passager_id', $passager_id);
            $res = $this->db->single();

            if (!$res || !in_array($res->statut, [ReservationStatus::EN_ATTENTE->value, ReservationStatus::CONFIRMEE->value], true)) {
                $this->db->query('ROLLBACK');
                $this->db->execute();
                return false;
            }

            $this->db->query('UPDATE trajets SET places_disponibles = places_disponibles + :places WHERE id = :trajet_id');
            $this->db->bind(':places', $res->places_reservees);
            $this->db->bind(':trajet_id', $res->trajet_id);
            $this->db->execute();

            $this->db->query('UPDATE reservations SET statut = :statut WHERE id = :id AND passager_id = :passager_id');
            $this->db->bind(':statut', ReservationStatus::ANNULEE->value);
            $this->db->bind(':id', $reservation_id);
            $this->db->bind(':passager_id', $passager_id);
            $this->db->execute();

            $this->db->query('COMMIT');
            $this->db->execute();
            return true;
        } catch (Exception $e) {
            $this->db->query('ROLLBACK');
            $this->db->execute();
            return false;
        }
    }

    public function getDetailById(int $reservation_id, int $passager_id) {
        $this->db->query("SELECT r.*, t.ville_depart, t.ville_arrivee, t.date_trajet, t.heure_depart, t.places_totales, t.places_disponibles, t.prix_par_place, t.description,
                                 u.nom as conducteur_nom, u.prenom as conducteur_prenom, u.telephone as conducteur_tel, v.marque, v.modele, v.couleur, v.immatriculation
                          FROM reservations r
                          JOIN trajets t ON r.trajet_id = t.id
                          JOIN utilisateurs u ON t.conducteur_id = u.id
                          JOIN vehicules v ON t.vehicule_id = v.id
                          WHERE r.id = :reservation_id AND r.passager_id = :passager_id");
        $this->db->bind(':reservation_id', $reservation_id);
        $this->db->bind(':passager_id', $passager_id);
        return $this->db->single();
    }

    public function getGainsMoisCourant(int $conducteurId): float {
        $this->db->query("SELECT COALESCE(SUM(r.prix_total), 0) as total
                          FROM reservations r
                          JOIN trajets t ON r.trajet_id = t.id
                          WHERE t.conducteur_id = :conducteur_id
                          AND r.statut = :statut
                          AND MONTH(r.date_reservation) = MONTH(CURDATE())
                          AND YEAR(r.date_reservation) = YEAR(CURDATE())");
        $this->db->bind(':conducteur_id', $conducteurId);
        $this->db->bind(':statut', ReservationStatus::CONFIRMEE->value);
        $row = $this->db->single();
        return $row ? (float)$row->total : 0.0;
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

    public function getPassagersByConducteur(int $conducteur_id): array {
        $this->db->query("SELECT
                            u.id, u.nom, u.prenom, u.email, u.telephone, u.photo_profil,
                            r.id AS reservation_id,
                            r.places_reservees, r.prix_total,
                            r.statut AS reservation_statut,
                            r.date_reservation,
                            t.id AS trajet_id,
                            t.ville_depart, t.ville_arrivee,
                            t.date_trajet, t.heure_depart
                        FROM reservations r
                        JOIN utilisateurs u ON u.id = r.passager_id
                        JOIN trajets t ON t.id = r.trajet_id
                        WHERE t.conducteur_id = :conducteur_id
                        ORDER BY r.date_reservation DESC");
        $this->db->bind(':conducteur_id', $conducteur_id);
        return $this->db->resultSet();
    }

    public function getPassagersByTrajet(int $trajet_id, int $conducteur_id): array {
        $this->db->query("SELECT
                            u.id, u.nom, u.prenom, u.email, u.telephone, u.photo_profil,
                            r.id AS reservation_id,
                            r.places_reservees, r.prix_total,
                            r.statut AS reservation_statut,
                            r.date_reservation,
                            t.id AS trajet_id,
                            t.ville_depart, t.ville_arrivee,
                            t.date_trajet, t.heure_depart
                        FROM reservations r
                        JOIN utilisateurs u ON u.id = r.passager_id
                        JOIN trajets t ON t.id = r.trajet_id
                        WHERE t.id = :trajet_id AND t.conducteur_id = :conducteur_id
                        ORDER BY r.date_reservation DESC");
        $this->db->bind(':trajet_id', $trajet_id);
        $this->db->bind(':conducteur_id', $conducteur_id);
        return $this->db->resultSet();
    }

    public function countAll(): int {
        $this->db->query("SELECT COUNT(*) as total FROM reservations");
        $row = $this->db->single();
        return $row ? (int)$row->total : 0;
    }
}