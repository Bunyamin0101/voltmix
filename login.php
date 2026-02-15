<?php
$pageTitle = 'Login – VOLTMIX';
require_once 'includes/header.php';

if (isLoggedIn()) {
    header('Location: configurator.php');
    exit;
}
?>

<div class="auth-container">
    <div class="text-center mb-4">
        <h2 class="fw-bold"><i class="bi bi-lightning-charge-fill text-volt me-2"></i>Login</h2>
        <p class="text-muted">Melde dich an um deine Mixes zu verwalten.</p>
    </div>

    <div class="auth-card">
        <div id="login-alert" class="alert alert-danger d-none" role="alert"></div>

        <form id="login-form">
            <div class="mb-3">
                <label class="form-label">E-Mail</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Passwort</label>
                <input type="password" class="form-control" name="passwort" required>
            </div>

            <button type="submit" class="btn btn-volt w-100 mt-2">
                <i class="bi bi-box-arrow-in-right me-2"></i>Einloggen
            </button>
        </form>

        <p class="text-center text-muted mt-3 mb-0 small">
            Noch kein Account? <a href="register.php" class="text-volt text-decoration-none">Jetzt registrieren</a>
        </p>
    </div>
</div>

<script src="js/auth.js"></script>
<?php require_once 'includes/footer.php'; ?>
