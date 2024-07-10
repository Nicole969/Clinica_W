<?php

require_once "config/Conn.php";

class Horarios
{
    private $diaS;
    private $horaInicio;
    private $horaFin;
    private $id_user;

    public function mostrar()
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Horarios";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }
}
