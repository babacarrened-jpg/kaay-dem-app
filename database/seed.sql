-- ========================================================
-- DONNÉES DE TEST - KAAY DEM !
-- ========================================================
/*conducteur : conducteur123
    passager : passager123             ------------moguini-------
    admin : admin123@*/

-- Insérer des utilisateurs de test
-- Conducteurs (est_conducteur_valide = 1)
INSERT INTO utilisateurs (nom, prenom, email, telephone, mot_de_passe, role, est_conducteur_valide, statut) VALUES
('Dupont', 'Jean', 'jean.dupont@example.com', '+221770000001', '$2b$10$Bkx5tkjIstT3JYUmQnse3eRUiZnvbFZenq66RZ3pisduTHriS3NJK', 'conducteur', 1, 'actif'),
('Sarr', 'Fatou', 'fatou.sarr@example.com', '+221770000002', '$2b$10$Bkx5tkjIstT3JYUmQnse3eRUiZnvbFZenq66RZ3pisduTHriS3NJK', 'conducteur', 1, 'actif'),
('Ba', 'Omar', 'omar.ba@example.com', '+221770000003', '$2b$10$Bkx5tkjIstT3JYUmQnse3eRUiZnvbFZenq66RZ3pisduTHriS3NJK', 'conducteur', 1, 'actif');

-- Passagers
INSERT INTO utilisateurs (nom, prenom, email, telephone, mot_de_passe, role, est_conducteur_valide, statut) VALUES
('Faye', 'Aminata', 'aminata.faye@example.com', '+221770000004', '$2b$10$.JMazSMmSm32WvhQJB2LruPPrGnYAu1X43.cbpUrsmccOOPdeoBgy', 'passager', 0, 'actif'),
('Gueye', 'Ibrahima', 'ibrahima.gueye@example.com', '+221770000005', '$2b$10$.JMazSMmSm32WvhQJB2LruPPrGnYAu1X43.cbpUrsmccOOPdeoBgy', 'passager', 0, 'actif'),
('Mbaye', 'Rokhaya', 'rokhaya.mbaye@example.com', '+221770000006', '$2b$10$.JMazSMmSm32WvhQJB2LruPPrGnYAu1X43.cbpUrsmccOOPdeoBgy', 'passager', 0, 'actif');

-- Admin
INSERT INTO utilisateurs (nom, prenom, email, telephone, mot_de_passe, role, est_conducteur_valide, statut) VALUES
('Admin', 'Kaay', 'admin2@kaaydem.sn', '+221700000002', '$2b$10$fZCKG/ccSt86czzx4/TVcuKvoig9ktaKiOqq85g2hQrExWAcCFpGq', 'admin', 0, 'actif');

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
    