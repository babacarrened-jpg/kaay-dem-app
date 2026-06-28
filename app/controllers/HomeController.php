<?php
// app/controllers/HomeController.php
opcache_reset();

class HomeController extends Controller {
    
    public function index() {
        $data = [
            'titre' => 'Accueil',
            'description' => 'Voyagez ensemble, économisez malin. Covoiturage entre Dakar, Rufisque et Diamniadio.'
        ];
        $this->render('home/index', $data);
    }
    
    public function about() {
        $data = [
            'titre' => 'À propos de Kaay Dem !'
        ];
        $this->render('home/about', $data);
    }

    public function contact() {
        $data = [
            'titre'   => 'Nous contacter',
            'success' => false,
            'errors'  => []
        ];
        $this->render('home/contact', $data);
    }

    public function envoyerContact() {
        $post = $this->getPostData();

        $nom     = trim($post['nom']     ?? '');
        $email   = trim($post['email']   ?? '');
        $message = trim($post['message'] ?? '');

        $errors = [];

        if (empty($nom))                         $errors[] = 'Le nom est obligatoire.';
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
                                                 $errors[] = 'Veuillez saisir un email valide.';
        if (empty($message))                     $errors[] = 'Le message ne peut pas être vide.';
        if (strlen($message) < 10)               $errors[] = 'Le message est trop court (min. 10 caractères).';

        if (!empty($errors)) {
            $this->render('home/contact', [
                'titre'   => 'Nous contacter',
                'success' => false,
                'errors'  => $errors,
                'old'     => compact('nom', 'email', 'message')
            ]);
            return;
        }

        $contactModel = $this->model('Contact');
        $contactModel->sauvegarder($nom, $email, $message);

        $this->render('home/contact', [
            'titre'   => 'Nous contacter',
            'success' => true,
            'errors'  => []
        ]);
    }
}