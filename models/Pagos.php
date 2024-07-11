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

    public function crearRecetas($Monto, $Descuento, $Saldo, $Total, $FechaPago, $MetodoPago, $id_cita, $id_paciente)
    {
        $conn = new Conn();
        $conexion = $conn->conectar();

        $sql = "INSERT INTO pagos(Monto, Descuento, Saldo, Total, FechaPago, MetodoPago ID_Cita, ID_Paciente ) 
                VALUES ('$Monto', '$Descuento', $Saldo, $Total, $FechaPago, $MetodoPago,$id_cita, $id_paciente )";


        $resultado = $conexion->exec($sql);

        if ($resultado === false) {
            echo "Error al crear recetas";
        } else {
            echo "Recetas creada correctamente";
        }

        $conn->cerrar();
        return $resultado;
    }
}
