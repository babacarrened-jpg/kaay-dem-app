<div style="max-width: 1100px; margin: 40px auto; padding: 0 20px;">
    
    <div class="page-header">
        <div class="page-title-group">
            <div class="page-title-icon">
                <i data-lucide="list" width="28" height="28"></i>
            </div>
            <div>
                <h1>Trajets disponibles</h1>
                <p>
                    <i data-lucide="map-pin" width="14" height="14" style="display:inline; margin-right:4px;"></i> 
                    <strong><?= htmlspecialchars($depart ?: 'Toutes villes') ?></strong> → 
                    <strong><?= htmlspecialchars($arrivee ?: 'Toutes villes') ?></strong>
                    <?php if($date): ?> | <i data-lucide="calendar" width="14" height="14" style="display:inline; margin:0 4px;"></i> <?= date('d/m/Y', strtotime($date)) ?><?php endif; ?>
                </p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>trajets/recherche" class="btn btn-outline">
            <i data-lucide="edit-3"></i> Modifier
        </a>
    </div>

    <?php if(!empty($depart) && !empty($arrivee)): ?>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

        <div class="glass-panel" style="margin-bottom:24px; padding:0; overflow:hidden; position:relative;">
            <div style="padding:20px 24px; display:flex; flex-wrap:wrap; justify-content:space-between; gap:16px; align-items:center; background:rgba(15,23,42,0.95);">
                <div>
                    <div style="font-size:12px; text-transform:uppercase; letter-spacing:0.2em; color:var(--kd-primary); margin-bottom:8px;">Itinéraire</div>
                    <h2 style="margin:0; font-size:20px; color:#F8FAFC;"><?= htmlspecialchars($depart) ?> → <?= htmlspecialchars($arrivee) ?></h2>
                    <?php if($date): ?>
                        <p style="margin:8px 0 0; color:var(--text-muted); font-size:14px;">Date du trajet : <?= date('d/m/Y', strtotime($date)) ?></p>
                    <?php endif; ?>
                </div>
                <div style="font-size:14px; color:var(--text-muted); text-align:right;">
                    <div>Carte interactive libre</div>
                    <div style="margin-top:4px;">Zoom automatique + trace routière OSRM</div>
                </div>
            </div>
            <div id="search-route-map" style="width:100%; height:360px;"></div>
            <div id="search-route-error" style="display:none; position:absolute; inset:0; background:rgba(15,23,42,0.88); color:#F8FAFC; display:flex; align-items:center; justify-content:center; text-align:center; padding:24px; font-size:16px;">
                Impossible d'afficher la carte pour ces villes. Vérifiez l'orthographe ou modifiez votre recherche.
            </div>
        </div>
    <?php endif; ?>

    <?php if(empty($trajets)): ?>
        <div class="glass-panel" style="text-align: center; padding: 60px 20px;">
            <div style="width: 80px; height: 80px; background: var(--kd-danger-light); color: var(--kd-danger); border-radius: 24px; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px; transform: rotate(10deg);">
                <i data-lucide="frown" width="40" height="40"></i>
            </div>
            <h3 style="font-size: 24px; margin-bottom: 8px;">Aucun trajet trouvé</h3>
            <p style="color: var(--text-muted); margin-bottom: 24px;">Désolé, nous n'avons trouvé aucun trajet correspondant à vos critères pour le moment.</p>
            <a href="<?= BASE_URL ?>trajets/recherche" class="btn btn-primary">
                <i data-lucide="search"></i> Nouvelle recherche
            </a>
        </div>
    <?php else: ?>
        <div style="margin-bottom: 20px; color: var(--text-muted); font-size: 14px; display: flex; flex-wrap: wrap; gap: 16px; align-items: center;">
            <i data-lucide="info" width="16" height="16"></i>
            Cliquez sur une offre pour voir les détails puis réserver.
            <?php if(!empty($prix_min) || !empty($prix_max) || !empty($places_min) || !empty($places_max)): ?>
                <span style="display:inline-flex; align-items:center; gap:4px; padding:6px 12px; background:#F8FAFC; border-radius:999px;">
                    <strong>Filtres :</strong>
                    <?= !empty($prix_min) ? 'Prix min ' . htmlspecialchars($prix_min) . ' F' : '' ?>
                    <?= !empty($prix_max) ? 'Prix max ' . htmlspecialchars($prix_max) . ' F' : '' ?>
                    <?= !empty($places_min) ? 'Places min ' . htmlspecialchars($places_min) : '' ?>
                    <?= !empty($places_max) ? 'Places max ' . htmlspecialchars($places_max) : '' ?>
                </span>
            <?php endif; ?>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px;">
            <?php foreach($trajets as $trajet): ?>
                <div class="glass-panel" style="padding: 24px; display: flex; flex-direction: column; cursor: pointer; position: relative; overflow: hidden;" onclick="window.location='<?= BASE_URL ?>trajets/detail/<?= $trajet->id ?>'">
                    
                    <!-- Ligne colorée au hover -->
                    <div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: var(--kd-primary); transform: scaleX(0); transform-origin: left; transition: var(--transition);" class="card-hover-bar"></div>

                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px;">
                        <div style="background: var(--kd-bg); padding: 8px 12px; border-radius: 8px; font-weight: 600; font-size: 13px; color: var(--text-main); display: flex; align-items: center; gap: 6px;">
                            <i data-lucide="calendar" width="14" height="14" style="color:var(--text-muted);"></i> <?= date('d/m/Y', strtotime($trajet->date_trajet)) ?> 
                            <span style="color:#CBD5E1;">|</span>
                            <i data-lucide="clock" width="14" height="14" style="color:var(--text-muted);"></i> <?= substr($trajet->heure_depart, 0, 5) ?>
                        </div>
                        <div style="font-family: 'Outfit'; font-weight: 700; font-size: 22px; color: var(--kd-primary);">
                            <?= number_format($trajet->prix_par_place, 0, ',', ' ') ?> F
                        </div>
                    </div>

                    <div style="font-family: 'Outfit'; font-weight: 600; font-size: 20px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
                        <?= htmlspecialchars($trajet->ville_depart) ?> 
                        <i data-lucide="arrow-right" style="color:var(--text-muted);" width="20" height="20"></i>
                        <?= htmlspecialchars($trajet->ville_arrivee) ?>
                    </div>

                    <div style="display: flex; align-items: center; gap: 16px; margin-top: auto; padding-top: 20px; border-top: 1px solid #E2E8F0;">
                        <div class="user-avatar" style="width:40px; height:40px; font-size: 16px;">
                            <?= substr($trajet->conducteur_prenom, 0, 1) ?>
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 600; font-size: 14px;"><?= htmlspecialchars($trajet->conducteur_prenom . ' ' . substr($trajet->conducteur_nom, 0, 1) . '.') ?></div>
                            <div style="font-size: 13px; color: var(--text-muted); display:flex; align-items:center; gap:4px;">
                                <i data-lucide="star" width="12" height="12" style="color:var(--kd-accent-dark); fill:var(--kd-accent-dark);"></i> 4.8/5
                            </div>
                        </div>
                        <div style="background: var(--kd-primary-light); color: var(--kd-primary); font-size: 12px; font-weight: 600; padding: 4px 10px; border-radius: 50px; display:flex; align-items:center; gap:4px;">
                            <i data-lucide="users" width="14" height="14"></i> <?= $trajet->places_disponibles ?>
                        </div>
                    </div>

                    <button type="button"
                        style="margin-top: 16px; width: 100%; border: 0; border-radius: 999px; background: linear-gradient(135deg, #dc2626, #b91c1c); color: white; padding: 12px 14px; font-weight: 800; cursor: pointer; box-shadow: 0 10px 24px rgba(220, 38, 38, 0.25);"
                        onclick="event.stopPropagation(); window.location='<?= BASE_URL ?>trajets/detail/<?= $trajet->id ?>'">
                        Voir le trajet & réserver
                    </button>

                </div>
            <?php endforeach; ?>
        </div>

        <?php if(!empty($pagination) && $pagination['totalPages'] > 1): ?>
            <div style="margin-top: 32px; display: flex; justify-content: center; gap: 8px; flex-wrap: wrap;">
                <?php for($p = 1; $p <= $pagination['totalPages']; $p++): ?>
                    <?php
                        $queryParams = array_filter([
                            'depart' => $depart,
                            'arrivee' => $arrivee,
                            'date' => $date,
                            'prix_min' => $prix_min,
                            'prix_max' => $prix_max,
                            'places_min' => $places_min,
                            'places_max' => $places_max,
                            'page' => $p
                        ], fn($value) => $value !== '' && $value !== null);
                        $query = http_build_query($queryParams);
                    ?>
                    <a href="<?= BASE_URL ?>trajets/resultats?<?= $query ?>"
                       class="btn <?= $p === $pagination['currentPage'] ? 'btn-primary' : 'btn-outline' ?>"
                       style="min-width: 44px; padding: 10px 14px;">
                        <?= $p ?>
                    </a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<script>
    (function() {
        const depart = <?= json_encode($depart) ?>;
        const arrivee = <?= json_encode($arrivee) ?>;
        const mapContainer = document.getElementById('search-route-map');
        const mapError = document.getElementById('search-route-error');

        const createMarkerIcon = (color) => {
            return L.divIcon({
                className: 'custom-marker',
                html: `<span style="display:inline-block;width:16px;height:16px;border-radius:9999px;background:${color};border:2px solid white;box-shadow:0 0 10px ${color};"></span>`,
                iconSize: [20, 20],
                iconAnchor: [10, 10]
            });
        };

        const showMapError = () => {
            if (mapContainer) mapContainer.style.display = 'none';
            if (mapError) mapError.style.display = 'flex';
        };

        const geocode = async query => {
            const url = `https://nominatim.openstreetmap.org/search?format=json&limit=1&countrycodes=sn&q=${encodeURIComponent(query)}`;
            const response = await fetch(url, { headers: { 'Accept': 'application/json' } });
            const data = await response.json();
            if (!data || !data.length) throw new Error('Geocoding failed');
            return { lat: parseFloat(data[0].lat), lon: parseFloat(data[0].lon) };
        };

        const fetchRoute = async (from, to) => {
            const routeUrl = `https://router.project-osrm.org/route/v1/driving/${from.lon},${from.lat};${to.lon},${to.lat}?overview=full&geometries=geojson`;
            const response = await fetch(routeUrl);
            const data = await response.json();
            if (!data.routes || !data.routes.length) throw new Error('No route found');
            return data.routes[0].geometry;
        };

        const initMap = async () => {
            if (!depart || !arrivee || !mapContainer || typeof L === 'undefined') {
                showMapError();
                return;
            }

            try {
                const origin = await geocode(depart);
                const destination = await geocode(arrivee);

                const map = L.map('search-route-map', {
                    center: [origin.lat, origin.lon],
                    zoom: 10,
                    zoomControl: false
                });

                L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
                    attribution: '&copy; <a href="https://carto.com/">CARTO</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                    maxZoom: 19
                }).addTo(map);

                const routeGeoJson = await fetchRoute(origin, destination);
                const routeLayer = L.geoJSON(routeGeoJson, {
                    style: { color: '#38bdf8', weight: 5, opacity: 0.95 }
                }).addTo(map);

                const bounds = routeLayer.getBounds();
                bounds.extend([origin.lat, origin.lon]);
                bounds.extend([destination.lat, destination.lon]);
                map.fitBounds(bounds, { padding: [40, 40] });

                L.marker([origin.lat, origin.lon], { icon: createMarkerIcon('#4ade80') })
                    .bindPopup(`<strong>${depart}</strong><br><span style="color:#CBD5E1;">Départ</span>`)
                    .addTo(map);

                L.marker([destination.lat, destination.lon], { icon: createMarkerIcon('#fb7185') })
                    .bindPopup(`<strong>${arrivee}</strong><br><span style="color:#CBD5E1;">Arrivée</span>`)
                    .addTo(map);
            } catch (err) {
                console.error(err);
                showMapError();
            }
        };

        document.addEventListener('DOMContentLoaded', initMap);
    })();
</script>
<style>
.glass-panel:hover .card-hover-bar { transform: scaleX(1); }
</style>
