<?php
/**
 * Save Configuration API
 * POST /api/save_config.php
 */
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../includes/db.php';

// Auth check
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
$userId = (int)$_SESSION['user_id'];

// Daten extrahieren
$caffeine = $input['caffeine'] ?? '150';
$flavors = $input['flavors'] ?? [];
$extras = $input['extras'] ?? [];
$sweetener = $input['sweetener'] ?? 'stevia';
$size = $input['size'] ?? '330';
$canName = trim($input['can_name'] ?? '');
$canColor = $input['can_color'] ?? '#39FF14';
$totalPrice = floatval($input['total_price'] ?? 0);

try {
    $pdo->beginTransaction();

    // Konfiguration speichern
    $stmt = $pdo->prepare(
        'INSERT INTO configurations (user_id, caffeine_level, sweetener, size_ml, can_name, can_color, total_price) 
         VALUES (?, ?, ?, ?, ?, ?, ?)'
    );
    $stmt->execute([$userId, $caffeine, $sweetener, $size, $canName, $canColor, $totalPrice]);
    $configId = $pdo->lastInsertId();

    // Flavors speichern
    if (!empty($flavors)) {
        $stmt = $pdo->prepare('INSERT INTO configuration_flavors (configuration_id, flavor_id) VALUES (?, ?)');
        foreach ($flavors as $flavorId) {
            $stmt->execute([$configId, $flavorId]);
        }
    }

    // Extras speichern
    if (!empty($extras)) {
        $stmt = $pdo->prepare('INSERT INTO configuration_extras (configuration_id, extra_id) VALUES (?, ?)');
        foreach ($extras as $extraId) {
            $stmt->execute([$configId, $extraId]);
        }
    }

    $pdo->commit();

    echo json_encode([
        'success' => true,
        'message' => 'Konfiguration gespeichert!',
        'config_id' => (int)$configId
    ]);
} catch (Exception $e) {
    $pdo->rollBack();
    http_response_code(500);
    echo json_encode(['error' => 'Fehler beim Speichern: ' . $e->getMessage()]);
}
