<?php

require_once "config/Conn.php";

class HistorialC
{
    private $fecha;
    private $descripcion;
    private $id_user;
    private $id_citas;

    public function mostrar()
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Historial_Clinico";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }
}
