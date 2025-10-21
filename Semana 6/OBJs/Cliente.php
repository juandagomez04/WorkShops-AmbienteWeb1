<?php
// OBJs/Cliente.php
require_once __DIR__ . '/objUsuario.php';

class Cliente extends objUsuario
{

    private $conn;

    // Abre conexión
    private function conectar()
    {
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "workshop4";

        $this->conn = new mysqli($host, $user, $pass, $db);
        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
        $this->conn->set_charset("utf8mb4");
    }

    public function registrar(): bool
    {
        return $this->guardarCliente();
    }

    // Guarda el cliente en la base de datos 
    public function guardarCliente(): bool
    {
        $this->conectar();

        // 1) Validar provincia
        $provinciaId = $this->getProvinciaId();
        $chk = $this->conn->prepare("SELECT 1 FROM provincias WHERE id=?");
        $chk->bind_param("i", $provinciaId);
        $chk->execute();
        $chk->store_result();
        if ($chk->num_rows === 0) {
            $chk->close();
            $this->conn->close();
            die("Provincia inválida (id={$provinciaId}).");
        }
        $chk->close();

        // 2) Insertar usuario
        $sql = "INSERT INTO usuarios (nombre, apellidos, username, email, contrasena, provincia_id)
            VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Error al preparar la consulta: " . $this->conn->error);
        }

        $nombre = $this->getNombre();
        $apellidos = $this->getApellidos();
        $username = $this->getUsername();
        $email = $this->getEmail();
        $contrasena = $this->getContrasena();

        $stmt->bind_param("sssssi", $nombre, $apellidos, $username, $email, $contrasena, $provinciaId);

        $ok = $stmt->execute();
        if (!$ok) {
            echo "Error al registrar: " . $stmt->error;
        }

        $stmt->close();
        $this->conn->close();
        return $ok;
    }
}

