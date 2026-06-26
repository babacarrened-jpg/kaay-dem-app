<?php
// app/controllers/ProfilController.php

class ProfilController extends Controller {
    private $userModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth/connexion');
        }

        $this->userModel = $this->model('User');
    }

    /**
     * Affiche la page du profil utilisateur
     */
    public function index() {
        $user = $this->userModel->getUserById($_SESSION['user_id']);

        if (!$user) {
            $this->redirect('auth/connexion');
        }

        $data = [
            'titre' => 'Mon profil - Kaay Dem !',
            'user' => $user
        ];

        $this->render('profil/index', $data);
    }
}
