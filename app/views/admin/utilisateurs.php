<div class="max-w-7xl mx-auto my-10 px-6">

    <header class="bg-white/80 backdrop-blur-md border border-slate-200 rounded-3xl p-6 md:p-8 mb-8 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div class="flex items-center gap-5">
            <div class="w-14 h-14 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-display font-bold text-slate-900 m-0 leading-tight">Gestion des utilisateurs</h1>
                <p class="text-slate-500 text-sm mt-1">Recherchez, consultez et gérez les comptes.</p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>admin/dashboard" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-brand-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 12m0 0l6-3m-6 3V5.25A2.25 2.25 0 015.25 3h13.5A2.25 2.25 0 0121 5.25v13.5A2.25 2.25 0 0118.75 21H5.25A2.25 2.25 0 013 18.75" />
            </svg>
            Retour au dashboard
        </a>
    </header>

    <?php if(isset($_GET['success'])): ?>
        <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-6 flex items-center gap-3 border border-green-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-semibold text-sm">
                <?php
                $msgs = ['supprime' => 'Utilisateur supprimé avec succès.'];
                echo $msgs[$_GET['success']] ?? 'Action effectuée avec succès.';
                ?>
            </span>
        </div>
    <?php endif; ?>
    <?php if(isset($_GET['error'])): ?>
        <div class="bg-red-50 text-red-700 p-4 rounded-xl mb-6 flex items-center gap-3 border border-red-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <span class="font-semibold text-sm">
                <?php
                $errs = [
                    'auto_suppression' => 'Vous ne pouvez pas supprimer votre propre compte.',
                    'echec_suppression' => 'Échec de la suppression.',
                    'introuvable' => 'Utilisateur introuvable.',
                ];
                echo $errs[$_GET['error']] ?? 'Une erreur est survenue.';
                ?>
            </span>
        </div>
    <?php endif; ?>

    <!-- Stats rapides -->
    <section class="grid grid-cols-3 gap-4 mb-8">
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
            <div class="text-2xl font-bold text-slate-900"><?= count($users) ?></div>
            <div class="text-xs text-slate-500 mt-1">Résultats affichés</div>
        </div>
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
            <div class="text-2xl font-bold text-green-600"><?= $nb_actifs ?></div>
            <div class="text-xs text-slate-500 mt-1">Comptes actifs</div>
        </div>
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
            <div class="text-2xl font-bold text-red-500"><?= $nb_suspendus ?></div>
            <div class="text-xs text-slate-500 mt-1">Comptes suspendus</div>
        </div>
    </section>

    <!-- Recherche -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 mb-8">
        <form action="<?= BASE_URL ?>admin/utilisateurs" method="GET" class="flex gap-3">
            <div class="relative flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" 
                       placeholder="Rechercher par nom, prénom, email ou téléphone..."
                       class="w-full pl-12 pr-4 py-3 rounded-2xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition-all text-sm">
            </div>
            <button type="submit" class="px-6 py-3 bg-brand-600 text-white rounded-2xl font-semibold text-sm hover:bg-brand-700 transition-colors">
                Rechercher
            </button>
            <?php if(!empty($search)): ?>
                <a href="<?= BASE_URL ?>admin/utilisateurs" class="px-4 py-3 bg-slate-100 text-slate-600 rounded-2xl font-semibold text-sm hover:bg-slate-200 transition-colors">
                    Effacer
                </a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Tableau -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50">
                        <th class="px-6 py-4 font-semibold text-xs text-slate-400 uppercase tracking-wider">Utilisateur</th>
                        <th class="px-6 py-4 font-semibold text-xs text-slate-400 uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-4 font-semibold text-xs text-slate-400 uppercase tracking-wider">Rôle</th>
                        <th class="px-6 py-4 font-semibold text-xs text-slate-400 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-4 font-semibold text-xs text-slate-400 uppercase tracking-wider">Inscription</th>
                        <th class="px-6 py-4 font-semibold text-xs text-slate-400 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php if(empty($users)): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-slate-300">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0z" />
                                </svg>
                            </div>
                            <p class="text-slate-400 font-medium text-sm">Aucun utilisateur trouvé.</p>
                        </td>
                    </tr>
                    <?php else: ?>
                        <?php foreach($users as $u): ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center font-bold text-sm shrink-0">
                                        <?= strtoupper(substr($u->prenom, 0, 1)) ?>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-slate-900 text-sm"><?= htmlspecialchars($u->prenom . ' ' . $u->nom) ?></div>
                                        <div class="text-xs text-slate-400">ID #<?= $u->id ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-slate-700"><?= htmlspecialchars($u->email) ?></div>
                                <div class="text-xs text-slate-400"><?= htmlspecialchars($u->telephone) ?></div>
                            </td>
                            <td class="px-6 py-4">
                                <?php
                                $roleColors = [
                                    'admin' => 'bg-red-50 text-red-600',
                                    'conducteur' => 'bg-indigo-50 text-indigo-600',
                                    'passager' => 'bg-sky-50 text-sky-600',
                                ];
                                $rc = $roleColors[$u->role] ?? 'bg-slate-50 text-slate-600';
                                ?>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold <?= $rc ?>">
                                    <?= ucfirst($u->role) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <?php if($u->statut === 'actif'): ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        Actif
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                        Suspendu
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500">
                                <?= date('d M Y', strtotime($u->date_inscription)) ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="<?= BASE_URL ?>admin/voirUtilisateur/<?= $u->id ?>" 
                                       class="p-2 rounded-lg bg-slate-50 text-slate-600 hover:bg-brand-600 hover:text-white transition-colors" 
                                       title="Voir le profil">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
