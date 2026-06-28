-- ========================================================
-- SCHÉMA DE BASE DE DONNÉES - KAAY DEM !
-- Moteur : MySQL/MariaDB
-- ========================================================

-- Table Utilisateurs (Visiteurs inscrits, Passagers, Conducteurs, Admins)
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    telephone VARCHAR(20) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    photo_profil VARCHAR(255) DEFAULT 'default-avatar.png',
    role ENUM('passager', 'conducteur', 'admin') DEFAULT 'passager',
    est_conducteur_valide BOOLEAN DEFAULT FALSE,
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('actif', 'suspendu') DEFAULT 'actif'
);

-- Table Véhicules (Liés aux conducteurs)
CREATE TABLE vehicules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    conducteur_id INT NOT NULL,
    marque VARCHAR(50) NOT NULL,
    modele VARCHAR(50) NOT NULL,
    couleur VARCHAR(30) NOT NULL,
    immatriculation VARCHAR(20) NOT NULL,
    nombre_places INT NOT NULL DEFAULT 4,
    date_ajout DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (conducteur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE
);

-- Table Demandes Conducteur (Pour validation par l'admin)
CREATE TABLE demandes_conducteur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    vehicule_id INT, -- Optionnel si les infos véhicule sont créées avec la demande
    permis_recto VARCHAR(255) NOT NULL,
    permis_verso VARCHAR(255) NOT NULL,
    statut ENUM('en_attente', 'validee', 'rejetee') DEFAULT 'en_attente',
    date_demande DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_traitement DATETIME NULL,
    admin_id INT NULL,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (admin_id) REFERENCES utilisateurs(id) ON DELETE SET NULL,
    FOREIGN KEY (vehicule_id) REFERENCES vehicules(id) ON DELETE SET NULL
);

-- Table Trajets
CREATE TABLE trajets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    conducteur_id INT NOT NULL,
    vehicule_id INT NOT NULL,
    ville_depart VARCHAR(100) NOT NULL,
    point_depart VARCHAR(150) NULL,
    ville_arrivee VARCHAR(100) NOT NULL,
    point_arrivee VARCHAR(150) NULL,
    date_trajet DATE NOT NULL,
    heure_depart TIME NOT NULL,
    prix_par_place DECIMAL(10, 2) NOT NULL,
    places_disponibles INT NOT NULL,
    places_totales INT NOT NULL,
    description TEXT NULL,
    climatisation BOOLEAN DEFAULT FALSE,
    musique BOOLEAN DEFAULT TRUE,
    fumeur BOOLEAN DEFAULT FALSE,
    statut ENUM('planifie', 'en_cours', 'termine', 'annule') DEFAULT 'planifie',
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (conducteur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (vehicule_id) REFERENCES vehicules(id) ON DELETE RESTRICT
);

-- Table Réservations
CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    trajet_id INT NOT NULL,
    passager_id INT NOT NULL,
    places_reservees INT NOT NULL DEFAULT 1,
    prix_total DECIMAL(10, 2) NOT NULL,
    statut ENUM('en_attente', 'confirmee', 'terminee', 'annulee', 'refusee') DEFAULT 'en_attente',
    date_reservation DATETIME DEFAULT CURRENT_TIMESTAMP,
    date_modification DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (trajet_id) REFERENCES trajets(id) ON DELETE CASCADE,
    FOREIGN KEY (passager_id) REFERENCES utilisateurs(id) ON DELETE CASCADE
);

-- Table Avis (Évaluations)
CREATE TABLE avis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    trajet_id INT NOT NULL,
    auteur_id INT NOT NULL,
    destinataire_id INT NOT NULL,
    note INT NOT NULL CHECK(note >= 1 AND note <= 5),
    commentaire TEXT NULL,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (trajet_id) REFERENCES trajets(id) ON DELETE CASCADE,
    FOREIGN KEY (auteur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (destinataire_id) REFERENCES utilisateurs(id) ON DELETE CASCADE
);

-- Table Signalements
CREATE TABLE signalements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    auteur_id INT NOT NULL,
    concerne_id INT NOT NULL,
    trajet_id INT NULL,
    motif VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    statut ENUM('nouveau', 'en_cours', 'traite') DEFAULT 'nouveau',
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (auteur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (concerne_id) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (trajet_id) REFERENCES trajets(id) ON DELETE SET NULL
);

-- Table Notifications
CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    titre VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    type VARCHAR(50) NOT NULL, -- ex: 'nouvelle_reservation', 'statut_trajet', 'alerte'
    lien VARCHAR(255) NULL,
    lue BOOLEAN DEFAULT FALSE,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS messages_contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    lu BOOLEAN DEFAULT FALSE,
    date_envoi DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS activites (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    type        VARCHAR(50)  NOT NULL,
    description TEXT         NOT NULL,
    user_id     INT          NULL,
    created_at  DATETIME     DEFAULT NOW(),
    FOREIGN KEY (user_id) REFERENCES utilisateurs(id) ON DELETE SET NULL
);
