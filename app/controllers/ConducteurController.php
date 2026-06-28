<?php
// app/controllers/ConducteurController.php

class ConducteurController extends Controller {
    private $trajetModel;
    private $reservationModel;
    private $vehiculeModel;

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
        $this->vehiculeModel = $this->model('Vehicule');
    }

    /**
     * Affiche le dashboard du conducteur
     */
    public function dashboard() {
        // Clôture automatique des trajets dont la date/heure est dépassée
        $this->trajetModel->cloturerTrajetsPasses((int)$_SESSION['user_id']);

        $trajets = $this->trajetModel->getByConducteur($_SESSION['user_id']);
        $activeTrajets = array_values(array_filter($trajets, function ($trajet) {
            return in_array($trajet->statut, ['planifie', 'en_cours'], true);
        }));

        $pendingReservations = $this->reservationModel->getPendingByConducteur($_SESSION['user_id']);

        $data = [
            'titre' => 'Espace Conducteur',
            'trajets_actifs' => count($activeTrajets),
            'gains_mois' => $this->reservationModel->getGainsMoisCourant((int)$_SESSION['user_id']),
            'reservations_attente' => is_array($pendingReservations) ? count($pendingReservations) : 0,
            'trajets' => $activeTrajets
        ];

        $this->render('conducteur/dashboard', $data);
    }

    /**
     * Affiche la liste des trajets du conducteur
     */
    public function mesTrajets() {
        $this->trajetModel->cloturerTrajetsPasses((int)$_SESSION['user_id']);
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
     * (redirige vers l'ajout de véhicule si le conducteur n'en a aucun)
     */
    public function nouveauTrajetForm() {
    $conducteurId = (int)$_SESSION['user_id'];
    $vehicules = $this->vehiculeModel->getByConducteur($conducteurId);

    // Aucun véhicule → rediriger vers l'ajout
    if (empty($vehicules)) {
        $this->redirect('conducteur/vehicule/nouveau?retour=trajet');
    }

    $data = [
        'titre'    => 'Publier un trajet',
        'vehicules' => $vehicules
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

    $conducteurId = (int)$_SESSION['user_id'];
    $vehicules = $this->vehiculeModel->getByConducteur($conducteurId);

    if (empty($vehicules)) {
        $this->redirect('conducteur/vehicule/nouveau?retour=trajet');
    }

    $postData = $this->getPostData();

    // Si plusieurs véhicules → prendre celui sélectionné, sinon le premier
    if (count($vehicules) > 1) {
        $vehiculeId = (int)($postData['vehicule_id'] ?? 0);
        $vehicule = $this->vehiculeModel->findById($vehiculeId);
        if (!$vehicule || (int)$vehicule->conducteur_id !== $conducteurId) {
            $data = ['titre' => 'Publier un trajet', 'vehicules' => $vehicules, 'erreur' => 'Veuillez sélectionner un véhicule valide.'];
            $this->render('conducteur/nouveau_trajet', $data);
            return;
        }
    } else {
        $vehicule = $vehicules[0];
    }

    $dateTrajet    = $postData['date_trajet'] ?? '';
    $heureDepart   = $postData['heure_depart'] ?? '';
    $placesTotales = max(1, (int)($postData['places_totales'] ?? 1));
    $prixParPlace  = (float)($postData['prix_par_place'] ?? 0);

    $errors = [];
    if (empty($postData['ville_depart']))  { $errors[] = 'ville_depart'; }
    if (empty($postData['ville_arrivee'])) { $errors[] = 'ville_arrivee'; }
    if ($dateTrajet === '')                { $errors[] = 'date_trajet'; }
    if ($heureDepart === '')               { $errors[] = 'heure_depart'; }
    if ($prixParPlace <= 0)                { $errors[] = 'prix_par_place'; }

    if (!empty($errors)) {
        $data = ['titre' => 'Publier un trajet', 'vehicules' => $vehicules, 'erreur' => 'Veuillez remplir correctement tous les champs obligatoires.'];
        $this->render('conducteur/nouveau_trajet', $data);
        return;
    }

    $trajetData = [
        'conducteur_id' => $conducteurId,
        'vehicule_id'   => $vehicule->id,
        'ville_depart'  => $postData['ville_depart'],
        'point_depart'  => $postData['point_depart'] ?? '',
        'ville_arrivee' => $postData['ville_arrivee'],
        'point_arrivee' => $postData['point_arrivee'] ?? '',
        'date_trajet'   => $dateTrajet,
        'heure_depart'  => $heureDepart,
        'prix_par_place' => $prixParPlace,
        'places_totales' => $placesTotales,
        'description'   => $postData['description'] ?? '',
        'climatisation' => !empty($postData['climatisation']),
        'musique'       => !empty($postData['musique']),
        'fumeur'        => !empty($postData['fumeur'])
    ];

    if ($this->trajetModel->create($trajetData)) {
        $this->redirect('conducteur/dashboard?success=trajet_publie');
    }

    $data = ['titre' => 'Publier un trajet', 'vehicules' => $vehicules, 'erreur' => 'Une erreur est survenue. Réessayez.'];
    $this->render('conducteur/nouveau_trajet', $data);
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
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('conducteur/dashboard');
        }

        $postData = $this->getPostData();

        $errors = [];
        if (empty($postData['marque'])) { $errors[] = 'marque'; }
        if (empty($postData['modele'])) { $errors[] = 'modele'; }
        if (empty($postData['couleur'])) { $errors[] = 'couleur'; }
        if (empty($postData['immatriculation'])) { $errors[] = 'immatriculation'; }
        if (empty($postData['nombre_places']) || (int)$postData['nombre_places'] < 1) { $errors[] = 'nombre_places'; }

        if (!empty($errors)) {
            $data = [
                'titre' => 'Ajouter mon véhicule',
                'retour' => $_POST['retour'] ?? '',
                'erreur' => 'Veuillez remplir correctement tous les champs.'
            ];
            $this->render('conducteur/nouveau_vehicule', $data);
            return;
        }

        $ok = $this->vehiculeModel->ajouter((int)$_SESSION['user_id'], $postData);

        if ($ok) {
            if (($postData['retour'] ?? '') === 'trajet') {
                $this->redirect('conducteur/trajets/nouveau');
            }
            $this->redirect('conducteur/dashboard?success=vehicule_ajoute');
        }

        $data = [
            'titre' => 'Ajouter mon véhicule',
            'retour' => $_POST['retour'] ?? '',
            'erreur' => "Une erreur est survenue lors de l'ajout du véhicule. Réessayez."
        ];
        $this->render('conducteur/nouveau_vehicule', $data);
    }

    /**
     * Annule un trajet publié (si aucune réservation confirmée)
     */
    public function annulerTrajet($trajet_id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('conducteur/trajets');
        }

        $ok = $this->trajetModel->annuler((int)$trajet_id, (int)$_SESSION['user_id']);

        if ($ok) {
            $this->redirect('conducteur/trajets?success=trajet_annule');
        }

        $this->redirect('conducteur/trajets?error=annulation_impossible');
    }

    /**
     * Clôture manuelle d'un trajet par son conducteur (avant l'heure prévue par ex.)
     */
    public function terminerTrajet($trajet_id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('conducteur/trajets');
        }

        $ok = $this->trajetModel->terminer((int)$trajet_id, (int)$_SESSION['user_id']);

        if ($ok) {
            $this->redirect('conducteur/trajets?success=trajet_termine');
        }

        $this->redirect('conducteur/trajets?error=cloture_impossible');
    }

    /**
     * Affiche les passagers d'un trajet précis (vérifie que ce trajet
     * appartient bien au conducteur connecté)
     */
    public function mesPassagers($trajet_id) {
        $conducteurId = (int)$_SESSION['user_id'];
        $trajetId = (int)$trajet_id;

        $trajet = $this->trajetModel->getById($trajetId);
        if (!$trajet || (int)$trajet->conducteur_id !== $conducteurId) {
            die('Accès refusé.');
        }

        $passagers = $this->reservationModel->getPassagersByTrajet($trajetId, $conducteurId);

        $data = [
            'titre' => 'Passagers du trajet',
            'trajet' => $trajet,
            'passagers' => $passagers
        ];

        $this->render('conducteur/mes_passagers', $data);
    }
}