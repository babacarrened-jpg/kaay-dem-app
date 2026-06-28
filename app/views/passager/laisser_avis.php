<div style="max-width: 600px; margin: 40px auto; padding: 0 20px;">

    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:32px;">
        <div style="display:flex; align-items:center; gap:16px;">
            <div style="width:56px; height:56px; background:#dc2626; color:white; border-radius:18px; display:flex; align-items:center; justify-content:center;">
                <i data-lucide="star" width="28" height="28"></i>
            </div>
            <div>
                <h1 style="font-size:2rem; margin:0;">Laisser un avis</h1>
                <p style="margin:4px 0 0; color:#64748b;">Évaluez votre expérience avec ce conducteur.</p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>passager/reservations"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold border border-slate-200 text-slate-700 hover:bg-slate-50 transition-all duration-200"
           style="text-decoration:none;">
            <i data-lucide="arrow-left" width="16" height="16"></i> Retour
        </a>
    </div>

    <!-- Infos trajet -->
    <div class="glass-panel" style="padding:20px; margin-bottom:24px; display:flex; align-items:center; gap:16px;">
        <div style="font-size:32px;">🚗</div>
        <div>
            <div style="font-weight:700; font-size:18px;">
                <?= htmlspecialchars($reservation->ville_depart) ?> → <?= htmlspecialchars($reservation->ville_arrivee) ?>
            </div>
            <div style="color:#64748b; font-size:14px; margin-top:4px;">
                <?= date('d/m/Y', strtotime($reservation->date_trajet)) ?> à <?= substr($reservation->heure_depart, 0, 5) ?>
                · Conducteur : <strong><?= htmlspecialchars($reservation->conducteur_prenom . ' ' . $reservation->conducteur_nom) ?></strong>
            </div>
        </div>
    </div>

    <!-- Formulaire avis -->
    <div class="glass-panel" style="padding:32px;">
        <form action="<?= BASE_URL ?>passager/reservation/<?= $reservation->id ?>/avis" method="POST">

            <!-- Étoiles -->
            <div style="margin-bottom:32px;">
                <label style="display:block; font-weight:600; font-size:16px; margin-bottom:16px;">
                    Votre note *
                </label>
                <div class="star-rating" style="display:flex; gap:8px;">
                    <?php for($i = 5; $i >= 1; $i--): ?>
                        <input type="radio" name="note" id="star<?= $i ?>" value="<?= $i ?>"
                               style="display:none;" <?= $i === 5 ? 'checked' : '' ?>>
                        <label for="star<?= $i ?>"
                               style="font-size:40px; cursor:pointer; color:#d1d5db; transition:color 0.2s;"
                               onmouseover="highlightStars(<?= $i ?>)"
                               onmouseout="resetStars()"
                               onclick="selectStar(<?= $i ?>)">★</label>
                    <?php endfor; ?>
                </div>
                <div id="note-label" style="margin-top:8px; font-size:14px; color:#64748b; font-weight:600;">Excellent !</div>
            </div>

            <!-- Commentaire -->
            <div style="margin-bottom:32px;">
                <label style="display:block; font-weight:600; font-size:16px; margin-bottom:8px;">
                    Commentaire (optionnel)
                </label>
                <textarea name="commentaire" class="input-field"
                          style="height:120px; padding:16px; resize:vertical;"
                          placeholder="Décrivez votre expérience : ponctualité, conduite, amabilité..."></textarea>
            </div>

            <button type="submit"
                class="w-full inline-flex items-center justify-center gap-2 py-4 rounded-xl text-base font-semibold text-white bg-brand-600 hover:bg-brand-700 transition-all duration-200 shadow-md"
                style="border:none; cursor:pointer;">
                <i data-lucide="send" width="18" height="18"></i>
                Envoyer mon avis
            </button>
        </form>
    </div>
</div>

<script>
const labels = { 1: 'Très mauvais 😞', 2: 'Mauvais 😕', 3: 'Correct 😐', 4: 'Bien 😊', 5: 'Excellent ! 🌟' };
let selectedNote = 5;

// Afficher les étoiles dans l'ordre visuel (droite = 1, gauche = 5)
const starLabels = document.querySelectorAll('.star-rating label');

function renderStars(upTo) {
    // Les labels sont en ordre inverse (5,4,3,2,1)
    starLabels.forEach((label, i) => {
        const val = 5 - i;
        label.style.color = val <= upTo ? '#f59e0b' : '#d1d5db';
    });
}

function highlightStars(n) {
    renderStars(n);
    document.getElementById('note-label').textContent = labels[n];
}

function resetStars() {
    renderStars(selectedNote);
    document.getElementById('note-label').textContent = labels[selectedNote];
}

function selectStar(n) {
    selectedNote = n;
    renderStars(n);
}

// Init
renderStars(5);
</script>