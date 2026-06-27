# Diagramme de classes UML - Kaay Dem App

## 1. Objectif
Ce document présente la modélisation UML du système de covoiturage Kaay Dem, en mettant l’accent sur le double rôle conducteur/passager, qui est le cœur du projet.

## 2. Point central du système : double rôle conducteur/passager
Le système repose sur une architecture où un utilisateur peut avoir deux rôles distincts selon le contexte :
- Passager : réserve un trajet.
- Conducteur : propose un trajet et gère les réservations.

Cette modélisation est centrale car elle conditionne les interactions entre les entités principales.

## 3. Classes principales

### 1. Utilisateur
Attributs :
- id
- nom
- prenom
- email
- telephone
- mot_de_passe
- role
- est_conducteur_valide
- statut

Méthodes :
- seConnecter()
- sInscrire()
- devenirConducteur()
- reserverTrajet()
- publierTrajet()

### 2. Conducteur
Hérite de Utilisateur.

Attributs :
- vehicules
- trajetsProposes
- reservationsGerees

Méthodes :
- publierTrajet()
- accepterReservation()
- refuserReservation()
- consulterReservations()

### 3. Passager
Hérite de Utilisateur.

Attributs :
- reservationsEffectuees
- trajetsReserves

Méthodes :
- rechercherTrajet()
- reserverTrajet()
- consulterReservation()
- annulerReservation()

### 4. Trajet
Attributs :
- id
- conducteur_id
- vehicule_id
- ville_depart
- point_depart
- ville_arrivee
- point_arrivee
- date_trajet
- heure_depart
- prix_par_place
- places_disponibles
- places_totales
- description
- statut

Méthodes :
- calculerPlacesDisponibles()
- verifierDisponibilite()
- mettreAJourStatut()

### 5. Vehicule
Attributs :
- id
- conducteur_id
- marque
- modele
- couleur
- immatriculation
- nombre_places

Méthodes :
- ajouterVehicule()
- supprimerVehicule()

### 6. Reservation
Attributs :
- id
- trajet_id
- passager_id
- places_reservees
- prix_total
- statut
- date_reservation

Méthodes :
- confirmer()
- annuler()
- refuser()

### 7. Notification
Attributs :
- id
- utilisateur_id
- titre
- message
- type
- lien
- lue

Méthodes :
- creerNotification()
- marquerCommeLue()

## 4. Relations principales
- Utilisateur 1 --- 0..* Reservation
- Conducteur 1 --- 0..* Trajet
- Conducteur 1 --- 0..* Vehicule
- Trajet 1 --- 0..* Reservation
- Passager 1 --- 0..* Reservation
- Utilisateur 1 --- 0..* Notification

## 5. Diagramme UML textuel
```text
Utilisateur
  - id
  - nom
  - prenom
  - email
  - telephone
  - mot_de_passe
  - role
  - est_conducteur_valide
  - statut
  + seConnecter()
  + sInscrire()
  + reserverTrajet()
  + publierTrajet()

Conducteur --|> Utilisateur
Passager --|> Utilisateur

Conducteur
  + publierTrajet()
  + accepterReservation()
  + refuserReservation()

Passager
  + rechercherTrajet()
  + reserverTrajet()
  + annulerReservation()

Trajet
  - id
  - conducteur_id
  - vehicule_id
  - ville_depart
  - ville_arrivee
  - date_trajet
  - heure_depart
  - prix_par_place
  - places_disponibles
  - places_totales
  - statut

Vehicule
  - id
  - conducteur_id
  - marque
  - modele
  - immatriculation
  - nombre_places

Reservation
  - id
  - trajet_id
  - passager_id
  - places_reservees
  - prix_total
  - statut

Notification
  - id
  - utilisateur_id
  - titre
  - message
  - type
  - lien
  - lue
```

## 6. Remarque importante
Le diagramme doit être présenté comme une modélisation orientée objet du système, avec une attention particulière à la séparation entre :
- le profil utilisateur,
- le comportement conducteur,
- le comportement passager,
- et les interactions liées aux réservations et trajets.

## 7. Suggestion de présentation pour l’enseignant
Tu peux présenter ce diagramme en disant :
- “Le système repose sur un utilisateur unique qui peut jouer le rôle de conducteur ou de passager selon l’action effectuée.”
- “Les réservations relient directement le passager au trajet proposé par le conducteur.”
- “Les notifications assurent le suivi entre les deux parties.”
