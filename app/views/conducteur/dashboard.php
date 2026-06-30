<?php
/**
 * REQUÊTE SQL RECOMMANDÉE POUR LE CONTRÔLEUR :
 * * $user_id = $_SESSION['user_id']; // ID de l'utilisateur connecté
 * * $query = $db->prepare("
 * SELECT r.*, 
 * t.date_trajet, t.heure_depart, t.ville_depart, t.ville_arrivee, t.statut AS trajet_statut,
 * u.prenom AS conducteur_prenom, u.nom AS conducteur_nom
 * FROM reservations r
 * INNER JOIN trajets t ON r.trajet_id = t.id
 * INNER JOIN utilisateurs u ON t.conducteur_id = u.id
 * WHERE r.passager_id = :user_id
 * ORDER BY t.date_trajet DESC, t.heure_depart DESC
 * ");
 * $query->execute(['user_id' => $user_id]);
 * $reservations = $query->fetchAll(PDO::FETCH_OBJ);
 */

// Sécurité pour éviter les erreurs de variables non définies
$reservations = $reservations ?? [];
$trajetsDejaNote = $trajetsDejaNote ?? [];
?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/lucide@latest"></script>

<div style="min-height: 100vh; padding: 40px 20px 60px; box-sizing: border-box; background-color: #f7f9fa; background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAxNDAgODAiPjx0ZXh0IHg9IjE1IiB5PSIzMCIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+S0FBWTwvdGV4dD48dGV4dCB4PSIxNSIgeT0iNDUiIGZpbGw=\#'): background-repeat: repeat; font-family: system-ui, -apple-system, sans-serif;">

    <div style="max-width: 1100px; margin: 0 auto;">

        <div style="display:flex; justify-content:space-between; align-items:center; gap:20px; margin-bottom:32px; padding:24px 28px; border-radius:24px; background:rgba(255,255,255,0.85); border:1px solid rgba(229,231,235,0.7); box-shadow:0 16px 40px rgba(0,0,0,0.04); backdrop-filter:blur(12px); -webkit-backdrop-filter:blur(12px); flex-wrap: wrap;">
            <div style="display:flex; align-items:center; gap:16px;">
                <div style="width:56px; height:56px; background:#dc2626; color:white; border-radius:18px; display:flex; align-items:center; justify-content:center; box-shadow: 0 4px 14px rgba(220,38,38,0.2);">
                    <i data-lucide="user-cog" width="28" height="28"></i>
                </div>
                <div>
                    <h1 style="font-size:1.8rem; margin:0; font-weight: 800; color: #111827;">Espace Conducteur</h1>
                    <p style="margin:4px 0 0; color:#64748b; font-weight: 500;">Pilotez vos trajets et suivez l'historique de vos réservations passager.</p>
                </div>
            </div>
            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <a href="<?= BASE_URL ?>trajets/recherche"
                   style="text-decoration:none; display: inline-flex; align-items: center; gap: 8px; padding: 12px 20px; border-radius: 12px; font-size: 14px; font-weight: 700; border: 1px solid #e2e8f0; color: #334155; background: white; transition: all 0.2s;"
                   onmouseover="this.style.background='#f8fafc'; this.style.borderColor='#cbd5e1';"
                   onmouseout="this.style.background='white'; this.style.borderColor='#e2e8f0';">
                    <i data-lucide="search" width="16" height="16"></i> Trouver un trajet
                </a>
                <a href="<?= BASE_URL ?>conducteur/trajets/nouveau"
                   style="text-decoration:none; display: inline-flex; align-items: center; gap: 8px; padding: 12px 22px; border-radius: 12px; font-size: 14px; font-weight: 700; color: white; background: #dc2626; transition: all 0.2s; box-shadow: 0 4px 12px rgba(220,38,38,0.15);"
                   onmouseover="this.style.background='#b91c1c';"
                   onmouseout="this.style.background='#dc2626';">
                    <i data-lucide="plus-circle" width="20" height="20"></i> Nouveau trajet
                </a>
            </div>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:20px; margin-bottom:48px;">
            <div class="glass-panel" style="padding:24px; display:flex; align-items:center; gap:18px; background: rgba(255,255,255,0.85); border-radius:20px; border:1px solid rgba(229,231,235,0.6); box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
                <div style="width:52px; height:52px; background:#FEE2E2; color:#dc2626; border-radius:16px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i data-lucide="milestone" width="26" height="26"></i>
                </div>
                <div>
                    <div style="color:#64748b; font-size:13px; font-weight:600; margin-bottom:4px;">Trajets proposés</div>
                    <div style="font-size:32px; font-weight:800; color:#0f172a; line-height:1;"><?= $trajets_actifs ?></div>
                </div>
            </div>

            <div class="glass-panel" style="padding:24px; display:flex; align-items:center; gap:18px; background: rgba(255,255,255,0.85); border-radius:20px; border:1px solid rgba(229,231,235,0.6); box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
                <div style="width:52px; height:52px; background:#DBEAFE; color:#1d4ed8; border-radius:16px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i data-lucide="ticket" width="24" height="24"></i>
                </div>
                <div>
                    <div style="color:#64748b; font-size:13px; font-weight:600; margin-bottom:4px;">Total Réservations</div>
                    <div style="font-size:32px; font-weight:800; color:#0f172a; line-height:1;"><?= count($reservations) ?></div>
                </div>
            </div>

            <div class="glass-panel" style="padding:24px; display:flex; align-items:center; gap:18px; background: rgba(255,255,255,0.85); border-radius:20px; border:1px solid rgba(229,231,235,0.6); box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
                <div style="width:52px; height:52px; background:#E0F2FE; color:#0369a1; border-radius:16px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i data-lucide="banknote" width="26" height="26"></i>
                </div>
                <div>
                    <div style="color:#64748b; font-size:13px; font-weight:600; margin-bottom:4px;">Gains ce mois</div>
                    <div style="font-size:24px; font-weight:800; color:#dc2626; line-height:1;"><?= number_format($gains_mois, 0, ',', ' ') ?> F</div>
                </div>
            </div>

            <div class="glass-panel" style="padding:24px; display:flex; align-items:center; gap:18px; background: rgba(255,255,255,0.85); border-radius:20px; border:1px solid rgba(229,231,235,0.6); box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
                <div style="width:52px; height:52px; background:#FEF3C7; color:#d97706; border-radius:16px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i data-lucide="star" width="24" height="24"></i>
                </div>
                <div>
                    <div style="color:#64748b; font-size:13px; font-weight:600; margin-bottom:4px;">Ma note globale</div>
                    <div style="font-size:32px; font-weight:800; color:#d97706; line-height:1;">
                        <?= $note_moyenne > 0 ? number_format($note_moyenne, 1) . '<span style="font-size:16px;color:#94a3b8;">/5</span>' : '—' ?>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-bottom: 56px;">
            <h3 style="font-size:22px; margin:0 0 24px 0; font-weight:800; display:flex; align-items:center; gap:10px; color: #111827;">
                <i data-lucide="calendar-check" width="24" height="24" style="color:#dc2626;"></i> Mes trajets proposés
            </h3>

            <?php if(!empty($trajets)): ?>
                <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(480px, 1fr)); gap:24px;">
                    <?php foreach($trajets as $trajet): ?>
                        <div class="glass-panel" style="padding:24px; background: rgba(255,255,255,0.9); backdrop-filter:blur(10px); border-radius:24px; border:1px solid rgba(229,231,235,0.6);">
                            <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:16px; margin-bottom:12px;">
                                <div>
                                    <span style="display:inline-block; background:#FEE2E2; color:#dc2626; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:0.08em; padding:3px 8px; border-radius:999px; margin-bottom:6px;"><?= htmlspecialchars($trajet->statut) ?></span>
                                    <h4 style="margin:0; font-size:20px; font-weight:800; color: #111827;"><?= htmlspecialchars($trajet->ville_depart) ?> → <?= htmlspecialchars($trajet->ville_arrivee) ?></h4>
                                </div>
                                <div style="text-align:right; flex-shrink:0;">
                                    <div style="font-size:22px; font-weight:800; color:#dc2626;"><?= number_format($trajet->prix_par_place, 0, ',', ' ') ?> F</div>
                                    <div style="font-size:11px; color:#94a3b8;">par place</div>
                                </div>
                            </div>

                            <div style="display:flex; gap:14px; flex-wrap:wrap; font-size:12px; color:#64748b; margin-bottom:16px; font-weight: 500;">
                                <span style="display:flex;align-items:center;gap:4px;"><i data-lucide="calendar" width="13" height="13"></i><?= date('d/m/Y', strtotime($trajet->date_trajet)) ?></span>
                                <span style="display:flex;align-items:center;gap:4px;"><i data-lucide="clock" width="13" height="13"></i><?= substr($trajet->heure_depart, 0, 5) ?></span>
                                <span style="display:flex;align-items:center;gap:4px;"><i data-lucide="users" width="13" height="13"></i><?= $trajet->places_disponibles ?> places restantes</span>
                            </div>

                            <div style="border-radius:14px; overflow:hidden; margin-bottom:16px; border:1px solid #e5e7eb;">
                                <div id="trip-map-<?= $trajet->id ?>" data-route-map="true" data-depart="<?= htmlspecialchars($trajet->ville_depart) ?>" data-arrivee="<?= htmlspecialchars($trajet->ville_arrivee) ?>" style="width:100%; height:160px; background:#f1f5f9;"></div>
                            </div>

                            <form action="<?= BASE_URL ?>conducteur/trajet/<?= $trajet->id ?>/annuler" method="POST" onsubmit="return confirm('Annuler ce trajet ?');">
                                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 py-3 rounded-xl text-xs font-semibold text-white" style="background:#dc2626; border:none; cursor:pointer;" onmouseover="this.style.background='#b91c1c';" onmouseout="this.style.background='#dc2626';">
                                    <i data-lucide="x-circle" width="14" height="14"></i> Annuler ce trajet
                                </button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="glass-panel" style="text-align:center; padding:50px 20px; background: rgba(255,255,255,0.9); border-radius:24px; border:1px solid rgba(229,231,235,0.6);">
                    <div style="font-size:48px; margin-bottom:14px;">🚗</div>
                    <h4 style="font-size:18px; margin-bottom:6px; font-weight:800;">Aucun trajet proposé</h4>
                    <p style="color:#64748b; font-size:14px; margin:0;">Vous n'avez publié aucun trajet actif pour le moment.</p>
                </div>
            <?php endif; ?>
        </div>


        <div>
            <h3 style="font-size:22px; margin:0 0 24px 0; font-weight:800; display:flex; align-items:center; gap:10px; color: #111827;">
                <i data-lucide="ticket" width="24" height="24" style="color:#dc2626;"></i> Mes réservations faites (Nouvelles & Anciennes)
            </h3>

            <?php if(empty($reservations)): ?>
                <div class="glass-panel" style="padding:60px 20px; text-align:center; background: rgba(255,255,255,0.9); border-radius:24px; border:1px solid rgba(229,231,235,0.6);">
                    <div style="font-size:48px; color:#94a3b8; margin-bottom:14px;">🎫</div>
                    <h4 style="font-size:18px; margin-bottom:6px; font-weight:800; color:#111827;">Aucune réservation dans la base de données</h4>
                    <p style="color:#64748b; font-size:14px; margin:0;">Vos anciennes et nouvelles réservations apparaîtront ici dès qu'elles seront enregistrées.</p>
                </div>
            <?php else: ?>
                <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(480px, 1fr)); gap:24px;">
                    <?php foreach($reservations as $res): ?>
                        <div class="glass-panel" style="padding:24px; background:white; border-radius:24px; border:1px solid rgba(229,231,235,0.7); box-shadow:0 4px 20px rgba(0,0,0,0.01); display:flex; flex-direction:column; justify-content:space-between; gap:16px;">
                            
                            <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:16px;">
                                <div>
                                    <div style="font-size:12px; color:#64748b; font-weight:600; background:#f1f5f9; padding:4px 10px; border-radius:6px; display:inline-flex; align-items:center; gap:4px; margin-bottom:8px;">
                                        <i data-lucide="calendar" width="12" height="12"></i> Le <?= date('d/m/Y', strtotime($res->date_trajet)) ?> à <?= substr($res->heure_depart, 0, 5) ?>
                                    </div>
                                    <h4 style="margin:0; font-size:18px; font-weight:800; color:#111827;"><?= htmlspecialchars($res->ville_depart) ?> → <?= htmlspecialchars($res->ville_arrivee) ?></h4>
                                    <div style="color:#475569; font-size:14px; margin-top:8px; display:flex; align-items:center; gap:6px;">
                                        <i data-lucide="user" width="14" height="14" style="color:#64748b;"></i> Conducteur : <strong style="color: #111827;"><?= htmlspecialchars($res->conducteur_prenom . ' ' . $res->conducteur_nom) ?></strong>
                                    </div>
                                </div>
                                <div style="text-align:right; flex-shrink:0;">
                                    <div style="font-size:22px; font-weight:800; color:#dc2626;"><?= number_format($res->prix_total, 0, ',', ' ') ?> F</div>
                                    <div style="color:#64748b; font-size:12px; font-weight:700; background:#f1f5f9; padding:2px 6px; border-radius:4px; display:inline-block; margin-top:2px;"><?= $res->places_reservees ?> place<?= $res->places_reservees > 1 ? 's' : '' ?></div>
                                </div>
                            </div>

                            <div style="display:flex; justify-content:space-between; align-items:center; border-top:1px solid #f1f5f9; padding-top:14px; flex-wrap:wrap; gap:10px;">
                                <div>
                                    <?php if($res->statut == 'en_attente'): ?>
                                        <span style="padding:4px 12px; border-radius:999px; background:#FEF3C7; color:#92400E; font-size:11px; font-weight:700; text-transform:uppercase;">En attente</span>
                                    <?php elseif($res->statut == 'confirmee'): ?>
                                        <span style="padding:4px 12px; border-radius:999px; background:#DCFCE7; color:#166534; font-size:11px; font-weight:700; text-transform:uppercase;">Confirmée</span>
                                    <?php elseif($res->statut == 'annulee'): ?>
                                        <span style="padding:4px 12px; border-radius:999px; background:#FEE2E2; color:#991B1B; font-size:11px; font-weight:700; text-transform:uppercase;">Annulée</span>
                                    <?php elseif($res->statut == 'terminee' || strtotime($res->date_trajet) < time()): ?>
                                        <span style="padding:4px 12px; border-radius:999px; background:#e2e8f0; color:#475569; font-size:11px; font-weight:700; text-transform:uppercase;">Ancien Voyage</span>
                                    <?php endif; ?>
                                </div>

                                <div style="display:flex; gap:6px; align-items:center;">
                                    <a href="<?= BASE_URL ?>passager/reservation/<?= $res->id ?>"
                                       style="text-decoration:none; display: inline-flex; align-items: center; padding: 8px 16px; border-radius: 10px; font-size: 13px; font-weight: 700; color: white; background: #334155; transition: background 0.2s;"
                                       onmouseover="this.style.background='#1e293b';" onmouseout="this.style.background='#334155';">
                                        Suivre
                                    </a>

                                    <?php if(in_array($res->statut, ['en_attente', 'confirmee'], true) && strtotime($res->date_trajet) >= time()): ?>
                                        <form action="<?= BASE_URL ?>passager/reservation/<?= $res->id ?>/annuler" method="POST" onsubmit="return confirm('Annuler cette réservation ?');" style="display:inline;">
                                            <button type="submit" style="cursor:pointer; padding: 8px 16px; border-radius: 10px; font-size: 13px; font-weight: 700; border: 1px solid #e2e8f0; color: #dc2626; background: white; transition: all 0.2s;" onmouseover="this.style.background='#fef2f2';" onmouseout="this.style.background='white';">
                                                Annuler
                                            </button>
                                        </form>
                                    <?php endif; ?>

                                    <?php
                                    $estPasse = ($res->statut === 'terminee') || (strtotime($res->date_trajet) < time() && $res->statut !== 'annulee');
                                    $dejaNote = in_array((int)$res->trajet_id, $trajetsDejaNote);
                                    ?>
                                    <?php if($estPasse && !$dejaNote): ?>
                                        <a href="<?= BASE_URL ?>passager/reservation/<?= $res->id ?>/avis" style="text-decoration:none; display: inline-flex; align-items: center; padding: 8px 16px; border-radius: 10px; font-size: 13px; font-weight: 700; color: white; background: #d97706;" onmouseover="this.style.background='#b45309';" onmouseout="this.style.background='#d97706';">
                                            ★ Laisser un avis
                                        </a>
                                    <?php elseif($estPasse && $dejaNote): ?>
                                        <span style="padding: 8px 16px; border-radius: 10px; font-size: 13px; font-weight: 700; color: #94a3b8; background: #f1f5f9; border: 1px solid #e2e8f0;">
                                            Noté
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>

<?php if(!empty($trajets)): ?>
<script>
const VILLES = {
    'dakar':      { lat: 14.6937, lon: -17.4441 },
    'rufisque':   { lat: 14.7156, lon: -17.2736 },
    'diamniadio': { lat: 14.7178, lon: -17.1731 },
};

const resolveCity = (query) => {
    if (!query) throw new Error("Nom de ville vide");
    const key = query.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '').trim();
    if (key.includes('dakar')) return VILLES['dakar'];
    if (key.includes('rufisque')) return VILLES['rufisque'];
    if (key.includes('diamniadio')) return VILLES['diamniadio'];
    throw new Error(`Ville non reconnue : ${query}`);
};

const fetchRoute = async (from, to) => {
    const r = await fetch(`https://router.project-osrm.org/route/v1/driving/${from.lon},${from.lat};${to.lon},${to.lat}?overview=full&geometries=geojson`);
    const d = await r.json();
    if (!d.routes || !d.routes.length) throw new Error('Pas de route trouvée');
    return d.routes[0].geometry;
};

const getMarkerIcon = (color) => L.divIcon({
    className: '',
    html: `<div style="width:12px;height:12px;border-radius:50%;background:${color};border:2px solid white;box-shadow:0 0 6px ${color};"></div>`,
    iconSize: [12, 12], iconAnchor: [6, 6]
});

const initMiniRouteMaps = async () => {
    const containers = document.querySelectorAll('[data-route-map="true"]');
    if (!containers.length || typeof L === 'undefined') return;

    for (const container of containers) {
        const depart  = container.getAttribute('data-depart');
        const arrivee = container.getAttribute('data-arrivee');
        if (!depart || !arrivee) continue;

        try {
            const from = resolveCity(depart);
            const to   = resolveCity(arrivee);
            container.innerHTML = '';

            const map = L.map(container, {
                zoomControl: false, dragging: false, scrollWheelZoom: false,
                doubleClickZoom: false, touchZoom: false, boxZoom: false, keyboard: false
            });

            L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', { maxZoom: 19 }).addTo(map);

            const geo   = await fetchRoute(from, to);
            const layer = L.geoJSON(geo, { style: { color: '#dc2626', weight: 4, opacity: 0.9 } }).addTo(map);

            map.fitBounds(layer.getBounds(), { padding: [15, 15] });
            L.marker([from.lat, from.lon], { icon: getMarkerIcon('#16a34a') }).addTo(map);
            L.marker([to.lat, to.lon], { icon: getMarkerIcon('#dc2626') }).addTo(map);
        } catch (e) {
            container.innerHTML = `<div style="display:flex;align-items:center;justify-content:center;height:100%;color:#94a3b8;font-size:12px;background:#f8fafc;">🗺️ Itinéraire non disponible</div>`;
        }
    }
};

document.addEventListener('DOMContentLoaded', initMiniRouteMaps);
</script>
<?php endif; ?>

<script>
lucide.createIcons();
</script>