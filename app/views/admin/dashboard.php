<div class="max-w-7xl mx-auto my-10 px-6">
    
    <!-- En-tête -->
    <header class="bg-white/80 backdrop-blur-md border border-slate-200 rounded-3xl p-6 md:p-8 mb-10 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div class="flex items-center gap-5">
            <div class="w-14 h-14 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-display font-bold text-slate-900 m-0 leading-tight">Administration Centrale</h1>
                <p class="text-slate-500 text-sm mt-1">Bienvenue Modérateur. Voici un aperçu de l'activité de Kaay Dem.</p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-right">
                <div class="font-semibold text-slate-900 text-sm">Admin System</div>
                <div class="text-xs text-green-600 flex items-center gap-1.5 justify-end mt-0.5">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    En ligne
                </div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-brand-600 to-brand-700 text-white flex items-center justify-center shadow-lg shadow-brand-700/30">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            </div>
        </div>
    </header>

    <?php if(isset($_GET['success'])): ?>
        <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-8 flex items-center gap-3 border border-green-200 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-semibold text-sm">Action effectuée avec succès !</span>
        </div>
    <?php endif; ?>

    <div class="mb-10 text-right">
        <a href="<?= BASE_URL ?>admin/trajets" class="inline-flex items-center gap-2 rounded-2xl bg-brand-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-brand-700 transition-colors">
            Voir tous les trajets
        </a>
    </div>

    <!-- KPIs -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex justify-between items-start hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div class="w-14 h-14 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
            </div>
            <div class="text-right">
                <div class="font-display text-4xl font-bold text-slate-900 leading-none mb-2"><?= isset($stats['utilisateurs']) ? $stats['utilisateurs'] : '0' ?></div>
                <div class="text-sm font-medium text-slate-500">Utilisateurs inscrits</div>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex justify-between items-start hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div class="w-14 h-14 rounded-2xl bg-yellow-50 text-yellow-600 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c-.317-.159-.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z" />
                </svg>
            </div>
            <div class="text-right">
                <div class="font-display text-4xl font-bold text-slate-900 leading-none mb-2"><?= isset($stats['trajets_actifs']) ? $stats['trajets_actifs'] : '0' ?></div>
                <div class="text-sm font-medium text-slate-500">Trajets en cours</div>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 flex justify-between items-start hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div class="w-14 h-14 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div class="text-right">
                <div class="font-display text-4xl font-bold text-slate-900 leading-none mb-2"><?= isset($stats['signalements']) ? $stats['signalements'] : '0' ?></div>
                <div class="text-sm font-medium text-slate-500">Signalements à traiter</div>
            </div>
        </div>
    </section>

    <!-- Carte des trajets actifs -->
    <?php if(!empty($trajets_actifs)): ?>
    <section class="mb-10">
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-8 py-6 flex justify-between items-center border-b border-slate-100">
                <div>
                    <h2 class="font-display text-xl font-bold text-slate-900">Trajets actifs en temps réel</h2>
                    <p class="text-sm text-slate-500 mt-1"><?= count($trajets_actifs) ?> trajet<?= count($trajets_actifs) > 1 ? 's' : '' ?> en cours sur le corridor</p>
                </div>
                <span class="flex items-center gap-2 text-xs font-semibold text-green-600 bg-green-50 px-3 py-1.5 rounded-full">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    Live
                </span>
            </div>
            <div id="admin-trajets-map" style="width:100%; height:480px;"></div>
        </div>
    </section>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
    const adminTrips = <?= json_encode(array_map(function($t) {
        return [
            'id'            => $t->id,
            'depart'        => $t->point_depart ?: $t->ville_depart,
            'arrivee'       => $t->point_arrivee ?: $t->ville_arrivee,
            'ville_depart'  => $t->ville_depart,
            'ville_arrivee' => $t->ville_arrivee,
            'date'          => $t->date_trajet,
            'heure'         => substr($t->heure_depart, 0, 5),
            'prix'          => $t->prix_par_place,
            'places'        => $t->places_disponibles,
            'statut'        => $t->statut,
        ];
    }, $trajets_actifs), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT); ?>;

    const adminColors = ['#38bdf8','#f97316','#22c55e','#a855f7','#fb7185','#facc15','#34d399'];

    const getMarkerIcon = (color) => L.divIcon({
        className: '',
        html: `<div style="width:14px;height:14px;border-radius:50%;background:${color};border:2.5px solid white;box-shadow:0 0 8px ${color};"></div>`,
        iconSize: [14, 14],
        iconAnchor: [7, 7]
    });

    const geocode = async (q) => {
        const r = await fetch(`https://nominatim.openstreetmap.org/search?format=json&limit=1&q=${encodeURIComponent(q)}`, {
            headers: { 'Accept': 'application/json' }
        });
        const d = await r.json();
        if (!d.length) throw new Error('not found');
        return { lat: parseFloat(d[0].lat), lon: parseFloat(d[0].lon) };
    };

    const fetchRoute = async (from, to) => {
        const r = await fetch(`https://router.project-osrm.org/route/v1/driving/${from.lon},${from.lat};${to.lon},${to.lat}?overview=full&geometries=geojson`);
        const d = await r.json();
        if (!d.routes?.length) throw new Error('no route');
        return d.routes[0].geometry;
    };

    const initAdminMap = async () => {
        if (!adminTrips.length || typeof L === 'undefined') return;

        const map = L.map('admin-trajets-map', {
            center: [14.715, -17.467],
            zoom: 9,
            zoomControl: true
        });

        L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; CARTO &copy; OpenStreetMap',
            maxZoom: 19
        }).addTo(map);

        const bounds = L.latLngBounds([]);

        for (let i = 0; i < adminTrips.length; i++) {
            const t = adminTrips[i];
            const color = adminColors[i % adminColors.length];
            try {
                const from = await geocode(`${t.depart}, Sénégal`);
                const to   = await geocode(`${t.arrivee}, Sénégal`);
                const geom = await fetchRoute(from, to);

                const route = L.geoJSON(geom, {
                    style: { color, weight: 4, opacity: 0.85 }
                }).addTo(map);
                bounds.extend(route.getBounds());

                L.marker([from.lat, from.lon], { icon: getMarkerIcon(color) })
                    .bindPopup(`
                        <div style="font-family:sans-serif;min-width:180px;">
                            <div style="font-weight:700;margin-bottom:6px;">🚩 ${t.ville_depart} → ${t.ville_arrivee}</div>
                            <div style="font-size:12px;color:#64748b;margin-bottom:2px;">📅 ${t.date} à ${t.heure}</div>
                            <div style="font-size:12px;color:#64748b;margin-bottom:2px;">💺 ${t.places} place(s) disponible(s)</div>
                            <div style="font-size:12px;color:#64748b;margin-bottom:6px;">💰 ${t.prix} F/place</div>
                            <span style="background:${t.statut==='en_cours'?'#dcfce7':'#dbeafe'};color:${t.statut==='en_cours'?'#16a34a':'#1d4ed8'};padding:2px 10px;border-radius:999px;font-size:11px;font-weight:700;">
                                ${t.statut}
                            </span>
                        </div>
                    `)
                    .addTo(map);

                L.marker([to.lat, to.lon], { icon: getMarkerIcon(color) })
                    .bindPopup(`<strong>Arrivée :</strong> ${t.ville_arrivee}`)
                    .addTo(map);

            } catch(e) {
                console.warn('Trajet ignoré:', t.ville_depart, '→', t.ville_arrivee, e);
            }
        }

        if (bounds.isValid()) map.fitBounds(bounds, { padding: [40, 40] });
    };

    document.addEventListener('DOMContentLoaded', initAdminMap);
    </script>
    <?php endif; ?>

    <!-- Contenu Principal -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Tableau des Demandes -->
        <div class="lg:col-span-2 bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-slate-100">
            <div class="flex justify-between items-center mb-8">
                <h2 class="font-display text-xl font-bold text-slate-900">Demandes Conducteurs (<?= isset($demandes_conducteur) ? count($demandes_conducteur) : '0' ?>)</h2>
                <button onclick="window.location.reload()" class="p-2 bg-slate-50 text-slate-500 hover:text-slate-900 rounded-lg transition-colors" title="Rafraîchir">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                </button>
            </div>

            <?php if(empty($demandes_conducteur)): ?>
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-slate-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-slate-400 font-medium text-sm">Aucune demande en attente</p>
                </div>
            <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100">
                            <th class="pb-4 font-semibold text-sm text-slate-400 uppercase tracking-wider">Utilisateur</th>
                            <th class="pb-4 font-semibold text-sm text-slate-400 uppercase tracking-wider">Date</th>
                            <th class="pb-4 font-semibold text-sm text-slate-400 uppercase tracking-wider">Documents</th>
                            <th class="pb-4 font-semibold text-sm text-slate-400 uppercase tracking-wider text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php foreach($demandes_conducteur as $demande): ?>
                            <tr class="group hover:bg-slate-50 transition-colors">
                                <td class="py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center font-bold text-sm">
                                            <?= substr($demande->utilisateur_prenom, 0, 1) ?>
                                        </div>
                                        <span class="font-semibold text-slate-900"><?= htmlspecialchars($demande->utilisateur_prenom . ' ' . $demande->utilisateur_nom) ?></span>
                                    </div>
                                </td>
                                <td class="py-4 text-sm text-slate-500 font-medium">
                                    <?= date('d M Y', strtotime($demande->date_demande)) ?>
                                </td>
                                <td class="py-4">
                                    <?php if(!empty($demande->permis_recto)): ?>
                                        <a href="<?= BASE_URL ?>assets/uploads/permis/<?= htmlspecialchars($demande->permis_recto) ?>" 
                                           target="_blank"
                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-brand-50 text-brand-600 text-xs font-semibold hover:bg-brand-100 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" />
                                            </svg>
                                            Recto
                                        </a>
                                        <a href="<?= BASE_URL ?>assets/uploads/permis/<?= htmlspecialchars($demande->permis_verso) ?>" 
                                           target="_blank"
                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-50 text-slate-600 text-xs font-semibold hover:bg-slate-100 transition-colors ml-1">
                                            Verso
                                        </a>
                                    <?php else: ?>
                                        <span class="text-xs text-slate-400 italic">Aucun document</span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <form action="<?= BASE_URL ?>admin/validerConducteur/<?= $demande->id ?>" method="POST" class="m-0">
                                            <button type="submit" class="p-2 rounded-lg bg-green-50 text-green-600 hover:bg-green-500 hover:text-white transition-colors" title="Valider">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                            </button>
                                        </form>
                                        <form action="<?= BASE_URL ?>admin/refuserConducteur/<?= $demande->id ?>" method="POST" class="m-0">
                                            <button type="submit" class="p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-500 hover:text-white transition-colors" title="Refuser">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>

        <!-- Activité Récente -->
        <div class="bg-white rounded-3xl p-6 md:p-8 shadow-sm border border-slate-100">
            <h2 class="font-display text-xl font-bold text-slate-900 mb-6">Flux d'Activité</h2>
            <div class="space-y-6">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-slate-900 font-medium"><strong>Nouveau trajet publié :</strong> Dakar → Rufisque par Moussa D.</p>
                        <p class="text-xs text-slate-500 mt-1 font-medium">Il y a 10 min</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-500 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-slate-900 font-medium"><strong>Nouvelle inscription :</strong> Awa Fall a rejoint la plateforme.</p>
                        <p class="text-xs text-slate-500 mt-1 font-medium">Il y a 45 min</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0l2.77-.693a14.267 14.267 0 014.622 0s2.77.693 4.513.693c1.744 0 3.203-.693 3.203-.693M3 15h12.5M3 4.5l2.77.693a14.267 14.267 0 004.622 0s2.77-.693 4.513-.693c1.744 0 3.203.693 3.203.693M3 4.5h12.5" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-slate-900 font-medium"><strong>Signalement reçu :</strong> Trajet #142 non effectué, émis par P. Diagne.</p>
                        <p class="text-xs text-slate-500 mt-1 font-medium">Aujourd'hui à 09:12</p>
                    </div>
                </div>
            </div>
            
            <a href="#" class="block text-center mt-8 text-sm font-semibold text-brand-600 hover:text-brand-700 transition-colors">Voir tout l'historique &rarr;</a>
        </div>
    </section>

</div>