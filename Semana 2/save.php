<?php
// Configuración de conexión
$servername = "localhost";  // Servidor (XAMPP usa localhost)
$username   = "root";       // Usuario por defecto en XAMPP
$password   = "";           // Contraseña por defecto en XAMPP es vacía
$dbname     = "workshop";   // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
$name     = $_POST['name'];
$lastname = $_POST['lastname'];
$email    = $_POST['email'];
$phone    = $_POST['phone'];

// Insertar en la base de datos
$sql = "INSERT INTO Usuarios (Nombre, Apellido, Correo, Telefono) 
        VALUES ('$name', '$lastname', '$email', '$phone')";

if ($conn->query($sql) === TRUE) {
    echo "Registro guardado correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>

