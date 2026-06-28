<div class="max-w-7xl mx-auto my-10 px-6">

    <!-- Header -->
    <header class="bg-white/80 backdrop-blur-md border border-slate-200 rounded-3xl p-6 md:p-8 mb-8 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div class="flex items-center gap-5">
            <div class="w-14 h-14 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-display font-bold text-slate-900 m-0 leading-tight">Gestion des réservations</h1>
                <p class="text-slate-500 text-sm mt-1">Consultez toutes les réservations et leur statut.</p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>admin/dashboard" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-brand-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 12m0 0l6-3M3 12h18" />
            </svg>
            Retour au dashboard
        </a>
    </header>

    <!-- Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex flex-col gap-1">
            <span class="text-2xl font-bold text-slate-900"><?= $nb_total ?></span>
            <span class="text-sm text-slate-500">Total</span>
        </div>
        <div class="bg-amber-50 rounded-2xl border border-amber-100 shadow-sm p-5 flex flex-col gap-1">
            <span class="text-2xl font-bold text-amber-600"><?= $nb_en_attente ?></span>
            <span class="text-sm text-amber-600">En attente</span>
        </div>
        <div class="bg-green-50 rounded-2xl border border-green-100 shadow-sm p-5 flex flex-col gap-1">
            <span class="text-2xl font-bold text-green-600"><?= $nb_confirmees ?></span>
            <span class="text-sm text-green-600">Confirmées</span>
        </div>
        <div class="bg-red-50 rounded-2xl border border-red-100 shadow-sm p-5 flex flex-col gap-1">
            <span class="text-2xl font-bold text-red-500"><?= $nb_annulees ?></span>
            <span class="text-sm text-red-500">Annulées</span>
        </div>
    </div>

    <!-- Filtres -->
    <section class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 mb-6">
        <form method="GET" action="<?= BASE_URL ?>admin/reservations" class="flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-1">
                <label class="block text-sm font-medium text-slate-700 mb-2">Recherche</label>
                <input type="text" name="search" value="<?= htmlspecialchars($filters['search']) ?>"
                       placeholder="Nom passager, conducteur, ville..."
                       class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-brand-500 focus:outline-none">
            </div>
            <div class="w-full md:w-56">
                <label class="block text-sm font-medium text-slate-700 mb-2">Statut</label>
                <select name="statut" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-brand-500 focus:outline-none">
                    <option value="">Tous les statuts</option>
                    <option value="en_attente"  <?= $filters['statut'] === 'en_attente'  ? 'selected' : '' ?>>En attente</option>
                    <option value="confirmee"   <?= $filters['statut'] === 'confirmee'   ? 'selected' : '' ?>>Confirmée</option>
                    <option value="annulee"     <?= $filters['statut'] === 'annulee'     ? 'selected' : '' ?>>Annulée</option>
                    <option value="terminee"    <?= $filters['statut'] === 'terminee'    ? 'selected' : '' ?>>Terminée</option>
                </select>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-brand-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-brand-700 transition-colors">Filtrer</button>
                <a href="<?= BASE_URL ?>admin/reservations" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition-colors">Réinitialiser</a>
            </div>
        </form>
    </section>

    <!-- Tableau -->
    <section class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <?php if (empty($reservations)): ?>
            <div class="py-20 text-center text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto mb-3 opacity-40">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <p class="font-medium">Aucune réservation trouvée.</p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/60">
                            <th class="px-6 py-4 text-left font-semibold text-slate-500 text-xs uppercase tracking-wider">#</th>
                            <th class="px-6 py-4 text-left font-semibold text-slate-500 text-xs uppercase tracking-wider">Trajet</th>
                            <th class="px-6 py-4 text-left font-semibold text-slate-500 text-xs uppercase tracking-wider">Passager</th>
                            <th class="px-6 py-4 text-left font-semibold text-slate-500 text-xs uppercase tracking-wider">Conducteur</th>
                            <th class="px-6 py-4 text-left font-semibold text-slate-500 text-xs uppercase tracking-wider">Places</th>
                            <th class="px-6 py-4 text-left font-semibold text-slate-500 text-xs uppercase tracking-wider">Prix</th>
                            <th class="px-6 py-4 text-left font-semibold text-slate-500 text-xs uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-4 text-left font-semibold text-slate-500 text-xs uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php foreach ($reservations as $r): ?>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <!-- ID -->
                            <td class="px-6 py-4 text-slate-400 font-mono text-xs">#<?= $r->id ?></td>

                            <!-- Trajet -->
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-0.5">
                                    <span class="font-semibold text-slate-800">
                                        <?= htmlspecialchars($r->ville_depart) ?>
                                        <span class="text-brand-500 mx-1">→</span>
                                        <?= htmlspecialchars($r->ville_arrivee) ?>
                                    </span>
                                    <span class="text-xs text-slate-400">
                                        <?= date('d M Y', strtotime($r->date_trajet)) ?>
                                        <?php if (!empty($r->heure_depart)): ?>
                                            à <?= substr($r->heure_depart, 0, 5) ?>
                                        <?php endif; ?>
                                    </span>
                                </div>
                            </td>

                            <!-- Passager -->
                            <td class="px-6 py-4">
                                <a href="<?= BASE_URL ?>admin/utilisateur/<?= $r->passager_id ?>"
                                   class="flex flex-col hover:text-brand-600 transition-colors">
                                    <span class="font-medium text-slate-800"><?= htmlspecialchars($r->passager_prenom . ' ' . $r->passager_nom) ?></span>
                                    <span class="text-xs text-slate-400"><?= htmlspecialchars($r->passager_email) ?></span>
                                </a>
                            </td>

                            <!-- Conducteur -->
                            <td class="px-6 py-4">
                                <a href="<?= BASE_URL ?>admin/utilisateur/<?= $r->conducteur_id ?>"
                                   class="flex flex-col hover:text-brand-600 transition-colors">
                                    <span class="font-medium text-slate-800"><?= htmlspecialchars($r->conducteur_prenom . ' ' . $r->conducteur_nom) ?></span>
                                    <span class="text-xs text-slate-400"><?= htmlspecialchars($r->conducteur_email) ?></span>
                                </a>
                            </td>

                            <!-- Places -->
                            <td class="px-6 py-4 text-slate-700 font-medium"><?= $r->places_reservees ?></td>

                            <!-- Prix -->
                            <td class="px-6 py-4 font-semibold text-slate-800">
                                <?= number_format($r->prix_total, 0, ',', ' ') ?> <span class="text-xs font-normal text-slate-400">FCFA</span>
                            </td>

                            <!-- Statut -->
                            <td class="px-6 py-4">
                                <?php
                                $badge = match($r->statut) {
                                    'en_attente' => ['bg-amber-50 text-amber-700 border border-amber-200',   'En attente'],
                                    'confirmee'  => ['bg-green-50 text-green-700 border border-green-200',   'Confirmée'],
                                    'annulee'    => ['bg-red-50 text-red-600 border border-red-200',         'Annulée'],
                                    'terminee'   => ['bg-slate-100 text-slate-500 border border-slate-200',  'Terminée'],
                                    default      => ['bg-slate-100 text-slate-500 border border-slate-200',  ucfirst($r->statut)],
                                };
                                ?>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold <?= $badge[0] ?>">
                                    <?= $badge[1] ?>
                                </span>
                            </td>

                            <!-- Date réservation -->
                            <td class="px-6 py-4 text-slate-500 text-xs">
                                <?= date('d M Y', strtotime($r->date_reservation)) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-slate-100 text-xs text-slate-400">
                <?= count($reservations) ?> réservation<?= count($reservations) > 1 ? 's' : '' ?> affichée<?= count($reservations) > 1 ? 's' : '' ?>
            </div>
        <?php endif; ?>
    </section>
</div>