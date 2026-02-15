<?php
$pageTitle = 'Mixer – VOLTMIX';
require_once 'includes/header.php';
?>

<div class="container py-4">
    <!-- Step Navigation -->
    <div class="config-steps" id="config-steps">
        <button class="config-step-btn active" data-step="1">Basis</button>
        <button class="config-step-btn" data-step="2">Geschmack</button>
        <button class="config-step-btn" data-step="3">Extras</button>
        <button class="config-step-btn" data-step="4">Süßung & Größe</button>
        <button class="config-step-btn" data-step="5">Design</button>
        <button class="config-step-btn" data-step="6">Zusammenfassung</button>
    </div>

    <div class="row mt-3">
        <!-- Main Content Area -->
        <div class="col-lg-8">
            <div class="step-content" id="step-content">

                <!-- ==================== STEP 1: BASIS ==================== -->
                <div class="step-panel active" id="step-1">
                    <h3 class="section-title"><i class="bi bi-lightning-charge me-2 text-volt"></i>Koffein-Level wählen</h3>
                    <p class="text-muted mb-4">Wie viel Power brauchst du? Wähle dein Koffein-Level als Basis.</p>

                    <div class="radio-grid" id="caffeine-grid">
                        <div class="radio-card" data-value="50" data-price="0">
                            <div class="radio-value">50<small style="font-size:0.5em">mg</small></div>
                            <div class="radio-label">Leicht</div>
                            <div class="radio-sublabel">Sanfter Boost</div>
                        </div>
                        <div class="radio-card" data-value="100" data-price="0">
                            <div class="radio-value">100<small style="font-size:0.5em">mg</small></div>
                            <div class="radio-label">Medium</div>
                            <div class="radio-sublabel">~ 1 Tasse Kaffee</div>
                        </div>
                        <div class="radio-card selected" data-value="150" data-price="0">
                            <div class="radio-value">150<small style="font-size:0.5em">mg</small></div>
                            <div class="radio-label">Stark</div>
                            <div class="radio-sublabel">Voller Fokus</div>
                        </div>
                        <div class="radio-card" data-value="200" data-price="0.50">
                            <div class="radio-value">200<small style="font-size:0.5em">mg</small></div>
                            <div class="radio-label">Maximum</div>
                            <div class="radio-sublabel">+0,50 € · Turbo-Modus</div>
                        </div>
                    </div>

                    <div class="step-nav">
                        <div></div>
                        <button class="btn btn-volt" onclick="goToStep(2)">Weiter <i class="bi bi-arrow-right ms-1"></i></button>
                    </div>
                </div>

                <!-- ==================== STEP 2: GESCHMACK ==================== -->
                <div class="step-panel" id="step-2">
                    <h3 class="section-title"><i class="bi bi-droplet-half me-2 text-volt"></i>Geschmacksrichtungen wählen</h3>
                    <p class="text-muted mb-3">Wähle bis zu 3 Geschmacksrichtungen für deinen Mix. Premium-Flavors kosten extra.</p>

                    <!-- Filter Bar (Extra-Feature: Suche/Filterung) -->
                    <div class="filter-bar">
                        <input type="text" class="form-control" id="flavor-search" placeholder="Suche...">
                        <button class="filter-tag active" data-category="all">Alle</button>
                        <button class="filter-tag" data-category="frucht">Frucht</button>
                        <button class="filter-tag" data-category="zitrus">Zitrus</button>
                        <button class="filter-tag" data-category="beere">Beere</button>
                        <button class="filter-tag" data-category="exotisch">Exotisch</button>
                        <button class="filter-tag" data-category="classic">Classic</button>
                        <button class="filter-tag" data-category="spezial">Spezial</button>
                    </div>

                    <div class="option-grid" id="flavor-grid">
                        <!-- Filled by JS -->
                    </div>

                    <div class="step-nav">
                        <button class="btn btn-volt-outline" onclick="goToStep(1)"><i class="bi bi-arrow-left me-1"></i> Zurück</button>
                        <button class="btn btn-volt" onclick="goToStep(3)">Weiter <i class="bi bi-arrow-right ms-1"></i></button>
                    </div>
                </div>

                <!-- ==================== STEP 3: EXTRAS ==================== -->
                <div class="step-panel" id="step-3">
                    <h3 class="section-title"><i class="bi bi-capsule me-2 text-volt"></i>Funktionale Extras</h3>
                    <p class="text-muted mb-4">Boost deinen Pulver-Mix mit funktionalen Zutaten. Jedes Extra kostet 0,30 € zusätzlich.</p>

                    <div class="option-grid" id="extras-grid">
                        <!-- Filled by JS -->
                    </div>

                    <div class="step-nav">
                        <button class="btn btn-volt-outline" onclick="goToStep(2)"><i class="bi bi-arrow-left me-1"></i> Zurück</button>
                        <button class="btn btn-volt" onclick="goToStep(4)">Weiter <i class="bi bi-arrow-right ms-1"></i></button>
                    </div>
                </div>

                <!-- ==================== STEP 4: SÜßUNG & GRÖßE ==================== -->
                <div class="step-panel" id="step-4">
                    <h3 class="section-title"><i class="bi bi-cup-straw me-2 text-volt"></i>Süßung & Größe</h3>

                    <h5 class="fw-bold mt-4 mb-3">Süßungsmittel</h5>
                    <div class="radio-grid" id="sweetener-grid">
                        <div class="radio-card" data-value="zucker" data-price="0">
                            <div style="font-size:2rem">🍬</div>
                            <div class="radio-label">Zucker</div>
                            <div class="radio-sublabel">Klassisch süß</div>
                        </div>
                        <div class="radio-card selected" data-value="stevia" data-price="0">
                            <div style="font-size:2rem">🌿</div>
                            <div class="radio-label">Stevia</div>
                            <div class="radio-sublabel">Natürliche Süße</div>
                        </div>
                        <div class="radio-card" data-value="erythrit" data-price="0.20">
                            <div style="font-size:2rem">🧊</div>
                            <div class="radio-label">Erythrit</div>
                            <div class="radio-sublabel">+0,20 € · Kalorienfrei</div>
                        </div>
                        <div class="radio-card" data-value="ohne" data-price="0">
                            <div style="font-size:2rem">💧</div>
                            <div class="radio-label">Ohne Süßung</div>
                            <div class="radio-sublabel">Nur natürliches Aroma</div>
                        </div>
                    </div>

                    <h5 class="fw-bold mt-5 mb-3">Dosengröße</h5>
                    <p class="text-muted small mb-3"><i class="bi bi-spoon me-1"></i>Jede Dose enthält einen 30g Messlöffel für die perfekte Portion.</p>
                    <div class="radio-grid" id="size-grid">
                        <div class="radio-card size-card" data-value="300" data-price="0">
                            <div class="size-ml">300<small style="font-size:0.4em">g</small></div>
                            <div class="size-label">Standard</div>
                            <div class="radio-sublabel">~10 Portionen</div>
                        </div>
                        <div class="radio-card size-card selected" data-value="500" data-price="3.00">
                            <div class="size-ml">500<small style="font-size:0.4em">g</small></div>
                            <div class="size-label">Medium</div>
                            <div class="radio-sublabel">+3,00 € · ~16 Portionen</div>
                        </div>
                        <div class="radio-card size-card" data-value="1000" data-price="7.50">
                            <div class="size-ml">1000<small style="font-size:0.4em">g</small></div>
                            <div class="size-label">Groß</div>
                            <div class="radio-sublabel">+7,50 € · ~33 Portionen</div>
                        </div>
                    </div>

                    <div class="step-nav">
                        <button class="btn btn-volt-outline" onclick="goToStep(3)"><i class="bi bi-arrow-left me-1"></i> Zurück</button>
                        <button class="btn btn-volt" onclick="goToStep(5)">Weiter <i class="bi bi-arrow-right ms-1"></i></button>
                    </div>
                </div>

                <!-- ==================== STEP 5: DESIGN ==================== -->
                <div class="step-panel" id="step-5">
                    <h3 class="section-title"><i class="bi bi-palette me-2 text-volt"></i>Dosen-Design</h3>
                    <p class="text-muted mb-4">Gib deinem Pulver-Mix einen Namen und wähle deine Dosenfarbe.</p>

                    <h5 class="fw-bold mb-3">Name auf der Dose</h5>
                    <input type="text" class="can-name-input form-control" id="can-name" maxlength="16" placeholder="DEIN NAME" value="">
                    <small class="text-muted d-block mt-1">Maximal 16 Zeichen</small>

                    <h5 class="fw-bold mt-4 mb-3">Dosenfarbe</h5>
                    <div class="color-options" id="color-options">
                        <div class="color-swatch selected" data-color="#39FF14" style="background:#39FF14" title="Neon Grün"></div>
                        <div class="color-swatch" data-color="#06b6d4" style="background:#06b6d4" title="Cyan"></div>
                        <div class="color-swatch" data-color="#f97316" style="background:#f97316" title="Orange"></div>
                        <div class="color-swatch" data-color="#ec4899" style="background:#ec4899" title="Pink"></div>
                        <div class="color-swatch" data-color="#a855f7" style="background:#a855f7" title="Lila"></div>
                        <div class="color-swatch" data-color="#ef4444" style="background:#ef4444" title="Rot"></div>
                        <div class="color-swatch" data-color="#eab308" style="background:#eab308" title="Gold"></div>
                        <div class="color-swatch" data-color="#22c55e" style="background:#22c55e" title="Grün"></div>
                        <div class="color-swatch" data-color="#3b82f6" style="background:#3b82f6" title="Blau"></div>
                        <div class="color-swatch" data-color="#ffffff" style="background:#ffffff" title="Weiß"></div>
                        <div class="color-swatch" data-color="#f5f5f4" style="background:linear-gradient(135deg,#c0c0c0,#e8e8e8,#c0c0c0)" title="Silber"></div>
                        <div class="color-swatch" data-color="#1e293b" style="background:#1e293b; border:1px solid #334155" title="Dunkel"></div>
                    </div>

                    <div class="step-nav">
                        <button class="btn btn-volt-outline" onclick="goToStep(4)"><i class="bi bi-arrow-left me-1"></i> Zurück</button>
                        <button class="btn btn-volt" onclick="goToStep(6)">Zur Zusammenfassung <i class="bi bi-arrow-right ms-1"></i></button>
                    </div>
                </div>

                <!-- ==================== STEP 6: ZUSAMMENFASSUNG ==================== -->
                <div class="step-panel" id="step-6">
                    <h3 class="section-title"><i class="bi bi-receipt me-2 text-volt"></i>Zusammenfassung</h3>

                    <div id="summary-content">
                        <!-- Filled by JS -->
                    </div>

                    <!-- Gutscheincode (Extra-Feature) -->
                    <div class="summary-section">
                        <h5><i class="bi bi-tag me-2 text-volt"></i>Gutscheincode</h5>
                        <div class="input-group coupon-input-group">
                            <input type="text" class="form-control" id="coupon-input" placeholder="Code eingeben...">
                            <button class="btn btn-volt" id="coupon-btn" onclick="applyCoupon()">Einlösen</button>
                        </div>
                        <div id="coupon-feedback" class="mt-2 small"></div>
                    </div>

                    <!-- Preisübersicht -->
                    <div class="summary-section" id="price-summary">
                        <!-- Filled by JS -->
                    </div>

                    <!-- Aktionsbuttons -->
                    <div class="d-flex gap-3 flex-wrap mt-4">
                        <?php if (isLoggedIn()): ?>
                            <button class="btn btn-volt-outline" onclick="saveConfiguration()">
                                <i class="bi bi-bookmark me-2"></i>Konfiguration speichern
                            </button>
                        <?php else: ?>
                            <a href="login.php" class="btn btn-volt-outline">
                                <i class="bi bi-person me-2"></i>Einloggen zum Speichern
                            </a>
                        <?php endif; ?>
                        <button class="btn btn-volt btn-volt-lg" onclick="orderNow()">
                            <i class="bi bi-cart-check me-2"></i>Jetzt bestellen
                        </button>
                    </div>

                    <div class="step-nav">
                        <button class="btn btn-volt-outline" onclick="goToStep(5)"><i class="bi bi-arrow-left me-1"></i> Zurück</button>
                        <div></div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Sidebar: Live Preview -->
        <div class="col-lg-4">
            <div class="preview-sidebar">
                <div class="preview-can-wrapper">
                    <!-- SVG Can Preview -->
                    <div class="can-svg-container" id="can-preview-svg">
                        <!-- Rendered by JS -->
                    </div>
                    <div class="preview-name" id="preview-name">DEIN MIX</div>
                    <div class="preview-details" id="preview-details">150mg Koffein · 500g · inkl. 30g Löffel</div>

                    <div class="preview-price" id="preview-price">3,95 €</div>
                    <div class="preview-price-detail" id="preview-price-detail">inkl. MwSt., zzgl. Versand</div>

                    <div class="preview-ingredients" id="preview-ingredients">
                        <small class="text-muted d-block mb-2">Zutaten & Extras:</small>
                        <span class="ingredient-tag">Wähle Geschmack...</span>
                    </div>

                    <button class="btn btn-volt w-100 mt-3" onclick="goToStep(6)">Weiter</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div class="vm-toast" id="vm-toast"></div>

<!-- Order Confirmation Modal -->
<div class="modal fade" id="orderModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background:var(--volt-card); border:1px solid var(--volt-green);">
            <div class="modal-body text-center p-5">
                <div style="font-size:4rem" class="mb-3">⚡</div>
                <h3 class="fw-bold mb-3">Bestellung eingegangen!</h3>
                <p class="text-muted">Dein individuelles Energy Pulver wird für dich gemischt und in deine Dose abgefüllt – inkl. 30g Messlöffel. Wir benachrichtigen dich, sobald es versandt wird.</p>
                <p class="text-muted small">(Dies ist ein Prototyp – es wird keine echte Bestellung ausgelöst.)</p>
                <button class="btn btn-volt mt-3" data-bs-dismiss="modal">Alles klar!</button>
            </div>
        </div>
    </div>
</div>

<!-- Preset data passed from PHP -->
<script>
    const PRESET_PARAM = <?php echo json_encode($_GET['preset'] ?? ''); ?>;
    const IS_LOGGED_IN = <?php echo isLoggedIn() ? 'true' : 'false'; ?>;
</script>
<script src="js/configurator.js"></script>

<?php require_once 'includes/footer.php'; ?>
