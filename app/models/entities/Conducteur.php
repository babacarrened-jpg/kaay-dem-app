<?php
// app/models/entities/Conducteur.php

require_once __DIR__ . '/Utilisateur.php';
require_once __DIR__ . '/../../interfaces/EvaluableInterface.php';

/**
 * Représente un utilisateur dans son rôle de conducteur : il publie des
 * trajets, gère ses véhicules et traite les réservations reçues.
 *
 * Les opérations de persistance restent déléguées aux modèles existants
 * (Trajet, Vehicule, Reservation, Avis) afin de ne pas dupliquer l'accès
 * aux données ; le rôle de cette classe est de représenter l'entité
 * métier "Conducteur" et son comportement propre.
 */
class Conducteur extends Utilisateur {
    protected bool $estValide;

    public function __construct(object $ligne) {
        parent::__construct($ligne);
        $this->estValide = !empty($ligne->est_conducteur_valide);
    }

    public function getRole(): string {
        return 'conducteur';
    }

    public function getLibelleTableauDeBord(): string {
        return 'Espace Conducteur';
    }

    public function getRouteTableauDeBord(): string {
        return 'conducteur/dashboard';
    }

    public function estValide(): bool {
        return $this->estValide;
    }

    /**
     * Un conducteur ne peut publier de trajet que si son compte a été
     * validé par un administrateur (règle imposée par le sujet).
     */
    public function peutPublierTrajet(): bool {
        return $this->estValide;
    }

    /**
     * Publie un nouveau trajet, si le conducteur est validé.
     * Délègue la persistance à Trajet::create().
     *
     * @throws RuntimeException si le conducteur n'est pas encore validé
     */
    public function publierTrajet(Trajet $trajetModel, array $donnees): bool {
        if (!$this->peutPublierTrajet()) {
            throw new RuntimeException("Ce conducteur n'est pas encore validé par l'administrateur.");
        }

        $donnees['conducteur_id'] = $this->id;
        return $trajetModel->create($donnees);
    }

    public function accepterReservation(Reservation $reservationModel, int $reservationId): bool {
        return $reservationModel->setStatus($reservationId, ReservationStatus::CONFIRMEE->value);
    }

    public function refuserReservation(Reservation $reservationModel, int $reservationId): bool {
        return $reservationModel->setStatus($reservationId, ReservationStatus::ANNULEE->value);
    }

    public function getNoteMoyenne(Avis $avisModel): float {
        return $avisModel->getAverageRating($this->id);
    }

    public function getTrajetsPublies(Trajet $trajetModel): array {
        return $trajetModel->getByConducteur($this->id);
    }

    public function getGainsDuMois(Reservation $reservationModel): float {
        return $reservationModel->getGainsMoisCourant($this->id);
    }
}