<?php
// public/index.php (Front Controller)

// Démarrage de la session
session_start();

// Chargement des fichiers de configuration et du cœur de l'application
require_once '../app/config/config.php';
require_once '../app/core/Database.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Router.php';

// Initialisation du routeur
$router = new Router();

// ============================================
// DÉFINITION DES ROUTES
// ============================================

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

// --- Trajets (Recherche & Détails) ---
$router->get('/trajets/recherche', 'TrajetController', 'searchForm');
$router->get('/trajets/resultats', 'TrajetController', 'searchResults');
$router->get('/trajets/detail/{id}', 'TrajetController', 'detail');

// --- Passager ---
$router->get('/passager/dashboard', 'PassagerController', 'dashboard');
$router->get('/passager/reservations', 'PassagerController', 'reservations');
$router->get('/passager/reservation/{id}', 'PassagerController', 'reservation');
$router->get('/passager/reserver/{trajet_id}', 'PassagerController', 'reserverTrajet');
$router->post('/passager/reserver/{trajet_id}', 'PassagerController', 'reserverTrajet');

// --- Conducteur ---
$router->get('/conducteur/dashboard', 'ConducteurController', 'dashboard');
$router->get('/conducteur/trajets', 'ConducteurController', 'mesTrajets');
$router->get('/conducteur/trajets/nouveau', 'ConducteurController', 'nouveauTrajetForm');
$router->post('/conducteur/trajets/nouveau', 'ConducteurController', 'creerTrajet');
$router->get('/conducteur/vehicule/nouveau', 'ConducteurController', 'nouveauVehiculeForm');
$router->post('/conducteur/vehicule/nouveau', 'ConducteurController', 'creerVehicule');
$router->post('/conducteur/trajet/{trajet_id}/annuler', 'ConducteurController', 'annulerTrajet');
$router->get('/conducteur/trajet/{trajet_id}/passagers', 'ConducteurController', 'mesPassagers');

// Gestion des réservations pour conducteurs
$router->get('/conducteur/reservations', 'ConducteurController', 'reservations');
$router->post('/conducteur/reservation/{reservation_id}/accept', 'ConducteurController', 'acceptReservation');
$router->post('/conducteur/reservation/{reservation_id}/reject', 'ConducteurController', 'rejectReservation');

// --- Profil ---
$router->get('/profil', 'ProfilController', 'index');

// --- Admin ---
$router->get('/admin/dashboard', 'AdminController', 'dashboard');
$router->get('/admin/trajets', 'AdminController', 'trajets');
$router->get('/admin/messages', 'AdminController', 'messages');
$router->post('/admin/messages/{id}/lu', 'AdminController', 'marquerMessageLu');
$router->post('/admin/validerConducteur/{id}', 'AdminController', 'validerConducteur');
$router->post('/admin/refuserConducteur/{id}', 'AdminController', 'refuserConducteur');

<<<<<<< HEAD
// Dans la section --- Passager ---
$router->get('/passager/devenirConducteur', 'PassagerController', 'devenirConducteurForm');
$router->post('/passager/devenirConducteur', 'PassagerController', 'devenirConducteur');
=======
$router->post('/passager/reservation/{reservation_id}/annuler', 'PassagerController', 'annulerReservation');
// Ajoute cette ligne dans public/index.php (section Conducteur)
$router->post('/conducteur/trajet/{trajet_id}/terminer', 'ConducteurController', 'terminerTrajet');
// Ajouter dans la section --- Passager ---
$router->get('/passager/reservation/{reservation_id}/avis', 'PassagerController', 'laisserAvis');
$router->post('/passager/reservation/{reservation_id}/avis', 'PassagerController', 'soumettreAvis');

// Dans la section --- Conducteur ---
$router->get('/conducteur/avis', 'ConducteurController', 'mesAvis');
>>>>>>> 58d3db4fb2c01afdc416c23bf1e43e3e97366bf0


// ============================================
// EXÉCUTION DU ROUTAGE
// ============================================

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Si passage via ?url=
if (!empty($_GET['url'])) {
    $uri = '/' . trim($_GET['url'], '/');
}

$router->dispatch($uri, $method);