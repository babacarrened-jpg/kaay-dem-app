<?php
/**
 * Vue : Administration — Détail d'un signalement
 * Chemin : app/views/admin/signalement_detail.php
 *
 * Variables attendues depuis AdminController::voirSignalement() :
 *   $signalement – objet retourné par Signalement::getById()
 */

$statutConfig = [
    'nouveau'  => ['bg' => 'bg-red-50', 'text' => 'text-red-700', 'dot' => 'bg-red-500', 'label' => 'Nouveau', 'border' => 'border-red-200'],
    'en_cours' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-700', 'dot' => 'bg-yellow-500', 'label' => 'En cours', 'border' => 'border-yellow-200'],
    'traite'   => ['bg' => 'bg-green-50', 'text' => 'text-green-700', 'dot' => 'bg-green-500', 'label' => 'Traité', 'border' => 'border-green-200'],
];
$sc = $statutConfig[$signalement->statut] ?? $statutConfig['nouveau'];
?>

<div class="max-w-4xl mx-auto my-10 px-6">

    <!-- En-tête -->
    <header class="bg-white/80 backdrop-blur-md border border-slate-200 rounded-3xl p-6 md:p-8 mb-8 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div class="flex items-center gap-5">
            <div class="w-14 h-14 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0l2.77-.693a14.267 14.267 0 014.622 0s2.77.693 4.513.693c1.744 0 3.203-.693 3.203-.693M3 15h12.5M3 4.5l2.77.693a14.267 14.267 0 004.622 0s2.77-.693 4.513-.693c1.744 0 3.203.693 3.203.693M3 4.5h12.5" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-display font-bold text-slate-900 m-0 leading-tight">Signalement #<?= $signalement->id ?></h1>
                <p class="text-slate-500 text-sm mt-1">Détail complet du signalement</p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>admin/signalements" class="inline-flex items-center gap-2 rounded-2xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-200 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Retour à la liste
        </a>
    </header>

    <!-- Statut actuel + Actions -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div class="flex items-center gap-3">
            <span class="text-sm font-semibold text-slate-500">Statut actuel :</span>
            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full <?= $sc['bg'] ?> <?= $sc['text'] ?> text-sm font-semibold border <?= $sc['border'] ?>">
                <span class="w-2.5 h-2.5 rounded-full <?= $sc['dot'] ?>"></span>
                <?= $sc['label'] ?>
            </span>
        </div>
        <div class="flex items-center gap-2 flex-wrap">
            <?php if ($signalement->statut === 'nouveau'): ?>
                <form action="<?= BASE_URL ?>admin/signalement/<?= $signalement->id ?>/statut" method="POST" class="m-0">
                    <input type="hidden" name="statut" value="en_cours">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-yellow-500 px-4 py-2.5 text-sm font-semibold text-white hover:bg-yellow-600 transition-colors shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Prendre en charge
                    </button>
                </form>
            <?php endif; ?>

            <?php if ($signalement->statut === 'en_cours'): ?>
                <form action="<?= BASE_URL ?>admin/signalement/<?= $signalement->id ?>/statut" method="POST" class="m-0">
                    <input type="hidden" name="statut" value="traite">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-green-500 px-4 py-2.5 text-sm font-semibold text-white hover:bg-green-600 transition-colors shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        Marquer comme traité
                    </button>
                </form>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>admin/signalement/<?= $signalement->id ?>/supprimer" method="POST" class="m-0" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce signalement ? Cette action est irréversible.');">
                <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-500 hover:text-white transition-colors border border-red-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                    Supprimer
                </button>
            </form>
        </div>
    </div>

    <!-- Informations principales -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

        <!-- Signalé par -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6">
            <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">Signalé par</h3>
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center font-bold text-lg">
                    <?= mb_strtoupper(mb_substr($signalement->auteur_prenom, 0, 1)) ?>
                </div>
                <div>
                    <div class="text-base font-semibold text-slate-900">
                        <?= htmlspecialchars($signalement->auteur_prenom . ' ' . $signalement->auteur_nom) ?>
                    </div>
                    <a href="mailto:<?= htmlspecialchars($signalement->auteur_email) ?>" class="text-sm text-brand-600 hover:underline">
                        <?= htmlspecialchars($signalement->auteur_email) ?>
                    </a>
                </div>
            </div>
            <div class="mt-3">
                <a href="<?= BASE_URL ?>admin/utilisateur/<?= $signalement->auteur_id ?>" class="inline-flex items-center gap-1.5 text-xs font-semibold text-brand-600 hover:text-brand-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    Voir le profil
                </a>
            </div>
        </div>

        <!-- Personne concernée -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6">
            <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">Personne signalée</h3>
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-red-50 text-red-600 flex items-center justify-center font-bold text-lg">
                    <?= mb_strtoupper(mb_substr($signalement->concerne_prenom, 0, 1)) ?>
                </div>
                <div>
                    <div class="text-base font-semibold text-slate-900">
                        <?= htmlspecialchars($signalement->concerne_prenom . ' ' . $signalement->concerne_nom) ?>
                    </div>
                    <a href="mailto:<?= htmlspecialchars($signalement->concerne_email) ?>" class="text-sm text-brand-600 hover:underline">
                        <?= htmlspecialchars($signalement->concerne_email) ?>
                    </a>
                </div>
            </div>
            <div class="mt-3">
                <a href="<?= BASE_URL ?>admin/utilisateur/<?= $signalement->concerne_id ?>" class="inline-flex items-center gap-1.5 text-xs font-semibold text-red-600 hover:text-red-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    Voir le profil
                </a>
            </div>
        </div>
    </div>

    <!-- Motif et Description -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Motif -->
            <div>
                <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Motif</h3>
                <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-slate-100 text-slate-700 text-sm font-semibold">
                    <?= htmlspecialchars($signalement->motif) ?>
                </span>
            </div>

            <!-- Date -->
            <div>
                <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Date du signalement</h3>
                <div class="text-sm font-medium text-slate-700">
                    <?= date('d/m/Y à H:i', strtotime($signalement->date_creation)) ?>
                </div>
            </div>

            <!-- Trajet lié -->
            <div>
                <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Trajet associé</h3>
                <?php if ($signalement->trajet_id && !empty($signalement->ville_depart)): ?>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-brand-50 text-brand-600 text-sm font-semibold">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                        </svg>
                        <?= htmlspecialchars($signalement->ville_depart) ?> → <?= htmlspecialchars($signalement->ville_arrivee) ?>
                    </span>
                    <?php if (!empty($signalement->date_trajet)): ?>
                        <div class="text-xs text-slate-400 mt-1">le <?= date('d/m/Y', strtotime($signalement->date_trajet)) ?></div>
                    <?php endif; ?>
                <?php else: ?>
                    <span class="text-sm text-slate-400 italic">Aucun trajet associé</span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Description complète -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 mb-6">
        <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">Description détaillée</h3>
        <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100">
            <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-wrap"><?= htmlspecialchars($signalement->description) ?></p>
        </div>
    </div>

    <!-- Historique rapide des actions -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6">
        <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-4">Actions rapides</h3>
        <div class="flex flex-wrap gap-3">
            <a href="<?= BASE_URL ?>admin/utilisateur/<?= $signalement->auteur_id ?>"
               class="inline-flex items-center gap-2 rounded-xl bg-brand-50 px-4 py-2.5 text-sm font-semibold text-brand-600 hover:bg-brand-100 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
                Profil de l'auteur
            </a>
            <a href="<?= BASE_URL ?>admin/utilisateur/<?= $signalement->concerne_id ?>"
               class="inline-flex items-center gap-2 rounded-xl bg-red-50 px-4 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-100 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
                Profil de la personne signalée
            </a>
            <?php if ($signalement->statut !== 'traite'): ?>
                <form action="<?= BASE_URL ?>admin/utilisateur/<?= $signalement->concerne_id ?>/suspendre" method="POST" class="m-0" onsubmit="return confirm('Suspendre cet utilisateur ?');">
                    <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-orange-50 px-4 py-2.5 text-sm font-semibold text-orange-600 hover:bg-orange-100 transition-colors border border-orange-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                        Suspendre l'utilisateur signalé
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>

</div>