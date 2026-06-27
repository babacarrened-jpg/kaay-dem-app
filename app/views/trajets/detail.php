<div style="max-width: 1100px; margin: 40px auto; padding: 0 20px; display: grid; grid-template-columns: 2fr 1fr; gap: 32px;">
    <!-- Colonne Principale -->
    <div>
        <div class="glass-panel" style="margin-bottom: 24px; position: relative; overflow: hidden;">
            <div style="position: absolute; top: 0; left: 0; bottom: 0; width: 6px; background: var(--kd-primary);"></div>
            
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px; color: var(--text-muted); font-size: 14px; font-weight: 500;">
                <i data-lucide="calendar" width="18" height="18"></i> <?= date('l d F Y', strtotime($trajet->date_trajet)) ?>
                <span style="color:#CBD5E1;">|</span>
                <i data-lucide="clock" width="18" height="18"></i> <?= substr($trajet->heure_depart, 0, 5) ?>
            </div>

            <h1 style="font-size: 32px; margin-bottom: 32px; display: flex; align-items: center; gap: 16px;">
                <?= htmlspecialchars($trajet->ville_depart) ?> 
                <div style="width: 40px; height: 40px; background: var(--kd-primary-light); color: var(--kd-primary); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="arrow-right" width="20" height="20"></i>
                </div>
                <?= htmlspecialchars($trajet->ville_arrivee) ?>
            </h1>

            <?php if(!empty($message)): ?>
                <div style="margin-bottom: 24px; padding: 18px 22px; border-radius: 20px; border: 1px solid <?= $alertType === 'danger' ? '#fecaca' : ($alertType === 'warning' ? '#fde68a' : '#d1fae5') ?>; background: <?= $alertType === 'danger' ? 'rgba(254, 202, 202, 0.2)' : ($alertType === 'warning' ? 'rgba(253, 230, 138, 0.2)' : 'rgba(220, 252, 231, 0.2)') ?>; color: <?= $alertType === 'danger' ? '#991b1b' : ($alertType === 'warning' ? '#92400e' : '#166534') ?>;">
                    <div style="display:flex; align-items:center; gap:12px; font-weight:600;">
                        <i data-lucide="info" width="18" height="18"></i>
                        <?= htmlspecialchars($message) ?>
                    </div>
                </div>
            <?php endif; ?>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; padding: 24px; background: var(--kd-bg); border-radius: var(--radius-md); border: 1px solid #E2E8F0; margin-bottom: 32px;">
                <div>
                    <div style="font-size: 13px; color: var(--text-muted); margin-bottom: 6px; display: flex; align-items: center; gap: 6px;">
                        <i data-lucide="map-pin" width="14" height="14"></i> Point de départ
                    </div>
                    <div style="font-weight: 600; color: var(--text-main);"><?= htmlspecialchars($trajet->point_depart ?: 'À définir avec le conducteur') ?></div>
                </div>
                <div>
                    <div style="font-size: 13px; color: var(--text-muted); margin-bottom: 6px; display: flex; align-items: center; gap: 6px;">
                        <i data-lucide="flag" width="14" height="14"></i> Point d'arrivée
                    </div>
                    <div style="font-weight: 600; color: var(--text-main);"><?= htmlspecialchars($trajet->point_arrivee ?: 'À définir avec le conducteur') ?></div>
                </div>
            </div>

            <h3 style="font-size: 20px; margin-bottom: 16px; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="info" width="20" height="20" style="color:var(--kd-primary);"></i> À propos du trajet
            </h3>
            <p style="color: var(--text-muted); margin-bottom: 24px; line-height: 1.7;"><?= nl2br(htmlspecialchars($trajet->description ?: 'Aucune description spécifique fournie par le conducteur.')) ?></p>

            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <?php if($trajet->climatisation): ?>
                    <span class="status-badge status-success"><i data-lucide="snowflake" width="14" height="14"></i> Climatisation</span>
                <?php endif; ?>
                <?php if($trajet->musique): ?>
                    <span class="status-badge status-success"><i data-lucide="music" width="14" height="14"></i> Musique</span>
                <?php endif; ?>
                <?php if($trajet->fumeur): ?>
                    <span class="status-badge status-pending"><i data-lucide="cigarette" width="14" height="14"></i> Fumeur toléré</span>
                <?php else: ?>
                    <span class="status-badge status-success"><i data-lucide="cigarette-off" width="14" height="14"></i> Non fumeur</span>
                <?php endif; ?>
            </div>
        </div>

        <div class="glass-panel">
            <h3 style="font-size: 20px; margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="user" width="20" height="20" style="color:var(--kd-primary);"></i> Le Conducteur
            </h3>
            <div style="display: flex; align-items: center; gap: 24px;">
                <div class="user-avatar" style="width: 80px; height: 80px; font-size: 28px;">
                    <?= substr($trajet->conducteur_prenom, 0, 1) ?>
                </div>
                <div>
                    <h4 style="font-size: 20px; margin-bottom: 6px;"><?= htmlspecialchars($trajet->conducteur_prenom . ' ' . $trajet->conducteur_nom) ?></h4>
                    <div style="color: var(--text-muted); font-size: 14px; margin-bottom: 12px; display:flex; align-items:center; gap:6px;">
                        <i data-lucide="star" width="14" height="14" style="color:var(--kd-accent-dark); fill:var(--kd-accent-dark);"></i> 4.8/5 - 12 avis
                    </div>
                    <div style="font-size: 14px; color: var(--text-main); font-weight: 500; display:flex; align-items:center; gap:8px;">
                        <div style="background: var(--kd-bg); padding: 6px 12px; border-radius: 6px; border: 1px solid #E2E8F0;">
                            <i data-lucide="car" width="14" height="14" style="display:inline; margin-right:4px; color:var(--text-muted);"></i>
                            <?= htmlspecialchars($trajet->marque . ' ' . $trajet->modele) ?> (<?= htmlspecialchars($trajet->couleur) ?>)
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Colonne Sidebar (Réservation) -->
    <div>
        <div class="glass-panel" style="position: sticky; top: 100px;">
            <div style="text-align: center; margin-bottom: 24px;">
                <div style="font-size: 14px; color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Prix par place</div>
                <div style="font-family: 'Outfit'; font-size: 48px; font-weight: 700; color: var(--kd-primary); line-height: 1;">
                    <?= number_format($trajet->prix_par_place, 0, ',', ' ') ?> <span style="font-size:24px;">F</span>
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px 0; border-top: 1px solid #E2E8F0; border-bottom: 1px solid #E2E8F0; margin-bottom: 32px;">
                <span style="font-weight: 600; color: var(--text-main); display:flex; align-items:center; gap:8px;">
                    <i data-lucide="users" width="18" height="18" style="color:var(--text-muted);"></i> Places restantes
                </span>
                <span style="background: var(--kd-primary-light); color: var(--kd-primary); padding: 6px 16px; border-radius: 50px; font-weight: 700; font-size: 18px;">
                    <?= $trajet->places_disponibles ?> / <?= $trajet->places_totales ?>
                </span>
            </div>

            <?php if(isset($_SESSION['user_id'])): ?>
                <?php if($_SESSION['user_id'] == $trajet->conducteur_id): ?>
                    <button class="btn btn-outline" style="width: 100%; height: 52px;" disabled>
                        <i data-lucide="lock"></i> C'est votre trajet
                    </button>
                <?php else: ?>
                    <div style="background: #fef2f2; border: 1px solid #fecaca; border-radius: 16px; padding: 14px 16px; margin-bottom: 14px; color: #991b1b; font-size: 14px; font-weight: 600;">
                        <i data-lucide="info" width="16" height="16" style="display:inline; margin-right:6px;"></i>
                        Réservez immédiatement votre place en un clic.
                    </div>
                    <a href="<?= BASE_URL ?>index.php?url=passager/reserver/<?= $trajet->id ?>" style="display: inline-flex; align-items: center; justify-content: center; width: 100%; height: 56px; font-size: 16px; font-weight: 800; border: 0; border-radius: 999px; background: linear-gradient(135deg, #dc2626, #b91c1c); color: white; box-shadow: 0 10px 24px rgba(220, 38, 38, 0.25); text-decoration: none; cursor: pointer;">
                        Réserver maintenant <i data-lucide="check-circle" style="margin-left: 10px;"></i>
                    </a>
                <?php endif; ?>
            <?php else: ?>
                <a href="<?= BASE_URL ?>auth/connexion" style="display: flex; align-items: center; justify-content: center; width: 100%; height: 56px; font-size: 16px; font-weight: 800; border: 0; border-radius: 999px; background: linear-gradient(135deg, #dc2626, #b91c1c); color: white; box-shadow: 0 10px 24px rgba(220, 38, 38, 0.25); text-decoration: none;">
                    Se connecter pour réserver
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
