<?php
$userRole = $_SESSION['user_role'] ?? '';
$isConducteurValide = !empty($_SESSION['est_conducteur_valide']);
$reservations = $reservations ?? [];
?>
<div style="max-width: 1100px; margin: 40px auto; padding: 0 20px;">
    
    <div class="page-header">

     <?php if($userRole !== 'conducteur' && !$isConducteurValide): ?>
<div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-100 mb-8 flex justify-between items-center">
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
            </svg>
        </div>
        <div>
            <p class="font-semibold text-slate-900">Vous voulez conduire ?</p>
            <p class="text-sm text-slate-500">Soumettez votre permis, l'admin validera votre profil.</p>
        </div>
    </div>
    <a href="<?= BASE_URL ?>passager/devenirConducteur" class="px-5 py-2.5 rounded-2xl bg-brand-600 text-white font-semibold text-sm hover:bg-brand-700 transition-colors shadow-sm whitespace-nowrap">
        Devenir conducteur
    </a>
</div>
<?php endif; ?>

<?php if(isset($_GET['success']) && $_GET['success'] === 'demande_envoyee'): ?>
    <div class="bg-green-50 text-green-700 p-4 rounded-xl mb-6 flex items-center gap-3 border border-green-200">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 shrink-0">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-sm font-semibold">Demande envoyée ! L'administrateur va traiter votre dossier.</span>
    </div>
<?php endif; ?>

        <div class="page-title-group">
            <div class="page-title-icon">
                <i data-lucide="ticket" width="28" height="28"></i>
            </div>
            <div>
                <h1>Mon Espace Passager</h1>
                <p>Gérez vos réservations et préparez vos voyages.</p>
            </div>
        </div>
        <a href="<?= BASE_URL ?>trajets/recherche" class="btn btn-primary">
            <i data-lucide="search"></i> Rechercher un trajet
        </a>
    </div>

    <?php if(isset($_GET['success']) && $_GET['success'] == 'reservation_ok'): ?>
        <div style="background: var(--kd-primary-light); color: var(--kd-primary); padding: 16px 20px; border-radius: var(--radius-sm); margin-bottom: 32px; display: flex; align-items: center; gap: 12px;">
            <i data-lucide="check-circle" width="24" height="24"></i>
            <div>
                <strong>Super !</strong> Votre demande de réservation a bien été envoyée au conducteur. Vous pouvez suivre son statut ci-dessous.
            </div>
        </div>
    <?php endif; ?>

    <h3 style="font-size: 20px; margin-bottom: 24px; font-family: 'Outfit'; display: flex; align-items: center; gap: 8px;">
        <i data-lucide="list" width="20" height="20" style="color:var(--text-muted);"></i> Mes Réservations (<?= count($reservations) ?>)
    </h3>

    <?php if(empty($reservations)): ?>
        <div class="glass-panel" style="text-align: center; padding: 60px 20px;">
            <div style="width: 80px; height: 80px; background: var(--kd-bg); color: var(--text-muted); border-radius: 24px; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
                <i data-lucide="ticket" width="40" height="40"></i>
            </div>
            <h3 style="font-size: 24px; margin-bottom: 8px;">Aucune réservation</h3>
            <p style="color: var(--text-muted); margin-bottom: 16px;">Vous n'avez pas encore réservé de trajet.</p>
            <p style="color: var(--text-muted); margin-bottom: 24px; font-weight:600;">Commencez par chercher un trajet et réservez votre ticket de transport en quelques clics.</p>
            <a href="<?= BASE_URL ?>trajets/recherche" class="btn btn-outline">Rechercher maintenant</a>
        </div>
    <?php else: ?>
        <div style="display: flex; flex-direction: column; gap: 16px;">
            <?php foreach($reservations as $res): ?>
                <div class="glass-panel" style="padding: 24px; display: flex; justify-content: space-between; align-items: center; position: relative; overflow: hidden;">
                    
                    <!-- Ligne colorée au hover -->
                    <div style="position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background: var(--kd-primary); transform: scaleY(0); transform-origin: top; transition: var(--transition);" class="card-hover-bar"></div>

                    <div style="flex: 2;">
                        <div style="font-weight: 600; font-size: 13px; color: var(--text-muted); margin-bottom: 8px; display:flex; align-items:center; gap:6px;">
                            <i data-lucide="calendar" width="14" height="14"></i> <?= date('d/m/Y', strtotime($res->date_trajet)) ?> 
                            <span style="color:#CBD5E1;">|</span>
                            <i data-lucide="clock" width="14" height="14"></i> <?= substr($res->heure_depart, 0, 5) ?>
                        </div>
                        <div style="font-family: 'Outfit'; font-weight: 600; font-size: 20px; margin-bottom: 8px; color: var(--text-main); display:flex; align-items:center; gap:12px;">
                            <?= htmlspecialchars($res->ville_depart) ?> 
                            <i data-lucide="arrow-right" width="18" height="18" style="color:var(--text-muted);"></i>
                            <?= htmlspecialchars($res->ville_arrivee) ?>
                        </div>
                        <div style="font-size: 14px; color: var(--text-muted); display:flex; align-items:center; gap:6px;">
                            <i data-lucide="user" width="14" height="14"></i> Conduit par <strong><?= htmlspecialchars($res->conducteur_prenom . ' ' . $res->conducteur_nom) ?></strong>
                        </div>
                    </div>

                    <div style="flex: 1; text-align: center; border-left: 1px solid #E2E8F0; border-right: 1px solid #E2E8F0; padding: 0 20px;">
                        <div style="font-family: 'Outfit'; font-weight: 700; font-size: 24px; color: var(--kd-primary); margin-bottom: 4px;">
                            <?= number_format($res->prix_total, 0, ',', ' ') ?> F
                        </div>
                        <div style="font-size: 13px; color: var(--text-muted); display:flex; align-items:center; justify-content:center; gap:4px;">
                            <i data-lucide="users" width="14" height="14"></i> <?= $res->places_reservees ?> place(s)
                        </div>
                    </div>

                    <div style="flex: 1; display:flex; flex-direction:column; align-items:flex-end; justify-content:space-between; gap:12px; text-align:right;">
                        <div>
                            <?php if($res->statut == 'en_attente'): ?>
                                <span class="status-badge status-pending"><i data-lucide="loader" width="14" height="14"></i> En attente</span>
                            <?php elseif($res->statut == 'confirmee'): ?>
                                <span class="status-badge status-success"><i data-lucide="check" width="14" height="14"></i> Confirmée</span>
                            <?php elseif($res->statut == 'annulee'): ?>
                                <span class="status-badge status-danger"><i data-lucide="x" width="14" height="14"></i> Annulée</span>
                            <?php elseif($res->statut == 'terminee'): ?>
                                <span class="status-badge" style="background:var(--kd-bg); color:var(--text-muted); border:1px solid #E2E8F0;"><i data-lucide="flag" width="14" height="14"></i> Terminée</span>
                            <?php endif; ?>
                        </div>
                        <div style="display:flex; gap:8px; flex-wrap:wrap; justify-content:flex-end;">
                            <a href="<?= BASE_URL ?>passager/reservation/<?= $res->id ?>" class="btn btn-outline" style="padding: 10px 16px; font-size: 13px;">Suivre le trajet</a>
                            <?php if(in_array($res->statut, ['en_attente', 'confirmee'], true)): ?>
                                <form action="<?= BASE_URL ?>passager/reservation/<?= $res->id ?>/annuler" method="POST" onsubmit="return confirm('Annuler cette réservation ?');">
                                    <button type="submit" class="btn btn-outline" style="padding: 10px 16px; font-size: 13px; border-color:#fecaca; color:#b91c1c;">Annuler</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
.glass-panel:hover .card-hover-bar { transform: scaleY(1); }
</style>


