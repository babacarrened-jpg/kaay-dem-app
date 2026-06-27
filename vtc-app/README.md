# VTC Realtime Prototype

Prototype de VTC moderne inspiré de Yango / Uber / Bolt.

## Installation

1. Ouvre un terminal dans `vtc-app`
2. Exécute `npm install`
3. Exécute `npm start`

## Pages disponibles

- `http://localhost:3000/passenger.html` : interface passager
- `http://localhost:3000/driver.html` : interface chauffeur

## Configuration

- Remplace `YOUR_MAPBOX_ACCESS_TOKEN` dans les fichiers HTML par ta clé Mapbox.
- Tu peux aussi remplacer la clé Mapbox par Google Maps si tu veux.

## Fonctionnalités intégrées

- Socket.IO pour la position GPS en direct
- création de course
- acceptation de course par le chauffeur
- diffusion en temps réel des mises à jour au passager
- interface de suivi et map interactive
- architecture prête pour les directions API et l’animation du marqueur
