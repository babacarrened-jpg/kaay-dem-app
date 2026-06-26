<!-- Hero Section -->
<section class="relative bg-slate-900 text-white rounded-b-[40px] mb-16 shadow-2xl overflow-hidden py-32 px-6 lg:px-10 text-center z-10">
    <!-- Unsplash Image Background -->
    <div class="absolute inset-0 bg-cover bg-center opacity-40 mix-blend-overlay" style="background-image: url('https://images.unsplash.com/photo-1519046904884-53103b34b206?auto=format&fit=crop&q=80&w=2070');"></div>
    <div class="absolute inset-0 bg-gradient-to-br from-brand-900/90 to-brand-700/80"></div>
    
    <!-- Glow Effect -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-accent/20 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto z-20">
        <div class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md rounded-full font-semibold text-sm mb-6 border border-white/20 shadow-lg">
            ✨ La nouvelle façon de voyager au Sénégal
        </div>
        <h1 class="text-5xl md:text-6xl lg:text-7xl font-display font-bold mb-6 leading-tight tracking-tight drop-shadow-lg">
            Voyagez ensemble,<br/>
            <span class="text-accent relative inline-block after:content-[''] after:absolute after:bottom-2 after:left-0 after:w-full after:h-3 after:bg-accent/30 after:-z-10 after:-skew-x-12">économisez malin.</span>
        </h1>
        <p class="text-xl md:text-2xl text-white/90 max-w-2xl mx-auto font-light mb-12 drop-shadow">
            <?= isset($description) ? $description : "Trouvez des trajets conviviaux, écologiques et économiques partout au Sénégal." ?>
        </p>
        
        <!-- Search Glass -->
        <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 max-w-4xl mx-auto shadow-2xl">
            <form action="<?= BASE_URL ?>trajets/resultats" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-5 items-end text-left">
                
                <div class="flex flex-col gap-2">
                    <label class="text-white/90 text-sm font-semibold tracking-wide">Départ</label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500">
                            <!-- Heroicon: map-pin -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                        </div>
                        <input type="text" name="depart" class="w-full h-12 pl-11 pr-4 rounded-xl bg-white/90 text-slate-900 placeholder-slate-400 focus:bg-white focus:ring-4 focus:ring-accent/40 outline-none transition-all" placeholder="Dakar...">
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-white/90 text-sm font-semibold tracking-wide">Arrivée</label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500">
                            <!-- Heroicon: map-pin -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                        </div>
                        <input type="text" name="arrivee" class="w-full h-12 pl-11 pr-4 rounded-xl bg-white/90 text-slate-900 placeholder-slate-400 focus:bg-white focus:ring-4 focus:ring-accent/40 outline-none transition-all" placeholder="Diamniadio...">
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-white/90 text-sm font-semibold tracking-wide">Date</label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500">
                            <!-- Heroicon: calendar -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                        </div>
                        <input type="date" name="date" class="w-full h-12 pl-11 pr-4 rounded-xl bg-white/90 text-slate-900 focus:bg-white focus:ring-4 focus:ring-accent/40 outline-none transition-all">
                    </div>
                </div>

                <button type="submit" class="h-12 bg-accent hover:bg-accent-dark text-slate-900 font-bold rounded-xl flex items-center justify-center gap-2 shadow-[0_4px_12px_rgba(253,224,71,0.4)] hover:shadow-[0_6px_20px_rgba(253,224,71,0.6)] hover:-translate-y-0.5 transition-all duration-300">
                    <!-- Heroicon: magnifying-glass -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    Rechercher
                </button>
            </form>
        </div>
    </div>
</section>

<!-- CTA Réservation Section -->
<section class="py-20 px-6 lg:px-10 max-w-7xl mx-auto">
    <div class="bg-gradient-to-br from-brand-50 via-white to-accent/20 rounded-3xl border border-brand-200/50 p-12 md:p-16 text-center shadow-[0_20px_60px_-10px_rgba(220,38,38,0.15)]">
        <div class="inline-block px-4 py-2 bg-brand-100 rounded-full font-bold text-brand-700 text-sm mb-6">
            🚗 Commencez dès maintenant
        </div>
        <h2 class="text-4xl md:text-5xl font-display font-bold text-slate-900 mb-4">Prêt à réserver votre trajet ?</h2>
        <p class="text-xl text-slate-600 mb-10 max-w-2xl mx-auto leading-relaxed">
            Rejoignez des centaines d'étudiants et commencez à économiser sur vos trajets. C'est gratuit, simple et instantané.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <?php if (!isset($_SESSION['user_id'])): ?>
                <!-- Si pas connecté -->
                <a href="<?= BASE_URL ?>auth/inscription" 
                   class="inline-flex items-center gap-2 bg-gradient-to-r from-brand-600 to-brand-700 hover:from-brand-700 hover:to-brand-800 text-white font-bold py-4 px-8 rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Créer un compte & réserver
                </a>
                <a href="<?= BASE_URL ?>auth/connexion" 
                   class="inline-flex items-center gap-2 bg-white border-2 border-brand-600 text-brand-700 hover:bg-brand-50 font-bold py-4 px-8 rounded-2xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0118 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    Se connecter
                </a>
            <?php else: ?>
                <!-- Si connecté -->
                <a href="<?= BASE_URL ?>trajets/resultats" 
                   class="inline-flex items-center gap-2 bg-gradient-to-r from-brand-600 to-brand-700 hover:from-brand-700 hover:to-brand-800 text-white font-bold py-4 px-8 rounded-2xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    Réserver maintenant
                </a>
                <a href="<?= BASE_URL ?>passager/dashboard" 
                   class="inline-flex items-center gap-2 bg-white border-2 border-brand-600 text-brand-700 hover:bg-brand-50 font-bold py-4 px-8 rounded-2xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m0 0h6m0 0V6m0 0h-6M6 12a6 6 0 1112 0 6 6 0 01-12 0z" />
                    </svg>
                    Voir mes réservations
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 px-6 lg:px-10 max-w-7xl mx-auto">
    <div class="text-center mb-16">
        <span class="text-brand-600 font-bold text-sm uppercase tracking-widest">Simple et Efficace</span>
        <h2 class="text-4xl md:text-5xl font-display font-bold text-slate-900 mt-3">Comment ça marche ?</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <!-- Feature 1 -->
        <div class="bg-white rounded-3xl p-10 text-center shadow-[0_10px_40px_-10px_rgba(15,23,42,0.08)] border border-slate-100 hover:-translate-y-3 hover:shadow-[0_20px_40px_-10px_rgba(4,120,87,0.15)] transition-all duration-300 group relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-500 to-brand-700 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            
            <div class="w-20 h-20 mx-auto bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center mb-8 -rotate-6 group-hover:rotate-0 group-hover:bg-gradient-to-br group-hover:from-brand-600 group-hover:to-brand-700 group-hover:text-white group-hover:scale-110 transition-all duration-300 shadow-lg shadow-brand-100">
                <!-- Heroicon: magnifying-glass -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>
            <h3 class="text-2xl font-display font-bold text-slate-900 mb-4">1. Cherchez votre trajet</h3>
            <p class="text-slate-500 leading-relaxed">Trouvez rapidement les itinéraires disponibles autour de vous, grâce à notre moteur de recherche intelligent.</p>
        </div>
        
        <!-- Feature 2 -->
        <div class="bg-white rounded-3xl p-10 text-center shadow-[0_10px_40px_-10px_rgba(15,23,42,0.08)] border border-slate-100 hover:-translate-y-3 hover:shadow-[0_20px_40px_-10px_rgba(4,120,87,0.15)] transition-all duration-300 group relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-500 to-brand-700 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            
            <div class="w-20 h-20 mx-auto bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center mb-8 -rotate-6 group-hover:rotate-0 group-hover:bg-gradient-to-br group-hover:from-brand-600 group-hover:to-brand-700 group-hover:text-white group-hover:scale-110 transition-all duration-300 shadow-lg shadow-brand-100">
                <!-- Heroicon: cursor-arrow-rays -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.159-5.254a5.25 5.25 0 011.07-3.21l1.58-2.19m0 0L15.42 6.5m-1.736 1.67l-2.613-2.613m-2.228 5.753l-2.613 2.613M12.06 12.06l3.525 3.525m-1.229 1.936l1.229 1.936M7.832 7.832L10.5 10.5m-2.668-2.668l1.642-4.106" />
                </svg>
            </div>
            <h3 class="text-2xl font-display font-bold text-slate-900 mb-4">2. Réservez en un clic</h3>
            <p class="text-slate-500 leading-relaxed">Bloquez votre place immédiatement depuis votre smartphone. C'est simple, rapide et sécurisé.</p>
        </div>
        
        <!-- Feature 3 -->
        <div class="bg-white rounded-3xl p-10 text-center shadow-[0_10px_40px_-10px_rgba(15,23,42,0.08)] border border-slate-100 hover:-translate-y-3 hover:shadow-[0_20px_40px_-10px_rgba(4,120,87,0.15)] transition-all duration-300 group relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-brand-500 to-brand-700 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            
            <div class="w-20 h-20 mx-auto bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center mb-8 -rotate-6 group-hover:rotate-0 group-hover:bg-gradient-to-br group-hover:from-brand-600 group-hover:to-brand-700 group-hover:text-white group-hover:scale-110 transition-all duration-300 shadow-lg shadow-brand-100">
                <!-- Heroicon: truck -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                </svg>
            </div>
            <h3 class="text-2xl font-display font-bold text-slate-900 mb-4">3. Voyagez ensemble !</h3>
            <p class="text-slate-500 leading-relaxed">Partagez la route, économisez vos frais de déplacement et faites de belles rencontres.</p>
        </div>
    </div>
</section>

<!-- Carte libre Leaflet -->
<section class="py-20 px-6 lg:px-10 max-w-7xl mx-auto border-t border-slate-200">
    <div class="flex flex-col lg:flex-row gap-12 items-center">
        <div class="lg:w-1/3">
            <span class="text-brand-600 font-bold text-sm uppercase tracking-widest">Couverture Globale</span>
            <h2 class="text-4xl font-display font-bold text-slate-900 mt-3 mb-6">Des trajets partout, en temps réel.</h2>
            <p class="text-slate-500 text-lg leading-relaxed mb-8">
                Explorez la carte pour voir les trajets récemment proposés. Notre intégration open source Leaflet + OSRM vous offre une expérience fluide et gratuite.
            </p>
            <a href="<?= BASE_URL ?>trajets/recherche" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white font-semibold py-3 px-6 rounded-xl shadow-lg transition-colors group">
                Explorer les trajets
                <!-- Heroicon: arrow-right -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 group-hover:translate-x-1 transition-transform">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
        <div class="lg:w-2/3 w-full h-[400px] rounded-3xl overflow-hidden shadow-2xl relative border border-slate-800">
            <!-- Leaflet Container -->
            <div id="leaflet-map" class="w-full h-full bg-slate-900"></div>
            
            <!-- Notice si la carte ne peut pas être affichée -->
            <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm flex flex-col items-center justify-center p-6 text-center pointer-events-none hidden" id="leaflet-error">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-red-400 mb-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <h3 class="text-white font-bold text-xl mb-2">Impossible d'afficher la carte</h3>
                <p class="text-slate-300">La carte utilise Leaflet et OSRM. Vérifiez votre connexion réseau et réessayez.</p>
            </div>
        </div>
    </div>
</section>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    const origin = [-17.4677, 14.7167]; // Dakar
    const destination = [-17.1290, 14.6655]; // Diamniadio (approx.)

    const createMarkerIcon = (color) => {
        return L.divIcon({
            className: 'custom-marker',
            html: `<span style="display:inline-block;width:16px;height:16px;border-radius:9999px;background:${color};border:2px solid white;box-shadow:0 0 10px ${color};"></span>`,
            iconSize: [20, 20],
            iconAnchor: [10, 10]
        });
    };

    const showMapError = () => {
        const errDiv = document.getElementById('leaflet-error');
        if (errDiv) errDiv.classList.remove('hidden');
    };

    const fetchRoute = async (from, to) => {
        const routeUrl = `https://router.project-osrm.org/route/v1/driving/${from[0]},${from[1]};${to[0]},${to[1]}?overview=full&geometries=geojson`;
        const response = await fetch(routeUrl);
        const data = await response.json();

        if (!data.routes || !data.routes.length) {
            throw new Error('Aucun itinéraire trouvé');
        }

        return data.routes[0].geometry;
    };

    if (typeof L !== 'undefined') {
        const map = L.map('leaflet-map', {
            center: [origin[1], origin[0]],
            zoom: 10,
            zoomControl: false
        });

        L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://carto.com/">CARTO</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            maxZoom: 19
        }).addTo(map);

        fetchRoute(origin, destination)
            .then(routeGeoJson => {
                const routeLayer = L.geoJSON(routeGeoJson, {
                    style: { color: '#38bdf8', weight: 6, opacity: 0.95 }
                }).addTo(map);

                const bounds = routeLayer.getBounds();
                map.fitBounds(bounds, { padding: [40, 40] });

                L.marker([origin[1], origin[0]], { icon: createMarkerIcon('#4ade80') })
                    .bindPopup('<strong>Dakar</strong><br><span style="color:#CBD5E1;">Départ</span>')
                    .addTo(map);

                L.marker([destination[1], destination[0]], { icon: createMarkerIcon('#fb7185') })
                    .bindPopup('<strong>Diamniadio</strong><br><span style="color:#CBD5E1;">Arrivée</span>')
                    .addTo(map);
            })
            .catch(() => showMapError());
    } else {
        showMapError();
    }
</script>
