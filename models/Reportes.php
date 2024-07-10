<?php

require_once "config/Conn.php";

class Reportes
{
    private $username;
    private $clave;
    private $tipo;
    private $confirmclave;
    private $id_rol;
    private $email;

    public function mostrar()
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Reportes";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }
}
