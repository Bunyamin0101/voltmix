<?php
// Session starten falls noch nicht geschehen
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Prüft ob der User eingeloggt ist
 */
function isLoggedIn(): bool {
    return isset($_SESSION['user_id']);
}

/**
 * Gibt die User-ID zurück oder null
 */
function getUserId(): ?int {
    return $_SESSION['user_id'] ?? null;
}

/**
 * Gibt den Usernamen zurück oder null
 */
function getUserName(): ?string {
    return $_SESSION['user_name'] ?? null;
}

/**
 * Gibt die User-Email zurück oder null
 */
function getUserEmail(): ?string {
    return $_SESSION['user_email'] ?? null;
}
