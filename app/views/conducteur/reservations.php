<script src="https://unpkg.com/lucide@latest"></script>

<div style="min-height: 100vh; padding: 40px 20px 60px; box-sizing: border-box; background-color: #f7f9fa; background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAxNDAgODAiPjx0ZXh0IHg9IjE1IiB5PSIzMCIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+S0FBWTwvdGV4dD48dGV4dCB4PSIxNSIgeT0iNDUiIGZpbGw9IiNkYzI2MjYiIG9wYWNpdHk9IjAuMDciIGZvbnQtZmFtaWx5PSJzYW5zLXNlcmlmIiBmb250LXdlaWdodD0iOTAwIiBmb250LXNpemU9IjEyIiBsZXR0ZXItc3BhY2luZz0iMC41cHkiPkRFTU08L3RleHQ+PHRleHQgeD0iODUiIHk9IjcwIiBmaWxsPSIjZGMyNjI2IiBvcGFjaXR5PSIwLjA3IiBmb250LWZhbWlseT0ic2Fucy1zZXJpZiIgZm9udC13ZWlnaHQ9IjkwMCIgZm9udC1zaXplPSIxMiIgbGV0dGVyLXNwYWNpbmc9IjAuNXB5Ij5LQUFZPC90ZXh0Pjx0ZXh0IHg9Ijg1IiB5PSI4NSIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+REVNTTwvdGV4dD48L3N2Zz4='); background-repeat: repeat; font-family: system-ui, -apple-system, sans-serif;">

    <div style="max-width: 1100px; margin: 0 auto;">

        <div class="page-header" style="display:flex; justify-content:space-between; align-items:center; gap:20px; margin-bottom:32px; padding:24px 28px; border-radius:24px; background:rgba(255,255,255,0.85); border:1px solid rgba(229,231,235,0.7); box-shadow:0 16px 40px rgba(0,0,0,0.04); backdrop-filter:blur(12px); -webkit-backdrop-filter:blur(12px); flex-wrap: wrap;">
            <div class="page-title-group" style="display:flex; align-items:center; gap:16px;">
                <div class="page-title-icon" style="width:56px; height:56px; background:#f97316; color:white; border-radius:18px; display:flex; align-items:center; justify-content:center; box-shadow: 0 4px 14px rgba(249,115,22,0.2);">
                    <i data-lucide="ticket" width="26" height="26"></i>
                </div>
                <div>
                    <h1 style="font-size:1.8rem; margin:0; font-weight: 800; color: #111827;">Réservations en attente</h1>
                    <p style="margin:4px 0 0; color:#64748b; font-weight: 500;">Validez ou refusez les demandes de vos passagers.</p>
                </div>
            </div>
        </div>

        <?php if(empty($reservations)): ?>
            <div class="glass-panel" style="padding: 80px 24px; text-align: center; background: rgba(255,255,255,0.85); backdrop-filter:blur(14px); -webkit-backdrop-filter:blur(14px); border-radius:24px; border:1px solid rgba(229,231,235,0.6); box-shadow:0 10px 30px rgba(0,0,0,0.02);">
                <div style="font-size: 52px; color: #f97316; margin-bottom: 20px;">🎫</div>
                <h2 style="font-size: 24px; margin-bottom: 10px; font-weight: 800; color: #111827;">Aucune réservation en attente</h2>
                <p style="color: #64748b; margin-bottom: 28px; font-size: 15px;">Les passagers n'ont actuellement envoyé aucune demande.</p>
                <a href="<?= BASE_URL ?>conducteur/trajets" class="btn btn-outline"
                   style="text-decoration:none; display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; border-radius: 12px; font-size: 14px; font-weight: 600; border: 1px solid #e2e8f0; color: #334155; background: white; transition: all 0.2s;"
                   onmouseover="this.style.background='#f8fafc'; this.style.borderColor='#cbd5e1';"
                   onmouseout="this.style.background='white'; this.style.borderColor='#e2e8f0';">
                    Voir mes trajets
                </a>
            </div>
        <?php else: ?>
            <div style="display: grid; gap: 18px;">
                <?php foreach($reservations as $res): ?>
                    <div class="glass-panel" style="padding: 24px; background: rgba(255,255,255,0.9); backdrop-filter:blur(10px); -webkit-backdrop-filter:blur(10px); border-radius:24px; border:1px solid rgba(229,231,235,0.6); box-shadow:0 4px 20px rgba(0,0,0,0.01); display:flex; justify-content:space-between; gap:20px; align-items:center; flex-wrap: wrap;">
                        
                        <div style="flex:2; min-width: 280px;">
                            <div style="font-size:13px; color:#64748b; margin-bottom:6px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; background: #f1f5f9; padding: 4px 10px; border-radius: 6px;">
                                <i data-lucide="calendar" width="14" height="14"></i> Le <?= date('d/m/Y', strtotime($res->date_trajet)) ?> à <?= substr($res->heure_depart,0,5) ?>
                            </div>
                            <h2 style="margin:8px 0 10px; font-size:20px; font-weight:800; color:#111827;"><?= htmlspecialchars($res->ville_depart) ?> → <?= htmlspecialchars($res->ville_arrivee) ?></h2>
                            <div style="color:#475569; font-size: 15px; display: flex; align-items: center; gap: 6px;">
                                <i data-lucide="user" width="16" height="16" style="color: #64748b;"></i> Passager : <strong style="color: #111827;"><?= htmlspecialchars($res->passager_prenom . ' ' . $res->passager_nom) ?></strong>
                            </div>
                        </div>

                        <div style="flex:0 0 240px; text-align:right; display:flex; flex-direction:column; gap:6px; align-items:flex-end; justify-content: center; min-width: 220px;">
                            <div style="font-size:24px; font-weight:800; color:#f97316;"><?= number_format($res->prix_total,0,',',' ') ?> F</div>
                            <div style="color:#475569; font-size:14px; font-weight: 700; background: #fff7ed; padding: 2px 8px; border-radius: 6px; border: 1px solid #ffedd5;"><?= $res->places_reservees ?> place<?= $res->places_reservees > 1 ? 's' : '' ?></div>
                            
                            <div style="display:flex; gap:8px; margin-top:12px; width: 100%;">
                                <form action="<?= BASE_URL ?>conducteur/reservation/<?= $res->id ?>/accept" method="POST" style="flex: 1; display:inline;">
                                    <button type="submit" 
                                            class="btn btn-primary" 
                                            style="width: 100%; border: none; cursor: pointer; padding: 10px 14px; border-radius: 12px; font-size: 14px; font-weight: 700; text-align: center; color: white; background: #16a34a; transition: all 0.2s;"
                                            onmouseover="this.style.background='#15803d';"
                                            onmouseout="this.style.background='#16a34a';">
                                        Accepter
                                    </button>
                                </form>
                                <form action="<?= BASE_URL ?>conducteur/reservation/<?= $res->id ?>/reject" method="POST" style="flex: 1; display:inline;">
                                    <button type="submit" 
                                            class="btn btn-outline" 
                                            style="width: 100%; cursor: pointer; padding: 10px 14px; border-radius: 12px; font-size: 14px; font-weight: 700; text-align: center; border: 1px solid #e2e8f0; color: #dc2626; background: white; transition: all 0.2s;"
                                            onmouseover="this.style.background='#fef2f2'; this.style.borderColor='#fca5a5';"
                                            onmouseout="this.style.background='white'; this.style.borderColor='#e2e8f0';">
                                        Refuser
                                    </button>
                                </form>
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