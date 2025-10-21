<?php
$username = isset($_GET['u']) ? $_GET['u'] : '';
?>
<!DOCTYPE html>
<html lang="es">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <form action="complete.html" method="get">
        <h2>Iniciar Sesión</h2>

        <div class="field">
            <label for="user">Usuario</label>
            <input id="user" name="username" type="text" value="<?php echo htmlspecialchars($username); ?>" required>
        </div>

        <div class="field">
            <label for="pass">Contraseña</label>
            <input id="pass" name="password" type="password" required>
        </div>

        <button type="submit">Entrar</button>

    </form>
    <form action="register.php" method="get"> 
        <button type="submit" style="background-color: #4CAF50; color: white;">Registrarse</button>
    </form>
</body>

</html>