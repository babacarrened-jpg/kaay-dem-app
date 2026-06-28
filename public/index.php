<?php
// public/index.php (Front Controller)

session_start();

require_once '../app/config/config.php';
require_once '../app/core/Database.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Router.php';

$router = new Router();

// --- Pages Publiques ---
$router->get('/', 'HomeController', 'index');
$router->get('/a-propos', 'HomeController', 'about');
$router->get('/contact', 'HomeController', 'contact');
$router->post('/contact/envoyer', 'HomeController', 'envoyerContact');

// --- Auth ---
$router->get('/auth/connexion', 'AuthController', 'loginForm');
$router->post('/auth/connexion', 'AuthController', 'login');
$router->get('/auth/inscription', 'AuthController', 'registerForm');
$router->post('/auth/inscription', 'AuthController', 'register');
$router->get('/auth/deconnexion', 'AuthController', 'logout');

// --- Trajets ---
$router->get('/trajets/recherche', 'TrajetController', 'searchForm');
$router->get('/trajets/resultats', 'TrajetController', 'searchResults');
$router->get('/trajets/detail/{id}', 'TrajetController', 'detail');

// --- Passager ---
$router->get('/passager/dashboard', 'PassagerController', 'dashboard');
$router->get('/passager/reservations', 'PassagerController', 'reservations');
$router->get('/passager/reservation/{id}', 'PassagerController', 'reservation');
$router->get('/passager/reserver/{trajet_id}', 'PassagerController', 'reserverTrajet');
$router->post('/passager/reserver/{trajet_id}', 'PassagerController', 'reserverTrajet');
$router->get('/passager/devenirConducteur', 'PassagerController', 'devenirConducteurForm');
$router->post('/passager/devenirConducteur', 'PassagerController', 'devenirConducteur');
$router->post('/passager/reservation/{reservation_id}/annuler', 'PassagerController', 'annulerReservation');
// ✅ Avis
$router->get('/passager/reservation/{reservation_id}/avis', 'PassagerController', 'laisserAvis');
$router->post('/passager/reservation/{reservation_id}/avis', 'PassagerController', 'soumettreAvis');

// --- Conducteur ---
$router->get('/conducteur/dashboard', 'ConducteurController', 'dashboard');
$router->get('/conducteur/trajets', 'ConducteurController', 'mesTrajets');
$router->get('/conducteur/trajets/nouveau', 'ConducteurController', 'nouveauTrajetForm');
$router->post('/conducteur/trajets/nouveau', 'ConducteurController', 'creerTrajet');
$router->get('/conducteur/vehicule/nouveau', 'ConducteurController', 'nouveauVehiculeForm');
$router->post('/conducteur/vehicule/nouveau', 'ConducteurController', 'creerVehicule');
$router->post('/conducteur/trajet/{trajet_id}/annuler', 'ConducteurController', 'annulerTrajet');
$router->post('/conducteur/trajet/{trajet_id}/terminer', 'ConducteurController', 'terminerTrajet');
$router->get('/conducteur/trajet/{trajet_id}/passagers', 'ConducteurController', 'mesPassagers');
// Réservations
$router->get('/conducteur/reservations', 'ConducteurController', 'reservations');
// ✅ AJOUTER :
$router->get('/api/conducteur/reservations', 'ConducteurController', 'getReservationsAjax');
$router->get('/api/conducteur/reservations', 'ConducteurController', 'getReservationsAjax');
$router->post('/conducteur/reservation/{reservation_id}/accept', 'ConducteurController', 'acceptReservation');
$router->post('/conducteur/reservation/{reservation_id}/reject', 'ConducteurController', 'rejectReservation');
// ✅ Avis conducteur
$router->get('/conducteur/avis', 'ConducteurController', 'mesAvis');

// --- Profil ---
$router->get('/profil', 'ProfilController', 'index');

// --- Admin ---
$router->get('/admin/dashboard', 'AdminController', 'dashboard');
$router->get('/admin/trajets', 'AdminController', 'trajets');
$router->get('/admin/messages', 'AdminController', 'messages');
$router->post('/admin/messages/{id}/lu', 'AdminController', 'marquerMessageLu');
$router->post('/admin/validerConducteur/{id}', 'AdminController', 'validerConducteur');
$router->post('/admin/refuserConducteur/{id}', 'AdminController', 'refuserConducteur');

// ============================================
$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if (!empty($_GET['url'])) {
    $uri = '/' . trim($_GET['url'], '/');
}

$router->dispatch($uri, $method);