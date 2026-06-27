<?php
// app/controllers/AuthController.php

class AuthController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('User');
    }

    /**
     * Affiche le formulaire d'inscription
     */
    public function registerForm() {
        $data = [
            'titre' => 'Inscription - Kaay Dem !',
            'nom' => '',
            'prenom' => '',
            'email' => '',
            'telephone' => '',
            'mot_de_passe' => '',
            'confirmation_mdp' => '',
            'nom_err' => '',
            'prenom_err' => '',
            'email_err' => '',
            'telephone_err' => '',
            'mot_de_passe_err' => '',
            'confirmation_mdp_err' => ''
        ];

        $this->render('auth/inscription', $data);
    }

    /**
     * Gère la soumission du formulaire d'inscription
     */
    public function register() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postData = $this->getPostData();

            $data = [
                'titre' => 'Inscription - Kaay Dem !',
                'nom' => $postData['nom'],
                'prenom' => $postData['prenom'],
                'email' => $postData['email'],
                'telephone' => $postData['telephone'],
                'mot_de_passe' => $postData['mot_de_passe'],
                'confirmation_mdp' => $postData['confirmation_mdp'],
                'nom_err' => '',
                'prenom_err' => '',
                'email_err' => '',
                'telephone_err' => '',
                'mot_de_passe_err' => '',
                'confirmation_mdp_err' => ''
            ];

            // Validation simple
            if(empty($data['email'])) {
                $data['email_err'] = 'Veuillez entrer un email';
            } else {
                if($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'Cet email est déjà pris';
                }
            }

            if(empty($data['nom'])) { $data['nom_err'] = 'Veuillez entrer un nom'; }
            if(empty($data['prenom'])) { $data['prenom_err'] = 'Veuillez entrer un prénom'; }
            if(empty($data['mot_de_passe'])) {
                $data['mot_de_passe_err'] = 'Veuillez entrer un mot de passe';
            } elseif(strlen($data['mot_de_passe']) < 6) {
                $data['mot_de_passe_err'] = 'Le mot de passe doit faire au moins 6 caractères';
            }

            if(empty($data['confirmation_mdp'])) {
                $data['confirmation_mdp_err'] = 'Veuillez confirmer le mot de passe';
            } else {
                if($data['mot_de_passe'] != $data['confirmation_mdp']) {
                    $data['confirmation_mdp_err'] = 'Les mots de passe ne correspondent pas';
                }
            }

            // Si aucune erreur
            if(empty($data['email_err']) && empty($data['nom_err']) && empty($data['mot_de_passe_err']) && empty($data['confirmation_mdp_err'])) {
                
                // Hashage du mot de passe
                $data['mot_de_passe'] = password_hash($data['mot_de_passe'], PASSWORD_DEFAULT);

                // Inscription via le modèle
                if($this->userModel->register($data)) {
                    // Connexion automatique après inscription pour permettre la réservation immédiate
                    $newUser = $this->userModel->login($data['email'], $postData['mot_de_passe']);
                    if($newUser) {
                        $this->createUserSession($newUser);
                    }

                    // Fallback : rediriger vers la page de connexion si l'auto-connexion échoue
                    $this->redirect('auth/connexion?success=inscrit');
                } else {
                    die("Une erreur est survenue lors de l'inscription.");
                }
            } else {
                // Recharger la vue avec erreurs
                $this->render('auth/inscription', $data);
            }

        } else {
            $this->redirect('auth/inscription');
        }
    }

    /**
     * Affiche le formulaire de connexion
     */
    public function loginForm() {
        $data = [
            'titre' => 'Connexion - Kaay Dem !',
            'email' => '',
            'mot_de_passe' => '',
            'email_err' => '',
            'mot_de_passe_err' => ''
        ];

        $this->render('auth/connexion', $data);
    }

    /**
     * Gère la connexion
     */
    public function login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postData = $this->getPostData();

            $data = [
                'titre' => 'Connexion - Kaay Dem !',
                'email' => $postData['email'],
                'mot_de_passe' => $postData['mot_de_passe'],
                'email_err' => '',
                'mot_de_passe_err' => ''
            ];

            if(empty($data['email'])) { $data['email_err'] = 'Veuillez entrer votre email'; }
            if(empty($data['mot_de_passe'])) { $data['mot_de_passe_err'] = 'Veuillez entrer votre mot de passe'; }

            if($this->userModel->findUserByEmail($data['email'])) {
                // Utilisateur trouvé
            } else {
                $data['email_err'] = 'Aucun utilisateur trouvé avec cet email';
            }

            if(empty($data['email_err']) && empty($data['mot_de_passe_err'])) {
                $loggedInUser = $this->userModel->login($data['email'], $data['mot_de_passe']);

                if($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['mot_de_passe_err'] = 'Mot de passe incorrect';
                    $this->render('auth/connexion', $data);
                }
            } else {
                $this->render('auth/connexion', $data);
            }
        } else {
            $this->redirect('auth/connexion');
        }
    }

    /**
     * Crée la session utilisateur
     */
    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_nom'] = $user->nom;
        $_SESSION['user_prenom'] = $user->prenom;
        $_SESSION['user_role'] = $user->role;
        $_SESSION['est_conducteur_valide'] = $user->est_conducteur_valide;

        // Permettre à un utilisateur validé conducteur de conserver aussi le rôle passager
        $roles = [$user->role];
        if($user->role !== 'admin') {
            if($user->role !== 'conducteur') {
                $roles[] = 'passager';
            }
            if($user->est_conducteur_valide || $user->role === 'conducteur') {
                $roles[] = 'conducteur';
            }
        }

        $_SESSION['user_roles'] = array_values(array_unique($roles));

        // Redirection selon le rôle principal
        if($user->role == 'admin') {
            $this->redirect('admin/dashboard');
        } elseif($user->role == 'conducteur' || $user->est_conducteur_valide) {
            $this->redirect('conducteur/dashboard');
        } else {
            $this->redirect('passager/dashboard');
        }
    }

    /**
     * Gère la déconnexion
     */
    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_nom']);
        unset($_SESSION['user_prenom']);
        unset($_SESSION['user_role']);
        unset($_SESSION['user_roles']);
        unset($_SESSION['est_conducteur_valide']);
        session_destroy();
        
        $this->redirect('auth/connexion');
    }
}
