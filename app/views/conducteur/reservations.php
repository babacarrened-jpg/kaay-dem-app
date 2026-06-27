<div style="max-width: 1100px; margin: 40px auto; padding: 0 20px;">

    <div class="page-header" style="display:flex; justify-content:space-between; align-items:center; gap:20px; margin-bottom:32px;">
        <div class="page-title-group" style="display:flex; align-items:center; gap:16px;">
            <div class="page-title-icon" style="width:56px; height:56px; background:#f97316; color:white; border-radius:18px; display:flex; align-items:center; justify-content:center;">
                <i data-lucide="ticket" width="24" height="24"></i>
            </div>
            <div>
                <h1 style="font-size:2rem; margin:0;">Réservations en attente</h1>
                <p style="margin:4px 0 0; color:#64748b;">Validez ou refusez les demandes de vos passagers.</p>
            </div>
        </div>
    </div>

    <?php if(empty($reservations)): ?>
        <div class="glass-panel" style="padding: 60px 24px; text-align: center; border: 1px solid #E2E8F0;">
            <div style="font-size: 52px; color: #f97316; margin-bottom: 24px;">🎫</div>
            <h2 style="font-size: 24px; margin-bottom: 12px;">Aucune réservation en attente</h2>
            <p style="color: #64748b; margin-bottom: 16px;">Les passagers n'ont actuellement envoyé aucune demande.</p>
            <a href="<?= BASE_URL ?>conducteur/trajets" class="btn btn-outline">Voir mes trajets</a>
        </div>
    <?php else: ?>
        <div style="display: grid; gap: 18px;">
            <?php foreach($reservations as $res): ?>
                <div class="glass-panel" style="padding: 20px; display:flex; justify-content:space-between; gap:16px; align-items:center;">
                    <div style="flex:2;">
                        <div style="font-size:13px; color:#64748b; margin-bottom:8px;">Le <?= date('d/m/Y', strtotime($res->date_trajet)) ?> à <?= substr($res->heure_depart,0,5) ?></div>
                        <h3 style="margin:0; font-size:18px; font-weight:800;"><?= htmlspecialchars($res->ville_depart) ?> → <?= htmlspecialchars($res->ville_arrivee) ?></h3>
                        <div style="color:#475569; margin-top:8px;">Passager : <strong><?= htmlspecialchars($res->passager_prenom . ' ' . $res->passager_nom) ?></strong></div>
                    </div>
                    <div style="flex:0 0 220px; text-align:right; display:flex; flex-direction:column; gap:8px; align-items:flex-end;">
                        <div style="font-size:20px; font-weight:800; color:#f97316;"><?= number_format($res->prix_total,0,',',' ') ?> F</div>
                        <div style="color:#64748b; font-size:13px;"><?= $res->places_reservees ?> place(s)</div>
                        <div style="display:flex; gap:8px; margin-top:8px;">
                            <form action="<?= BASE_URL ?>conducteur/reservation/<?= $res->id ?>/accept" method="POST" style="display:inline;">
                                <button type="submit" class="btn btn-primary" style="padding:8px 12px;">Accepter</button>
                            </form>
                            <form action="<?= BASE_URL ?>conducteur/reservation/<?= $res->id ?>/reject" method="POST" style="display:inline;">
                                <button type="submit" class="btn btn-outline" style="padding:8px 12px;">Refuser</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>
