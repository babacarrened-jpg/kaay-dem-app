<?php
$userRole = $_SESSION['user_role'] ?? '';
$isConducteurValide = !empty($_SESSION['est_conducteur_valide']);
$reservations = $reservations ?? [];
?>

<script src="https://unpkg.com/lucide@latest"></script>

<div style="
    min-height: 100vh;
    padding: 40px 20px;
    box-sizing: border-box;
    background-color: #f7f9fa;
    background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNDAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCAxNDAgODAiPjx0ZXh0IHg9IjE1IiB5PSIzMCIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+S0FBWTwvdGV4dD48dGV4dCB4PSIxNSIgeT0iNDUiIGZpbGw9IiNkYzI2MjYiIG9wYWNpdHk9IjAuMDciIGZvbnQtZmFtaWx5PSJzYW5zLXNlcmlmIiBmb250LXdlaWdodD0iOTAwIiBmb250LXNpemU9IjEyIiBsZXR0ZXItc3BhY2luZz0iMC41cHkiPkRFTU08L3RleHQ+PHRleHQgeD0iODUiIHk9IjcwIiBmaWxsPSIjZGMyNjI2IiBvcGFjaXR5PSIwLjA3IiBmb250LWZhbWlseT0ic2Fucy1zZXJpZiIgZm9udC13ZWlnaHQ9IjkwMCIgZm9udC1zaXplPSIxMiIgbGV0dGVyLXNwYWNpbmc9IjAuNXB5Ij5LQUFZPC90ZXh0Pjx0ZXh0IHg9Ijg1IiB5PSI4NSIgZmlsbD0iI2RjMjYyNiIgb3BhY2l0eT0iMC4wNyIgZm9udC1mYW1pbHk9InNhbnMtc2VyaWYiIGZvbnQtd2VpZ2h0PSI5MDAiIGZvbnQtc2l6ZT0iMTIiIGxldHRlci1zcGFjaW5nPSIwLjVweSI+REVNTTwvdGV4dD48L3N2Zz4=');
    background-repeat: repeat;
    font-family: system-ui, -apple-system, sans-serif;
">

    <div class="glass-panel" style="
        max-width: 1100px; 
        margin: 0 auto; 
        padding: 40px;
        border-radius: 24px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border: 1px solid rgba(229, 231, 235, 0.6);
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        box-sizing: border-box;
    ">
        
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
                    <h1 style="margin: 0; font-size: 26px; font-weight: 800; color: #111827;">Mon Espace Passager</h1>
                    <p style="margin: 4px 0 0 0; color: #4b5563; font-size: 14px;">Gérez vos réservations et préparez vos voyages.</p>
                </div>
            </div>
            <a href="<?= BASE_URL ?>trajets/recherche" class="btn btn-primary" style="background: #dc2626; color: white; border: 0; box-shadow: 0 4px 12px rgba(220,38,38,0.15);">
                <i data-lucide="search" width="16" height="16"></i> Rechercher un trajet
            </a>
        </div>

        <?php if(isset($_GET['success']) && $_GET['success'] == 'reservation_ok'): ?>
            <div style="background: rgba(34,197,94,0.12); color: #166534; border: 1px solid rgba(34,197,94,0.2); padding: 16px 20px; border-radius: var(--radius-sm); margin: 24px 0 32px; display: flex; align-items: center; gap: 12px;">
                <i data-lucide="check-circle" width="24" height="24"></i>
                <div>
                    <strong>Super !</strong> Votre demande de réservation a bien été envoyée au conducteur. Vous pouvez suivre son statut ci-dessous.
                </div>
            </div>
        <?php endif; ?>

        <h3 style="font-size: 20px; margin: 32px 0 24px; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 8px; color: #111827;">
            <i data-lucide="list" width="20" height="20" style="color:#6b7280;"></i> Mes Réservations (<?= count($reservations) ?>)
        </h3>

        <?php if(empty($reservations)): ?>
            <div style="text-align: center; padding: 60px 20px; background: rgba(247, 249, 250, 0.5); border-radius: 16px; border: 1px dashed #d1d5db;">
                <div style="width: 80px; height: 80px; background: #fff; color: #6b7280; border: 1px solid #e5e7eb; border-radius: 24px; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px; box-shadow: 0 4px 10px rgba(0,0,0,0.02);">
                    <i data-lucide="ticket" width="40" height="40"></i>
                </div>
                <h3 style="font-size: 22px; margin-bottom: 8px; color:#111827;">Aucune réservation</h3>
                <p style="color: #4b5563; margin-bottom: 16px;">Vous n'avez pas encore réservé de trajet.</p>
                <p style="color: #4b5563; margin-bottom: 24px; font-weight:600;">Commencez par chercher un trajet et réservez votre ticket de transport en quelques clics.</p>
                <a href="<?= BASE_URL ?>trajets/recherche" class="btn btn-outline">Rechercher maintenant</a>
            </div>
        <?php else: ?>
            <div style="display: flex; flex-direction: column; gap: 16px;">
                <?php foreach($reservations as $res): ?>
                    <div class="glass-panel" style="padding: 24px; display: flex; justify-content: space-between; align-items: center; position: relative; overflow: hidden; background: white; border: 1px solid #e5e7eb; border-radius: 16px;">
                        
                        <div style="position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background: #dc2626; transform: scaleY(0); transform-origin: top; transition: 0.2s ease-in-out;" class="card-hover-bar"></div>

                        <div style="flex: 2;">
                            <div style="font-weight: 600; font-size: 13px; color: #6b7280; margin-bottom: 8px; display:flex; align-items:center; gap:6px;">
                                <i data-lucide="calendar" width="14" height="14"></i> <?= date('d/m/Y', strtotime($res->date_trajet)) ?> 
                                <span style="color:#CBD5E1;">|</span>
                                <i data-lucide="clock" width="14" height="14"></i> <?= substr($res->heure_depart, 0, 5) ?>
                            </div>
                            <div style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 20px; margin-bottom: 8px; color: #111827; display:flex; align-items:center; gap:12px;">
                                <?= htmlspecialchars($res->ville_depart) ?> 
                                <i data-lucide="arrow-right" width="18" height="18" style="color:#9ca3af;"></i>
                                <?= htmlspecialchars($res->ville_arrivee) ?>
                            </div>
                            <div style="font-size: 14px; color: #4b5563; display:flex; align-items:center; gap:6px;">
                                <i data-lucide="user" width="14" height="14"></i> Conduit par <strong style="color:#111827;"><?= htmlspecialchars($res->conducteur_prenom . ' ' . $res->conducteur_nom) ?></strong>
                            </div>
                        </div>

                        <div style="flex: 1; text-align: center; border-left: 1px solid #E2E8F0; border-right: 1px solid #E2E8F0; padding: 0 20px;">
                            <div style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 24px; color: #dc2626; margin-bottom: 4px;">
                                <?= number_format($res->prix_total, 0, ',', ' ') ?> F
                            </div>
                            <div style="font-size: 13px; color: #6b7280; display:flex; align-items:center; justify-content:center; gap:4px;">
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
                                    <span class="status-badge" style="background:#f3f4f6; color:#4b5563; border:1px solid #E2E8F0;"><i data-lucide="flag" width="14" height="14"></i> Terminée</span>
                                <?php endif; ?>
                            </div>
                            <div style="display:flex; gap:8px; flex-wrap:wrap; justify-content:flex-end;">
                                <a href="<?= BASE_URL ?>passager/reservation/<?= $res->id ?>" class="btn btn-outline" style="padding: 10px 16px; font-size: 13px; border-radius: 10px;">Suivre le trajet</a>
                                <?php if(in_array($res->statut, ['en_attente', 'confirmee'], true)): ?>
                                    <form action="<?= BASE_URL ?>passager/reservation/<?= $res->id ?>/annuler" method="POST" onsubmit="return confirm('Annuler cette réservation ?');">
                                        <button type="submit" class="btn btn-outline" style="padding: 10px 16px; font-size: 13px; border-radius: 10px; border-color:#fecaca; color:#b91c1c;">Annuler</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
.glass-panel:hover .card-hover-bar { transform: scaleY(1) !important; }
</style>

<script>
  lucide.createIcons();
</script>