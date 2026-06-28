<div style="min-height: 100vh; padding: 40px 20px 60px; box-sizing: border-box; background-color: #f7f9fa; background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAxNDAgODAiPjx0ZXh0IHg9IjE1IiB5PSIzMCIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+S0FBWTwvdGV4dD48dGV4dCB4PSIxNSIgeT0iNDUiIGZpbGw9IiNkYzI2MjYiIG9wYWNpdHk9IjAuMDciIGZvbnQtZmFtaWx5PSJzYW5zLXNlcmlmIiBmb250LXdlaWdodD0iOTAwIiBmb250LXNpemU9IjEyIiBsZXR0ZXItc3BhY2luZz0iMC41cHkiPkRFTU08L3RleHQ+PHRleHQgeD0iODUiIHk9IjcwIiBmaWxsPSIjZGMyNjI2IiBvcGFjaXR5PSIwLjA3IiBmb250LWZhbWlseT0ic2Fucy1zZXJpZiIgZm9udC13ZWlnaHQ9IjkwMCIgZm9udC1zaXplPSIxMiIgbGV0dGVyLXNwYWNpbmc9IjAuNXB5Ij5LQUFZPC90ZXh0Pjx0ZXh0IHg9Ijg1IiB5PSI4NSIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+REVNTTwvdGV4dD48L3N2Zz4='); background-repeat: repeat; font-family: system-ui, -apple-system, sans-serif;">

    <div style="max-width: 1100px; margin: 0 auto;">

        <div class="page-header" style="display:flex; justify-content:space-between; align-items:center; gap:20px; margin-bottom:32px; padding:24px 28px; border-radius:24px; background:rgba(255,255,255,0.8); border:1px solid rgba(229,231,235,0.7); box-shadow:0 16px 40px rgba(0,0,0,0.04); backdrop-filter:blur(12px); -webkit-backdrop-filter:blur(12px);">
            <div class="page-title-group" style="display:flex; align-items:center; gap:16px;">
                <div class="page-title-icon" style="width:56px; height:56px; background:#dc2626; color:white; border-radius:18px; display:flex; align-items:center; justify-content:center;">
                    <i data-lucide="car" width="28" height="28"></i>
                </div>
                <div>
                    <h1 style="font-size:2rem; margin:0;">Espace Conducteur</h1>
                    <p style="margin:4px 0 0; color:#64748b;">Gérez vos trajets et réservations.</p>
                </div>
            </div>
            <a href="<?= BASE_URL ?>conducteur/trajets/nouveau"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold text-white bg-brand-600 hover:bg-brand-700 hover:-translate-y-0.5 transition-all duration-200 shadow-md hover:shadow-lg"
               style="text-decoration:none;">
                <i data-lucide="plus-circle" width="20" height="20" style="vertical-align:middle;"></i>
                Nouveau trajet
            </a>
        </div>

        <?php if(isset($_GET['success']) && $_GET['success'] == 'trajet_publie'): ?>
            <div id="publish-success-banner" style="background:#DCFCE7; color:#166534; padding:16px 20px; border-radius:12px; margin-bottom:32px; display:flex; align-items:center; gap:12px; box-shadow:0 8px 24px rgba(22,101,52,0.14);">
                <i data-lucide="check-circle" width="24" height="24"></i>
                <strong>Félicitations !</strong> Votre trajet a bien été publié.
            </div>
        <?php endif; ?>

    <!-- Statistiques : 4 cartes -->
    <div style="display:grid; grid-template-columns:repeat(4, 1fr); gap:20px; margin-bottom:40px;">

        <!-- Trajets actifs -->
        <a href="<?= BASE_URL ?>conducteur/trajets" class="glass-panel" style="padding:24px; display:flex; align-items:center; gap:16px; text-decoration:none; color:inherit; transition:transform 0.15s;" onmouseover="this.style.transform='translateY(-3px)';" onmouseout="this.style.transform='translateY(0)';">
            <div style="width:50px; height:50px; background:#FEE2E2; color:#dc2626; border-radius:14px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                <i data-lucide="map" width="24" height="24"></i>
            </div>
            <div>
                <div style="color:#64748b; font-size:13px; font-weight:500;">Trajets actifs</div>
                <div style="font-size:28px; font-weight:800; color:#0f172a; line-height:1; margin-top:2px;"><?= $trajets_actifs ?></div>
            </div>
        </a>

        <!-- Réservations en attente -->
        <a href="<?= BASE_URL ?>conducteur/reservations" class="glass-panel" style="padding:24px; display:flex; align-items:center; gap:16px; text-decoration:none; color:inherit; transition:transform 0.15s;" onmouseover="this.style.transform='translateY(-3px)';" onmouseout="this.style.transform='translateY(0)';">
            <div style="width:50px; height:50px; background:#FEF3C7; color:#d97706; border-radius:14px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                <i data-lucide="bell" width="24" height="24"></i>
            </div>
            <div>
                <div style="color:#64748b; font-size:13px; font-weight:500;">En attente</div>
                <div style="font-size:28px; font-weight:800; color:#0f172a; line-height:1; margin-top:2px;"><?= $reservations_attente ?></div>
            </div>
        </a>

        <!-- Gains ce mois -->
        <div class="glass-panel" style="padding:24px; display:flex; align-items:center; gap:16px;">
            <div style="width:50px; height:50px; background:#DBEAFE; color:#1d4ed8; border-radius:14px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                <i data-lucide="wallet" width="24" height="24"></i>
            </div>
            <div>
                <div style="color:#64748b; font-size:13px; font-weight:500;">Gains ce mois</div>
                <div style="font-size:24px; font-weight:800; color:#dc2626; line-height:1; margin-top:2px;"><?= number_format($gains_mois, 0, ',', ' ') ?> F</div>
            </div>
        </div>

        <!-- Note moyenne -->
        <a href="<?= BASE_URL ?>conducteur/avis" class="glass-panel" style="padding:24px; display:flex; align-items:center; gap:16px; text-decoration:none; color:inherit; transition:transform 0.15s;" onmouseover="this.style.transform='translateY(-3px)';" onmouseout="this.style.transform='translateY(0)';">
            <div style="width:50px; height:50px; background:#FEF3C7; color:#d97706; border-radius:14px; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:22px;">
                ★
            </div>
            <div>
                <div style="color:#64748b; font-size:13px; font-weight:500;">Mes note</div>
                <div style="font-size:28px; font-weight:800; color:#d97706; line-height:1; margin-top:2px;">
                    <?= $note_moyenne > 0 ? number_format($note_moyenne, 1) . '<span style="font-size:16px; color:#94a3b8;">/5</span>' : '—' ?>
                </div>
            </div>
        </a>

    </div>

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
        <h3 style="font-size:20px; margin:0; display:flex; align-items:center; gap:8px;">
            <i data-lucide="calendar-check" width="20" height="20" style="color:#64748b;"></i> Mes trajets actifs
        </h3>
        <a href="<?= BASE_URL ?>conducteur/trajets" style="font-size:14px; font-weight:600; color:#dc2626; text-decoration:none; display:flex; align-items:center; gap:4px;">
            Voir tous mes trajets <i data-lucide="arrow-right" width="16" height="16"></i>
        </a>
    </div>

    <?php if(!empty($trajets)): ?>
        <div class="glass-panel" style="margin-bottom:32px; padding:0; overflow:hidden; border-radius:24px;">
            <div style="padding:24px 28px; display:flex; justify-content:space-between; align-items:center; gap:16px;">
                <div>
                    <div style="color:#64748b; font-size:14px; font-weight:500; margin-bottom:6px;">Carte des trajets</div>
                    <h2 style="font-size:22px; font-weight:800; margin:0;">Visualisez tous vos trajets actifs</h2>
                </div>
                <span style="background:rgba(14,165,233,0.1); color:#0284c7; padding:10px 16px; border-radius:999px; font-size:14px; font-weight:700;">
                    <?= count($trajets) ?> trajet<?= count($trajets) > 1 ? 's' : '' ?> actif<?= count($trajets) > 1 ? 's' : '' ?>
                </span>
            </div>
            <div id="conducteur-trajets-map" style="width:100%; height:420px;"></div>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(320px, 1fr)); gap:24px;">
            <?php foreach($trajets as $trajet): ?>
                <div class="glass-panel" style="padding:22px;">
                    <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:16px; margin-bottom:18px;">
                        <div>
                            <div style="font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:#dc2626; margin-bottom:6px;"><?= htmlspecialchars($trajet->statut) ?></div>
                            <h3 style="margin:0; font-size:18px; font-weight:800;"><?= htmlspecialchars($trajet->ville_depart) ?> → <?= htmlspecialchars($trajet->ville_arrivee) ?></h3>
                        </div>
                        <div style="font-size:18px; font-weight:800; color:#dc2626;"><?= number_format($trajet->prix_par_place, 0, ',', ' ') ?> F</div>
                    </div>
                    <p style="color:#64748b; margin-bottom:14px; font-size:14px;">
                        <?= date('d/m/Y', strtotime($trajet->date_trajet)) ?> à <?= substr($trajet->heure_depart, 0, 5) ?>
                    </p>
                    <div style="display:flex; justify-content:space-between; font-size:13px; color:#64748b; margin-bottom:16px;">
                        <span><i data-lucide="users" width="14" height="14" style="vertical-align:middle;"></i> <?= $trajet->places_disponibles ?> places restantes</span>
                        <span><i data-lucide="truck" width="14" height="14" style="vertical-align:middle;"></i> <?= htmlspecialchars($trajet->marque . ' ' . $trajet->modele) ?></span>
                    </div>

                    <div style="margin-bottom:16px; border:1px solid #e5e7eb; border-radius:14px; overflow:hidden; background:#f8fafc;">
                        <div style="padding:10px 12px; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:#64748b; display:flex; align-items:center; gap:6px; border-bottom:1px solid #e5e7eb; background:white;">
                            <i data-lucide="route" width="14" height="14" style="color:#dc2626;"></i>
                            Itinéraire du trajet
                        </div>
                        <div id="trip-map-<?= $trajet->id ?>"
                             class="trip-mini-map"
                             data-route-map="true"
                             data-depart="<?= htmlspecialchars($trajet->point_depart ?: $trajet->ville_depart) ?>"
                             data-arrivee="<?= htmlspecialchars($trajet->point_arrivee ?: $trajet->ville_arrivee) ?>"
                             style="width:100%; height:180px; background:#0f172a;"></div>
                    </div>

                    <form action="<?= BASE_URL ?>conducteur/trajet/<?= $trajet->id ?>/annuler" method="POST"
                          onsubmit="return confirm('Annuler ce trajet ? Cette action est irréversible.');">
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-xl text-sm font-semibold text-white transition-all duration-200"
                            style="background:#dc2626; border:none; cursor:pointer;"
                            onmouseover="this.style.background='#b91c1c';"
                            onmouseout="this.style.background='#dc2626';">
                            <i data-lucide="x-circle" width="16" height="16" style="vertical-align:middle;"></i>
                            Annuler ce trajet
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="glass-panel" style="text-align:center; padding:60px 20px;">
            <div style="font-size:64px; margin-bottom:16px;">🚗</div>
            <h3 style="font-size:24px; margin-bottom:8px;">Aucun trajet prévu</h3>
            <p style="color:#64748b; margin-bottom:24px;">Publiez votre premier trajet !</p>
            <a href="<?= BASE_URL ?>conducteur/trajets/nouveau"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold text-white bg-brand-600 hover:bg-brand-700 transition-all duration-200"
               style="text-decoration:none;">
                <i data-lucide="plus-circle" width="20" height="20" style="vertical-align:middle;"></i> Publier un trajet
            </a>
        </div>
    <?php endif; ?>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const banner = document.getElementById('publish-success-banner');
        if (banner) {
            setTimeout(function () {
                banner.style.transition = 'opacity 0.35s ease';
                banner.style.opacity = '0';
                setTimeout(function () {
                    banner.style.display = 'none';
                }, 350);
            }, 4000);
        }
    });
</script>

<?php if(!empty($trajets)): ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const conducteurTrips = <?= json_encode(array_map(function($trajet) {
            return [
                'id'           => $trajet->id,
                'depart'       => $trajet->point_depart ?: $trajet->ville_depart,
                'arrivee'      => $trajet->point_arrivee ?: $trajet->ville_arrivee,
                'ville_depart' => $trajet->ville_depart,
                'ville_arrivee'=> $trajet->ville_arrivee,
                'date'         => $trajet->date_trajet,
                'heure'        => substr($trajet->heure_depart, 0, 5),
                'prix'         => $trajet->prix_par_place,
                'places'       => $trajet->places_disponibles,
                'vehicule'     => $trajet->marque . ' ' . $trajet->modele,
                'statut'       => $trajet->statut
            ];
        }, $trajets), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>;

        const getMarkerIcon = (color) => L.divIcon({
            className: 'custom-marker',
            html: `<span style="display:inline-block;width:16px;height:16px;border-radius:9999px;background:${color};border:2px solid white;box-shadow:0 0 10px ${color};"></span>`,
            iconSize: [20, 20], iconAnchor: [10, 10]
        });

        const geocode = async (query) => {
            const r = await fetch(`https://nominatim.openstreetmap.org/search?format=json&limit=1&q=${encodeURIComponent(query)}`, { headers: { 'Accept': 'application/json' } });
            const d = await r.json();
            if (!d.length) throw new Error('Geocoding failed');
            return { lat: parseFloat(d[0].lat), lon: parseFloat(d[0].lon) };
        };

        const fetchRoute = async (from, to) => {
            const r = await fetch(`https://router.project-osrm.org/route/v1/driving/${from.lon},${from.lat};${to.lon},${to.lat}?overview=full&geometries=geojson`);
            const d = await r.json();
            if (!d.routes?.length) throw new Error('No route');
            return d.routes[0].geometry;
        };

        const initConducteurMap = async () => {
            if (!conducteurTrips.length || typeof L === 'undefined') return;

            const map = L.map('conducteur-trajets-map', { center: [14.715, -17.467], zoom: 9, zoomControl: false });
            L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', { maxZoom: 19 }).addTo(map);

            const bounds = L.latLngBounds([]);
            const colors = ['#38bdf8', '#f97316', '#22c55e', '#a855f7', '#fb7185'];

            for (let i = 0; i < conducteurTrips.length; i++) {
                const t = conducteurTrips[i];
                const color = colors[i % colors.length];
                try {
                    const from = await geocode(`${t.depart}, Sénégal`);
                    const to   = await geocode(`${t.arrivee}, Sénégal`);
                    const geo  = await fetchRoute(from, to);
                    const layer = L.geoJSON(geo, { style: { color, weight: 5, opacity: 0.85 } }).addTo(map);
                    bounds.extend(layer.getBounds());
                    L.marker([from.lat, from.lon], { icon: getMarkerIcon(color) }).bindPopup(`<strong>Départ</strong><br>${t.depart}<br><small>${t.date} ${t.heure}</small>`).addTo(map);
                    L.marker([to.lat, to.lon],   { icon: getMarkerIcon(color) }).bindPopup(`<strong>Arrivée</strong><br>${t.arrivee}`).addTo(map);
                } catch(e) { console.error(e); }
            }

            if (bounds.isValid()) map.fitBounds(bounds, { padding: [40, 40] });
        };

        const initMiniRouteMaps = async () => {
            const containers = document.querySelectorAll('[data-route-map="true"]');
            if (!containers.length || typeof L === 'undefined') return;

            for (const container of containers) {
                const depart = container.getAttribute('data-depart');
                const arrivee = container.getAttribute('data-arrivee');
                if (!depart || !arrivee) continue;

                try {
                    const map = L.map(container, { zoomControl: false, dragging: false, scrollWheelZoom: false, doubleClickZoom: false, touchZoom: false, boxZoom: false });
                    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', { maxZoom: 19 }).addTo(map);

                    const from = await geocode(`${depart}, Sénégal`);
                    const to = await geocode(`${arrivee}, Sénégal`);
                    const geo = await fetchRoute(from, to);
                    const layer = L.geoJSON(geo, { style: { color: '#dc2626', weight: 4, opacity: 0.9 } }).addTo(map);
                    const bounds = layer.getBounds();
                    bounds.extend([from.lat, from.lon]);
                    bounds.extend([to.lat, to.lon]);
                    map.fitBounds(bounds, { padding: [12, 12] });

                    L.marker([from.lat, from.lon], { icon: getMarkerIcon('#22c55e') }).addTo(map);
                    L.marker([to.lat, to.lon], { icon: getMarkerIcon('#fb7185') }).addTo(map);
                } catch (e) {
                    container.innerHTML = '<div style="display:flex;align-items:center;justify-content:center;height:100%;color:#64748b;font-size:13px;">Carte indisponible</div>';
                }
            }
        };

        document.addEventListener('DOMContentLoaded', () => {
            initConducteurMap();
            initMiniRouteMaps();
        });
    </script>
<?php endif; ?>