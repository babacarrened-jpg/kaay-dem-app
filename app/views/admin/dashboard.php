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

    <div class="mb-10 flex flex-wrap gap-3 justify-end">
        <a href="<?= BASE_URL ?>admin/utilisateurs" class="inline-flex items-center gap-2 rounded-2xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-200 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0z" />
            </svg>
            Gestion utilisateurs
        </a>
        <a href="<?= BASE_URL ?>admin/reservations" class="inline-flex items-center gap-2 rounded-2xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-200 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
            </svg>
            Gestion réservations
        </a>
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

    <!-- KPIs supplémentaires — card "Trajets publiés" supprimée, compteurs animés ajoutés -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">

        <!-- Conducteurs -->
        <div class="bg-white p-5 rounded-3xl shadow-sm border border-slate-100 flex justify-between items-start hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                </svg>
            </div>
            <div class="text-right">
                <div class="font-display text-3xl font-bold text-slate-900 leading-none mb-1"
                     data-counter="<?= $stats['nb_conducteurs'] ?? 0 ?>">0</div>
                <div class="text-xs font-medium text-slate-500">Conducteurs</div>
            </div>
        </div>

        <!-- Passagers -->
        <div class="bg-white p-5 rounded-3xl shadow-sm border border-slate-100 flex justify-between items-start hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                </svg>
            </div>
            <div class="text-right">
                <div class="font-display text-3xl font-bold text-slate-900 leading-none mb-1"
                     data-counter="<?= $stats['nb_passagers'] ?? 0 ?>">0</div>
                <div class="text-xs font-medium text-slate-500">Passagers</div>
            </div>
        </div>

        <!-- Réservations -->
        <div class="bg-white p-5 rounded-3xl shadow-sm border border-slate-100 flex justify-between items-start hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                </svg>
            </div>
            <div class="text-right">
                <div class="font-display text-3xl font-bold text-slate-900 leading-none mb-1"
                     data-counter="<?= $stats['nb_reservations'] ?? 0 ?>">0</div>
                <div class="text-xs font-medium text-slate-500">Réservations</div>
            </div>
        </div>

    </section>

    <!-- Script compteur animé -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('[data-counter]').forEach(function (el) {
            var target = parseInt(el.dataset.counter, 10) || 0;
            var duration = 1200;
            var start = performance.now();
            function tick(now) {
                var p = Math.min((now - start) / duration, 1);
                var ease = 1 - Math.pow(1 - p, 3);
                el.textContent = Math.round(ease * target);
                if (p < 1) requestAnimationFrame(tick);
            }
            requestAnimationFrame(tick);
        });
    });
    </script>

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
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-green-50 text-green-600 flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div class="text-2xl font-bold text-slate-900"><?= number_format((float)($sg->revenu_total ?? 0), 0, ',', ' ') ?> <span class="text-sm font-medium text-slate-400">FCFA</span></div>
                <div class="text-xs text-slate-500 mt-1">Chiffre d'affaires total</div>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" /></svg>
                </div>
                <div class="text-2xl font-bold text-slate-900"><?= number_format((float)($sg->revenu_moyen_par_trajet ?? 0), 0, ',', ' ') ?> <span class="text-sm font-medium text-slate-400">FCFA</span></div>
                <div class="text-xs text-slate-500 mt-1">Revenu moyen / trajet</div>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                </div>
                <div class="text-2xl font-bold text-slate-900"><?= $sg->taux_occupation_global ?? 0 ?><span class="text-sm font-medium text-slate-400">%</span></div>
                <div class="text-xs text-slate-500 mt-1">Taux d'occupation global</div>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185z" /></svg>
                </div>
                <div class="text-2xl font-bold text-slate-900"><?= number_format((float)($sg->prix_moyen_place ?? 0), 0, ',', ' ') ?> <span class="text-sm font-medium text-slate-400">FCFA</span></div>
                <div class="text-xs text-slate-500 mt-1">Prix moyen / place</div>
            </div>
        </div>
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

    <!-- ========== GRAPHIQUES + TOP CONDUCTEURS ========== -->
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
                
                    <div style="height:260px">
                        <canvas id="chartTrajetsMois" width="707" height="260" style="display: block; box-sizing: border-box; height: 260px; width: 707px;"></canvas>
                    </div>

                    <script>
                    (() => {

                        const labels = ["Janvier","F\u00e9vrier","Mars","Avril","Mai","Juin","Juillet","Ao\u00fbt","Septembre","Octobre","Novembre","D\u00e9cembre"];

                        const values = [0,0,0,0,0,15,0,0,0,0,0,0];

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

                            </div>
        </div>
        <!-- Revenu par mois -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                <div>
                    <h2 class="font-display text-base font-bold text-slate-900">Revenus par mois</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Chiffre d'affaires mensuel (FCFA)</p>
                </div>
                 
                    <div class="p-6">
                        <p class="text-slate-400 text-sm text-center py-8">Aucune donnée.</p>
                    </div>
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

                
                    <div style="height:260px">
                        <canvas id="chartTauxOccupation" width="707" height="260" style="display: block; box-sizing: border-box; height: 260px; width: 707px;"></canvas>
                    </div>

                    <script>
                    (() => {

                        const labels = ["Janvier","F\u00e9vrier","Mars","Avril","Mai","Juin","Juillet","Ao\u00fbt","Septembre","Octobre","Novembre","D\u00e9cembre"];

                        const values = [0,0,0,0,0,8.3,0,0,0,0,0,0];

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

                
            </div>

        </div>

        <!-- Top Conducteurs -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                <div>
                    <h2 class="font-display text-base font-bold text-slate-900">Top Conducteurs</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Classement par nombre de trajets publiés</p>
                </div>
                <span class="text-xs font-semibold bg-brand-50 text-brand-600 px-3 py-1 rounded-full">Top 5</span>
            </div>
            <div class="p-6">
                <?php if(empty($top_conducteurs)): ?>
                    <p class="text-slate-400 text-sm text-center py-8">Aucun conducteur actif.</p>
                <?php else: ?>
                <?php
                $medals = ['🥇','🥈','🥉'];
                $maxT = max(array_map(fn($c) => (int)$c->nb_trajets, $top_conducteurs)) ?: 1;
                ?>
                <div class="space-y-4">
                    <?php foreach($top_conducteurs as $i => $c): $pct = round((int)$c->nb_trajets / $maxT * 100); ?>
                    <div class="flex items-center gap-3">
                        <span class="text-xl w-7 shrink-0 text-center"><?= $medals[$i] ?? $i+1 ?></span>
                        <div class="w-9 h-9 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center font-bold text-sm shrink-0">
                            <?= mb_strtoupper(mb_substr($c->conducteur, 0, 1)) ?>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-center mb-1.5">
                                <span class="text-sm font-semibold text-slate-800 truncate"><?= htmlspecialchars($c->conducteur) ?></span>
                                <div class="flex items-center gap-2 ml-2 shrink-0">
                                    <?php if($c->note_moyenne): ?>
                                    <span class="text-xs text-yellow-600 font-semibold">⭐ <?= number_format((float)$c->note_moyenne,1) ?></span>
                                    <?php endif; ?>
                                    <span class="text-sm font-bold text-brand-600"><?= (int)$c->nb_trajets ?></span>
                                </div>
                            </div>
                            <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                <div class="h-full bg-brand-500 rounded-full transition-all duration-500" style="width:<?= $pct ?>%"></div>
                            </div>
                            <div class="text-xs text-slate-400 mt-1"><?= (int)($c->passagers_transportes ?? 0) ?> passager(s)</div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

    </div>

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
                <a href="<?= BASE_URL ?>admin/historique" class="block text-center mt-8 text-sm font-semibold text-brand-600 hover:text-brand-700 transition-colors">Voir tout l'historique &rarr;</a>        
            </div>
    </section>

</div>  