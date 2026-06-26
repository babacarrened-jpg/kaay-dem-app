<?php
// public/test-data.php - Script pour créer des données de test

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/core/Database.php';

echo "<html><head><style>body{font-family:Arial;margin:20px;}</style></head><body>";
echo "<h1>✨ Création des données de test</h1>";

try {
    $db = new Database();
    
    // Générer le bon hash pour password: "password123"
    $password_hash = password_hash('password123', PASSWORD_DEFAULT);

    
    // 1. Créer un conducteur de test
    echo "<h2>1️⃣ Création du conducteur...</h2>";
    
    // Supprimer le conducteur existant et ses données associées
    $db->query("DELETE FROM reservations WHERE trajet_id IN (SELECT id FROM trajets WHERE conducteur_id = (SELECT id FROM utilisateurs WHERE email = :email LIMIT 1))");
    $db->bind(':email', 'amadou@test.com');
    $db->execute();
    
    $db->query("DELETE FROM trajets WHERE conducteur_id = (SELECT id FROM utilisateurs WHERE email = :email LIMIT 1)");
    $db->bind(':email', 'amadou@test.com');
    $db->execute();
    
    $db->query("DELETE FROM vehicules WHERE conducteur_id = (SELECT id FROM utilisateurs WHERE email = :email LIMIT 1)");
    $db->bind(':email', 'amadou@test.com');
    $db->execute();
    
    $db->query("DELETE FROM utilisateurs WHERE email = :email");
    $db->bind(':email', 'amadou@test.com');
    $db->execute();
    
    // Maintenant créer le nouveau conducteur
    echo "➕ Création d'un nouveau conducteur...<br>";
    $db->query("INSERT INTO utilisateurs (nom, prenom, email, telephone, mot_de_passe, role, est_conducteur_valide, statut) 
               VALUES (:nom, :prenom, :email, :tel, :pass, :role, :valid, :statut)");
    $db->bind(':nom', 'Diallo');
    $db->bind(':prenom', 'Amadou');
    $db->bind(':email', 'amadou@test.com');
    $db->bind(':tel', '+221772345678');
    $db->bind(':pass', $password_hash);
    $db->bind(':role', 'conducteur');
    $db->bind(':valid', 1);
    $db->bind(':statut', 'actif');
    $db->execute();
    
    $db->query("SELECT id FROM utilisateurs WHERE email = :email");
    $db->bind(':email', 'amadou@test.com');
    $result = $db->single();
    $conductor_id = $result->id;
    echo "✅ Conducteur créé : amadou@test.com<br>";
    
    // 1.5 Créer un passager de test
    echo "<h2>1️⃣.5️⃣ Création d'un passager...</h2>";
    
    // Supprimer le passager existant et ses réservations
    $db->query("DELETE FROM reservations WHERE passager_id = (SELECT id FROM utilisateurs WHERE email = :email LIMIT 1)");
    $db->bind(':email', 'passager@test.com');
    $db->execute();
    
    $db->query("DELETE FROM utilisateurs WHERE email = :email");
    $db->bind(':email', 'passager@test.com');
    $db->execute();
    
    // Créer le nouveau passager
    echo "➕ Création d'un nouveau passager...<br>";
    $db->query("INSERT INTO utilisateurs (nom, prenom, email, telephone, mot_de_passe, role, est_conducteur_valide, statut) 
               VALUES (:nom, :prenom, :email, :tel, :pass, :role, :valid, :statut)");
    $db->bind(':nom', 'Ndiaye');
    $db->bind(':prenom', 'Marie');
    $db->bind(':email', 'passager@test.com');
    $db->bind(':tel', '+221783456789');
    $db->bind(':pass', $password_hash);
    $db->bind(':role', 'passager');
    $db->bind(':valid', 0);
    $db->bind(':statut', 'actif');
    $db->execute();
    
    echo "✅ Passager créé : passager@test.com<br>";

    
    // 2. Vérifier/créer le véhicule
    echo "<h2>2️⃣ Création du véhicule...</h2>";
    $db->query("SELECT id FROM vehicules WHERE immatriculation = :immat");
    $db->bind(':immat', 'SN-001-AAA');
    $check = $db->single();
    
    if($check) {
        $vehicle_id = $check->id;
        echo "✅ Véhicule existe déjà avec l'ID: $vehicle_id<br>";
    } else {
        echo "➕ Création d'un nouveau véhicule...<br>";
        $db->query("INSERT INTO vehicules (conducteur_id, marque, modele, couleur, immatriculation, nombre_places) 
                   VALUES (:cond_id, :marque, :modele, :couleur, :immat, :places)");
        $db->bind(':cond_id', $conductor_id);
        $db->bind(':marque', 'Toyota');
        $db->bind(':modele', 'Corolla');
        $db->bind(':couleur', 'Blanc');
        $db->bind(':immat', 'SN-001-AAA');
        $db->bind(':places', 4);
        $db->execute();
        
        $db->query("SELECT id FROM vehicules WHERE immatriculation = :immat");
        $db->bind(':immat', 'SN-001-AAA');
        $result = $db->single();
        $vehicle_id = $result->id;
        echo "✅ Véhicule créé avec l'ID: $vehicle_id<br>";
    }
    
    // 3. Créer des trajets
    echo "<h2>3️⃣ Création des trajets...</h2>";
    
    $trajets = [
        ['Dakar', 'Gare Routière', 'Diamniadio', 'Rond-point', '08:00:00', 1500],
        ['Dakar', 'Plateau', 'Rufisque', 'Centre-ville', '14:30:00', 800],
        ['Dakar', 'Liberté 6', 'Thiès', 'Gare', '10:00:00', 2000],
    ];
    
    $created_count = 0;
    
    foreach($trajets as $i => $trajet) {
        $trip_date = date('Y-m-d', strtotime("+ " . ($i + 1) . " day"));
        
        // Vérifier si trajet existe déjà
        $db->query("SELECT id FROM trajets WHERE conducteur_id = :cond_id AND date_trajet = :date AND heure_depart = :heure");
        $db->bind(':cond_id', $conductor_id);
        $db->bind(':date', $trip_date);
        $db->bind(':heure', $trajet[4]);
        $check = $db->single();
        
        if(!$check) {
            $db->query("INSERT INTO trajets (conducteur_id, vehicule_id, ville_depart, point_depart, ville_arrivee, point_arrivee, date_trajet, heure_depart, prix_par_place, places_disponibles, places_totales, climatisation, musique, fumeur, statut) 
                       VALUES (:cond_id, :veh_id, :ville_d, :point_d, :ville_a, :point_a, :date, :heure, :prix, :places, :places_total, :clim, :music, :smoke, :statut)");
            $db->bind(':cond_id', $conductor_id);
            $db->bind(':veh_id', $vehicle_id);
            $db->bind(':ville_d', $trajet[0]);
            $db->bind(':point_d', $trajet[1]);
            $db->bind(':ville_a', $trajet[2]);
            $db->bind(':point_a', $trajet[3]);
            $db->bind(':date', $trip_date);
            $db->bind(':heure', $trajet[4]);
            $db->bind(':prix', $trajet[5]);
            $db->bind(':places', 4);
            $db->bind(':places_total', 4);
            $db->bind(':clim', 1);
            $db->bind(':music', 1);
            $db->bind(':smoke', 0);
            $db->bind(':statut', 'planifie');
            $db->execute();
            
            echo "✅ Trajet créé: {$trajet[0]} → {$trajet[2]} le $trip_date à {$trajet[4]}<br>";
            $created_count++;
        }
    }
    
    echo "<hr>";
    echo "<h2 style='color:green;'>✅ Données de test prêtes!</h2>";
    
    echo "<h3>📱 Comptes de test :</h3>";
    echo "<div style='background:#f5f5f5;padding:15px;border-radius:8px;margin:10px 0;'>";
    echo "<p><strong>🚗 CONDUCTEUR</strong></p>";
    echo "<p><strong>Email :</strong> amadou@test.com</p>";
    echo "<p><strong>Mot de passe :</strong> password123</p>";
    echo "</div>";
    
    echo "<div style='background:#f5f5f5;padding:15px;border-radius:8px;margin:10px 0;'>";
    echo "<p><strong>👤 PASSAGER</strong></p>";
    echo "<p><strong>Email :</strong> passager@test.com</p>";
    echo "<p><strong>Mot de passe :</strong> password123</p>";
    echo "</div>";
    
    echo "<p style='margin-top:20px;'><strong>Trajets disponibles :</strong> $created_count</p>";
    echo "<p style='margin-top:20px;'><a href='" . BASE_URL . "' style='background:#dc2626;color:white;padding:10px 20px;border-radius:8px;text-decoration:none;display:inline-block;'>← Retour à l'accueil</a></p>";
    
} catch(Exception $e) {
    echo "<h2 style='color:red;'>❌ Erreur</h2>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}

echo "</body></html>";
?>
