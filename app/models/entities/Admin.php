<?php
// app/models/entities/Admin.php

require_once __DIR__ . '/Utilisateur.php';

/**
 * Représente un utilisateur dans son rôle d'administrateur : il valide les
 * comptes conducteurs, gère les utilisateurs et consulte les statistiques.
 */
class Admin extends Utilisateur {

    public function getRole(): string {
        return 'admin';
    }

    public function getLibelleTableauDeBord(): string {
        return 'Espace Administrateur';
    }

    public function getRouteTableauDeBord(): string {
        return 'admin/dashboard';
    }

    public function validerConducteur(User $userModel, int $utilisateurId): bool {
        return $userModel->validateConducteur($utilisateurId, $this->id);
    }

    public function refuserConducteur(User $userModel, int $utilisateurId): bool {
        return $userModel->refuseConducteur($utilisateurId, $this->id);
    }

    public function getStatistiques(Trajet $trajetModel): array {
        return [
            'trajets_par_mois' => $trajetModel->getTrajetsByMonth(),
            'taux_occupation' => $trajetModel->getTauxOccupationByMonth(),
            'top_conducteurs' => $trajetModel->getTopConducteurs(5),
        ];
    }
}