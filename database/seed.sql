-- ========================================================
-- DONNÉES DE TEST - KAAY DEM !
-- ========================================================
/*conducteur : conducteur123
    passager : passager123             ------------moguini-------
    admind : admin123@*/

-- Insérer des utilisateurs de test
INSERT INTO utilisateurs (nom, prenom, email, telephone, mot_de_passe, role, est_conducteur_valide, statut) VALUES
('Diallo', 'Amadou', 'amadou.diallo@example.com', '+221772345678', '$2y$10$R9q6TSKb4FuDJoF2y2jquewPKdtOg/gO2KHJRnmC3Vyoi..q0.Gea', 'conducteur', TRUE, 'actif'),
('Diop', 'Saliou', 'saliou.diop@example.com', '+221774567890', '$2y$10$R9q6TSKb4FuDJoF2y2jquewPKdtOg/gO2KHJRnmC3Vyoi..q0.Gea', 'conducteur', TRUE, 'actif'),
('Fall', 'Khady', 'khady.fall@example.com', '+221775678901', '$2y$10$R9q6TSKb4FuDJoF2y2jquewPKdtOg/gO2KHJRnmC3Vyoi..q0.Gea', 'conducteur', TRUE, 'actif'),
('Ndiaye', 'Aïssatou', 'aissatou.ndiaye@example.com', '+221783456789', '$2y$10$JriPwa58rpicSm1EU7l59.HwUjSSWEFWOA/YbTfQjmYrqeMXgc6tG', 'passager', FALSE, 'actif'),
('Seck', 'Moussa', 'moussa.seck@example.com', '+221794567890', '$2y$10$JriPwa58rpicSm1EU7l59.HwUjSSWEFWOA/YbTfQjmYrqeMXgc6tG', 'passager', FALSE, 'actif'),
('Admin', 'Super', 'admin@example.com', '+221700000000', '$2y$10$U4eH5fZG59Qh4sX8CQ2pJ.Z6y0A9o1f8YBrQ6s5Lx5fKzJj9j7Qm2', 'admin', FALSE, 'actif');

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
    