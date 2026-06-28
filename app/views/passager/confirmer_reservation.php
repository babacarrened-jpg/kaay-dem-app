<div style="max-width: 600px; margin: 40px auto; padding: 0 20px;">

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:32px;">
        <div style="display:flex; align-items:center; gap:16px;">
            <div style="width:56px; height:56px; background:#dc2626; color:white; border-radius:18px; display:flex; align-items:center; justify-content:center;">
                <i data-lucide="ticket" width="28" height="28"></i>
            </div>
            <div>
                <h1 style="font-size:2rem; margin:0;">Confirmer la réservation</h1>
                <p style="margin:4px 0 0; color:#64748b;">Vérifiez les détails avant de réserver.</p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>trajets/detail/<?= $trajet->id ?>"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold border border-slate-200 text-slate-700 hover:bg-slate-50 transition-all duration-200"
           style="text-decoration:none;">
            <i data-lucide="arrow-left" width="16" height="16"></i> Retour
        </a>
    </div>

    <!-- Résumé du trajet -->
    <div class="glass-panel" style="padding:24px; margin-bottom:24px;">
        <h2 style="font-size:20px; font-weight:800; margin:0 0 16px;">
            <?= htmlspecialchars($trajet->ville_depart) ?> → <?= htmlspecialchars($trajet->ville_arrivee) ?>
        </h2>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; font-size:14px; color:#475569;">
            <div><strong>Date :</strong> <?= date('d/m/Y', strtotime($trajet->date_trajet)) ?></div>
            <div><strong>Heure :</strong> <?= substr($trajet->heure_depart, 0, 5) ?></div>
            <div><strong>Prix/place :</strong> <span style="color:#dc2626; font-weight:700;"><?= number_format($trajet->prix_par_place, 0, ',', ' ') ?> F</span></div>
            <div><strong>Places dispo :</strong> <?= $trajet->places_disponibles ?></div>
            <?php if(!empty($trajet->point_depart)): ?>
                <div><strong>RDV départ :</strong> <?= htmlspecialchars($trajet->point_depart) ?></div>
            <?php endif; ?>
            <?php if(!empty($trajet->point_arrivee)): ?>
                <div><strong>Dépose :</strong> <?= htmlspecialchars($trajet->point_arrivee) ?></div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Formulaire -->
    <div class="glass-panel" style="padding:28px;">
        <form action="<?= BASE_URL ?>passager/reserver/<?= $trajet->id ?>" method="POST">

            <div style="margin-bottom:24px;">
                <label style="display:block; font-weight:600; font-size:15px; margin-bottom:8px;">
                    Nombre de places *
                </label>
                <div style="position:relative;">
                    <i data-lucide="users" style="position:absolute; left:16px; top:14px; color:#94a3b8; width:18px; height:18px;"></i>
                    <input type="number" name="places" class="input-field"
                           min="1" max="<?= $trajet->places_disponibles ?>"
                           value="1" required
                           style="padding-left:48px;"
                           oninput="updateTotal(this.value)">
                </div>
            </div>

            <!-- Total dynamique -->
            <div style="background:#f8fafc; border:1px solid #E2E8F0; border-radius:12px; padding:16px 20px; margin-bottom:28px; display:flex; justify-content:space-between; align-items:center;">
                <span style="color:#64748b; font-weight:500;">Total à payer</span>
                <span id="prix-total" style="font-size:24px; font-weight:800; color:#dc2626;">
                    <?= number_format($trajet->prix_par_place, 0, ',', ' ') ?> F
                </span>
            </div>

            <button type="submit"
                class="w-full inline-flex items-center justify-center gap-2 py-4 rounded-xl text-base font-semibold text-white bg-brand-600 hover:bg-brand-700 transition-all duration-200 shadow-md"
                style="border:none; cursor:pointer;">
                <i data-lucide="check-circle" width="20" height="20"></i>
                Confirmer ma réservation
            </button>
        </form>
    </div>
</div>

<script>
const prixParPlace = <?= (float)$trajet->prix_par_place ?>;

function updateTotal(places) {
    const total = prixParPlace * parseInt(places || 1);
    document.getElementById('prix-total').textContent = total.toLocaleString('fr-FR') + ' F';
}
</script>