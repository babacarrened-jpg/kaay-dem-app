<?php
$reservation = $reservation ?? null;
$statusMessage = $statusMessage ?? '';
$alertType = $alertType ?? 'info';
?>
<?php $canCancel = $canCancel ?? false; ?>

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

    <?php if ($reservation): ?>
    <div class="glass-panel" style="
        max-width: 1000px; 
        margin: 0 auto; 
        padding: 40px;
        border-radius: 24px;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border: 1px solid rgba(229, 231, 235, 0.6);
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        box-sizing: border-box;
    ">
        <div class="page-header" style="display:flex; justify-content:space-between; align-items:flex-start; gap:20px; margin-bottom:32px;">
            <div style="display:flex; align-items:center; gap:16px;">
                <div style="width:56px; height:56px; background:#dc2626; color:white; border-radius:18px; display:flex; align-items:center; justify-content:center; box-shadow: 0 4px 14px rgba(220,38,38,0.2);">
                    <i data-lucide="navigation" width="24" height="24"></i>
                </div>
                <div>
                    <h1 style="font-size:2rem; margin:0; font-weight: 800; color: #111827;">Suivi de réservation</h1>
                    <p style="margin:4px 0 0; color:#4b5563; font-size: 14px;">Consultez le statut et toutes les informations de votre ticket.</p>
                </div>
            </div>
            <a href="<?= BASE_URL ?>passager/reservations" class="btn btn-outline" style="display:inline-flex; align-items:center; gap:10px; padding: 12px 20px; font-size: 14px; border-radius: 12px; background: white;"> 
                <i data-lucide="list" width="16" height="16"></i> Retour aux réservations
            </a>
        </div>

        <?php if(isset($_GET['success']) && $_GET['success'] === 'reservation_annulee'): ?>
            <div style="margin-bottom:24px; padding:16px 20px; border-radius:14px; background:rgba(20,184,166,0.12); color:#115e59; border:1px solid rgba(20,184,166,0.25); font-weight: 600; font-size: 14px;">
                Votre réservation a bien été annulée.
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['error']) && $_GET['error'] === 'annulation_impossible'): ?>
            <div style="margin-bottom:24px; padding:16px 20px; border-radius:14px; background:rgba(239,68,68,0.12); color:#991b1b; border:1px solid rgba(239,68,68,0.25); font-weight: 600; font-size: 14px;">
                Impossible d’annuler cette réservation à ce stade.
            </div>
        <?php endif; ?>

        <div style="display:grid; grid-template-columns: 1.4fr 0.8fr; gap:24px; align-items:flex-start;">
            <div style="padding:28px; border:1px solid #e5e7eb; background: white; border-radius: 20px;">

                <div style="display:flex; align-items:center; justify-content:space-between; gap:16px; margin-bottom:24px;">
                    <div>
                        <div style="font-size:13px; color:#6b7280; margin-bottom:6px; display:flex; gap:8px; align-items:center; font-weight: 600;">
                            <i data-lucide="calendar" width="14" height="14"></i> <?= date('d/m/Y', strtotime($reservation->date_trajet)) ?> 
                            <span>|</span> 
                            <i data-lucide="clock" width="14" height="14"></i> <?= substr($reservation->heure_depart, 0, 5) ?>
                        </div>
                        <h2 style="font-size:26px; margin:0; font-weight: 800; color: #111827; font-family: 'Outfit', sans-serif;">
                            <?= htmlspecialchars($reservation->ville_depart) ?> 
                            <span style="color: #9ca3af; font-weight: 400;">→</span> 
                            <?= htmlspecialchars($reservation->ville_arrivee) ?>
                        </h2>
                    </div>
                    <div style="text-align:right;">
                        <div style="font-size: 24px; font-weight: 800; color: #dc2626; font-family: 'Outfit', sans-serif;"><?= number_format($reservation->prix_total, 0, ',', ' ') ?> F</div>
                        <div style="color:#6b7280; font-size:13px; font-weight: 600;"><?= $reservation->places_reservees ?> place(s)</div>
                    </div>
                </div>

                <?php if(!empty($statusMessage)): ?>
                    <div style="margin-bottom:24px; padding:18px 20px; border-radius:14px; font-size: 14px; font-weight: 600; background:<?= $alertType === 'success' ? 'rgba(34,197,94,0.12)' : ($alertType === 'warning' ? 'rgba(245,158,11,0.12)' : ($alertType === 'danger' ? 'rgba(220,38,38,0.12)' : '#f3f4f6')) ?>; color:<?= $alertType === 'success' ? '#166534' : ($alertType === 'warning' ? '#92400e' : ($alertType === 'danger' ? '#991b1b' : '#374151')) ?>; border:1px solid <?= $alertType === 'success' ? 'rgba(34,197,94,0.2)' : ($alertType === 'warning' ? 'rgba(245,158,11,0.2)' : ($alertType === 'danger' ? 'rgba(220,38,38,0.15)' : '#e5e7eb')) ?>;">
                        <?= htmlspecialchars($statusMessage) ?>
                    </div>
                <?php endif; ?>

                <div style="display:grid; gap:18px; margin-bottom:32px;">
                    <div style="display:flex; gap:18px; align-items:center;">
                        <div style="width:44px; height:44px; border-radius:14px; background:#f8fafc; border:1px solid #e5e7eb; display:flex; align-items:center; justify-content:center; color:#dc2626;"><i data-lucide="user" width="20" height="20"></i></div>
                        <div>
                            <div style="font-size:13px; color:#6b7280;">Conducteur</div>
                            <div style="font-size:16px; font-weight:700; color:#111827;"><?= htmlspecialchars($reservation->conducteur_prenom . ' ' . $reservation->conducteur_nom) ?></div>
                            <div style="font-size:13px; color:#4b5563; font-weight: 500;">Téléphone : <?= htmlspecialchars($reservation->conducteur_tel) ?></div>
                        </div>
                    </div>

                    <div style="display:flex; gap:18px; align-items:center;">
                        <div style="width:44px; height:44px; border-radius:14px; background:#f8fafc; border:1px solid #e5e7eb; display:flex; align-items:center; justify-content:center; color:#dc2626;"><i data-lucide="calendar" width="20" height="20"></i></div>
                        <div>
                            <div style="font-size:13px; color:#6b7280;">Date et heure</div>
                            <div style="font-size:16px; font-weight:700; color:#111827;"><?= date('d/m/Y', strtotime($reservation->date_trajet)) ?> à <?= substr($reservation->heure_depart, 0, 5) ?></div>
                        </div>
                    </div>

                    <div style="display:flex; gap:18px; align-items:center;">
                        <div style="width:44px; height:44px; border-radius:14px; background:#f8fafc; border:1px solid #e5e7eb; display:flex; align-items:center; justify-content:center; color:#dc2626;"><i data-lucide="car" width="20" height="20"></i></div>
                        <div>
                            <div style="font-size:13px; color:#6b7280;">Véhicule</div>
                            <div style="font-size:16px; font-weight:700; color:#111827;"><?= htmlspecialchars($reservation->marque . ' ' . $reservation->modele) ?> - <?= htmlspecialchars($reservation->couleur) ?></div>
                            <div style="font-size:13px; color:#4b5563; font-weight: 500;">Immatriculation : <?= htmlspecialchars($reservation->immatriculation) ?></div>
                        </div>
                    </div>
                </div>

                <div style="border-radius:16px; background:#f8fafc; padding:20px; border:1px solid #e5e7eb;">
                    <h3 style="font-size:18px; margin-bottom:14px; color:#111827; font-weight: 700;">Suivi du trajet</h3>
                    <div style="display:grid; gap:16px;">
                        <div style="display:flex; gap:16px; align-items:flex-start;">
                            <div style="width:12px; height:12px; border-radius:999px; background:#dc2626; margin-top:6px;"></div>
                            <div>
                                <div style="font-weight:700; color:#111827;">Réservation effectuée</div>
                                <div style="color:#4b5563; font-size:13px;">Votre ticket est enregistré et en cours de traitement.</div>
                            </div>
                        </div>
                        <div style="display:flex; gap:16px; align-items:flex-start;">
                            <div style="width:12px; height:12px; border-radius:999px; background:<?= $reservation->statut === 'confirmee' ? '#16a34a' : '#f59e0b' ?>; margin-top:6px;"></div>
                            <div>
                                <div style="font-weight:700; color:#111827;">Statut de confirmation</div>
                                <div style="color:#4b5563; font-size:13px;"><?= $reservation->statut === 'confirmee' ? 'Réservation confirmée par le conducteur.' : 'En attente de confirmation.' ?></div>
                            </div>
                        </div>
                        <?php if($reservation->statut === 'confirmee'): ?>
                            <div style="display:flex; gap:16px; align-items:flex-start;">
                                <div style="width:12px; height:12px; border-radius:999px; background:#3b82f6; margin-top:6px;"></div>
                                <div>
                                    <div style="font-weight:700; color:#111827;">Prêt à partir</div>
                                    <div style="color:#4b5563; font-size:13px;">Préparez-vous pour le départ, arrivez 10 minutes en avance.</div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if(!empty($reservation->description)): ?>
                    <div style="margin-top:24px; padding:24px; border-radius:16px; background:white; border:1px solid #e5e7eb;">
                        <h3 style="font-size:18px; margin-bottom:12px; color:#111827; font-weight: 700;">Instructions du conducteur</h3>
                        <p style="margin:0; line-height:1.75; color:#4b5563; font-size:14px;"><?= nl2br(htmlspecialchars($reservation->description)) ?></p>
                    </div>
                <?php endif; ?>

            </div>

            <aside>
                <div style="padding:24px; border:1px solid #e5e7eb; background:#ffffff; border-radius: 20px;">
                    <div style="font-size:12px; color:#6b7280; text-transform:uppercase; letter-spacing:0.1em; margin-bottom:16px; font-weight: 700;">Détails du ticket</div>
                    <div style="display:grid; gap:14px; font-size: 14px;">
                        <div style="display:flex; flex-direction: column; gap:4px;">
                            <span style="color:#6b7280; font-size: 13px;">Trajet</span>
                            <strong style="color: #111827;"><?= htmlspecialchars($reservation->ville_depart) ?> → <?= htmlspecialchars($reservation->ville_arrivee) ?></strong>
                        </div>
                        <div style="display:flex; justify-content:space-between; gap:12px; border-top: 1px dashed #f3f4f6; pt-2">
                            <span style="color:#6b7280;">Nombre de places</span>
                            <strong style="color: #111827;"><?= $reservation->places_reservees ?></strong>
                        </div>
                        <div style="display:flex; justify-content:space-between; gap:12px;">
                            <span style="color:#6b7280;">Prix unitaire</span>
                            <strong style="color: #111827;"><?= number_format($reservation->prix_par_place, 0, ',', ' ') ?> F</strong>
                        </div>
                        <div style="display:flex; justify-content:space-between; gap:12px; border-top: 1px solid #f3f4f6; padding-top: 10px;">
                            <span style="color:#6b7280; font-weight: 600;">Prix total</span>
                            <strong style="color: #dc2626; font-size: 16px; font-weight: 800;"><?= number_format($reservation->prix_total, 0, ',', ' ') ?> F</strong>
                        </div>
                        <div style="display:flex; justify-content:space-between; gap:12px; border-top: 1px dashed #f3f4f6; padding-top: 10px;">
                            <span style="color:#6b7280;">Places restantes</span>
                            <strong style="color: #111827;"><?= $reservation->places_disponibles ?> / <?= $reservation->places_totales ?></strong>
                        </div>
                    </div>

                    <?php if ($canCancel): ?>
                        <form action="<?= BASE_URL ?>passager/reservation/<?= $reservation->id ?>/annuler" method="POST" style="margin-top:20px;" onsubmit="return confirm('Annuler cette réservation ?');">
                            <button type="submit" class="btn btn-outline" style="width:100%; padding: 12px; font-size: 13px; font-weight: 700; border-radius: 12px; border-color:#fecaca; color:#b91c1c; background: white; cursor: pointer;">
                                Annuler la réservation
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </aside>
        </div>
    </div>
    <?php else: ?>
    <div style="max-width: 600px; margin: 0 auto; box-sizing: border-box;">
        <div class="glass-panel" style="padding: 40px; text-align: center; border-radius: 24px; background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); border: 1px solid rgba(229, 231, 235, 0.6); box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
            <div style="width:64px; height:64px; background:#fee2e2; color:#ef4444; border-radius:20px; display:flex; align-items:center; justify-content:center; margin: 0 auto 20px;">
                <i data-lucide="alert-circle" width="32" height="32"></i>
            </div>
            <h2 style="margin-bottom: 8px; font-weight: 800; color: #111827;">Réservation introuvable</h2>
            <p style="color: #4b5563; font-size: 14px; margin-bottom: 24px;">Cette réservation n’existe pas ou n’est plus accessible.</p>
            <a href="<?= BASE_URL ?>passager/reservations" class="btn btn-primary" style="background: #dc2626; color: white; border: 0; padding: 12px 24px; font-size: 14px; font-weight: 700; border-radius: 12px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">Retour</a>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
  lucide.createIcons();
</script>