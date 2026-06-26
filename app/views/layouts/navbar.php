<nav id="main-nav" class="sticky top-0 z-50 transition-all duration-500" aria-label="Navigation principale">

    <!-- Fond glassmorphism avec gradient subtil -->
    <div class="absolute inset-0 bg-white/60 backdrop-blur-2xl border-b border-white/30 shadow-[0_4px_24px_rgba(0,0,0,0.06)]" aria-hidden="true"></div>

    <div class="relative max-w-7xl mx-auto px-6 lg:px-10 h-20 flex items-center justify-between">

        <!-- Logo -->
        <a href="<?= BASE_URL ?>" class="flex items-center group flex-shrink-0" aria-label="Kaay Dem - Accueil">
            <!-- Desktop : logo principal -->
            <img src="<?= BASE_URL ?>assets/images/logo2.png" alt="Kaay Dem"
                class="hidden md:block h-10 w-auto transition-all duration-300 group-hover:scale-105 group-hover:drop-shadow-md">
            <!-- Mobile : même logo en plus petit -->
            <img src="<?= BASE_URL ?>assets/images/logo1.png" alt="Kaay Dem"
                class="block md:hidden h-10 w-auto transition-all duration-300 group-hover:scale-105">
        </a>

        <!-- Navigation Desktop -->
        <div class="hidden md:flex items-center gap-2">

            <!-- Liens nav -->
            <a href="<?= BASE_URL ?>trajets/recherche"
                class="nav-link group flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-white/70 transition-all duration-200">
                <span class="p-1 rounded-lg bg-slate-100 group-hover:bg-brand-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-slate-500 group-hover:text-brand-600 transition-colors">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </span>
                Rechercher
            </a>

            <a href="<?= BASE_URL ?>a-propos"
                class="nav-link group flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-white/70 transition-all duration-200">
                <span class="p-1 rounded-lg bg-slate-100 group-hover:bg-brand-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5 text-slate-500 group-hover:text-brand-600 transition-colors">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                </span>
                À propos
            </a>

            <!-- Séparateur -->
            <div class="w-px h-6 bg-slate-200/80 mx-1" aria-hidden="true"></div>

            <?php if (isset($_SESSION['user_id'])) : ?>

                <?php
                $dashboard_link = BASE_URL . 'passager/dashboard';
                if ($_SESSION['user_role'] == 'admin') $dashboard_link = BASE_URL . 'admin/dashboard';
                if ($_SESSION['user_role'] == 'conducteur') $dashboard_link = BASE_URL . 'conducteur/dashboard';
                ?>

                <!-- Dashboard icon -->
                <a href="<?= $dashboard_link ?>"
                    class="p-2.5 rounded-xl text-slate-500 hover:text-brand-600 hover:bg-brand-50 transition-all duration-200"
                    title="Mon Dashboard">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                </a>

                <!-- Avatar pill -->
                <a href="<?= BASE_URL ?>profil"
                    class="flex items-center gap-3 bg-white/80 border border-slate-200/80 py-1.5 pl-1.5 pr-4 rounded-2xl hover:border-brand-300 hover:bg-white hover:shadow-lg hover:shadow-brand-600/10 hover:-translate-y-0.5 transition-all duration-300 group">
                    <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-brand-500 to-brand-700 text-white flex items-center justify-center font-bold text-sm shadow-inner">
                        <?= strtoupper(substr($_SESSION['user_prenom'], 0, 1)) ?>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xs font-semibold text-slate-900 leading-none group-hover:text-brand-700 transition-colors">
                            <?= htmlspecialchars($_SESSION['user_prenom']) ?>
                        </span>
                        <span class="text-[10px] text-slate-400 mt-0.5"><?= ucfirst($_SESSION['user_role']) ?></span>
                    </div>
                </a>

                <!-- Déconnexion -->
                <a href="<?= BASE_URL ?>auth/deconnexion"
                    class="p-2.5 rounded-xl bg-red-50 text-red-500 hover:bg-red-600 hover:text-white transition-all duration-200 shadow-sm"
                    title="Se déconnecter">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4.5 h-4.5 w-[18px] h-[18px]">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                </a>

            <?php else : ?>

                <a href="<?= BASE_URL ?>auth/connexion"
                    class="text-sm font-semibold text-slate-600 hover:text-brand-700 px-3 py-2 rounded-xl hover:bg-brand-50 transition-all duration-200">
                    Se connecter
                </a>

                <a href="<?= BASE_URL ?>auth/inscription"
                    class="flex items-center gap-2 bg-gradient-to-r from-brand-600 to-brand-800 text-white text-sm font-semibold py-2.5 px-5 rounded-xl shadow-md shadow-brand-700/25 hover:shadow-xl hover:shadow-brand-700/35 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 relative overflow-hidden group">
                    <span class="absolute inset-0 bg-gradient-to-r from-brand-500 to-brand-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    <span class="relative">S'inscrire</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="relative w-4 h-4 transition-transform duration-300 group-hover:translate-x-0.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>

            <?php endif; ?>
        </div>

        <!-- Bouton hamburger mobile -->
        <button id="mobile-menu-btn"
            class="md:hidden relative z-10 p-2.5 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-white/70 transition-all duration-200"
            aria-label="Ouvrir le menu"
            aria-expanded="false"
            aria-controls="mobile-menu">
            <svg id="icon-open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
            </svg>
            <svg id="icon-close" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 hidden">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Menu Mobile (drawer) -->
    <div id="mobile-menu"
        class="md:hidden overflow-hidden max-h-0 transition-[max-height,opacity] duration-500 ease-in-out opacity-0"
        aria-hidden="true">

        <div class="relative bg-white/80 backdrop-blur-2xl border-t border-slate-100/80 px-6 py-5 flex flex-col gap-2">

            <!-- Gradient décoratif -->
            <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-bl from-brand-100/40 to-transparent rounded-full -translate-y-1/2 translate-x-1/4 pointer-events-none" aria-hidden="true"></div>

            <a href="<?= BASE_URL ?>trajets/recherche"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:text-brand-700 hover:bg-brand-50 transition-all duration-200 group">
                <div class="w-9 h-9 rounded-xl bg-slate-100 group-hover:bg-brand-100 flex items-center justify-center transition-colors flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-slate-500 group-hover:text-brand-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </div>
                Rechercher un trajet
            </a>

            <a href="<?= BASE_URL ?>a-propos"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:text-brand-700 hover:bg-brand-50 transition-all duration-200 group">
                <div class="w-9 h-9 rounded-xl bg-slate-100 group-hover:bg-brand-100 flex items-center justify-center transition-colors flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-slate-500 group-hover:text-brand-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                    </svg>
                </div>
                À propos
            </a>

            <div class="h-px bg-slate-100 my-1" aria-hidden="true"></div>

            <?php if (isset($_SESSION['user_id'])) : ?>

                <?php
                $dashboard_link = BASE_URL . 'passager/dashboard';
                if ($_SESSION['user_role'] == 'admin') $dashboard_link = BASE_URL . 'admin/dashboard';
                if ($_SESSION['user_role'] == 'conducteur') $dashboard_link = BASE_URL . 'conducteur/dashboard';
                ?>

                <!-- Avatar mobile -->
                <a href="<?= BASE_URL ?>profil"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-50 transition-all duration-200 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500 to-brand-700 text-white flex items-center justify-center font-bold shadow-md flex-shrink-0">
                        <?= strtoupper(substr($_SESSION['user_prenom'], 0, 1)) ?>
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-slate-900"><?= htmlspecialchars($_SESSION['user_prenom']) ?></div>
                        <div class="text-xs text-slate-400"><?= ucfirst($_SESSION['user_role']) ?> &bull; Voir le profil</div>
                    </div>
                </a>

                <a href="<?= $dashboard_link ?>"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-700 hover:text-brand-700 hover:bg-brand-50 transition-all duration-200 group">
                    <div class="w-9 h-9 rounded-xl bg-slate-100 group-hover:bg-brand-100 flex items-center justify-center transition-colors flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-slate-500 group-hover:text-brand-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                        </svg>
                    </div>
                    Mon Dashboard
                </a>

                <a href="<?= BASE_URL ?>auth/deconnexion"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-red-600 hover:bg-red-50 transition-all duration-200 group mt-1">
                    <div class="w-9 h-9 rounded-xl bg-red-50 group-hover:bg-red-100 flex items-center justify-center transition-colors flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                    </div>
                    Se déconnecter
                </a>

            <?php else : ?>

                <a href="<?= BASE_URL ?>auth/connexion"
                    class="flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-sm font-semibold text-slate-700 border border-slate-200 hover:border-brand-300 hover:text-brand-700 hover:bg-brand-50 transition-all duration-200">
                    Se connecter
                </a>

                <a href="<?= BASE_URL ?>auth/inscription"
                    class="flex items-center justify-center gap-2 bg-gradient-to-r from-brand-600 to-brand-800 text-white text-sm font-semibold py-3 px-5 rounded-xl shadow-md shadow-brand-700/25 hover:shadow-lg hover:shadow-brand-700/35 transition-all duration-300">
                    S'inscrire gratuitement
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>

            <?php endif; ?>

            <!-- Padding bas pour éviter que le contenu colle -->
            <div class="h-2"></div>
        </div>
    </div>
</nav>

<script>
    (function() {
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        const iconOpen = document.getElementById('icon-open');
        const iconClose = document.getElementById('icon-close');
        let isOpen = false;

        btn.addEventListener('click', () => {
            isOpen = !isOpen;
            if (isOpen) {
                menu.style.maxHeight = menu.scrollHeight + 'px';
                menu.style.opacity = '1';
                menu.setAttribute('aria-hidden', 'false');
                btn.setAttribute('aria-expanded', 'true');
                iconOpen.classList.add('hidden');
                iconClose.classList.remove('hidden');
            } else {
                menu.style.maxHeight = '0';
                menu.style.opacity = '0';
                menu.setAttribute('aria-hidden', 'true');
                btn.setAttribute('aria-expanded', 'false');
                iconOpen.classList.remove('hidden');
                iconClose.classList.add('hidden');
            }
        });

        // Fermer sur resize vers desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768 && isOpen) {
                isOpen = false;
                menu.style.maxHeight = '0';
                menu.style.opacity = '0';
                menu.setAttribute('aria-hidden', 'true');
                btn.setAttribute('aria-expanded', 'false');
                iconOpen.classList.remove('hidden');
                iconClose.classList.add('hidden');
            }
        });
    })();
</script>