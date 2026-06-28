<script src="https://unpkg.com/lucide@latest"></script>

<div style="
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    box-sizing: border-box;
    background-color: #f7f9fa;
    background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAxNDAgODAiPjx0ZXh0IHg9IjE1IiB5PSIzMCIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+S0FBWTwvdGV4dD48dGV4dCB4PSIxNSIgeT0iNDUiIGZpbGw9IiNkYzI2MjYiIG9wYWNpdHk9IjAuMDciIGZvbnQtZmFtaWx5PSJzYW5zLXNlcmlmIiBmb250LXdlaWdodD0iOTAwIiBmb250LXNpemU9IjEyIiBsZXR0ZXItc3BhY2luZz0iMC41cHkiPkRFTU08L3RleHQ+PHRleHQgeD0iODUiIHk9IjcwIiBmaWxsPSIjZGMyNjI2IiBvcGFjaXR5PSIwLjA3IiBmb250LWZhbWlseT0ic2Fucy1zZXJpZiIgZm9udC13ZWlnaHQ9IjkwMCIgZm9udC1zaXplPSIxMiIgbGV0dGVyLXNwYWNpbmc9IjAuNXB5Ij5LQUFZPC90ZXh0Pjx0ZXh0IHg9Ijg1IiB5PSI4NSIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+REVNTTwvdGV4dD48L3N2Zz4=');
    background-repeat: repeat;
    font-family: system-ui, -apple-system, sans-serif;
">
    
    <div class="glass-panel auth-card" style="
        width: 100%; 
        max-width: 460px; 
        padding: 45px;
        border-radius: 24px;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border: 1px solid rgba(229, 231, 235, 0.6);
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        box-sizing: border-box;
    ">
        
        <div style="text-align: center; margin-bottom: 32px;">
            <div style="width: 60px; height: 60px; background: rgba(220, 38, 38, 0.08); color: #dc2626; border: 1px solid rgba(220, 38, 38, 0.15); border-radius: 18px; display: flex; align-items: center; justify-content: center; margin: 0 auto 18px; transform: rotate(-5deg);">
                <i data-lucide="log-in" width="28" height="28"></i>
            </div>
            <h1 style="font-size: 26px; font-weight: 800; color: #111827; margin: 0 0 8px 0;">Bon retour !</h1>
            <p style="color: #4b5563; font-size: 14px; margin: 0;">Connectez-vous pour accéder à votre espace.</p>
        </div>

        <?php if(isset($_GET['success']) && $_GET['success'] == 'inscrit'): ?>
            <div style="background: rgba(34,197,94,0.12); color: #166534; border: 1px solid rgba(34,197,94,0.2); padding: 14px; border-radius: 12px; margin-bottom: 24px; text-align: center; font-weight: 700; font-size: 14px; display:flex; align-items:center; justify-content:center; gap:8px;">
                <i data-lucide="check-circle" width="18" height="18"></i> Inscription réussie !
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>auth/connexion" method="POST">
            
            <div class="input-group" style="margin-bottom: 20px;">
                <label for="email" style="display: block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 8px;">Adresse Email</label>
                <div style="position: relative;">
                    <i data-lucide="mail" style="position:absolute; left:16px; top:14px; color:#6b7280; width:18px; height:18px;"></i>
                    <input type="email" name="email" class="input-field" placeholder="etudiant@ucad.edu.sn" value="<?= isset($email) ? $email : '' ?>" style="width:100%; height:48px; box-sizing:border-box; padding-left: 48px; border-radius:12px; border:1px solid #d1d5db; background:white; font-size:14px; <?= !empty($email_err) ? 'border-color: #dc2626; box-shadow: 0 0 0 4px rgba(220,38,38,0.1);' : '' ?>">
                </div>
                <span style="color: #dc2626; font-size: 13px; font-weight:600; margin-top:6px; display:block;"><?= !empty($email_err) ? $email_err : '' ?></span>
            </div>

            <div class="input-group" style="margin-bottom: 32px;">
                <div style="display:flex; justify-content:between; align-items:center; margin-bottom: 8px; width:100%;">
                    <label for="mot_de_passe" style="font-size: 13px; font-weight: 700; color: #374151; flex:1;">Mot de passe</label>
                    <a href="<?= BASE_URL ?>auth/mot-de-passe-oublie" style="font-size:12px; font-weight:700; color: #dc2626; text-decoration:none;">Mot de passe oublié ?</a>
                </div>
                <div style="position: relative;">
                    <i data-lucide="lock" style="position:absolute; left:16px; top:14px; color:#6b7280; width:18px; height:18px;"></i>
                    <input type="password" name="mot_de_passe" class="input-field" placeholder="••••••••" style="width:100%; height:48px; box-sizing:border-box; padding-left: 48px; border-radius:12px; border:1px solid #d1d5db; background:white; font-size:14px; <?= !empty($mot_de_passe_err) ? 'border-color: #dc2626; box-shadow: 0 0 0 4px rgba(220,38,38,0.1);' : '' ?>">
                </div>
                <span style="color: #dc2626; font-size: 13px; font-weight:600; margin-top:6px; display:block;"><?= !empty($mot_de_passe_err) ? $mot_de_passe_err : '' ?></span>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; height: 52px; font-size: 15px; font-weight: 700; background: #dc2626; color:white; border:0; border-radius:14px; display:flex; align-items:center; justify-content:center; gap:8px; cursor:pointer; box-shadow: 0 6px 20px rgba(220,38,38,0.2); transition: background 0.2s;" onmouseover="this.style.background='#b91c1c'" onmouseout="this.style.background='#dc2626'">
                Se connecter <i data-lucide="arrow-right" width="16" height="16"></i>
            </button>

            <div style="text-align: center; margin-top: 32px; font-size: 14px; color: #4b5563; font-weight: 500;">
                Pas encore de compte ? 
                <a href="<?= BASE_URL ?>auth/inscription" style="font-weight: 700; color: #dc2626; text-decoration:none; margin-left:4px;">Créer un compte</a>
            </div>
        </form>
    </div>
</div>

<script>
  lucide.createIcons();
</script>