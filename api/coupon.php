<?php
/**
 * Coupon API – Gutscheincode validieren
 * GET /api/coupon.php?code=XXXXX
 */
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/db.php';

$code = strtoupper(trim($_GET['code'] ?? ''));

if (empty($code)) {
    echo json_encode(['valid' => false, 'error' => 'Kein Code angegeben.']);
    exit;
}

// Gutschein in der Datenbank suchen
$stmt = $pdo->prepare(
    'SELECT code, discount_percent FROM coupons 
     WHERE UPPER(code) = ? AND is_active = 1 AND valid_until >= CURDATE()'
);
$stmt->execute([$code]);
$coupon = $stmt->fetch();

if ($coupon) {
    echo json_encode([
        'valid' => true,
        'code' => $coupon['code'],
        'discount' => (int)$coupon['discount_percent']
    ]);
} else {
    echo json_encode([
        'valid' => false,
        'error' => 'Ungültiger oder abgelaufener Gutscheincode.'
    ]);
}
