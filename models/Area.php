<?php

require_once dirname(__DIR__) . "/config/Conn.php";

class Area
{
    private $id_area;
    private $nombre;
    private $descripcion;

    public function mostrar()
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Area";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }
}
?>
