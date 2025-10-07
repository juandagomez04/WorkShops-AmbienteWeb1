<?php
// register.php
$host = "localhost";
$user = "root";
$pass = "";
$db = "workshop3";

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <form action="save.php" method="post" autocomplete="off">
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