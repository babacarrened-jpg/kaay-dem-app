<?php
// app/controllers/AdminController.php

class AdminController extends Controller {
    private $userModel;
    private $trajetModel;
    
    public function __construct() {
        if(!isset($_SESSION['user_id'])) {
            $this->redirect('auth/connexion');
        }

        $roles = $_SESSION['user_roles'] ?? [$_SESSION['user_role'] ?? ''];
        if(!in_array('admin', $roles, true)) {
            die("Accès non autorisé. Vous devez être administrateur.");
        }

        $this->userModel = $this->model('User');
        $this->trajetModel = $this->model('Trajet');
    }

    public function dashboard() {
        $demandes = $this->userModel->getPendingConducteurRequests();
        $allTrajets = $this->trajetModel->getAll();
        $reservationModel = $this->model('Reservation');

        $trajetsByMonth    = $this->trajetModel->getTrajetsByMonth();
        $tauxOccupation    = $this->trajetModel->getTauxOccupationByMonth();
        $topConducteurs    = $this->trajetModel->getTopConducteurs(5);
        $statsGlobales     = $this->trajetModel->getStatsGlobales();

        $data = [
            'titre' => 'Administration - Kaay Dem !',
            'stats' => [
                'utilisateurs'      => count($this->userModel->findAll()),
                'trajets_actifs'    => count($allTrajets),
                'signalements'      => 0,
                'nb_conducteurs'    => $this->userModel->countByRole('conducteur'),
                'nb_passagers'      => $this->userModel->countByRole('passager'),
                'nb_trajets'        => $this->trajetModel->countAll(),
                'nb_reservations'   => $reservationModel->countAll(),
            ],
            'demandes_conducteur'  => $demandes,
            'trajets_by_month'     => $trajetsByMonth,
            'taux_occupation'      => $tauxOccupation,
            'top_conducteurs'      => $topConducteurs,
            'stats_globales'       => $statsGlobales,
        ];

        $this->render('admin/dashboard', $data);
    }

    public function trajets() {
        $filters = [
            'statut'        => $_GET['statut'] ?? '',
            'conducteur_id' => isset($_GET['conducteur_id']) && is_numeric($_GET['conducteur_id']) ? (int)$_GET['conducteur_id'] : '',
            'ville_depart'  => trim($_GET['ville_depart'] ?? ''),
            'ville_arrivee' => trim($_GET['ville_arrivee'] ?? '')
        ];

        $conducteurs = $this->userModel->getConducteurs();
        $trajets     = $this->trajetModel->getAll($filters);

        $data = [
            'titre'       => 'Tous les trajets',
            'trajets'     => $trajets,
            'conducteurs' => $conducteurs,
            'filters'     => $filters
        ];

        $this->render('admin/trajets', $data);
    }

    // Version mise à jour par le collègue : JOIN sur demandes_conducteur pour récupérer le bon nom
    public function validerConducteur($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $db = new Database();
            $db->query('SELECT u.prenom, u.nom FROM demandes_conducteur d JOIN utilisateurs u ON d.utilisateur_id = u.id WHERE d.id = :id');
            $db->bind(':id', (int)$id);
            $user = $db->single();

            $this->userModel->validateConducteur((int)$id, (int)$_SESSION['user_id']);

            $activiteModel = $this->model('Activite');
            $nom = $user ? $user->prenom . ' ' . $user->nom : '#' . $id;
            $activiteModel->loguer('conducteur_valide', 'Conducteur ' . $nom . ' validé.', $_SESSION['user_id']);

            $this->redirect('admin/dashboard?success=conducteur_valide');
        }
        $this->redirect('admin/dashboard');
    }

    // Version mise à jour par le collègue : idem
    public function refuserConducteur($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $db = new Database();
            $db->query('SELECT u.prenom, u.nom FROM demandes_conducteur d JOIN utilisateurs u ON d.utilisateur_id = u.id WHERE d.id = :id');
            $db->bind(':id', (int)$id);
            $user = $db->single();

            $this->userModel->refuseConducteur((int)$id, (int)$_SESSION['user_id']);

            $activiteModel = $this->model('Activite');
            $nom = $user ? $user->prenom . ' ' . $user->nom : '#' . $id;
            $activiteModel->loguer('conducteur_refuse', 'Conducteur ' . $nom . ' refusé.', $_SESSION['user_id']);

            $this->redirect('admin/dashboard?success=conducteur_refuse');
        }
        $this->redirect('admin/dashboard');
    }

    public function utilisateurs() {
        $search = trim($_GET['search'] ?? '');
        $users  = !empty($search) ? $this->userModel->search($search) : $this->userModel->findAll();

        $db = new Database();
        $db->query("SELECT COUNT(*) as total FROM utilisateurs WHERE statut = 'suspendu'");
        $row = $db->single();
        $countSuspendus = $row ? (int)$row->total : 0;

        $data = [
            'titre'        => 'Gestion des utilisateurs',
            'users'        => $users,
            'search'       => $search,
            'nb_actifs'    => $this->userModel->countByStatut('actif'),
            'nb_suspendus' => $countSuspendus
        ];
        $this->render('admin/utilisateurs', $data);
    }

    public function voirUtilisateur($id) {
        $user = $this->userModel->getUserById((int)$id);
        if(!$user) {
            $this->redirect('admin/utilisateurs?error=introuvable');
            return;
        }
        $data = ['titre' => 'Profil - ' . $user->prenom . ' ' . $user->nom, 'user' => $user];
        $this->render('admin/utilisateur_profil', $data);
    }

    public function modifierUtilisateur($id) {
        $id = (int)$id;
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($id === (int)$_SESSION['user_id']) {
                $this->redirect('admin/utilisateur/' . $id . '?error=auto_modification');
                return;
            }
            $data = [
                'nom'       => trim($_POST['nom'] ?? ''),
                'prenom'    => trim($_POST['prenom'] ?? ''),
                'email'     => trim($_POST['email'] ?? ''),
                'telephone' => trim($_POST['telephone'] ?? ''),
                'role'      => trim($_POST['role'] ?? 'passager'),
            ];
            if($this->userModel->updateByAdmin($id, $data)) {
                $this->redirect('admin/utilisateur/' . $id . '?success=modifie');
            } else {
                $this->redirect('admin/utilisateur/' . $id . '?error=echec');
            }
        } else {
            $this->redirect('admin/utilisateur/' . $id);
        }
    }

    public function suspendreUtilisateur($id) {
        $id = (int)$id;
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($id === (int)$_SESSION['user_id']) {
                $this->redirect('admin/utilisateur/' . $id . '?error=auto_suspension');
                return;
            }
            $user = $this->userModel->getUserById($id);
            $this->userModel->suspend($id);

            $activiteModel = $this->model('Activite');
            $nom = $user ? $user->prenom . ' ' . $user->nom : '#' . $id;
            $activiteModel->loguer('utilisateur_suspendu', 'Utilisateur ' . $nom . ' suspendu.', $_SESSION['user_id']);

            $this->redirect('admin/utilisateur/' . $id . '?success=suspendu');
        }
        $this->redirect('admin/utilisateur/' . $id);
    }

    public function reactiverUtilisateur($id) {
        $id = (int)$id;
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $this->userModel->getUserById($id);
            $this->userModel->unsuspend($id);

            $activiteModel = $this->model('Activite');
            $nom = $user ? $user->prenom . ' ' . $user->nom : '#' . $id;
            $activiteModel->loguer('utilisateur_reactive', 'Utilisateur ' . $nom . ' réactivé.', $_SESSION['user_id']);

            $this->redirect('admin/utilisateur/' . $id . '?success=reactive');
        }
        $this->redirect('admin/utilisateur/' . $id);
    }

    public function supprimerUtilisateur($id) {
        $id = (int)$id;
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($id === (int)$_SESSION['user_id']) {
                $this->redirect('admin/utilisateurs?error=auto_suppression');
                return;
            }
            $user = $this->userModel->getUserById($id);
            $nom  = $user ? $user->prenom . ' ' . $user->nom : '#' . $id;

            if($this->userModel->delete($id)) {
                $activiteModel = $this->model('Activite');
                $activiteModel->loguer('utilisateur_supprime', 'Utilisateur ' . $nom . ' supprimé.', $_SESSION['user_id']);
                $this->redirect('admin/utilisateurs?success=supprime');
            } else {
                $this->redirect('admin/utilisateurs?error=echec_suppression');
            }
        }
        $this->redirect('admin/utilisateurs');
    }

    public function reservations() {
        $reservationModel = $this->model('Reservation');

        $filters = [
            'statut' => $_GET['statut'] ?? '',
            'search' => trim($_GET['search'] ?? ''),
        ];

        $reservations = $reservationModel->getAllWithDetails($filters);

        $data = [
            'titre'         => 'Gestion des réservations',
            'reservations'  => $reservations,
            'filters'       => $filters,
            'nb_total'      => $reservationModel->countAll(),
            'nb_en_attente' => $reservationModel->countByStatut('en_attente'),
            'nb_confirmees' => $reservationModel->countByStatut('confirmee'),
            'nb_annulees'   => $reservationModel->countByStatut('annulee'),
        ];

        $this->render('admin/reservations', $data);
    }

    public function historique() {
        $activiteModel = $this->model('Activite');
        $activites     = $activiteModel->getLast(100);

        $data = [
            'titre'     => 'Historique des activités',
            'activites' => $activites,
        ];

        $this->render('admin/historique', $data);
    }

    public function evaluations() {
        $avisModel = $this->model('Avis');

        $filtreNote = isset($_GET['note']) && is_numeric($_GET['note'])
            ? (int)$_GET['note']
            : null;

        $evaluations = $avisModel->getAllForAdmin($filtreNote);
        $stats       = $avisModel->getStatsGlobales();

        $data = [
            'titre'       => 'Gestion des évaluations',
            'evaluations' => $evaluations,
            'stats'       => $stats,
        ];

        $this->render('admin/evaluations', $data);
    }

    public function supprimerAvis($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/evaluations');
        }

        $avisModel = $this->model('Avis');
        $avisModel->deleteById((int)$id);

        $activiteModel = $this->model('Activite');
        $activiteModel->loguer(
            'avis_supprime',
            'Avis #' . $id . ' supprimé par l\'administrateur.',
            $_SESSION['user_id']
        );

        $this->redirect('admin/evaluations?success=avis_supprime');
    }

    // =============================================
    // MESSAGES DE CONTACT
    // =============================================

    public function messages() {
        $contactModel = $this->model('Contact');
        $messages = $contactModel->getTous();

        $data = [
            'titre'    => 'Messages de contact',
            'messages' => $messages,
        ];

        $this->render('admin/messages_contact', $data);
    }

    public function marquerMessageLu($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/messages');
        }

        $contactModel = $this->model('Contact');
        $contactModel->marquerLu((int)$id);

        $this->redirect('admin/messages');
    }

    // =============================================
    // SIGNALEMENTS
    // =============================================

    /**
     * Liste des signalements avec filtres
     */
    public function signalements() {
        $signalementModel = $this->model('Signalement');

        $filters = [
            'statut' => $_GET['statut'] ?? '',
            'motif'  => trim($_GET['motif'] ?? ''),
        ];

        $filtreStatut = !empty($filters['statut']) ? $filters['statut'] : null;
        $filtreMotif  = !empty($filters['motif']) ? $filters['motif'] : null;

        $signalements = $signalementModel->getAllForAdmin($filtreStatut, $filtreMotif);
        $stats        = $signalementModel->getStatsGlobales();

        $data = [
            'titre'        => 'Gestion des signalements',
            'signalements' => $signalements,
            'stats'        => $stats,
            'filters'      => $filters,
        ];

        $this->render('admin/signalements', $data);
    }

    /**
     * Détail d'un signalement
     */
    public function voirSignalement($id) {
        $signalementModel = $this->model('Signalement');
        $signalement = $signalementModel->getById((int)$id);

        if (!$signalement) {
            $this->redirect('admin/signalements?error=introuvable');
            return;
        }

        $data = [
            'titre'       => 'Signalement #' . $signalement->id,
            'signalement' => $signalement,
        ];

        $this->render('admin/signalement_detail', $data);
    }

    /**
     * Changer le statut d'un signalement (nouveau → en_cours → traite)
     */
    public function changerStatutSignalement($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/signalements');
            return;
        }

        $statut = $_POST['statut'] ?? '';
        $statutsValides = ['nouveau', 'en_cours', 'traite'];

        if (!in_array($statut, $statutsValides, true)) {
            $this->redirect('admin/signalements?error=statut_invalide');
            return;
        }

        $signalementModel = $this->model('Signalement');
        $signalementModel->updateStatut((int)$id, $statut);

        $activiteModel = $this->model('Activite');
        $activiteModel->loguer(
            'signalement_statut',
            'Signalement #' . $id . ' passé en "' . $statut . '".',
            $_SESSION['user_id']
        );

        $this->redirect('admin/signalements?success=statut_modifie');
    }

    /**
     * Supprimer un signalement
     */
    public function supprimerSignalement($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/signalements');
            return;
        }

        $signalementModel = $this->model('Signalement');
        $signalementModel->deleteById((int)$id);

        $activiteModel = $this->model('Activite');
        $activiteModel->loguer(
            'signalement_supprime',
            'Signalement #' . $id . ' supprimé par l\'administrateur.',
            $_SESSION['user_id']
        );

        $this->redirect('admin/signalements?success=signalement_supprime');
    }
}