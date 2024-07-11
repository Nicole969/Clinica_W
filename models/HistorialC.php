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

    public function crearHist($fecha, $altura, $peso, $alergias, $enfermedadesp, $observaciones, $descripcion, $id_user, $id_cita)
    {
        $conn = new Conn();
        $conexion = $conn->conectar();

        $sql = "INSERT INTO historial_clinico(Fecha, Altura, Peso, Alergias, EnfermedadesPrevias, Observaciones, Descripcion, ID_User, ID_Cita) 
                VALUES ('$fecha', $altura, $peso, '$alergias', '$enfermedadesp', '$observaciones', '$descripcion', $id_user, $id_cita)";
        
        
        $resultado = $conexion->exec($sql);

        if ($resultado === false) {
            echo "Error al crear HISTORIAL";
        } else {
            echo "HISTORIAL creada correctamente";
        }

        $conn->cerrar();
        return $resultado;
    }
}
