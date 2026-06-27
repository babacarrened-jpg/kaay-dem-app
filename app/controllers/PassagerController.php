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
            $this->redirect('passager/reservations?error=reservation_introuvable');
        }

        $statusMessage = '';
        $alertType = 'info';
        $canCancel = in_array($reservation->statut, [ReservationStatus::EN_ATTENTE->value, ReservationStatus::CONFIRMEE->value], true);

        switch ($reservation->statut) {
            case ReservationStatus::CONFIRMEE->value:
                $statusMessage = 'Votre réservation est confirmée. Préparez-vous à embarquer !';
                $alertType = 'success';
                break;
            case ReservationStatus::EN_ATTENTE->value:
                $statusMessage = 'Votre réservation est en attente de confirmation du conducteur.';
                $alertType = 'warning';
                break;
            case ReservationStatus::TERMINEE->value:
                $statusMessage = 'Ce trajet est terminé. Merci d’avoir voyagé avec nous.';
                $alertType = 'secondary';
                break;
            case ReservationStatus::ANNULEE->value:
                $statusMessage = 'Cette réservation a été annulée. Contactez le support pour plus d’informations.';
                $alertType = 'danger';
                break;
            case 'refusee':
                $statusMessage = 'Le conducteur a refusé votre réservation.';
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
            'alertType' => $alertType,
            'canCancel' => $canCancel
        ];

        $this->render('passager/reservation', $data);
    }

    public function annulerReservation($reservation_id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('passager/reservations');
        }

        $reservation_id = (int)$reservation_id;
        $ok = $this->reservationModel->cancelByPassager($reservation_id, (int)$_SESSION['user_id']);

        if ($ok) {
            $this->redirect('passager/reservation/' . $reservation_id . '?success=reservation_annulee');
        }

        $this->redirect('passager/reservation/' . $reservation_id . '?error=annulation_impossible');
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

    public function devenirConducteurForm() {
    // Vérifier si déjà conducteur
    if($_SESSION['user_role'] === 'conducteur' || $_SESSION['est_conducteur_valide']) {
        $this->redirect('conducteur/dashboard');
    }

    $data = ['titre' => 'Devenir Conducteur - Kaay Dem !'];
    $this->render('passager/devenir_conducteur', $data);
}

public function devenirConducteur() {
    if($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $this->redirect('passager/dashboard');
    }

    // Vérifier les fichiers
    if(empty($_FILES['permis_recto']['name']) || empty($_FILES['permis_verso']['name'])) {
        $this->redirect('passager/devenirConducteur?error=fichiers_manquants');
    }

    // Dossier upload
    $uploadDir = '../public/assets/uploads/permis/';
    if(!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Upload recto
    $rectoExt = pathinfo($_FILES['permis_recto']['name'], PATHINFO_EXTENSION);
    $rectoName = 'permis_' . $_SESSION['user_id'] . '_recto_' . time() . '.' . $rectoExt;
    move_uploaded_file($_FILES['permis_recto']['tmp_name'], $uploadDir . $rectoName);

    // Upload verso
    $versoExt = pathinfo($_FILES['permis_verso']['name'], PATHINFO_EXTENSION);
    $versoName = 'permis_' . $_SESSION['user_id'] . '_verso_' . time() . '.' . $versoExt;
    move_uploaded_file($_FILES['permis_verso']['tmp_name'], $uploadDir . $versoName);

    $userModel = $this->model('User');
    $result = $userModel->demanderConducteur((int)$_SESSION['user_id'], $rectoName, $versoName);

    if($result) {
        $this->redirect('passager/dashboard?success=demande_envoyee');
    } else {
        $this->redirect('passager/devenirConducteur?error=demande_existante');
    }
}

}
