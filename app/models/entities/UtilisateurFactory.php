<?php
// app/models/entities/UtilisateurFactory.php

require_once __DIR__ . '/Utilisateur.php';
require_once __DIR__ . '/Conducteur.php';
require_once __DIR__ . '/Passager.php';
require_once __DIR__ . '/Admin.php';

/**
 * Fabrique chargée d'instancier la bonne sous-classe de Utilisateur
 * (Conducteur, Passager ou Admin) à partir d'une ligne de la table
 * utilisateurs (objet stdClass renvoyé par PDO).
 *
 * Gestion du double rôle : un même compte peut être à la fois conducteur
 * et passager (un conducteur validé peut aussi réserver des trajets en
 * tant que passager). Le rôle stocké en base (utilisateurs.role) indique
 * le rôle "principal" du compte, mais creerSelonRole() permet d'obtenir
 * explicitement l'une ou l'autre représentation pour un même utilisateur,
 * ce qui correspond au choix de composition plutôt que d'exclusivité.
 */
class UtilisateurFactory {

    /**
     * Instancie la sous-classe correspondant au rôle principal stocké en base.
     */
    public static function creerDepuisLigne(object $ligne): Utilisateur {
        return self::creerSelonRole($ligne, $ligne->role);
    }

    /**
     * Instancie explicitement la sous-classe demandée pour cette ligne
     * utilisateur, indépendamment du rôle stocké en base. Permet de
     * représenter le double rôle : un conducteur validé qui réserve un
     * trajet est alors traité comme un Passager le temps de l'opération.
     */
    public static function creerSelonRole(object $ligne, string $role): Utilisateur {
        return match ($role) {
            'conducteur' => new Conducteur($ligne),
            'admin' => new Admin($ligne),
            default => new Passager($ligne),
        };
    }

    /**
     * Un même utilisateur peut-il agir comme conducteur ? (compte validé
     * par l'administrateur, indépendamment de son rôle stocké en base)
     */
    public static function peutAgirCommeConducteur(object $ligne): bool {
        return !empty($ligne->est_conducteur_valide);
    }
}