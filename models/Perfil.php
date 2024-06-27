<?php

require_once "config/Conn.php";

class Perfil
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

    public function mostrar()
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM perfil";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }
}
