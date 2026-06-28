<script src="https://unpkg.com/lucide@latest"></script>

<div style="min-height: 100vh; padding: 40px 20px 60px; box-sizing: border-box; background-color: #f7f9fa; background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAxNDAgODAiPjx0ZXh0IHg9IjE1IiB5PSIzMCIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+S0FBWTwvdGV4dD48dGV4dCB4PSIxI1"Pjx0ZXh0IHg9IjE1IiB5PSI0NSIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+REVNTTwvdGV4dD48dGV4dCB4PSI4NSIgeT0iNzAiIGZpbGw9IiNkYzI2MjYiIG9wYWNpdHk9IjAuMDciIGZvbnQtZmFtaWx5PSJzYW5zLXNlcmlmIiBmb250LXdlaWdodD0iOTAwIiBmb250LXNpemU9IjEyIiBsZXR0ZXItc3BhY2luZz0iMC41cHkiPktBQVk8L3RleHQ+PHRleHQgeD0iODUiIHk9Ijg1IiBmaWxsPSIjZGMyNjI2IiBvcGFjaXR5PSIwLjA3IiBmb250LWZhbWlseT0ic2Fucy1zZXJpZiIgZm9udC13ZWlnaHQ9IjkwMCIgZm9udC1zaXplPSIxMiIgbGV0dGVyLXNwYWNpbmc9IjAuNXB5Ij5ERU1NPC90ZXh0Pjwvc3ZnPg=='); background-repeat: repeat; font-family: system-ui, -apple-system, sans-serif;">

    <div style="max-width: 1000px; margin: 0 auto;">

        <div class="page-header" style="display:flex; justify-content:space-between; align-items:center; gap:20px; margin-bottom:32px; padding:24px 28px; border-radius:24px; background:rgba(255,255,255,0.85); border:1px solid rgba(229,231,235,0.7); box-shadow:0 16px 40px rgba(0,0,0,0.04); backdrop-filter:blur(12px); -webkit-backdrop-filter:blur(12px); flex-wrap: wrap;">
            <div class="page-title-group" style="display:flex; align-items:center; gap:16px;">
                <div class="page-title-icon" style="width:56px; height:56px; background:#dc2626; color:white; border-radius:18px; display:flex; align-items:center; justify-content:center; box-shadow: 0 4px 14px rgba(220,38,38,0.2);">
                    <i data-lucide="users" width="26" height="26"></i>
                </div>
                <div>
                    <h1 style="font-size:1.8rem; margin:0; font-weight: 800; color: #111827;">Passagers du trajet</h1>
                    <p style="margin:4px 0 0; color:#64748b; font-weight: 500; display: flex; align-items: center; gap: 6px; flex-wrap: wrap;">
                        <span style="color:#111827; font-weight:700;"><?= htmlspecialchars($trajet->ville_depart) ?> → <?= htmlspecialchars($trajet->ville_arrivee) ?></span>
                        <span style="color:#cbd5e1;">|</span>
                        <span style="display:inline-flex; align-items:center; gap:4px;"><i data-lucide="calendar" width="14" height="14"></i> <?= date('d/m/Y', strtotime($trajet->date_trajet)) ?></span>
                        <span style="display:inline-flex; align-items:center; gap:4px;"><i data-lucide="clock" width="14" height="14"></i> <?= substr($trajet->heure_depart, 0, 5) ?></span>
                    </p>
                </div>
            </div>
            <a href="<?= BASE_URL ?>conducteur/trajets"
               style="text-decoration:none; display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; border-radius: 12px; font-size: 14px; font-weight: 600; border: 1px solid #e2e8f0; color: #334155; background: white; transition: all 0.2s;"
               onmouseover="this.style.background='#f8fafc'; this.style.borderColor='#cbd5e1';"
               onmouseout="this.style.background='white'; this.style.borderColor='#e2e8f0';">
                <i data-lucide="arrow-left" width="16" height="16"></i> Retour à mes trajets
            </a>
        </div>

        <?php if (empty($passagers)): ?>
            <div class="glass-panel" style="padding: 80px 24px; text-align: center; background: rgba(255,255,255,0.85); backdrop-filter:blur(14px); -webkit-backdrop-filter:blur(14px); border-radius:24px; border:1px solid rgba(229,231,235,0.6); box-shadow:0 10px 30px rgba(0,0,0,0.02);">
                <div style="font-size: 52px; margin-bottom: 20px;">🧍</div>
                <h2 style="font-size: 22px; margin-bottom: 10px; font-weight: 800; color: #111827;">Aucun passager pour le moment</h2>
                <p style="color: #64748b; margin: 0; font-size: 15px; font-weight: 500;">Personne n'a encore réservé ce trajet.</p>
            </div>
        <?php else: ?>
            <?php
            $statutLabels = [
                'en_attente' => ['label' => 'En attente', 'bg' => '#FEF3C7', 'color' => '#92400E'],
                'confirmee'  => ['label' => 'Confirmée', 'bg' => '#DCFCE7', 'color' => '#166534'],
                'terminee'   => ['label' => 'Terminée',  'bg' => '#E2E8F0', 'color' => '#475569'],
                'annulee'    => ['label' => 'Annulée',   'bg' => '#FEE2E2', 'color' => '#991B1B'],
                'refusee'    => ['label' => 'Refusée',   'bg' => '#FEE2E2', 'color' => '#991B1B'],
            ];
            ?>
            <div style="display: grid; gap: 16px;">
                <?php foreach ($passagers as $passager): ?>
                    <?php $statutInfo = $statutLabels[$passager->reservation_statut] ?? ['label' => ucfirst($passager->reservation_statut), 'bg' => '#E2E8F0', 'color' => '#475569']; ?>
                    
                    <div class="glass-panel" style="padding: 24px; background: rgba(255,255,255,0.9); backdrop-filter:blur(10px); -webkit-backdrop-filter:blur(10px); border-radius:24px; border:1px solid rgba(229,231,235,0.6); box-shadow:0 4px 20px rgba(0,0,0,0.01); display:flex; justify-content:space-between; align-items:center; gap: 20px; flex-wrap: wrap;">
                        <div style="display:flex; align-items:center; gap:16px; min-width: 280px; flex: 1;">
                            <div style="width:52px; height:52px; border-radius:50%; background:#fef2f2; color:#dc2626; display:flex; align-items:center; justify-content:center; font-weight:900; font-size:20px; box-shadow: 0 4px 12px rgba(220,38,38,0.08); flex-shrink: 0; border: 1px solid rgba(220,38,38,0.1);">
                                <?= htmlspecialchars(strtoupper(substr($passager->prenom, 0, 1))) ?>
                            </div>
                            <div>
                                <div style="font-weight:800; font-size:17px; color: #111827;"><?= htmlspecialchars($passager->prenom . ' ' . $passager->nom) ?></div>
                                <div style="color:#64748b; font-size:13px; display:flex; gap:16px; flex-wrap:wrap; margin-top:6px; font-weight: 500;">
                                    <span style="display:inline-flex; align-items:center; gap:5px;"><i data-lucide="phone" width="14" height="14" style="color:#94a3b8;"></i> <?= htmlspecialchars($passager->telephone) ?></span>
                                    <span style="display:inline-flex; align-items:center; gap:5px;"><i data-lucide="mail" width="14" height="14" style="color:#94a3b8;"></i> <?= htmlspecialchars($passager->email) ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div style="text-align:right; min-width: 140px; display: flex; flex-direction: column; align-items: flex-end; justify-content: center;">
                            <span style="padding: 6px 14px; border-radius: 999px; display:inline-block; font-size:11px; font-weight:700; text-transform: uppercase; letter-spacing: 0.04em; background:<?= $statutInfo['bg'] ?>; color:<?= $statutInfo['color'] ?>; margin-bottom: 8px;">
                                <?= $statutInfo['label'] ?>
                            </span>
                            <div style="font-size:14px; color:#475569; font-weight: 700; background: #f8fafc; padding: 4px 10px; border-radius: 8px; border: 1px solid #e2e8f0;">
                                <?= $passager->places_reservees ?> place<?= $passager->places_reservees > 1 ? 's' : '' ?> · <span style="color: #dc2626; font-weight: 800;"><?= number_format($passager->prix_total, 0, ',', ' ') ?> F</span>
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