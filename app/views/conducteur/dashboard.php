<div style="min-height: 100vh; padding: 40px 20px 60px; box-sizing: border-box; background-color: #f7f9fa; background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAxNDAgODAiPjx0ZXh0IHg9IjE1IiB5PSIzMCIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+S0FBWTwvdGV4dD48dGV4dCB4PSIxNSIgeT0iNDUiIGZpbGw9IiNkYzI2MjYiIG9wYWNpdHk9IjAuMDciIGZvbnQtZmFtaWx5PSJzYW5zLXNlcmlmIiBmb250LXdlaWdodD0iOTAwIiBmb250LXNpemU9IjEyIiBsZXR0ZXItc3BhY2luZz0iMC41cHkiPkRFTU88L3RleHQ+PHRleHQgeD0iODUiIHk9IjcwIiBmaWxsPSIjZGMyNjI2IiBvcGFjaXR5PSIwLjA3IiBmb250LWZhbWlseT0ic2Fucy1zZXJpZiIgZm9udC13ZWlnaHQ9IjkwMCIgZm9udC1zaXplPSIxMiIgbGV0dGVyLXNwYWNpbmc9IjAuNXB5Ij5LQUFZPC90ZXh0Pjx0ZXh0IHg9Ijg1IiB5PSI4NSIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+REVNTTwvdGV4dD48L3N2Zz4='); background-repeat: repeat; font-family: system-ui, -apple-system, sans-serif;">

    <div style="max-width: 1200px; margin: 0 auto;">

        <!-- Header -->
        <div style="display:flex; justify-content:space-between; align-items:center; gap:20px; margin-bottom:32px; padding:24px 28px; border-radius:24px; background:rgba(255,255,255,0.8); border:1px solid rgba(229,231,235,0.7); box-shadow:0 16px 40px rgba(0,0,0,0.04); backdrop-filter:blur(12px);">
            <div style="display:flex; align-items:center; gap:16px;">
                <div style="width:56px; height:56px; background:#dc2626; color:white; border-radius:18px; display:flex; align-items:center; justify-content:center;">
                    <i data-lucide="car" width="28" height="28"></i>
                </div>
                <div>
                    <h1 style="font-size:2rem; margin:0;">Espace Conducteur</h1>
                    <p style="margin:4px 0 0; color:#64748b;">Gérez vos trajets et réservations.</p>
                </div>
            </div>
            <a href="<?= BASE_URL ?>conducteur/trajets/nouveau"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold text-white bg-brand-600 hover:bg-brand-700 hover:-translate-y-0.5 transition-all duration-200 shadow-md"
               style="text-decoration:none;">
                <i data-lucide="plus-circle" width="20" height="20"></i> Nouveau trajet
            </a>
        </div>

        <?php if(isset($_GET['success']) && $_GET['success'] == 'trajet_publie'): ?>
            <div id="publish-success-banner" style="background:#DCFCE7; color:#166534; padding:16px 20px; border-radius:12px; margin-bottom:32px; display:flex; align-items:center; gap:12px;">
                <i data-lucide="check-circle" width="24" height="24"></i>
                <strong>Félicitations !</strong> Votre trajet a bien été publié.
            </div>
        <?php endif; ?>

        <!-- 4 Statistiques -->
        <div style="display:grid; grid-template-columns:repeat(4, 1fr); gap:20px; margin-bottom:48px;">

            <a href="<?= BASE_URL ?>conducteur/trajets" class="glass-panel" style="padding:28px; display:flex; align-items:center; gap:18px; text-decoration:none; color:inherit; transition:transform 0.2s,box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 32px rgba(0,0,0,0.1)';" onmouseout="this.style.transform='none';this.style.boxShadow='';">
                <div style="width:56px; height:56px; background:#FEE2E2; color:#dc2626; border-radius:16px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i data-lucide="map" width="28" height="28"></i>
                </div>
                <div>
                    <div style="color:#64748b; font-size:13px; font-weight:500; margin-bottom:4px;">Trajets actifs</div>
                    <div style="font-size:36px; font-weight:800; color:#0f172a; line-height:1;"><?= $trajets_actifs ?></div>
                </div>
            </a>

            <a href="<?= BASE_URL ?>conducteur/reservations" class="glass-panel" style="padding:28px; display:flex; align-items:center; gap:18px; text-decoration:none; color:inherit; transition:transform 0.2s,box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 32px rgba(0,0,0,0.1)';" onmouseout="this.style.transform='none';this.style.boxShadow='';">
                <div style="width:56px; height:56px; background:#FEF3C7; color:#d97706; border-radius:16px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i data-lucide="bell" width="28" height="28"></i>
                </div>
                <div>
                    <div style="color:#64748b; font-size:13px; font-weight:500; margin-bottom:4px;">En attente</div>
                    <div style="font-size:36px; font-weight:800; color:#0f172a; line-height:1;"><?= $reservations_attente ?></div>
                </div>
            </a>

            <div class="glass-panel" style="padding:28px; display:flex; align-items:center; gap:18px;">
                <div style="width:56px; height:56px; background:#DBEAFE; color:#1d4ed8; border-radius:16px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i data-lucide="wallet" width="28" height="28"></i>
                </div>
                <div>
                    <div style="color:#64748b; font-size:13px; font-weight:500; margin-bottom:4px;">Gains ce mois</div>
                    <div style="font-size:26px; font-weight:800; color:#dc2626; line-height:1;"><?= number_format($gains_mois, 0, ',', ' ') ?> F</div>
                </div>
            </div>

            <a href="<?= BASE_URL ?>conducteur/avis" class="glass-panel" style="padding:28px; display:flex; align-items:center; gap:18px; text-decoration:none; color:inherit; transition:transform 0.2s,box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 32px rgba(0,0,0,0.1)';" onmouseout="this.style.transform='none';this.style.boxShadow='';">
                <div style="width:56px; height:56px; background:#FEF3C7; color:#d97706; border-radius:16px; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:26px;">★</div>
                <div>
                    <div style="color:#64748b; font-size:13px; font-weight:500; margin-bottom:4px;">Ma note</div>
                    <div style="font-size:36px; font-weight:800; color:#d97706; line-height:1;">
                        <?= $note_moyenne > 0 ? number_format($note_moyenne, 1) . '<span style="font-size:18px;color:#94a3b8;">/5</span>' : '—' ?>
                    </div>
                </div>
            </a>

        </div>

        <!-- Titre section -->
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:28px;">
            <h3 style="font-size:22px; margin:0; font-weight:800; display:flex; align-items:center; gap:10px;">
                <i data-lucide="calendar-check" width="22" height="22" style="color:#dc2626;"></i> Mes trajets actifs
            </h3>
            <a href="<?= BASE_URL ?>conducteur/trajets" style="font-size:14px; font-weight:600; color:#dc2626; text-decoration:none; display:flex; align-items:center; gap:4px;">
                Voir tous <i data-lucide="arrow-right" width="16" height="16"></i>
            </a>
        </div>

        <?php if(!empty($trajets)): ?>
            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(420px, 1fr)); gap:28px;">
                <?php foreach($trajets as $trajet): ?>
                    <div class="glass-panel" style="padding:28px; border-radius:24px; transition:transform 0.2s,box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 16px 40px rgba(0,0,0,0.1)';" onmouseout="this.style.transform='none';this.style.boxShadow='';">

                        <!-- Badge + Prix -->
                        <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:16px; margin-bottom:14px;">
                            <div>
                                <span style="display:inline-block; background:#FEE2E2; color:#dc2626; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; padding:4px 10px; border-radius:999px; margin-bottom:8px;"><?= htmlspecialchars($trajet->statut) ?></span>
                                <h3 style="margin:0; font-size:20px; font-weight:800;"><?= htmlspecialchars($trajet->ville_depart) ?> → <?= htmlspecialchars($trajet->ville_arrivee) ?></h3>
                            </div>
                            <div style="text-align:right; flex-shrink:0;">
                                <div style="font-size:22px; font-weight:800; color:#dc2626;"><?= number_format($trajet->prix_par_place, 0, ',', ' ') ?> F</div>
                                <div style="font-size:12px; color:#94a3b8;">par place</div>
                            </div>
                        </div>

                        <!-- Infos -->
                        <div style="display:flex; gap:16px; flex-wrap:wrap; font-size:13px; color:#64748b; margin-bottom:16px;">
                            <span style="display:flex;align-items:center;gap:5px;"><i data-lucide="calendar" width="13" height="13"></i><?= date('d/m/Y', strtotime($trajet->date_trajet)) ?></span>
                            <span style="display:flex;align-items:center;gap:5px;"><i data-lucide="clock" width="13" height="13"></i><?= substr($trajet->heure_depart, 0, 5) ?></span>
                            <span style="display:flex;align-items:center;gap:5px;"><i data-lucide="users" width="13" height="13"></i><?= $trajet->places_disponibles ?> places restantes</span>
                            <span style="display:flex;align-items:center;gap:5px;"><i data-lucide="truck" width="13" height="13"></i><?= htmlspecialchars($trajet->marque . ' ' . $trajet->modele) ?></span>
                        </div>

                        <!-- Carte itinéraire -->
                        <div style="border-radius:16px; overflow:hidden; margin-bottom:20px; border:1px solid #e5e7eb;">
                            <div style="padding:10px 14px; background:white; border-bottom:1px solid #e5e7eb; display:flex; align-items:center; gap:8px;">
                                <i data-lucide="route" width="14" height="14" style="color:#dc2626;"></i>
                                <span style="font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; color:#64748b;">Itinéraire</span>
                                <span style="margin-left:auto; font-size:12px; color:#94a3b8;"><?= htmlspecialchars($trajet->ville_depart) ?> → <?= htmlspecialchars($trajet->ville_arrivee) ?></span>
                            </div>
                            <div id="trip-map-<?= $trajet->id ?>"
                                 data-route-map="true"
                                 data-depart="<?= htmlspecialchars($trajet->ville_depart) ?>"
                                 data-arrivee="<?= htmlspecialchars($trajet->ville_arrivee) ?>"
                                 style="width:100%; height:220px; background:#f1f5f9; position:relative;">
                                <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;gap:8px;color:#94a3b8;font-size:13px;">
                                    <span style="width:16px;height:16px;border:2px solid #e5e7eb;border-top-color:#dc2626;border-radius:50%;display:inline-block;animation:spin 0.8s linear infinite;"></span>
                                    Chargement...
                                </div>
                            </div>
                        </div>

                        <!-- Bouton Annuler -->
                        <form action="<?= BASE_URL ?>conducteur/trajet/<?= $trajet->id ?>/annuler" method="POST"
                              onsubmit="return confirm('Annuler ce trajet ? Cette action est irréversible.');">
                            <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-xl text-sm font-semibold text-white transition-all duration-200"
                                style="background:#dc2626; border:none; cursor:pointer; font-size:14px;"
                                onmouseover="this.style.background='#b91c1c';"
                                onmouseout="this.style.background='#dc2626';">
                                <i data-lucide="x-circle" width="16" height="16"></i> Annuler ce trajet
                            </button>
                        </form>

                    </div>
                <?php endforeach; ?>
            </div>

        <?php else: ?>
            <div class="glass-panel" style="text-align:center; padding:80px 20px; border-radius:24px;">
                <div style="font-size:72px; margin-bottom:20px;">🚗</div>
                <h3 style="font-size:26px; margin-bottom:10px;">Aucun trajet prévu</h3>
                <p style="color:#64748b; margin-bottom:28px; font-size:16px;">Publiez votre premier trajet pour commencer à recevoir des réservations.</p>
                <a href="<?= BASE_URL ?>conducteur/trajets/nouveau"
                   class="inline-flex items-center gap-2 px-8 py-4 rounded-xl font-semibold text-white bg-brand-600 hover:bg-brand-700 transition-all duration-200 shadow-md"
                   style="text-decoration:none; font-size:15px;">
                    <i data-lucide="plus-circle" width="20" height="20"></i> Publier un trajet
                </a>
            </div>
        <?php endif; ?>

    </div>
</div>

<style>
@keyframes spin { to { transform: rotate(360deg); } }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const banner = document.getElementById('publish-success-banner');
    if (banner) {
        setTimeout(() => {
            banner.style.transition = 'opacity 0.35s ease';
            banner.style.opacity = '0';
            setTimeout(() => banner.style.display = 'none', 350);
        }, 4000);
    }
});
</script>

<?php if(!empty($trajets)): ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
// ✅ Coordonnées GPS précises — Dakar, Rufisque, Diamniadio uniquement
const VILLES = {
    'dakar':      { lat: 14.6937, lon: -17.4441 },
    'rufisque':   { lat: 14.7156, lon: -17.2736 },
    'diamniadio': { lat: 14.7178, lon: -17.1731 },
};

const resolveCity = (query) => {
    const key = query.toLowerCase()
        .normalize('NFD')
        .replace(/[\u0300-\u036f]/g, '')
        .trim();

    for (const [ville, coords] of Object.entries(VILLES)) {
        if (key.includes(ville) || ville.includes(key)) {
            return coords;
        }
    }
    throw new Error(`Ville non trouvée : ${query}`);
};

const fetchRoute = async (from, to) => {
    const r = await fetch(
        `https://router.project-osrm.org/route/v1/driving/${from.lon},${from.lat};${to.lon},${to.lat}?overview=full&geometries=geojson`
    );
    const d = await r.json();
    if (!d.routes?.length) throw new Error('Pas de route');
    return d.routes[0].geometry;
};

const getMarkerIcon = (color) => L.divIcon({
    className: '',
    html: `<div style="width:14px;height:14px;border-radius:50%;background:${color};border:2px solid white;box-shadow:0 0 8px ${color};"></div>`,
    iconSize: [14, 14], iconAnchor: [7, 7]
});

const initMiniRouteMaps = async () => {
    const containers = document.querySelectorAll('[data-route-map="true"]');
    if (!containers.length || typeof L === 'undefined') return;

    for (const container of containers) {
        const depart  = container.getAttribute('data-depart');
        const arrivee = container.getAttribute('data-arrivee');
        if (!depart || !arrivee) continue;

        // Vider le loader
        container.innerHTML = '';

        try {
            const from = resolveCity(depart);
            const to   = resolveCity(arrivee);

            const map = L.map(container, {
                zoomControl: false,
                dragging: false,
                scrollWheelZoom: false,
                doubleClickZoom: false,
                touchZoom: false,
                boxZoom: false,
                keyboard: false
            });

            L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                attribution: '© CARTO © OpenStreetMap',
                maxZoom: 19
            }).addTo(map);

            const geo   = await fetchRoute(from, to);
            const layer = L.geoJSON(geo, {
                style: { color: '#dc2626', weight: 5, opacity: 0.9 }
            }).addTo(map);

            map.fitBounds(layer.getBounds(), { padding: [20, 20] });

            // Marker départ (vert)
            L.marker([from.lat, from.lon], { icon: getMarkerIcon('#16a34a') })
             .bindPopup(`<strong>📍 Départ</strong><br>${depart}`)
             .addTo(map);

            // Marker arrivée (rouge)
            L.marker([to.lat, to.lon], { icon: getMarkerIcon('#dc2626') })
             .bindPopup(`<strong>🏁 Arrivée</strong><br>${arrivee}`)
             .addTo(map);

        } catch (e) {
            container.innerHTML = `
                <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;color:#94a3b8;font-size:13px;gap:6px;">
                    <span style="font-size:28px;">🗺️</span>
                    Carte indisponible
                </div>`;
        }
    }
};

document.addEventListener('DOMContentLoaded', initMiniRouteMaps);
</script>
<?php endif; ?>