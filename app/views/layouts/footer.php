<footer class="mt-auto relative overflow-hidden bg-red-900 text-white border-t border-white/10">
    <style>
        .footer-logo img {
            filter: brightness(0) invert(1);
            transition: filter 0.3s ease;
        }
        .footer-logo:hover img {
            filter: invert(18%) sepia(93%) saturate(5952%) hue-rotate(-6deg) brightness(0.9);
        }
    </style>

    <!-- Gradient décoratif en fond -->
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute -top-24 -left-24 w-72 h-72 bg-red-700/15 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-12 right-1/3 w-60 h-60 bg-red-600/15 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 lg:px-10">

        <!-- Section principale -->
        <div class="py-10 flex flex-col md:flex-row justify-between items-center gap-8">

            <!-- Logo + tagline -->
            <div class="flex flex-col items-center md:items-start gap-2">
                <a href="<?= BASE_URL ?>" class="footer-logo group" aria-label="Kaay Dem - Accueil">
                    <img src="<?= BASE_URL ?>assets/images/logo2.png"
                        alt="Kaay Dem"
                        class="h-8 w-auto transition-all duration-500">
                </a>
                <p class="text-xs text-red-200 hidden md:block">Covoiturage étudiant &mdash; Dakar &bull; Rufisque &bull; Diamniadio</p>
            </div>

            <!-- Liens -->
            <nav class="flex flex-wrap justify-center gap-x-8 gap-y-2" aria-label="Liens footer">
                <a href="<?= BASE_URL ?>a-propos"
                    class="text-sm font-medium text-white/80 hover:text-white transition-colors duration-200 relative after:absolute after:bottom-[-2px] after:left-0 after:h-px after:w-0 after:bg-white hover:after:w-full after:transition-all after:duration-300">
                    À propos
                </a>
                <a href="<?= BASE_URL ?>contact"
                    class="text-sm font-medium text-slate-500 hover:text-white transition-colors duration-200 relative after:absolute after:bottom-[-2px] after:left-0 after:h-px after:w-0 after:bg-brand-500 hover:after:w-full after:transition-all after:duration-300">
                    Contact
                </a>
                <a href="#"
                    class="text-sm font-medium text-slate-500 hover:text-white transition-colors duration-200 relative after:absolute after:bottom-[-2px] after:left-0 after:h-px after:w-0 after:bg-brand-500 hover:after:w-full after:transition-all after:duration-300">
                    CGU
                </a>
                <a href="<?= BASE_URL ?>trajets/recherche"
                    class="text-sm font-medium text-slate-500 hover:text-white transition-colors duration-200 relative after:absolute after:bottom-[-2px] after:left-0 after:h-px after:w-0 after:bg-brand-500 hover:after:w-full after:transition-all after:duration-300">
                    Rechercher un trajet
                </a>
            </nav>

            <!-- Badge statut -->
            <div class="flex items-center gap-2 bg-white/10 border border-white/20 px-4 py-2 rounded-full backdrop-blur-sm">
                <span class="relative flex h-2 w-2 flex-shrink-0">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white/30 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                </span>
                <span class="text-xs text-white/80">Projet académique actif</span>
            </div>
        </div>

        <!-- Bas de footer -->
        <div class="border-t border-white/10 py-5 flex flex-col sm:flex-row justify-between items-center gap-3">
            <p class="text-xs text-white/80">
                &copy; <?= date('Y') ?> <span class="text-white font-medium">Kaay Dem !</span> &mdash; Tous droits réservés
            </p>
            <p class="text-xs text-white/80">
                Fait avec à Dakar, Sénégal
            </p>
        </div>
    </div>
</footer>