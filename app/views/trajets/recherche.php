<script src="https://unpkg.com/lucide@latest"></script>

<div style="max-width:1200px; margin:80px auto; padding:0 40px; font-family: system-ui, -apple-system, sans-serif;">

    <div class="page-header" style="margin-bottom:45px;">
        <div class="page-title-group" style="display: flex; align-items: center; gap: 15px;">
            <div class="page-title-icon" style="background: white; border: 1px solid #e5e7eb; border-radius: 12px; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                <i data-lucide="search" style="width: 24px; height: 24px; color: #dc2626;"></i>
            </div>

            <div>
                <h1 style="margin: 0; font-size: 28px; font-weight: 700; color: #111827;">Trouver un trajet</h1>
                <p style="margin: 5px 0 0 0; color: #6b7280; font-size: 15px;">Définissez vos critères pour voyager sereinement.</p>
            </div>
        </div>
    </div>

    <div class="glass-panel" style="padding:55px; border-radius:20px; background: white; border: 1px solid #f3f4f6; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">

        <form action="<?= BASE_URL ?>trajets/resultats" method="GET">

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:40px;margin-bottom:45px;">

                <div class="input-group">
                    <label style="display:block;margin-bottom:12px;font-weight:600;color: #111827;">
                        Ville de départ
                    </label>

                    <div style="position:relative;">
                        <i data-lucide="map-pin"
                           style="position:absolute;left:18px;top:20px;width:22px;height:22px;color:#9ca3af;"></i>

                        <input
                            type="text"
                            name="depart"
                            class="input-field"
                            placeholder="Ex : Dakar, Rufisque..."
                            style="height:62px;padding-left:55px;font-size:16px;width:100%;box-sizing:border-box;border:1px solid #e5e7eb;border-radius:12px;">
                    </div>
                </div>

                <div class="input-group">
                    <label style="display:block;margin-bottom:12px;font-weight:600;color: #111827;">
                        Ville d'arrivée
                    </label>

                    <div style="position:relative;">
                        <i data-lucide="map-pin"
                           style="position:absolute;left:18px;top:20px;width:22px;height:22px;color:#9ca3af;"></i>

                        <input
                            type="text"
                            name="arrivee"
                            class="input-field"
                            placeholder="Ex : Diamniadio..."
                            style="height:62px;padding-left:55px;font-size:16px;width:100%;box-sizing:border-box;border:1px solid #e5e7eb;border-radius:12px;">
                    </div>
                </div>

            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:40px;margin-bottom:45px;">

                <div class="input-group">
                    <label style="display:block;margin-bottom:12px;font-weight:600;color: #111827;">
                        Prix minimum (FCFA)
                    </label>

                    <div style="position:relative;">
                        <i data-lucide="tag"
                           style="position:absolute;left:18px;top:20px;width:22px;height:22px;color:#9ca3af;"></i>

                        <input
                            type="number"
                            name="prix_min"
                            class="input-field"
                            placeholder="0"
                            style="height:62px;padding-left:55px;font-size:16px;width:100%;box-sizing:border-box;border:1px solid #e5e7eb;border-radius:12px;">
                    </div>
                </div>

                <div class="input-group">
                    <label style="display:block;margin-bottom:12px;font-weight:600;color: #111827;">
                        Prix maximum (FCFA)
                    </label>

                    <div style="position:relative;">
                        <i data-lucide="tag"
                           style="position:absolute;left:18px;top:20px;width:22px;height:22px;color:#9ca3af;"></i>

                        <input
                            type="number"
                            name="prix_max"
                            class="input-field"
                            placeholder="3000"
                            style="height:62px;padding-left:55px;font-size:16px;width:100%;box-sizing:border-box;border:1px solid #e5e7eb;border-radius:12px;">
                    </div>
                </div>

            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:40px;margin-bottom:45px;">

                <div class="input-group">
                    <label style="display:block;margin-bottom:12px;font-weight:600;color: #111827;">
                        Places disponibles min
                    </label>

                    <div style="position:relative;">
                        <i data-lucide="users"
                           style="position:absolute;left:18px;top:20px;width:22px;height:22px;color:#9ca3af;"></i>

                        <input
                            type="number"
                            name="places_min"
                            min="1"
                            class="input-field"
                            placeholder="1"
                            style="height:62px;padding-left:55px;font-size:16px;width:100%;box-sizing:border-box;border:1px solid #e5e7eb;border-radius:12px;">
                    </div>
                </div>

                <div class="input-group">
                    <label style="display:block;margin-bottom:12px;font-weight:600;color: #111827;">
                        Places disponibles max
                    </label>

                    <div style="position:relative;">
                        <i data-lucide="users"
                           style="position:absolute;left:18px;top:20px;width:22px;height:22px;color:#9ca3af;"></i>

                        <input
                            type="number"
                            name="places_max"
                            min="1"
                            class="input-field"
                            placeholder="5"
                            style="height:62px;padding-left:55px;font-size:16px;width:100%;box-sizing:border-box;border:1px solid #e5e7eb;border-radius:12px;">
                    </div>
                </div>

            </div>

            <div class="input-group" style="margin-bottom:50px;">

                <label style="display:block;margin-bottom:12px;font-weight:600;color: #111827;">
                    Date du trajet
                </label>

                <div style="position:relative;">
                    <i data-lucide="calendar"
                       style="position:absolute;left:18px;top:20px;width:22px;height:22px;color:#9ca3af;"></i>

                    <input
                        type="date"
                        name="date"
                        class="input-field"
                        style="height:62px;padding-left:55px;font-size:16px;width:100%;box-sizing:border-box;border:1px solid #e5e7eb;border-radius:12px;">
                </div>

            </div>

            <div style="display: flex; justify-content: center; width: 100%;">
                <button
                    type="submit"
                    style="
                        padding: 0 35px;
                        height:64px;
                        background:#dc2626;
                        color:white;
                        border:none;
                        border-radius:14px;
                        font-size:17px;
                        font-weight:700;
                        cursor:pointer;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        gap:12px;
                        transition:all .3s ease;
                        box-shadow:0 10px 25px rgba(220,38,38,.35);
                    "
                    onmouseover="this.style.background='#b91c1c';this.style.transform='translateY(-2px)'"
                    onmouseout="this.style.background='#dc2626';this.style.transform='translateY(0)'">

                    <i data-lucide="search" style="width: 20px; height: 20px;"></i>
                    Lancer la recherche

                </button>
            </div>

        </form>

    </div>

</div>

<script>
  lucide.createIcons();
</script>