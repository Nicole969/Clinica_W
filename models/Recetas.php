<?php

require_once "config/Conn.php";

class Recetas
{
    public function mostrar()
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM recetas";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function crearRecetas($fecha, $descripcion, $id_user, $id_cita)
    {
        $conn = new Conn();
        $conexion = $conn->conectar();

        $sql = "INSERT INTO recetas(Fecha, Descripcion, ID_User, ID_Cita) 
                VALUES ('$fecha', '$descripcion', $id_user, $id_cita)";
        
        
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
