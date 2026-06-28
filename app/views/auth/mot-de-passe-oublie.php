<script src="https://unpkg.com/lucide@latest"></script>

<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 40px 20px; box-sizing: border-box; background-color: #f7f9fa; background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAxNDAgODAiPjx0ZXh0IHg9IjE1IiB5PSIzMCIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+S0FBWTwvdGV4dD48dGV4dCB4PSIxNSIgeT0iNDUiIGZpbGw9IiNkYzI2MjYiIG9wYWNpdHk9IjAuMDciIGZvbnQtZmFtaWx5PSJzYW5zLXNlcmlmIiBmb250LXdlaWdodD0iOTAwIiBmb250LXNpemU9IjEyIiBsZXR0ZXItc3BhY2luZz0iMC41cHkiPkRFTU08L3RleHQ+PHRleHQgeD0iODUiIHk9IjcwIiBmaWxsPSIjZGMyNjI2IiBvcGFjaXR5PSIwLjA3IiBmb250LWZhbWlseT0ic2Fucy1zZXJpZiIgZm9udC13ZWlnaHQ9IjkwMCIgZm9udC1zaXplPSIxMiIgbGV0dGVyLXNwYWNpbmc9IjAuNXB5Ij5LQUFZPC90ZXh0Pjx0ZXh0IHg9Ijg1IiB5PSI4NSIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+REVNTTwvdGV4dD48L3N2Zz4='); background-repeat: repeat; font-family: system-ui, -apple-system, sans-serif;">
    
    <div class="glass-panel" style="width: 100%; max-width: 460px; padding: 45px; border-radius: 24px; background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); border: 1px solid rgba(229, 231, 235, 0.6); box-shadow: 0 10px 30px rgba(0,0,0,0.03); box-sizing: border-box;">
        
        <div style="text-align: center; margin-bottom: 32px;">
            <h1 style="font-size: 24px; font-weight: 800; color: #111827; margin-bottom: 8px;">Mot de passe oublié</h1>
            <p style="color: #4b5563; font-size: 14px;">Saisissez votre adresse email pour recevoir un lien de récupération.</p>
        </div>

        <?php if(!empty($data['message'])): ?>
            <div style="background: rgba(34,197,94,0.12); color: #166534; border: 1px solid rgba(34,197,94,0.2); padding: 14px; border-radius: 12px; margin-bottom: 24px; text-align: center; font-weight: 700; font-size: 14px;">
                <?= $data['message'] ?>
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>auth/mot-de-passe-oublie" method="POST">
            <div class="input-group" style="margin-bottom: 24px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: #374151; margin-bottom: 8px;">Adresse Email</label>
                <input type="email" name="email" required placeholder="votre-email@ucad.edu.sn" style="width:100%; height:48px; box-sizing:border-box; padding: 0 16px; border-radius:12px; border:1px solid #d1d5db; background:white; font-size:14px;">
            </div>

            <button type="submit" style="width: 100%; height: 52px; font-size: 15px; font-weight: 700; background: #dc2626; color:white; border:0; border-radius:14px; cursor:pointer; box-shadow: 0 6px 20px rgba(220,38,38,0.2);">
                Envoyer le lien
            </button>
        </form>
    </div>
</div>
<script>lucide.createIcons();</script>