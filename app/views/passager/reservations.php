<div style="max-width: 1100px; margin: 40px auto; padding: 0 20px;">

    <div class="page-header" style="display:flex; justify-content:space-between; align-items:center; gap:20px; margin-bottom:32px;">
        <div class="page-title-group" style="display:flex; align-items:center; gap:16px;">
            <div class="page-title-icon" style="width:56px; height:56px; background:#dc2626; color:white; border-radius:18px; display:flex; align-items:center; justify-content:center;">
                <i data-lucide="ticket" width="24" height="24"></i>
            </div>
            <div>
                <h1 style="font-size:2rem; margin:0;">Mes réservations</h1>
                <p style="margin:4px 0 0; color:#64748b;">Suivez chaque trajet réservé en un clin d’œil.</p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>trajets/recherche" class="btn btn-primary" style="display:inline-flex; align-items:center; gap:8px;"> <i data-lucide="search"></i> Rechercher un trajet</a>
    </div>

    <?php if(empty($reservations)): ?>
        <div class="glass-panel" style="padding: 60px 24px; text-align: center; border: 1px solid #E2E8F0;">
            <div style="font-size: 52px; color: #ef4444; margin-bottom: 24px;">🎫</div>
            <h2 style="font-size: 24px; margin-bottom: 12px;">Aucune réservation pour le moment</h2>
            <p style="color: #64748b; margin-bottom: 16px;">Vous n'avez pas encore réservé de trajet.</p>
            <p style="color: #64748b; margin-bottom: 24px; font-weight: 600;">Trouvez un trajet, réservez votre ticket, puis suivez votre voyage directement depuis ici.</p>
            <a href="<?= BASE_URL ?>trajets/recherche" class="btn btn-outline">Chercher un trajet</a>
        </div>
    <?php else: ?>
        <div style="display: grid; gap: 18px;">
            <?php foreach($reservations as $res): ?>
                <div class="glass-panel" style="padding: 24px; border: 1px solid #E2E8F0; display: grid; grid-template-columns: 2fr 1fr; gap: 20px; align-items: center;">
                    <div>
                        <div style="font-size: 13px; color: #64748b; margin-bottom: 10px; display:flex; gap:8px; align-items:center;">
                            <i data-lucide="calendar" width="14" height="14"></i> <?= date('d/m/Y', strtotime($res->date_trajet)) ?>
                            <span>|</span>
                            <i data-lucide="clock" width="14" height="14"></i> <?= substr($res->heure_depart, 0, 5) ?>
                        </div>
                        <h2 style="margin:0 0 10px; font-size: 22px; color: #0f172a; font-weight:700;"><?= htmlspecialchars($res->ville_depart) ?> → <?= htmlspecialchars($res->ville_arrivee) ?></h2>
                        <p style="margin:0; color:#475569; line-height:1.8;">Conducteur : <strong><?= htmlspecialchars($res->conducteur_prenom . ' ' . $res->conducteur_nom) ?></strong></p>
                    </div>
                    <div style="display:flex; flex-direction:column; align-items:flex-end; gap:12px;">
                        <div style="text-align:right;">
                            <div style="font-size: 18px; font-weight:700; color:#dc2626;"><?= number_format($res->prix_total, 0, ',', ' ') ?> F</div>
                            <div style="font-size: 13px; color:#64748b;"><?= $res->places_reservees ?> place(s)</div>
                        </div>
                        <div>
                            <?php if($res->statut == 'en_attente'): ?>
                                <span class="status-badge status-pending" style="padding:8px 14px;">En attente</span>
                            <?php elseif($res->statut == 'confirmee'): ?>
                                <span class="status-badge status-success" style="padding:8px 14px;">Confirmée</span>
                            <?php elseif($res->statut == 'annulee'): ?>
                                <span class="status-badge status-danger" style="padding:8px 14px;">Annulée</span>
                            <?php elseif($res->statut == 'terminee'): ?>
                                <span class="status-badge" style="padding:8px 14px; background:#f8fafc; color:#475569; border:1px solid #e2e8f0;">Terminée</span>
                            <?php endif; ?>
                        </div>
                        <a href="<?= BASE_URL ?>passager/reservation/<?= $res->id ?>" class="btn btn-primary" style="padding: 12px 18px;">Suivre le trajet</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
