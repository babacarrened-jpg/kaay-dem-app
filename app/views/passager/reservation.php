<div style="max-width: 1000px; margin: 40px auto; padding: 0 20px;">
    <div class="page-header" style="display:flex; justify-content:space-between; align-items:flex-start; gap:20px; margin-bottom:32px;">
        <div style="display:flex; align-items:center; gap:16px;">
            <div style="width:56px; height:56px; background:#dc2626; color:white; border-radius:18px; display:flex; align-items:center; justify-content:center;">
                <i data-lucide="navigation" width="24" height="24"></i>
            </div>
            <div>
                <h1 style="font-size:2rem; margin:0;">Suivi de réservation</h1>
                <p style="margin:4px 0 0; color:#64748b;">Consultez le statut et toutes les informations de votre ticket.</p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>passager/reservations" class="btn btn-outline" style="display:inline-flex; align-items:center; gap:10px;"> <i data-lucide="list"></i> Retour aux réservations</a>
    </div>

    <div style="display:grid; grid-template-columns: 1.4fr 0.8fr; gap:24px; align-items:flex-start;">
        <div class="glass-panel" style="padding:28px; border:1px solid #E2E8F0;">

            <div style="display:flex; align-items:center; justify-content:space-between; gap:16px; margin-bottom:24px;">
                <div>
                    <div style="font-size:13px; color:#64748b; margin-bottom:6px; display:flex; gap:8px; align-items:center;"><i data-lucide="calendar" width="14" height="14"></i> <?= date('d/m/Y', strtotime($reservation->date_trajet)) ?> <span>|</span> <i data-lucide="clock" width="14" height="14"></i> <?= substr($reservation->heure_depart, 0, 5) ?></div>
                    <h2 style="font-size:28px; margin:0;"><?= htmlspecialchars($reservation->ville_depart) ?> → <?= htmlspecialchars($reservation->ville_arrivee) ?></h2>
                </div>
                <div style="text-align:right;">
                    <div style="font-size: 20px; font-weight: 700; color: #dc2626;"><?= number_format($reservation->prix_total, 0, ',', ' ') ?> F</div>
                    <div style="color:#64748b; font-size:13px;"><?= $reservation->places_reservees ?> place(s)</div>
                </div>
            </div>

            <?php if(!empty($statusMessage)): ?>
                <div style="margin-bottom:24px; padding:18px 20px; border-radius:18px; background:<?= $alertType === 'success' ? 'rgba(20,184,166,0.1)' : ($alertType === 'warning' ? 'rgba(245,158,11,0.12)' : ($alertType === 'danger' ? 'rgba(239,68,68,0.12)' : '#f8fafc')) ?>; color:<?= $alertType === 'success' ? '#115e59' : ($alertType === 'warning' ? '#92400e' : ($alertType === 'danger' ? '#991b1b' : '#334155')) ?>; border:1px solid <?= $alertType === 'success' ? 'rgba(20,184,166,0.25)' : ($alertType === 'warning' ? 'rgba(245,158,11,0.25)' : ($alertType === 'danger' ? 'rgba(239,68,68,0.25)' : '#e2e8f0')) ?>;">
                    <?= htmlspecialchars($statusMessage) ?>
                </div>
            <?php endif; ?>

            <div style="display:grid; gap:18px; margin-bottom:32px;">
                <div style="display:flex; gap:18px; align-items:center;">
                    <div style="width:44px; height:44px; border-radius:14px; background:#f8fafc; display:flex; align-items:center; justify-content:center; color:#dc2626;"><i data-lucide="user" width="20" height="20"></i></div>
                    <div>
                        <div style="font-size:13px; color:#64748b;">Conducteur</div>
                        <div style="font-size:16px; font-weight:700; color:#0f172a;"><?= htmlspecialchars($reservation->conducteur_prenom . ' ' . $reservation->conducteur_nom) ?></div>
                        <div style="font-size:13px; color:#64748b;">Téléphone : <?= htmlspecialchars($reservation->conducteur_tel) ?></div>
                    </div>
                </div>

                <div style="display:flex; gap:18px; align-items:center;">
                    <div style="width:44px; height:44px; border-radius:14px; background:#f8fafc; display:flex; align-items:center; justify-content:center; color:#dc2626;"><i data-lucide="calendar" width="20" height="20"></i></div>
                    <div>
                        <div style="font-size:13px; color:#64748b;">Date et heure</div>
                        <div style="font-size:16px; font-weight:700; color:#0f172a;"><?= date('d/m/Y', strtotime($reservation->date_trajet)) ?> à <?= substr($reservation->heure_depart, 0, 5) ?></div>
                    </div>
                </div>

                <div style="display:flex; gap:18px; align-items:center;">
                    <div style="width:44px; height:44px; border-radius:14px; background:#f8fafc; display:flex; align-items:center; justify-content:center; color:#dc2626;"><i data-lucide="car" width="20" height="20"></i></div>
                    <div>
                        <div style="font-size:13px; color:#64748b;">Véhicule</div>
                        <div style="font-size:16px; font-weight:700; color:#0f172a;"><?= htmlspecialchars($reservation->marque . ' ' . $reservation->modele) ?> - <?= htmlspecialchars($reservation->couleur) ?></div>
                        <div style="font-size:13px; color:#64748b;">Immatriculation : <?= htmlspecialchars($reservation->immatriculation) ?></div>
                    </div>
                </div>
            </div>

            <div style="border-radius:24px; background:#f8fafc; padding:20px; border:1px solid #e2e8f0;">
                <h3 style="font-size:18px; margin-bottom:14px; color:#0f172a;">Suivi du trajet</h3>
                <div style="display:grid; gap:16px;">
                    <div style="display:flex; gap:16px; align-items:flex-start;">
                        <div style="width:12px; height:12px; border-radius:999px; background:#dc2626; margin-top:6px;"></div>
                        <div>
                            <div style="font-weight:700; color:#0f172a;">Réservation effectuée</div>
                            <div style="color:#64748b; font-size:13px;">Votre ticket est enregistré et en cours de traitement.</div>
                        </div>
                    </div>
                    <div style="display:flex; gap:16px; align-items:flex-start;">
                        <div style="width:12px; height:12px; border-radius:999px; background:<?= $reservation->statut === 'confirmee' ? '#16a34a' : '#f59e0b' ?>; margin-top:6px;"></div>
                        <div>
                            <div style="font-weight:700; color:#0f172a;">Statut de confirmation</div>
                            <div style="color:#64748b; font-size:13px;"><?= $reservation->statut === 'confirmee' ? 'Réservation confirmée par le conducteur.' : 'En attente de confirmation.' ?></div>
                        </div>
                    </div>
                    <?php if($reservation->statut === 'confirmee'): ?>
                        <div style="display:flex; gap:16px; align-items:flex-start;">
                            <div style="width:12px; height:12px; border-radius:999px; background:#3b82f6; margin-top:6px;"></div>
                            <div>
                                <div style="font-weight:700; color:#0f172a;">Prêt à partir</div>
                                <div style="color:#64748b; font-size:13px;">Préparez-vous pour le départ, arrivez 10 minutes en avance.</div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if(!empty($reservation->description)): ?>
                <div style="margin-top:24px; padding:24px; border-radius:24px; background:white; border:1px solid #E2E8F0;">
                    <h3 style="font-size:18px; margin-bottom:12px; color:#0f172a;">Instructions du conducteur</h3>
                    <p style="margin:0; line-height:1.75; color:#475569;"><?= nl2br(htmlspecialchars($reservation->description)) ?></p>
                </div>
            <?php endif; ?>

        </div>

        <aside>
            <div class="glass-panel" style="padding:24px; border:1px solid #E2E8F0; background:#ffffff;">
                <div style="font-size:13px; color:#64748b; text-transform:uppercase; letter-spacing:0.15em; margin-bottom:16px;">Détails du ticket</div>
                <div style="display:grid; gap:14px;">
                    <div style="display:flex; justify-content:space-between; gap:12px;">
                        <span style="color:#64748b;">Trajet</span>
                        <strong><?= htmlspecialchars($reservation->ville_depart) ?> → <?= htmlspecialchars($reservation->ville_arrivee) ?></strong>
                    </div>
                    <div style="display:flex; justify-content:space-between; gap:12px;">
                        <span style="color:#64748b;">Nombre de places</span>
                        <strong><?= $reservation->places_reservees ?></strong>
                    </div>
                    <div style="display:flex; justify-content:space-between; gap:12px;">
                        <span style="color:#64748b;">Prix unitaire</span>
                        <strong><?= number_format($reservation->prix_par_place, 0, ',', ' ') ?> F</strong>
                    </div>
                    <div style="display:flex; justify-content:space-between; gap:12px;">
                        <span style="color:#64748b;">Prix total</span>
                        <strong><?= number_format($reservation->prix_total, 0, ',', ' ') ?> F</strong>
                    </div>
                    <div style="display:flex; justify-content:space-between; gap:12px;">
                        <span style="color:#64748b;">Places restantes</span>
                        <strong><?= $reservation->places_disponibles ?> / <?= $reservation->places_totales ?></strong>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>
