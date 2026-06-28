<?php
// trajetsDejaNote est calculé et fourni par le contrôleur (PassagerController::reservations())
$trajetsDejaNote = $trajetsDejaNote ?? [];
?>

<div style="max-width: 1100px; margin: 40px auto; padding: 0 20px;">

    <div style="display:flex; justify-content:space-between; align-items:center; gap:20px; margin-bottom:32px;">
        <div style="display:flex; align-items:center; gap:16px;">
            <div style="width:56px; height:56px; background:#dc2626; color:white; border-radius:18px; display:flex; align-items:center; justify-content:center;">
                <i data-lucide="ticket" width="24" height="24"></i>
            </div>
            <div>
                <h1 style="font-size:2rem; margin:0;">Mes réservations</h1>
                <p style="margin:4px 0 0; color:#64748b;">Suivez chaque trajet réservé en un clin d'œil.</p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>trajets/recherche"
           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold text-white bg-brand-600 hover:bg-brand-700 transition-all duration-200"
           style="text-decoration:none;">
            <i data-lucide="search" width="16" height="16"></i> Rechercher un trajet
        </a>
    </div>

    <?php if(isset($_GET['success']) && $_GET['success'] == 'avis_envoye'): ?>
        <div style="background:#DCFCE7; color:#166534; padding:16px 20px; border-radius:12px; margin-bottom:24px; display:flex; align-items:center; gap:12px;">
            <i data-lucide="check-circle" width="20" height="20"></i> Merci ! Votre avis a bien été envoyé.
        </div>
    <?php endif; ?>

    <?php if(isset($_GET['error']) && $_GET['error'] == 'deja_note'): ?>
        <div style="background:#FEF3C7; color:#92400E; padding:16px 20px; border-radius:12px; margin-bottom:24px; display:flex; align-items:center; gap:12px;">
            <i data-lucide="alert-circle" width="20" height="20"></i> Vous avez déjà laissé un avis pour ce trajet.
        </div>
    <?php endif; ?>

    <?php if(empty($reservations)): ?>
        <div class="glass-panel" style="padding:60px 24px; text-align:center;">
            <div style="font-size:52px; color:#ef4444; margin-bottom:24px;">🎫</div>
            <h2 style="font-size:24px; margin-bottom:12px;">Aucune réservation pour le moment</h2>
            <p style="color:#64748b; margin-bottom:24px;">Vous n'avez pas encore réservé de trajet.</p>
            <a href="<?= BASE_URL ?>trajets/recherche"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold text-white bg-brand-600 hover:bg-brand-700 transition-all duration-200"
               style="text-decoration:none;">
                Chercher un trajet
            </a>
        </div>
    <?php else: ?>
        <div style="display:grid; gap:18px;">
            <?php foreach($reservations as $res): ?>
                <div class="glass-panel" style="padding:24px; display:grid; grid-template-columns:2fr 1fr; gap:20px; align-items:center;">
                    <div>
                        <div style="font-size:13px; color:#64748b; margin-bottom:10px; display:flex; gap:8px; align-items:center;">
                            <i data-lucide="calendar" width="14" height="14"></i> <?= date('d/m/Y', strtotime($res->date_trajet)) ?>
                            <span>|</span>
                            <i data-lucide="clock" width="14" height="14"></i> <?= substr($res->heure_depart, 0, 5) ?>
                        </div>
                        <h2 style="margin:0 0 10px; font-size:22px; font-weight:700;"><?= htmlspecialchars($res->ville_depart) ?> → <?= htmlspecialchars($res->ville_arrivee) ?></h2>
                        <p style="margin:0; color:#475569;">Conducteur : <strong><?= htmlspecialchars($res->conducteur_prenom . ' ' . $res->conducteur_nom) ?></strong></p>
                    </div>
                    <div style="display:flex; flex-direction:column; align-items:flex-end; gap:12px;">
                        <div style="text-align:right;">
                            <div style="font-size:18px; font-weight:700; color:#dc2626;"><?= number_format($res->prix_total, 0, ',', ' ') ?> F</div>
                            <div style="font-size:13px; color:#64748b;"><?= $res->places_reservees ?> place(s)</div>
                        </div>

                        <!-- Badge statut -->
                        <?php if($res->statut == 'en_attente'): ?>
                            <span style="padding:8px 14px; border-radius:999px; background:#FEF3C7; color:#92400E; font-size:13px; font-weight:600;">En attente</span>
                        <?php elseif($res->statut == 'confirmee'): ?>
                            <span style="padding:8px 14px; border-radius:999px; background:#DCFCE7; color:#166534; font-size:13px; font-weight:600;">Confirmée</span>
                        <?php elseif($res->statut == 'annulee'): ?>
                            <span style="padding:8px 14px; border-radius:999px; background:#FEE2E2; color:#991B1B; font-size:13px; font-weight:600;">Annulée</span>
                        <?php elseif($res->statut == 'terminee'): ?>
                            <span style="padding:8px 14px; border-radius:999px; background:#f1f5f9; color:#475569; font-size:13px; font-weight:600;">Terminée</span>
                        <?php endif; ?>

                        <!-- Boutons -->
                        <div style="display:flex; gap:8px; flex-wrap:wrap; justify-content:flex-end;">
                            <a href="<?= BASE_URL ?>passager/reservation/<?= $res->id ?>"
                               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold text-white bg-brand-600 hover:bg-brand-700 transition-all duration-200"
                               style="text-decoration:none;">
                                Suivre
                            </a>

                            <?php if(in_array($res->statut, ['en_attente', 'confirmee'], true)): ?>
                                <form action="<?= BASE_URL ?>passager/reservation/<?= $res->id ?>/annuler" method="POST"
                                      onsubmit="return confirm('Annuler cette réservation ?');">
                                    <button type="submit"
                                        style="padding:10px 16px; border-radius:10px; border:1px solid #fecaca; color:#b91c1c; background:white; font-weight:600; font-size:13px; cursor:pointer;">
                                        Annuler
                                    </button>
                                </form>
                            <?php endif; ?>

                            <!-- Bouton avis : visible uniquement si trajet terminé ET pas encore noté -->
                            <?php
                            $trajetTermine = ($res->statut === 'terminee') || (($res->trajet_statut ?? '') === 'termine');
                            $dejaNote = in_array((int)$res->trajet_id, $trajetsDejaNote);
                            ?>
                            <?php if($trajetTermine && !$dejaNote): ?>
                                <a href="<?= BASE_URL ?>passager/reservation/<?= $res->id ?>/avis"
                                   style="padding:10px 16px; border-radius:10px; background:#f59e0b; color:white; font-weight:600; font-size:13px; text-decoration:none; display:inline-flex; align-items:center; gap:6px;">
                                    ★ Laisser un avis
                                </a>
                            <?php elseif($trajetTermine && $dejaNote): ?>
                                <span style="padding:10px 16px; border-radius:10px; background:#f1f5f9; color:#94a3b8; font-size:13px; font-weight:600;">
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