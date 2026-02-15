/**
 * Auth.js – Login & Registrierung Frontend-Logik
 */

document.addEventListener('DOMContentLoaded', function () {

    // === Registrierung ===
    const registerForm = document.getElementById('register-form');
    if (registerForm) {
        registerForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            const formData = new FormData(registerForm);
            const data = Object.fromEntries(formData.entries());

            const alertEl = document.getElementById('register-alert');
            const successEl = document.getElementById('register-success');
            alertEl.classList.add('d-none');
            successEl.classList.add('d-none');

            // Client-seitige Validierung
            if (data.passwort !== data.passwort2) {
                alertEl.textContent = 'Die Passwörter stimmen nicht überein.';
                alertEl.classList.remove('d-none');
                return;
            }

            try {
                const res = await fetch('api/auth.php?action=register', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                const result = await res.json();

                if (result.success) {
                    successEl.textContent = 'Registrierung erfolgreich! Du wirst weitergeleitet...';
                    successEl.classList.remove('d-none');
                    setTimeout(() => {
                        window.location.href = 'configurator.php';
                    }, 1000);
                } else {
                    alertEl.textContent = result.error || 'Ein Fehler ist aufgetreten.';
                    alertEl.classList.remove('d-none');
                }
            } catch (err) {
                alertEl.textContent = 'Verbindungsfehler. Bitte versuche es erneut.';
                alertEl.classList.remove('d-none');
            }
        });
    }

    // === Login ===
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            const formData = new FormData(loginForm);
            const data = Object.fromEntries(formData.entries());

            const alertEl = document.getElementById('login-alert');
            alertEl.classList.add('d-none');

            try {
                const res = await fetch('api/auth.php?action=login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                const result = await res.json();

                if (result.success) {
                    window.location.href = 'configurator.php';
                } else {
                    alertEl.textContent = result.error || 'Login fehlgeschlagen.';
                    alertEl.classList.remove('d-none');
                }
            } catch (err) {
                alertEl.textContent = 'Verbindungsfehler. Bitte versuche es erneut.';
                alertEl.classList.remove('d-none');
            }
        });
    }
});
