<?php
require_once __DIR__ . '/../common/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $name = trim($_POST['name']);
    $lastName = trim($_POST['lastName']);
    $role = 'user';

    // Si usas hash:
    // $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $passwordHash = $password; // texto plano por ahora

    $sql = "INSERT INTO usuarios (name, lastName, username, password, role, status, last_login_datetime)
            VALUES (?, ?, ?, ?, ?, 'active', NULL)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $name, $lastName, $username, $passwordHash, $role);

    if ($stmt->execute()) {
        echo "✅ Usuario registrado correctamente";
    } else {
        echo "❌ Error al registrar: " . $conn->error;
    }
} else {
    echo "Método no permitido";
}
?>
