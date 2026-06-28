
<script src="https://unpkg.com/lucide@latest"></script>

<div style="
    min-height: 100vh;
    padding: 40px 20px;
    box-sizing: border-box;
    background-color: #f7f9fa;
    background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAxNDAgODAiPjx0ZXh0IHg9IjE1IiB5PSIzMCIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+S0FBWTwvdGV4dD48dGV4dCB4PSIxNSIgeT0iNDUiIGZpbGw9IiNkYzI2MjYiIG9wYWNpdHk9IjAuMDciIGZvbnQtZmFtaWx5PSJzYW5zLXNlcmlmIiBmb250LXdlaWdodD0iOTAwIiBmb250LXNpemU9IjEyIiBsZXR0ZXItc3BhY2luZz0iMC41cHkiPkRFTU08L3RleHQ+PHRleHQgeD0iODUiIHk9IjcwIiBmaWxsPSIjZGMyNjI2IiBvcGFjaXR5PSIwLjA3IiBmb250LWZhbWlseT0ic2Fucy1zZXJpZiIgZm9udC13ZWlnaHQ9IjkwMCIgZm9udC1zaXplPSIxMiIgbGV0dGVyLXNwYWNpbmc9IjAuNXB5Ij5LQUFZPC90ZXh0Pjx0ZXh0IHg9Ijg1IiB5PSI4NSIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+REVNTTwvdGV4dD48L3N2Zz4=');
    background-repeat: repeat;
    font-family: system-ui, -apple-system, sans-serif;
">

    <div style="max-width: 1100px; margin: 0 auto; display: grid; grid-template-columns: 2fr 1fr; gap: 32px;">
        
        <div>
            <div class="glass-panel" style="
                margin-bottom: 24px; 
                position: relative; 
                overflow: hidden;
                padding: 35px;
                border-radius: 24px;
                background: rgba(255, 255, 255, 0.85);
                backdrop-filter: blur(14px);
                -webkit-backdrop-filter: blur(14px);
                border: 1px solid rgba(229, 231, 235, 0.6);
                box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            ">
                <div style="position: absolute; top: 0; left: 0; bottom: 0; width: 6px; background: #dc2626;"></div>
                
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px; color: #4b5563; font-size: 14px; font-weight: 600;">
                    <i data-lucide="calendar" width="18" height="18" style="color: #6b7280;"></i> <?= date('l d F Y', strtotime($trajet->date_trajet)) ?>
                    <span style="color:#d1d5db;">|</span>
                    <i data-lucide="clock" width="18" height="18" style="color: #6b7280;"></i> <?= substr($trajet->heure_depart, 0, 5) ?>
                </div>

                <h1 style="font-size: 30px; font-weight: 800; color: #111827; margin: 0 0 32px 0; display: flex; align-items: center; gap: 16px;">
                    <?= htmlspecialchars($trajet->ville_depart) ?> 
                    <div style="width: 38px; height: 38px; background: rgba(220, 38, 38, 0.08); color: #dc2626; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(220, 38, 38, 0.15);">
                        <i data-lucide="arrow-right" width="18" height="18"></i>
                    </div>
                    <?= htmlspecialchars($trajet->ville_arrivee) ?>
                </h1>

                <?php if(!empty($message)): ?>
                    <div style="margin-bottom: 24px; padding: 18px 22px; border-radius: 16px; border: 1px solid <?= $alertType === 'danger' ? '#fecaca' : ($alertType === 'warning' ? '#fde68a' : '#d1fae5') ?>; background: <?= $alertType === 'danger' ? 'rgba(254, 202, 202, 0.4)' : ($alertType === 'warning' ? 'rgba(253, 230, 138, 0.4)' : 'rgba(220, 252, 231, 0.4)') ?>; color: <?= $alertType === 'danger' ? '#991b1b' : ($alertType === 'warning' ? '#92400e' : '#166534') ?>; backdrop-filter: blur(4px);">
                        <div style="display:flex; align-items:center; gap:12px; font-weight:700; font-size:15px;">
                            <i data-lucide="info" width="18" height="18"></i>
                            <?= htmlspecialchars($message) ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; padding: 24px; background: white; border-radius: 16px; border: 1px solid #e5e7eb; margin-bottom: 32px;">
                    <div>
                        <div style="font-size: 13px; color: #6b7280; font-weight: 600; margin-bottom: 6px; display: flex; align-items: center; gap: 6px;">
                            <i data-lucide="map-pin" width="14" height="14" style="color:#dc2626;"></i> Point de départ
                        </div>
                        <div style="font-weight: 700; color: #111827; font-size: 15px;"><?= htmlspecialchars($trajet->point_depart ?: 'À définir avec le conducteur') ?></div>
                    </div>
                    <div>
                        <div style="font-size: 13px; color: #6b7280; font-weight: 600; margin-bottom: 6px; display: flex; align-items: center; gap: 6px;">
                            <i data-lucide="flag" width="14" height="14" style="color:#dc2626;"></i> Point d'arrivée
                        </div>
                        <div style="font-weight: 700; color: #111827; font-size: 15px;"><?= htmlspecialchars($trajet->point_arrivee ?: 'À définir avec le conducteur') ?></div>
                    </div>
                </div>

                <h3 style="font-size: 18px; font-weight: 800; color: #111827; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px;">
                    <i data-lucide="info" width="18" height="18" style="color:#dc2626;"></i> À propos du trajet
                </h3>
                <p style="color: #374151; font-size: 15px; margin: 0 0 28px 0; line-height: 1.7;"><?= nl2br(htmlspecialchars($trajet->description ?: 'Aucune description spécifique fournie par le conducteur.')) ?></p>

                <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <?php if($trajet->climatisation): ?>
                        <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 50px; font-size: 13px; font-weight: 700; background: rgba(34,197,94,0.12); color: #166534; border: 1px solid rgba(34,197,94,0.2);"><i data-lucide="snowflake" width="14" height="14"></i> Climatisation</span>
                    <?php endif; ?>
                    <?php if($trajet->musique): ?>
                        <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 50px; font-size: 13px; font-weight: 700; background: rgba(34,197,94,0.12); color: #166534; border: 1px solid rgba(34,197,94,0.2);"><i data-lucide="music" width="14" height="14"></i> Musique</span>
                    <?php endif; ?>
                    <?php if($trajet->fumeur): ?>
                        <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 50px; font-size: 13px; font-weight: 700; background: rgba(245,158,11,0.12); color: #92400e; border: 1px solid rgba(245,158,11,0.2);"><i data-lucide="cigarette" width="14" height="14"></i> Fumeur toléré</span>
                    <?php else: ?>
                        <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 50px; font-size: 13px; font-weight: 700; background: rgba(34,197,94,0.12); color: #166534; border: 1px solid rgba(34,197,94,0.2);"><i data-lucide="cigarette-off" width="14" height="14"></i> Non fumeur</span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="glass-panel" style="
                padding: 35px;
                border-radius: 24px;
                background: rgba(255, 255, 255, 0.85);
                backdrop-filter: blur(14px);
                -webkit-backdrop-filter: blur(14px);
                border: 1px solid rgba(229, 231, 235, 0.6);
                box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            ">
                <h3 style="font-size: 18px; font-weight: 800; color: #111827; margin: 0 0 24px 0; display: flex; align-items: center; gap: 8px;">
                    <i data-lucide="user" width="18" height="18" style="color:#dc2626;"></i> Le Conducteur
                </h3>
                <div style="display: flex; align-items: center; gap: 24px;">
                    <div style="width: 74px; height: 74px; background: #dc2626; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 26px; box-shadow: 0 4px 12px rgba(220,38,38,0.2);">
                        <?= strtoupper(substr($trajet->conducteur_prenom, 0, 1)) ?>
                    </div>
                    <div>
                        <h4 style="font-size: 19px; font-weight: 800; color: #111827; margin: 0 0 6px 0;"><?= htmlspecialchars($trajet->conducteur_prenom . ' ' . $trajet->conducteur_nom) ?></h4>
                        <div style="color: #4b5563; font-size: 14px; margin-bottom: 12px; display:flex; align-items:center; gap:6px; font-weight: 500;">
                            <i data-lucide="star" width="14" height="14" style="color:#fbbf24; fill:#fbbf24;"></i> 4.8/5 - 12 avis
                        </div>
                        <div style="font-size: 14px; color: #111827; font-weight: 600;">
                            <div style="background: white; padding: 6px 12px; border-radius: 8px; border: 1px solid #e5e7eb; display: inline-flex; align-items: center; gap: 6px;">
                                <i data-lucide="car" width="14" height="14" style="color:#6b7280;"></i>
                                <?= htmlspecialchars($trajet->marque . ' ' . $trajet->modele) ?> (<span style="color:#4b5563; font-weight: 500;"><?= htmlspecialchars($trajet->couleur) ?></span>)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="glass-panel" style="
                position: sticky; 
                top: 40px;
                padding: 35px;
                border-radius: 24px;
                background: rgba(255, 255, 255, 0.88);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(229, 231, 235, 0.6);
                box-shadow: 0 15px 35px rgba(0,0,0,0.04);
            ">
                <div style="text-align: center; margin-bottom: 28px;">
                    <div style="font-size: 13px; color: #6b7280; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Prix par place</div>
                    <div style="font-size: 44px; font-weight: 900; color: #dc2626; line-height: 1; letter-spacing: -1px;">
                        <?= number_format($trajet->prix_par_place, 0, ',', ' ') ?> <span style="font-size:22px; font-weight: 700;">F</span>
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding: 20px 0; border-top: 1px solid #e5e7eb; border-bottom: 1px solid #e5e7eb; margin-bottom: 28px;">
                    <span style="font-weight: 700; color: #111827; font-size: 15px; display:flex; align-items:center; gap:8px;">
                        <i data-lucide="users" width="18" height="18" style="color:#6b7280;"></i> Places restantes
                    </span>
                    <span style="background: rgba(220,38,38,0.08); color: #dc2626; border: 1px solid rgba(220,38,38,0.15); padding: 6px 16px; border-radius: 50px; font-weight: 800; font-size: 16px;">
                        <?= $trajet->places_disponibles ?> / <?= $trajet->places_totales ?>
                    </span>
                </div>

                <?php if(isset($_SESSION['user_id'])): ?>
                    <?php if($_SESSION['user_id'] == $trajet->conducteur_id): ?>
                        <button style="width: 100%; height: 54px; background: #f3f4f6; color: #9ca3af; border: 1px solid #e5e7eb; border-radius: 14px; font-weight: 700; font-size: 15px; display: flex; align-items: center; justify-content: center; gap: 8px;" disabled>
                            <i data-lucide="lock" width="16" height="16"></i> C'est votre trajet
                        </button>
                    <?php else: ?>
                        <div style="background: #fef2f2; border: 1px solid rgba(220,38,38,0.15); border-radius: 12px; padding: 14px; margin-bottom: 20px; color: #991b1b; font-size: 14px; font-weight: 600; line-height: 1.4;">
                            <i data-lucide="info" width="16" height="16" style="display:inline; margin-right:6px; vertical-align: middle;"></i>
                            Réservez immédiatement votre place en un clic.
                        </div>
                        <a href="<?= BASE_URL ?>index.php?url=passager/reserver/<?= $trajet->id ?>" style="display: inline-flex; align-items: center; justify-content: center; width: 100%; height: 56px; font-size: 16px; font-weight: 700; border: 0; border-radius: 14px; background: #dc2626; color: white; box-shadow: 0 8px 24px rgba(220, 38, 38, 0.3); text-decoration: none; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='#b91c1c'" onmouseout="this.style.background='#dc2626'">
                            Réserver maintenant <i data-lucide="check-circle" style="margin-left: 10px;" width="18" height="18"></i>
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="<?= BASE_URL ?>auth/connexion" style="display: flex; align-items: center; justify-content: center; width: 100%; height: 56px; font-size: 16px; font-weight: 700; border: 0; border-radius: 14px; background: #dc2626; color: white; box-shadow: 0 8px 24px rgba(220, 38, 38, 0.3); text-decoration: none; transition: background 0.2s;" onmouseover="this.style.background='#b91c1c'" onmouseout="this.style.background='#dc2626'">
                        Se connecter pour réserver
                    </a>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<script>
  lucide.createIcons();
</script>

```