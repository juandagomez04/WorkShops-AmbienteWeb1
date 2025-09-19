<?php
// Establecer la zona horaria de Costa Rica
date_default_timezone_set('America/Costa_Rica');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fecha y Hora Dinámico</title>
</head>
<body>
    <h1>Fecha y Hora actuales</h1>

    <div>
        <h2>Fecha: </h2>
        <p>
            <?php
            // Mostrar la fecha en formato "Día de la semana, Día de mes de Año"
            echo strftime('%A, %d de %B', time());
            ?>
        </p>

        <h2>Hora: </h2>
        <p>
            <?php
            // Mostrar la hora en formato "Hora:Minutosam/pm"
            echo strftime('%I:%M%p', time());
            ?>
        </p>
    </div>
</body>
</html>
