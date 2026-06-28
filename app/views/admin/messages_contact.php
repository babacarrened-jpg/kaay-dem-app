<div class="max-w-5xl mx-auto my-10 px-6">

    <!-- En-tête -->
    <header class="bg-white/80 backdrop-blur-md border border-slate-200 rounded-3xl p-6 md:p-8 mb-10 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-display font-bold text-slate-900 leading-tight">Messages de contact</h1>
                <p class="text-slate-500 text-sm mt-1"><?= count($messages) ?> message<?= count($messages) > 1 ? 's' : '' ?> reçu<?= count($messages) > 1 ? 's' : '' ?></p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>admin/dashboard" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-slate-900 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Retour au dashboard
        </a>
    </header>

    <?php if (empty($messages)): ?>
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-16 text-center">
            <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-slate-300">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
            </div>
            <p class="text-slate-400 font-medium text-sm">Aucun message de contact pour l'instant.</p>
        </div>
    <?php else: ?>
        <div class="space-y-4">
            <?php foreach ($messages as $msg): ?>
                <div class="bg-white rounded-3xl border <?= $msg->lu ? 'border-slate-100' : 'border-brand-200 shadow-sm' ?> p-6 flex flex-col md:flex-row md:items-start gap-5 transition-all">

                    <!-- Avatar initiale -->
                    <div class="w-12 h-12 rounded-full <?= $msg->lu ? 'bg-slate-100 text-slate-400' : 'bg-brand-50 text-brand-600' ?> flex items-center justify-center font-bold text-lg shrink-0">
                        <?= mb_strtoupper(mb_substr($msg->nom, 0, 1)) ?>
                    </div>

                    <!-- Contenu -->
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-3 mb-1">
                            <span class="font-semibold text-slate-900"><?= htmlspecialchars($msg->nom) ?></span>
                            <a href="mailto:<?= htmlspecialchars($msg->email) ?>" class="text-brand-600 text-sm hover:underline"><?= htmlspecialchars($msg->email) ?></a>
                            <?php if (!$msg->lu): ?>
                                <span class="inline-flex items-center gap-1 bg-brand-100 text-brand-700 text-xs font-bold px-2.5 py-0.5 rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-brand-600 animate-pulse"></span>
                                    Nouveau
                                </span>
                            <?php endif; ?>
                        </div>
                        <p class="text-xs text-slate-400 font-medium mb-3">
                            <?= date('d/m/Y à H:i', strtotime($msg->date_envoi)) ?>
                        </p>
                        <p class="text-slate-700 text-sm leading-relaxed whitespace-pre-wrap"><?= htmlspecialchars($msg->message) ?></p>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center gap-2 shrink-0 mt-1">
                        <!-- Répondre par email -->
                        <a href="mailto:<?= htmlspecialchars($msg->email) ?>?subject=Réponse à votre message - Kaay Dem !&body=Bonjour <?= htmlspecialchars($msg->nom) ?>,%0A%0A"
                           class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-brand-50 text-brand-600 text-xs font-semibold hover:bg-brand-600 hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Répondre
                        </a>

                        <?php if (!$msg->lu): ?>
                            <form action="<?= BASE_URL ?>admin/messages/<?= (int)$msg->id ?>/lu" method="POST" class="m-0">
                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-slate-100 text-slate-600 text-xs font-semibold hover:bg-slate-200 transition-colors" title="Marquer comme lu">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                    Lu
                                </button>
                            </form>
                        <?php else: ?>
                            <span class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl bg-green-50 text-green-600 text-xs font-semibold">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                Traité
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>