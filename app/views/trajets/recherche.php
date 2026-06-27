<div style="max-width: 800px; margin: 60px auto; padding: 0 20px;">
    
    <div class="page-header">
        <div class="page-title-group">
            <div class="page-title-icon">
                <i data-lucide="search" width="28" height="28"></i>
            </div>
            <div>
                <h1>Trouver un trajet</h1>
                <p>Définissez vos critères pour voyager sereinement.</p>
            </div>
        </div>
    </div>

    <div class="glass-panel">
        <form action="<?= BASE_URL ?>trajets/resultats" method="GET">
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                <div class="input-group" style="margin:0;">
                    <label>Ville de départ</label>
                    <div style="position:relative;">
                        <i data-lucide="map-pin" style="position:absolute; left:16px; top:14px; color:var(--text-muted); width:20px; height:20px;"></i>
                        <input type="text" name="depart" class="input-field" placeholder="Ex: Dakar, Rufisque..." style="padding-left:48px;">
                    </div>
                </div>
                <div class="input-group" style="margin:0;">
                    <label>Ville d'arrivée</label>
                    <div style="position:relative;">
                        <i data-lucide="map-pin" style="position:absolute; left:16px; top:14px; color:var(--text-muted); width:20px; height:20px;"></i>
                        <input type="text" name="arrivee" class="input-field" placeholder="Ex: Diamniadio..." style="padding-left:48px;">
                    </div>
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                <div class="input-group" style="margin:0;">
                    <label>Prix min (FCFA)</label>
                    <div style="position:relative;">
                        <i data-lucide="tag" style="position:absolute; left:16px; top:14px; color:var(--text-muted); width:20px; height:20px;"></i>
                        <input type="number" name="prix_min" class="input-field" placeholder="0" style="padding-left:48px;">
                    </div>
                </div>
                <div class="input-group" style="margin:0;">
                    <label>Prix max (FCFA)</label>
                    <div style="position:relative;">
                        <i data-lucide="tag" style="position:absolute; left:16px; top:14px; color:var(--text-muted); width:20px; height:20px;"></i>
                        <input type="number" name="prix_max" class="input-field" placeholder="3000" style="padding-left:48px;">
                    </div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 32px;">
                <div class="input-group" style="margin:0;">
                    <label>Places disponibles min</label>
                    <div style="position:relative;">
                        <i data-lucide="users" style="position:absolute; left:16px; top:14px; color:var(--text-muted); width:20px; height:20px;"></i>
                        <input type="number" name="places_min" class="input-field" min="1" placeholder="1" style="padding-left:48px;">
                    </div>
                </div>
                <div class="input-group" style="margin:0;">
                    <label>Places disponibles max</label>
                    <div style="position:relative;">
                        <i data-lucide="users" style="position:absolute; left:16px; top:14px; color:var(--text-muted); width:20px; height:20px;"></i>
                        <input type="number" name="places_max" class="input-field" min="1" placeholder="5" style="padding-left:48px;">
                    </div>
                </div>
            </div>

            <div class="input-group" style="margin-bottom: 32px;">
                <label>Date du trajet</label>
                <div style="position:relative;">
                    <i data-lucide="calendar" style="position:absolute; left:16px; top:14px; color:var(--text-muted); width:20px; height:20px;"></i>
                    <input type="date" name="date" class="input-field" style="padding-left:48px;">
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; height: 52px; font-size: 16px;">
                <i data-lucide="search"></i> Lancer la recherche
            </button>
        </form>
    </div>
</div>
