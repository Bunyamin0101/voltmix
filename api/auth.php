<?php
/**
 * Auth API Endpoint
 * POST /api/auth.php?action=register  – Registrierung
 * POST /api/auth.php?action=login     – Login
 */
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../includes/db.php';

$action = $_GET['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Nur POST-Anfragen erlaubt']);
    exit;
}

// JSON-Body lesen
$input = json_decode(file_get_contents('php://input'), true);

switch ($action) {
    case 'register':
        handleRegister($pdo, $input);
        break;
    case 'login':
        handleLogin($pdo, $input);
        break;
    default:
        http_response_code(400);
        echo json_encode(['error' => 'Unbekannte Aktion']);
}

/**
 * Registrierung verarbeiten
 */
function handleRegister(PDO $pdo, ?array $input): void {
    // Pflichtfelder prüfen
    $vorname = trim($input['vorname'] ?? '');
    $nachname = trim($input['nachname'] ?? '');
    $email = trim($input['email'] ?? '');
    $passwort = $input['passwort'] ?? '';
    $passwort2 = $input['passwort2'] ?? '';
    $strasse = trim($input['strasse'] ?? '');
    $plz = trim($input['plz'] ?? '');
    $stadt = trim($input['stadt'] ?? '');

    // Validierung
    if (empty($vorname) || empty($nachname) || empty($email) || empty($passwort)) {
        http_response_code(400);
        echo json_encode(['error' => 'Bitte fülle alle Pflichtfelder aus.']);
        return;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(['error' => 'Bitte gib eine gültige E-Mail-Adresse ein.']);
        return;
    }

    if (strlen($passwort) < 6) {
        http_response_code(400);
        echo json_encode(['error' => 'Das Passwort muss mindestens 6 Zeichen lang sein.']);
        return;
    }

    if ($passwort !== $passwort2) {
        http_response_code(400);
        echo json_encode(['error' => 'Die Passwörter stimmen nicht überein.']);
        return;
    }

    // Prüfen ob E-Mail schon existiert
    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        http_response_code(409);
        echo json_encode(['error' => 'Diese E-Mail-Adresse ist bereits registriert.']);
        return;
    }

    // User anlegen
    $hash = password_hash($passwort, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare(
        'INSERT INTO users (vorname, nachname, email, passwort_hash, strasse, plz, stadt) 
         VALUES (?, ?, ?, ?, ?, ?, ?)'
    );
    $stmt->execute([$vorname, $nachname, $email, $hash, $strasse, $plz, $stadt]);

    // Direkt einloggen
    $userId = $pdo->lastInsertId();
    $_SESSION['user_id'] = (int)$userId;
    $_SESSION['user_name'] = $vorname;
    $_SESSION['user_email'] = $email;

    echo json_encode([
        'success' => true,
        'message' => 'Registrierung erfolgreich!',
        'user' => [
            'id' => (int)$userId,
            'name' => $vorname,
            'email' => $email
        ]
    ]);
}

/**
 * Login verarbeiten
 */
function handleLogin(PDO $pdo, ?array $input): void {
    $email = trim($input['email'] ?? '');
    $passwort = $input['passwort'] ?? '';

    if (empty($email) || empty($passwort)) {
        http_response_code(400);
        echo json_encode(['error' => 'Bitte E-Mail und Passwort eingeben.']);
        return;
    }

    // User suchen
    $stmt = $pdo->prepare('SELECT id, vorname, email, passwort_hash FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($passwort, $user['passwort_hash'])) {
        http_response_code(401);
        echo json_encode(['error' => 'E-Mail oder Passwort falsch.']);
        return;
    }

    // Session setzen
    $_SESSION['user_id'] = (int)$user['id'];
    $_SESSION['user_name'] = $user['vorname'];
    $_SESSION['user_email'] = $user['email'];

    echo json_encode([
        'success' => true,
        'message' => 'Login erfolgreich!',
        'user' => [
            'id' => (int)$user['id'],
            'name' => $user['vorname'],
            'email' => $user['email']
        ]
    ]);
}
