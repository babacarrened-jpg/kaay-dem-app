<div class="max-w-2xl mx-auto my-10 px-6">
    <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
        
        <div class="flex items-center gap-4 mb-8">
            <div class="w-14 h-14 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-display font-bold text-slate-900">Devenir Conducteur</h1>
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
                <label class="block text-sm font-semibold text-slate-700 mb-2">Permis de conduire (recto)</label>
                <div class="border-2 border-dashed border-slate-200 rounded-2xl p-6 text-center hover:border-brand-400 transition-colors cursor-pointer" onclick="document.getElementById('permis_recto').click()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10 text-slate-300 mx-auto mb-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                    </svg>
                    <p class="text-sm text-slate-500 font-medium">Cliquez pour uploader le recto</p>
                    <p class="text-xs text-slate-400 mt-1">JPG, PNG ou PDF — max 2MB</p>
                    <input type="file" id="permis_recto" name="permis_recto" accept="image/*,.pdf" class="hidden" required onchange="document.getElementById('label_recto').textContent = this.files[0].name">
                </div>
                <p id="label_recto" class="text-xs text-brand-600 font-semibold mt-2"></p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Permis de conduire (verso)</label>
                <div class="border-2 border-dashed border-slate-200 rounded-2xl p-6 text-center hover:border-brand-400 transition-colors cursor-pointer" onclick="document.getElementById('permis_verso').click()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10 text-slate-300 mx-auto mb-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                    </svg>
                    <p class="text-sm text-slate-500 font-medium">Cliquez pour uploader le verso</p>
                    <p class="text-xs text-slate-400 mt-1">JPG, PNG ou PDF — max 2MB</p>
                    <input type="file" id="permis_verso" name="permis_verso" accept="image/*,.pdf" class="hidden" required onchange="document.getElementById('label_verso').textContent = this.files[0].name">
                </div>
                <p id="label_verso" class="text-xs text-brand-600 font-semibold mt-2"></p>
            </div>

            <div class="flex gap-4 pt-2">
                <a href="<?= BASE_URL ?>passager/dashboard" class="flex-1 text-center px-6 py-3 rounded-2xl border border-slate-200 text-slate-600 font-semibold text-sm hover:bg-slate-50 transition-colors">
                    Annuler
                </a>
                <button type="submit" class="flex-1 px-6 py-3 rounded-2xl bg-brand-600 text-white font-semibold text-sm hover:bg-brand-700 transition-colors shadow-sm">
                    Envoyer ma demande
                </button>
            </div>

        </form>
    </div>
</div>