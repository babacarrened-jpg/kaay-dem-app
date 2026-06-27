<div style="max-width: 1100px; margin: 40px auto; padding: 0 20px;">
    
    <div class="page-header">
        <div class="page-title-group">
            <div class="page-title-icon">
                <i data-lucide="car" width="28" height="28"></i>
            </div>
            <div>
                <h1>Espace Conducteur</h1>
                <p>Gérez vos trajets proposés et vos réservations passagers.</p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>conducteur/trajets/nouveau" class="btn btn-primary">
            <i data-lucide="plus-circle"></i> Publier un trajet
        </a>
    </div>

    <?php if(isset($_GET['success']) && $_GET['success'] == 'trajet_publie'): ?>
        <div style="background: var(--kd-primary-light); color: var(--kd-primary); padding: 16px 20px; border-radius: var(--radius-sm); margin-bottom: 32px; display: flex; align-items: center; gap: 12px;">
            <i data-lucide="check-circle" width="24" height="24"></i>
            <div>
                <strong>Félicitations !</strong> Votre trajet a bien été publié. Les passagers peuvent maintenant le réserver.
            </div>
        </div>
    <?php endif; ?>

    <!-- Statistiques Conducteur -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-bottom: 40px;">
        <a href="<?= BASE_URL ?>conducteur/trajets" class="glass-panel" style="padding: 24px; display: flex; align-items: center; gap: 20px; text-decoration:none; color:inherit; transition: transform 0.15s;">
            <div style="width: 56px; height: 56px; background: var(--kd-primary-light); color: var(--kd-primary); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                <i data-lucide="map" width="28" height="28"></i>
            </div>
            <div>
                <div style="color: var(--text-muted); font-size: 14px; font-weight: 500;">Trajets actifs</div>
                <div style="font-family: 'Outfit'; font-size: 32px; font-weight: 700; color: var(--text-main); line-height: 1; margin-top: 4px;"><?= $trajets_actifs ?></div>
            </div>
        </a>
        
        <a href="<?= BASE_URL ?>conducteur/reservations" class="glass-panel" style="padding: 24px; display: flex; align-items: center; gap: 20px; text-decoration:none; color:inherit; transition: transform 0.15s;">
            <div style="width: 56px; height: 56px; background: rgba(249, 168, 37, 0.1); color: var(--kd-accent-dark); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                <i data-lucide="bell" width="28" height="28"></i>
            </div>
            <div>
                <div style="color: var(--text-muted); font-size: 14px; font-weight: 500;">Réservations en attente</div>
                <div style="font-family: 'Outfit'; font-size: 32px; font-weight: 700; color: var(--text-main); line-height: 1; margin-top: 4px;"><?= $reservations_attente ?></div>
            </div>
        </a>
        
        <div class="glass-panel" style="padding: 24px; display: flex; align-items: center; gap: 20px;">
            <div style="width: 56px; height: 56px; background: rgba(21, 101, 192, 0.1); color: #1565C0; border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                <i data-lucide="wallet" width="28" height="28"></i>
            </div>
            <div>
                <div style="color: var(--text-muted); font-size: 14px; font-weight: 500;">Gains ce mois</div>
                <div style="font-family: 'Outfit'; font-size: 32px; font-weight: 700; color: var(--kd-primary); line-height: 1; margin-top: 4px;"><?= number_format($gains_mois, 0, ',', ' ') ?> <span style="font-size:20px;">F</span></div>
            </div>
        </div>
    </div>

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 24px;">
        <h3 style="font-size: 20px; margin:0; font-family: 'Outfit'; display: flex; align-items: center; gap: 8px;">
            <i data-lucide="calendar-check" width="20" height="20" style="color:var(--text-muted);"></i> Mes trajets actifs
        </h3>
        <a href="<?= BASE_URL ?>conducteur/trajets" style="font-size:14px; font-weight:600; color:var(--kd-primary); text-decoration:none; display:flex; align-items:center; gap:4px;">
            Voir tous mes trajets <i data-lucide="arrow-right" width="16" height="16"></i>
        </a>
    </div>

    <?php if(!empty($trajets)): ?>
        <div class="glass-panel" style="margin-bottom: 32px; padding: 0; overflow: hidden; border-radius: 24px;">
            <div style="padding: 24px 28px; display:flex; justify-content:space-between; align-items:center; gap:16px; background: var(--kd-bg);">
                <div>
                    <div style="color: var(--text-muted); font-size: 14px; font-weight: 500; margin-bottom: 6px;">Carte des trajets</div>
                    <h2 style="font-size: 22px; font-weight: 800; margin: 0;">Visualisez tous vos trajets actifs</h2>
                </div>
                <span style="background: rgba(14, 165, 233, 0.1); color: #0284c7; padding: 10px 16px; border-radius: 999px; font-size: 14px; font-weight: 700;">
                    <?= count($trajets) ?> trajet<?= count($trajets) > 1 ? 's' : '' ?> actif<?= count($trajets) > 1 ? 's' : '' ?>
                </span>
            </div>
            <div id="conducteur-trajets-map" style="width:100%; height:420px;"></div>
            <div id="conducteur-map-error" style="display:none; position:absolute; inset:0; background:rgba(15,23,42,0.88); color:#F8FAFC; display:flex; align-items:center; justify-content:center; text-align:center; padding:24px; font-size:16px;">
                Impossible d'afficher votre carte. Vérifiez votre connexion et réessayez.
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px;">
            <?php foreach($trajets as $trajet): ?>
                <div class="glass-panel" style="padding: 22px;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 16px; margin-bottom: 18px;">
                        <div>
                            <div style="font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.15em; color: var(--kd-primary); margin-bottom: 8px;"><?= htmlspecialchars($trajet->statut) ?></div>
                            <h3 style="margin:0; font-size: 18px; font-weight: 800;"><?= htmlspecialchars($trajet->ville_depart) ?> → <?= htmlspecialchars($trajet->ville_arrivee) ?></h3>
                        </div>
                        <div style="font-size: 20px; font-weight: 800; color: var(--kd-primary);"><?= number_format($trajet->prix_par_place, 0, ',', ' ') ?> F</div>
                    </div>
                    <p style="color: var(--text-muted); margin-bottom: 14px;">Départ : <?= date('d/m/Y', strtotime($trajet->date_trajet)) ?> à <?= substr($trajet->heure_depart, 0, 5) ?></p>
                    <div style="display:flex; justify-content:space-between; gap:10px; font-size:13px; color:var(--text-muted); margin-bottom: 16px;">
                        <span><i data-lucide="users" width="14" height="14" style="vertical-align:middle;"></i> <?= $trajet->places_disponibles ?> places restantes</span>
                        <span><i data-lucide="truck" width="14" height="14" style="vertical-align:middle;"></i> <?= htmlspecialchars($trajet->marque . ' ' . $trajet->modele) ?></span>
                    </div>
                    <form action="<?= BASE_URL ?>conducteur/trajet/<?= $trajet->id ?>/annuler" method="POST" onsubmit="return confirm('Annuler ce trajet ? Cette action est irréversible.');">
                        <button type="submit" class="btn btn-outline" style="width:100%; justify-content:center; font-size:13px; padding:10px;">
                            <i data-lucide="x-circle" width="16" height="16"></i> Annuler ce trajet
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="glass-panel" style="text-align: center; padding: 60px 20px;">
            <div style="width: 80px; height: 80px; background: var(--kd-bg); color: var(--text-muted); border-radius: 24px; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
                <i data-lucide="car-front" width="40" height="40"></i>
            </div>
            <h3 style="font-size: 24px; margin-bottom: 8px;">Aucun trajet prévu</h3>
            <p style="color: var(--text-muted); margin-bottom: 24px;">Vous n'avez aucun trajet planifié pour le moment.</p>
            <a href="<?= BASE_URL ?>conducteur/trajets/nouveau" class="btn btn-outline">
                <i data-lucide="plus"></i> Publier votre premier trajet
            </a>
        </div>
    <?php endif; ?>

</div>

<?php if(!empty($trajets)): ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const conducteurTrips = <?= json_encode(array_map(function($trajet) {
            return [
                'id' => $trajet->id,
                'depart' => $trajet->point_depart ?: $trajet->ville_depart,
                'arrivee' => $trajet->point_arrivee ?: $trajet->ville_arrivee,
                'ville_depart' => $trajet->ville_depart,
                'ville_arrivee' => $trajet->ville_arrivee,
                'date' => $trajet->date_trajet,
                'heure' => substr($trajet->heure_depart, 0, 5),
                'prix' => $trajet->prix_par_place,
                'places' => $trajet->places_disponibles,
                'vehicule' => $trajet->marque . ' ' . $trajet->modele,
                'statut' => $trajet->statut
            ];
        }, $trajets), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>;

        const getMarkerIcon = (color) => {
            return L.divIcon({
                className: 'custom-marker',
                html: `<span style="display:inline-block;width:16px;height:16px;border-radius:9999px;background:${color};border:2px solid white;box-shadow:0 0 10px ${color};"></span>`,
                iconSize: [20, 20],
                iconAnchor: [10, 10]
            });
        };

        const showConducteurMapError = () => {
            document.getElementById('conducteur-map-error').style.display = 'flex';
        };

        const geocode = async (query) => {
            const url = `https://nominatim.openstreetmap.org/search?format=json&limit=1&q=${encodeURIComponent(query)}`;
            const response = await fetch(url, { headers: { 'Accept': 'application/json' } });
            const data = await response.json();
            if (!data || !data.length) {
                throw new Error('Geocoding failed');
            }
            return { lat: parseFloat(data[0].lat), lon: parseFloat(data[0].lon) };
        };

        const fetchRoute = async (from, to) => {
            const routeUrl = `https://router.project-osrm.org/route/v1/driving/${from.lon},${from.lat};${to.lon},${to.lat}?overview=full&geometries=geojson`;
            const response = await fetch(routeUrl);
            const data = await response.json();
            if (!data.routes || !data.routes.length) {
                throw new Error('No route found');
            }
            return data.routes[0].geometry;
        };

        const initConducteurMap = async () => {
            if (!conducteurTrips.length || typeof L === 'undefined') {
                showConducteurMapError();
                return;
            }

            const map = L.map('conducteur-trajets-map', {
                center: [14.715, -17.467],
                zoom: 9,
                zoomControl: false
            });

            L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; <a href="https://carto.com/">CARTO</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                maxZoom: 19
            }).addTo(map);

            const bounds = L.latLngBounds([]);
            const colors = ['#38bdf8', '#f97316', '#22c55e', '#a855f7', '#fb7185'];

            for (let index = 0; index < conducteurTrips.length; index++) {
                const trajet = conducteurTrips[index];
                const color = colors[index % colors.length];

                try {
                    const from = await geocode(`${trajet.depart}, Sénégal`);
                    const to = await geocode(`${trajet.arrivee}, Sénégal`);
                    const geometry = await fetchRoute(from, to);

                    const routeLayer = L.geoJSON(geometry, {
                        style: { color: color, weight: 5, opacity: 0.85 }
                    }).addTo(map);
                    bounds.extend(routeLayer.getBounds());

                    const departMarker = L.marker([from.lat, from.lon], { icon: getMarkerIcon(color) })
                        .bindPopup(`<strong>Départ</strong><br>${trajet.depart}<br><small>${trajet.date} ${trajet.heure}</small>`)
                        .addTo(map);
                    const arriveeMarker = L.marker([to.lat, to.lon], { icon: getMarkerIcon(color) })
                        .bindPopup(`<strong>Arrivée</strong><br>${trajet.arrivee}<br><small>${trajet.date} ${trajet.heure}</small>`)
                        .addTo(map);

                } catch (error) {
                    console.error(error);
                }
            }

            if (bounds.isValid()) {
                map.fitBounds(bounds, { padding: [40, 40] });
            }
        };

        document.addEventListener('DOMContentLoaded', initConducteurMap);
    </script>
<?php endif; ?>