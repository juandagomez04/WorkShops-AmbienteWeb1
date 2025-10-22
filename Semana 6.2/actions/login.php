<?php
session_start();
require_once __DIR__ . '/../common/connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: ../index.php');
  exit;
}

$username = trim($_POST['username'] ?? '');
$password = (string) ($_POST['password'] ?? '');

$sql = "SELECT id, name, lastName, username, password, role, status
          FROM usuarios
          WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$res = $stmt->get_result();

if (!$res || $res->num_rows !== 1) {
  $_SESSION['login_error'] = 'Usuario o contraseña inválidos.';
  header('Location: ../index.php');
  exit;
}

$user = $res->fetch_assoc();

// Soporta tanto hash como texto plano (por compatibilidad con Semana 5)
$passOk = password_verify($password, $user['password']) || ($password === $user['password']);

if (!$passOk) {
  $_SESSION['login_error'] = 'Usuario o contraseña inválidos.';
  header('Location: ../index.php');
  exit;
}

// Solo usuarios activos pueden entrar
if ($user['status'] !== 'active') {
  $_SESSION['login_error'] = 'Tu cuenta está inactiva. Contacta al administrador.';
  header('Location: ../index.php');
  exit;
}

// Actualiza último login
$upd = $conn->prepare("UPDATE usuarios SET last_login_datetime = NOW() WHERE id = ?");
$upd->bind_param('i', $user['id']);
$upd->execute();

// Guarda sesión
$_SESSION['user_id'] = (int) $user['id'];
$_SESSION['username'] = $user['username'];
$_SESSION['role'] = $user['role'];
$_SESSION['name'] = $user['name'];
$_SESSION['lastName'] = $user['lastName'];

header('Location: ../pages/dashboard.php');
exit;
?>