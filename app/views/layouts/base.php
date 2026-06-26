<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($titre) ? $titre . ' - ' . APP_NAME : APP_NAME ?></title>

    <!-- Fonts (Inter & Outfit) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,300;0,14..32,400;0,14..32,500;0,14..32,600;0,14..32,700;1,14..32,400&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#fef2f2',
                            100: '#fee2e2',
                            200: '#fecaca',
                            300: '#fca5a5',
                            400: '#f87171',
                            500: '#ef4444',
                            600: '#dc2626',
                            700: '#b91c1c',
                            800: '#991b1b',
                            900: '#7f1d1d',
                        },
                        accent: {
                            DEFAULT: '#FDE047',
                            dark: '#EAB308',
                        }
                    },
                    boxShadow: {
                        'glass': '0 8px 32px 0 rgba(0,0,0,0.08)',
                        'glow': '0 0 24px rgba(220,38,38,0.3)',
                    },
                    backdropBlur: {
                        xs: '2px',
                    }
                }
            }
        }
    </script>

    <!-- CSS custom -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">

    <style>
        /* Glass panels */
        .glass-panel {
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        /* Navbar scroll shrink */
        #main-nav.scrolled>div:first-child {
            background: rgba(255, 255, 255, 0.85);
            box-shadow: 0 4px 32px rgba(0, 0, 0, 0.10);
        }

        #main-nav.scrolled .nav-logo {
            height: 2rem;
            /* h-8 */
        }

        /* Smooth scrollbar webkit */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 99px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 antialiased flex flex-col min-h-screen font-sans">

    <!-- Navbar -->
    <?php require_once '../app/views/layouts/navbar.php'; ?>

    <!-- Contenu dynamique -->
    <main class="flex-grow flex flex-col">
        <?php echo $content ?? ''; ?>
    </main>

    <!-- Footer -->
    <?php require_once '../app/views/layouts/footer.php'; ?>

    <!-- Script global : navbar shrink on scroll -->
    <script>
        (function() {
            const nav = document.getElementById('main-nav');
            if (!nav) return;
            const onScroll = () => {
                if (window.scrollY > 20) {
                    nav.classList.add('scrolled');
                } else {
                    nav.classList.remove('scrolled');
                }
            };
            window.addEventListener('scroll', onScroll, {
                passive: true
            });
        })();
    </script>

</body>

</html>