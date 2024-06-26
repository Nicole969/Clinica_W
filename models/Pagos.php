<?php

require_once "config/Conn.php";

class Usuario
{
    private $monto;
    private $descuento;
    private $saldo;
    private $total;
    private $id_paciente;

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
