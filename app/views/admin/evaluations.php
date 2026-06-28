<?php
/**
 * Vue : Administration — Gestion des évaluations
 * Chemin : app/views/admin/evaluations.php
 *
 * Variables attendues depuis AdminController::evaluations() :
 *   $evaluations  – tableau d'objets retournés par Avis::getAllForAdmin()
 *   $stats        – objet { total, note_moyenne, nb_5, nb_4, nb_3, nb_2, nb_1 }
 *
 * Structure d'un objet $evaluation (après JOIN dans getAllForAdmin) :
 *   id, note (1–5), commentaire, date_creation,
 *   auteur_prenom, auteur_nom, auteur_id,
 *   destinataire_prenom, destinataire_nom, destinataire_id,
 *   trajet_id, ville_depart, ville_arrivee   ← nullable si JOIN LEFT
 */

function renderStars(int $note, int $max = 5): string {
    $html = '';
    for ($i = 1; $i <= $max; $i++) {
        $fill = $i <= $note ? '#FBBF24' : '#E2E8F0';
        $html .= "<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='{$fill}' style='width:14px;height:14px;display:inline-block;'><path fill-rule='evenodd' d='M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z' clip-rule='evenodd'/></svg>";
    }
    return $html;
}
?>
<div class="max-w-7xl mx-auto my-10 px-6">

    <!-- EN-TÊTE -->
    <header class="bg-white/80 backdrop-blur-md border border-slate-200 rounded-3xl p-6 md:p-8 mb-10 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div class="flex items-center gap-5">
            <div class="w-14 h-14 bg-yellow-50 text-yellow-500 rounded-2xl flex items-center justify-center shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-display font-bold text-slate-900 m-0 leading-tight">Évaluations</h1>
                <p class="text-slate-500 text-sm mt-1">Avis laissés par les passagers sur les conducteurs.</p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>admin"
           class="inline-flex items-center gap-2 rounded-2xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-200 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
            Tableau de bord
        </a>
    </header>

    <?php if(isset($_GET['success'])): ?>
        <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-8 flex items-center gap-3 border border-green-200 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 shrink-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="font-semibold text-sm">Avis supprimé avec succès.</span>
        </div>
    <?php endif; ?>

    <!-- SYNTHÈSE NOTES -->
    <?php if(!empty($stats)): ?>
    <section class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 md:p-8 mb-10">
        <div class="flex flex-col md:flex-row gap-8 items-center">

            <!-- Note globale -->
            <div class="text-center shrink-0 px-6">
                <div class="text-6xl font-display font-bold text-slate-900 leading-none">
                    <?= number_format((float)($stats->note_moyenne ?? 0), 1) ?>
                </div>
                <div class="flex justify-center gap-0.5 my-3">
                    <?= renderStars((int)round($stats->note_moyenne ?? 0)) ?>
                </div>
                <div class="text-xs text-slate-500 font-medium"><?= (int)($stats->total ?? 0) ?> avis au total</div>
            </div>

            <!-- Barres de répartition -->
            <div class="flex-1 w-full space-y-2.5">
                <?php
                $total = max(1, (int)($stats->total ?? 0));
                for($n = 5; $n >= 1; $n--):
                    $key   = 'nb_' . $n;
                    $count = (int)($stats->$key ?? 0);
                    $pct   = round($count / $total * 100);
                ?>
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-1 w-12 shrink-0">
                        <span class="text-sm font-semibold text-slate-700"><?= $n ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#FBBF24" class="w-3.5 h-3.5">
                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1 h-2.5 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-yellow-400 rounded-full transition-all duration-700" style="width:<?= $pct ?>%"></div>
                    </div>
                    <span class="text-xs text-slate-500 w-8 text-right shrink-0"><?= $count ?></span>
                </div>
                <?php endfor; ?>
            </div>

        </div>
    </section>
    <?php endif; ?>

    <!-- FILTRES PAR NOTE -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 mb-6 flex flex-wrap gap-3 items-center">
        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider mr-1">Filtrer par note :</span>
        <?php
        $currentNote = $_GET['note'] ?? '';
        $noteOptions = ['' => 'Toutes', '5' => '5 ★', '4' => '4 ★', '3' => '3 ★', '2' => '2 ★', '1' => '1 ★'];
        foreach($noteOptions as $val => $label):
            $active = ($currentNote === (string)$val);
        ?>
        <a href="?note=<?= $val ?>"
           class="px-4 py-2 rounded-xl text-sm font-semibold transition-colors
                  <?= $active ? 'bg-yellow-400 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' ?>">
            <?= $label ?>
        </a>
        <?php endforeach; ?>
    </div>

    <!-- TABLE DES AVIS -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden mb-10">
        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
            <h2 class="font-display text-base font-bold text-slate-900">
                Liste des avis
                <?php if(!empty($evaluations)): ?>
                    <span class="ml-2 text-sm font-normal text-slate-400">(<?= count($evaluations) ?>)</span>
                <?php endif; ?>
            </h2>
            <button onclick="window.location.reload()"
                    class="p-2 bg-slate-50 text-slate-500 hover:text-slate-900 rounded-lg transition-colors"
                    title="Rafraîchir">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/>
                </svg>
            </button>
        </div>

        <?php if(empty($evaluations)): ?>
            <div class="text-center py-20">
                <div class="text-5xl mb-4">⭐</div>
                <p class="text-slate-400 font-medium text-sm">Aucun avis trouvé.</p>
                <?php if($currentNote): ?>
                    <a href="?" class="mt-3 inline-block text-brand-600 text-sm font-semibold hover:underline">Voir tous les avis</a>
                <?php endif; ?>
            </div>
        <?php else: ?>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50/50">
                        <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">#</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Passager</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Conducteur noté</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Note</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Commentaire</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Trajet</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach($evaluations as $ev): ?>
                    <?php
                        $noteColor = match(true) {
                            $ev->note >= 4 => 'text-green-600',
                            $ev->note == 3 => 'text-yellow-600',
                            default        => 'text-red-500',
                        };
                        $trajetLabel = !empty($ev->ville_depart) && !empty($ev->ville_arrivee)
                            ? htmlspecialchars($ev->ville_depart . ' → ' . $ev->ville_arrivee)
                            : null;
                    ?>
                    <tr class="group hover:bg-slate-50/60 transition-colors">

                        <!-- ID -->
                        <td class="px-6 py-4 text-sm font-mono text-slate-400">#<?= $ev->id ?></td>

                        <!-- Auteur (passager) -->
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center font-bold text-xs shrink-0">
                                    <?= mb_strtoupper(mb_substr($ev->auteur_prenom, 0, 1)) ?>
                                </div>
                                <a href="<?= BASE_URL ?>admin/utilisateur/<?= $ev->auteur_id ?>"
                                   class="text-sm font-semibold text-slate-800 hover:text-brand-600 transition-colors whitespace-nowrap">
                                    <?= htmlspecialchars($ev->auteur_prenom . ' ' . $ev->auteur_nom) ?>
                                </a>
                            </div>
                        </td>

                        <!-- Destinataire (conducteur évalué) -->
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-xs shrink-0">
                                    <?= mb_strtoupper(mb_substr($ev->destinataire_prenom ?? '?', 0, 1)) ?>
                                </div>
                                <a href="<?= BASE_URL ?>admin/utilisateur/<?= $ev->destinataire_id ?>"
                                   class="text-sm font-semibold text-slate-800 hover:text-brand-600 transition-colors whitespace-nowrap">
                                    <?= htmlspecialchars(($ev->destinataire_prenom ?? '') . ' ' . ($ev->destinataire_nom ?? '')) ?>
                                </a>
                            </div>
                        </td>

                        <!-- Note -->
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-1.5">
                                <span class="text-sm font-bold <?= $noteColor ?>"><?= $ev->note ?>/5</span>
                                <div class="flex gap-0.5"><?= renderStars((int)$ev->note) ?></div>
                            </div>
                        </td>

                        <!-- Commentaire -->
                        <td class="px-6 py-4 max-w-xs">
                            <?php if(!empty($ev->commentaire)): ?>
                                <p class="text-sm text-slate-600 leading-relaxed italic line-clamp-2">
                                    "<?= htmlspecialchars($ev->commentaire) ?>"
                                </p>
                            <?php else: ?>
                                <span class="text-xs text-slate-400 italic">Aucun commentaire</span>
                            <?php endif; ?>
                        </td>

                        <!-- Trajet -->
                        <td class="px-6 py-4">
                            <?php if($trajetLabel): ?>
                                <a href="<?= BASE_URL ?>admin/trajets?search=<?= urlencode($ev->ville_depart ?? '') ?>"
                                   class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-brand-50 text-brand-600 text-xs font-semibold hover:bg-brand-100 transition-colors whitespace-nowrap">
                                    <?= $trajetLabel ?>
                                </a>
                            <?php else: ?>
                                <span class="text-xs text-slate-400">—</span>
                            <?php endif; ?>
                        </td>

                        <!-- Date -->
                        <td class="px-6 py-4 text-sm text-slate-500 whitespace-nowrap">
                            <?= date('d M Y', strtotime($ev->date_creation)) ?>
                            <div class="text-xs text-slate-400"><?= date('H:i', strtotime($ev->date_creation)) ?></div>
                        </td>

                        <!-- Supprimer -->
                        <td class="px-6 py-4">
                            <div class="flex justify-end">
                                <form action="<?= BASE_URL ?>admin/evaluations/supprimer/<?= $ev->id ?>" method="POST"
                                      onsubmit="return confirm('Supprimer définitivement cet avis ? Cette action est irréversible.')">
                                    <button type="submit"
                                            class="p-2 rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-colors"
                                            title="Supprimer cet avis">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>

</div>