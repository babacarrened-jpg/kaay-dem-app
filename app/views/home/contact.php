<section class="max-w-6xl mx-auto px-6 py-16 lg:px-10">
    <div class="text-center mb-16">
        <span class="text-brand-600 font-bold text-sm uppercase tracking-widest">Contact</span>
        <h1 class="text-4xl md:text-5xl font-display font-bold text-slate-900 mt-4">Besoin d'aide ? Contactez-nous</h1>
        <p class="mt-6 text-slate-500 text-lg max-w-3xl mx-auto">Nous sommes là pour répondre à vos questions sur l'application, les trajets ou la création de compte. Écrivez-nous et nous reviendrons vers vous rapidement.</p>
    </div>

    <div class="grid gap-10 lg:grid-cols-[1.2fr_0.8fr]">
        <div class="rounded-3xl bg-white p-10 shadow-glow border border-slate-200">
            <h2 class="text-2xl font-semibold text-slate-900 mb-6">Envoyez-nous un message</h2>

            <?php if (!empty($success)): ?>
                <div class="flex items-center gap-3 rounded-2xl bg-green-50 border border-green-200 px-5 py-4 mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-green-600 shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-green-700 text-sm font-semibold">Message envoyé ! Nous vous répondrons dans les plus brefs délais.</p>
                </div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class="rounded-2xl bg-red-50 border border-red-200 px-5 py-4 mb-6">
                    <p class="text-red-700 font-semibold text-sm mb-2">Veuillez corriger les erreurs suivantes :</p>
                    <ul class="list-disc list-inside space-y-1">
                        <?php foreach ($errors as $err): ?>
                            <li class="text-red-600 text-sm"><?= htmlspecialchars($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>contact/envoyer" method="POST" class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Votre nom</label>
                    <input
                        type="text"
                        name="nom"
                        value="<?= htmlspecialchars($old['nom'] ?? '') ?>"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-3 text-slate-900 outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition-all"
                        placeholder="Nom complet"
                        required
                    >
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-3 text-slate-900 outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition-all"
                        placeholder="adresse@mail.com"
                        required
                    >
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Message</label>
                    <textarea
                        name="message"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-5 py-3 text-slate-900 outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-100 transition-all"
                        rows="6"
                        placeholder="Écrivez votre question..."
                        required
                    ><?= htmlspecialchars($old['message'] ?? '') ?></textarea>
                </div>
                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-2xl bg-brand-600 px-6 py-3 text-sm font-semibold text-white hover:bg-brand-700 transition-all duration-200"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                    </svg>
                    Envoyer le message
                </button>
            </form>
        </div>

        <aside class="rounded-3xl bg-slate-900 text-white p-10 shadow-2xl border border-white/10">
            <h2 class="text-2xl font-semibold mb-6">Informations</h2>
            <div class="space-y-5 text-slate-300">
                <div>
                    <p class="font-semibold text-white">Email</p>
                    <p>support@kaaydem.local</p>
                </div>
                <div>
                    <p class="font-semibold text-white">Téléphone</p>
                    <p>+221 77 123 45 67</p>
                </div>
                <div>
                    <p class="font-semibold text-white">Adresse</p>
                    <p>Dakar, Sénégal</p>
                </div>
            </div>
        </aside>
    </div>
</section>