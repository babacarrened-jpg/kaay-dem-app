<div style="min-height: 80vh; display: flex; align-items: center; justify-content: center; padding: 40px 20px;">
    
    <div class="glass-panel auth-card" style="width: 100%; max-width: 480px; padding: 48px;">
        
        <div style="text-align: center; margin-bottom: 32px;">
            <div style="width: 64px; height: 64px; background: var(--kd-primary-light); color: var(--kd-primary); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; transform: rotate(-5deg);">
                <i data-lucide="log-in" width="32" height="32"></i>
            </div>
            <h1 style="font-size: 28px; margin-bottom: 8px;">Bon retour !</h1>
            <p style="color: var(--text-muted);">Connectez-vous pour accéder à votre espace.</p>
        </div>

        <?php if(isset($_GET['success']) && $_GET['success'] == 'inscrit'): ?>
            <div style="background: var(--kd-primary-light); color: var(--kd-primary); padding: 16px; border-radius: var(--radius-sm); margin-bottom: 24px; text-align: center; font-weight: 500; display:flex; align-items:center; justify-content:center; gap:8px;">
                <i data-lucide="check-circle" width="18" height="18"></i> Inscription réussie !
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>auth/connexion" method="POST">
            
            <div class="input-group">
                <label for="email">Adresse Email</label>
                <div style="position: relative;">
                    <i data-lucide="mail" style="position:absolute; left:16px; top:14px; color:var(--text-muted); width:20px; height:20px;"></i>
                    <input type="email" name="email" class="input-field" placeholder="etudiant@ucad.edu.sn" value="<?= isset($email) ? $email : '' ?>" style="padding-left: 48px; <?= !empty($email_err) ? 'border-color: var(--kd-danger); box-shadow: 0 0 0 4px var(--kd-danger-light);' : '' ?>">
                </div>
                <span style="color: var(--kd-danger); font-size: 13px; font-weight:500; margin-top:4px; display:block;"><?= !empty($email_err) ? $email_err : '' ?></span>
            </div>

            <div class="input-group" style="margin-bottom: 32px;">
                <label for="mot_de_passe" style="display:flex; justify-content:space-between;">
                    Mot de passe
                    <a href="#" style="font-size:12px; font-weight:400;">Mot de passe oublié ?</a>
                </label>
                <div style="position: relative;">
                    <i data-lucide="lock" style="position:absolute; left:16px; top:14px; color:var(--text-muted); width:20px; height:20px;"></i>
                    <input type="password" name="mot_de_passe" class="input-field" placeholder="••••••••" style="padding-left: 48px; <?= !empty($mot_de_passe_err) ? 'border-color: var(--kd-danger); box-shadow: 0 0 0 4px var(--kd-danger-light);' : '' ?>">
                </div>
                <span style="color: var(--kd-danger); font-size: 13px; font-weight:500; margin-top:4px; display:block;"><?= !empty($mot_de_passe_err) ? $mot_de_passe_err : '' ?></span>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; height: 52px; font-size: 16px;">
                Se connecter <i data-lucide="arrow-right"></i>
            </button>

            <div style="text-align: center; margin-top: 32px; font-size: 14px; color:var(--text-muted);">
                Pas encore de compte ? 
                <a href="<?= BASE_URL ?>auth/inscription" style="font-weight: 700;">Créer un compte</a>
            </div>
        </form>
    </div>
</div>
