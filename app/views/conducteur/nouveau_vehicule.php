<script src="https://unpkg.com/lucide@latest"></script>

<div style="min-height: 100vh; padding: 40px 20px 60px; box-sizing: border-box; background-color: #f7f9fa; background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAxNDAgODAiPjx0ZXh0IHg9IjE1IiB5PSIzMCIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+S0FBWTwvdGV4dD48dGV4dCB4PSIxNSIgeT0iNDUiIGZpbGw9IiNkYzI2MjYiIG9wYWNpdHk9IjAuMDciIGZvbnQtZmFtaWx5PSJzYW5zLXNlcmlmIiBmb250LXdlaWdodD0iOTAwIiBmb250LXNpemU9IjEyIiBsZXR0ZXItc3BhY2luZz0iMC41cHkiPkRFTU08L3RleHQ+PHRleHQgeD0iODUiIHk9IjcwIiBmaWxsPSIjZGMyNjI2IiBvcGFjaXR5PSIwLjA3IiBmb250LWZhbWlseT0ic2Fucy1zZXJpZiIgZm9udC13ZWlnaHQ9IjkwMCIgZm9udC1zaXplPSIxMiIgbGV0dGVyLXNwYWNpbmc9IjAuNXB5Ij5LQUFZPC90ZXh0Pjx0ZXh0IHg9Ijg1IiB5PSI4NSIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+REVNTTwvdGV4dD48L3N2Zz4='); background-repeat: repeat; font-family: system-ui, -apple-system, sans-serif;">

    <div style="max-width: 800px; margin: 0 auto;">

        <div class="page-header" style="display:flex; justify-content:space-between; align-items:center; gap:20px; margin-bottom:32px; padding:24px 28px; border-radius:24px; background:rgba(255,255,255,0.85); border:1px solid rgba(229,231,235,0.7); box-shadow:0 16px 40px rgba(0,0,0,0.04); backdrop-filter:blur(12px); -webkit-backdrop-filter:blur(12px); flex-wrap: wrap;">
            <div class="page-title-group" style="display:flex; align-items:center; gap:16px;">
                <div style="width:56px; height:56px; background:#dc2626; color:white; border-radius:18px; display:flex; align-items:center; justify-content:center; box-shadow: 0 4px 14px rgba(220,38,38,0.2);">
                    <i data-lucide="car" width="28" height="28"></i>
                </div>
                <div>
                    <h1 style="font-size:1.8rem; margin:0; font-weight: 800; color: #111827;">Ajouter mon véhicule</h1>
                    <p style="margin:4px 0 0; color:#64748b; font-weight: 500;">Avant de publier un trajet, renseignez les informations de votre véhicule.</p>
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
            <div style="margin-bottom: 24px; padding: 16px 20px; border-radius: 14px; background:#FEE2E2; color:#991B1B; font-weight: 500; border: 1px solid rgba(153,27,27,0.1); display: flex; align-items: center; gap: 10px;">
                <i data-lucide="alert-circle" width="20" height="20"></i>
                <?= htmlspecialchars($erreur) ?>
            </div>
        <?php endif; ?>

        <?php if (($retour ?? '') === 'trajet'): ?>
            <div style="margin-bottom: 24px; padding: 16px 20px; border-radius: 14px; background:#DBEAFE; color:#1E40AF; font-weight: 500; border: 1px solid rgba(30,64,175,0.1); display: flex; align-items: center; gap: 10px;">
                <i data-lucide="info" width="20" height="20"></i>
                Vous devez d'abord ajouter un véhicule pour pouvoir publier un trajet.
            </div>
        <?php endif; ?>

        <div class="glass-panel" style="padding:36px; background: rgba(255,255,255,0.9); backdrop-filter:blur(10px); -webkit-backdrop-filter:blur(10px); border-radius:24px; border:1px solid rgba(229,231,235,0.6); box-shadow:0 4px 20px rgba(0,0,0,0.01);">
            <form action="<?= BASE_URL ?>conducteur/vehicule/nouveau" method="POST">
                <input type="hidden" name="retour" value="<?= htmlspecialchars($retour ?? '') ?>">

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                    <div class="input-group" style="margin:0;">
                        <label style="display:block; font-size:14px; font-weight:700; color:#475569; margin-bottom:8px;">Marque *</label>
                        <input type="text" name="marque" class="input-field" required placeholder="Ex: Toyota" style="width:100%; padding: 13px 16px; border-radius:12px; border:1px solid #cbd5e1; font-size:15px; box-sizing:border-box;">
                    </div>
                    <div class="input-group" style="margin:0;">
                        <label style="display:block; font-size:14px; font-weight:700; color:#475569; margin-bottom:8px;">Modèle *</label>
                        <input type="text" name="modele" class="input-field" required placeholder="Ex: Corolla" style="width:100%; padding: 13px 16px; border-radius:12px; border:1px solid #cbd5e1; font-size:15px; box-sizing:border-box;">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                    <div class="input-group" style="margin:0;">
                        <label style="display:block; font-size:14px; font-weight:700; color:#475569; margin-bottom:8px;">Couleur *</label>
                        <input type="text" name="couleur" class="input-field" required placeholder="Ex: Blanc" style="width:100%; padding: 13px 16px; border-radius:12px; border:1px solid #cbd5e1; font-size:15px; box-sizing:border-box;">
                    </div>
                    <div class="input-group" style="margin:0;">
                        <label style="display:block; font-size:14px; font-weight:700; color:#475569; margin-bottom:8px;">Immatriculation *</label>
                        <input type="text" name="immatriculation" class="input-field" required placeholder="Ex: SN-001-AAA" style="width:100%; padding: 13px 16px; border-radius:12px; border:1px solid #cbd5e1; font-size:15px; box-sizing:border-box;">
                    </div>
                </div>

                <div class="input-group" style="margin-bottom: 40px;">
                    <label style="display:block; font-size:14px; font-weight:700; color:#475569; margin-bottom:8px;">Nombre de places (hors conducteur) *</label>
                    <input type="number" name="nombre_places" class="input-field" min="1" max="8" value="4" required style="width:100%; padding: 13px 16px; border-radius:12px; border:1px solid #cbd5e1; font-size:15px; box-sizing:border-box;">
                </div>

                <button type="submit" 
                    class="w-full inline-flex items-center justify-center gap-2 py-4 rounded-xl text-base font-semibold text-white transition-all duration-200 shadow-md"
                    style="border:none; cursor:pointer; background: #dc2626; width:100%; height: 56px; font-size:16px;"
                    onmouseover="this.style.background='#b91c1c'; this.style.transform='translateY(-1px)';"
                    onmouseout="this.style.background='#dc2626'; this.style.transform='none';">
                    Enregistrer mon véhicule <i data-lucide="check" width="18" height="18"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<style>
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