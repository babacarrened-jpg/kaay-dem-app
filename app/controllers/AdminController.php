<?php
// app/controllers/AdminController.php

class AdminController extends Controller {
    private $userModel;
    private $trajetModel;
    
    public function __construct() {
        if(!isset($_SESSION['user_id'])) {
            $this->redirect('auth/connexion');
        }

        // Sécurité : Seul l'admin peut accéder à ce contrôleur
        $roles = $_SESSION['user_roles'] ?? [$_SESSION['user_role'] ?? ''];
        if(!in_array('admin', $roles, true)) {
            die("Accès non autorisé. Vous devez être administrateur.");
        }

        $this->userModel = $this->model('User');
        $this->trajetModel = $this->model('Trajet');
    }

    /**
     * Affiche le dashboard d'administration
     */
    public function dashboard() {
        $demandes = $this->userModel->getPendingConducteurRequests();
        $allTrajets = $this->trajetModel->getAll();

        $data = [
            'titre' => 'Administration - Kaay Dem !',
            'stats' => [
                'utilisateurs' => count($this->userModel->findAll()),
                'trajets_actifs' => count($allTrajets),
                'signalements' => 0
            ],
            'demandes_conducteur' => $demandes
        ];

        $this->render('admin/dashboard', $data);
    }

    public function trajets() {
        $filters = [
            'statut' => $_GET['statut'] ?? '',
            'conducteur_id' => isset($_GET['conducteur_id']) && is_numeric($_GET['conducteur_id']) ? (int)$_GET['conducteur_id'] : '',
            'ville_depart' => trim($_GET['ville_depart'] ?? ''),
            'ville_arrivee' => trim($_GET['ville_arrivee'] ?? '')
        ];

        $conducteurs = $this->userModel->getConducteurs();
        $trajets = $this->trajetModel->getAll($filters);

        $data = [
            'titre' => 'Tous les trajets',
            'trajets' => $trajets,
            'conducteurs' => $conducteurs,
            'filters' => $filters
        ];

        $this->render('admin/trajets', $data);
    }

    /**
     * Valide un conducteur
     */
    public function validerConducteur($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->userModel->validateConducteur((int)$id, (int)$_SESSION['user_id']);
            $this->redirect('admin/dashboard?success=conducteur_valide');
        }

        $this->redirect('admin/dashboard');
    }

    /**
     * Refuse un conducteur
     */
    public function refuserConducteur($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->userModel->refuseConducteur((int)$id, (int)$_SESSION['user_id']);
            $this->redirect('admin/dashboard?success=conducteur_refuse');
        }

        $this->redirect('admin/dashboard');
    }
}
