<script src="https://unpkg.com/lucide@latest"></script>

<div style="
    min-height: 100vh;
    padding: 40px 20px;
    box-sizing: border-box;
    background-color: #f7f9fa;
    background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAxNDAgODAiPjx0ZXh0IHg9IjE1IiB5PSIzMCIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+S0FBWTwvdGV4dD48dGV4dCB4PSIxNSIgeT0iNDUiIGZpbGw9IiNkYzI2MjYiIG9wYWNpdHk9IjAuMDciIGZvbnQtZmFtaWx5PSJzYW5zLXNlcmlmIiBmb250LXdlaWdodD0iOTAwIiBmb250LXNpemU9IjEyIiBsZXR0ZXItc3BhY2luZz0iMC41cHkiPkRFTU08L3RleHQ+PHRleHQgeD0iODUiIHk9IjcwIiBmaWxsPSIjZGMyNjI2IiBvcGFjaXR5PSIwLjA3IiBmb250LWZhbWlseT0ic2Fucy1zZXJpZiIgZm9udC13ZWlnaHQ9IjkwMCIgZm9udC1zaXplPSIxMiIgbGV0dGVyLXNwYWNpbmc9IjAuNXB5Ij5LQUFZPC90ZXh0Pjx0ZXh0IHg9Ijg1IiB5PSI4NSIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+REVNTTwvdGV4dD48L3N2Zz4=');
    background-repeat: repeat;
    font-family: system-ui, -apple-system, sans-serif;
">

    <div class="glass-panel" style="
        max-width: 1150px; 
        margin: 0 auto; 
        padding: 40px;
        border-radius: 24px;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border: 1px solid rgba(229, 231, 235, 0.6);
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        box-sizing: border-box;
    ">

        <div style="display: grid; grid-template-columns: 1.3fr 0.7fr; gap: 32px; align-items: flex-start;">
            
            <div style="background: white; border: 1px solid #e5e7eb; border-radius: 20px; padding: 32px;">
                <div style="display: flex; items-start: flex-start; justify-content: space-between; gap: 16px;">
                    <div>
                        <h1 style="font-size: 28px; font-weight: 800; color: #111827; margin: 0; font-family: 'Outfit', sans-serif;">
                            Bonjour <?= htmlspecialchars($user->prenom) ?>,
                        </h1>
                        <p style="margin-top: 8px; font-size: 14px; color: #4b5563; max-width: 500px; line-height: 1.5;">
                            Voici les informations de votre compte. Vous pouvez revenir à votre tableau de bord ou gérer votre profil depuis cette page.
                        </p>
                    </div>
                    <div style="text-align: right;">
                        <span style="inline-flex: inline-block; border-radius: 9999px; background: rgba(220, 38, 38, 0.08); padding: 8px 16px; font-size: 13px; font-weight: 700; color: #dc2626; border: 1px solid rgba(220, 38, 38, 0.15);">
                            <?= ucfirst(htmlspecialchars($user->role ?? 'passager')) ?>
                        </span>
                    </div>
                </div>

                <div style="margin-top: 40px; display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px;">
                    <div style="border-radius: 16px; border: 1px solid #e5e7eb; background: #f8fafc; padding: 20px;">
                        <h2 style="font-size: 13px; font-weight: 700; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Nom complet</h2>
                        <p style="margin: 10px 0 0 0; color: #111827; font-size: 15px; font-weight: 600;"><?= htmlspecialchars($user->nom) ?> <?= htmlspecialchars($user->prenom) ?></p>
                    </div>

                    <div style="border-radius: 16px; border: 1px solid #e5e7eb; background: #f8fafc; padding: 20px;">
                        <h2 style="font-size: 13px; font-weight: 700; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Adresse email</h2>
                        <p style="margin: 10px 0 0 0; color: #111827; font-size: 15px; font-weight: 600; word-break: break-all;"><?= htmlspecialchars($user->email) ?></p>
                    </div>

                    <div style="border-radius: 16px; border: 1px solid #e5e7eb; background: #f8fafc; padding: 20px;">
                        <h2 style="font-size: 13px; font-weight: 700; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Téléphone</h2>
                        <p style="margin: 10px 0 0 0; color: #111827; font-size: 15px; font-weight: 600;"><?= !empty($user->telephone) ? htmlspecialchars($user->telephone) : '<span style="color: #9ca3af; font-weight: 500;">Non renseigné</span>' ?></p>
                    </div>

                    <div style="border-radius: 16px; border: 1px solid #e5e7eb; background: #f8fafc; padding: 20px;">
                        <h2 style="font-size: 13px; font-weight: 700; color: #4b5563; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Statut du compte</h2>
                        <p style="margin: 10px 0 0 0; color: #111827; font-size: 15px; font-weight: 600;"><?= isset($user->est_conducteur_valide) && $user->est_conducteur_valide ? 'Conducteur validé' : 'Profil standard' ?></p>
                    </div>
                </div>

                <div style="margin-top: 40px; display: flex; gap: 16px; flex-wrap: wrap;">
                    <a href="<?= BASE_URL ?>passager/dashboard"
                        style="display: inline-flex; align-items: center; justify-content: center; border-radius: 14px; background: #dc2626; padding: 14px 28px; font-size: 14px; font-weight: 700; color: white; text-decoration: none; box-shadow: 0 4px 14px rgba(220,38,38,0.2); transition: background 0.2s;"
                        onmouseover="this.style.background='#b91c1c'" 
                        onmouseout="this.style.background='#dc2626'">
                        Accéder au tableau de bord
                    </a>
                    <a href="<?= BASE_URL ?>auth/deconnexion"
                        style="display: inline-flex; align-items: center; justify-content: center; border-radius: 14px; border: 1px solid #d1d5db; background: white; padding: 14px 28px; font-size: 14px; font-weight: 700; color: #374151; text-decoration: none; transition: background 0.2s;"
                        onmouseover="this.style.background='#f9fafb'" 
                        onmouseout="this.style.background='white'">
                        Se déconnecter
                    </a>
                </div>
            </div>

            <aside style="border-radius: 20px; border: 1px solid #e5e7eb; background: rgba(248, 250, 252, 0.6); padding: 32px; box-sizing: border-box;">
                <div>
                    <h2 style="font-size: 18px; font-weight: 800; color: #111827; margin: 0; font-family: 'Outfit', sans-serif;">À propos de votre compte</h2>
                    <p style="margin-top: 12px; font-size: 14px; line-height: 1.6; color: #4b5563;">
                        Votre profil vous permet de revenir rapidement à vos trajets, vos réservations et votre espace personnel à tout moment.
                    </p>
                </div>

                <div style="margin-top: 32px; display: grid; gap: 16px;">
                    <div style="border-radius: 16px; background: white; padding: 20px; border: 1px solid #e5e7eb;">
                        <h3 style="font-size: 13px; font-weight: 700; color: #4b5563; margin: 0;">ID utilisateur</h3>
                        <p style="margin: 8px 0 0 0; font-size: 14px; color: #111827; font-weight: 700;">#<?= htmlspecialchars($user->id) ?></p>
                    </div>
                    <div style="border-radius: 16px; background: white; padding: 20px; border: 1px solid #e5e7eb;">
                        <h3 style="font-size: 13px; font-weight: 700; color: #4b5563; margin: 0;">Inscrit depuis</h3>
                        <p style="margin: 8px 0 0 0; font-size: 14px; color: #111827; font-weight: 700;">
                            <?= isset($user->created_at) ? htmlspecialchars(date('d/m/Y', strtotime($user->created_at))) : 'Date non disponible' ?>
                        </p>
                    </div>
                </div>
            </aside>

        </div>
    </div>
</div>

<script>
  lucide.createIcons();
</script>