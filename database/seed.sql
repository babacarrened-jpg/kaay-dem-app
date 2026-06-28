-- ========================================================
-- DONNÉES DE TEST - KAAY DEM !
-- ========================================================
/*conducteur : conducteur123
    passager : passager123             ------------moguini-------
    admin : admin123@     
    */

-- Insérer des utilisateurs de test
INSERT INTO utilisateurs (nom, prenom, email, telephone, mot_de_passe, photo_profil, role, est_conducteur_valide, statut) VALUES
('Ndiaye', 'Cheikh', 'cheikh.ndiaye@test.com', '+221771234567', '$2b$10$SamGjFcl5coAlDsgFtIaOuPeIRyhrZWk141ourujhkBAz79eBo2Ei', 'default-avatar.png', 'conducteur', 1, 'actif'),
('Diop', 'Lamine', 'lamine.diop@gmail.com', '+221772345678', '$2b$10$1vBTrBOg8qf3wD6cVX6mg.ht0.PjLLljSXMwQsFTzbSfWNf4sbL.S', 'default-avatar.png', 'passager', 0, 'actif'),
('Fall', 'Seydou', 'seydou.fall@example.com', '+221773456789', '$2b$10$SamGjFcl5coAlDsgFtIaOuPeIRyhrZWk141ourujhkBAz79eBo2Ei', 'default-avatar.png', 'conducteur', 1, 'actif'),
('Mbaye', 'Aminata', 'aminata.mbaye@gmail.com', '+221774567890', '$2b$10$1vBTrBOg8qf3wD6cVX6mg.ht0.PjLLljSXMwQsFTzbSfWNf4sbL.S', 'default-avatar.png', 'passager', 0, 'actif'),
('Gueye', 'Rokhaya', 'rokhaya.gueye@example.com', '+221775678901', '$2b$10$1vBTrBOg8qf3wD6cVX6mg.ht0.PjLLljSXMwQsFTzbSfWNf4sbL.S', 'default-avatar.png', 'passager', 0, 'actif'),
('Sarr', 'Pape', 'pape.sarr@gmail.com', '+221776789012', '$2b$10$SamGjFcl5coAlDsgFtIaOuPeIRyhrZWk141ourujhkBAz79eBo2Ei', 'default-avatar.png', 'conducteur', 1, 'actif'),
('Ba', 'Fatou', 'fatou.ba@example.com', '+221777890123', '$2b$10$1vBTrBOg8qf3wD6cVX6mg.ht0.PjLLljSXMwQsFTzbSfWNf4sbL.S', 'default-avatar.png', 'passager', 0, 'actif'),
('Faye', 'Ibrahima', 'ibrahima.faye@example.com', '+221778901234', '$2b$10$SamGjFcl5coAlDsgFtIaOuPeIRyhrZWk141ourujhkBAz79eBo2Ei', 'default-avatar.png', 'conducteur', 1, 'actif'),
('Diallo', 'Marieme', 'marieme.diallo@example.com', '+221779012345', '$2b$10$1vBTrBOg8qf3wD6cVX6mg.ht0.PjLLljSXMwQsFTzbSfWNf4sbL.S', 'default-avatar.png', 'passager', 0, 'actif'),
('Sow', 'Ousmane', 'ousmane.sow@example.com', '+221770123456', '$2b$10$1vBTrBOg8qf3wD6cVX6mg.ht0.PjLLljSXMwQsFTzbSfWNf4sbL.S', 'default-avatar.png', 'passager', 0, 'actif'),
('Admin', 'Kaay', 'admin2@kaaydem.sn', '+221700000002', '$2b$10$ohqop/KnR/j9P5Xc.OpUBOdJ7r1ONIJcQcx1Rhc0m6UszuVNRLpRi', 'default-avatar.png', 'admin', 0, 'actif');

-- Insérer des véhicules
INSERT INTO vehicules (conducteur_id, marque, modele, couleur, immatriculation, nombre_places) VALUES
(1, 'Toyota', 'Corolla', 'Blanc', 'SN-001-AAA', 4),
(1, 'Peugeot', '206', 'Gris', 'SN-002-BBB', 4),
(2, 'Honda', 'Civic', 'Noir', 'SN-003-CCC', 4),
(3, 'Renault', 'Kangoo', 'Bleu', 'SN-004-DDD', 5);

-- Insérer des trajets
INSERT INTO trajets (conducteur_id, vehicule_id, ville_depart, point_depart, ville_arrivee, point_arrivee, date_trajet, heure_depart, prix_par_place, places_disponibles, places_totales, description, climatisation, musique, fumeur, statut) VALUES
(1, 1, 'Dakar', 'Gare Routière de Dakar', 'Diamniadio', 'Rond-point de Diamniadio', DATE_ADD(CURDATE(), INTERVAL 1 DAY), '08:00:00', 1500, 4, 4, 'Trajet confortable avec climatisation. Départ tôt le matin.', TRUE, TRUE, FALSE, 'planifie'),
(1, 1, 'Dakar', 'Plateau', 'Rufisque', 'Centre-ville', DATE_ADD(CURDATE(), INTERVAL 2 DAY), '14:30:00', 800, 3, 4, 'Trajet l\'après-midi, idéal pour les étudiants.', TRUE, TRUE, FALSE, 'planifie'),
(1, 2, 'Dakar', 'Gare Routière de Dakar', 'Diamniadio', 'Rond-point de Diamniadio', DATE_ADD(CURDATE(), INTERVAL 3 DAY), '10:00:00', 1200, 4, 4, 'Véhicule confortable, nouveau modèle.', FALSE, TRUE, FALSE, 'planifie'),
(2, 3, 'Thiès', 'Gare de Thiès', 'Dakar', 'HLM', DATE_ADD(CURDATE(), INTERVAL 1 DAY), '06:30:00', 1000, 4, 4, 'Trajet quotidien vers Dakar, départ très tôt.', TRUE, TRUE, FALSE, 'planifie'),
(3, 4, 'Saint-Louis', 'Gare Routière', 'Dakar', 'Parcelles Assainies', DATE_ADD(CURDATE(), INTERVAL 2 DAY), '07:00:00', 1800, 5, 5, 'Voyage confortable avec beaucoup d’espace pour les bagages.', TRUE, FALSE, FALSE, 'planifie');
    