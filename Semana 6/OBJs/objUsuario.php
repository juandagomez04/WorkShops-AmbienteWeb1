<?php
// objUsuario.php
abstract class objUsuario
{
    protected string $nombre;
    protected string $apellidos;
    protected string $username;
    protected string $email;
    protected string $contrasena;
    protected int $provinciaId;

    public function __construct($nombre, $apellidos, $username, $email, $contrasena, $provinciaId)
    {
        $this->nombre = trim($nombre);
        $this->apellidos = trim($apellidos);
        $this->username = trim($username);
        $this->email = trim($email);
        $this->contrasena = password_hash($contrasena, PASSWORD_BCRYPT);
        $this->provinciaId = (int)$provinciaId;    
    }

    // Getters
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getApellidos()
    {
        return $this->apellidos;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getContrasena()
    {
        return $this->contrasena;
    }
    public function getProvinciaId()
    {
        return $this->provinciaId;
    }

    // Métodos Setters
    public function setNombre($nombre)
    {
        $this->nombre = trim($nombre);
    }
    public function setApellidos($apellidos)
    {
        $this->apellidos = trim($apellidos);
    }
    public function setUsername($username)
    {
        $this->username = trim($username);
    }
    public function setEmail($email)
    {
        $this->email = trim($email);
    }
    public function setContrasena($contrasena)
    {
        $this->contrasena = password_hash($contrasena, PASSWORD_BCRYPT);
    }
    public function setProvincia($provinciaId)
    {
        $this->provinciaId = (int)$provinciaId;
    }

    // Método que se implementa diferente en cada subclase
    abstract public function registrar(): bool;
}

