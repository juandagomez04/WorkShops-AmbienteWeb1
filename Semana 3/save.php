<?php
// save.php
$host = "localhost";
$user = "root";
$pass = "";
$db = "workshop3";

// Asegurarse de que el método de solicitud es POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: register.php");
    exit;
}

// Recoger y validar datos del formulario
$nombre = trim($_POST['nombre'] ?? '');
$apellidos = trim($_POST['apellidos'] ?? '');
$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$contraseña = trim($_POST['contraseña'] ?? '');
$provinciaId = intval($_POST['provincia_id'] ?? 0);

// Validar campos obligatorios
if (!$nombre || !$apellidos || !$username || !$email || !$contraseña || !$provinciaId) {
    die("Faltan datos obligatorios.");
}

// Conectar a la base de datos
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

// Insertar usuario en la base de datos
$sql = "INSERT INTO usuarios (nombre, apellidos, username, email, contraseña, provincia_id)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Error al preparar la consulta: " . $conn->error);
}

$stmt->bind_param("sssssi", $nombre, $apellidos, $username, $email, $contraseña, $provinciaId);

if ($stmt->execute()) {
    // Redirige al login con el nombre de usuario prellenado
    header("Location: index.php?u=" . urlencode($username));
    exit;
} else {
    echo "Error al registrar: " . $stmt->error;
}

$stmt->close();
$conn->close();
