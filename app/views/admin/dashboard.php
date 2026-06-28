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

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <!-- ========== KPIs BUSINESS ========== -->
    <?php if(!empty($stats_globales)): $sg = $stats_globales; ?>
    <section class="mb-10">
        <h2 class="font-display text-lg font-bold text-slate-700 mb-4 px-1">Vue d'ensemble</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">

            <!-- Revenu total -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-green-50 text-green-600 flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div class="text-2xl font-bold text-slate-900"><?= number_format((float)($sg->revenu_total ?? 0), 0, ',', ' ') ?> <span class="text-sm font-medium text-slate-400">FCFA</span></div>
                <div class="text-xs text-slate-500 mt-1">Chiffre d'affaires total</div>
            </div>

            <!-- Revenu moyen par trajet -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" /></svg>
                </div>
                <div class="text-2xl font-bold text-slate-900"><?= number_format((float)($sg->revenu_moyen_par_trajet ?? 0), 0, ',', ' ') ?> <span class="text-sm font-medium text-slate-400">FCFA</span></div>
                <div class="text-xs text-slate-500 mt-1">Revenu moyen / trajet</div>
            </div>

            <!-- Taux d'occupation global -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                </div>
                <div class="text-2xl font-bold text-slate-900"><?= $sg->taux_occupation_global ?? 0 ?><span class="text-sm font-medium text-slate-400">%</span></div>
                <div class="text-xs text-slate-500 mt-1">Taux d'occupation global</div>
            </div>

            <!-- Prix moyen par place -->
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185z" /></svg>
                </div>
                <div class="text-2xl font-bold text-slate-900"><?= number_format((float)($sg->prix_moyen_place ?? 0), 0, ',', ' ') ?> <span class="text-sm font-medium text-slate-400">FCFA</span></div>
                <div class="text-xs text-slate-500 mt-1">Prix moyen / place</div>
            </div>
        </div>

        <!-- 2e ligne : indicateurs trajets -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                <div class="text-xs text-slate-400 uppercase tracking-wider mb-2">Mois record 🏆</div>
                <div class="text-lg font-bold text-slate-900"><?= $sg->mois_max ? htmlspecialchars($sg->mois_max->mois_label) : '—' ?></div>
                <div class="text-sm text-green-600 font-semibold"><?= $sg->mois_max ? (int)$sg->mois_max->total . ' trajets' : '' ?></div>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                <div class="text-xs text-slate-400 uppercase tracking-wider mb-2">Mois creux 📉</div>
                <div class="text-lg font-bold text-slate-900"><?= $sg->mois_min ? htmlspecialchars($sg->mois_min->mois_label) : '—' ?></div>
                <div class="text-sm text-red-500 font-semibold"><?= $sg->mois_min ? (int)$sg->mois_min->total . ' trajet(s)' : '' ?></div>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                <div class="text-xs text-slate-400 uppercase tracking-wider mb-2">Moyenne mensuelle</div>
                <div class="text-lg font-bold text-slate-900"><?= $sg->moyenne_mensuelle ?? 0 ?> <span class="text-sm font-normal text-slate-400">trajets/mois</span></div>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                <div class="text-xs text-slate-400 uppercase tracking-wider mb-2">Places vendues</div>
                <div class="text-lg font-bold text-slate-900"><?= (int)($sg->places_vendues ?? 0) ?> <span class="text-sm font-normal text-slate-400">/ <?= (int)($sg->total_places ?? 0) ?></span></div>
            </div>
        </div>

        <!-- 3e ligne : statuts trajets -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
            <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 text-center">
                <div class="text-2xl font-bold text-slate-700"><?= (int)($sg->total_trajets ?? 0) ?></div>
                <div class="text-xs text-slate-500 mt-0.5">Total trajets</div>
            </div>
            <div class="bg-green-50 rounded-2xl p-4 border border-green-100 text-center">
                <div class="text-2xl font-bold text-green-700"><?= (int)($sg->trajets_termines ?? 0) ?></div>
                <div class="text-xs text-green-600 mt-0.5">Terminés</div>
            </div>
            <div class="bg-yellow-50 rounded-2xl p-4 border border-yellow-100 text-center">
                <div class="text-2xl font-bold text-yellow-700"><?= (int)($sg->trajets_planifies ?? 0) ?></div>
                <div class="text-xs text-yellow-600 mt-0.5">Planifiés</div>
            </div>
            <div class="bg-red-50 rounded-2xl p-4 border border-red-100 text-center">
                <div class="text-2xl font-bold text-red-600"><?= (int)($sg->trajets_annules ?? 0) ?></div>
                <div class="text-xs text-red-500 mt-0.5">Annulés</div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ========== GRAPHIQUES ========== -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">

        <!-- Trajets par mois -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100">
                <h2 class="font-display text-base font-bold text-slate-900">
                    Trajets par mois
                </h2>
                <p class="text-xs text-slate-500 mt-1">
                    Nombre de trajets publiés chaque mois
                </p>
            </div>

            <div class="p-6">
                <?php if(empty($trajets_by_month)): ?>

                    <p class="text-center text-slate-400 py-10">
                        Aucune donnée disponible.
                    </p>

                <?php else: ?>

                    <div style="height:260px">
                        <canvas id="chartTrajetsMois"></canvas>
                    </div>

                    <script>
                    (() => {

                        const labels = <?= json_encode(array_map(fn($r)=>$r->mois_label,$trajets_by_month)) ?>;

                        const values = <?= json_encode(array_map(fn($r)=>(int)$r->total,$trajets_by_month)) ?>;

                        new Chart(document.getElementById("chartTrajetsMois"),{

                            type:"bar",

                            data:{
                                labels:labels,
                                datasets:[{
                                    label:"Trajets",
                                    data:values,
                                    backgroundColor:"#4F46E5",
                                    borderRadius:8,
                                    barThickness:35
                                }]
                            },

                            options:{
                                responsive:true,
                                maintainAspectRatio:false,

                                plugins:{
                                    legend:{
                                        display:false
                                    }
                                },

                                scales:{
                                    x:{
                                        grid:{
                                            display:false
                                        }
                                    },
                                    y:{
                                        beginAtZero:true,
                                        ticks:{
                                            stepSize:1
                                        }
                                    }
                                }
                            }

                        });

                    })();
                    </script>

                <?php endif; ?>
            </div>
        </div>

    <!-- Revenu par mois -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                <div>
                    <h2 class="font-display text-base font-bold text-slate-900">Revenus par mois</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Chiffre d'affaires mensuel (FCFA)</p>
                </div>
                <?php if(!empty($stats_globales)): ?>
                <span class="text-xs font-semibold bg-green-50 text-green-600 px-3 py-1 rounded-full">
                    Total : <?= number_format((float)($stats_globales->revenu_total ?? 0), 0, ',', ' ') ?> FCFA
                </span>
                <?php endif; ?>
            </div>
            <div class="p-6">
                <?php if(empty($stats_globales->revenu_by_month)): ?>
                    <p class="text-slate-400 text-sm text-center py-8">Aucune donnée.</p>
                <?php else: ?>
                <div style="position:relative;height:220px;">
                    <canvas id="chartRevenuMois"></canvas>
                </div>
                <script>
                (function(){
                    const labels = <?= json_encode(array_map(fn($r) => $r->mois_label, $stats_globales->revenu_by_month)) ?>;
                    const values = <?= json_encode(array_map(fn($r) => (float)$r->revenu, $stats_globales->revenu_by_month)) ?>;
                    new Chart(document.getElementById('chartRevenuMois'), {
                        type: 'bar',
                        data: {
                            labels,
                            datasets: [{
                                label: 'Revenu (FCFA)',
                                data: values,
                                backgroundColor: values.map(v => v === Math.max(...values) ? 'rgba(34,197,94,0.9)' : 'rgba(34,197,94,0.25)'),
                                borderColor: 'rgba(34,197,94,1)',
                                borderWidth: 1.5,
                                borderRadius: 6,
                                borderSkipped: false,
                            }]
                        },
                        options: {
                            responsive: true, maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false },
                                tooltip: { callbacks: { label: ctx => ' ' + ctx.parsed.y.toLocaleString('fr-FR') + ' FCFA' } }
                            },
                            scales: {
                                x: { grid: { display: false }, ticks: { font: { size: 11 } } },
                                y: { beginAtZero: true, ticks: { font: { size: 11 }, callback: v => v.toLocaleString('fr-FR') }, grid: { color: 'rgba(0,0,0,0.04)' } }
                            }
                        }
                    });
                })();
                </script>
                <?php endif; ?>
            </div>
        </div>

                <!-- Taux d'occupation -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">

            <div class="px-6 py-5 border-b border-slate-100">
                <h2 class="font-display text-base font-bold text-slate-900">
                    Taux d'occupation
                </h2>
                <p class="text-xs text-slate-500 mt-1">
                    Pourcentage moyen des places occupées par mois
                </p>
            </div>

            <div class="p-6">

                <?php if(empty($taux_occupation)): ?>

                    <p class="text-center text-slate-400 py-10">
                        Aucune donnée disponible.
                    </p>

                <?php else: ?>

                    <div style="height:260px">
                        <canvas id="chartTauxOccupation"></canvas>
                    </div>

                    <script>
                    (() => {

                        const labels = <?= json_encode(array_map(fn($r)=>$r->mois_label,$taux_occupation)) ?>;

                        const values = <?= json_encode(array_map(fn($r)=>(float)$r->taux_occupation,$taux_occupation)) ?>;

                        new Chart(document.getElementById("chartTauxOccupation"),{

                            type:"bar",

                            data:{
                                labels:labels,
                                datasets:[{
                                    label:"Taux d'occupation",
                                    data:values,
                                    backgroundColor:"#10B981",
                                    borderRadius:8,
                                    barThickness:35
                                }]
                            },

                            options:{
                                responsive:true,
                                maintainAspectRatio:false,

                                plugins:{
                                    legend:{
                                        display:false
                                    },
                                    tooltip:{
                                        callbacks:{
                                            label:(ctx)=>ctx.parsed.y+" %"
                                        }
                                    }
                                },

                                scales:{
                                    x:{
                                        grid:{
                                            display:false
                                        }
                                    },
                                    y:{
                                        beginAtZero:true,
                                        max:100,
                                        ticks:{
                                            callback:(value)=>value+"%"
                                        }
                                    }
                                }
                            }

                        });

                    })();
                    </script>

                <?php endif; ?>

            </div>

        </div>
        <!-- Top Conducteurs -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                <div>
                    <h2 class="font-display text-base font-bold text-slate-900">Top Conducteurs</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Par nombre de trajets publiés</p>
                </div>
                <span class="text-xs font-semibold bg-brand-50 text-brand-600 px-3 py-1 rounded-full">Top 5</span>
            </div>
            <div class="p-6">
                <?php if(empty($top_conducteurs)): ?>
                    <p class="text-slate-400 text-sm text-center py-8">Aucun conducteur actif.</p>
                <?php else: ?>
                <div style="position:relative;height:220px;">
                    <canvas id="chartTopConducteurs"></canvas>
                </div>
                <script>
                (function(){
                    const labels = <?= json_encode(array_map(fn($c) => $c->conducteur, $top_conducteurs)) ?>;
                    const values = <?= json_encode(array_map(fn($c) => (int)$c->nb_trajets, $top_conducteurs)) ?>;
                    new Chart(document.getElementById('chartTopConducteurs'), {
                        type: 'bar',
                        data: {
                            labels,
                            datasets: [{
                                label: 'Trajets',
                                data: values,
                                backgroundColor: ['rgba(234,179,8,0.85)','rgba(148,163,184,0.85)','rgba(180,83,9,0.7)','rgba(99,102,241,0.6)','rgba(99,102,241,0.4)'],
                                borderRadius: 6,
                                borderSkipped: false,
                            }]
                        },
                        options: {
                            indexAxis: 'y',
                            responsive: true, maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false },
                                tooltip: { callbacks: { label: ctx => ' ' + ctx.parsed.x + ' trajet(s)' } }
                            },
                            scales: {
                                x: { beginAtZero: true, ticks: { stepSize: 1, font: { size: 11 } }, grid: { color: 'rgba(0,0,0,0.04)' } },
                                y: { grid: { display: false }, ticks: { font: { size: 12, weight: '600' } } }
                            }
                        }
                    });
                })();
                </script>
                <!-- Mini tableau -->
                <div class="mt-4 space-y-2">
                    <?php foreach($top_conducteurs as $i => $c): ?>
                    <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center gap-2">
                            <span><?php if($i===0) echo '🥇'; elseif($i===1) echo '🥈'; elseif($i===2) echo '🥉'; else echo '<span class="text-slate-400 font-semibold w-5 inline-block text-center">'.($i+1).'</span>'; ?></span>
                            <span class="font-medium text-slate-700"><?= htmlspecialchars($c->conducteur) ?></span>
                        </div>
                        <div class="flex items-center gap-3 text-xs text-slate-500">
                            <span><?= (int)$c->passagers_transportes ?> passager(s)</span>
                            <?php if($c->note_moyenne): ?><span class="text-yellow-600 font-semibold">⭐ <?= number_format((float)$c->note_moyenne,1) ?></span><?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
 
    <!-- ========== STATISTIQUES : TOP CONDUCTEURS ========== -->
    <section class="mb-10">
        <div class="max-w-lg bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <span class="text-lg">🏆</span>
                    <div>
                        <h2 class="font-display text-base font-bold text-slate-900">Top Conducteurs</h2>
                        <p class="text-xs text-slate-400">Par trajets publiés</p>
                    </div>
                </div>
                <span class="bg-brand-50 text-brand-600 text-xs font-bold px-2.5 py-1 rounded-full">
                    TOP <?= count($top_conducteurs) ?>
                </span>
            </div>
            <div class="divide-y divide-slate-50">
                <?php if (!empty($top_conducteurs)):
                    $medals = ['🥇','🥈','🥉'];
                    $maxT   = $top_conducteurs[0]->nb_trajets ?: 1;
                    foreach ($top_conducteurs as $i => $c):
                        $pct = round(($c->nb_trajets / $maxT) * 100);
                ?>
                <div class="flex items-center gap-4 px-6 py-3 hover:bg-slate-50 transition-colors">
                    <span class="text-xl w-7 text-center shrink-0"><?= $medals[$i] ?? '#'.($i+1) ?></span>
                    <div class="w-9 h-9 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center font-bold text-sm shrink-0">
                        <?= mb_strtoupper(mb_substr(explode(' ', $c->conducteur)[0], 0, 1)) ?>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-semibold text-slate-800 truncate"><?= htmlspecialchars($c->conducteur) ?></span>
                            <div class="flex items-center gap-3 ml-3 shrink-0">
                                <?php if($c->note_moyenne): ?>
                                    <span class="text-xs text-yellow-600 font-semibold">⭐ <?= number_format((float)$c->note_moyenne,1) ?></span>
                                <?php endif; ?>
                                <span class="text-sm font-bold text-brand-600"><?= $c->nb_trajets ?> trajet<?= $c->nb_trajets > 1 ? 's' : '' ?></span>
                            </div>
                        </div>
                        <div class="w-full h-1.5 rounded-full bg-slate-100 overflow-hidden">
                            <div class="h-full bg-brand-500 rounded-full" style="width:<?= $pct ?>%"></div>
                        </div>
                        <div class="text-xs text-slate-400 mt-1"><?= (int)$c->passagers_transportes ?> passager(s)</div>
                    </div>
                </div>
                <?php endforeach; else: ?>
                    <div class="px-6 py-8 text-center text-slate-400 text-sm">Aucun conducteur pour l'instant.</div>
                <?php endif; ?>
            </div>
        </div>
    </section>
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
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-display text-xl font-bold text-slate-900">Flux d'Activité</h2>
                <?php if (!empty($messages_non_lus) && $messages_non_lus > 0): ?>
                    <span class="bg-brand-600 text-white text-xs font-bold px-2.5 py-1 rounded-full">
                        <?= $messages_non_lus ?> nouveau<?= $messages_non_lus > 1 ? 'x' : '' ?>
                    </span>
                <?php endif; ?>
            </div>
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

                <!-- Messages de contact récents -->
                <?php if (!empty($derniers_messages)): ?>
                <div class="border-t border-slate-100 pt-4 mt-2">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Messages reçus</p>
                    <div class="space-y-3">
                        <?php foreach ($derniers_messages as $msg): ?>
                        <div class="flex items-start gap-3 <?= !$msg->lu ? 'bg-brand-50 border border-brand-100' : 'bg-slate-50' ?> rounded-xl p-3">
                            <div class="w-8 h-8 rounded-full <?= !$msg->lu ? 'bg-brand-600 text-white' : 'bg-slate-200 text-slate-500' ?> flex items-center justify-center font-bold text-xs shrink-0">
                                <?= mb_strtoupper(mb_substr($msg->nom, 0, 1)) ?>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-semibold text-slate-900"><?= htmlspecialchars($msg->nom) ?></span>
                                    <?php if (!$msg->lu): ?><span class="w-1.5 h-1.5 rounded-full bg-brand-600 shrink-0"></span><?php endif; ?>
                                </div>
                                <p class="text-xs text-slate-500 truncate"><?= htmlspecialchars(mb_substr($msg->message, 0, 55)) ?>...</p>
                                <p class="text-xs text-slate-400 mt-0.5"><?= date('d/m à H:i', strtotime($msg->date_envoi)) ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <a href="<?= BASE_URL ?>admin/messages" class="block text-center mt-8 text-sm font-semibold text-brand-600 hover:text-brand-700 transition-colors">Voir tout l'historique &rarr;</a>
        </div>
    </section>

</div>