<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

require_once __DIR__ . '/../common/connection.php';

// Revalidar que siga activo (por si lo desactivaron mientras navega)
$uid = (int)$_SESSION['user_id'];
$chk = $conn->prepare("SELECT status FROM usuarios WHERE id = ?");
$chk->bind_param('i', $uid);
$chk->execute();
$st = $chk->get_result()->fetch_assoc()['status'] ?? 'inactive';
if ($st !== 'active') {
    session_destroy();
    header('Location: ../index.php');
    exit;
}
