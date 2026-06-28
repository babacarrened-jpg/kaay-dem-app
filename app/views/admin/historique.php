<div class="max-w-5xl mx-auto my-10 px-6">

    <header class="bg-white/80 backdrop-blur-md border border-slate-200 rounded-3xl p-6 mb-8 shadow-sm flex items-center justify-between">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-display font-bold text-slate-900">Historique des activités</h1>
                <p class="text-sm text-slate-500 mt-0.5">Les 100 dernières actions sur la plateforme</p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>admin/dashboard" class="inline-flex items-center gap-2 rounded-2xl bg-slate-100 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-200 transition-colors">
            ← Retour
        </a>
    </header>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <?php if(empty($activites)): ?>
            <div class="text-center py-16">
                <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-slate-300">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="text-slate-400 font-medium">Aucune activité enregistrée pour l'instant.</p>
            </div>
        <?php else: ?>
        <div class="divide-y divide-slate-100">
            <?php foreach($activites as $a): ?>
            <?php
                $icons = [
                    'inscription'          => ['bg' => 'bg-sky-50',    'text' => 'text-sky-600',    'path' => 'M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z'],
                    'nouveau_trajet'       => ['bg' => 'bg-brand-50',  'text' => 'text-brand-600',  'path' => 'M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c-.317-.159-.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z'],
                    'nouvelle_reservation' => ['bg' => 'bg-emerald-50','text' => 'text-emerald-600','path' => 'M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z'],
                    'conducteur_valide'    => ['bg' => 'bg-green-50',  'text' => 'text-green-600',  'path' => 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                    'conducteur_refuse'    => ['bg' => 'bg-red-50',    'text' => 'text-red-500',    'path' => 'M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                    'utilisateur_suspendu' => ['bg' => 'bg-orange-50', 'text' => 'text-orange-500', 'path' => 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636'],
                    'utilisateur_reactive' => ['bg' => 'bg-green-50',  'text' => 'text-green-500',  'path' => 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                    'utilisateur_supprime' => ['bg' => 'bg-red-50',    'text' => 'text-red-600',    'path' => 'M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z'],
                ];

                $ic = $icons[$a->type] ?? [
                    'bg'   => 'bg-slate-100',
                    'text' => 'text-slate-500',
                    'path' => 'M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z'
                ];

                $now     = new DateTime();
                $created = new DateTime($a->created_at);
                $diff    = $now->diff($created);

                if ($diff->days > 0)     $temps = 'Il y a ' . $diff->days . 'j';
                elseif ($diff->h > 0)    $temps = 'Il y a ' . $diff->h . 'h';
                elseif ($diff->i > 0)    $temps = 'Il y a ' . $diff->i . ' min';
                else                     $temps = 'À l\'instant';
            ?>
            <div class="flex items-start gap-4 px-6 py-4 hover:bg-slate-50 transition-colors">
                <div class="w-10 h-10 rounded-xl <?= $ic['bg'] ?> <?= $ic['text'] ?> flex items-center justify-center shrink-0 mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="<?= $ic['path'] ?>" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm text-slate-800 font-medium"><?= htmlspecialchars($a->description) ?></p>
                    <?php if(!empty($a->prenom)): ?>
                    <p class="text-xs text-slate-400 mt-0.5">Par <?= htmlspecialchars($a->prenom . ' ' . $a->nom) ?></p>
                    <?php endif; ?>
                </div>
                <div class="text-xs text-slate-400 font-medium shrink-0 mt-1"><?= $temps ?></div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

</div>