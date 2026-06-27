<?php
// app/controllers/ConducteurController.php

class ConducteurController extends Controller {
    private $trajetModel;
    private $reservationModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth/connexion');
        }

        $roles = $_SESSION['user_roles'] ?? [$_SESSION['user_role'] ?? ''];
        if (!in_array('conducteur', $roles, true) && ($_SESSION['user_role'] ?? '') !== 'admin') {
            die('Accès refusé. Vous devez être un conducteur validé.');
        }

        $this->trajetModel = $this->model('Trajet');
        $this->reservationModel = $this->model('Reservation');
    }

    /**
     * Affiche le dashboard du conducteur
     */
    public function dashboard() {
        $trajets = $this->trajetModel->getByConducteur($_SESSION['user_id']);
        $activeTrajets = array_values(array_filter($trajets, function ($trajet) {
            return in_array($trajet->statut, ['planifie', 'en_cours'], true);
        }));

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
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('conducteur/reservations');
        }

        $detail = $this->reservationModel->getDetailForConducteur((int)$reservation_id);
        if (!$detail || (int)$detail->conducteur_id !== (int)$_SESSION['user_id']) {
            die('Accès refusé.');
        }

        if ($this->reservationModel->setStatus((int)$reservation_id, ReservationStatus::CONFIRMEE->value)) {
            $notif = $this->model('Notification');
            $title = 'Réservation confirmée';
            $message = "Votre réservation pour le trajet {$detail->ville_depart} → {$detail->ville_arrivee} du {$detail->date_trajet} a été confirmée par le conducteur.";
            $link = BASE_URL . 'passager/reservation/' . $reservation_id;
            $notif->create($detail->passager_id, $title, $message, 'nouvelle_reservation', $link);

            $this->redirect('conducteur/reservations?success=accept_ok');
        }

        $this->redirect('conducteur/reservations?error=accept_fail');
    }

    /**
     * Refuser / annuler une réservation (conducteur)
     */
    public function rejectReservation($reservation_id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('conducteur/reservations');
        }

        $detail = $this->reservationModel->getDetailForConducteur((int)$reservation_id);
        if (!$detail || (int)$detail->conducteur_id !== (int)$_SESSION['user_id']) {
            die('Accès refusé.');
        }

        if ($this->reservationModel->setStatus((int)$reservation_id, ReservationStatus::ANNULEE->value)) {
            $notif = $this->model('Notification');
            $title = 'Réservation refusée';
            $message = "Désolé, votre réservation pour le trajet {$detail->ville_depart} → {$detail->ville_arrivee} du {$detail->date_trajet} n'a pas été acceptée par le conducteur. Il y a désormais plus de places disponibles pour ce trajet.";
            $link = BASE_URL . 'passager/reservations';
            $notif->create($detail->passager_id, $title, $message, 'annulation_reservation', $link);

            $this->redirect('conducteur/reservations?success=reject_ok');
        }

        $this->redirect('conducteur/reservations?error=reject_fail');
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
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('conducteur/trajets/nouveau');
        }

        $postData = $this->getPostData();
        $vehiculeId = $this->getFirstVehiculeId((int)$_SESSION['user_id']);

        if (!$vehiculeId) {
            $this->redirect('conducteur/dashboard?error=vehicule_manquant');
        }

        $dateTrajet = $postData['date_trajet'] ?? '';
        $heureDepart = $postData['heure_depart'] ?? '';
        $placesTotales = max(1, (int)($postData['places_totales'] ?? 1));
        $prixParPlace = (float)($postData['prix_par_place'] ?? 0);

        if ($dateTrajet === '' || $heureDepart === '' || $prixParPlace <= 0) {
            $this->redirect('conducteur/trajets/nouveau?error=champs_manquants');
        }

        $db = new Database();
        $db->query('INSERT INTO trajets (conducteur_id, vehicule_id, ville_depart, point_depart, ville_arrivee, point_arrivee, date_trajet, heure_depart, prix_par_place, places_disponibles, places_totales, description, climatisation, musique, fumeur, statut) VALUES (:conducteur_id, :vehicule_id, :ville_depart, :point_depart, :ville_arrivee, :point_arrivee, :date_trajet, :heure_depart, :prix_par_place, :places_disponibles, :places_totales, :description, :climatisation, :musique, :fumeur, :statut)');
        $db->bind(':conducteur_id', $_SESSION['user_id']);
        $db->bind(':vehicule_id', $vehiculeId);
        $db->bind(':ville_depart', $postData['ville_depart'] ?? '');
        $db->bind(':point_depart', $postData['point_depart'] ?? null);
        $db->bind(':ville_arrivee', $postData['ville_arrivee'] ?? '');
        $db->bind(':point_arrivee', $postData['point_arrivee'] ?? null);
        $db->bind(':date_trajet', $dateTrajet);
        $db->bind(':heure_depart', $heureDepart);
        $db->bind(':prix_par_place', $prixParPlace);
        $db->bind(':places_disponibles', $placesTotales);
        $db->bind(':places_totales', $placesTotales);
        $db->bind(':description', $postData['description'] ?? null);
        $db->bind(':climatisation', !empty($postData['climatisation']) ? 1 : 0);
        $db->bind(':musique', !empty($postData['musique']) ? 1 : 0);
        $db->bind(':fumeur', !empty($postData['fumeur']) ? 1 : 0);
        $db->bind(':statut', 'planifie');

        if ($db->execute()) {
            $this->redirect('conducteur/dashboard?success=trajet_publie');
        }

        $this->redirect('conducteur/trajets/nouveau?error=trajet_echec');
    }

    private function getFirstVehiculeId(int $conducteurId): ?int {
        $db = new Database();
        $db->query('SELECT id FROM vehicules WHERE conducteur_id = :conducteur_id ORDER BY id ASC LIMIT 1');
        $db->bind(':conducteur_id', $conducteurId);
        $vehicule = $db->single();
        return $vehicule ? (int)$vehicule->id : null;
    }
}
