<script src="https://unpkg.com/lucide@latest"></script>

<div style="
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    box-sizing: border-box;
    background-color: #1a1a2e;
    background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAxNDAgODAiPjx0ZXh0IHg9IjE1IiB5PSIzMCIgZmlsbD0iI2ZmZmZmZiIgb3BhY2l0eT0iMC4wNSIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+QURNSU48L3RleHQ+PC9zdmc+');
    background-repeat: repeat;
    font-family: system-ui, -apple-system, sans-serif;
">
    
    <div style="
        width: 100%; 
        max-width: 460px; 
        padding: 45px;
        border-radius: 24px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border: 1px solid rgba(229, 231, 235, 0.6);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        box-sizing: border-box;
    ">
        
        <div style="text-align: center; margin-bottom: 32px;">
            <div style="width: 60px; height: 60px; background: rgba(30, 58, 138, 0.1); color: #1e3a8a; border: 1px solid rgba(30, 58, 138, 0.2); border-radius: 18px; display: flex; align-items: center; justify-content: center; margin: 0 auto 18px; transform: rotate(-5deg);">
                <i data-lucide="shield" width="28" height="28"></i>
            </div>
            <h1 style="font-size: 26px; font-weight: 800; color: #111827; margin: 0 0 8px 0;">Espace Administrateur</h1>
            <p style="color: #4b5563; font-size: 14px; margin: 0;">Connectez-vous pour accéder au panneau d'administration.</p>
        </div>

        <?php if(!empty($compte_err)): ?>
          <div style="background:#FEE2E2; border:1px solid #fecaca; color:#991B1B; padding:16px 20px; border-radius:12px; margin-bottom:20px; display:flex; align-items:center; gap:12px; font-weight:600;">
          <i data-lucide="ban" width="20" height="20" style="flex-shrink:0;"></i>
          <?= htmlspecialchars($compte_err) ?>
          </div>
        <?php endif; ?>

        <?php if(!empty($role_err)): ?>
          <div style="background:#FEF3C7; border:1px solid #fde68a; color:#92400e; padding:16px 20px; border-radius:12px; margin-bottom:20px; display:flex; align-items:center; gap:12px; font-weight:600;">
          <i data-lucide="alert-triangle" width="20" height="20" style="flex-shrink:0;"></i>
          <?= htmlspecialchars($role_err) ?>
          </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>auth/admin-connexion" method="POST">
            
            <div style="margin-bottom: 20px;">
                <label for="email" style="display: block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 8px;">Adresse Email Admin</label>
                <div style="position: relative;">
                    <i data-lucide="mail" style="position:absolute; left:16px; top:14px; color:#6b7280; width:18px; height:18px;"></i>
                    <input type="email" name="email" placeholder="admin@kaaydem.sn" value="<?= isset($email) ? $email : '' ?>" style="width:100%; height:48px; box-sizing:border-box; padding-left: 48px; border-radius:12px; border:1px solid #d1d5db; background:white; font-size:14px; <?= !empty($email_err) ? 'border-color: #1e3a8a; box-shadow: 0 0 0 4px rgba(30,58,138,0.1);' : '' ?>">
                </div>
                <span style="color: #dc2626; font-size: 13px; font-weight:600; margin-top:6px; display:block;"><?= !empty($email_err) ? $email_err : '' ?></span>
            </div>

            <div style="margin-bottom: 32px;">
                <label for="mot_de_passe" style="display: block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 8px;">Mot de passe</label>
                <div style="position: relative;">
                    <i data-lucide="lock" style="position:absolute; left:16px; top:14px; color:#6b7280; width:18px; height:18px;"></i>
                    <input type="password" name="mot_de_passe" placeholder="••••••••" style="width:100%; height:48px; box-sizing:border-box; padding-left: 48px; border-radius:12px; border:1px solid #d1d5db; background:white; font-size:14px; <?= !empty($mot_de_passe_err) ? 'border-color: #1e3a8a; box-shadow: 0 0 0 4px rgba(30,58,138,0.1);' : '' ?>">
                </div>
                <span style="color: #dc2626; font-size: 13px; font-weight:600; margin-top:6px; display:block;"><?= !empty($mot_de_passe_err) ? $mot_de_passe_err : '' ?></span>
            </div>

            <button type="submit" style="width: 100%; height: 52px; font-size: 15px; font-weight: 700; background: #1e3a8a; color:white; border:0; border-radius:14px; display:flex; align-items:center; justify-content:center; gap:8px; cursor:pointer; box-shadow: 0 6px 20px rgba(30,58,138,0.3); transition: background 0.2s;" onmouseover="this.style.background='#1e40af'" onmouseout="this.style.background='#1e3a8a'">
                Accéder au panneau admin <i data-lucide="arrow-right" width="16" height="16"></i>
            </button>

            <div style="text-align: center; margin-top: 32px; font-size: 14px; color: #6b7280; font-weight: 500;">
                <a href="<?= BASE_URL ?>auth/connexion" style="font-weight: 700; color: #4b5563; text-decoration:none;">← Retour à la connexion utilisateur</a>
            </div>
        </form>
    </div>
</div>

<script>
  lucide.createIcons();
</script>
