<?php
// trajetsDejaNote est calculé et fourni par le contrôleur (PassagerController::reservations())
$trajetsDejaNote = $trajetsDejaNote ?? [];
?>

<script src="https://unpkg.com/lucide@latest"></script>

<div style="min-height: 100vh; padding: 40px 20px 60px; box-sizing: border-box; background-color: #f7f9fa; background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAxNDAgODAiPjx0ZXh0IHg9IjE1IiB5PSIzMCIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+S0FBWTwvdGV4dD48dGV4dCB4PSIxNSIgeT0iNDUiIGZpbGw9IiNkYzI2MjYiIG9wYWNpdHk9IjAuMDciIGZvbnQtZmFtaWx5PSJzYW5zLXNlcmlmIiBmb250LXdlaWdodD0iOTAwIiBmb250LXNpemU9IjEyIiBsZXR0ZXItc3BhY2luZz0iMC41cHkiPkRFTU08L3RleHQ+PHRleHQgeD0iODUiIHk9IjcwIiBmaWxsPSIjZGMyNjI2IiBvcGFjaXR5PSIwLjA3IiBmb250LWZhbWlseT0ic2Fucy1zZXJpZiIgZm9udC13ZWlnaHQ9IjkwMCIgZm9udC1zaXplPSIxMiIgbGV0dGVyLXNwYWNpbmc9IjAuNXB5Ij5LQUFZPC90ZXh0Pjx0ZXh0IHg9Ijg1IiB5PSI4NSIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+REVNTTwvdGV4dD48L3N2Zz4='); background-repeat: repeat; font-family: system-ui, -apple-system, sans-serif;">

    <div style="max-width: 1100px; margin: 0 auto;">

        <div class="page-header" style="display:flex; justify-content:space-between; align-items:center; gap:20px; margin-bottom:32px; padding:24px 28px; border-radius:24px; background:rgba(255,255,255,0.85); border:1px solid rgba(229,231,235,0.7); box-shadow:0 16px 40px rgba(0,0,0,0.04); backdrop-filter:blur(12px); -webkit-backdrop-filter:blur(12px); flex-wrap: wrap;">
            <div class="page-title-group" style="display:flex; align-items:center; gap:16px;">
                <div style="width:56px; height:56px; background:#dc2626; color:white; border-radius:18px; display:flex; align-items:center; justify-content:center; box-shadow: 0 4px 14px rgba(220,38,38,0.2);">
                    <i data-lucide="ticket" width="26" height="26"></i>
                </div>
                <div>
                    <h1 style="font-size:1.8rem; margin:0; font-weight: 800; color: #111827;">Mes réservations</h1>
                    <p style="margin:4px 0 0; color:#64748b; font-weight: 500;">Suivez chaque trajet réservé en un clin d'œil.</p>
                </div>
            </div>
            <a href="<?= BASE_URL ?>trajets/recherche"
               style="text-decoration:none; display: inline-flex; align-items: center; gap: 8px; padding: 12px 22px; border-radius: 12px; font-size: 14px; font-weight: 700; color: white; background: #dc2626; transition: all 0.2s; box-shadow: 0 4px 12px rgba(220,38,38,0.15);"
               onmouseover="this.style.background='#b91c1c'; this.style.transform='translateY(-1px)';"
               onmouseout="this.style.background='#dc2626'; this.style.transform='none';">
                <i data-lucide="search" width="16" height="16"></i> Rechercher un trajet
            </a>
        </div>

        <?php if(isset($_GET['success']) && $_GET['success'] == 'avis_envoye'): ?>
            <div style="background:#DCFCE7; color:#166534; padding:16px 20px; border-radius:14px; margin-bottom:24px; display:flex; align-items:center; gap:12px; font-weight: 600; border: 1px solid rgba(22,101,52,0.1);">
                <i data-lucide="check-circle" width="20" height="20" style="color:#16a34a;"></i> Merci ! Votre avis a bien été envoyé.
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['error']) && $_GET['error'] == 'deja_note'): ?>
            <div style="background:#FEF3C7; color:#92400E; padding:16px 20px; border-radius:14px; margin-bottom:24px; display:flex; align-items:center; gap:12px; font-weight: 600; border: 1px solid rgba(146,64,14,0.1);">
                <i data-lucide="alert-circle" width="20" height="20" style="color:#d97706;"></i> Vous avez déjà laissé un avis pour ce trajet.
            </div>
        <?php endif; ?>

        <?php if(empty($reservations)): ?>
            <div class="glass-panel" style="padding: 80px 24px; text-align: center; background: rgba(255,255,255,0.85); backdrop-filter:blur(14px); -webkit-backdrop-filter:blur(14px); border-radius:24px; border:1px solid rgba(229,231,235,0.6); box-shadow:0 10px 30px rgba(0,0,0,0.02);">
                <div style="font-size: 52px; color: #dc2626; margin-bottom: 20px;">🎫</div>
                <h2 style="font-size: 24px; margin-bottom: 10px; font-weight: 800; color: #111827;">Aucune réservation pour le moment</h2>
                <p style="color: #64748b; margin-bottom: 28px; font-size: 15px; font-weight: 500;">Vous n'avez pas encore réservé de trajet.</p>
                <a href="<?= BASE_URL ?>trajets/recherche"
                   style="text-decoration:none; display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; border-radius: 12px; font-size: 14px; font-weight: 700; color: white; background: #dc2626; transition: all 0.2s;"
                   onmouseover="this.style.background='#b91c1c';"
                   onmouseout="this.style.background='#dc2626';">
                    Chercher un trajet
                </a>
            </div>
        <?php else: ?>
            <div style="display:grid; gap:18px;">
                <?php foreach($reservations as $res): ?>
                    <div class="glass-panel" style="padding: 24px; background: rgba(255,255,255,0.9); backdrop-filter:blur(10px); -webkit-backdrop-filter:blur(10px); border-radius:24px; border:1px solid rgba(229,231,235,0.6); box-shadow:0 4px 20px rgba(0,0,0,0.01); display:grid; grid-template-columns:2fr 1fr; gap:20px; align-items:center; flex-wrap: wrap;">
                        
                        <div>
                            <div style="font-size:13px; color:#64748b; margin-bottom:8px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; background: #f1f5f9; padding: 4px 10px; border-radius: 6px; flex-wrap: wrap;">
                                <span style="display:inline-flex; align-items:center; gap:4px;"><i data-lucide="calendar" width="14" height="14"></i> Le <?= date('d/m/Y', strtotime($res->date_trajet)) ?></span>
                                <span style="color:#cbd5e1;">•</span>
                                <span style="display:inline-flex; align-items:center; gap:4px;"><i data-lucide="clock" width="14" height="14"></i> à <?= substr($res->heure_depart, 0, 5) ?></span>
                            </div>
                            <h2 style="margin:6px 0 10px; font-size:22px; font-weight:800; color:#111827;"><?= htmlspecialchars($res->ville_depart) ?> → <?= htmlspecialchars($res->ville_arrivee) ?></h2>
                            <div style="color:#475569; font-size: 15px; display: flex; align-items: center; gap: 6px;">
                                <i data-lucide="user" width="16" height="16" style="color: #64748b;"></i> Conducteur : <strong style="color: #111827;"><?= htmlspecialchars($res->conducteur_prenom . ' ' . $res->conducteur_nom) ?></strong>
                            </div>
                        </div>

                        <div style="display:flex; flex-direction:column; align-items:flex-end; gap:12px; justify-content: center;">
                            <div style="text-align:right;">
                                <div style="font-size:22px; font-weight:800; color:#dc2626;"><?= number_format($res->prix_total, 0, ',', ' ') ?> F</div>
                                <div style="color:#475569; font-size:13px; font-weight: 700; background: #f1f5f9; padding: 2px 8px; border-radius: 6px; display: inline-block; margin-top: 2px;"><?= $res->places_reservees ?> place<?= $res->places_reservees > 1 ? 's' : '' ?></div>
                            </div>

                            <?php if($res->statut == 'en_attente'): ?>
                                <span style="padding: 6px 14px; border-radius: 999px; font-size:11px; font-weight:700; text-transform: uppercase; letter-spacing: 0.04em; background:#FEF3C7; color:#92400E;">En attente</span>
                            <?php elseif($res->statut == 'confirmee'): ?>
                                <span style="padding: 6px 14px; border-radius: 999px; font-size:11px; font-weight:700; text-transform: uppercase; letter-spacing: 0.04em; background:#DCFCE7; color:#166534;">Confirmée</span>
                            <?php elseif($res->statut == 'annulee'): ?>
                                <span style="padding: 6px 14px; border-radius: 999px; font-size:11px; font-weight:700; text-transform: uppercase; letter-spacing: 0.04em; background:#FEE2E2; color:#991B1B;">Annulée</span>
                            <?php elseif($res->statut == 'terminee'): ?>
                                <span style="padding: 6px 14px; border-radius: 999px; font-size:11px; font-weight:700; text-transform: uppercase; letter-spacing: 0.04em; background:#e2e8f0; color:#475569;">Terminée</span>
                            <?php endif; ?>

                            <div style="display:flex; gap:8px; flex-wrap:wrap; justify-content:flex-end; width: 100%;">
                                <a href="<?= BASE_URL ?>passager/reservation/<?= $res->id ?>"
                                   style="text-decoration:none; display: inline-flex; align-items: center; gap: 6px; padding: 10px 16px; border-radius: 12px; font-size: 13px; font-weight: 700; color: white; background: #334155; transition: all 0.2s;"
                                   onmouseover="this.style.background='#1e293b';"
                                   onmouseout="this.style.background='#334155';">
                                    Suivre
                                </a>

                                <?php if(in_array($res->statut, ['en_attente', 'confirmee'], true)): ?>
                                    <form action="<?= BASE_URL ?>passager/reservation/<?= $res->id ?>/annuler" method="POST"
                                          onsubmit="return confirm('Annuler cette réservation ?');" style="display:inline;">
                                        <button type="submit"
                                            style="cursor:pointer; padding: 10px 16px; border-radius: 12px; font-size: 13px; font-weight: 700; border: 1px solid #e2e8f0; color: #dc2626; background: white; transition: all 0.2s;"
                                            onmouseover="this.style.background='#fef2f2'; this.style.borderColor='#fca5a5';"
                                            onmouseout="this.style.background='white'; this.style.borderColor='#e2e8f0';">
                                            Annuler
                                        </button>
                                    </form>
                                <?php endif; ?>

                                <?php
                                $trajetTermine = ($res->statut === 'terminee') || (($res->trajet_statut ?? '') === 'termine');
                                $dejaNote = in_array((int)$res->trajet_id, $trajetsDejaNote);
                                ?>
                                <?php if($trajetTermine && !$dejaNote): ?>
                                    <a href="<?= BASE_URL ?>passager/reservation/<?= $res->id ?>/avis"
                                       style="text-decoration:none; display: inline-flex; align-items: center; gap: 6px; padding: 10px 16px; border-radius: 12px; font-size: 13px; font-weight: 700; color: white; background: #d97706; transition: all 0.2s;"
                                       onmouseover="this.style.background='#b45309';"
                                       onmouseout="this.style.background='#d97706';">
                                        ★ Laisser un avis
                                    </a>
                                <?php elseif($trajetTermine && $dejaNote): ?>
                                    <span style="display: inline-flex; align-items: center; gap: 6px; padding: 10px 16px; border-radius: 12px; font-size: 13px; font-weight: 700; color: #94a3b8; background: #f1f5f9; border: 1px solid #e2e8f0;">
                                        ★ Avis envoyé
                                    </span>
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