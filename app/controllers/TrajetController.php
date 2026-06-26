<?php
// app/controllers/TrajetController.php

class TrajetController extends Controller {
    private $trajetModel;

    public function __construct() {
        $this->trajetModel = $this->model('Trajet');
    }

    /**
     * Affiche la page de recherche avancée
     */
    public function searchForm() {
        $data = [
            'titre' => 'Rechercher un trajet'
        ];
        $this->render('trajets/recherche', $data);
    }

    /**
     * Affiche les résultats de la recherche
     */
    public function searchResults() {
        // Récupération des paramètres GET
        $depart = isset($_GET['depart']) ? trim($_GET['depart']) : '';
        $arrivee = isset($_GET['arrivee']) ? trim($_GET['arrivee']) : '';
        $date = isset($_GET['date']) ? trim($_GET['date']) : '';

        // Exécution de la recherche
        $trajets = $this->trajetModel->search($depart, $arrivee, $date);

        $data = [
            'titre' => 'Résultats de recherche',
            'depart' => $depart,
            'arrivee' => $arrivee,
            'date' => $date,
            'trajets' => $trajets
        ];

        $this->render('trajets/resultats', $data);
    }

    /**
     * Affiche le détail d'un trajet
     */
    public function detail($id) {
        $trajet = $this->trajetModel->getById($id);

        if(!$trajet) {
            die("Trajet introuvable.");
        }

        $data = [
            'titre' => 'Détail du trajet ' . $trajet->ville_depart . ' - ' . $trajet->ville_arrivee,
            'trajet' => $trajet
        ];

        $this->render('trajets/detail', $data);
    }
}
