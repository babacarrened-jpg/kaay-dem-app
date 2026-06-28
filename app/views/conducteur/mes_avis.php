<div style="max-width: 900px; margin: 40px auto; padding: 0 20px;">

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:32px;">
        <div style="display:flex; align-items:center; gap:16px;">
            <div style="width:56px; height:56px; background:#dc2626; color:white; border-radius:18px; display:flex; align-items:center; justify-content:center;">
                <i data-lucide="star" width="28" height="28"></i>
            </div>
            <div>
                <h1 style="font-size:2rem; margin:0;">Mes avis</h1>
                <p style="margin:4px 0 0; color:#64748b;">Ce que les passagers pensent de vous.</p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>conducteur/dashboard"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold border border-slate-200 text-slate-700 hover:bg-slate-50 transition-all duration-200"
           style="text-decoration:none;">
            <i data-lucide="arrow-left" width="16" height="16"></i> Dashboard
        </a>
    </div>

    <!-- Note moyenne -->
    <div class="glass-panel" style="padding:28px; margin-bottom:32px; display:flex; align-items:center; gap:32px;">
        <div style="text-align:center;">
            <div style="font-size:56px; font-weight:800; color:#dc2626; line-height:1;">
                <?= number_format($moyenne, 1) ?>
            </div>
            <div style="font-size:24px; color:#f59e0b; margin:4px 0;">
                <?php for($i = 1; $i <= 5; $i++): ?>
                    <?= $i <= round($moyenne) ? '★' : '☆' ?>
                <?php endfor; ?>
            </div>
            <div style="color:#64748b; font-size:13px;"><?= count($avis) ?> avis</div>
        </div>
        <div style="flex:1; display:flex; flex-direction:column; gap:6px;">
            <?php for($i = 5; $i >= 1; $i--): ?>
                <?php
                $count = count(array_filter($avis, fn($a) => (int)$a->note === $i));
                $pct   = count($avis) > 0 ? ($count / count($avis)) * 100 : 0;
                ?>
                <div style="display:flex; align-items:center; gap:10px;">
                    <span style="font-size:13px; color:#64748b; width:12px;"><?= $i ?></span>
                    <span style="color:#f59e0b; font-size:14px;">★</span>
                    <div style="flex:1; height:8px; background:#E2E8F0; border-radius:999px; overflow:hidden;">
                        <div style="height:100%; background:#f59e0b; border-radius:999px; width:<?= $pct ?>%;"></div>
                    </div>
                    <span style="font-size:13px; color:#64748b; width:20px;"><?= $count ?></span>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <!-- Liste des avis -->
    <?php if(empty($avis)): ?>
        <div class="glass-panel" style="padding:60px 24px; text-align:center;">
            <div style="font-size:52px; margin-bottom:16px;">⭐</div>
            <h2 style="font-size:22px; margin-bottom:8px;">Aucun avis pour le moment</h2>
            <p style="color:#64748b;">Les avis apparaîtront ici après vos trajets terminés.</p>
        </div>
    <?php else: ?>
        <div style="display:grid; gap:16px;">
            <?php foreach($avis as $a): ?>
                <div class="glass-panel" style="padding:20px;">
                    <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:10px;">
                        <div style="display:flex; align-items:center; gap:12px;">
                            <div style="width:40px; height:40px; background:#dc2626; color:white; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:16px;">
                                <?= strtoupper(substr($a->auteur_prenom, 0, 1)) ?>
                            </div>
                            <div>
                                <div style="font-weight:700;"><?= htmlspecialchars($a->auteur_prenom . ' ' . $a->auteur_nom) ?></div>
                                <div style="font-size:12px; color:#94a3b8;"><?= date('d/m/Y', strtotime($a->date_creation)) ?></div>
                            </div>
                        </div>
                        <div style="font-size:20px; color:#f59e0b;">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <?= $i <= (int)$a->note ? '★' : '☆' ?>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <?php if(!empty($a->commentaire)): ?>
                        <p style="margin:0; color:#475569; line-height:1.7; font-style:italic;">
                            "<?= htmlspecialchars($a->commentaire) ?>"
                        </p>
                    <?php else: ?>
                        <p style="margin:0; color:#94a3b8; font-size:13px;">Aucun commentaire.</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>