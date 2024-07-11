<?php

require_once "config/Conn.php";

class Tratamientos
{
    public function mostrar()
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM tratamientos";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function crearTratamiento($Cantidad, $Dosis, $Duracion, $ID_Medico, $ID_Cita)
    {
        $conn = new Conn();
        $conexion = $conn->conectar();

        $sql = "INSERT INTO tratamientos(Cantidad, Dosis, Duracion, ID_Medico, ID_Cita) 
                VALUES ('$Cantidad', '$Dosis', '$Duracion', '$ID_Medico', '$ID_Cita')";
        
        
        $resultado = $conexion->exec($sql);

        if ($resultado === false) {
            echo "Error al crear tratamiento";
        } else {
            echo "Tratamiento creada correctamente";
        }

        $conn->cerrar();
        return $resultado;
    }
}
