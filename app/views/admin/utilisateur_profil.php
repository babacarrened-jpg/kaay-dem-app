<div class="max-w-5xl mx-auto my-10 px-6">

    <header class="mb-8">
        <a href="<?= BASE_URL ?>admin/utilisateurs" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-brand-600 transition-colors mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 12m0 0l6-3m-6 3V5.25A2.25 2.25 0 015.25 3h13.5A2.25 2.25 0 0121 5.25v13.5A2.25 2.25 0 0118.75 21H5.25A2.25 2.25 0 013 18.75" />
            </svg>
            Retour à la liste
        </a>
    </header>

    <?php if(isset($_GET['success'])): ?>
        <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-6 flex items-center gap-3 border border-green-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-semibold text-sm">
                <?php
                $msgs = [
                    'modifie' => 'Informations mises à jour avec succès.',
                    'suspendu' => 'Utilisateur suspendu.',
                    'reactive' => 'Utilisateur réactivé.',
                ];
                echo $msgs[$_GET['success']] ?? 'Action réussie.';
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
                    'auto_modification' => 'Vous ne pouvez pas modifier votre propre compte ici.',
                    'auto_suspension' => 'Vous ne pouvez pas suspendre votre propre compte.',
                    'echec' => 'Échec de l\'opération.',
                ];
                echo $errs[$_GET['error']] ?? 'Une erreur est survenue.';
                ?>
            </span>
        </div>
    <?php endif; ?>

    <!-- Carte profil -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden mb-8">
        <div class="bg-gradient-to-r from-brand-600 to-brand-700 px-8 py-10">
            <div class="flex items-center gap-6">
                <div class="w-20 h-20 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center text-white text-3xl font-bold">
                    <?= strtoupper(substr($user->prenom, 0, 1)) . strtoupper(substr($user->nom, 0, 1)) ?>
                </div>
                <div class="text-white">
                    <h1 class="text-2xl font-display font-bold m-0"><?= htmlspecialchars($user->prenom . ' ' . $user->nom) ?></h1>
                    <div class="flex items-center gap-3 mt-2">
                        <span class="text-sm text-white/80"><?= htmlspecialchars($user->email) ?></span>
                        <?php if($user->statut === 'actif'): ?>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-400/30 text-white">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-300"></span>
                                Actif
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-400/30 text-white">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-300"></span>
                                Suspendu
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Téléphone</div>
                    <div class="text-sm font-semibold text-slate-900"><?= htmlspecialchars($user->telephone) ?></div>
                </div>
                <div>
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Rôle</div>
                    <div class="text-sm font-semibold text-slate-900"><?= ucfirst($user->role) ?></div>
                </div>
                <div>
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Date d'inscription</div>
                    <div class="text-sm font-semibold text-slate-900"><?= date('d M Y à H:i', strtotime($user->date_inscription)) ?></div>
                </div>
                <div>
                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Conducteur validé</div>
                    <div class="text-sm font-semibold <?= $user->est_conducteur_valide ? 'text-green-600' : 'text-slate-400' ?>">
                        <?= $user->est_conducteur_valide ? 'Oui' : 'Non' ?>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-wrap gap-3 pt-6 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('edit-form').classList.toggle('hidden')" 
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-brand-600 text-white text-sm font-semibold hover:bg-brand-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                    </svg>
                    Modifier
                </button>

                <?php if($user->statut === 'actif'): ?>
                <form action="<?= BASE_URL ?>admin/utilisateur/<?= $user->id ?>/suspendre" method="POST" class="m-0"
                      onsubmit="return confirm('Suspendre cet utilisateur ? Il ne pourra plus se connecter.');">
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-yellow-50 text-yellow-700 text-sm font-semibold hover:bg-yellow-500 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                        Suspendre
                    </button>
                </form>
                <?php else: ?>
                <form action="<?= BASE_URL ?>admin/utilisateur/<?= $user->id ?>/reactiver" method="POST" class="m-0">
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-green-50 text-green-700 text-sm font-semibold hover:bg-green-500 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        Réactiver
                    </button>
                </form>
                <?php endif; ?>

                <form action="<?= BASE_URL ?>admin/utilisateur/<?= $user->id ?>/supprimer" method="POST" class="m-0"
                      onsubmit="return confirm('ATTENTION : Cette action est irréversible. Supprimer définitivement cet utilisateur ?');">
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-red-50 text-red-700 text-sm font-semibold hover:bg-red-500 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Formulaire d'édition (caché par défaut) -->
    <div id="edit-form" class="hidden bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
        <h2 class="font-display text-xl font-bold text-slate-900 mb-6">Modifier les informations</h2>
        <form action="<?= BASE_URL ?>admin/utilisateur/<?= $user->id ?>/modifier" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Nom</label>
                <input type="text" name="nom" value="<?= htmlspecialchars($user->nom) ?>" required
                       class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition-all text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Prénom</label>
                <input type="text" name="prenom" value="<?= htmlspecialchars($user->prenom) ?>" required
                       class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition-all text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user->email) ?>" required
                       class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition-all text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Téléphone</label>
                <input type="text" name="telephone" value="<?= htmlspecialchars($user->telephone) ?>" required
                       class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition-all text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Rôle</label>
                <select name="role" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:border-brand-500 focus:ring-2 focus:ring-brand-100 outline-none transition-all text-sm">
                    <option value="passager" <?= $user->role === 'passager' ? 'selected' : '' ?>>Passager</option>
                    <option value="conducteur" <?= $user->role === 'conducteur' ? 'selected' : '' ?>>Conducteur</option>
                    <option value="admin" <?= $user->role === 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
            <div class="md:col-span-2 flex gap-3 pt-2">
                <button type="submit" class="px-6 py-3 bg-brand-600 text-white rounded-2xl font-semibold text-sm hover:bg-brand-700 transition-colors">
                    Enregistrer
                </button>
                <button type="button" onclick="document.getElementById('edit-form').classList.add('hidden')" 
                        class="px-6 py-3 bg-slate-100 text-slate-600 rounded-2xl font-semibold text-sm hover:bg-slate-200 transition-colors">
                    Annuler
                </button>
            </div>
        </form>
    </div>

</div>