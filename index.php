<?php
$pageTitle = 'VOLTMIX – Dein Energy Pulver, dein Mix';
require_once 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <p class="text-volt fw-bold text-uppercase mb-2" style="letter-spacing:3px; font-size:0.85rem;">
                    <i class="bi bi-lightning-charge-fill me-1"></i> Energy Pulver Konfigurator
                </p>
                <h1 class="hero-title text-white mb-3">
                    Dein Pulver.<br>
                    <span class="text-volt glow-text">Dein Mix.</span>
                </h1>
                <p class="hero-subtitle mb-4">
                    Kreiere dein individuelles Energy Pulver aus über 20 Geschmacksrichtungen, 
                    funktionalen Extras und persönlichem Dosen-Design.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="configurator.php" class="btn btn-volt btn-volt-lg">
                        <i class="bi bi-lightning-charge-fill me-2"></i>Jetzt mixen
                    </a>
                    <a href="#presets" class="btn btn-volt-outline btn-volt-lg">
                        Beliebte Mixes
                    </a>
                </div>
            </div>
            <div class="col-lg-5 text-center mt-5 mt-lg-0">
                <!-- Hero SVG Pulverdose -->
                <svg class="hero-can-svg" viewBox="0 0 220 340" width="240">
                    <defs>
                        <linearGradient id="heroTubGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#1a1a2e"/>
                            <stop offset="30%" stop-color="#16213e"/>
                            <stop offset="70%" stop-color="#0f3460"/>
                            <stop offset="100%" stop-color="#1a1a2e"/>
                        </linearGradient>
                        <linearGradient id="heroLidGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" stop-color="#222"/>
                            <stop offset="50%" stop-color="#444"/>
                            <stop offset="100%" stop-color="#222"/>
                        </linearGradient>
                    </defs>
                    <!-- Shadow -->
                    <ellipse cx="110" cy="320" rx="65" ry="10" fill="rgba(0,0,0,0.3)"/>
                    <!-- Tub body -->
                    <rect x="30" y="60" width="160" height="250" rx="14" fill="url(#heroTubGrad)"/>
                    <!-- Lid -->
                    <rect x="25" y="38" width="170" height="30" rx="10" fill="url(#heroLidGrad)"/>
                    <ellipse cx="110" cy="38" rx="85" ry="10" fill="#333"/>
                    <ellipse cx="110" cy="38" rx="70" ry="7" fill="#444"/>
                    <!-- Lid grip lines -->
                    <line x1="60" y1="38" x2="160" y2="38" stroke="#555" stroke-width="0.5"/>
                    <line x1="65" y1="42" x2="155" y2="42" stroke="#555" stroke-width="0.3"/>
                    <!-- Bottom rim -->
                    <ellipse cx="110" cy="310" rx="80" ry="6" fill="#0a0e17"/>
                    <!-- Brand text -->
                    <text x="110" y="155" text-anchor="middle" fill="#39FF14" font-family="'Russo One', sans-serif" font-size="24" letter-spacing="3">VOLTMIX</text>
                    <!-- Lightning bolt -->
                    <path class="bolt-flash" d="M105 170 L115 170 L110 192 L125 187 L105 222 L110 202 L95 207 Z" fill="#39FF14"/>
                    <!-- Subtitle -->
                    <text x="110" y="252" text-anchor="middle" fill="rgba(255,255,255,0.6)" font-family="'Exo 2', sans-serif" font-size="9" letter-spacing="2">CUSTOM ENERGY</text>
                    <!-- Decorative line -->
                    <line x1="55" y1="262" x2="165" y2="262" stroke="#39FF14" stroke-width="0.5" opacity="0.4"/>
                    <text x="110" y="278" text-anchor="middle" fill="rgba(255,255,255,0.4)" font-family="'Exo 2', sans-serif" font-size="7">500g</text>
                </svg>
            </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="vm-card p-4 h-100 text-center">
                    <div class="feature-icon mx-auto mb-3" style="background:rgba(57,255,20,0.1)">
                        <i class="bi bi-sliders text-volt"></i>
                    </div>
                    <h5 class="fw-bold mb-2">5-Schritte Mixer</h5>
                    <p class="text-muted mb-0" style="font-size:0.9rem;">Wähle Koffein, Geschmack, Extras, Süßung und dein Dosen-Design – komplett individuell.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="vm-card p-4 h-100 text-center">
                    <div class="feature-icon mx-auto mb-3" style="background:rgba(6,182,212,0.1)">
                        <i class="bi bi-palette text-accent"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Dosen-Designer</h5>
                    <p class="text-muted mb-0" style="font-size:0.9rem;">Gib deinem Pulver-Mix einen Namen und wähle deine Lieblingsfarbe für die Dose.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="vm-card p-4 h-100 text-center">
                    <div class="feature-icon mx-auto mb-3" style="background:rgba(249,115,22,0.1)">
                        <i class="bi bi-bookmark-star" style="color:var(--volt-orange)"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Mixes speichern</h5>
                    <p class="text-muted mb-0" style="font-size:0.9rem;">Registriere dich und speichere deine Lieblings-Konfigurationen für später.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Preset Drinks Section -->
<section class="py-5" id="presets">
    <div class="container">
        <h2 class="section-title text-center mb-2">
            <i class="bi bi-stars me-2 text-volt"></i>Beliebte Mixes
        </h2>
        <p class="text-center text-muted mb-4">Starte mit einer unserer Vorlagen und passe sie nach deinem Geschmack an.</p>

        <div class="row g-4">
            <!-- Preset 1 -->
            <div class="col-md-4">
                <div class="vm-card preset-card p-4 h-100" onclick="window.location='configurator.php?preset=gamer_fuel'">
                    <span class="preset-badge">Beliebt</span>
                    <div class="text-center mb-3 mt-2">
                        <span style="font-size:3.2rem;">🎮</span>
                    </div>
                    <h5 class="fw-bold text-center mb-2">Gamer Fuel</h5>
                    <p class="text-muted text-center mb-3" style="font-size:0.88rem; line-height:1.55;">200mg Koffein pro Portion, Tropical Mango + Citrus Lime, mit L-Theanin für fokussiertes Gaming.</p>
                    <div class="text-center mt-auto pt-2" style="border-top:1px solid var(--volt-border);">
                        <span class="text-volt fw-bold" style="font-size:1.1rem;">ab 8,35 €</span>
                    </div>
                </div>
            </div>
            <!-- Preset 2 -->
            <div class="col-md-4">
                <div class="vm-card preset-card p-4 h-100" onclick="window.location='configurator.php?preset=focus_flow'">
                    <div class="text-center mb-3 mt-2">
                        <span style="font-size:3.2rem;">🧠</span>
                    </div>
                    <h5 class="fw-bold text-center mb-2">Focus Flow</h5>
                    <p class="text-muted text-center mb-3" style="font-size:0.88rem; line-height:1.55;">100mg Koffein pro Portion, Blaubeere + Grüner Tee, mit B-Vitaminen und Ginkgo für Produktivität.</p>
                    <div class="text-center mt-auto pt-2" style="border-top:1px solid var(--volt-border);">
                        <span class="text-volt fw-bold" style="font-size:1.1rem;">ab 8,15 €</span>
                    </div>
                </div>
            </div>
            <!-- Preset 3 -->
            <div class="col-md-4">
                <div class="vm-card preset-card p-4 h-100" onclick="window.location='configurator.php?preset=berry_blast'">
                    <div class="text-center mb-3 mt-2">
                        <span style="font-size:3.2rem;">🫐</span>
                    </div>
                    <h5 class="fw-bold text-center mb-2">Berry Blast</h5>
                    <p class="text-muted text-center mb-3" style="font-size:0.88rem; line-height:1.55;">150mg Koffein pro Portion, Mixed Berry + Açaí, Taurin und Guarana für den vollen Boost.</p>
                    <div class="text-center mt-auto pt-2" style="border-top:1px solid var(--volt-border);">
                        <span class="text-volt fw-bold" style="font-size:1.1rem;">ab 12,35 €</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5">
    <div class="container">
        <div class="vm-card p-5 text-center" style="border-color: rgba(57,255,20,0.2);">
            <h2 class="fw-bold mb-3">Bereit für deinen eigenen Pulver-Mix?</h2>
            <p class="text-muted mb-4">Über 20 Geschmacksrichtungen, funktionale Extras und individuelles Dosen-Design warten auf dich.</p>
            <a href="configurator.php" class="btn btn-volt btn-volt-lg">
                <i class="bi bi-lightning-charge-fill me-2"></i>Konfigurator starten
            </a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
