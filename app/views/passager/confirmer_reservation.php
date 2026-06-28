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

    <div class="glass-panel" style="
        width: 100%; 
        max-width: 650px; 
        padding: 45px;
        border-radius: 24px;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border: 1px solid rgba(229, 231, 235, 0.6);
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        box-sizing: border-box;
    ">

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:32px;">
            <div style="display:flex; align-items:center; gap:16px;">
                <div style="width:56px; height:56px; background:#dc2626; color:white; border-radius:18px; display:flex; align-items:center; justify-content:center; box-shadow: 0 4px 14px rgba(220,38,38,0.2);">
                    <i data-lucide="ticket" width="28" height="28"></i>
                </div>
                <div>
                    <h1 style="font-size:24px; font-weight:800; color:#111827; margin:0; font-family: 'Outfit', sans-serif;">Confirmer la réservation</h1>
                    <p style="margin:4px 0 0; color:#4b5563; font-size:14px;">Vérifiez les détails avant de réserver.</p>
                </div>
            </div>
            <a href="<?= BASE_URL ?>trajets/detail/<?= $trajet->id ?>"
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold border border-slate-200 text-slate-700 hover:bg-slate-50 transition-all duration-200"
               style="text-decoration:none; background:white;">
                <i data-lucide="arrow-left" width="16" height="16"></i> Retour
            </a>
        </div>

        <div style="padding:24px; margin-bottom:24px; background:white; border: 1px solid #e5e7eb; border-radius:16px;">
            <h2 style="font-size:20px; font-weight:800; margin:0 0 16px; color:#111827; font-family: 'Outfit', sans-serif;">
                <?= htmlspecialchars($trajet->ville_depart) ?> <span style="color: #9ca3af; font-weight: 400;">→</span> <?= htmlspecialchars($trajet->ville_arrivee) ?>
            </h2>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; font-size:14px; color:#4b5563;">
                <div><strong style="color:#111827;">Date :</strong> <?= date('d/m/Y', strtotime($trajet->date_trajet)) ?></div>
                <div><strong style="color:#111827;">Heure :</strong> <?= substr($trajet->heure_depart, 0, 5) ?></div>
                <div><strong style="color:#111827;">Prix/place :</strong> <span style="color:#dc2626; font-weight:700;"><?= number_format($trajet->prix_par_place, 0, ',', ' ') ?> F</span></div>
                <div><strong style="color:#111827;">Places dispo :</strong> <?= $trajet->places_disponibles ?></div>
                <?php if(!empty($trajet->point_depart)): ?>
                    <div style="grid-column: span 2;"><strong style="color:#111827;">RDV départ :</strong> <?= htmlspecialchars($trajet->point_depart) ?></div>
                <?php endif; ?>
                <?php if(!empty($trajet->point_arrivee)): ?>
                    <div style="grid-column: span 2;"><strong style="color:#111827;">Dépose :</strong> <?= htmlspecialchars($trajet->point_arrivee) ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div style="padding:4px;">
            <form action="<?= BASE_URL ?>passager/reserver/<?= $trajet->id ?>" method="POST">

                <div style="margin-bottom:24px;">
                    <label style="display:block; font-weight:700; font-size:14px; color:#374151; margin-bottom:8px;">
                        Nombre de places *
                    </label>
                    <div style="position:relative;">
                        <i data-lucide="users" style="position:absolute; left:16px; top:14px; color:#6b7280; width:18px; height:18px;"></i>
                        <input type="number" name="places" class="input-field"
                               min="1" max="<?= $trajet->places_disponibles ?>"
                               value="1" required
                               style="width:100%; height:48px; box-sizing:border-box; padding-left:48px; border-radius:12px; border:1px solid #d1d5db; background:white; font-size:14px;"
                               oninput="updateTotal(this.value)">
                    </div>
                </div>

                <div style="background:#f8fafc; border:1px solid #e5e7eb; border-radius:14px; padding:16px 20px; margin-bottom:28px; display:flex; justify-content:space-between; align-items:center;">
                    <span style="color:#6b7280; font-weight:600; font-size:14px;">Total à payer</span>
                    <span id="prix-total" style="font-size:24px; font-weight:800; color:#dc2626; font-family: 'Outfit', sans-serif;">
                        <?= number_format($trajet->prix_par_place, 0, ',', ' ') ?> F
                    </span>
                </div>

                <button type="submit"
                    class="btn btn-primary"
                    style="width: 100%; height: 52px; font-size: 15px; font-weight: 700; background: #dc2626; color:white; border:0; border-radius:14px; display:flex; align-items:center; justify-content:center; gap:8px; cursor:pointer; box-shadow: 0 4px 14px rgba(220,38,38,0.2); transition: background 0.2s;"
                    onmouseover="this.style.background='#b91c1c'" 
                    onmouseout="this.style.background='#dc2626'">
                    <i data-lucide="check-circle" width="18" height="18"></i>
                    Confirmer ma réservation
                </button>
            </form>
        </div>
    </div>
</div>

<script>
const prixParPlace = <?= (float)$trajet->prix_par_place ?>;

function updateTotal(places) {
    const total = prixParPlace * parseInt(places || 1);
    document.getElementById('prix-total').textContent = total.toLocaleString('fr-FR') + ' F';
}

lucide.createIcons();
</script>