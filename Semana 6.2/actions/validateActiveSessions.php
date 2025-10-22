<?php
// Uso: php validateActiveSessions.php 24
require_once __DIR__ . '/../common/connection.php';

if ($argc < 2) {
    fwrite(STDERR, "Uso: php validateActiveSessions.php <horas>\n");
    exit(1);
}
$hours = (int) $argv[1];
if ($hours <= 0) {
    fwrite(STDERR, "El valor de <horas> debe ser un entero > 0\n");
    exit(1);
}

$sql = "UPDATE usuarios
        SET status = 'inactive'
        WHERE status = 'active'
        AND last_login_datetime IS NOT NULL
        AND TIMESTAMPDIFF(HOUR, last_login_datetime, NOW()) > ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $hours);
$stmt->execute();

echo "[OK] Usuarios desactivados por inactividad (> {$hours}h): {$stmt->affected_rows}\n";
