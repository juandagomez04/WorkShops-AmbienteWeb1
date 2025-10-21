<?php
// register.php

// 1) Si llega POST: crear el objeto y registrar (POO)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/OBJs/Cliente.php';   // Clase Cliente (hereda de Usuario)

    $cliente = new Cliente(
        $_POST['nombre'] ?? '',
        $_POST['apellidos'] ?? '',
        $_POST['username'] ?? '',
        $_POST['email'] ?? '',
        $_POST['contraseña'] ?? '',
        (int) ($_POST['provincia_id'] ?? 0)
    );


    // Usa el método polimórfico
    if ($cliente->registrar()) {
        header('Location: complete.html');
        exit;
    } else {
        $error = "No se pudo registrar el usuario.";
    }
}

// 2) Cargar provincias para el <select>
$host = "localhost";
$user = "root";
$pass = "";
$db = "workshop4";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");

$provincias = [];
$res = $conn->query("SELECT id, nombre FROM provincias ORDER BY nombre");
if ($res) {
    while ($row = $res->fetch_assoc()) {
        $provincias[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="styles.css" />
</head>

<body>
    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="register.php" method="post" autocomplete="off">
        <h2>Registro de Usuario</h2>

        <div class="row">
            <div class="field">
                <label for="nombre">Nombre</label>
                <input id="nombre" name="nombre" type="text" required>
            </div>
            <div class="field">
                <label for="apellidos">Apellidos</label>
                <input id="apellidos" name="apellidos" type="text" required>
            </div>
        </div>

        <div class="field">
            <label for="username">Nombre de usuario</label>
            <input id="username" name="username" type="text" required>
        </div>

        <div class="field">
            <label for="email">Correo electrónico</label>
            <input id="email" name="email" type="email" required>
        </div>

        <div class="field">
            <label for="contraseña">Contraseña</label>
            <input id="contraseña" name="contraseña" type="password" required>
        </div>

        <div class="field">
            <label for="provincia">Provincia</label>
            <select id="provincia" name="provincia_id" required>
                <option value="" disabled selected>Seleccione una provincia</option>
                <?php foreach ($provincias as $p): ?>
                    <option value="<?= htmlspecialchars($p['id']) ?>">
                        <?= htmlspecialchars($p['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

        </div>

        <button type="submit">Registrar</button>
    </form>
</body>

</html>