<?php
/**
 * Load Configurations API
 * GET /api/load_configs.php
 */
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Nicht eingeloggt.']);
    exit;
}

$userId = (int)$_SESSION['user_id'];

// Konfigurationen laden
$stmt = $pdo->prepare(
    'SELECT * FROM configurations WHERE user_id = ? ORDER BY created_at DESC'
);
$stmt->execute([$userId]);
$configs = $stmt->fetchAll();

// Für jede Konfiguration die Flavors und Extras laden
foreach ($configs as &$config) {
    // Flavors
    $stmt = $pdo->prepare('SELECT flavor_id FROM configuration_flavors WHERE configuration_id = ?');
    $stmt->execute([$config['id']]);
    $config['flavors'] = array_column($stmt->fetchAll(), 'flavor_id');

    // Extras
    $stmt = $pdo->prepare('SELECT extra_id FROM configuration_extras WHERE configuration_id = ?');
    $stmt->execute([$config['id']]);
    $config['extras'] = array_column($stmt->fetchAll(), 'extra_id');
}

echo json_encode(['configs' => $configs]);
