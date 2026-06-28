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

        // Récupération des statistiques
        $trajetsByMonth = $this->trajetModel->getTrajetsByMonth();
        $tauxOccupation = $this->trajetModel->getTauxOccupationByMonth();
        $topConducteurs = $this->trajetModel->getTopConducteurs(5);

        // Tous les mois de l'année
        $mois = [
            'Janvier',
            'Février',
            'Mars',
            'Avril',
            'Mai',
            'Juin',
            'Juillet',
            'Août',
            'Septembre',
            'Octobre',
            'Novembre',
            'Décembre'
        ];

        /*
        |--------------------------------------------------------------------------
        | Trajets par mois
        |--------------------------------------------------------------------------
        */

        $trajetsComplets = [];

        foreach ($mois as $m) {

            $nb = 0;

            foreach ($trajetsByMonth as $t) {

                if ($t->mois_label === $m) {
                    $nb = (int)$t->total;
                    break;
                }
            }

            $trajetsComplets[] = (object)[
                'mois_label' => $m,
                'total' => $nb
            ];
        }

        $trajetsByMonth = $trajetsComplets;

        /*
        |--------------------------------------------------------------------------
        | Taux d'occupation
        |--------------------------------------------------------------------------
        */

        $occupationComplete = [];

        foreach ($mois as $m) {

            $taux = 0;

            foreach ($tauxOccupation as $o) {

                if ($o->mois_label === $m) {
                    $taux = (float)$o->taux_occupation;
                    break;
                }
            }

            $occupationComplete[] = (object)[
                'mois_label' => $m,
                'taux_occupation' => $taux
            ];
        }

        $tauxOccupation = $occupationComplete;

        $data = [

            'titre' => 'Administration - Kaay Dem !',

            'stats' => [
                'utilisateurs'   => count($this->userModel->findAll()),
                'trajets_actifs' => count($allTrajets),
                'signalements'   => 0
            ],

            'demandes_conducteur' => $demandes,

            'trajets_by_month' => $trajetsByMonth,

            'taux_occupation' => $tauxOccupation,

            'top_conducteurs' => $topConducteurs,
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