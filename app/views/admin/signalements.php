<div class="max-w-7xl mx-auto my-10 px-6">

    <!-- En-tête -->
    <header class="bg-white/80 backdrop-blur-md border border-slate-200 rounded-3xl p-6 md:p-8 mb-10 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div class="flex items-center gap-5">
            <div class="w-14 h-14 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0l2.77-.693a14.267 14.267 0 014.622 0s2.77.693 4.513.693c1.744 0 3.203-.693 3.203-.693M3 15h12.5M3 4.5l2.77.693a14.267 14.267 0 004.622 0s2.77-.693 4.513-.693c1.744 0 3.203.693 3.203.693M3 4.5h12.5" />
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-display font-bold text-slate-900 m-0 leading-tight">Gestion des Signalements</h1>
                <p class="text-slate-500 text-sm mt-1">Suivez et traitez les signalements des utilisateurs.</p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>admin/dashboard" class="inline-flex items-center gap-2 rounded-2xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-200 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Retour au tableau de bord
        </a>
    </header>

    <!-- Messages de succès -->
    <?php if(isset($_GET['success'])): ?>
        <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-8 flex items-center gap-3 border border-green-200 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-semibold text-sm">
                <?php
                    $msgs = [
                        'statut_modifie'      => 'Le statut du signalement a été mis à jour.',
                        'signalement_supprime' => 'Le signalement a été supprimé avec succès.',
                    ];
                    echo $msgs[$_GET['success']] ?? 'Action effectuée avec succès !';
                ?>
            </span>
        </div>
    <?php endif; ?>

    <!-- KPIs -->
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-10">
        <div class="bg-white p-5 rounded-3xl shadow-sm border border-slate-100 flex justify-between items-start hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl bg-slate-50 text-slate-600 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0l2.77-.693a14.267 14.267 0 014.622 0s2.77.693 4.513.693c1.744 0 3.203-.693 3.203-.693M3 15h12.5M3 4.5l2.77.693a14.267 14.267 0 004.622 0s2.77-.693 4.513-.693c1.744 0 3.203.693 3.203.693M3 4.5h12.5" />
                </svg>
            </div>
            <div class="text-right">
                <div class="font-display text-3xl font-bold text-slate-900 leading-none mb-1"><?= (int)($stats->total ?? 0) ?></div>
                <div class="text-xs font-medium text-slate-500">Total signalements</div>
            </div>
        </div>

        <div class="bg-white p-5 rounded-3xl shadow-sm border border-slate-100 flex justify-between items-start hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
            </div>
            <div class="text-right">
                <div class="font-display text-3xl font-bold text-red-600 leading-none mb-1"><?= (int)($stats->nb_nouveaux ?? 0) ?></div>
                <div class="text-xs font-medium text-slate-500">Nouveaux</div>
            </div>
        </div>

        <div class="bg-white p-5 rounded-3xl shadow-sm border border-slate-100 flex justify-between items-start hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl bg-yellow-50 text-yellow-600 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="text-right">
                <div class="font-display text-3xl font-bold text-yellow-600 leading-none mb-1"><?= (int)($stats->nb_en_cours ?? 0) ?></div>
                <div class="text-xs font-medium text-slate-500">En cours</div>
            </div>
        </div>

        <div class="bg-white p-5 rounded-3xl shadow-sm border border-slate-100 flex justify-between items-start hover:-translate-y-1 hover:shadow-md transition-all duration-300">
            <div class="w-12 h-12 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="text-right">
                <div class="font-display text-3xl font-bold text-green-600 leading-none mb-1"><?= (int)($stats->nb_traites ?? 0) ?></div>
                <div class="text-xs font-medium text-slate-500">Traités</div>
            </div>
        </div>
    </section>

    <!-- Filtres -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 mb-8">
        <form method="GET" action="<?= BASE_URL ?>admin/signalements" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-1">
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Statut</label>
                <select name="statut" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all">
                    <option value="">Tous les statuts</option>
                    <option value="nouveau" <?= (isset($filters['statut']) && $filters['statut'] === 'nouveau') ? 'selected' : '' ?>>🔴 Nouveau</option>
                    <option value="en_cours" <?= (isset($filters['statut']) && $filters['statut'] === 'en_cours') ? 'selected' : '' ?>>🟡 En cours</option>
                    <option value="traite" <?= (isset($filters['statut']) && $filters['statut'] === 'traite') ? 'selected' : '' ?>>🟢 Traité</option>
                </select>
            </div>
            <div class="flex-1">
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Rechercher par motif</label>
                <input type="text" name="motif" value="<?= htmlspecialchars($filters['motif'] ?? '') ?>" placeholder="Ex: comportement, trajet non effectué..."
                       class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-brand-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-brand-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    Filtrer
                </button>
                <a href="<?= BASE_URL ?>admin/signalements" class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-600 hover:bg-slate-200 transition-colors">
                    Réinitialiser
                </a>
            </div>
        </form>
    </div>

    <!-- Tableau des signalements -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 md:px-8 py-6 border-b border-slate-100 flex justify-between items-center">
            <div>
                <h2 class="font-display text-xl font-bold text-slate-900">Liste des signalements</h2>
                <p class="text-sm text-slate-500 mt-1"><?= count($signalements) ?> signalement<?= count($signalements) > 1 ? 's' : '' ?> trouvé<?= count($signalements) > 1 ? 's' : '' ?></p>
            </div>
        </div>

        <?php if(empty($signalements)): ?>
            <div class="text-center py-16">
                <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-slate-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="text-slate-400 font-medium text-sm">Aucun signalement trouvé</p>
                <p class="text-slate-300 text-xs mt-1">Modifiez vos filtres ou revenez plus tard.</p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/50">
                            <th class="px-6 py-4 font-semibold text-xs text-slate-400 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 font-semibold text-xs text-slate-400 uppercase tracking-wider">Signalé par</th>
                            <th class="px-6 py-4 font-semibold text-xs text-slate-400 uppercase tracking-wider">Personne concernée</th>
                            <th class="px-6 py-4 font-semibold text-xs text-slate-400 uppercase tracking-wider">Motif</th>
                            <th class="px-6 py-4 font-semibold text-xs text-slate-400 uppercase tracking-wider">Trajet</th>
                            <th class="px-6 py-4 font-semibold text-xs text-slate-400 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 font-semibold text-xs text-slate-400 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-4 font-semibold text-xs text-slate-400 uppercase tracking-wider text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php foreach($signalements as $signalement): ?>
                            <tr class="group hover:bg-slate-50/80 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="text-xs font-bold text-slate-400">#<?= $signalement->id ?></span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center font-bold text-xs">
                                            <?= mb_strtoupper(mb_substr($signalement->auteur_prenom, 0, 1)) ?>
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-slate-900"><?= htmlspecialchars($signalement->auteur_prenom . ' ' . $signalement->auteur_nom) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-red-50 text-red-600 flex items-center justify-center font-bold text-xs">
                                            <?= mb_strtoupper(mb_substr($signalement->concerne_prenom, 0, 1)) ?>
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-slate-900"><?= htmlspecialchars($signalement->concerne_prenom . ' ' . $signalement->concerne_nom) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold">
                                        <?= htmlspecialchars($signalement->motif) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    <?php if($signalement->trajet_id): ?>
                                        <span class="text-xs font-medium"><?= htmlspecialchars($signalement->ville_depart) ?> → <?= htmlspecialchars($signalement->ville_arrivee) ?></span>
                                    <?php else: ?>
                                        <span class="text-xs text-slate-400 italic">Non lié</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500 font-medium">
                                    <?= date('d/m/Y', strtotime($signalement->date_creation)) ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php
                                        $statutConfig = [
                                            'nouveau'  => ['bg' => 'bg-red-50', 'text' => 'text-red-700', 'dot' => 'bg-red-500', 'label' => 'Nouveau'],
                                            'en_cours' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-700', 'dot' => 'bg-yellow-500', 'label' => 'En cours'],
                                            'traite'   => ['bg' => 'bg-green-50', 'text' => 'text-green-700', 'dot' => 'bg-green-500', 'label' => 'Traité'],
                                        ];
                                        $sc = $statutConfig[$signalement->statut] ?? $statutConfig['nouveau'];
                                    ?>
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full <?= $sc['bg'] ?> <?= $sc['text'] ?> text-xs font-semibold">
                                        <span class="w-2 h-2 rounded-full <?= $sc['dot'] ?>"></span>
                                        <?= $sc['label'] ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <!-- Changer statut -->
                                        <?php if($signalement->statut === 'nouveau'): ?>
                                            <form action="<?= BASE_URL ?>admin/signalement/<?= $signalement->id ?>/statut" method="POST" class="m-0">
                                                <input type="hidden" name="statut" value="en_cours">
                                                <button type="submit" class="p-2 rounded-lg bg-yellow-50 text-yellow-600 hover:bg-yellow-500 hover:text-white transition-colors" title="Prendre en charge">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        <?php endif; ?>

                                        <?php if($signalement->statut === 'en_cours'): ?>
                                            <form action="<?= BASE_URL ?>admin/signalement/<?= $signalement->id ?>/statut" method="POST" class="m-0">
                                                <input type="hidden" name="statut" value="traite">
                                                <button type="submit" class="p-2 rounded-lg bg-green-50 text-green-600 hover:bg-green-500 hover:text-white transition-colors" title="Marquer comme traité">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                    </svg>
                                                </button>
                                            </form>
                                        <?php endif; ?>

                                        <!-- Voir détail -->
                                        <a href="<?= BASE_URL ?>admin/signalement/<?= $signalement->id ?>" class="p-2 rounded-lg bg-brand-50 text-brand-600 hover:bg-brand-500 hover:text-white transition-colors" title="Voir le détail">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </a>

                                        <!-- Supprimer -->
                                        <form action="<?= BASE_URL ?>admin/signalement/<?= $signalement->id ?>/supprimer" method="POST" class="m-0" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce signalement ?');">
                                            <button type="submit" class="p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-500 hover:text-white transition-colors" title="Supprimer">
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