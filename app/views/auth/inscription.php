<div style="min-height: 80vh; display: flex; align-items: center; justify-content: center; padding: 40px 20px;">
    
    <div class="glass-panel auth-card" style="width: 100%; max-width: 600px; padding: 48px;">
        
        <div style="text-align: center; margin-bottom: 32px;">
            <div style="width: 64px; height: 64px; background: var(--kd-primary-light); color: var(--kd-primary); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; transform: rotate(-5deg);">
                <i data-lucide="user-plus" width="32" height="32"></i>
            </div>
            <h1 style="font-size: 28px; margin-bottom: 8px;">Rejoignez l'aventure</h1>
            <p style="color: var(--text-muted);">Créez votre compte Kaay Dem pour voyager malin.</p>
        </div>

        <form action="<?= BASE_URL ?>auth/inscription" method="POST">
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="input-group">
                    <label>Prénom</label>
                    <div style="position: relative;">
                        <i data-lucide="user" style="position:absolute; left:16px; top:14px; color:var(--text-muted); width:20px; height:20px;"></i>
                        <input type="text" name="prenom" class="input-field" placeholder="Moussa" value="<?= isset($prenom) ? $prenom : '' ?>" style="padding-left: 48px; <?= !empty($prenom_err) ? 'border-color: var(--kd-danger);' : '' ?>">
                    </div>
                    <span style="color: var(--kd-danger); font-size: 13px; font-weight:500; margin-top:4px; display:block;"><?= !empty($prenom_err) ? $prenom_err : '' ?></span>
                </div>
                <div class="input-group">
                    <label>Nom</label>
                    <div style="position: relative;">
                        <i data-lucide="user" style="position:absolute; left:16px; top:14px; color:var(--text-muted); width:20px; height:20px;"></i>
                        <input type="text" name="nom" class="input-field" placeholder="Diop" value="<?= isset($nom) ? $nom : '' ?>" style="padding-left: 48px; <?= !empty($nom_err) ? 'border-color: var(--kd-danger);' : '' ?>">
                    </div>
                    <span style="color: var(--kd-danger); font-size: 13px; font-weight:500; margin-top:4px; display:block;"><?= !empty($nom_err) ? $nom_err : '' ?></span>
                </div>
            </div>

            <div class="input-group">
                <label>Adresse Email</label>
                <div style="position: relative;">
                    <i data-lucide="mail" style="position:absolute; left:16px; top:14px; color:var(--text-muted); width:20px; height:20px;"></i>
                    <input type="email" name="email" class="input-field" placeholder="etudiant@ucad.edu.sn" value="<?= isset($email) ? $email : '' ?>" style="padding-left: 48px; <?= !empty($email_err) ? 'border-color: var(--kd-danger);' : '' ?>">
                </div>
                <span style="color: var(--kd-danger); font-size: 13px; font-weight:500; margin-top:4px; display:block;"><?= !empty($email_err) ? $email_err : '' ?></span>
            </div>

            <div class="input-group">
                <label>Téléphone (Sénégal)</label>
                <div style="position: relative;">
                    <i data-lucide="phone" style="position:absolute; left:16px; top:14px; color:var(--text-muted); width:20px; height:20px;"></i>
                    <input type="text" name="telephone" class="input-field" placeholder="+221 77 000 00 00" value="<?= isset($telephone) ? $telephone : '' ?>" style="padding-left: 48px; <?= !empty($telephone_err) ? 'border-color: var(--kd-danger);' : '' ?>">
                </div>
                <span style="color: var(--kd-danger); font-size: 13px; font-weight:500; margin-top:4px; display:block;"><?= !empty($telephone_err) ? $telephone_err : '' ?></span>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 12px;">
                <div class="input-group">
                    <label>Mot de passe</label>
                    <div style="position: relative;">
                        <i data-lucide="lock" style="position:absolute; left:16px; top:14px; color:var(--text-muted); width:20px; height:20px;"></i>
                        <input type="password" name="mot_de_passe" class="input-field" placeholder="••••••••" style="padding-left: 48px; <?= !empty($mot_de_passe_err) ? 'border-color: var(--kd-danger);' : '' ?>">
                    </div>
                    <span style="color: var(--kd-danger); font-size: 13px; font-weight:500; margin-top:4px; display:block;"><?= !empty($mot_de_passe_err) ? $mot_de_passe_err : '' ?></span>
                </div>
                <div class="input-group">
                    <label>Confirmation</label>
                    <div style="position: relative;">
                        <i data-lucide="shield-check" style="position:absolute; left:16px; top:14px; color:var(--text-muted); width:20px; height:20px;"></i>
                        <input type="password" name="confirmation_mdp" class="input-field" placeholder="••••••••" style="padding-left: 48px; <?= !empty($confirmation_mdp_err) ? 'border-color: var(--kd-danger);' : '' ?>">
                    </div>
                    <span style="color: var(--kd-danger); font-size: 13px; font-weight:500; margin-top:4px; display:block;"><?= !empty($confirmation_mdp_err) ? $confirmation_mdp_err : '' ?></span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; height: 52px; font-size: 16px;">
                Créer mon compte <i data-lucide="user-check"></i>
            </button>

            <div style="text-align: center; margin-top: 32px; font-size: 14px; color:var(--text-muted);">
                Déjà un compte ? 
                <a href="<?= BASE_URL ?>auth/connexion" style="font-weight: 700;">Connectez-vous</a>
            </div>
        </form>
    </div>
</div>
