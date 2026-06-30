<?php
// app/models/entities/Utilisateur.php

/**
 * Classe abstraite représentant un utilisateur de la plateforme.
 *
 * Toutes les données sont stockées dans une unique table SQL (utilisateurs),
 * mais cette hiérarchie de classes permet de modéliser proprement le
 * comportement spécifique de chaque rôle (Conducteur, Passager, Admin)
 * tout en partageant les attributs et méthodes communs.
 *
 * Une instance se construit à partir d'une ligne de la table utilisateurs
 * (objet stdClass renvoyé par PDO), via UtilisateurFactory::creerDepuisLigne().
 */
abstract class Utilisateur {
    protected int $id;
    protected string $nom;
    protected string $prenom;
    protected string $email;
    protected string $telephone;
    protected string $photoProfil;
    protected string $statut;
    protected string $dateInscription;

    public function __construct(object $ligne) {
        $this->id = (int) $ligne->id;
        $this->nom = $ligne->nom;
        $this->prenom = $ligne->prenom;
        $this->email = $ligne->email;
        $this->telephone = $ligne->telephone;
        $this->photoProfil = $ligne->photo_profil ?? 'default-avatar.png';
        $this->statut = $ligne->statut ?? 'actif';
        $this->dateInscription = $ligne->date_inscription ?? '';
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNomComplet(): string {
        return trim($this->prenom . ' ' . $this->nom);
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getTelephone(): string {
        return $this->telephone;
    }

    public function getPhotoProfil(): string {
        return $this->photoProfil;
    }

    public function estActif(): bool {
        return $this->statut === 'actif';
    }

    /**
     * Nom du rôle, utilisé notamment pour le contrôle d'accès et l'affichage.
     */
    abstract public function getRole(): string;

    /**
     * Libellé du tableau de bord propre à chaque rôle (polymorphisme :
     * chaque sous-classe redéfinit cette méthode différemment).
     */
    abstract public function getLibelleTableauDeBord(): string;

    /**
     * Route (sans BASE_URL) vers le tableau de bord de ce rôle.
     */
    abstract public function getRouteTableauDeBord(): string;
}