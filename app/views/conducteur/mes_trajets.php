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

    <?php if(isset($_GET['success']) && $_GET['success'] == 'trajet_annule'): ?>
        <div style="background:#DCFCE7; color:#166534; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
            <i data-lucide="check-circle" width="20" height="20"></i> Le trajet a bien été annulé.
        </div>
    <?php endif; ?>

    <?php if(isset($_GET['error']) && $_GET['error'] == 'annulation_impossible'): ?>
        <div style="background:#FEE2E2; color:#991B1B; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px;">
            <i data-lucide="alert-circle" width="20" height="20"></i> Impossible d'annuler ce trajet : une réservation a déjà été confirmée.
        </div>
    <?php endif; ?>

    <?php if(empty($trajets)): ?>
        <div class="glass-panel" style="padding: 60px 24px; text-align: center; border: 1px solid #E2E8F0;">
            <div style="font-size: 52px; color: #ef4444; margin-bottom: 24px;">🚗</div>
            <h2 style="font-size: 24px; margin-bottom: 12px;">Aucun trajet publié</h2>
            <p style="color: #64748b; margin-bottom: 24px;">Publiez votre premier trajet pour permettre aux passagers de réserver.</p>
            <a href="<?= BASE_URL ?>conducteur/trajets/nouveau" class="btn btn-outline">Publier un trajet</a>
        </div>
    <?php else: ?>
        <?php
        $statutLabels = [
            'planifie' => ['label' => 'Planifié', 'class' => 'status-success', 'bg' => '#DCFCE7', 'color' => '#166534'],
            'en_cours' => ['label' => 'En cours', 'class' => 'status-info', 'bg' => '#DBEAFE', 'color' => '#1E40AF'],
            'termine' => ['label' => 'Terminé', 'class' => 'status-secondary', 'bg' => '#E2E8F0', 'color' => '#475569'],
            'annule' => ['label' => 'Annulé', 'class' => 'status-danger', 'bg' => '#FEE2E2', 'color' => '#991B1B'],
        ];
        ?>
        <div style="display: grid; gap: 18px;">
            <?php foreach($trajets as $trajet): ?>
                <?php $statutInfo = $statutLabels[$trajet->statut] ?? ['label' => ucfirst($trajet->statut), 'bg' => '#E2E8F0', 'color' => '#475569']; ?>
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
                            <span style="padding: 8px 16px; border-radius: 999px; display:inline-flex; align-items:center; gap:6px; font-size:13px; font-weight:600; background:<?= $statutInfo['bg'] ?>; color:<?= $statutInfo['color'] ?>; margin-bottom: 12px;"><?= $statutInfo['label'] ?></span>

                            <a href="<?= BASE_URL ?>conducteur/trajet/<?= $trajet->id ?>/passagers" class="btn btn-outline" style="width:100%; justify-content:center; font-size:13px; padding:8px 12px; margin-bottom: 8px; text-decoration:none;">
                                <i data-lucide="users" width="14" height="14"></i> Voir les passagers
                            </a>

                            <?php if(in_array($trajet->statut, ['planifie', 'en_cours'], true)): ?>
                                <form action="<?= BASE_URL ?>conducteur/trajet/<?= $trajet->id ?>/annuler" method="POST" onsubmit="return confirm('Annuler ce trajet ? Cette action est irréversible.');">
                                    <button type="submit" class="btn btn-outline" style="width:100%; justify-content:center; font-size:13px; padding:8px 12px;">
                                        <i data-lucide="x-circle" width="14" height="14"></i> Annuler
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>