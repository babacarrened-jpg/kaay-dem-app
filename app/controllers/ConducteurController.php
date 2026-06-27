<?php
// app/controllers/ConducteurController.php

class ConducteurController extends Controller {
    private $trajetModel;
    private $reservationModel;

    public function __construct() {
        if(!isset($_SESSION['user_id'])) {
            $this->redirect('auth/connexion');
        }

        // Vérifier si l'utilisateur a le rôle conducteur ou un conducteur validé
        $roles = $_SESSION['user_roles'] ?? [$_SESSION['user_role'] ?? ''];
        if(!in_array('conducteur', $roles, true) && $_SESSION['user_role'] != 'admin') {
            die("Accès refusé. Vous devez être un conducteur validé.");
        }

        $this->trajetModel = $this->model('Trajet');
        $this->reservationModel = $this->model('Reservation');
    }

    /**
     * Affiche le dashboard du conducteur
     */
    public function dashboard() {
        $trajets = $this->trajetModel->getByConducteur($_SESSION['user_id']);
        $activeTrajets = array_values(array_filter($trajets, function($trajet) {
            return in_array($trajet->statut, ['planifie', 'en_cours'], true);
        }));

        // Compter les réservations en attente pour les trajets de ce conducteur
        $pendingReservations = $this->reservationModel->getPendingByConducteur($_SESSION['user_id']);

        $data = [
            'titre' => 'Espace Conducteur',
            'trajets_actifs' => count($activeTrajets),
            'gains_mois' => 15000,
            'reservations_attente' => is_array($pendingReservations) ? count($pendingReservations) : 0,
            'trajets' => $activeTrajets
        ];

        $this->render('conducteur/dashboard', $data);
    }

    /**
     * Affiche la liste des trajets du conducteur
     */
    public function mesTrajets() {
        $trajets = $this->trajetModel->getByConducteur($_SESSION['user_id']);

        $data = [
            'titre' => 'Mes trajets',
            'trajets' => $trajets
        ];

        $this->render('conducteur/mes_trajets', $data);
    }

    /**
     * Liste les réservations en attente pour les trajets du conducteur
     */
    public function reservations() {
        $reservations = $this->reservationModel->getPendingByConducteur($_SESSION['user_id']);

        $data = [
            'titre' => 'Réservations en attente',
            'reservations' => $reservations
        ];

        $this->render('conducteur/reservations', $data);
    }

    /**
     * Accepter une réservation (conducteur)
     */
    public function acceptReservation($reservation_id) {
        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('conducteur/reservations');
        }

        $detail = $this->reservationModel->getDetailForConducteur((int)$reservation_id);
        if(!$detail || $detail->conducteur_id != $_SESSION['user_id']) {
            die('Accès refusé.');
        }

        if($this->reservationModel->setStatus((int)$reservation_id, ReservationStatus::CONFIRMEE->value)) {
            // Notifier le passager
            $notif = $this->model('Notification');
            $title = 'Réservation confirmée';
            $message = "Votre réservation pour le trajet {$detail->ville_depart} → {$detail->ville_arrivee} du {$detail->date_trajet} a été confirmée par le conducteur.";
            $link = BASE_URL . 'passager/reservation/' . $reservation_id;
            $notif->create($detail->passager_id, $title, $message, 'nouvelle_reservation', $link);

            $this->redirect('conducteur/reservations?success=accept_ok');
        } else {
            $this->redirect('conducteur/reservations?error=accept_fail');
        }
    }

    /**
     * Refuser / annuler une réservation (conducteur)
     */
    public function rejectReservation($reservation_id) {
        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('conducteur/reservations');
        }

        $detail = $this->reservationModel->getDetailForConducteur((int)$reservation_id);
        if(!$detail || $detail->conducteur_id != $_SESSION['user_id']) {
            die('Accès refusé.');
        }

        if($this->reservationModel->setStatus((int)$reservation_id, ReservationStatus::ANNULEE->value)) {
            // Notifier le passager de l'annulation
            $notif = $this->model('Notification');
            $title = 'Réservation refusée';
            $message = "Désolé, votre réservation pour le trajet {$detail->ville_depart} → {$detail->ville_arrivee} du {$detail->date_trajet} n'a pas été acceptée par le conducteur. Il y a désormais plus de places disponibles pour ce trajet.";
            $link = BASE_URL . 'passager/reservations';
            $notif->create($detail->passager_id, $title, $message, 'annulation_reservation', $link);

            $this->redirect('conducteur/reservations?success=reject_ok');
        } else {
            $this->redirect('conducteur/reservations?error=reject_fail');
        }
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
