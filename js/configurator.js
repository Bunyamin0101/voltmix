/**
 * configurator.js – Hauptlogik des VOLTMIX Energy Pulver Konfigurators
 * Vanilla JS + Bootstrap, keine weiteren Frameworks
 */

// ============================================================
//  DATEN: Geschmacksrichtungen (22+ für Anforderung 4)
// ============================================================
const FLAVORS = [
    // Frucht (5)
    { id: 'apfel',       name: 'Grüner Apfel',     desc: 'Knackig-frisch',             category: 'frucht',   price: 0,    premium: false, emoji: '🍏' },
    { id: 'wassermelone', name: 'Wassermelone',     desc: 'Sommerlich-saftig',           category: 'frucht',   price: 0,    premium: false, emoji: '🍉' },
    { id: 'pfirsich',    name: 'Pfirsich',          desc: 'Weich & süß',                category: 'frucht',   price: 0,    premium: false, emoji: '🍑' },
    { id: 'birne',       name: 'Williams Birne',    desc: 'Aromatisch-mild',            category: 'frucht',   price: 0,    premium: false, emoji: '🍐' },
    { id: 'kirsche',     name: 'Kirsche',           desc: 'Süß-säuerlich',              category: 'frucht',   price: 0,    premium: false, emoji: '🍒' },

    // Zitrus (4)
    { id: 'zitrone',     name: 'Zitrone',           desc: 'Klassisch sauer',            category: 'zitrus',   price: 0,    premium: false, emoji: '🍋' },
    { id: 'limette',     name: 'Citrus Lime',       desc: 'Erfrischend-herb',           category: 'zitrus',   price: 0,    premium: false, emoji: '🍈' },
    { id: 'grapefruit',  name: 'Pink Grapefruit',   desc: 'Bitter-süß',                 category: 'zitrus',   price: 0,    premium: false, emoji: '🍊' },
    { id: 'yuzu',        name: 'Yuzu',              desc: 'Japanische Zitrusfrucht',    category: 'zitrus',   price: 0.30, premium: true,  emoji: '🟡' },

    // Beere (4)
    { id: 'blaubeere',   name: 'Blaubeere',         desc: 'Intensiv-beerig',            category: 'beere',    price: 0,    premium: false, emoji: '🫐' },
    { id: 'himbeere',    name: 'Himbeere',           desc: 'Fruchtig-süß',              category: 'beere',    price: 0,    premium: false, emoji: '🍇' },
    { id: 'erdbeere',    name: 'Erdbeere',           desc: 'Der Klassiker',             category: 'beere',    price: 0,    premium: false, emoji: '🍓' },
    { id: 'acai',        name: 'Açaí Berry',         desc: 'Superfood-Power',           category: 'beere',    price: 0.30, premium: true,  emoji: '🟣' },

    // Exotisch (4)
    { id: 'mango',       name: 'Tropical Mango',    desc: 'Süß & exotisch',            category: 'exotisch', price: 0,    premium: false, emoji: '🥭' },
    { id: 'passionsfr',  name: 'Passionsfrucht',    desc: 'Tropisch-säuerlich',         category: 'exotisch', price: 0,    premium: false, emoji: '🌺' },
    { id: 'ananas',      name: 'Ananas',             desc: 'Süß-tropisch',             category: 'exotisch', price: 0,    premium: false, emoji: '🍍' },
    { id: 'litschi',     name: 'Litschi',            desc: 'Blumig-süß',               category: 'exotisch', price: 0.30, premium: true,  emoji: '🌸' },

    // Classic (3)
    { id: 'cola',        name: 'Cola',               desc: 'Der Kult-Geschmack',       category: 'classic',  price: 0,    premium: false, emoji: '🥤' },
    { id: 'original',    name: 'Original Energy',    desc: 'Klassisch wie du es kennst', category: 'classic', price: 0,    premium: false, emoji: '⚡' },
    { id: 'icetea',      name: 'Ice Tea',            desc: 'Erfrischend-herb',          category: 'classic',  price: 0,    premium: false, emoji: '🧊' },

    // Spezial (3)
    { id: 'gruenertee', name: 'Grüner Tee Matcha',  desc: 'Japanisch-erdig',           category: 'spezial',  price: 0.30, premium: true,  emoji: '🍵' },
    { id: 'ingwer',     name: 'Ingwer-Shot',         desc: 'Scharf & wärmend',         category: 'spezial',  price: 0.30, premium: true,  emoji: '🫚' },
    { id: 'minze',      name: 'Arctic Mint',         desc: 'Eiskalt-erfrischend',      category: 'spezial',  price: 0,    premium: false, emoji: '🌿' },
];

// ============================================================
//  DATEN: Funktionale Extras
// ============================================================
const EXTRAS = [
    { id: 'taurin',     name: 'Taurin',              desc: 'Aminosäure für Ausdauer',       price: 0.30, emoji: '💪' },
    { id: 'guarana',    name: 'Guarana',             desc: 'Natürliches Koffein-Extra',     price: 0.30, emoji: '🌱' },
    { id: 'ltheanin',   name: 'L-Theanin',          desc: 'Fokus ohne Nervosität',         price: 0.30, emoji: '🧠' },
    { id: 'bvitamine', name: 'B-Vitamin Komplex',   desc: 'B6, B12 für Energie',           price: 0.30, emoji: '💊' },
    { id: 'vitaminc',  name: 'Vitamin C',            desc: 'Immunsystem-Boost',            price: 0.30, emoji: '🍊' },
    { id: 'magnesium', name: 'Magnesium',            desc: 'Gegen Müdigkeit',              price: 0.30, emoji: '⚙️' },
    { id: 'kreatin',   name: 'Kreatin',              desc: 'Leistungssteigerung',          price: 0.30, emoji: '🏋️' },
    { id: 'ginkgo',    name: 'Ginkgo Biloba',        desc: 'Konzentration & Gedächtnis',   price: 0.30, emoji: '🍃' },
    { id: 'zink',      name: 'Zink',                 desc: 'Stoffwechsel-Unterstützung',   price: 0.30, emoji: '🔩' },
    { id: 'coq10',     name: 'Coenzym Q10',          desc: 'Zellenergie-Booster',          price: 0.30, emoji: '🔋' },
    { id: 'kollagen',  name: 'Kollagen',             desc: 'Beauty-Boost von innen',       price: 0.30, emoji: '✨' },
    { id: 'elektrolyte', name: 'Elektrolyte',        desc: 'Hydration & Balance',          price: 0.30, emoji: '💧' },
];

// ============================================================
//  PRESETS (vorkonfigurierte Drinks – Extra-Feature)
// ============================================================
const PRESETS = {
    gamer_fuel: {
        name: 'GAMER FUEL',
        caffeine: '200',
        flavors: ['mango', 'limette'],
        extras: ['ltheanin', 'taurin', 'bvitamine'],
        sweetener: 'stevia',
        size: '500',
        color: '#39FF14',
        canName: 'GAMER FUEL'
    },
    focus_flow: {
        name: 'FOCUS FLOW',
        caffeine: '100',
        flavors: ['blaubeere', 'gruenertee'],
        extras: ['ltheanin', 'bvitamine', 'ginkgo'],
        sweetener: 'stevia',
        size: '500',
        color: '#06b6d4',
        canName: 'FOCUS FLOW'
    },
    berry_blast: {
        name: 'BERRY BLAST',
        caffeine: '150',
        flavors: ['blaubeere', 'himbeere', 'acai'],
        extras: ['taurin', 'guarana'],
        sweetener: 'zucker',
        size: '1000',
        color: '#a855f7',
        canName: 'BERRY BLAST'
    }
};

// ============================================================
//  STATE
// ============================================================
let state = {
    step: 1,
    caffeine: { value: '150', price: 0 },
    flavors: [],        // Array of flavor IDs
    extras: [],         // Array of extra IDs
    sweetener: { value: 'stevia', price: 0 },
    size: { value: '500', price: 3.00 },
    canName: '',
    canColor: '#39FF14',
    coupon: null,       // { code, discount }
    basePrice: 3.95
};

// ============================================================
//  INITIALISIERUNG
// ============================================================
document.addEventListener('DOMContentLoaded', function () {
    renderFlavors();
    renderExtras();
    setupStepNavigation();
    setupCaffeineSelection();
    setupSweetenerSelection();
    setupSizeSelection();
    setupColorSelection();
    setupCanNameInput();
    setupFlavorFilter();
    updatePreview();
    renderCanSVG();

    // Preset laden (Extra-Feature: Vorkonfigurierte Produkte)
    if (PRESET_PARAM && PRESETS[PRESET_PARAM]) {
        loadPreset(PRESET_PARAM);
    }
});

// ============================================================
//  STEP NAVIGATION
// ============================================================
function setupStepNavigation() {
    document.querySelectorAll('.config-step-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            goToStep(parseInt(btn.dataset.step));
        });
    });
}

function goToStep(step) {
    // Update state
    state.step = step;

    // Update step buttons
    document.querySelectorAll('.config-step-btn').forEach(btn => {
        const btnStep = parseInt(btn.dataset.step);
        btn.classList.remove('active');
        if (btnStep === step) btn.classList.add('active');
    });

    // Update panels
    document.querySelectorAll('.step-panel').forEach(panel => {
        panel.classList.remove('active');
    });
    document.getElementById('step-' + step).classList.add('active');

    // Bei Zusammenfassung -> Summary rendern
    if (step === 6) {
        renderSummary();
    }

    // Scroll nach oben
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// ============================================================
//  STEP 1: KOFFEIN
// ============================================================
function setupCaffeineSelection() {
    document.querySelectorAll('#caffeine-grid .radio-card').forEach(card => {
        card.addEventListener('click', () => {
            document.querySelectorAll('#caffeine-grid .radio-card').forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');
            state.caffeine = {
                value: card.dataset.value,
                price: parseFloat(card.dataset.price)
            };
            updatePreview();
        });
    });
}

// ============================================================
//  STEP 2: GESCHMACK (22 Optionen!)
// ============================================================
function renderFlavors() {
    const grid = document.getElementById('flavor-grid');
    grid.innerHTML = '';

    // Gruppiert nach Kategorie rendern
    const categories = {
        frucht: 'Frucht',
        zitrus: 'Zitrus',
        beere: 'Beere',
        exotisch: 'Exotisch',
        classic: 'Classic',
        spezial: 'Spezial'
    };

    for (const [catKey, catLabel] of Object.entries(categories)) {
        const catFlavors = FLAVORS.filter(f => f.category === catKey);
        if (catFlavors.length === 0) continue;

        const header = document.createElement('div');
        header.className = 'category-header';
        header.textContent = catLabel;
        header.dataset.category = catKey;
        grid.appendChild(header);

        catFlavors.forEach(flavor => {
            const card = document.createElement('div');
            card.className = 'option-card' + (state.flavors.includes(flavor.id) ? ' selected' : '');
            card.dataset.id = flavor.id;
            card.dataset.category = flavor.category;
            card.innerHTML = `
                <div class="option-icon" style="background:rgba(57,255,20,0.08); font-size:1.8rem;">${flavor.emoji}</div>
                <div>
                    <div class="option-name">${flavor.name} ${flavor.premium ? '<span class="badge bg-warning text-dark" style="font-size:0.6rem;">PREMIUM</span>' : ''}</div>
                    <div class="option-desc">${flavor.desc}</div>
                    ${flavor.price > 0 ? `<div class="option-price">+${flavor.price.toFixed(2).replace('.', ',')} €</div>` : '<div class="option-price">Inklusive</div>'}
                </div>
            `;
            card.addEventListener('click', () => toggleFlavor(flavor.id, card));
            grid.appendChild(card);
        });
    }
}

function toggleFlavor(flavorId, cardEl) {
    const idx = state.flavors.indexOf(flavorId);
    if (idx > -1) {
        // Entfernen
        state.flavors.splice(idx, 1);
        cardEl.classList.remove('selected');
    } else {
        // Max 3 Flavors
        if (state.flavors.length >= 3) {
            showToast('Maximal 3 Geschmacksrichtungen wählbar!', true);
            return;
        }
        state.flavors.push(flavorId);
        cardEl.classList.add('selected');
    }
    updatePreview();
}

// Suche & Filterung (Extra-Feature)
function setupFlavorFilter() {
    // Kategorie-Filter
    document.querySelectorAll('.filter-tag').forEach(tag => {
        tag.addEventListener('click', () => {
            document.querySelectorAll('.filter-tag').forEach(t => t.classList.remove('active'));
            tag.classList.add('active');
            filterFlavors();
        });
    });

    // Text-Suche
    document.getElementById('flavor-search').addEventListener('input', filterFlavors);
}

function filterFlavors() {
    const activeCategory = document.querySelector('.filter-tag.active')?.dataset.category || 'all';
    const searchTerm = document.getElementById('flavor-search').value.toLowerCase().trim();

    document.querySelectorAll('#flavor-grid .option-card').forEach(card => {
        const matchesCategory = activeCategory === 'all' || card.dataset.category === activeCategory;
        const flavor = FLAVORS.find(f => f.id === card.dataset.id);
        const matchesSearch = !searchTerm ||
            flavor.name.toLowerCase().includes(searchTerm) ||
            flavor.desc.toLowerCase().includes(searchTerm);

        card.style.display = (matchesCategory && matchesSearch) ? '' : 'none';
    });

    // Kategorie-Header ein-/ausblenden
    document.querySelectorAll('#flavor-grid .category-header').forEach(header => {
        const cat = header.dataset.category;
        const matchesCat = activeCategory === 'all' || cat === activeCategory;
        header.style.display = matchesCat ? '' : 'none';
    });
}

// ============================================================
//  STEP 3: EXTRAS
// ============================================================
function renderExtras() {
    const grid = document.getElementById('extras-grid');
    grid.innerHTML = '';

    EXTRAS.forEach(extra => {
        const card = document.createElement('div');
        card.className = 'option-card' + (state.extras.includes(extra.id) ? ' selected' : '');
        card.dataset.id = extra.id;
        card.innerHTML = `
            <div class="option-icon" style="background:rgba(6,182,212,0.08); font-size:1.8rem;">${extra.emoji}</div>
            <div>
                <div class="option-name">${extra.name}</div>
                <div class="option-desc">${extra.desc}</div>
                <div class="option-price">+${extra.price.toFixed(2).replace('.', ',')} €</div>
            </div>
        `;
        card.addEventListener('click', () => toggleExtra(extra.id, card));
        grid.appendChild(card);
    });
}

function toggleExtra(extraId, cardEl) {
    const idx = state.extras.indexOf(extraId);
    if (idx > -1) {
        state.extras.splice(idx, 1);
        cardEl.classList.remove('selected');
    } else {
        state.extras.push(extraId);
        cardEl.classList.add('selected');
    }
    updatePreview();
}

// ============================================================
//  STEP 4: SÜßUNG & GRÖßE
// ============================================================
function setupSweetenerSelection() {
    document.querySelectorAll('#sweetener-grid .radio-card').forEach(card => {
        card.addEventListener('click', () => {
            document.querySelectorAll('#sweetener-grid .radio-card').forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');
            state.sweetener = {
                value: card.dataset.value,
                price: parseFloat(card.dataset.price)
            };
            updatePreview();
        });
    });
}

function setupSizeSelection() {
    document.querySelectorAll('#size-grid .radio-card').forEach(card => {
        card.addEventListener('click', () => {
            document.querySelectorAll('#size-grid .radio-card').forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');
            state.size = {
                value: card.dataset.value,
                price: parseFloat(card.dataset.price)
            };
            updatePreview();
        });
    });
}

// ============================================================
//  STEP 5: DESIGN
// ============================================================
function setupColorSelection() {
    document.querySelectorAll('#color-options .color-swatch').forEach(swatch => {
        swatch.addEventListener('click', () => {
            document.querySelectorAll('#color-options .color-swatch').forEach(s => s.classList.remove('selected'));
            swatch.classList.add('selected');
            state.canColor = swatch.dataset.color;
            updatePreview();
            renderCanSVG();
        });
    });
}

function setupCanNameInput() {
    document.getElementById('can-name').addEventListener('input', function () {
        state.canName = this.value.toUpperCase();
        updatePreview();
        renderCanSVG();
    });
}

// ============================================================
//  PREIS BERECHNUNG
// ============================================================
function calculatePrice() {
    let price = state.basePrice;

    // Koffein-Aufpreis
    price += state.caffeine.price;

    // Geschmack-Aufpreise (Premium-Flavors)
    state.flavors.forEach(fId => {
        const flavor = FLAVORS.find(f => f.id === fId);
        if (flavor) price += flavor.price;
    });

    // Extras
    state.extras.forEach(eId => {
        const extra = EXTRAS.find(e => e.id === eId);
        if (extra) price += extra.price;
    });

    // Süßung
    price += state.sweetener.price;

    // Größe
    price += state.size.price;

    return price;
}

function calculateDiscountedPrice() {
    const price = calculatePrice();
    if (state.coupon) {
        return price * (1 - state.coupon.discount / 100);
    }
    return price;
}

function formatPrice(price) {
    return price.toFixed(2).replace('.', ',') + ' €';
}

// ============================================================
//  LIVE PREVIEW AKTUALISIEREN
// ============================================================
function updatePreview() {
    // Name
    const nameEl = document.getElementById('preview-name');
    nameEl.textContent = state.canName || 'DEIN MIX';

    // Details
    const detailsEl = document.getElementById('preview-details');
    detailsEl.textContent = `${state.caffeine.value}mg Koffein · ${state.size.value}g`;

    // Preis
    const priceEl = document.getElementById('preview-price');
    const originalPrice = calculatePrice();
    const finalPrice = calculateDiscountedPrice();

    if (state.coupon) {
        priceEl.innerHTML = `<span class="summary-original-price">${formatPrice(originalPrice)}</span>${formatPrice(finalPrice)}`;
    } else {
        priceEl.textContent = formatPrice(originalPrice);
    }

    // Ingredients
    const ingredientsEl = document.getElementById('preview-ingredients');
    let html = '<small class="text-muted d-block mb-2">Zutaten & Extras:</small>';

    if (state.flavors.length === 0 && state.extras.length === 0) {
        html += '<span class="ingredient-tag">Wähle Geschmack...</span>';
    } else {
        state.flavors.forEach(fId => {
            const flavor = FLAVORS.find(f => f.id === fId);
            if (flavor) html += `<span class="ingredient-tag">${flavor.emoji} ${flavor.name}</span>`;
        });
        state.extras.forEach(eId => {
            const extra = EXTRAS.find(e => e.id === eId);
            if (extra) html += `<span class="ingredient-tag extra">${extra.emoji} ${extra.name}</span>`;
        });
    }
    ingredientsEl.innerHTML = html;

    // SVG aktualisieren
    renderCanSVG();
}

// ============================================================
//  SVG DOSEN-PREVIEW (visuelle Darstellung)
// ============================================================
function renderCanSVG() {
    const container = document.getElementById('can-preview-svg');
    const color = state.canColor;
    const name = state.canName || 'VOLTMIX';

    // Helligkeit der Farbe bestimmen für Textfarbe
    const textColor = isLightColor(color) ? '#0a0e17' : '#ffffff';
    const portions = Math.floor(parseInt(state.size.value) / 30);
    const sizeVal = parseInt(state.size.value);

    // Dimensionen je nach Dosengröße
    let tubW, tubH, tubX, lidW, lidX, viewW, viewH;
    if (sizeVal <= 300) {
        // Klein / Standard
        tubW = 120; tubH = 190; tubX = 30;
        lidW = 130; lidX = 25;
        viewW = 180; viewH = 270;
    } else if (sizeVal <= 500) {
        // Medium
        tubW = 140; tubH = 220; tubX = 20;
        lidW = 150; lidX = 15;
        viewW = 180; viewH = 300;
    } else {
        // Groß (1000g)
        tubW = 156; tubH = 260; tubX = 12;
        lidW = 166; lidX = 7;
        viewW = 180; viewH = 340;
    }

    const cx = viewW / 2;
    const lidY = 32;
    const tubY = lidY + 18;
    const tubBottom = tubY + tubH;
    const labelY = tubY + 35;
    const labelH = Math.min(130, tubH * 0.5);
    const labelMidY = labelY + labelH / 2;

    container.innerHTML = `
        <svg viewBox="0 0 ${viewW} ${viewH}" xmlns="http://www.w3.org/2000/svg" style="transition: all 0.4s ease;">
            <defs>
                <linearGradient id="tubBodyGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:${adjustBrightness(color, -50)}"/>
                    <stop offset="20%" style="stop-color:${adjustBrightness(color, -20)}"/>
                    <stop offset="50%" style="stop-color:${adjustBrightness(color, 20)}"/>
                    <stop offset="80%" style="stop-color:${adjustBrightness(color, -20)}"/>
                    <stop offset="100%" style="stop-color:${adjustBrightness(color, -50)}"/>
                </linearGradient>
                <linearGradient id="tubLidGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:#1a1a1a"/>
                    <stop offset="50%" style="stop-color:#3a3a3a"/>
                    <stop offset="100%" style="stop-color:#1a1a1a"/>
                </linearGradient>
                <linearGradient id="tubShine" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:rgba(255,255,255,0); stop-opacity:0"/>
                    <stop offset="35%" style="stop-color:rgba(255,255,255,0.08); stop-opacity:0.08"/>
                    <stop offset="50%" style="stop-color:rgba(255,255,255,0.18); stop-opacity:0.18"/>
                    <stop offset="65%" style="stop-color:rgba(255,255,255,0.08); stop-opacity:0.08"/>
                    <stop offset="100%" style="stop-color:rgba(255,255,255,0); stop-opacity:0"/>
                </linearGradient>
            </defs>
            
            <!-- Shadow -->
            <ellipse cx="${cx}" cy="${tubBottom - 6}" rx="${tubW / 2 - 8}" ry="5" fill="rgba(0,0,0,0.25)"/>
            
            <!-- Tub body -->
            <rect x="${tubX}" y="${tubY}" width="${tubW}" height="${tubH}" rx="12" fill="url(#tubBodyGrad)"/>
            
            <!-- Shine overlay -->
            <rect x="${tubX}" y="${tubY}" width="${tubW}" height="${tubH}" rx="12" fill="url(#tubShine)"/>
            
            <!-- Lid -->
            <rect x="${lidX}" y="${lidY}" width="${lidW}" height="24" rx="8" fill="url(#tubLidGrad)"/>
            <ellipse cx="${cx}" cy="${lidY}" rx="${lidW / 2}" ry="9" fill="#333"/>
            <ellipse cx="${cx}" cy="${lidY}" rx="${lidW / 2 - 12}" ry="6" fill="#444"/>
            <!-- Lid grip -->
            <line x1="${cx - 40}" y1="${lidY}" x2="${cx + 40}" y2="${lidY}" stroke="#555" stroke-width="0.5"/>
            <line x1="${cx - 35}" y1="${lidY + 4}" x2="${cx + 35}" y2="${lidY + 4}" stroke="#555" stroke-width="0.3"/>
            
            <!-- VOLTMIX Logo -->
            <text x="${cx}" y="${labelY + 26}" text-anchor="middle" fill="${textColor}" font-family="'Russo One', sans-serif" font-size="${sizeVal >= 1000 ? '17' : '15'}" letter-spacing="2" opacity="0.9">VOLTMIX</text>
            
            <!-- Lightning icon -->
            <path d="M${cx - 4} ${labelY + 34} L${cx + 4} ${labelY + 34} L${cx} ${labelY + 48} L${cx + 12} ${labelY + 44} L${cx - 4} ${labelY + 68} L${cx} ${labelY + 54} L${cx - 12} ${labelY + 58} Z" fill="${textColor}" opacity="0.7"/>
            
            <!-- Custom name -->
            <text x="${cx}" y="${labelY + labelH - 10}" text-anchor="middle" fill="${textColor}" font-family="'Russo One', sans-serif" font-size="${name.length > 10 ? '9' : '11'}" letter-spacing="1" opacity="0.95">${escapeHtml(name)}</text>
            
            <!-- Separator -->
            <line x1="${tubX + 20}" y1="${labelY + labelH + 4}" x2="${tubX + tubW - 20}" y2="${labelY + labelH + 4}" stroke="${textColor}" stroke-width="0.5" opacity="0.3"/>
            
            <!-- Caffeine info -->
            <text x="${cx}" y="${labelY + labelH + 18}" text-anchor="middle" fill="${textColor}" font-family="'Exo 2', sans-serif" font-size="7" letter-spacing="1.5" opacity="0.6">${state.caffeine.value}MG CAFFEINE / PORTION</text>
            
            <!-- Size info -->
            <text x="${cx}" y="${tubBottom - 22}" text-anchor="middle" fill="${textColor}" font-family="'Exo 2', sans-serif" font-size="8" opacity="0.5">${state.size.value}g · ~${portions} Portionen</text>
            

            
            <!-- Top decorative stripe -->
            <rect x="${tubX}" y="${tubY + 14}" width="${tubW}" height="3" fill="${textColor}" opacity="0.15"/>
            <rect x="${tubX}" y="${tubY + 21}" width="${tubW}" height="1" fill="${textColor}" opacity="0.08"/>
            
            <!-- Glow border -->
            <rect x="${tubX}" y="${tubY}" width="${tubW}" height="${tubH}" rx="12" fill="none" stroke="${textColor}" stroke-width="0.5" opacity="0.15"/>
        </svg>
    `;
}

// Hilfsfunktionen für Farben
function adjustBrightness(hex, amount) {
    hex = hex.replace('#', '');
    if (hex.length === 3) hex = hex.split('').map(c => c + c).join('');
    const num = parseInt(hex, 16);
    let r = Math.min(255, Math.max(0, (num >> 16) + amount));
    let g = Math.min(255, Math.max(0, ((num >> 8) & 0x00FF) + amount));
    let b = Math.min(255, Math.max(0, (num & 0x0000FF) + amount));
    return '#' + (r << 16 | g << 8 | b).toString(16).padStart(6, '0');
}

function isLightColor(hex) {
    hex = hex.replace('#', '');
    if (hex.length === 3) hex = hex.split('').map(c => c + c).join('');
    const r = parseInt(hex.substr(0, 2), 16);
    const g = parseInt(hex.substr(2, 2), 16);
    const b = parseInt(hex.substr(4, 2), 16);
    const luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;
    return luminance > 0.6;
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// ============================================================
//  STEP 6: ZUSAMMENFASSUNG
// ============================================================
function renderSummary() {
    const summaryEl = document.getElementById('summary-content');
    const priceSummaryEl = document.getElementById('price-summary');

    // Ausgewählte Daten
    const sweetenerLabels = { zucker: 'Zucker', stevia: 'Stevia', erythrit: 'Erythrit', ohne: 'Ohne Süßung' };

    let html = '';

    // Basis & Koffein
    html += `
        <div class="summary-section">
            <h5><i class="bi bi-lightning-charge me-2 text-volt"></i>Basis</h5>
            <div class="summary-row">
                <span class="label">Koffein-Level</span>
                <span>${state.caffeine.value}mg${state.caffeine.price > 0 ? ' (+' + formatPrice(state.caffeine.price) + ')' : ''}</span>
            </div>
        </div>
    `;

    // Geschmack
    html += `<div class="summary-section"><h5><i class="bi bi-droplet-half me-2 text-volt"></i>Geschmack</h5>`;
    if (state.flavors.length === 0) {
        html += '<p class="text-muted">Keine Geschmacksrichtung gewählt</p>';
    } else {
        state.flavors.forEach(fId => {
            const f = FLAVORS.find(fl => fl.id === fId);
            if (f) {
                html += `<div class="summary-row">
                    <span>${f.emoji} ${f.name} ${f.premium ? '(Premium)' : ''}</span>
                    <span>${f.price > 0 ? '+' + formatPrice(f.price) : 'Inklusive'}</span>
                </div>`;
            }
        });
    }
    html += '</div>';

    // Extras
    html += `<div class="summary-section"><h5><i class="bi bi-capsule me-2 text-volt"></i>Funktionale Extras</h5>`;
    if (state.extras.length === 0) {
        html += '<p class="text-muted">Keine Extras gewählt</p>';
    } else {
        state.extras.forEach(eId => {
            const e = EXTRAS.find(ex => ex.id === eId);
            if (e) {
                html += `<div class="summary-row">
                    <span>${e.emoji} ${e.name}</span>
                    <span>+${formatPrice(e.price)}</span>
                </div>`;
            }
        });
    }
    html += '</div>';

    // Süßung, Größe, Design
    html += `
        <div class="summary-section">
            <h5><i class="bi bi-cup-straw me-2 text-volt"></i>Süßung & Größe</h5>
            <div class="summary-row">
                <span class="label">Süßungsmittel</span>
                <span>${sweetenerLabels[state.sweetener.value] || state.sweetener.value}${state.sweetener.price > 0 ? ' (+' + formatPrice(state.sweetener.price) + ')' : ''}</span>
            </div>
            <div class="summary-row">
                <span class="label">Dosengröße</span>
                <span>${state.size.value}g${state.size.price > 0 ? ' (+' + formatPrice(state.size.price) + ')' : ''}</span>
            </div>

        </div>
        <div class="summary-section">
            <h5><i class="bi bi-palette me-2 text-volt"></i>Design</h5>
            <div class="summary-row">
                <span class="label">Name auf der Dose</span>
                <span>${state.canName || '(keiner)'}</span>
            </div>
            <div class="summary-row">
                <span class="label">Dosenfarbe</span>
                <span><span style="display:inline-block;width:18px;height:18px;border-radius:50%;background:${state.canColor};vertical-align:middle;border:1px solid rgba(255,255,255,0.2)"></span></span>
            </div>
        </div>
    `;

    summaryEl.innerHTML = html;

    // Preisübersicht
    const originalPrice = calculatePrice();
    const finalPrice = calculateDiscountedPrice();

    let priceHtml = '<h5><i class="bi bi-calculator me-2 text-volt"></i>Preisübersicht</h5>';
    priceHtml += `<div class="summary-row"><span class="label">Basispreis (${state.size.value}g Dose)</span><span>${formatPrice(state.basePrice)}</span></div>`;

    if (state.caffeine.price > 0)
        priceHtml += `<div class="summary-row"><span class="label">Koffein 200mg</span><span>+${formatPrice(state.caffeine.price)}</span></div>`;

    const flavorCost = state.flavors.reduce((sum, fId) => {
        const f = FLAVORS.find(fl => fl.id === fId);
        return sum + (f ? f.price : 0);
    }, 0);
    if (flavorCost > 0)
        priceHtml += `<div class="summary-row"><span class="label">Premium-Geschmack</span><span>+${formatPrice(flavorCost)}</span></div>`;

    const extraCost = state.extras.length * 0.30;
    if (extraCost > 0)
        priceHtml += `<div class="summary-row"><span class="label">${state.extras.length}x Extras</span><span>+${formatPrice(extraCost)}</span></div>`;

    if (state.sweetener.price > 0)
        priceHtml += `<div class="summary-row"><span class="label">Süßungsmittel</span><span>+${formatPrice(state.sweetener.price)}</span></div>`;

    if (state.size.price > 0)
        priceHtml += `<div class="summary-row"><span class="label">Größenaufpreis</span><span>+${formatPrice(state.size.price)}</span></div>`;

    priceHtml += '<hr class="border-secondary my-2">';

    if (state.coupon) {
        priceHtml += `<div class="summary-row"><span class="label">Zwischensumme</span><span>${formatPrice(originalPrice)}</span></div>`;
        priceHtml += `<div class="summary-row"><span class="label text-volt">Gutschein (${state.coupon.code}) -${state.coupon.discount}%</span><span class="text-volt">-${formatPrice(originalPrice - finalPrice)}</span></div>`;
        priceHtml += '<hr class="border-secondary my-2">';
    }

    priceHtml += `<div class="summary-row"><span class="fw-bold">Gesamtpreis</span><span class="summary-total">${formatPrice(finalPrice)}</span></div>`;

    priceSummaryEl.innerHTML = priceHtml;
}

// ============================================================
//  GUTSCHEIN (Extra-Feature)
// ============================================================
async function applyCoupon() {
    const code = document.getElementById('coupon-input').value.trim();
    const feedbackEl = document.getElementById('coupon-feedback');

    if (!code) {
        feedbackEl.innerHTML = '<span class="text-danger">Bitte einen Code eingeben.</span>';
        return;
    }

    try {
        const res = await fetch('api/coupon.php?code=' + encodeURIComponent(code));
        const result = await res.json();

        if (result.valid) {
            state.coupon = { code: result.code, discount: result.discount };
            feedbackEl.innerHTML = `<span class="text-volt"><i class="bi bi-check-circle me-1"></i>${result.discount}% Rabatt angewendet!</span>`;
            updatePreview();
            renderSummary();
            showToast(`Gutschein "${result.code}" eingelöst – ${result.discount}% Rabatt!`);
        } else {
            feedbackEl.innerHTML = `<span class="text-danger"><i class="bi bi-x-circle me-1"></i>${result.error || 'Ungültiger Code.'}</span>`;
        }
    } catch (err) {
        feedbackEl.innerHTML = '<span class="text-danger">Fehler bei der Validierung.</span>';
    }
}

// ============================================================
//  PRESETS LADEN (Extra-Feature: Vorkonfigurierte Produkte)
// ============================================================
function loadPreset(presetKey) {
    const preset = PRESETS[presetKey];
    if (!preset) return;

    // State mit Preset befüllen
    state.caffeine.value = preset.caffeine;
    state.caffeine.price = preset.caffeine === '200' ? 0.50 : 0;
    state.flavors = [...preset.flavors];
    state.extras = [...preset.extras];
    state.sweetener.value = preset.sweetener;
    state.sweetener.price = preset.sweetener === 'erythrit' ? 0.20 : 0;
    state.size.value = preset.size;
    state.size.price = preset.size === '500' ? 3.00 : preset.size === '1000' ? 7.50 : 0;
    state.canColor = preset.color;
    state.canName = preset.canName;

    // UI aktualisieren
    // Koffein
    document.querySelectorAll('#caffeine-grid .radio-card').forEach(c => {
        c.classList.toggle('selected', c.dataset.value === preset.caffeine);
    });

    // Sweetener
    document.querySelectorAll('#sweetener-grid .radio-card').forEach(c => {
        c.classList.toggle('selected', c.dataset.value === preset.sweetener);
    });

    // Size
    document.querySelectorAll('#size-grid .radio-card').forEach(c => {
        c.classList.toggle('selected', c.dataset.value === preset.size);
    });

    // Color
    document.querySelectorAll('#color-options .color-swatch').forEach(s => {
        s.classList.toggle('selected', s.dataset.color === preset.color);
    });

    // Name
    document.getElementById('can-name').value = preset.canName;

    // Flavors & Extras UI updaten
    renderFlavors();
    renderExtras();

    updatePreview();
    showToast(`Preset "${preset.name}" geladen! Passe ihn nach deinem Geschmack an.`);
}

// ============================================================
//  KONFIGURATION SPEICHERN
// ============================================================
async function saveConfiguration() {
    if (!IS_LOGGED_IN) {
        showToast('Bitte logge dich ein um zu speichern.', true);
        return;
    }

    const data = {
        caffeine: state.caffeine.value,
        flavors: state.flavors,
        extras: state.extras,
        sweetener: state.sweetener.value,
        size: state.size.value,
        can_name: state.canName,
        can_color: state.canColor,
        total_price: calculateDiscountedPrice()
    };

    try {
        const res = await fetch('api/save_config.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });
        const result = await res.json();

        if (result.success) {
            showToast('Konfiguration gespeichert!');
        } else {
            showToast(result.error || 'Fehler beim Speichern.', true);
        }
    } catch (err) {
        showToast('Verbindungsfehler.', true);
    }
}

// ============================================================
//  BESTELLEN (Prototyp – zeigt nur Modal)
// ============================================================
function orderNow() {
    const modal = new bootstrap.Modal(document.getElementById('orderModal'));
    modal.show();
}

// ============================================================
//  TOAST BENACHRICHTIGUNGEN
// ============================================================
function showToast(message, isError = false) {
    const toast = document.getElementById('vm-toast');
    toast.textContent = message;
    toast.className = 'vm-toast show' + (isError ? ' error' : '');

    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);
}
