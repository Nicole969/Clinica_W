<?php

require_once "config/Conn.php";

class Usuario
{
    private $nombre;
    private $apellidos;
    private $celular;
    private $direccion;
    private $especialidad;
    private $fecha;
    private $dni;
    private $id_reportes;
    private $id_rol;

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
