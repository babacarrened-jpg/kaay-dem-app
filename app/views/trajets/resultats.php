
<script src="https://unpkg.com/lucide@latest"></script>

<div style="
    min-height: 100vh;
    padding: 40px 20px;
    box-sizing: border-box;
    background-color: #f7f9fa;
    background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAxNDAgODAiPjx0ZXh0IHg9IjE1IiB5PSIzMCIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+S0FBWTwvdGV4dD48dGV4dCB4PSIxNSIgeT0iNDUiIGZpbGw9IiNkYzI2MjYiIG9wYWNpdHk9IjAuMDciIGZvbnQtZmFtaWx5PSJzYW5zLXNlcmlmIiBmb250LXdlaWdodD0iOTAwIiBmb250LXNpemU9IjEyIiBsZXR0ZXItc3BhY2luZz0iMC41cHkiPkRFTU08L3RleHQ+PHRleHQgeD0iODUiIHk9IjcwIiBmaWxsPSIjZGMyNjI2IiBvcGFjaXR5PSIwLjA3IiBmb250LWZhbWlseT0ic2Fucy1zZXJpZiIgZm9udC13ZWlnaHQ9IjkwMCIgZm9udC1zaXplPSIxMiIgbGV0dGVyLXNwYWNpbmc9IjAuNXB5Ij5LQUFZPC90ZXh0Pjx0ZXh0IHg9Ijg1IiB5PSI4NSIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+REVNTTwvdGV4dD48L3N2Zz4=');
    background-repeat: repeat;
    font-family: system-ui, -apple-system, sans-serif;
">

    <div style="max-width: 1100px; margin: 0 auto;">
        
        <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 35px; background: rgba(255,255,255,0.75); padding: 20px; border-radius: 16px; backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); border: 1px solid rgba(229,231,235,0.5); box-shadow: 0 4px 20px rgba(0,0,0,0.01);">
            <div class="page-title-group" style="display: flex; align-items: center; gap: 14px;">
                <div class="page-title-icon" style="background: white; border: 1px solid #e5e7eb; border-radius: 10px; width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="list" width="24" height="24" style="color: #dc2626;"></i>
                </div>
                <div>
                    <h1 style="margin: 0; font-size: 24px; font-weight: 800; color: #111827;">Trajets disponibles</h1>
                    <p style="margin: 4px 0 0 0; color: #4b5563; font-size: 14px;">
                        <i data-lucide="map-pin" width="14" height="14" style="display:inline; margin-right:4px; vertical-align: middle;"></i> 
                        <strong><?= htmlspecialchars($depart ?: 'Toutes villes') ?></strong> → 
                        <strong><?= htmlspecialchars($arrivee ?: 'Toutes villes') ?></strong>
                        <?php if($date): ?> | <i data-lucide="calendar" width="14" height="14" style="display:inline; margin:0 4px; vertical-align: middle;"></i> <?= date('d/m/Y', strtotime($date)) ?><?php endif; ?>
                    </p>
                </div>
            </div>
            <a href="<?= BASE_URL ?>trajets/recherche" class="btn btn-outline" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none; color: #374151; background: white; border: 1px solid #d1d5db; padding: 10px 18px; border-radius: 10px; font-weight: 600; font-size: 14px;">
                <i data-lucide="edit-3" width="16" height="16"></i> Modifier
            </a>
        </div>

        <?php if(!empty($depart) && !empty($arrivee)): ?>
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

            <div class="glass-panel" style="margin-bottom:30px; padding:0; overflow:hidden; position:relative; border-radius: 20px; background: rgba(255,255,255,0.4); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); border: 1px solid rgba(229,231,235,0.6); box-shadow: 0 10px 25px rgba(0,0,0,0.02);">
                <div style="padding:20px 24px; display:flex; flex-wrap:wrap; justify-content:space-between; gap:16px; align-items:center; background:rgba(15,23,42,0.92);">
                    <div>
                        <div style="font-size:11px; text-transform:uppercase; letter-spacing:0.2em; color:#ef4444; margin-bottom:6px; font-weight: 700;">Itinéraire</div>
                        <h2 style="margin:0; font-size:18px; color:#F8FAFC; font-weight: 700;"><?= htmlspecialchars($depart) ?> → <?= htmlspecialchars($arrivee) ?></h2>
                        <?php if($date): ?>
                            <p style="margin:6px 0 0; color:#9ca3af; font-size:13px;">Date du trajet : <?= date('d/m/Y', strtotime($date)) ?></p>
                        <?php endif; ?>
                    </div>
                    <div style="font-size:13px; color:#9ca3af; text-align:right;">
                        <div style="color: #f8fafc; font-weight: 600;">Carte interactive libre</div>
                        <div style="margin-top:2px; font-size: 12px;">Zoom automatique + trace OSRM</div>
                    </div>
                </div>
                <div id="search-route-map" style="width:100%; height:340px;"></div>
                <div id="search-route-error" style="display:none; position:absolute; inset:0; background:rgba(15,23,42,0.9); color:#F8FAFC; display:flex; align-items:center; justify-content:center; text-align:center; padding:24px; font-size:15px;">
                    Impossible d'afficher la carte pour ces villes. Vérifiez l'orthographe ou modifiez votre recherche.
                </div>
            </div>
        <?php endif; ?>

        <?php if(empty($trajets)): ?>
            <div class="glass-panel" style="text-align: center; padding: 60px 20px; border-radius: 24px; background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(229,231,235,0.6); box-shadow: 0 10px 30px rgba(0,0,0,0.02);">
                <div style="width: 80px; height: 80px; background: #fee2e2; color: #dc2626; border-radius: 24px; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px; transform: rotate(10deg);">
                    <i data-lucide="frown" width="40" height="40"></i>
                </div>
                <h3 style="font-size: 24px; margin: 0 0 8px 0; font-weight: 700; color: #111827;">Aucun trajet trouvé</h3>
                <p style="color: #4b5563; margin-bottom: 24px; font-size: 15px;">Désolé, nous n'avons trouvé aucun trajet correspondant à vos critères pour le moment.</p>
                <a href="<?= BASE_URL ?>trajets/recherche" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none; background: #dc2626; color: white; padding: 12px 24px; border-radius: 12px; font-weight: 700; box-shadow: 0 4px 14px rgba(220,38,38,0.3);">
                    <i data-lucide="search" width="18" height="18"></i> Nouvelle recherche
                </a>
            </div>
        <?php else: ?>
            
            <div style="margin-bottom: 24px; color: #374151; font-size: 14px; display: flex; flex-wrap: wrap; gap: 16px; align-items: center; background: rgba(255,255,255,0.65); padding: 12px 18px; border-radius: 12px; backdrop-filter: blur(6px); border: 1px solid rgba(229,231,235,0.4);">
                <i data-lucide="info" width="16" height="16" style="color: #dc2626;"></i>
                Cliquez sur une offre pour voir les détails puis réserver.
                <?php if(!empty($prix_min) || !empty($prix_max) || !empty($places_min) || !empty($places_max)): ?>
                    <span style="display:inline-flex; align-items:center; gap:6px; padding:6px 14px; background:white; border: 1px solid #e5e7eb; border-radius:999px; font-size: 13px; color: #111827;">
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
                    <div class="glass-panel" style="padding: 24px; display: flex; flex-direction: column; cursor: pointer; position: relative; overflow: hidden; border-radius: 20px; background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); border: 1px solid rgba(229,231,235,0.6); box-shadow: 0 10px 30px rgba(0,0,0,0.03); transition: transform 0.2s ease, box-shadow 0.2s ease;" onclick="window.location='<?= BASE_URL ?>trajets/detail/<?= $trajet->id ?>'" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 15px 35px rgba(0,0,0,0.06)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.03)';">
                        
                        <div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: #dc2626;"></div>

                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px;">
                            <div style="background: #f3f4f6; padding: 8px 12px; border-radius: 8px; font-weight: 600; font-size: 13px; color: #1f2937; display: flex; align-items: center; gap: 6px; border: 1px solid #e5e7eb;">
                                <i data-lucide="calendar" width="14" height="14" style="color:#4b5563;"></i> <?= date('d/m/Y', strtotime($trajet->date_trajet)) ?> 
                                <span style="color:#d1d5db;">|</span>
                                <i data-lucide="clock" width="14" height="14" style="color:#4b5563;"></i> <?= substr($trajet->heure_depart, 0, 5) ?>
                            </div>
                            <div style="font-weight: 800; font-size: 22px; color: #dc2626;">
                                <?= number_format($trajet->prix_par_place, 0, ',', ' ') ?> F
                            </div>
                        </div>

                        <div style="font-weight: 700; font-size: 19px; margin-bottom: 24px; color: #111827; display: flex; align-items: center; gap: 12px;">
                            <?= htmlspecialchars($trajet->ville_depart) ?> 
                            <i data-lucide="arrow-right" style="color:#6b7280;" width="18" height="18"></i>
                            <?= htmlspecialchars($trajet->ville_arrivee) ?>
                        </div>

                        <div style="display: flex; align-items: center; gap: 14px; margin-top: auto; padding-top: 18px; border-top: 1px solid #e5e7eb;">
                            <div style="width:40px; height:40px; font-size: 16px; background: #dc2626; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700;">
                                <?= strtoupper(substr($trajet->conducteur_prenom, 0, 1)) ?>
                            </div>
                            <div style="flex: 1;">
                                <div style="font-weight: 700; font-size: 14px; color: #111827; display:flex; align-items:center; gap:6px; flex-wrap:wrap;">
                                    <?= htmlspecialchars($trajet->conducteur_prenom . ' ' . $trajet->conducteur_nom) ?>
                                    <span style="display:inline-flex; align-items:center; gap:4px; font-size: 11px; font-weight: 700; padding: 3px 8px; border-radius: 999px; background: rgba(34,197,94,0.12); color: #15803d;">
                                        <i data-lucide="shield-check" width="12" height="12"></i> Vérifié
                                    </span>
                                </div>
                                <div style="font-size: 13px; color: #4b5563; display:flex; align-items:center; gap:4px; margin-top: 4px;">
                                    <i data-lucide="star" width="12" height="12" style="color:#fbbf24; fill:#fbbf24;"></i> 4.8/5
                                </div>
                            </div>
                            <div style="background: rgba(220,38,38,0.08); color: #dc2626; font-size: 12px; font-weight: 700; padding: 5px 12px; border-radius: 50px; display:flex; align-items:center; gap:5px; border: 1px solid rgba(220,38,38,0.15);">
                                <i data-lucide="users" width="14" height="14"></i> <?= $trajet->places_disponibles ?> pl.
                            </div>
                        </div>

                        <button type="button"
                            style="margin-top: 18px; width: 100%; border: 0; border-radius: 14px; background: #dc2626; color: white; padding: 13px 14px; font-weight: 700; font-size: 15px; cursor: pointer; box-shadow: 0 6px 20px rgba(220, 38, 38, 0.2); transition: background 0.2s;"
                            onmouseover="this.style.background='#b91c1c'"
                            onmouseout="this.style.background='#dc2626'"
                            onclick="event.stopPropagation(); window.location='<?= BASE_URL ?>trajets/detail/<?= $trajet->id ?>'">
                            Voir le trajet & réserver
                        </button>

                    </div>
                <?php endforeach; ?>
            </div>

            <?php if(!empty($pagination) && $pagination['totalPages'] > 1): ?>
                <div style="margin-top: 40px; display: flex; justify-content: center; gap: 8px; flex-wrap: wrap;">
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
                           style="min-width: 44px; height: 44px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 14px; transition: all 0.2s; 
                           <?= $p === $pagination['currentPage'] ? 'background: #dc2626; color: white; box-shadow: 0 4px 12px rgba(220,38,38,0.3);' : 'background: white; color: #374151; border: 1px solid #d1d5db;' ?> "
                           onmouseover="if(<?= $p !== $pagination['currentPage'] ? 'true' : 'false' ?>) { this.style.background='#f3f4f6'; }"
                           onmouseout="if(<?= $p !== $pagination['currentPage'] ? 'true' : 'false' ?>) { this.style.background='white'; }">
                            <?= $p ?>
                        </a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
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
                    style: { color: '#dc2626', weight: 5, opacity: 0.85 }
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

<script>
  lucide.createIcons();
</script>

```