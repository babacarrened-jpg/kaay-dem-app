<div style="max-width: 1100px; margin: 40px auto; padding: 0 20px;">
    <div class="page-header" style="display:flex; justify-content:space-between; align-items:center; gap:20px; margin-bottom:32px;">
        <div class="page-title-group" style="display:flex; align-items:center; gap:16px;">
            <div class="page-title-icon" style="width:56px; height:56px; background:#dc2626; color:white; border-radius:18px; display:flex; align-items:center; justify-content:center;">
                <i data-lucide="car" width="24" height="24"></i>
            </div>
            <div>
                <h1 style="font-size:2rem; margin:0;">Mes trajets</h1>
                <p style="margin:4px 0 0; color:#64748b;">Consultez les trajets que vous avez publiés.</p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>conducteur/trajets/nouveau" class="btn btn-primary" style="display:inline-flex; align-items:center; gap:8px;"> <i data-lucide="plus-circle"></i> Nouveau trajet</a>
    </div>

    <?php if(empty($trajets)): ?>
        <div class="glass-panel" style="padding: 60px 24px; text-align: center; border: 1px solid #E2E8F0;">
            <div style="font-size: 52px; color: #ef4444; margin-bottom: 24px;">🚗</div>
            <h2 style="font-size: 24px; margin-bottom: 12px;">Aucun trajet publié</h2>
            <p style="color: #64748b; margin-bottom: 24px;">Publiez votre premier trajet pour permettre aux passagers de réserver.</p>
            <a href="<?= BASE_URL ?>conducteur/trajets/nouveau" class="btn btn-outline">Publier un trajet</a>
        </div>
    <?php else: ?>
        <div style="display: grid; gap: 18px;">
            <?php foreach($trajets as $trajet): ?>
                <div class="glass-panel" style="padding: 24px; border: 1px solid #E2E8F0;">
                    <div style="display:flex; justify-content:space-between; flex-wrap:wrap; gap:20px; align-items:flex-start;">
                        <div>
                            <h2 style="font-size: 22px; margin-bottom: 8px;"><?= htmlspecialchars($trajet->ville_depart) ?> → <?= htmlspecialchars($trajet->ville_arrivee) ?></h2>
                            <div style="color:#64748b; font-size:14px; margin-bottom:10px; display:flex; gap:12px; flex-wrap:wrap;">
                                <span><strong>Date :</strong> <?= htmlspecialchars($trajet->date_trajet) ?></span>
                                <span><strong>Départ :</strong> <?= substr($trajet->heure_depart, 0, 5) ?></span>
                                <span><strong>Places :</strong> <?= htmlspecialchars($trajet->places_disponibles) ?>/<?= htmlspecialchars($trajet->places_totales) ?></span>
                            </div>
                            <p style="color:#475569; margin:0; line-height:1.7;"><?= nl2br(htmlspecialchars($trajet->description ?: 'Aucune description fournie.')) ?></p>
                        </div>
                        <div style="text-align:right; min-width:180px;">
                            <div style="font-size: 18px; font-weight: 700; color: #dc2626; margin-bottom: 8px;"><?= number_format($trajet->prix_par_place, 0, ',', ' ') ?> F</div>
                            <span class="status-badge status-success" style="padding: 10px 16px; border-radius: 999px; display:inline-flex; align-items:center; gap:6px;">Disponible</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
