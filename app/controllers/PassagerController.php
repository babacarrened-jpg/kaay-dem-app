<?php
// app/controllers/PassagerController.php

class PassagerController extends Controller {
    private $reservationModel;
    private $trajetModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth/connexion');
        }

        $this->reservationModel = $this->model('Reservation');
        $this->trajetModel = $this->model('Trajet');
    }

    /**
     * Affiche le dashboard du passager
     */
    public function dashboard() {
        $reservations = $this->reservationModel->getByPassager($_SESSION['user_id']);

        // Statut de la demande "devenir conducteur" (s'il y en a une), pour affichage du suivi
        $userModel = $this->model('User');
        $demandeConducteur = $userModel->getDemandeConducteur((int)$_SESSION['user_id']);

        $data = [
            'titre' => 'Mon Espace Passager',
            'reservations' => $reservations,
            'demandeConducteur' => $demandeConducteur
        ];

        $this->render('passager/dashboard', $data);
    }

    /**
     * Liste toutes les réservations du passager
     */
    public function reservations() {
        $reservations = $this->reservationModel->getByPassager($_SESSION['user_id']);

        // Pré-calculer quels trajets ont déjà été notés par ce passager
        // (fait ici car la vue ne peut pas charger les modèles directement)
        $avisModel = $this->model('Avis');
        $trajetsDejaNote = [];
        foreach (($reservations ?? []) as $res) {
            if ($avisModel->dejaNote((int)$res->trajet_id, (int)$_SESSION['user_id'])) {
                $trajetsDejaNote[] = (int)$res->trajet_id;
            }
        }

        $data = [
            'titre' => 'Mes réservations',
            'reservations' => $reservations,
            'trajetsDejaNote' => $trajetsDejaNote
        ];

        $this->render('passager/reservations', $data);
    }

    /**
     * Affiche les détails d'une réservation
     */
    public function reservation($id) {
        $reservation = $this->reservationModel->getDetailById((int)$id, $_SESSION['user_id']);

        if (!$reservation) {
            $this->redirect('passager/reservations?error=reservation_introuvable');
        }

        $statusMessage = '';
        $alertType = 'info';
        $canCancel = in_array($reservation->statut, [
            ReservationStatus::EN_ATTENTE->value,
            ReservationStatus::CONFIRMEE->value
        ], true);

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
                $statusMessage = 'Ce trajet est terminé. Merci d\'avoir voyagé avec nous.';
                $alertType = 'secondary';
                break;
            case ReservationStatus::ANNULEE->value:
                $statusMessage = 'Cette réservation a été annulée.';
                $alertType = 'danger';
                break;
            case 'refusee':
                $statusMessage = 'Le conducteur a refusé votre réservation.';
                $alertType = 'danger';
                break;
            default:
                $statusMessage = 'Statut : ' . ucfirst(str_replace('_', ' ', $reservation->statut));
                break;
        }

        $data = [
            'titre'         => 'Suivi de réservation',
            'reservation'   => $reservation,
            'statusMessage' => $statusMessage,
            'alertType'     => $alertType,
            'canCancel'     => $canCancel
        ];

        $this->render('passager/reservation', $data);
    }

    /**
     * Annuler une réservation (passager)
     */
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
     * Réserver un trajet (GET = formulaire, POST = traitement)
     */
    public function reserverTrajet($trajet_id = null) {
        $trajet_id = $trajet_id ?? ($_POST['trajet_id'] ?? $_GET['trajet_id'] ?? null);
        $trajet = $this->trajetModel->getById($trajet_id);

        if (!$trajet) {
            $this->redirect('trajets/recherche?error=trajet_introuvable');
        }

        // Empêcher le conducteur de réserver son propre trajet
        if ((int)$trajet->conducteur_id === (int)$_SESSION['user_id']) {
            $this->redirect('trajets/detail/' . $trajet_id . '?error=proprio_trajet');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Afficher le formulaire de confirmation
            $data = [
                'titre'  => 'Confirmer la réservation',
                'trajet' => $trajet
            ];
            $this->render('passager/confirmer_reservation', $data);
            return;
        }

        // POST : traiter la réservation
        $places    = max(1, (int)($_POST['places'] ?? 1));
        $prixTotal = $trajet->prix_par_place * $places;

        try {
            if ($this->reservationModel->reserver($trajet_id, $_SESSION['user_id'], $places, $prixTotal)) {
                $this->redirect('passager/reservations?success=reservation_ok');
            } else {
                $this->redirect('trajets/detail/' . $trajet_id . '?error=reservation_echec');
            }
        } catch (PlacesInsuffisantesException $e) {
            $this->redirect('trajets/detail/' . $trajet_id . '?error=places_insuffisantes');
        } catch (ReservationConflictException $e) {
            $this->redirect('trajets/detail/' . $trajet_id . '?error=reservation_conflit');
        }
    }

    /**
     * Formulaire devenir conducteur
     */
    public function devenirConducteurForm() {
        if ($_SESSION['user_role'] === 'conducteur' || !empty($_SESSION['est_conducteur_valide'])) {
            $this->redirect('conducteur/dashboard');
        }

        $userModel = $this->model('User');
        $demandeConducteur = $userModel->getDemandeConducteur((int)$_SESSION['user_id']);

        $data = [
            'titre' => 'Devenir Conducteur - Kaay Dem !',
            'demandeConducteur' => $demandeConducteur
        ];
        $this->render('passager/devenir_conducteur', $data);
    }

    /**
     * Traitement demande devenir conducteur
     */
    public function devenirConducteur() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('passager/dashboard');
        }

        if (empty($_FILES['permis_recto']['name']) || empty($_FILES['permis_verso']['name'])) {
            $this->redirect('passager/devenirConducteur?error=fichiers_manquants');
        }

        $uploadDir = '../public/assets/uploads/permis/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $rectoExt  = pathinfo($_FILES['permis_recto']['name'], PATHINFO_EXTENSION);
        $rectoName = 'permis_' . $_SESSION['user_id'] . '_recto_' . time() . '.' . $rectoExt;
        move_uploaded_file($_FILES['permis_recto']['tmp_name'], $uploadDir . $rectoName);

        $versoExt  = pathinfo($_FILES['permis_verso']['name'], PATHINFO_EXTENSION);
        $versoName = 'permis_' . $_SESSION['user_id'] . '_verso_' . time() . '.' . $versoExt;
        move_uploaded_file($_FILES['permis_verso']['tmp_name'], $uploadDir . $versoName);

        $userModel = $this->model('User');
        $result    = $userModel->demanderConducteur((int)$_SESSION['user_id'], $rectoName, $versoName);

        if ($result) {
            $this->redirect('passager/dashboard?success=demande_envoyee');
        } else {
            $this->redirect('passager/devenirConducteur?error=demande_existante');
        }
    }

    /**
     * Formulaire pour laisser un avis
     */
    public function laisserAvis($reservation_id) {
        $reservation = $this->reservationModel->getDetailById((int)$reservation_id, $_SESSION['user_id']);

        if (!$reservation) {
            $this->redirect('passager/reservations?error=introuvable');
        }

        // Vérifications
        if ($reservation->trajet_statut !== 'termine') {
            $this->redirect('passager/reservations?error=trajet_non_termine');
        }

        $avisModel = $this->model('Avis');

        if ($avisModel->dejaNote((int)$reservation->trajet_id, (int)$_SESSION['user_id'])) {
            $this->redirect('passager/reservations?error=deja_note');
        }

        $data = [
            'titre'       => 'Laisser un avis',
            'reservation' => $reservation
        ];

        $this->render('passager/laisser_avis', $data);
    }

    /**
     * Traitement de l'avis soumis
     */
    public function soumettreAvis($reservation_id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('passager/reservations');
        }

        $reservation = $this->reservationModel->getDetailById((int)$reservation_id, $_SESSION['user_id']);

        if (!$reservation || $reservation->trajet_statut !== 'termine') {
            $this->redirect('passager/reservations?error=impossible');
        }

        $avisModel = $this->model('Avis');

        if ($avisModel->dejaNote((int)$reservation->trajet_id, (int)$_SESSION['user_id'])) {
            $this->redirect('passager/reservations?error=deja_note');
        }

        $note = (int)($_POST['note'] ?? 0);
        $commentaire = trim($_POST['commentaire'] ?? '');

        if ($note < 1 || $note > 5) {
            $this->redirect('passager/reservation/' . $reservation_id . '/avis?error=note_invalide');
        }

        $ok = $avisModel->addRating(
            (int)$reservation->trajet_id,
            (int)$_SESSION['user_id'],
            (int)$reservation->conducteur_id,
            $note,
            $commentaire
        );

        if ($ok) {
            $this->redirect('passager/reservations?success=avis_envoye');
        }

        $this->redirect('passager/reservations?error=avis_echec');
    }
}