<?php
// Datenbankverbindung - Zugangsdaten aus docker-compose.yml
$db_host = 'db';
$db_name = 'meine_db';
$db_user = 'benutzer';
$db_pass = 'benutzerpasswort';

try {
    $pdo = new PDO(
        "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4",
        $db_user,
        $db_pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    http_response_code(500);
    die(json_encode(['error' => 'Datenbankverbindung fehlgeschlagen: ' . $e->getMessage()]));
}
