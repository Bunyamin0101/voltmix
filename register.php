<?php
$pageTitle = 'Registrieren – VOLTMIX';
require_once 'includes/header.php';

// Wenn schon eingeloggt -> redirect
if (isLoggedIn()) {
    header('Location: configurator.php');
    exit;
}
?>

<div class="auth-container">
    <div class="text-center mb-4">
        <h2 class="fw-bold"><i class="bi bi-lightning-charge-fill text-volt me-2"></i>Account erstellen</h2>
        <p class="text-muted">Registriere dich um deine Mixes zu speichern.</p>
    </div>

    <div class="auth-card">
        <div id="register-alert" class="alert alert-danger d-none" role="alert"></div>
        <div id="register-success" class="alert alert-volt d-none" role="alert"></div>

        <form id="register-form">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Vorname *</label>
                    <input type="text" class="form-control" name="vorname" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nachname *</label>
                    <input type="text" class="form-control" name="nachname" required>
                </div>
            </div>

            <div class="mt-3">
                <label class="form-label">E-Mail *</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="mt-3">
                <label class="form-label">Straße & Hausnummer</label>
                <input type="text" class="form-control" name="strasse">
            </div>

            <div class="row g-3 mt-0">
                <div class="col-md-4">
                    <label class="form-label">PLZ</label>
                    <input type="text" class="form-control" name="plz" maxlength="5">
                </div>
                <div class="col-md-8">
                    <label class="form-label">Stadt</label>
                    <input type="text" class="form-control" name="stadt">
                </div>
            </div>

            <div class="mt-3">
                <label class="form-label">Passwort * <small class="text-muted">(min. 6 Zeichen)</small></label>
                <input type="password" class="form-control" name="passwort" required minlength="6">
            </div>

            <div class="mt-3">
                <label class="form-label">Passwort wiederholen *</label>
                <input type="password" class="form-control" name="passwort2" required>
            </div>

            <button type="submit" class="btn btn-volt w-100 mt-4">
                <i class="bi bi-person-plus me-2"></i>Registrieren
            </button>
        </form>

        <p class="text-center text-muted mt-3 mb-0 small">
            Schon einen Account? <a href="login.php" class="text-volt text-decoration-none">Jetzt einloggen</a>
        </p>
    </div>
</div>

<script src="js/auth.js"></script>
<?php require_once 'includes/footer.php'; ?>
