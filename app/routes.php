<?php
// app/routes.php

// ─── AUTH ───────────────────────────────────────────
$router->get('/', 'AuthController', 'index');
$router->get('/auth/connexion', 'AuthController', 'connexionForm');
$router->post('/auth/connexion', 'AuthController', 'connexion');
$router->get('/auth/inscription', 'AuthController', 'inscriptionForm');
$router->post('/auth/inscription', 'AuthController', 'inscription');
$router->get('/auth/deconnexion', 'AuthController', 'deconnexion');

// ─── CONDUCTEUR ─────────────────────────────────────
$router->get('/conducteur/dashboard', 'ConducteurController', 'dashboard');
$router->get('/conducteur/trajets', 'ConducteurController', 'mesTrajets');
$router->get('/conducteur/trajets/nouveau', 'ConducteurController', 'nouveauTrajetForm');
$router->post('/conducteur/trajets/nouveau', 'ConducteurController', 'creerTrajet');
$router->post('/conducteur/trajet/{trajet_id}/annuler', 'ConducteurController', 'annulerTrajet');
$router->get('/conducteur/reservations', 'ConducteurController', 'reservations');
$router->post('/conducteur/reservation/{reservation_id}/accepter', 'ConducteurController', 'acceptReservation');
$router->post('/conducteur/reservation/{reservation_id}/refuser', 'ConducteurController', 'rejectReservation');
$router->get('/conducteur/vehicule/nouveau', 'ConducteurController', 'nouveauVehiculeForm');
$router->post('/conducteur/vehicule/nouveau', 'ConducteurController', 'creerVehicule');
$router->get('/conducteur/passagers', 'ConducteurController', 'mesPassagers');

// ─── TRAJETS ────────────────────────────────────────
$router->get('/trajets/recherche', 'TrajetController', 'searchForm');   // ← remplace 'recherche' par 'searchForm'
$router->get('/trajets/resultats', 'TrajetController', 'searchResults');
