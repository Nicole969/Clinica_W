<?php

require_once "config/Conn.php";

class Notificaciones
{
    private $tipo;
    private $mensaje;
    private $fechaEnvio;
    private $id_user;
    private $id_citas;

    public function mostrar()
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM notificacion";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }
}
