<script src="https://unpkg.com/lucide@latest"></script>

<div style="min-height: 100vh; padding: 40px 20px 60px; box-sizing: border-box; background-color: #f7f9fa; background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAxNDAgODAiPjx0ZXh0IHg9IjE1IiB5PSIzMCIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+S0FBWTwvdGV4dD48dGV4dCB4PSIxNSIgeT0iNDUiIGZpbGw9IiNkYzI2MjYiIG9wYWNpdHk9IjAuMDciIGZvbnQtZmFtaWx5PSJzYW5zLXNlcmlmIiBmb250LXdlaWdodD0iOTAwIiBmb250LXNpemU9IjEyIiBsZXR0ZXItc3BhY2luZz0iMC41cHkiPkRFTU08L3RleHQ+PHRleHQgeD0iODUiIHk9IjcwIiBmaWxsPSIjZGMyNjI2IiBvcGFjaXR5PSIwLjA3IiBmb250LWZhbWlseT0ic2Fucy1zZXJpZiIgZm9udC13ZWlnaHQ9IjkwMCIgZm9udC1zaXplPSIxMiIgbGV0dGVyLXNwYWNpbmc9IjAuNXB5Ij5LQUFZPC90ZXh0Pjx0ZXh0IHg9Ijg1IiB5PSI4NSIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+REVNTTwvdGV4dD48L3N2Zz4='); background-repeat: repeat; font-family: system-ui, -apple-system, sans-serif;">

    <div style="max-width: 1100px; margin: 0 auto;">

        <div class="page-header" style="display:flex; justify-content:space-between; align-items:center; gap:20px; margin-bottom:32px; padding:24px 28px; border-radius:24px; background:rgba(255,255,255,0.85); border:1px solid rgba(229,231,235,0.7); box-shadow:0 16px 40px rgba(0,0,0,0.04); backdrop-filter:blur(12px); -webkit-backdrop-filter:blur(12px); flex-wrap: wrap;">
            <div class="page-title-group" style="display:flex; align-items:center; gap:16px;">
                <div class="page-title-icon" style="width:56px; height:56px; background:#dc2626; color:white; border-radius:18px; display:flex; align-items:center; justify-content:center; box-shadow: 0 4px 14px rgba(220,38,38,0.2);">
                    <i data-lucide="car" width="26" height="26"></i>
                </div>
                <div>
                    <h1 style="font-size:1.8rem; margin:0; font-weight: 800; color: #111827;">Mes trajets</h1>
                    <p style="margin:4px 0 0; color:#64748b; font-weight: 500;">Consultez les trajets que vous avez publiés.</p>
                </div>
            </div>
            <a href="<?= BASE_URL ?>conducteur/trajets/nouveau"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold text-white transition-all duration-200 shadow-md"
               style="text-decoration:none; background: #dc2626;"
               onmouseover="this.style.background='#b91c1c';"
               onmouseout="this.style.background='#dc2626';">
                <i data-lucide="plus-circle" width="18" height="18"></i> Nouveau trajet
            </a>
        </div>

        <?php if(isset($_GET['success']) && $_GET['success'] == 'trajet_annule'): ?>
            <div style="background:#DCFCE7; color:#166534; padding:16px 20px; border-radius:14px; margin-bottom:24px; display:flex; align-items:center; gap:12px; font-weight: 500; border: 1px solid rgba(22,101,52,0.1);">
                <i data-lucide="check-circle" width="20" height="20"></i> Le trajet a bien été annulé.
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['success']) && $_GET['success'] == 'trajet_termine'): ?>
            <div style="background:#DCFCE7; color:#166534; padding:16px 20px; border-radius:14px; margin-bottom:24px; display:flex; align-items:center; gap:12px; font-weight: 500; border: 1px solid rgba(22,101,52,0.1);">
                <i data-lucide="check-circle" width="20" height="20"></i> Le trajet a bien été marqué comme terminé.
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['error']) && $_GET['error'] == 'annulation_impossible'): ?>
            <div style="background:#FEE2E2; color:#991B1B; padding:16px 20px; border-radius:14px; margin-bottom:24px; display:flex; align-items:center; gap:12px; font-weight: 500; border: 1px solid rgba(153,27,27,0.1);">
                <i data-lucide="alert-circle" width="20" height="20"></i> Impossible d'annuler : une réservation a déjà été confirmée.
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['error']) && $_GET['error'] == 'cloture_impossible'): ?>
            <div style="background:#FEE2E2; color:#991B1B; padding:16px 20px; border-radius:14px; margin-bottom:24px; display:flex; align-items:center; gap:12px; font-weight: 500; border: 1px solid rgba(153,27,27,0.1);">
                <i data-lucide="alert-circle" width="20" height="20"></i> Impossible de terminer ce trajet.
            </div>
        <?php endif; ?>

        <?php if(empty($trajets)): ?>
            <div class="glass-panel" style="padding:80px 24px; text-align:center; background: rgba(255,255,255,0.85); backdrop-filter:blur(14px); -webkit-backdrop-filter:blur(14px); border-radius:24px; border:1px solid rgba(229,231,235,0.6); box-shadow:0 10px 30px rgba(0,0,0,0.02);">
                <div style="font-size:52px; margin-bottom:20px;">🚗</div>
                <h2 style="font-size:24px; margin-bottom:10px; font-weight: 800; color: #111827;">Aucun trajet publié</h2>
                <p style="color:#64748b; margin-bottom:28px; font-size:15px;">Publiez votre premier trajet pour permettre aux passagers de réserver.</p>
                <a href="<?= BASE_URL ?>conducteur/trajets/nouveau"
                   class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold text-white transition-all duration-200 shadow-md"
                   style="text-decoration:none; background: #dc2626;"
                   onmouseover="this.style.background='#b91c1c';"
                   onmouseout="this.style.background='#dc2626';">
                    <i data-lucide="plus-circle" width="16" height="16"></i> Publier un trajet
                </a>
            </div>
        <?php else: ?>
            <?php
            $statutLabels = [
                'planifie' => ['label' => 'Planifié', 'bg' => '#DCFCE7', 'color' => '#166534'],
                'en_cours' => ['label' => 'En cours', 'bg' => '#DBEAFE', 'color' => '#1E40AF'],
                'termine'  => ['label' => 'Terminé',  'bg' => '#E2E8F0', 'color' => '#475569'],
                'annule'   => ['label' => 'Annulé',   'bg' => '#FEE2E2', 'color' => '#991B1B'],
            ];
            ?>
            <div style="display:grid; gap:18px;">
                <?php foreach($trajets as $trajet): ?>
                    <?php $statutInfo = $statutLabels[$trajet->statut] ?? ['label' => ucfirst($trajet->statut), 'bg' => '#E2E8F0', 'color' => '#475569']; ?>
                    
                    <div class="glass-panel" style="padding:28px; background: rgba(255,255,255,0.9); backdrop-filter:blur(10px); -webkit-backdrop-filter:blur(10px); border-radius:24px; border:1px solid rgba(229,231,235,0.6); box-shadow:0 4px 20px rgba(0,0,0,0.01);">
                        <div style="display:flex; justify-content:space-between; flex-wrap:wrap; gap:24px; align-items:flex-start;">

                            <div style="flex:1; min-width: 280px;">
                                <h2 style="font-size:22px; margin:0 0 10px; font-weight:800; color:#111827;"><?= htmlspecialchars($trajet->ville_depart) ?> → <?= htmlspecialchars($trajet->ville_arrivee) ?></h2>
                                <div style="color:#64748b; font-size:13px; margin-bottom:14px; display:flex; gap:16px; flex-wrap:wrap; font-weight:500;">
                                    <span style="display:inline-flex; align-items:center; gap:5px;"><i data-lucide="calendar" width="14" height="14"></i> <strong>Date :</strong> <?= date('d/m/Y', strtotime($trajet->date_trajet)) ?></span>
                                    <span style="display:inline-flex; align-items:center; gap:5px;"><i data-lucide="clock" width="14" height="14"></i> <strong>Départ :</strong> <?= substr($trajet->heure_depart, 0, 5) ?></span>
                                    <span style="display:inline-flex; align-items:center; gap:5px;"><i data-lucide="users" width="14" height="14"></i> <strong>Places :</strong> <?= htmlspecialchars($trajet->places_disponibles) ?>/<?= htmlspecialchars($trajet->places_totales) ?></span>
                                </div>
                                <p style="color:#475569; margin:0; line-height:1.6; font-size:15px; background: #f8fafc; padding: 14px 18px; border-radius: 14px; border: 1px solid #f1f5f9;"><?= nl2br(htmlspecialchars($trajet->description ?: 'Aucune description fournie.')) ?></p>
                            </div>

                            <div style="min-width:220px; display:flex; flex-direction:column; gap:10px; align-items:flex-end; flex-shrink:0;">
                                <div style="font-size:24px; font-weight:800; color:#dc2626;"><?= number_format($trajet->prix_par_place, 0, ',', ' ') ?> F <span style="font-size:12px; color:#94a3b8; font-weight:normal;">/ place</span></div>
                                <span style="padding:6px 14px; border-radius:999px; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:0.04em; margin-bottom:6px; background:<?= $statutInfo['bg'] ?>; color:<?= $statutInfo['color'] ?>;">
                                    <?= $statutInfo['label'] ?>
                                </span>

                                <a href="<?= BASE_URL ?>conducteur/trajet/<?= $trajet->id ?>/passagers"
                                   class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold border border-slate-200 text-slate-700 bg-white hover:bg-slate-50 transition-all duration-200 shadow-sm"
                                   style="text-decoration:none; width:100%; box-sizing:border-box;">
                                    <i data-lucide="users" width="15" height="15"></i>
                                    Voir les passagers
                                </a>

                                <?php if(in_array($trajet->statut, ['planifie', 'en_cours'], true)): ?>

                                    <form action="<?= BASE_URL ?>conducteur/trajet/<?= $trajet->id ?>/terminer" method="POST"
                                          onsubmit="return confirm('Marquer ce trajet comme terminé ?');" style="width:100%;">
                                        <button type="submit"
                                            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold text-white transition-all duration-200 shadow-sm"
                                            style="background:#16a34a; border:none; cursor:pointer; width:100%;"
                                            onmouseover="this.style.background='#15803d';"
                                            onmouseout="this.style.background='#16a34a';">
                                            <i data-lucide="check-circle" width="15" height="15"></i>
                                            Terminer le trajet
                                        </button>
                                    </form>

                                    <form action="<?= BASE_URL ?>conducteur/trajet/<?= $trajet->id ?>/annuler" method="POST"
                                          onsubmit="return confirm('Annuler ce trajet ? Cette action est irréversible.');" style="width:100%;">
                                        <button type="submit"
                                            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold text-white transition-all duration-200 shadow-sm"
                                            style="background:#dc2626; border:none; cursor:pointer; width:100%;"
                                            onmouseover="this.style.background='#b91c1c';"
                                            onmouseout="this.style.background='#dc2626';">
                                            <i data-lucide="x-circle" width="15" height="15"></i>
                                            Annuler ce trajet
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
</div>

<script>
  // Initialisation des icônes Lucide
  lucide.createIcons();
</script>