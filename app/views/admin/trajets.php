<div class="max-w-7xl mx-auto my-10 px-6">
    <header class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-display font-bold text-slate-900 m-0 leading-tight">Tous les trajets</h1>
            <p class="text-slate-500 mt-2">Vue complète des trajets publiés par les conducteurs.</p>
        </div>
        <a href="<?= BASE_URL ?>admin/dashboard" class="inline-flex items-center gap-2 rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-slate-700 transition-colors">
            Revenir au dashboard
        </a>
    </header>

    <section class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 mb-8">
        <form method="GET" action="<?= BASE_URL ?>admin/trajets" class="grid gap-4 md:grid-cols-4 items-end">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2" for="ville_depart">Ville de départ</label>
                <input id="ville_depart" name="ville_depart" type="text" value="<?= htmlspecialchars($filters['ville_depart'] ?? '') ?>" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-brand-500 focus:outline-none" placeholder="Dakar, Thiès...">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2" for="ville_arrivee">Ville d'arrivée</label>
                <input id="ville_arrivee" name="ville_arrivee" type="text" value="<?= htmlspecialchars($filters['ville_arrivee'] ?? '') ?>" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-brand-500 focus:outline-none" placeholder="Rufisque, Diamniadio...">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2" for="statut">Statut</label>
                <select id="statut" name="statut" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-brand-500 focus:outline-none">
                    <option value="">Tous les statuts</option>
                    <option value="planifie" <?= isset($filters['statut']) && $filters['statut'] === 'planifie' ? 'selected' : '' ?>>Planifié</option>
                    <option value="termine" <?= isset($filters['statut']) && $filters['statut'] === 'termine' ? 'selected' : '' ?>>Terminé</option>
                    <option value="annule" <?= isset($filters['statut']) && $filters['statut'] === 'annule' ? 'selected' : '' ?>>Annulé</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2" for="conducteur_id">Conducteur</label>
                <select id="conducteur_id" name="conducteur_id" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-brand-500 focus:outline-none">
                    <option value="">Tous les conducteurs</option>
                    <?php if(!empty($conducteurs)): ?>
                        <?php foreach($conducteurs as $conducteur): ?>
                            <option value="<?= intval($conducteur->id) ?>" <?= isset($filters['conducteur_id']) && (int)$filters['conducteur_id'] === (int)$conducteur->id ? 'selected' : '' ?>><?= htmlspecialchars($conducteur->prenom . ' ' . $conducteur->nom) ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="md:col-span-4 flex items-center gap-3">
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-brand-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-brand-700 transition-colors">Filtrer</button>
                <a href="<?= BASE_URL ?>admin/trajets" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition-colors">Réinitialiser</a>
            </div>
        </form>

        <div class="mt-4 text-sm text-slate-600">
            <?php if(!empty($filters['statut']) || !empty($filters['conducteur_id'])): ?>
                <span class="font-semibold"><?= count($trajets) ?></span> trajet(s) affiché(s) selon les filtres sélectionnés.
            <?php else: ?>
                <span class="font-semibold"><?= count($trajets) ?></span> trajet(s) total(s).
            <?php endif; ?>
        </div>
    </section>

    <?php if(empty($trajets)): ?>
        <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 text-slate-600">
            <p class="font-semibold">Aucun trajet trouvé pour le moment.</p>
            <p class="mt-2 text-sm">Les utilisateurs n'ont pas encore publié de trajet ou les données sont absentes.</p>
        </div>
    <?php else: ?>
        <div class="overflow-x-auto bg-white rounded-3xl shadow-sm border border-slate-100">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50">
                        <th class="px-6 py-4 text-sm font-semibold text-slate-500 uppercase tracking-wide">Trajet</th>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-500 uppercase tracking-wide">Conducteur</th>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-500 uppercase tracking-wide">Date / Heure</th>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-500 uppercase tracking-wide">Places</th>
                        <th class="px-6 py-4 text-sm font-semibold text-slate-500 uppercase tracking-wide">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach($trajets as $trajet): ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 align-top">
                                <div class="font-semibold text-slate-900"><?= htmlspecialchars($trajet->ville_depart . ' → ' . $trajet->ville_arrivee) ?></div>
                                <div class="text-sm text-slate-500">Départ : <?= htmlspecialchars($trajet->point_depart ?: 'Non défini') ?></div>
                                <div class="text-sm text-slate-500">Arrivée : <?= htmlspecialchars($trajet->point_arrivee ?: 'Non défini') ?></div>
                            </td>
                            <td class="px-6 py-4 align-top">
                                <div class="font-semibold text-slate-900"><?= htmlspecialchars($trajet->conducteur_prenom . ' ' . $trajet->conducteur_nom) ?></div>
                                <div class="text-sm text-slate-500">Tel: <?= htmlspecialchars($trajet->conducteur_tel) ?></div>
                            </td>
                            <td class="px-6 py-4 align-top text-sm text-slate-700">
                                <?= date('d/m/Y', strtotime($trajet->date_trajet)) ?>
                                <div class="text-slate-500 mt-1"><?= substr($trajet->heure_depart, 0, 5) ?></div>
                            </td>
                            <td class="px-6 py-4 align-top text-sm text-slate-700">
                                <?= intval($trajet->places_disponibles) ?> / <?= intval($trajet->places_totales) ?> places
                            </td>
                            <td class="px-6 py-4 align-top text-sm font-semibold <?= $trajet->statut === 'planifie' ? 'text-emerald-600' : 'text-slate-500' ?>">
                                <?= htmlspecialchars(ucfirst($trajet->statut)) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
