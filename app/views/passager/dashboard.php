<div style="max-width: 1100px; margin: 40px auto; padding: 0 20px;">
    
    <div class="page-header">
        <div class="page-title-group">
            <div class="page-title-icon">
                <i data-lucide="ticket" width="28" height="28"></i>
            </div>
            <div>
                <h1>Mon Espace Passager</h1>
                <p>Gérez vos réservations et préparez vos voyages.</p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>trajets/recherche" class="btn btn-primary">
            <i data-lucide="search"></i> Nouveau trajet
        </a>
    </div>

    <?php if(isset($_GET['success']) && $_GET['success'] == 'reservation_ok'): ?>
        <div style="background: var(--kd-primary-light); color: var(--kd-primary); padding: 16px 20px; border-radius: var(--radius-sm); margin-bottom: 32px; display: flex; align-items: center; gap: 12px;">
            <i data-lucide="check-circle" width="24" height="24"></i>
            <div>
                <strong>Super !</strong> Votre demande de réservation a bien été envoyée au conducteur. Vous pouvez suivre son statut ci-dessous.
            </div>
        </div>
    <?php endif; ?>

    <h3 style="font-size: 20px; margin-bottom: 24px; font-family: 'Outfit'; display: flex; align-items: center; gap: 8px;">
        <i data-lucide="list" width="20" height="20" style="color:var(--text-muted);"></i> Mes Réservations (<?= count($reservations) ?>)
    </h3>

    <?php if(empty($reservations)): ?>
        <div class="glass-panel" style="text-align: center; padding: 60px 20px;">
            <div style="width: 80px; height: 80px; background: var(--kd-bg); color: var(--text-muted); border-radius: 24px; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
                <i data-lucide="ticket" width="40" height="40"></i>
            </div>
            <h3 style="font-size: 24px; margin-bottom: 8px;">Aucune réservation</h3>
            <p style="color: var(--text-muted); margin-bottom: 24px;">Vous n'avez pas encore réservé de trajet.</p>
            <a href="<?= BASE_URL ?>trajets/recherche" class="btn btn-outline">Rechercher maintenant</a>
        </div>
    <?php else: ?>
        <div style="display: flex; flex-direction: column; gap: 16px;">
            <?php foreach($reservations as $res): ?>
                <div class="glass-panel" style="padding: 24px; display: flex; justify-content: space-between; align-items: center; position: relative; overflow: hidden;">
                    
                    <!-- Ligne colorée au hover -->
                    <div style="position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background: var(--kd-primary); transform: scaleY(0); transform-origin: top; transition: var(--transition);" class="card-hover-bar"></div>

                    <div style="flex: 2;">
                        <div style="font-weight: 600; font-size: 13px; color: var(--text-muted); margin-bottom: 8px; display:flex; align-items:center; gap:6px;">
                            <i data-lucide="calendar" width="14" height="14"></i> <?= date('d/m/Y', strtotime($res->date_trajet)) ?> 
                            <span style="color:#CBD5E1;">|</span>
                            <i data-lucide="clock" width="14" height="14"></i> <?= substr($res->heure_depart, 0, 5) ?>
                        </div>
                        <div style="font-family: 'Outfit'; font-weight: 600; font-size: 20px; margin-bottom: 8px; color: var(--text-main); display:flex; align-items:center; gap:12px;">
                            <?= htmlspecialchars($res->ville_depart) ?> 
                            <i data-lucide="arrow-right" width="18" height="18" style="color:var(--text-muted);"></i>
                            <?= htmlspecialchars($res->ville_arrivee) ?>
                        </div>
                        <div style="font-size: 14px; color: var(--text-muted); display:flex; align-items:center; gap:6px;">
                            <i data-lucide="user" width="14" height="14"></i> Conduit par <strong><?= htmlspecialchars($res->conducteur_prenom . ' ' . $res->conducteur_nom) ?></strong>
                        </div>
                    </div>

                    <div style="flex: 1; text-align: center; border-left: 1px solid #E2E8F0; border-right: 1px solid #E2E8F0; padding: 0 20px;">
                        <div style="font-family: 'Outfit'; font-weight: 700; font-size: 24px; color: var(--kd-primary); margin-bottom: 4px;">
                            <?= number_format($res->prix_total, 0, ',', ' ') ?> F
                        </div>
                        <div style="font-size: 13px; color: var(--text-muted); display:flex; align-items:center; justify-content:center; gap:4px;">
                            <i data-lucide="users" width="14" height="14"></i> <?= $res->places_reservees ?> place(s)
                        </div>
                    </div>

                    <div style="flex: 1; text-align: right;">
                        <?php if($res->statut == 'en_attente'): ?>
                            <span class="status-badge status-pending"><i data-lucide="loader" width="14" height="14"></i> En attente</span>
                        <?php elseif($res->statut == 'confirmee'): ?>
                            <span class="status-badge status-success"><i data-lucide="check" width="14" height="14"></i> Confirmée</span>
                        <?php elseif($res->statut == 'annulee'): ?>
                            <span class="status-badge status-danger"><i data-lucide="x" width="14" height="14"></i> Annulée</span>
                        <?php elseif($res->statut == 'terminee'): ?>
                            <span class="status-badge" style="background:var(--kd-bg); color:var(--text-muted); border:1px solid #E2E8F0;"><i data-lucide="flag" width="14" height="14"></i> Terminée</span>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
.glass-panel:hover .card-hover-bar { transform: scaleY(1); }
</style>
