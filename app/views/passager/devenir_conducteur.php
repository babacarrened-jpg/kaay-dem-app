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
        
        <div class="flex items-center gap-4 mb-8">
            <div style="width: 56px; height: 56px; background: rgba(220, 38, 38, 0.08); color: #dc2626; border: 1px solid rgba(220, 38, 38, 0.15);\" class="rounded-2xl flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.124V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-slate-900" style="font-family: 'Outfit', sans-serif;">Devenir Conducteur</h1>
                <p class="text-slate-500 text-sm mt-1">Soumettez votre permis pour validation par l'administrateur.</p>
            </div>
        </div>

        <?php if(isset($_GET['error'])): ?>
            <div class="bg-red-50 text-red-700 p-4 rounded-xl mb-6 flex items-center gap-3 border border-red-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-semibold">
                    <?= $_GET['error'] === 'demande_existante' ? 'Vous avez déjà une demande en attente.' : 'Une erreur est survenue. Réessayez.' ?>
                </span>
            </div>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>passager/devenirConducteur" method="POST" enctype="multipart/form-data" class="space-y-6">
            
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Permis de conduire (recto)</label>
                <div class="border-2 border-dashed border-slate-200 rounded-2xl p-6 text-center hover:border-red-400 transition-colors cursor-pointer bg-white" onclick="document.getElementById('permis_recto').click()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10 text-slate-300 mx-auto mb-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                    </svg>
                    <p class="text-sm text-slate-600 font-semibold">Cliquez pour uploader le recto</p>
                    <p class="text-xs text-slate-400 mt-1">JPG, PNG ou PDF — max 2MB</p>
                    <input type="file" id="permis_recto" name="permis_recto" accept="image/*,.pdf" class="hidden" required onchange="document.getElementById('label_recto').textContent = this.files[0].name">
                </div>
                <p id="label_recto" class="text-xs text-red-600 font-semibold mt-2"></p>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Permis de conduire (verso)</label>
                <div class="border-2 border-dashed border-slate-200 rounded-2xl p-6 text-center hover:border-red-400 transition-colors cursor-pointer bg-white" onclick="document.getElementById('permis_verso').click()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10 text-slate-300 mx-auto mb-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                    </svg>
                    <p class="text-sm text-slate-600 font-semibold">Cliquez pour uploader le verso</p>
                    <p class="text-xs text-slate-400 mt-1">JPG, PNG ou PDF — max 2MB</p>
                    <input type="file" id="permis_verso" name="permis_verso" accept="image/*,.pdf" class="hidden" required onchange="document.getElementById('label_verso').textContent = this.files[0].name">
                </div>
                <p id="label_verso" class="text-xs text-red-600 font-semibold mt-2"></p>
            </div>

            <div class="flex gap-4 pt-4">
                <a href="<?= BASE_URL ?>passager/dashboard" class="flex-1 text-center px-6 py-3.5 rounded-2xl border border-slate-200 text-slate-700 font-bold text-sm bg-white hover:bg-slate-50 transition-colors">
                    Annuler
                </a>
                <button type="submit" class="flex-1 px-6 py-3.5 rounded-2xl text-white font-bold text-sm transition-colors shadow-sm" style="background: #dc2626; box-shadow: 0 4px 14px rgba(220,38,38,0.2);" onmouseover="this.style.background='#b91c1c'" onmouseout="this.style.background='#dc2626'">
                    Envoyer ma demande
                </button>
            </div>

        </form>
    </div>
</div>