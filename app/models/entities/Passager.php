<?php
// app/models/entities/Passager.php

require_once __DIR__ . '/Utilisateur.php';

/**
 * Représente un utilisateur dans son rôle de passager : il recherche des
 * trajets, réserve des places, et évalue le conducteur après le voyage.
 */
class Passager extends Utilisateur {

    public function getRole(): string {
        return 'passager';
    }

    public function getLibelleTableauDeBord(): string {
        return 'Mon Espace Passager';
    }

    public function getRouteTableauDeBord(): string {
        return 'passager/dashboard';
    }

    /**
     * Réserve des places sur un trajet. Délègue la logique transactionnelle
     * (vérification des places, conflits de date) à Reservation::reserver().
     *
     * @throws PlacesInsuffisantesException
     * @throws ReservationConflictException
     */
    public function reserverTrajet(Reservation $reservationModel, int $trajetId, int $places, float $prixTotal): bool {
        return $reservationModel->reserver($trajetId, $this->id, $places, $prixTotal);
    }

    public function annulerReservation(Reservation $reservationModel, int $reservationId): bool {
        return $reservationModel->cancelByPassager($reservationId, $this->id);
    }

    /**
     * Note le conducteur d'un trajet terminé. Refuse silencieusement
     * (retourne false) si le trajet n'est pas encore terminé ou si ce
     * passager a déjà noté ce trajet, conformément aux règles métier.
     */
    public function noterConducteur(Avis $avisModel, int $trajetId, int $conducteurId, int $note, string $commentaire = ''): bool {
        if ($avisModel->dejaNote($trajetId, $this->id)) {
            return false;
        }
        return $avisModel->addRating($trajetId, $this->id, $conducteurId, $note, $commentaire);
    }

    public function getReservations(Reservation $reservationModel): array {
        return $reservationModel->getByPassager($this->id);
    }
}