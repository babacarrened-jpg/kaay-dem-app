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
                    // Connexion automatique après inscription
                    $newUser = $this->userModel->login($data['email'], $postData['mot_de_passe']);
                    if($newUser) {
                        $this->createUserSession($newUser);
                    }

                    $this->redirect('auth/connexion?success=inscrit');
                } else {
                    die("Une erreur est survenue lors de l'inscription.");
                }
            } else {
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
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $this->redirect('auth/connexion');
        return;
    }

    $postData = $this->getPostData();

    $data = [
        'titre'            => 'Connexion - Kaay Dem !',
        'email'            => $postData['email'] ?? '',
        'mot_de_passe'     => $postData['mot_de_passe'] ?? '',
        'email_err'        => '',
        'mot_de_passe_err' => '',
        'compte_err'       => ''
    ];

    // Validation basique
    if (empty($data['email'])) {
        $data['email_err'] = 'Veuillez entrer votre email';
    }
    if (empty($data['mot_de_passe'])) {
        $data['mot_de_passe_err'] = 'Veuillez entrer votre mot de passe';
    }

    if (!empty($data['email_err']) || !empty($data['mot_de_passe_err'])) {
        $this->render('auth/connexion', $data);
        return;
    }

    // Vérifier si l'utilisateur existe
    $userExist = $this->userModel->findUserByEmail($data['email']);

    if (!$userExist) {
        $data['email_err'] = 'Aucun compte trouvé avec cet email';
        $this->render('auth/connexion', $data);
        return;
    }

    // ✅ Vérifier si le compte est suspendu
    if (isset($userExist->statut) && $userExist->statut === 'suspendu') {
        $data['compte_err'] = '🚫 Votre compte a été suspendu. Contactez l\'administrateur pour plus d\'informations.';
        $this->render('auth/connexion', $data);
        return;
    }

    // Vérifier le mot de passe
    $loggedInUser = $this->userModel->login($data['email'], $data['mot_de_passe']);

    if ($loggedInUser) {
        // Vérifier aussi le statut depuis l'objet retourné
        if (isset($loggedInUser->statut) && $loggedInUser->statut === 'suspendu') {
            $data['compte_err'] = '🚫 Votre compte a été suspendu. Contactez l\'administrateur pour plus d\'informations.';
            $this->render('auth/connexion', $data);
            return;
        }
        $this->createUserSession($loggedInUser);
    } else {
        $data['mot_de_passe_err'] = 'Mot de passe incorrect';
        $this->render('auth/connexion', $data);
    }
}
    /**
     * Page : Demande de réinitialisation de mot de passe oublié
     */
    public function motDePasseOublie() {
        $data = [
            'titre' => 'Mot de passe oublié - Kaay Dem !',
            'message' => '',
            'alertType' => ''
        ];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $postData = $this->getPostData();
            $email = trim($postData['email']);
            
            if (!empty($email)) {
                // Génération des données de sécurité
                $token = bin2hex(random_bytes(32)); 
                $expire_at = date("Y-m-d H:i:s", strtotime("+15 minutes"));
                
                // Enregistrement via le modèle
                $this->userModel->savePasswordResetToken($email, $token, $expire_at);
                
                // Construction du lien
                $lien = BASE_URL . "auth/reinitialiser-mot-de-passe?token=" . $token;
                
                // Envoi de l'email
                $sujet = "Réinitialisation de votre mot de passe - KAAY DEMM";
                $contenu = "Bonjour,\n\nPour changer votre mot de passe, cliquez sur ce lien (valide 15 min) : \n" . $lien;
                $headers = "From: no-reply@kaaydemm.sn";
                @mail($email, $sujet, $contenu, $headers);
                
                // Message sécurisé standardisé
                $data['message'] = "Si cet email correspond à un compte, un lien de réinitialisation vous a été envoyé.";
                $data['alertType'] = "success";
            }
        }

        $this->render('auth/mot-de-passe-oublie', $data);
    }

    /**
     * Page : Définition du nouveau mot de passe via le Token reçu
     */
    public function reinitialiserMotDePasse() {
        $data = [
            'titre' => 'Nouveau mot de passe - Kaay Dem !',
            'message' => '',
            'error' => false,
            'success' => false,
            'token' => isset($_GET['token']) ? trim($_GET['token']) : ''
        ];

        // Vérification immédiate du jeton d'accès
        if (empty($data['token'])) {
            $data['message'] = "Le jeton d'accès est manquant.";
            $data['error'] = true;
        } else {
            $resetRequest = $this->userModel->checkResetToken($data['token']);

            if (!$resetRequest) {
                $data['message'] = "Le lien est invalide ou a expiré. Veuillez refaire une demande.";
                $data['error'] = true;
            }
        }

        // Traitement de la modification effective
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !$data['error']) {
            $postData = $this->getPostData();
            $nouveau_mdp = $postData['mot_de_passe'];
            $confirmation = $postData['confirmation_mot_de_passe'];

            if ($nouveau_mdp !== $confirmation) {
                $data['message'] = "Les mots de passe ne correspondent pas.";
            } elseif (strlen($nouveau_mdp) < 6) {
                $data['message'] = "Le mot de passe doit faire au moins 6 caractères.";
            } else {
                // Application sécurisée du changement
                $mdp_hache = password_hash($nouveau_mdp, PASSWORD_DEFAULT);
                $this->userModel->updatePasswordAndClearTokens($resetRequest->email, $mdp_hache);

                $data['message'] = "Votre mot de passe a été modifié avec succès !";
                $data['success'] = true;
            }
        }

        $this->render('auth/reinitialiser-mot-de-passe', $data);
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