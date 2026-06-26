<?php
// app/controllers/HomeController.php

class HomeController extends Controller {
    
    public function index() {
        // Exemples de données à transmettre à la vue
        $data = [
            'titre' => 'Accueil',
            'description' => 'Voyagez ensemble, économisez malin. Covoiturage entre Dakar, Rufisque et Diamniadio.'
        ];
        
        // On effectue le rendu via le layout par défaut ('base.php')
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
            'titre' => 'Nous contacter'
        ];
        $this->render('home/contact', $data);
    }
}
