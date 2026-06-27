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
        $prix_min = isset($_GET['prix_min']) ? trim($_GET['prix_min']) : '';
        $prix_max = isset($_GET['prix_max']) ? trim($_GET['prix_max']) : '';
        $places_min = isset($_GET['places_min']) ? trim($_GET['places_min']) : '';
        $places_max = isset($_GET['places_max']) ? trim($_GET['places_max']) : '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        // Exécution de la recherche
        $result = $this->trajetModel->search($depart, $arrivee, $date, $prix_min, $prix_max, $places_min, $places_max, $page, 8);

        $data = [
            'titre' => 'Résultats de recherche',
            'depart' => $depart,
            'arrivee' => $arrivee,
            'date' => $date,
            'prix_min' => $prix_min,
            'prix_max' => $prix_max,
            'places_min' => $places_min,
            'places_max' => $places_max,
            'trajets' => $result['trajets'],
            'pagination' => $result['pagination']
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

        $message = null;
        $alertType = null;
        if(isset($_GET['error'])) {
            switch($_GET['error']) {
                case 'places_insuffisantes':
                    $message = 'Désolé, il ne reste plus assez de places disponibles.';
                    $alertType = 'danger';
                    break;
                case 'reservation_conflit':
                    $message = 'Vous avez déjà une réservation sur un trajet qui se déroule le même jour.';
                    $alertType = 'warning';
                    break;
                case 'reservation_echec':
                    $message = 'La réservation n’a pas pu être finalisée. Réessayez plus tard.';
                    $alertType = 'danger';
                    break;
            }
        }

        $data = [
            'titre' => 'Détail du trajet ' . $trajet->ville_depart . ' - ' . $trajet->ville_arrivee,
            'trajet' => $trajet,
            'message' => $message,
            'alertType' => $alertType
        ];

        $this->render('trajets/detail', $data);
    }
}
