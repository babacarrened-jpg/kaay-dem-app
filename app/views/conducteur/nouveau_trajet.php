<div style="max-width: 800px; margin: 40px auto; padding: 0 20px;">
    
    <div class="page-header">
        <div class="page-title-group">
            <div class="page-title-icon">
                <i data-lucide="map-pin" width="28" height="28"></i>
            </div>
            <div>
                <h1>Publier un trajet</h1>
                <p>Proposez vos places libres et partagez les frais de route.</p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>conducteur/dashboard" class="btn btn-outline">
            <i data-lucide="arrow-left"></i> Retour
        </a>
    </div>

    <?php if (!empty($erreur)): ?>
        <div class="alert alert-danger" style="margin-bottom: 24px; padding: 16px; border-radius: 12px; background:#FEE2E2; color:#991B1B;">
            <?= htmlspecialchars($erreur) ?>
        </div>
    <?php endif; ?>

    <div class="glass-panel">
        <form action="<?= BASE_URL ?>conducteur/trajets/nouveau" method="POST">
            
            <div style="display:flex; align-items:center; gap:12px; margin-bottom: 24px; padding-bottom: 12px; border-bottom: 1px solid #E2E8F0;">
                <div style="width: 32px; height: 32px; background: var(--kd-primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700;">1</div>
                <h3 style="font-family: 'Outfit'; font-size: 20px; margin:0;">L'itinéraire</h3>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                <div class="input-group" style="margin:0;">
                    <label>Ville de départ *</label>
                    <div style="position:relative;">
                        <i data-lucide="map-pin" style="position:absolute; left:16px; top:14px; color:var(--text-muted); width:20px; height:20px;"></i>
                        <input type="text" name="ville_depart" class="input-field" required placeholder="Ex: Dakar" style="padding-left:48px;">
                    </div>
                </div>
                <div class="input-group" style="margin:0;">
                    <label>Ville d'arrivée *</label>
                    <div style="position:relative;">
                        <i data-lucide="map-pin" style="position:absolute; left:16px; top:14px; color:var(--text-muted); width:20px; height:20px;"></i>
                        <input type="text" name="ville_arrivee" class="input-field" required placeholder="Ex: Diamniadio" style="padding-left:48px;">
                    </div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 40px;">
                <div class="input-group" style="margin:0;">
                    <label>Point de RDV précis (Départ)</label>
                    <div style="position:relative;">
                        <i data-lucide="navigation" style="position:absolute; left:16px; top:14px; color:var(--text-muted); width:20px; height:20px;"></i>
                        <input type="text" name="point_depart" class="input-field" placeholder="Ex: Rond-point Colobane" style="padding-left:48px;">
                    </div>
                </div>
                <div class="input-group" style="margin:0;">
                    <label>Point de dépose (Arrivée)</label>
                    <div style="position:relative;">
                        <i data-lucide="flag" style="position:absolute; left:16px; top:14px; color:var(--text-muted); width:20px; height:20px;"></i>
                        <input type="text" name="point_arrivee" class="input-field" placeholder="Ex: Sphères ministérielles" style="padding-left:48px;">
                    </div>
                </div>
            </div>

            <div style="display:flex; align-items:center; gap:12px; margin-bottom: 24px; padding-bottom: 12px; border-bottom: 1px solid #E2E8F0;">
                <div style="width: 32px; height: 32px; background: var(--kd-primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700;">2</div>
                <h3 style="font-family: 'Outfit'; font-size: 20px; margin:0;">Date & Heure</h3>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 40px;">
                <div class="input-group" style="margin:0;">
                    <label>Date du trajet *</label>
                    <div style="position:relative;">
                        <i data-lucide="calendar" style="position:absolute; left:16px; top:14px; color:var(--text-muted); width:20px; height:20px;"></i>
                        <input type="date" name="date_trajet" class="input-field" required style="padding-left:48px;">
                    </div>
                </div>
                <div class="input-group" style="margin:0;">
                    <label>Heure de départ *</label>
                    <div style="position:relative;">
                        <i data-lucide="clock" style="position:absolute; left:16px; top:14px; color:var(--text-muted); width:20px; height:20px;"></i>
                        <input type="time" name="heure_depart" class="input-field" required style="padding-left:48px;">
                    </div>
                </div>
            </div>

            <div style="display:flex; align-items:center; gap:12px; margin-bottom: 24px; padding-bottom: 12px; border-bottom: 1px solid #E2E8F0;">
                <div style="width: 32px; height: 32px; background: var(--kd-primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700;">3</div>
                <h3 style="font-family: 'Outfit'; font-size: 20px; margin:0;">Détails & Prix</h3>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                <div class="input-group" style="margin:0;">
                    <label>Nombre de places proposées *</label>
                    <div style="position:relative;">
                        <i data-lucide="users" style="position:absolute; left:16px; top:14px; color:var(--text-muted); width:20px; height:20px;"></i>
                        <input type="number" name="places_totales" class="input-field" min="1" max="6" value="3" required style="padding-left:48px;">
                    </div>
                </div>
                <div class="input-group" style="margin:0;">
                    <label>Prix par place (FCFA) *</label>
                    <div style="position:relative;">
                        <i data-lucide="banknote" style="position:absolute; left:16px; top:14px; color:var(--text-muted); width:20px; height:20px;"></i>
                        <input type="number" name="prix_par_place" class="input-field" min="500" step="100" placeholder="Ex: 1000" required style="padding-left:48px;">
                    </div>
                </div>
            </div>

            <div class="input-group" style="margin-bottom: 40px;">
                <label>Commentaire pour les passagers (Optionnel)</label>
                <textarea name="description" class="input-field" style="height: 120px; padding: 16px; resize: vertical;" placeholder="Précisez des informations utiles (bagages acceptés, retards tolérés, point de RDV exact...)"></textarea>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; height: 56px; font-size: 16px;">
                Publier le trajet <i data-lucide="send"></i>
            </button>
        </form>
    </div>
</div>