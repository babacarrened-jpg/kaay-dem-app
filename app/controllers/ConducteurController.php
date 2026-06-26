<?php
// app/controllers/ConducteurController.php

class ConducteurController extends Controller {
    private $trajetModel;
    private $reservationModel;

    public function __construct() {
        if(!isset($_SESSION['user_id'])) {
            $this->redirect('auth/connexion');
        }

        // Vérifier si l'utilisateur a le rôle conducteur et est validé
        if($_SESSION['user_role'] != 'conducteur' && $_SESSION['user_role'] != 'admin') {
            die("Accès refusé. Vous devez être un conducteur validé.");
        }

        $this->trajetModel = $this->model('Trajet');
        $this->reservationModel = $this->model('Reservation');
    }

    /**
     * Affiche le dashboard du conducteur
     */
    public function dashboard() {
        // En vrai, il faudrait récupérer uniquement les trajets du conducteur connecté
        // $trajets = $this->trajetModel->getByConducteur($_SESSION['user_id']);
        
        $data = [
            'titre' => 'Espace Conducteur',
            'trajets_actifs' => 2, // Dummy data
            'gains_mois' => 15000, // Dummy data
            'reservations_attente' => 3 // Dummy data
        ];

        $this->render('conducteur/dashboard', $data);
    }

    /**
     * Affiche le formulaire de création de trajet
     */
    public function nouveauTrajetForm() {
        $data = [
            'titre' => 'Publier un trajet'
        ];
        $this->render('conducteur/nouveau_trajet', $data);
    }

    /**
     * Traite la création d'un nouveau trajet
     */
    public function creerTrajet() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postData = $this->getPostData();

            // Ici on devrait appeler le TrajetModel pour faire l'INSERT INTO trajets
            // ...
            // Pour l'exercice, on redirige avec succès
            
            $this->redirect('conducteur/dashboard?success=trajet_publie');
        } else {
            $this->redirect('conducteur/trajets/nouveau');
        }
    }
}
