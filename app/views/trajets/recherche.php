<script src="https://unpkg.com/lucide@latest"></script>

<div style="
    min-height: 100vh;
    padding: 80px 40px;
    box-sizing: border-box;
    background-color: #f7f9fa;
    background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAxNDAgODAiPjx0ZXh0IHg9IjE1IiB5PSIzMCIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+S0FBWTwvdGV4dD48dGV4dCB4PSIxNSIgeT0iNDUiIGZpbGw9IiNkYzI2MjYiIG9wYWNpdHk9IjAuMDciIGZvbnQtZmFtaWx5PSJzYW5zLXNlcmlmIiBmb250LXdlaWdodD0iOTAwIiBmb250LXNpemU9IjEyIiBsZXR0ZXItc3BhY2luZz0iMC41cHkiPkRFTU08L3RleHQ+PHRleHQgeD0iODUiIHk9IjcwIiBmaWxsPSIjZGMyNjI2IiBvcGFjaXR5PSIwLjA3IiBmb250LWZhbWlseT0ic2Fucy1zZXJpZiIgZm9udC13ZWlnaHQ9IjkwMCIgZm9udC1zaXplPSIxMiIgbGV0dGVyLXNwYWNpbmc9IjAuNXB5Ij5LQUFZPC90ZXh0Pjx0ZXh0IHg9Ijg1IiB5PSI4NSIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+REVNTTwvdGV4dD48L3N2Zz4=');
    background-repeat: repeat;
    font-family: system-ui, -apple-system, sans-serif;
">

    <div style="max-width: 1100px; margin: 0 auto;">
        
        <div class="page-header" style="margin-bottom: 45px;">
            <div class="page-title-group" style="display: flex; align-items: center; gap: 18px;">
                <div class="page-title-icon" style="background: white; border: 1px solid #e5e7eb; border-radius: 12px; width: 54px; height: 54px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                    <i data-lucide="search" style="width: 26px; height: 26px; color: #dc2626;"></i>
                </div>
                <div>
                    <h1 style="margin: 0; font-size: 32px; font-weight: 800; color: #111827; letter-spacing: -0.5px;">Trouver un trajet</h1>
                    <p style="margin: 6px 0 0 0; color: #6b7280; font-size: 15px;">Définissez vos critères pour voyager sereinement.</p>
                </div>
            </div>
        </div>

        <div class="glass-panel" style="
            padding: 50px; 
            border-radius: 24px; 
            background: rgba(255, 255, 255, 0.82); 
            backdrop-filter: blur(16px); 
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(229, 231, 235, 0.6); 
            box-shadow: 0 20px 40px rgba(0,0,0,0.04);
        ">

            <form action="<?= BASE_URL ?>trajets/resultats" method="GET">

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 35px; margin-bottom: 35px;">
                    <div class="input-group">
                        <label style="display: block; margin-bottom: 12px; font-weight: 700; font-size: 14px; color: #1f2937;">
                            Ville de départ
                        </label>
                        <div style="position: relative;">
                            <i data-lucide="map-pin" style="position: absolute; left: 18px; top: 20px; width: 22px; height: 22px; color: #9ca3af;"></i>
                            <select name="depart" style="height: 62px; padding-left: 55px; font-size: 16px; width: 100%; box-sizing: border-box; border: 1px solid #e5e7eb; border-radius: 14px; background: white; color: #111827;">
                                <option value="">Choisir une ville</option>
                                <option value="Dakar">Dakar</option>
                                <option value="Rufisque">Rufisque</option>
                                <option value="Diamniadio">Diamniadio</option>
                            </select>
                        </div>
                    </div>

                    <div class="input-group">
                        <label style="display: block; margin-bottom: 12px; font-weight: 700; font-size: 14px; color: #1f2937;">
                            Ville d'arrivée
                        </label>
                        <div style="position: relative;">
                            <i data-lucide="map-pin" style="position: absolute; left: 18px; top: 20px; width: 22px; height: 22px; color: #9ca3af;"></i>
                            <select name="arrivee" style="height: 62px; padding-left: 55px; font-size: 16px; width: 100%; box-sizing: border-box; border: 1px solid #e5e7eb; border-radius: 14px; background: white; color: #111827;">
                                <option value="">Choisir une ville</option>
                                <option value="Dakar">Dakar</option>
                                <option value="Rufisque">Rufisque</option>
                                <option value="Diamniadio">Diamniadio</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 35px; margin-bottom: 35px;">
                    <div class="input-group">
                        <label style="display: block; margin-bottom: 12px; font-weight: 700; font-size: 14px; color: #1f2937;">
                            Prix minimum (FCFA)
                        </label>
                        <div style="position: relative;">
                            <i data-lucide="tag" style="position: absolute; left: 18px; top: 20px; width: 22px; height: 22px; color: #9ca3af;"></i>
                            <input type="number" name="prix_min" placeholder="0" style="height: 62px; padding-left: 55px; font-size: 16px; width: 100%; box-sizing: border-box; border: 1px solid #e5e7eb; border-radius: 14px; background: white; color: #111827;">
                        </div>
                    </div>

                    <div class="input-group">
                        <label style="display: block; margin-bottom: 12px; font-weight: 700; font-size: 14px; color: #1f2937;">
                            Prix maximum (FCFA)
                        </label>
                        <div style="position: relative;">
                            <i data-lucide="tag" style="position: absolute; left: 18px; top: 20px; width: 22px; height: 22px; color: #9ca3af;"></i>
                            <input type="number" name="prix_max" placeholder="3000" style="height: 62px; padding-left: 55px; font-size: 16px; width: 100%; box-sizing: border-box; border: 1px solid #e5e7eb; border-radius: 14px; background: white; color: #111827;">
                        </div>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 35px; margin-bottom: 35px;">
                    <div class="input-group">
                        <label style="display: block; margin-bottom: 12px; font-weight: 700; font-size: 14px; color: #1f2937;">
                            Places disponibles min
                        </label>
                        <div style="position: relative;">
                            <i data-lucide="users" style="position: absolute; left: 18px; top: 20px; width: 22px; height: 22px; color: #9ca3af;"></i>
                            <input type="number" name="places_min" min="1" placeholder="1" style="height: 62px; padding-left: 55px; font-size: 16px; width: 100%; box-sizing: border-box; border: 1px solid #e5e7eb; border-radius: 14px; background: white; color: #111827;">
                        </div>
                    </div>

                    <div class="input-group">
                        <label style="display: block; margin-bottom: 12px; font-weight: 700; font-size: 14px; color: #1f2937;">
                            Places disponibles max
                        </label>
                        <div style="position: relative;">
                            <i data-lucide="users" style="position: absolute; left: 18px; top: 20px; width: 22px; height: 22px; color: #9ca3af;"></i>
                            <input type="number" name="places_max" min="1" placeholder="5" style="height: 62px; padding-left: 55px; font-size: 16px; width: 100%; box-sizing: border-box; border: 1px solid #e5e7eb; border-radius: 14px; background: white; color: #111827;">
                        </div>
                    </div>
                </div>

                <div class="input-group" style="margin-bottom: 45px;">
                    <label style="display: block; margin-bottom: 12px; font-weight: 700; font-size: 14px; color: #1f2937;">
                        Date du trajet
                    </label>
                    <div style="position: relative;">
                        <i data-lucide="calendar" style="position: absolute; left: 18px; top: 20px; width: 22px; height: 22px; color: #9ca3af;"></i>
                        <input type="date" name="date" style="height: 62px; padding-left: 55px; padding-right: 20px; font-size: 16px; width: 100%; box-sizing: border-box; border: 1px solid #e5e7eb; border-radius: 14px; background: white; color: #111827;">
                    </div>
                </div>

                <div style="display: flex; justify-content: center; width: 100%;">
                    <button type="submit" style="
                        padding: 0 45px;
                        height: 60px;
                        background: #dc2626;
                        color: white;
                        border: none;
                        border-radius: 16px;
                        font-size: 16px;
                        font-weight: 700;
                        cursor: pointer;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 12px;
                        transition: all .25s ease;
                        box-shadow: 0 8px 24px rgba(220, 38, 38, 0.35);
                    "
                    onmouseover="this.style.background='#b91c1c'; this.style.transform='translateY(-2px)';"
                    onmouseout="this.style.background='#dc2626'; this.style.transform='translateY(0)';"
                    >
                        <i data-lucide="search" style="width: 20px; height: 20px;"></i>
                        Lancer la recherche
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>

<script>
  lucide.createIcons();
</script>