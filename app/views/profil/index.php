<section class="max-w-6xl mx-auto px-6 py-12 lg:px-10">
    <div class="grid gap-8 lg:grid-cols-[1.3fr_0.7fr]">
        <div class="bg-white rounded-3xl p-8 shadow-glow">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-semibold text-slate-900">Bonjour <?= htmlspecialchars($user->prenom) ?>,</h1>
                    <p class="mt-2 text-sm text-slate-500 max-w-2xl">Voici les informations de votre compte. Vous pouvez revenir à votre tableau de bord ou gérer votre profil depuis cette page.</p>
                </div>
                <div class="text-right">
                    <span class="inline-flex items-center gap-2 rounded-full bg-brand-100 px-4 py-2 text-sm font-medium text-brand-800"><?= ucfirst(htmlspecialchars($user->role ?? 'passager')) ?></span>
                </div>
            </div>

            <div class="mt-10 grid gap-6 sm:grid-cols-2">
                <div class="rounded-3xl border border-slate-200/80 bg-slate-50 p-6">
                    <h2 class="text-base font-semibold text-slate-800">Nom complet</h2>
                    <p class="mt-3 text-slate-600 text-sm"><?= htmlspecialchars($user->nom) ?> <?= htmlspecialchars($user->prenom) ?></p>
                </div>

                <div class="rounded-3xl border border-slate-200/80 bg-slate-50 p-6">
                    <h2 class="text-base font-semibold text-slate-800">Adresse email</h2>
                    <p class="mt-3 text-slate-600 text-sm"><?= htmlspecialchars($user->email) ?></p>
                </div>

                <div class="rounded-3xl border border-slate-200/80 bg-slate-50 p-6">
                    <h2 class="text-base font-semibold text-slate-800">Téléphone</h2>
                    <p class="mt-3 text-slate-600 text-sm"><?= !empty($user->telephone) ? htmlspecialchars($user->telephone) : '<span class="text-slate-400">Non renseigné</span>' ?></p>
                </div>

                <div class="rounded-3xl border border-slate-200/80 bg-slate-50 p-6">
                    <h2 class="text-base font-semibold text-slate-800">Statut du compte</h2>
                    <p class="mt-3 text-slate-600 text-sm"><?= isset($user->est_conducteur_valide) && $user->est_conducteur_valide ? 'Conducteur validé' : 'Profil standard' ?></p>
                </div>
            </div>

            <div class="mt-10 flex flex-col gap-4 sm:flex-row sm:items-center">
                <a href="<?= BASE_URL ?>passager/dashboard"
                    class="inline-flex items-center justify-center rounded-2xl bg-brand-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-brand-700/25 hover:bg-brand-700 transition-all duration-200">
                    Accéder au tableau de bord
                </a>
                <a href="<?= BASE_URL ?>auth/deconnexion"
                    class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition-all duration-200">
                    Se déconnecter
                </a>
            </div>
        </div>

        <aside class="space-y-6 rounded-3xl border border-slate-200/80 bg-slate-50 p-8 shadow-glow">
            <div>
                <h2 class="text-xl font-semibold text-slate-900">À propos de votre compte</h2>
                <p class="mt-3 text-sm leading-6 text-slate-500">Votre profil vous permet de revenir rapidement à vos trajets, vos réservations et votre espace personnel à tout moment.</p>
            </div>

            <div class="space-y-4">
                <div class="rounded-3xl bg-white p-5 shadow-sm border border-slate-200/80">
                    <h3 class="text-sm font-semibold text-slate-800">ID utilisateur</h3>
                    <p class="mt-2 text-sm text-slate-500">#<?= htmlspecialchars($user->id) ?></p>
                </div>
                <div class="rounded-3xl bg-white p-5 shadow-sm border border-slate-200/80">
                    <h3 class="text-sm font-semibold text-slate-800">Inscrit depuis</h3>
                    <p class="mt-2 text-sm text-slate-500"><?= isset($user->created_at) ? htmlspecialchars(date('d/m/Y', strtotime($user->created_at))) : 'Date non disponible' ?></p>
                </div>
            </div>
        </aside>
    </div>
</section>
