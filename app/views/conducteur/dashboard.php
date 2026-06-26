<div style="max-width: 1100px; margin: 40px auto; padding: 0 20px;">
    
    <div class="page-header">
        <div class="page-title-group">
            <div class="page-title-icon">
                <i data-lucide="car" width="28" height="28"></i>
            </div>
            <div>
                <h1>Espace Conducteur</h1>
                <p>Gérez vos trajets proposés et vos réservations passagers.</p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>conducteur/trajets/nouveau" class="btn btn-primary">
            <i data-lucide="plus-circle"></i> Publier un trajet
        </a>
    </div>

    <?php if(isset($_GET['success']) && $_GET['success'] == 'trajet_publie'): ?>
        <div style="background: var(--kd-primary-light); color: var(--kd-primary); padding: 16px 20px; border-radius: var(--radius-sm); margin-bottom: 32px; display: flex; align-items: center; gap: 12px;">
            <i data-lucide="check-circle" width="24" height="24"></i>
            <div>
                <strong>Félicitations !</strong> Votre trajet a bien été publié. Les passagers peuvent maintenant le réserver.
            </div>
        </div>
    <?php endif; ?>

    <!-- Statistiques Conducteur -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-bottom: 40px;">
        <div class="glass-panel" style="padding: 24px; display: flex; align-items: center; gap: 20px;">
            <div style="width: 56px; height: 56px; background: var(--kd-primary-light); color: var(--kd-primary); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                <i data-lucide="map" width="28" height="28"></i>
            </div>
            <div>
                <div style="color: var(--text-muted); font-size: 14px; font-weight: 500;">Trajets actifs</div>
                <div style="font-family: 'Outfit'; font-size: 32px; font-weight: 700; color: var(--text-main); line-height: 1; margin-top: 4px;"><?= $trajets_actifs ?></div>
            </div>
        </div>
        
        <div class="glass-panel" style="padding: 24px; display: flex; align-items: center; gap: 20px;">
            <div style="width: 56px; height: 56px; background: rgba(249, 168, 37, 0.1); color: var(--kd-accent-dark); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                <i data-lucide="bell" width="28" height="28"></i>
            </div>
            <div>
                <div style="color: var(--text-muted); font-size: 14px; font-weight: 500;">Réservations en attente</div>
                <div style="font-family: 'Outfit'; font-size: 32px; font-weight: 700; color: var(--text-main); line-height: 1; margin-top: 4px;"><?= $reservations_attente ?></div>
            </div>
        </div>
        
        <div class="glass-panel" style="padding: 24px; display: flex; align-items: center; gap: 20px;">
            <div style="width: 56px; height: 56px; background: rgba(21, 101, 192, 0.1); color: #1565C0; border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                <i data-lucide="wallet" width="28" height="28"></i>
            </div>
            <div>
                <div style="color: var(--text-muted); font-size: 14px; font-weight: 500;">Gains ce mois</div>
                <div style="font-family: 'Outfit'; font-size: 32px; font-weight: 700; color: var(--kd-primary); line-height: 1; margin-top: 4px;"><?= number_format($gains_mois, 0, ',', ' ') ?> <span style="font-size:20px;">F</span></div>
            </div>
        </div>
    </div>

    <h3 style="font-size: 20px; margin-bottom: 24px; font-family: 'Outfit'; display: flex; align-items: center; gap: 8px;">
        <i data-lucide="calendar-check" width="20" height="20" style="color:var(--text-muted);"></i> Mes trajets planifiés
    </h3>
    
    <div class="glass-panel" style="text-align: center; padding: 60px 20px;">
        <div style="width: 80px; height: 80px; background: var(--kd-bg); color: var(--text-muted); border-radius: 24px; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
            <i data-lucide="car-front" width="40" height="40"></i>
        </div>
        <h3 style="font-size: 24px; margin-bottom: 8px;">Aucun trajet prévu</h3>
        <p style="color: var(--text-muted); margin-bottom: 24px;">Vous n'avez aucun trajet planifié pour le moment.</p>
        <a href="<?= BASE_URL ?>conducteur/trajets/nouveau" class="btn btn-outline">
            <i data-lucide="plus"></i> Publier votre premier trajet
        </a>
    </div>

</div>
