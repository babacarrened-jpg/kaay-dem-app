<?php
// app/controllers/AdminController.php

class AdminController extends Controller {
    private $userModel;
    private $trajetModel;
    
    public function __construct() {
        if(!isset($_SESSION['user_id'])) {
            $this->redirect('auth/connexion');
        }

        // Sécurité : Seul l'admin peut accéder à ce contrôleur
        $roles = $_SESSION['user_roles'] ?? [$_SESSION['user_role'] ?? ''];
        if(!in_array('admin', $roles, true)) {
            die("Accès non autorisé. Vous devez être administrateur.");
        }

        $this->userModel = $this->model('User');
        $this->trajetModel = $this->model('Trajet');
    }

    /**
     * Affiche le dashboard d'administration
     */
    public function dashboard() {
        $demandes = $this->userModel->getPendingConducteurRequests();
        $allTrajets = $this->trajetModel->getAll();
        $reservationModel = $this->model('Reservation');

        // --- Nouvelles statistiques ---
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
            'statut' => $_GET['statut'] ?? '',
            'conducteur_id' => isset($_GET['conducteur_id']) && is_numeric($_GET['conducteur_id']) ? (int)$_GET['conducteur_id'] : '',
            'ville_depart' => trim($_GET['ville_depart'] ?? ''),
            'ville_arrivee' => trim($_GET['ville_arrivee'] ?? '')
        ];

        $conducteurs = $this->userModel->getConducteurs();
        $trajets = $this->trajetModel->getAll($filters);

        $data = [
            'titre' => 'Tous les trajets',
            'trajets' => $trajets,
            'conducteurs' => $conducteurs,
            'filters' => $filters
        ];

        $this->render('admin/trajets', $data);
    }

    /**
     * Valide un conducteur
     */
    public function validerConducteur($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->userModel->validateConducteur((int)$id, (int)$_SESSION['user_id']);
            $this->redirect('admin/dashboard?success=conducteur_valide');
        }

        $this->redirect('admin/dashboard');
    }

    /**
     * Refuse un conducteur
     */
    public function refuserConducteur($id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->userModel->refuseConducteur((int)$id, (int)$_SESSION['user_id']);
            $this->redirect('admin/dashboard?success=conducteur_refuse');
        }

        $this->redirect('admin/dashboard');
    }
        /**
     * Liste des utilisateurs avec recherche
     */
    // Dans utilisateurs() - lignes 107-116
    public function utilisateurs() {
        $search = trim($_GET['search'] ?? '');
        $users = !empty($search) ? $this->userModel->search($search) : $this->userModel->findAll();

        // Compte les suspendus avec une nouvelle connexion
        $db = new Database();
        $db->query("SELECT COUNT(*) as total FROM utilisateurs WHERE statut = 'suspendu'");
        $row = $db->single();
        $countSuspendus = $row ? (int)$row->total : 0;

        $data = [
            'titre' => 'Gestion des utilisateurs',
            'users' => $users,
            'search' => $search,
            'nb_actifs' => $this->userModel->countByStatut('actif'),
            'nb_suspendus' => $countSuspendus
        ];
        $this->render('admin/utilisateurs', $data);
    }

    /**
     * Profil détaillé d'un utilisateur
     */
    public function voirUtilisateur($id) {
        $user = $this->userModel->getUserById((int)$id);
        if(!$user) {
            $this->redirect('admin/utilisateurs?error=introuvable');
            return;
        }
        $data = ['titre' => 'Profil - ' . $user->prenom . ' ' . $user->nom, 'user' => $user];
        $this->render('admin/utilisateur_profil', $data);
    }

    /**
     * Modifie un utilisateur
     */
    public function modifierUtilisateur($id) {
        $id = (int)$id;
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($id === (int)$_SESSION['user_id']) {
                $this->redirect('admin/voirUtilisateur/' . $id . '?error=auto_modification');
                return;
            }
            $data = [
                'nom' => trim($_POST['nom'] ?? ''),
                'prenom' => trim($_POST['prenom'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'telephone' => trim($_POST['telephone'] ?? ''),
                'role' => trim($_POST['role'] ?? 'passager'),
            ];
            if($this->userModel->updateByAdmin($id, $data)) {
                $this->redirect('admin/voirUtilisateur/' . $id . '?success=modifie');
            } else {
                $this->redirect('admin/voirUtilisateur/' . $id . '?error=echec');
            }
        } else {
            $this->redirect('admin/voirUtilisateur/' . $id);
        }
    }

    /**
     * Suspend un utilisateur
     */
    public function suspendreUtilisateur($id) {
        $id = (int)$id;
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($id === (int)$_SESSION['user_id']) {
                $this->redirect('admin/voirUtilisateur/' . $id . '?error=auto_suspension');
                return;
            }
            $this->userModel->suspend($id);
            $this->redirect('admin/voirUtilisateur/' . $id . '?success=suspendu');
        }
        $this->redirect('admin/voirUtilisateur/' . $id);
    }

    /**
     * Réactive un utilisateur
     */
    public function reactiverUtilisateur($id) {
        $id = (int)$id;
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->userModel->unsuspend($id);
            $this->redirect('admin/voirUtilisateur/' . $id . '?success=reactive');
        }
        $this->redirect('admin/voirUtilisateur/' . $id);
    }

    /**
     * Supprime un utilisateur
     */
    public function supprimerUtilisateur($id) {
        $id = (int)$id;
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($id === (int)$_SESSION['user_id']) {
                $this->redirect('admin/utilisateurs?error=auto_suppression');
                return;
            }
            if($this->userModel->delete($id)) {
                $this->redirect('admin/utilisateurs?success=supprime');
            } else {
                $this->redirect('admin/utilisateurs?error=echec_suppression');
            }
        }
        $this->redirect('admin/utilisateurs');
    }

}
