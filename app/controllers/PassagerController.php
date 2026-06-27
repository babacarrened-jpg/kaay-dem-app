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
        // Récupérer les réservations récentes du passager
        $reservations = $this->reservationModel->getByPassager($_SESSION['user_id']);

        $data = [
            'titre' => 'Mon Espace Passager',
            'reservations' => $reservations
        ];

        $this->render('passager/dashboard', $data);
    }

    /**
     * Liste toutes les réservations du passager
     */
    public function reservations() {
        $reservations = $this->reservationModel->getByPassager($_SESSION['user_id']);

        $data = [
            'titre' => 'Mes réservations',
            'reservations' => $reservations
        ];

        $this->render('passager/reservations', $data);
    }

    /**
     * Affiche les détails et le suivi d'une réservation
     */
    public function reservation($id) {
        $reservation = $this->reservationModel->getDetailById((int)$id, $_SESSION['user_id']);

        if (!$reservation) {
            die("Réservation introuvable.");
        }

        $statusMessage = '';
        $alertType = 'info';

        switch ($reservation->statut) {
            case 'confirmee':
                $statusMessage = 'Votre réservation est confirmée. Préparez-vous à embarquer !';
                $alertType = 'success';
                break;
            case 'en_attente':
                $statusMessage = 'Votre réservation est en attente de confirmation du conducteur.';
                $alertType = 'warning';
                break;
            case 'termine':
                $statusMessage = 'Ce trajet est terminé. Merci d’avoir voyagé avec nous.';
                $alertType = 'secondary';
                break;
            case 'annulee':
                $statusMessage = 'Cette réservation a été annulée. Contactez le support pour plus d’informations.';
                $alertType = 'danger';
                break;
            default:
                $statusMessage = 'Statut de la réservation : ' . ucfirst(str_replace('_', ' ', $reservation->statut));
                break;
        }

        $data = [
            'titre' => 'Suivi de réservation',
            'reservation' => $reservation,
            'statusMessage' => $statusMessage,
            'alertType' => $alertType
        ];

        $this->render('passager/reservation', $data);
    }

    /**
     * Traite une demande de réservation
     */
    public function reserverTrajet($trajet_id = null) {
        if($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {
            $trajet_id = $trajet_id ?? ($_POST['trajet_id'] ?? $_GET['trajet_id'] ?? null);
            
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
