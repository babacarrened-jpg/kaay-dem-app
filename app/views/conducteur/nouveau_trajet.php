<div style="max-width: 800px; margin: 40px auto; padding: 0 20px;">

    <div class="page-header" style="display:flex; justify-content:space-between; align-items:center; gap:20px; margin-bottom:32px;">
        <div class="page-title-group" style="display:flex; align-items:center; gap:16px;">
            <div style="width:56px; height:56px; background:#dc2626; color:white; border-radius:18px; display:flex; align-items:center; justify-content:center;">
                <i data-lucide="map-pin" width="28" height="28"></i>
            </div>
            <div>
                <h1 style="font-size:2rem; margin:0;">Publier un trajet</h1>
                <p style="margin:4px 0 0; color:#64748b;">Proposez vos places libres et partagez les frais de route.</p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>conducteur/dashboard"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold border border-slate-200 text-slate-700 hover:bg-slate-50 transition-all duration-200"
           style="text-decoration:none;">
            <i data-lucide="arrow-left" width="16" height="16"></i> Retour
        </a>
    </div>

    <?php if (!empty($erreur)): ?>
        <div style="padding:16px 20px; border-radius:12px; background:#FEE2E2; color:#991B1B; margin-bottom:24px;">
            <?= htmlspecialchars($erreur) ?>
        </div>
    <?php endif; ?>

    <div class="glass-panel" style="padding:32px;">
        <form action="<?= BASE_URL ?>conducteur/trajets/nouveau" method="POST">

            <!-- ===== ÉTAPE 0 : Choix du véhicule (si plusieurs) ===== -->
            <?php if(count($vehicules) > 1): ?>
            <div style="display:flex; align-items:center; gap:12px; margin-bottom:24px; padding-bottom:12px; border-bottom:1px solid #E2E8F0;">
                <div style="width:32px; height:32px; background:#dc2626; color:white; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700; flex-shrink:0;">0</div>
                <h3 style="font-family:'Outfit'; font-size:20px; margin:0;">Choisir votre véhicule</h3>
            </div>
            <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:16px; margin-bottom:40px;">
                <?php foreach($vehicules as $i => $v): ?>
                    <label style="cursor:pointer;">
                        <input type="radio" name="vehicule_id" value="<?= $v->id ?>"
                               <?= $i === 0 ? 'checked' : '' ?>
                               style="display:none;"
                               onchange="document.querySelectorAll('.vehicule-card').forEach(c => c.classList.remove('vehicule-selected')); this.closest('.vehicule-card').classList.add('vehicule-selected');">
                        <div class="vehicule-card <?= $i === 0 ? 'vehicule-selected' : '' ?>"
                             style="padding:16px; border-radius:14px; border:2px solid #E2E8F0; transition:all 0.2s; background:white;">
                            <div style="font-size:28px; margin-bottom:8px;">🚗</div>
                            <div style="font-weight:700; font-size:16px;"><?= htmlspecialchars($v->marque . ' ' . $v->modele) ?></div>
                            <div style="color:#64748b; font-size:13px; margin-top:4px;"><?= htmlspecialchars($v->couleur) ?> · <?= htmlspecialchars($v->immatriculation) ?></div>
                            <div style="color:#64748b; font-size:13px;"><?= $v->nombre_places ?> places</div>
                        </div>
                    </label>
                <?php endforeach; ?>
                <!-- Ajouter un véhicule -->
                <a href="<?= BASE_URL ?>conducteur/vehicule/nouveau?retour=trajet"
                   style="padding:16px; border-radius:14px; border:2px dashed #cbd5e1; display:flex; flex-direction:column; align-items:center; justify-content:center; gap:8px; text-decoration:none; color:#64748b; transition:all 0.2s; min-height:110px;"
                   onmouseover="this.style.borderColor='#dc2626'; this.style.color='#dc2626';"
                   onmouseout="this.style.borderColor='#cbd5e1'; this.style.color='#64748b';">
                    <i data-lucide="plus-circle" width="24" height="24"></i>
                    <span style="font-size:13px; font-weight:600;">Ajouter un véhicule</span>
                </a>
            </div>
            <?php else: ?>
                <!-- Un seul véhicule → caché, sélectionné automatiquement -->
                <input type="hidden" name="vehicule_id" value="<?= $vehicules[0]->id ?>">
                <div style="background:#f8fafc; border:1px solid #E2E8F0; border-radius:12px; padding:14px 18px; margin-bottom:32px; display:flex; align-items:center; gap:12px;">
                    <span style="font-size:22px;">🚗</span>
                    <div>
                        <div style="font-weight:700;"><?= htmlspecialchars($vehicules[0]->marque . ' ' . $vehicules[0]->modele) ?></div>
                        <div style="font-size:13px; color:#64748b;"><?= htmlspecialchars($vehicules[0]->couleur) ?> · <?= htmlspecialchars($vehicules[0]->immatriculation) ?> · <?= $vehicules[0]->nombre_places ?> places</div>
                    </div>
                    <a href="<?= BASE_URL ?>conducteur/vehicule/nouveau?retour=trajet"
                       style="margin-left:auto; font-size:13px; color:#dc2626; text-decoration:none; font-weight:600;">
                        + Ajouter un véhicule
                    </a>
                </div>
            <?php endif; ?>

            <!-- ===== ÉTAPE 1 : Itinéraire ===== -->
            <div style="display:flex; align-items:center; gap:12px; margin-bottom:24px; padding-bottom:12px; border-bottom:1px solid #E2E8F0;">
                <div style="width:32px; height:32px; background:#dc2626; color:white; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700; flex-shrink:0;">1</div>
                <h3 style="font-family:'Outfit'; font-size:20px; margin:0;">L'itinéraire</h3>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px; margin-bottom:24px;">
                <div class="input-group" style="margin:0;">
                    <label>Ville de départ *</label>
                    <div style="position:relative;">
                        <i data-lucide="map-pin" style="position:absolute; left:16px; top:14px; color:#94a3b8; width:20px; height:20px;"></i>
                        <select name="ville_depart" class="input-field" required style="padding-left:48px; appearance:none;">
                            <option value="">Choisir une ville</option>
                            <option value="Dakar">Dakar</option>
                            <option value="Rufisque">Rufisque</option>
                            <option value="Diamniadio">Diamniadio</option>
                        </select>
                    </div>
                </div>
                <div class="input-group" style="margin:0;">
                    <label>Ville d'arrivée *</label>
                    <div style="position:relative;">
                        <i data-lucide="map-pin" style="position:absolute; left:16px; top:14px; color:#94a3b8; width:20px; height:20px;"></i>
                        <select name="ville_arrivee" class="input-field" required style="padding-left:48px; appearance:none;">
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
                    <label>Point de RDV précis (Départ)</label>
                    <div style="position:relative;">
                        <i data-lucide="navigation" style="position:absolute; left:16px; top:14px; color:#94a3b8; width:20px; height:20px;"></i>
                        <input type="text" name="point_depart" class="input-field" placeholder="Ex: Rond-point Colobane" style="padding-left:48px;">
                    </div>
                </div>
                <div class="input-group" style="margin:0;">
                    <label>Point de dépose (Arrivée)</label>
                    <div style="position:relative;">
                        <i data-lucide="flag" style="position:absolute; left:16px; top:14px; color:#94a3b8; width:20px; height:20px;"></i>
                        <input type="text" name="point_arrivee" class="input-field" placeholder="Ex: Gare routière" style="padding-left:48px;">
                    </div>
                </div>
            </div>

            <!-- ===== ÉTAPE 2 : Date & Heure ===== -->
            <div style="display:flex; align-items:center; gap:12px; margin-bottom:24px; padding-bottom:12px; border-bottom:1px solid #E2E8F0;">
                <div style="width:32px; height:32px; background:#dc2626; color:white; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700; flex-shrink:0;">2</div>
                <h3 style="font-family:'Outfit'; font-size:20px; margin:0;">Date & Heure</h3>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px; margin-bottom:40px;">
                <div class="input-group" style="margin:0;">
                    <label>Date du trajet *</label>
                    <div style="position:relative;">
                        <i data-lucide="calendar" style="position:absolute; left:16px; top:14px; color:#94a3b8; width:20px; height:20px;"></i>
                        <input type="date" name="date_trajet" class="input-field" required style="padding-left:48px;">
                    </div>
                </div>
                <div class="input-group" style="margin:0;">
                    <label>Heure de départ *</label>
                    <div style="position:relative;">
                        <i data-lucide="clock" style="position:absolute; left:16px; top:14px; color:#94a3b8; width:20px; height:20px;"></i>
                        <input type="time" name="heure_depart" class="input-field" required style="padding-left:48px;">
                    </div>
                </div>
            </div>

            <!-- ===== ÉTAPE 3 : Détails & Prix ===== -->
            <div style="display:flex; align-items:center; gap:12px; margin-bottom:24px; padding-bottom:12px; border-bottom:1px solid #E2E8F0;">
                <div style="width:32px; height:32px; background:#dc2626; color:white; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700; flex-shrink:0;">3</div>
                <h3 style="font-family:'Outfit'; font-size:20px; margin:0;">Détails & Prix</h3>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px; margin-bottom:24px;">
                <div class="input-group" style="margin:0;">
                    <label>Nombre de places proposées *</label>
                    <div style="position:relative;">
                        <i data-lucide="users" style="position:absolute; left:16px; top:14px; color:#94a3b8; width:20px; height:20px;"></i>
                        <input type="number" name="places_totales" class="input-field" min="1" max="6" value="3" required style="padding-left:48px;">
                    </div>
                </div>
                <div class="input-group" style="margin:0;">
                    <label>Prix par place (FCFA) *</label>
                    <div style="position:relative;">
                        <i data-lucide="banknote" style="position:absolute; left:16px; top:14px; color:#94a3b8; width:20px; height:20px;"></i>
                        <input type="number" name="prix_par_place" class="input-field" min="500" step="100" placeholder="Ex: 1000" required style="padding-left:48px;">
                    </div>
                </div>
            </div>

            <div style="display:flex; gap:24px; margin-bottom:32px; flex-wrap:wrap;">
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer; font-size:14px;">
                    <input type="checkbox" name="climatisation" value="1" style="width:18px; height:18px; accent-color:#dc2626;">
                    <i data-lucide="snowflake" width="16" height="16"></i> Climatisation
                </label>
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer; font-size:14px;">
                    <input type="checkbox" name="musique" value="1" checked style="width:18px; height:18px; accent-color:#dc2626;">
                    <i data-lucide="music" width="16" height="16"></i> Musique
                </label>
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer; font-size:14px;">
                    <input type="checkbox" name="fumeur" value="1" style="width:18px; height:18px; accent-color:#dc2626;">
                    <i data-lucide="cigarette" width="16" height="16"></i> Fumeur autorisé
                </label>
            </div>

            <div class="input-group" style="margin-bottom:40px;">
                <label>Commentaire pour les passagers (Optionnel)</label>
                <textarea name="description" class="input-field" style="height:120px; padding:16px; resize:vertical;"
                    placeholder="Précisez des informations utiles (bagages acceptés, retards tolérés, point de RDV exact...)"></textarea>
            </div>

            <button type="submit"
                class="w-full inline-flex items-center justify-center gap-2 py-4 rounded-xl text-base font-semibold text-white bg-brand-600 hover:bg-brand-700 hover:-translate-y-0.5 transition-all duration-200 shadow-md hover:shadow-lg"
                style="border:none; cursor:pointer;">
                Publier le trajet <i data-lucide="send" width="18" height="18"></i>
            </button>

        </form>
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
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}
</style>