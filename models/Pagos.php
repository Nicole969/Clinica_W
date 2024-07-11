<?php

require_once "config/Conn.php";

class Pagos
{
    private $monto;
    private $descuento;
    private $saldo;
    private $total;
    private $id_paciente;

    public function mostrar()
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Pagos";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }
}
