<?php
$pageTitle = 'Meine Drinks – VOLTMIX';
require_once 'includes/header.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}
?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0"><i class="bi bi-bookmark-fill text-volt me-2"></i>Meine gespeicherten Drinks</h2>
        <a href="configurator.php" class="btn btn-volt">
            <i class="bi bi-plus-lg me-1"></i>Neuer Mix
        </a>
    </div>

    <div id="saved-configs-container">
        <div class="text-center py-5">
            <div class="spinner-border text-volt" role="status"></div>
            <p class="text-muted mt-2">Lade gespeicherte Konfigurationen...</p>
        </div>
    </div>
</div>

<!-- Toast -->
<div class="vm-toast" id="vm-toast"></div>

<script>
// Flavor- und Extra-Daten für Anzeige (gleiche Daten wie im Konfigurator)
const FLAVOR_MAP = {
    'apfel': '🍏 Grüner Apfel', 'wassermelone': '🍉 Wassermelone', 'pfirsich': '🍑 Pfirsich',
    'birne': '🍐 Williams Birne', 'kirsche': '🍒 Kirsche', 'zitrone': '🍋 Zitrone',
    'limette': '🍈 Citrus Lime', 'grapefruit': '🍊 Pink Grapefruit', 'yuzu': '🟡 Yuzu',
    'blaubeere': '🫐 Blaubeere', 'himbeere': '🍇 Himbeere', 'erdbeere': '🍓 Erdbeere',
    'acai': '🟣 Açaí Berry', 'mango': '🥭 Tropical Mango', 'passionsfr': '🌺 Passionsfrucht',
    'ananas': '🍍 Ananas', 'litschi': '🌸 Litschi', 'cola': '🥤 Cola',
    'original': '⚡ Original Energy', 'icetea': '🧊 Ice Tea', 'gruenertee': '🍵 Grüner Tee Matcha',
    'ingwer': '🫚 Ingwer-Shot', 'minze': '🌿 Arctic Mint'
};

const EXTRA_MAP = {
    'taurin': '💪 Taurin', 'guarana': '🌱 Guarana', 'ltheanin': '🧠 L-Theanin',
    'bvitamine': '💊 B-Vitamine', 'vitaminc': '🍊 Vitamin C', 'magnesium': '⚙️ Magnesium',
    'kreatin': '🏋️ Kreatin', 'ginkgo': '🍃 Ginkgo Biloba', 'zink': '🔩 Zink',
    'coq10': '🔋 Coenzym Q10', 'kollagen': '✨ Kollagen', 'elektrolyte': '💧 Elektrolyte'
};

const SWEETENER_MAP = { 'zucker': 'Zucker', 'stevia': 'Stevia', 'erythrit': 'Erythrit', 'ohne': 'Ohne Süßung' };

document.addEventListener('DOMContentLoaded', loadSavedConfigs);

async function loadSavedConfigs() {
    const container = document.getElementById('saved-configs-container');

    try {
        const res = await fetch('api/load_configs.php');
        const data = await res.json();

        if (!data.configs || data.configs.length === 0) {
            container.innerHTML = `
                <div class="text-center py-5">
                    <div style="font-size:4rem" class="mb-3">�</div>
                    <h4 class="text-muted">Noch keine Pulver-Mixes gespeichert</h4>
                    <p class="text-muted">Starte den Konfigurator und erstelle deinen ersten Pulver-Mix!</p>
                    <a href="configurator.php" class="btn btn-volt mt-2">Jetzt mixen</a>
                </div>
            `;
            return;
        }

        let html = '<div class="row g-4">';
        data.configs.forEach(config => {
            const date = new Date(config.created_at).toLocaleDateString('de-DE', {
                day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit'
            });

            const flavorTags = config.flavors.map(f => 
                `<span class="ingredient-tag">${FLAVOR_MAP[f] || f}</span>`
            ).join('');

            const extraTags = config.extras.map(e => 
                `<span class="ingredient-tag extra">${EXTRA_MAP[e] || e}</span>`
            ).join('');

            html += `
                <div class="col-md-6">
                    <div class="saved-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="fw-bold mb-1" style="font-family:'Russo One',sans-serif">
                                    <span style="display:inline-block;width:14px;height:14px;border-radius:50%;background:${config.can_color};vertical-align:middle;margin-right:6px;border:1px solid rgba(255,255,255,0.2)"></span>
                                    ${config.can_name || 'Unbenannter Drink'}
                                </h5>
                                <small class="text-muted">${date}</small>
                            </div>
                            <span class="text-volt fw-bold" style="font-family:'Russo One',sans-serif; font-size:1.2rem;">
                                ${parseFloat(config.total_price).toFixed(2).replace('.', ',')} €
                            </span>
                        </div>
                        <div class="mt-3">
                            <small class="text-muted">
                                ${config.caffeine_level}mg Koffein · ${config.size_ml}g · ${SWEETENER_MAP[config.sweetener] || config.sweetener}
                            </small>
                        </div>
                        <div class="mt-2">
                            ${flavorTags}${extraTags}
                        </div>
                        <div class="mt-3 d-flex gap-2">
                            <a href="configurator.php" class="btn btn-volt-outline btn-sm">
                                <i class="bi bi-pencil me-1"></i>Neu mixen
                            </a>
                            <button class="btn btn-sm" style="color:var(--volt-muted); border:1px solid var(--volt-border);" onclick="deleteConfig(${config.id}, this)">
                                <i class="bi bi-trash me-1"></i>Löschen
                            </button>
                        </div>
                    </div>
                </div>
            `;
        });
        html += '</div>';
        container.innerHTML = html;

    } catch (err) {
        container.innerHTML = '<div class="alert alert-danger">Fehler beim Laden der Konfigurationen.</div>';
    }
}

async function deleteConfig(configId, btnEl) {
    if (!confirm('Möchtest du diese Konfiguration wirklich löschen?')) return;

    try {
        const res = await fetch('api/delete_config.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ config_id: configId })
        });
        const result = await res.json();

        if (result.success) {
            // Card mit Animation entfernen
            const card = btnEl.closest('.col-md-6');
            card.style.transition = 'opacity 0.3s, transform 0.3s';
            card.style.opacity = '0';
            card.style.transform = 'scale(0.9)';
            setTimeout(() => {
                card.remove();
                // Prüfen ob noch Configs vorhanden
                if (document.querySelectorAll('.saved-card').length === 0) {
                    loadSavedConfigs();
                }
            }, 300);
            showToast('Konfiguration gelöscht.');
        } else {
            showToast(result.error || 'Fehler beim Löschen.', true);
        }
    } catch (err) {
        showToast('Verbindungsfehler.', true);
    }
}

function showToast(message, isError = false) {
    const toast = document.getElementById('vm-toast');
    toast.textContent = message;
    toast.className = 'vm-toast show' + (isError ? ' error' : '');
    setTimeout(() => toast.classList.remove('show'), 3000);
}
</script>

<?php require_once 'includes/footer.php'; ?>
