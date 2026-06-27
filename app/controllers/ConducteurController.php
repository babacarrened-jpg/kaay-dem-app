<?php
// app/controllers/ConducteurController.php

class ConducteurController extends Controller {
    private $trajetModel;
    private $reservationModel;
    private $vehiculeModel;

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
        $this->vehiculeModel = $this->model('Vehicule');
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
     * (redirige vers l'ajout de véhicule si le conducteur n'en a aucun)
     */
    public function nouveauTrajetForm() {
        if(!$this->vehiculeModel->conducteurAUnVehicule((int)$_SESSION['user_id'])) {
            $this->redirect('conducteur/vehicule/nouveau?retour=trajet');
        }

        $data = [
            'titre' => 'Publier un trajet'
        ];
        $this->render('conducteur/nouveau_trajet', $data);
    }

    /**
     * Traite la création d'un nouveau trajet
     */
    public function creerTrajet() {
        if($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->redirect('conducteur/trajets/nouveau');
            return;
        }

        $conducteurId = (int)$_SESSION['user_id'];

        // Le conducteur doit avoir au moins un véhicule pour publier
        $vehicule = $this->vehiculeModel->getPremierVehicule($conducteurId);
        if(!$vehicule) {
            $this->redirect('conducteur/vehicule/nouveau?retour=trajet');
            return;
        }

        $postData = $this->getPostData();

        // Validation simple des champs obligatoires
        $errors = [];
        if(empty($postData['ville_depart'])) { $errors[] = 'ville_depart'; }
        if(empty($postData['ville_arrivee'])) { $errors[] = 'ville_arrivee'; }
        if(empty($postData['date_trajet'])) { $errors[] = 'date_trajet'; }
        if(empty($postData['heure_depart'])) { $errors[] = 'heure_depart'; }
        if(empty($postData['places_totales']) || (int)$postData['places_totales'] < 1) { $errors[] = 'places_totales'; }
        if(empty($postData['prix_par_place']) || (float)$postData['prix_par_place'] <= 0) { $errors[] = 'prix_par_place'; }

        if(!empty($errors)) {
            $data = [
                'titre' => 'Publier un trajet',
                'erreur' => 'Veuillez remplir correctement tous les champs obligatoires.'
            ];
            $this->render('conducteur/nouveau_trajet', $data);
            return;
        }

        $trajetData = [
            'conducteur_id' => $conducteurId,
            'vehicule_id' => $vehicule->id,
            'ville_depart' => $postData['ville_depart'],
            'point_depart' => $postData['point_depart'] ?? '',
            'ville_arrivee' => $postData['ville_arrivee'],
            'point_arrivee' => $postData['point_arrivee'] ?? '',
            'date_trajet' => $postData['date_trajet'],
            'heure_depart' => $postData['heure_depart'],
            'prix_par_place' => (float)$postData['prix_par_place'],
            'places_totales' => (int)$postData['places_totales'],
            'description' => $postData['description'] ?? ''
        ];

        if($this->trajetModel->create($trajetData)) {
            $this->redirect('conducteur/dashboard?success=trajet_publie');
        } else {
            $data = [
                'titre' => 'Publier un trajet',
                'erreur' => "Une erreur est survenue lors de la publication du trajet. Réessayez."
            ];
            $this->render('conducteur/nouveau_trajet', $data);
        }
    }

    /**
     * Affiche le formulaire d'ajout de véhicule
     */
    public function nouveauVehiculeForm() {
        $data = [
            'titre' => 'Ajouter mon véhicule',
            'retour' => $_GET['retour'] ?? ''
        ];
        $this->render('conducteur/nouveau_vehicule', $data);
    }

    /**
     * Traite l'ajout d'un véhicule
     */
    public function creerVehicule() {
        if($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->redirect('conducteur/dashboard');
            return;
        }

        $postData = $this->getPostData();

        $errors = [];
        if(empty($postData['marque'])) { $errors[] = 'marque'; }
        if(empty($postData['modele'])) { $errors[] = 'modele'; }
        if(empty($postData['couleur'])) { $errors[] = 'couleur'; }
        if(empty($postData['immatriculation'])) { $errors[] = 'immatriculation'; }
        if(empty($postData['nombre_places']) || (int)$postData['nombre_places'] < 1) { $errors[] = 'nombre_places'; }

        if(!empty($errors)) {
            $data = [
                'titre' => 'Ajouter mon véhicule',
                'retour' => $_POST['retour'] ?? '',
                'erreur' => 'Veuillez remplir correctement tous les champs.'
            ];
            $this->render('conducteur/nouveau_vehicule', $data);
            return;
        }

        $ok = $this->vehiculeModel->ajouter((int)$_SESSION['user_id'], $postData);

        if($ok) {
            // Si l'utilisateur venait du formulaire de trajet, on l'y renvoie directement
            if(($postData['retour'] ?? '') === 'trajet') {
                $this->redirect('conducteur/trajets/nouveau');
            } else {
                $this->redirect('conducteur/dashboard?success=vehicule_ajoute');
            }
        } else {
            $data = [
                'titre' => 'Ajouter mon véhicule',
                'retour' => $_POST['retour'] ?? '',
                'erreur' => "Une erreur est survenue lors de l'ajout du véhicule. Réessayez."
            ];
            $this->render('conducteur/nouveau_vehicule', $data);
        }
    }
}