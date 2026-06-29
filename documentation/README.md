# Kaay Dem ! — Plateforme de covoiturage étudiant

Projet de Programmation Orientée Objet en PHP — ISEP Diamniadio, année académique 2025-2026.

## Présentation

**Kaay Dem !** (« Viens-y ! » en wolof) est une plateforme web de covoiturage réservée à la communauté étudiante de l'ISEP Diamniadio. Elle permet aux conducteurs de publier leurs trajets entre Dakar, Rufisque et Diamniadio, et aux passagers de réserver des places, avec un système d'évaluation mutuelle à l'issue du voyage.

L'application a été développée intégralement en **PHP orienté objet, sans framework**, afin de démontrer la maîtrise des concepts fondamentaux de la POO et d'une architecture MVC construite à la main.

## Stack technique

| Élément | Technologie |
|---|---|
| Langage | PHP 8.1+ |
| Architecture | MVC maison (sans framework) |
| Base de données | MySQL / MariaDB |
| Serveur web | Apache (WampServer) ou Nginx |
| Cartographie | Leaflet.js |
| Frontend | HTML5, CSS3, JavaScript (AJAX) |

## Structure du projet

```
kaay-dem-app/
├── public/
│   ├── index.php          ← Point d'entrée unique (Front Controller)
│   ├── .htaccess          ← Réécriture d'URL vers index.php
│   └── assets/            ← CSS, images, uploads
├── app/
│   ├── config/config.php  ← Constantes (DB, BASE_URL…)
│   ├── core/
│   │   ├── Router.php     ← Routeur maison avec regex
│   │   ├── Controller.php ← Contrôleur abstrait de base
│   │   └── Database.php   ← Classe PDO avec query/bind/execute
│   ├── controllers/       ← AuthController, TrajetController…
│   ├── models/            ← User, Trajet, Reservation, Avis…
│   ├── views/             ← Vues PHP (layouts, partials)
│   ├── enums/             ← ReservationStatus (PHP 8.1)
│   ├── interfaces/        ← RepositoryInterface, EvaluableInterface
│   ├── traits/            ← Timestampable
│   └── exceptions/        ← PlacesInsuffisantesException…
└── database/
    ├── schema.sql         ← Création des tables
    └── seed.sql           ← Données de démonstration
```

## Concepts POO implémentés

- **Classe abstraite** : `Controller` — base commune de tous les contrôleurs
- **Interfaces** : `RepositoryInterface` (CRUD), `EvaluableInterface` (évaluations)
- **Enum PHP 8.1** : `ReservationStatus` (EN_ATTENTE, CONFIRMEE, TERMINEE, ANNULEE)
- **Trait** : `Timestampable` (propriétés `created_at` / `updated_at`)
- **Exceptions personnalisées** : `PlacesInsuffisantesException`, `ReservationConflictException`
- **Héritage** : tous les contrôleurs étendent `Controller`

## Fonctionnalités

### Authentification et rôles
- Inscription / connexion / déconnexion
- Hachage des mots de passe avec `password_hash()` (BCRYPT)
- Trois rôles : passager, conducteur, admin
- Processus de validation conducteur (upload permis, validation admin)

### Gestion des trajets
- Publication de trajets (ville, date, heure, prix, places, options)
- Recherche avec normalisation Unicode (insensible aux accents)
- Clôture automatique des trajets passés
- Carte interactive Leaflet.js sur la page de détail

### Réservations
- Cycle de vie complet avec transactions SQL et verrou `FOR UPDATE`
- Gestion de la concurrence sur les places disponibles
- Annulation avec réincrément automatique des places

### Évaluations
- Notation 1 à 5 étoiles après trajet terminé
- Note moyenne calculée et affichée sur le profil conducteur

### Tableaux de bord
- **Conducteur** : trajets, réservations en attente, gains, note moyenne
- **Passager** : réservations actives, historique, évaluations
- **Admin** : KPIs globaux, top conducteurs, taux d'occupation, statistiques

### Bonus
- Carte Leaflet.js
- Formulaire de contact
- Signalements utilisateurs avec workflow
- Notifications internes
- API AJAX pour les réservations conducteur

## Base de données

| Table | Description |
|---|---|
| `utilisateurs` | Tous les acteurs (passager, conducteur, admin) |
| `vehicules` | Véhicules liés aux conducteurs |
| `demandes_conducteur` | Demandes de passage au rôle conducteur |
| `trajets` | Trajets publiés |
| `reservations` | Réservations de places |
| `avis` | Évaluations post-trajet |
| `signalements` | Signalements d'abus |
| `notifications` | Notifications internes |
| `contacts` | Messages du formulaire de contact |
| `activites` | Journal d'activité admin |

## Installation

1. **Cloner le dépôt**
   ```bash
   git clone <url-du-depot> kaay-dem-app
   cd kaay-dem-app
   ```

2. **Configurer la base de données**
   - Créer une base `kaay_dem` dans MySQL/MariaDB
   - Importer `database/schema.sql` puis `database/seed.sql`
   - Modifier les constantes dans `app/config/config.php` (hôte, nom BDD, identifiants)

3. **Configurer le serveur web**
   - Pointer le DocumentRoot vers le dossier `public/`
   - S'assurer que le module Apache `mod_rewrite` est activé (pour le `.htaccess`)

4. **Accéder à l'application**
   - Ouvrir `http://localhost/kaay-dem-app/` dans le navigateur

## Sécurité

- Requêtes SQL préparées (PDO `prepare` + `bindValue`)
- Mots de passe hachés avec `password_hash()` (BCRYPT)
- Sorties HTML échappées avec `htmlspecialchars()`
- Contrôle d'accès par rôle sur chaque route sensible

## Génération du rapport Word

Un script Node.js génère le rapport technique au format `.docx` :

```bash
npm install
node index.js
```

Le fichier `rapport_kaay_dem.docx` est créé à la racine du projet.

Un serveur de téléchargement est également disponible :

```bash
node server.js
```

Puis ouvrir `http://localhost:3000` dans le navigateur.

## Membres du groupe

| Membre | Contributions |
|---|---|
| [Prénom NOM] | Architecture MVC, authentification, modèle User |
| [Prénom NOM] | Modèles Trajet et Vehicule, recherche, formulaires conducteur |
| [Prénom NOM] | Modèle Reservation, transactions SQL, exceptions |
| [Prénom NOM] | Dashboard admin, KPIs, évaluations, signalements, carte Leaflet |

## Licence

Projet académique — ISEP Diamniadio. Usage pédagogique uniquement.
