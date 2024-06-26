<?php

require_once "config/Conn.php";

class Citas
{
    private $asunto;
    private $descripcion;
    private $fecha;
    private $hora;
    private $tiempo;
    private $estado;
    private $id_user;

    public function __construct()
    {
        /*    $this->username = $username;
        $this->clave = $clave;
        $this->apellidos = $apellidos;
        $this->nombres = $nombres;
        $this->tipo = $tipo;
        $this->id_escuela = $id_escuela;
        $this->email = $email; */
    }

    public function mostrar()
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM user";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function login($username)
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM user WHERE username = '$username' ";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }
}
