<script src="https://unpkg.com/lucide@latest"></script>

<div style="min-height: 100vh; padding: 40px 20px 60px; box-sizing: border-box; background-color: #f7f9fa; background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAxNDAgODAiPjx0ZXh0IHg9IjE1IiB5PSIzMCIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+S0FBWTwvdGV4dD48dGV4dCB4PSIxNSIgeT0iNDUiIGZpbGw9IiNkYzI2MjYiIG9wYWNpdHk9IjAuMDciIGZvbnQtZmFtaWx5PSJzYW5zLXNlcmlmIiBmb250LXdlaWdodD0iOTAwIiBmb250LXNpemU9IjEyIiBsZXR0ZXItc3BhY2luZz0iMC41cHkiPkRFTU08L3RleHQ+PHRleHQgeD0iODUiIHk9IjcwIiBmaWxsPSIjZGMyNjI2IiBvcGFjaXR5PSIwLjA3IiBmb250LWZhbWlseT0ic2Fucy1zZXJpZiIgZm9udC13ZWlnaHQ9IjkwMCIgZm9udC1zaXplPSIxMiIgbGV0dGVyLXNwYWNpbmc9IjAuNXB5Ij5LQUFZPC90ZXh0Pjx0ZXh0IHg9Ijg1IiB5PSI4NSIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+REVNTTwvdGV4dD48L3N2Zz4='); background-repeat: repeat; font-family: system-ui, -apple-system, sans-serif;">

    <div style="max-width: 800px; margin: 0 auto;">

        <div class="page-header" style="display:flex; justify-content:space-between; align-items:center; gap:20px; margin-bottom:32px; padding:24px 28px; border-radius:24px; background:rgba(255,255,255,0.85); border:1px solid rgba(229,231,235,0.7); box-shadow:0 16px 40px rgba(0,0,0,0.04); backdrop-filter:blur(12px); -webkit-backdrop-filter:blur(12px); flex-wrap: wrap;">
            <div class="page-title-group" style="display:flex; align-items:center; gap:16px;">
                <div style="width:56px; height:56px; background:#dc2626; color:white; border-radius:18px; display:flex; align-items:center; justify-content:center; box-shadow: 0 4px 14px rgba(220,38,38,0.2);">
                    <i data-lucide="map-pin" width="28" height="28"></i>
                </div>
                <div>
                    <h1 style="font-size:1.8rem; margin:0; font-weight: 800; color: #111827;">Publier un trajet</h1>
                    <p style="margin:4px 0 0; color:#64748b; font-weight: 500;">Proposez vos places libres et partagez les frais de route.</p>
                </div>
            </div>
            <a href="<?= BASE_URL ?>conducteur/dashboard"
               style="text-decoration:none; display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; border-radius: 12px; font-size: 14px; font-weight: 600; border: 1px solid #e2e8f0; color: #334155; background: white; transition: all 0.2s;"
               onmouseover="this.style.background='#f8fafc'; this.style.borderColor='#cbd5e1';"
               onmouseout="this.style.background='white'; this.style.borderColor='#e2e8f0';">
                <i data-lucide="arrow-left" width="16" height="16"></i> Retour
            </a>
        </div>

        <?php if (!empty($erreur)): ?>
            <div style="padding:16px 20px; border-radius:14px; background:#FEE2E2; color:#991B1B; margin-bottom:24px; font-weight: 500; border: 1px solid rgba(153,27,27,0.1);">
                <?= htmlspecialchars($erreur) ?>
            </div>
        <?php endif; ?>

        <div class="glass-panel" style="padding:36px; background: rgba(255,255,255,0.9); backdrop-filter:blur(10px); -webkit-backdrop-filter:blur(10px); border-radius:24px; border:1px solid rgba(229,231,235,0.6); box-shadow:0 4px 20px rgba(0,0,0,0.01);">
            <form action="<?= BASE_URL ?>conducteur/trajets/nouveau" method="POST">

                <?php if(count($vehicules) > 1): ?>
                <div style="display:flex; align-items:center; gap:12px; margin-bottom:24px; padding-bottom:12px; border-bottom:1px solid #f1f5f9;">
                    <div style="width:28px; height:28px; background:#dc2626; color:white; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:14px; flex-shrink:0;">0</div>
                    <h3 style="font-size:18px; font-weight: 800; color:#111827; margin:0;">Choisir votre véhicule</h3>
                </div>
                <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:16px; margin-bottom:40px;">
                    <?php foreach($vehicules as $i => $v): ?>
                        <label style="cursor:pointer; margin: 0;">
                            <input type="radio" name="vehicule_id" value="<?= $v->id ?>"
                                   <?= $i === 0 ? 'checked' : '' ?>
                                   style="display:none;"
                                   onchange="document.querySelectorAll('.vehicule-card').forEach(c => c.classList.remove('vehicule-selected')); this.closest('.vehicule-card').classList.add('vehicule-selected');">
                            <div class="vehicule-card <?= $i === 0 ? 'vehicule-selected' : '' ?>"
                                 style="padding:18px; border-radius:16px; border:2px solid #E2E8F0; transition:all 0.2s; background:white;">
                                <div style="font-size:28px; margin-bottom:8px;">🚗</div>
                                <div style="font-weight:800; font-size:16px; color:#111827;"><?= htmlspecialchars($v->marque . ' ' . $v->modele) ?></div>
                                <div style="color:#64748b; font-size:13px; margin-top:4px; font-weight:500;"><?= htmlspecialchars($v->couleur) ?> · <?= htmlspecialchars($v->immatriculation) ?></div>
                                <div style="color:#dc2626; font-size:13px; font-weight:700; margin-top:2px;"><?= $v->nombre_places ?> places</div>
                            </div>
                        </label>
                    <?php endforeach; ?>
                    
                    <a href="<?= BASE_URL ?>conducteur/vehicule/nouveau?retour=trajet"
                       style="padding:18px; border-radius:16px; border:2px dashed #cbd5e1; display:flex; flex-direction:column; align-items:center; justify-content:center; gap:8px; text-decoration:none; color:#64748b; transition:all 0.2s; min-height:110px; background:rgba(255,255,255,0.5);"
                       onmouseover="this.style.borderColor='#dc2626'; this.style.color='#dc2626'; this.style.background='white';"
                       onmouseout="this.style.borderColor='#cbd5e1'; this.style.color='#64748b'; this.style.background='rgba(255,255,255,0.5)';">
                        <i data-lucide="plus-circle" width="24" height="24"></i>
                        <span style="font-size:13px; font-weight:700;">Ajouter un véhicule</span>
                    </a>
                </div>
                <?php else: ?>
                    <input type="hidden" name="vehicule_id" value="<?= $vehicules[0]->id ?>">
                    <div style="background:#f8fafc; border:1px solid #E2E8F0; border-radius:16px; padding:16px 20px; margin-bottom:32px; display:flex; align-items:center; gap:14px;">
                        <span style="font-size:24px;">🚗</span>
                        <div>
                            <div style="font-weight:800; color:#111827;"><?= htmlspecialchars($vehicules[0]->marque . ' ' . $vehicules[0]->modele) ?></div>
                            <div style="font-size:13px; color:#64748b; font-weight: 500; margin-top:2px;"><?= htmlspecialchars($vehicules[0]->couleur) ?> · <?= htmlspecialchars($vehicules[0]->immatriculation) ?> · <span style="color:#dc2626; font-weight:700;"><?= $vehicules[0]->nombre_places ?> places</span></div>
                        </div>
                        <a href="<?= BASE_URL ?>conducteur/vehicule/nouveau?retour=trajet"
                           style="margin-left:auto; font-size:13px; color:#dc2626; text-decoration:none; font-weight:700;">
                            + Ajouter un véhicule
                        </a>
                    </div>
                <?php endif; ?>

                <div style="display:flex; align-items:center; gap:12px; margin-bottom:24px; padding-bottom:12px; border-bottom:1px solid #f1f5f9;">
                    <div style="width:28px; height:28px; background:#dc2626; color:white; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:14px; flex-shrink:0;">1</div>
                    <h3 style="font-size:18px; font-weight: 800; color:#111827; margin:0;">L'itinéraire</h3>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px; margin-bottom:24px;">
                    <div class="input-group" style="margin:0;">
                        <label style="display:block; font-size:14px; font-weight:700; color:#475569; margin-bottom:8px;">Ville de départ *</label>
                        <div style="position:relative;">
                            <i data-lucide="map-pin" style="position:absolute; left:16px; top:14px; color:#94a3b8; width:18px; height:18px;"></i>
                            <select name="ville_depart" class="input-field" required style="width:100%; padding: 13px 16px 13px 48px; border-radius:12px; border:1px solid #cbd5e1; font-size:15px; background:white; appearance:none;">
                                <option value="">Choisir une ville</option>
                                <option value="Dakar">Dakar</option>
                                <option value="Rufisque">Rufisque</option>
                                <option value="Diamniadio">Diamniadio</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-group" style="margin:0;">
                        <label style="display:block; font-size:14px; font-weight:700; color:#475569; margin-bottom:8px;">Ville d'arrivée *</label>
                        <div style="position:relative;">
                            <i data-lucide="map-pin" style="position:absolute; left:16px; top:14px; color:#94a3b8; width:18px; height:18px;"></i>
                            <select name="ville_arrivee" class="input-field" required style="width:100%; padding: 13px 16px 13px 48px; border-radius:12px; border:1px solid #cbd5e1; font-size:15px; background:white; appearance:none;">
                                <option value="">Choisir une ville</option>
                                <option value="Dakar">Dakar</option>
                                <option value="Rufisque">Rufisque</option>
                                <option value="Diamniadio">Diamniadio</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px; margin-bottom:40px;">
                    <div class="input-group" style="margin:0;">
                        <label style="display:block; font-size:14px; font-weight:700; color:#475569; margin-bottom:8px;">Point de RDV précis (Départ)</label>
                        <div style="position:relative;">
                            <i data-lucide="navigation" style="position:absolute; left:16px; top:14px; color:#94a3b8; width:18px; height:18px;"></i>
                            <input type="text" name="point_depart" class="input-field" placeholder="Ex: Rond-point Colobane" style="width:100%; padding: 13px 16px 13px 48px; border-radius:12px; border:1px solid #cbd5e1; font-size:15px; box-sizing:border-box;">
                        </div>
                    </div>
                    <div class="input-group" style="margin:0;">
                        <label style="display:block; font-size:14px; font-weight:700; color:#475569; margin-bottom:8px;">Point de dépose (Arrivée)</label>
                        <div style="position:relative;">
                            <i data-lucide="flag" style="position:absolute; left:16px; top:14px; color:#94a3b8; width:18px; height:18px;"></i>
                            <input type="text" name="point_arrivee" class="input-field" placeholder="Ex: Gare routière" style="width:100%; padding: 13px 16px 13px 48px; border-radius:12px; border:1px solid #cbd5e1; font-size:15px; box-sizing:border-box;">
                        </div>
                    </div>
                </div>

                <div style="display:flex; align-items:center; gap:12px; margin-bottom:24px; padding-bottom:12px; border-bottom:1px solid #f1f5f9;">
                    <div style="width:28px; height:28px; background:#dc2626; color:white; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:14px; flex-shrink:0;">2</div>
                    <h3 style="font-size:18px; font-weight: 800; color:#111827; margin:0;">Date & Heure</h3>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px; margin-bottom:40px;">
                    <div class="input-group" style="margin:0;">
                        <label style="display:block; font-size:14px; font-weight:700; color:#475569; margin-bottom:8px;">Date du trajet *</label>
                        <div style="position:relative;">
                            <i data-lucide="calendar" style="position:absolute; left:16px; top:14px; color:#94a3b8; width:18px; height:18px;"></i>
                            <input type="date" name="date_trajet" class="input-field" required style="width:100%; padding: 13px 16px 13px 48px; border-radius:12px; border:1px solid #cbd5e1; font-size:15px; box-sizing:border-box;">
                        </div>
                    </div>
                    <div class="input-group" style="margin:0;">
                        <label style="display:block; font-size:14px; font-weight:700; color:#475569; margin-bottom:8px;">Heure de départ *</label>
                        <div style="position:relative;">
                            <i data-lucide="clock" style="position:absolute; left:16px; top:14px; color:#94a3b8; width:18px; height:18px;"></i>
                            <input type="time" name="heure_depart" class="input-field" required style="width:100%; padding: 13px 16px 13px 48px; border-radius:12px; border:1px solid #cbd5e1; font-size:15px; box-sizing:border-box;">
                        </div>
                    </div>
                </div>

                <div style="display:flex; align-items:center; gap:12px; margin-bottom:24px; padding-bottom:12px; border-bottom:1px solid #f1f5f9;">
                    <div style="width:28px; height:28px; background:#dc2626; color:white; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:14px; flex-shrink:0;">3</div>
                    <h3 style="font-size:18px; font-weight: 800; color:#111827; margin:0;">Détails & Prix</h3>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px; margin-bottom:24px;">
                    <div class="input-group" style="margin:0;">
                        <label style="display:block; font-size:14px; font-weight:700; color:#475569; margin-bottom:8px;">Nombre de places proposées *</label>
                        <div style="position:relative;">
                            <i data-lucide="users" style="position:absolute; left:16px; top:14px; color:#94a3b8; width:18px; height:18px;"></i>
                            <input type="number" name="places_totales" class="input-field" min="1" max="6" value="3" required style="width:100%; padding: 13px 16px 13px 48px; border-radius:12px; border:1px solid #cbd5e1; font-size:15px; box-sizing:border-box;">
                        </div>
                    </div>
                    <div class="input-group" style="margin:0;">
                        <label style="display:block; font-size:14px; font-weight:700; color:#475569; margin-bottom:8px;">Prix par place (FCFA) *</label>
                        <div style="position:relative;">
                            <i data-lucide="banknote" style="position:absolute; left:16px; top:14px; color:#94a3b8; width:18px; height:18px;"></i>
                            <input type="number" name="prix_par_place" class="input-field" min="500" step="100" placeholder="Ex: 1000" required style="width:100%; padding: 13px 16px 13px 48px; border-radius:12px; border:1px solid #cbd5e1; font-size:15px; box-sizing:border-box;">
                        </div>
                    </div>
                </div>

                <div style="display:flex; gap:24px; margin-bottom:32px; flex-wrap:wrap; background:#f8fafc; padding: 14px 20px; border-radius:14px; border:1px solid #e2e8f0;">
                    <label style="display:flex; align-items:center; gap:8px; cursor:pointer; font-size:14px; font-weight:600; color:#475569; margin:0;">
                        <input type="checkbox" name="climatisation" value="1" style="width:18px; height:18px; accent-color:#dc2626;">
                        <i data-lucide="snowflake" width="16" height="16" style="color:#0ea5e9;"></i> Climatisation
                    </label>
                    <label style="display:flex; align-items:center; gap:8px; cursor:pointer; font-size:14px; font-weight:600; color:#475569; margin:0;">
                        <input type="checkbox" name="musique" value="1" checked style="width:18px; height:18px; accent-color:#dc2626;">
                        <i data-lucide="music" width="16" height="16" style="color:#16a34a;"></i> Musique
                    </label>
                    <label style="display:flex; align-items:center; gap:8px; cursor:pointer; font-size:14px; font-weight:600; color:#475569; margin:0;">
                        <input type="checkbox" name="fumeur" value="1" style="width:18px; height:18px; accent-color:#dc2626;">
                        <i data-lucide="cigarette" width="16" height="16" style="color:#64748b;"></i> Fumeur autorisé
                    </label>
                </div>

                <div class="input-group" style="margin-bottom:40px;">
                    <label style="display:block; font-size:14px; font-weight:700; color:#475569; margin-bottom:8px;">Commentaire pour les passagers (Optionnel)</label>
                    <textarea name="description" class="input-field" style="width:100%; height:120px; padding:16px; border-radius:12px; border:1px solid #cbd5e1; font-size:15px; resize:vertical; box-sizing:border-box;"
                        placeholder="Précisez des informations utiles (bagages acceptés, retards tolérés, point de RDV exact...)"></textarea>
                </div>

                <button type="submit"
                    class="w-full inline-flex items-center justify-center gap-2 py-4 rounded-xl text-base font-semibold text-white transition-all duration-200 shadow-md"
                    style="border:none; cursor:pointer; background: #dc2626; width:100%; font-size:16px;"
                    onmouseover="this.style.background='#b91c1c'; this.style.transform='translateY(-1px)';"
                    onmouseout="this.style.background='#dc2626'; this.style.transform='none';">
                    Publier le trajet <i data-lucide="send" width="18" height="18"></i>
                </button>

            </form>
        </div>
    </div>
</div>

<style>
.vehicule-selected {
    border-color: #dc2626 !important;
    background: #fef2f2 !important;
    box-shadow: 0 0 0 3px rgba(220,38,38,0.15);
}
.vehicule-card:hover {
    border-color: #fca5a5;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.06);
}
.input-field:focus {
    outline: none;
    border-color: #dc2626 !important;
    box-shadow: 0 0 0 3px rgba(220,38,38,0.1) !important;
}
</style>

<script>
  // Initialisation des icônes Lucide
  lucide.createIcons();
</script>