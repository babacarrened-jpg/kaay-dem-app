<script src="https://unpkg.com/lucide@latest"></script>

<div style="min-height: 100vh; padding: 40px 20px 60px; box-sizing: border-box; background-color: #f7f9fa; background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAxNDAgODAiPjx0ZXh0IHg9IjE1IiB5PSIzMCIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+S0FBWTwvdGV4dD48dGV4dCB4PSIxNSIgeT0iNDUiIGZpbGw9IiNkYzI2MjYiIG9wYWNpdHk9IjAuMDciIGZvbnQtZmFtaWx5PSJzYW5zLXNlcmlmIiBmb250LXdlaWdodD0iOTAwIiBmb250LXNpemU9IjEyIiBsZXR0ZXItc3BhY2luZz0iMC41cHkiPkRFTU08L3RleHQ+PHRleHQgeD0iODUiIHk9IjcwIiBmaWxsPSIjZGMyNjI2IiBvcGFjaXR5PSIwLjA3IiBmb250LWZhbWlseT0ic2Fucy1zZXJpZiIgZm9udC13ZWlnaHQ9IjkwMCIgZm9udC1zaXplPSIxMiIgbGV0dGVyLXNwYWNpbmc9IjAuNXB5Ij5LQUFZPC90ZXh0Pjx0ZXh0IHg9Ijg1IiB5PSI4NSIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+REVNTTwvdGV4dD48L3N2Zz4='); background-repeat: repeat; font-family: system-ui, -apple-system, sans-serif;">

    <div style="max-width: 900px; margin: 0 auto;">

        <div style="display:flex; justify-content:space-between; align-items:center; gap:20px; margin-bottom:32px; padding:24px 28px; border-radius:24px; background:rgba(255,255,255,0.85); border:1px solid rgba(229,231,235,0.7); box-shadow:0 16px 40px rgba(0,0,0,0.04); backdrop-filter:blur(12px); -webkit-backdrop-filter:blur(12px);">
            <div style="display:flex; align-items:center; gap:16px;">
                <div style="width:56px; height:56px; background:#dc2626; color:white; border-radius:18px; display:flex; align-items:center; justify-content:center; box-shadow: 0 4px 14px rgba(220,38,38,0.2);">
                    <i data-lucide="star" width="28" height="28"></i>
                </div>
                <div>
                    <h1 style="font-size:2rem; margin:0; font-weight: 800; color:#111827;">Mes avis</h1>
                    <p style="margin:4px 0 0; color:#64748b;">Ce que les passagers pensent de vous.</p>
                </div>
            </div>
            <a href="<?= BASE_URL ?>conducteur/dashboard"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold border border-slate-200 text-slate-700 bg-white hover:bg-slate-50 transition-all duration-200 shadow-sm"
               style="text-decoration:none; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="arrow-left" width="16" height="16"></i> Dashboard
            </a>
        </div>

        <div class="glass-panel" style="padding:28px; margin-bottom:32px; display:flex; align-items:center; gap:32px; background: rgba(255,255,255,0.85); backdrop-filter:blur(14px); -webkit-backdrop-filter:blur(14px); border-radius:24px; border:1px solid rgba(229,231,235,0.6); box-shadow:0 10px 30px rgba(0,0,0,0.02);">
            <div style="text-align:center; padding-right: 16px; border-right: 1px solid #e5e7eb;">
                <div style="font-size:56px; font-weight:800; color:#dc2626; line-height:1;">
                    <?= number_format($moyenne, 1) ?>
                </div>
                <div style="font-size:24px; color:#f59e0b; margin:6px 0;">
                    <?php for($i = 1; $i <= 5; $i++): ?>
                        <?= $i <= round($moyenne) ? '★' : '☆' ?>
                    <?php endfor; ?>
                </div>
                <div style="color:#64748b; font-size:13px; font-weight: 600;"><?= count($avis) ?> avis</div>
            </div>
            <div style="flex:1; display:flex; flex-direction:column; gap:6px;">
                <?php for($i = 5; $i >= 1; $i--): ?>
                    <?php
                    $count = count(array_filter($avis, fn($a) => (int)$a->note === $i));
                    $pct   = count($avis) > 0 ? ($count / count($avis)) * 100 : 0;
                    ?>
                    <div style="display:flex; align-items:center; gap:10px;">
                        <span style="font-size:13px; color:#64748b; width:12px; font-weight:600;"><?= $i ?></span>
                        <span style="color:#f59e0b; font-size:14px;">★</span>
                        <div style="flex:1; height:8px; background:#E2E8F0; border-radius:999px; overflow:hidden;">
                            <div style="height:100%; background:#f59e0b; border-radius:999px; width:<?= $pct ?>%;"></div>
                        </div>
                        <span style="font-size:13px; color:#64748b; width:20px; text-align:right;"><?= $count ?></span>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <?php if(empty($avis)): ?>
            <div class="glass-panel" style="padding:80px 24px; text-align:center; background: rgba(255,255,255,0.85); backdrop-filter:blur(14px); -webkit-backdrop-filter:blur(14px); border-radius:24px; border:1px solid rgba(229,231,235,0.6); box-shadow:0 10px 30px rgba(0,0,0,0.02);">
                <div style="font-size:52px; margin-bottom:16px;">⭐</div>
                <h2 style="font-size:22px; margin-bottom:8px; font-weight: 800; color: #111827;">Aucun avis pour le moment</h2>
                <p style="color:#64748b; margin:0;">Les avis apparaîtront ici après vos trajets terminés.</p>
            </div>
        <?php else: ?>
            <div style="display:grid; gap:16px;">
                <?php foreach($avis as $a): ?>
                    <div class="glass-panel" style="padding:24px; background: rgba(255,255,255,0.9); backdrop-filter:blur(10px); -webkit-backdrop-filter:blur(10px); border-radius:20px; border:1px solid rgba(229,231,235,0.6); box-shadow:0 4px 20px rgba(0,0,0,0.01);">
                        <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:14px;">
                            <div style="display:flex; align-items:center; gap:12px;">
                                <div style="width:42px; height:42px; background:#dc2626; color:white; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:800; font-size:16px; box-shadow: 0 2px 8px rgba(220,38,38,0.15);">
                                    <?= strtoupper(substr($a->auteur_prenom, 0, 1)) ?>
                                </div>
                                <div>
                                    <div style="font-weight:800; color: #111827;"><?= htmlspecialchars($a->auteur_prenom . ' ' . $a->auteur_nom) ?></div>
                                    <div style="font-size:12px; color:#94a3b8; font-weight: 500; margin-top: 2px;"><?= date('d/m/Y', strtotime($a->date_creation)) ?></div>
                                </div>
                            </div>
                            <div style="font-size:18px; color:#f59e0b; letter-spacing: -1px;">
                                <?php for($i = 1; $i <= 5; $i++): ?>
                                    <?= $i <= (int)$a->note ? '★' : '☆' ?>
                                <?php endfor; ?>
                            </div>
                        </div>
                        
                        <?php if(!empty($a->commentaire)): ?>
                            <p style="margin:0; color:#374151; line-height:1.6; font-size:15px; font-style:italic; background: #f8fafc; padding: 14px 18px; border-radius: 14px; border: 1px solid #f1f5f9;">
                                "<?= htmlspecialchars($a->commentaire) ?>"
                            </p>
                        <?php else: ?>
                            <p style="margin:0; color:#94a3b8; font-size:13px; font-style: italic;">Aucun commentaire laissé.</p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</div>

<script>
  // Initialisation des icônes Lucide
  lucide.createIcons();
</script>