<div style="max-width: 800px; margin: 40px auto; padding: 0 20px;">

    <div class="page-header">
        <div class="page-title-group">
            <div class="page-title-icon">
                <i data-lucide="car" width="28" height="28"></i>
            </div>
            <div>
                <h1>Ajouter mon véhicule</h1>
                <p>Avant de publier un trajet, renseignez les informations de votre véhicule.</p>
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

    <?php if (($retour ?? '') === 'trajet'): ?>
        <div class="alert alert-info" style="margin-bottom: 24px; padding: 16px; border-radius: 12px; background:#DBEAFE; color:#1E40AF;">
            Vous devez d'abord ajouter un véhicule pour pouvoir publier un trajet.
        </div>
    <?php endif; ?>

    <div class="glass-panel">
        <form action="<?= BASE_URL ?>conducteur/vehicule/nouveau" method="POST">
            <input type="hidden" name="retour" value="<?= htmlspecialchars($retour ?? '') ?>">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                <div class="input-group" style="margin:0;">
                    <label>Marque *</label>
                    <input type="text" name="marque" class="input-field" required placeholder="Ex: Toyota">
                </div>
                <div class="input-group" style="margin:0;">
                    <label>Modèle *</label>
                    <input type="text" name="modele" class="input-field" required placeholder="Ex: Corolla">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
                <div class="input-group" style="margin:0;">
                    <label>Couleur *</label>
                    <input type="text" name="couleur" class="input-field" required placeholder="Ex: Blanc">
                </div>
                <div class="input-group" style="margin:0;">
                    <label>Immatriculation *</label>
                    <input type="text" name="immatriculation" class="input-field" required placeholder="Ex: SN-001-AAA">
                </div>
            </div>

            <div class="input-group" style="margin-bottom: 40px;">
                <label>Nombre de places (hors conducteur) *</label>
                <input type="number" name="nombre_places" class="input-field" min="1" max="8" value="4" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; height: 56px; font-size: 16px;">
                Enregistrer mon véhicule <i data-lucide="check"></i>
            </button>
        </form>
    </div>
</div>