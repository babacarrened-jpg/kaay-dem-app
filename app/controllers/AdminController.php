<?php
// app/controllers/AdminController.php

class AdminController extends Controller {
    private $userModel;
    
    public function __construct() {
        if(!isset($_SESSION['user_id'])) {
            $this->redirect('auth/connexion');
        }

        // Sécurité : Seul l'admin peut accéder à ce contrôleur
        if($_SESSION['user_role'] != 'admin') {
            die("Accès non autorisé. Vous devez être administrateur.");
        }

        $this->userModel = $this->model('User');
    }

    /**
     * Affiche le dashboard d'administration
     */
    public function dashboard() {
        $demandes = $this->userModel->getPendingConducteurRequests();

        $data = [
            'titre' => 'Administration - Kaay Dem !',
            'stats' => [
                'utilisateurs' => count($this->userModel->findAll()),
                'trajets_actifs' => 0,
                'signalements' => 0
            ],
            'demandes_conducteur' => $demandes
        ];

        $this->render('admin/dashboard', $data);
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
