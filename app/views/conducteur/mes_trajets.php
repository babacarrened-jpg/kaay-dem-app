<div style="max-width: 1100px; margin: 40px auto; padding: 0 20px;">

    <div class="page-header" style="display:flex; justify-content:space-between; align-items:center; gap:20px; margin-bottom:32px;">
        <div class="page-title-group" style="display:flex; align-items:center; gap:16px;">
            <div class="page-title-icon" style="width:56px; height:56px; background:#dc2626; color:white; border-radius:18px; display:flex; align-items:center; justify-content:center;">
                <i data-lucide="car" width="24" height="24"></i>
            </div>
            <div>
                <h1 style="font-size:2rem; margin:0;">Mes trajets</h1>
                <p style="margin:4px 0 0; color:#64748b;">Consultez les trajets que vous avez publiés.</p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>conducteur/trajets/nouveau"
           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold text-white bg-brand-600 hover:bg-brand-700 hover:-translate-y-0.5 transition-all duration-200 shadow-md hover:shadow-lg"
           style="text-decoration:none;">
            <i data-lucide="plus-circle" width="18" height="18" style="vertical-align:middle;"></i>
            Nouveau trajet
        </a>
    </div>

    <?php if(isset($_GET['success']) && $_GET['success'] == 'trajet_annule'): ?>
        <div style="background:#DCFCE7; color:#166534; padding:16px 20px; border-radius:12px; margin-bottom:24px; display:flex; align-items:center; gap:12px;">
            <i data-lucide="check-circle" width="20" height="20"></i> Le trajet a bien été annulé.
        </div>
    <?php endif; ?>

    <?php if(isset($_GET['success']) && $_GET['success'] == 'trajet_termine'): ?>
        <div style="background:#DCFCE7; color:#166534; padding:16px 20px; border-radius:12px; margin-bottom:24px; display:flex; align-items:center; gap:12px;">
            <i data-lucide="check-circle" width="20" height="20"></i> Le trajet a bien été marqué comme terminé.
        </div>
    <?php endif; ?>

    <?php if(isset($_GET['error']) && $_GET['error'] == 'annulation_impossible'): ?>
        <div style="background:#FEE2E2; color:#991B1B; padding:16px 20px; border-radius:12px; margin-bottom:24px; display:flex; align-items:center; gap:12px;">
            <i data-lucide="alert-circle" width="20" height="20"></i> Impossible d'annuler : une réservation a déjà été confirmée.
        </div>
    <?php endif; ?>

    <?php if(isset($_GET['error']) && $_GET['error'] == 'cloture_impossible'): ?>
        <div style="background:#FEE2E2; color:#991B1B; padding:16px 20px; border-radius:12px; margin-bottom:24px; display:flex; align-items:center; gap:12px;">
            <i data-lucide="alert-circle" width="20" height="20"></i> Impossible de terminer ce trajet.
        </div>
    <?php endif; ?>

    <?php if(empty($trajets)): ?>
        <div class="glass-panel" style="padding:60px 24px; text-align:center;">
            <div style="font-size:52px; margin-bottom:24px;">🚗</div>
            <h2 style="font-size:24px; margin-bottom:12px;">Aucun trajet publié</h2>
            <p style="color:#64748b; margin-bottom:24px;">Publiez votre premier trajet pour permettre aux passagers de réserver.</p>
            <a href="<?= BASE_URL ?>conducteur/trajets/nouveau"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold text-white bg-brand-600 hover:bg-brand-700 transition-all duration-200"
               style="text-decoration:none;">
                <i data-lucide="plus-circle" width="16" height="16" style="vertical-align:middle;"></i> Publier un trajet
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
                <div class="glass-panel" style="padding:24px;">
                    <div style="display:flex; justify-content:space-between; flex-wrap:wrap; gap:20px; align-items:flex-start;">

                        <!-- Infos trajet -->
                        <div style="flex:1;">
                            <h2 style="font-size:22px; margin-bottom:8px;"><?= htmlspecialchars($trajet->ville_depart) ?> → <?= htmlspecialchars($trajet->ville_arrivee) ?></h2>
                            <div style="color:#64748b; font-size:14px; margin-bottom:10px; display:flex; gap:12px; flex-wrap:wrap;">
                                <span><strong>Date :</strong> <?= htmlspecialchars($trajet->date_trajet) ?></span>
                                <span><strong>Départ :</strong> <?= substr($trajet->heure_depart, 0, 5) ?></span>
                                <span><strong>Places :</strong> <?= htmlspecialchars($trajet->places_disponibles) ?>/<?= htmlspecialchars($trajet->places_totales) ?></span>
                            </div>
                            <p style="color:#475569; margin:0; line-height:1.7;"><?= nl2br(htmlspecialchars($trajet->description ?: 'Aucune description fournie.')) ?></p>
                        </div>

                        <!-- Boutons -->
                        <div style="min-width:200px; display:flex; flex-direction:column; gap:10px; align-items:flex-end;">
                            <div style="font-size:18px; font-weight:700; color:#dc2626;"><?= number_format($trajet->prix_par_place, 0, ',', ' ') ?> F</div>
                            <span style="padding:8px 16px; border-radius:999px; font-size:13px; font-weight:600; background:<?= $statutInfo['bg'] ?>; color:<?= $statutInfo['color'] ?>;">
                                <?= $statutInfo['label'] ?>
                            </span>

                            <!-- Voir les passagers -->
                            <a href="<?= BASE_URL ?>conducteur/trajet/<?= $trajet->id ?>/passagers"
                               class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold text-white bg-brand-600 hover:bg-brand-700 hover:-translate-y-0.5 transition-all duration-200 shadow-sm hover:shadow-md"
                               style="text-decoration:none;">
                                <i data-lucide="users" width="14" height="14" style="vertical-align:middle;"></i>
                                Voir les passagers
                            </a>

                            <?php if(in_array($trajet->statut, ['planifie', 'en_cours'], true)): ?>

                                <!-- Terminer -->
                                <form action="<?= BASE_URL ?>conducteur/trajet/<?= $trajet->id ?>/terminer" method="POST"
                                      onsubmit="return confirm('Marquer ce trajet comme terminé ?');" style="width:100%;">
                                    <button type="submit"
                                        class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold text-white transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5"
                                        style="background:#16a34a; border:none; cursor:pointer;"
                                        onmouseover="this.style.background='#15803d';"
                                        onmouseout="this.style.background='#16a34a';">
                                        <i data-lucide="check-circle" width="14" height="14" style="vertical-align:middle;"></i>
                                        Terminer le trajet
                                    </button>
                                </form>

                                <!-- Annuler -->
                                <form action="<?= BASE_URL ?>conducteur/trajet/<?= $trajet->id ?>/annuler" method="POST"
                                      onsubmit="return confirm('Annuler ce trajet ? Cette action est irréversible.');" style="width:100%;">
                                    <button type="submit"
                                        class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold text-white transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5"
                                        style="background:#dc2626; border:none; cursor:pointer;"
                                        onmouseover="this.style.background='#b91c1c';"
                                        onmouseout="this.style.background='#dc2626';">
                                        <i data-lucide="x-circle" width="14" height="14" style="vertical-align:middle;"></i>
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