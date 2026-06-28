<div style="max-width: 1000px; margin: 40px auto; padding: 0 20px;">

    <div class="page-header" style="display:flex; justify-content:space-between; align-items:center; gap:20px; margin-bottom:32px; flex-wrap: wrap;">
        <div class="page-title-group" style="display:flex; align-items:center; gap:16px;">
            <div class="page-title-icon" style="width:56px; height:56px; background:#dc2626; color:white; border-radius:18px; display:flex; align-items:center; justify-content:center;">
                <i data-lucide="users" width="24" height="24"></i>
            </div>
            <div>
                <h1 style="font-size:1.8rem; margin:0;">Passagers du trajet</h1>
                <p style="margin:4px 0 0; color:#64748b;">
                    <?= htmlspecialchars($trajet->ville_depart) ?> → <?= htmlspecialchars($trajet->ville_arrivee) ?>
                    · <?= date('d/m/Y', strtotime($trajet->date_trajet)) ?> à <?= substr($trajet->heure_depart, 0, 5) ?>
                </p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>conducteur/trajets" class="btn btn-outline">
            <i data-lucide="arrow-left"></i> Retour à mes trajets
        </a>
    </div>

    <?php if (empty($passagers)): ?>
        <div class="glass-panel" style="padding: 60px 24px; text-align: center; border: 1px solid #E2E8F0;">
            <div style="font-size: 52px; margin-bottom: 24px;">🧍</div>
            <h2 style="font-size: 22px; margin-bottom: 12px;">Aucun passager pour le moment</h2>
            <p style="color: #64748b; margin: 0;">Personne n'a encore réservé ce trajet.</p>
        </div>
    <?php else: ?>
        <?php
        $statutLabels = [
            'en_attente' => ['label' => 'En attente', 'bg' => '#FEF3C7', 'color' => '#92400E'],
            'confirmee' => ['label' => 'Confirmée', 'bg' => '#DCFCE7', 'color' => '#166534'],
            'terminee' => ['label' => 'Terminée', 'bg' => '#E2E8F0', 'color' => '#475569'],
            'annulee' => ['label' => 'Annulée', 'bg' => '#FEE2E2', 'color' => '#991B1B'],
            'refusee' => ['label' => 'Refusée', 'bg' => '#FEE2E2', 'color' => '#991B1B'],
        ];
        ?>
        <div style="display: grid; gap: 16px;">
            <?php foreach ($passagers as $passager): ?>
                <?php $statutInfo = $statutLabels[$passager->reservation_statut] ?? ['label' => ucfirst($passager->reservation_statut), 'bg' => '#E2E8F0', 'color' => '#475569']; ?>
                <div class="glass-panel" style="padding: 20px 24px; border: 1px solid #E2E8F0; display:flex; justify-content:space-between; align-items:center; gap: 20px; flex-wrap: wrap;">
                    <div style="display:flex; align-items:center; gap:16px;">
                        <div style="width:48px; height:48px; border-radius:50%; background:#FEE2E2; color:#dc2626; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:18px;">
                            <?= htmlspecialchars(strtoupper(substr($passager->prenom, 0, 1))) ?>
                        </div>
                        <div>
                            <div style="font-weight:700; font-size:16px;"><?= htmlspecialchars($passager->prenom . ' ' . $passager->nom) ?></div>
                            <div style="color:#64748b; font-size:13px; display:flex; gap:14px; flex-wrap:wrap; margin-top:2px;">
                                <span><i data-lucide="phone" width="13" height="13" style="vertical-align:middle;"></i> <?= htmlspecialchars($passager->telephone) ?></span>
                                <span><i data-lucide="mail" width="13" height="13" style="vertical-align:middle;"></i> <?= htmlspecialchars($passager->email) ?></span>
                            </div>
                        </div>
                    </div>
                    <div style="text-align:right;">
                        <span style="padding: 6px 14px; border-radius: 999px; display:inline-block; font-size:13px; font-weight:600; background:<?= $statutInfo['bg'] ?>; color:<?= $statutInfo['color'] ?>; margin-bottom: 6px;"><?= $statutInfo['label'] ?></span>
                        <div style="font-size:13px; color:#64748b;"><?= $passager->places_reservees ?> place<?= $passager->places_reservees > 1 ? 's' : '' ?> · <?= number_format($passager->prix_total, 0, ',', ' ') ?> F</div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>