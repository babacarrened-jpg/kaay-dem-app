<?php
// app/controllers/PassagerController.php

class PassagerController extends Controller {
    private $reservationModel;
    private $trajetModel;

    public function __construct() {
        // Vérifier si l'utilisateur est connecté
        if(!isset($_SESSION['user_id'])) {
            $this->redirect('auth/connexion');
        }

        $this->reservationModel = $this->model('Reservation');
        $this->trajetModel = $this->model('Trajet');
    }

    /**
     * Affiche le dashboard du passager
     */
    public function dashboard() {
        // Récupérer les réservations
        $reservations = $this->reservationModel->getByPassager($_SESSION['user_id']);

        $data = [
            'titre' => 'Mon Espace Passager',
            'reservations' => $reservations
        ];

        $this->render('passager/dashboard', $data);
    }

    /**
     * Traite une demande de réservation
     */
    public function reserverTrajet($trajet_id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // Récupérer infos du trajet
            $trajet = $this->trajetModel->getById($trajet_id);

            if(!$trajet) {
                die("Trajet introuvable.");
            }

            // Empêcher le conducteur de réserver son propre trajet
            if($trajet->conducteur_id == $_SESSION['user_id']) {
                die("Vous ne pouvez pas réserver votre propre trajet.");
            }

            $places = 1; // Par défaut, 1 place (à rendre dynamique plus tard)
            $prix_total = $trajet->prix_par_place * $places;

            // Lancer la réservation
            try {
                if($this->reservationModel->reserver($trajet_id, $_SESSION['user_id'], $places, $prix_total)) {
                    $this->redirect('passager/dashboard?success=reservation_ok');
                } else {
                    $this->redirect('trajets/detail/' . $trajet_id . '?error=reservation_echec');
                }
            } catch (PlacesInsuffisantesException $e) {
                $this->redirect('trajets/detail/' . $trajet_id . '?error=places_insuffisantes');
            } catch (ReservationConflictException $e) {
                $this->redirect('trajets/detail/' . $trajet_id . '?error=reservation_conflit');
            }
        } else {
            $this->redirect('trajets/detail/' . $trajet_id);
        }
    }
}
