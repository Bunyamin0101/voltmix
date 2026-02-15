<?php
/**
 * Delete Configuration API
 * POST /api/delete_config.php
 */
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Nicht eingeloggt.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Nur POST erlaubt.']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$configId = (int)($input['config_id'] ?? 0);
$userId = (int)$_SESSION['user_id'];

if ($configId <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Ungültige Konfigurations-ID.']);
    exit;
}

try {
    // Nur eigene Konfigurationen löschen dürfen
    $stmt = $pdo->prepare('SELECT id FROM configurations WHERE id = ? AND user_id = ?');
    $stmt->execute([$configId, $userId]);

    if (!$stmt->fetch()) {
        http_response_code(403);
        echo json_encode(['error' => 'Keine Berechtigung.']);
        exit;
    }

    // Abhängige Daten zuerst löschen
    $pdo->prepare('DELETE FROM configuration_flavors WHERE configuration_id = ?')->execute([$configId]);
    $pdo->prepare('DELETE FROM configuration_extras WHERE configuration_id = ?')->execute([$configId]);
    $pdo->prepare('DELETE FROM configurations WHERE id = ?')->execute([$configId]);

    echo json_encode(['success' => true, 'message' => 'Konfiguration gelöscht.']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Fehler beim Löschen.']);
}
