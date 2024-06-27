<?php

require_once "config/Conn.php";

class Citas
{
    private $asunto;
    private $descripcion;
    private $fecha;
    private $hora;
    private $tiempo;
    private $estado;
    private $id_user;


    public function mostrar()
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM citas";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function mostrarMisCitas($id)
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $resultados = [];
        $sql = "SELECT * FROM citas WHERE Id_User = ?";
        $stmt = $conexion->prepare($sql);

        // Vincular el parámetro 'id'
        if ($stmt->execute([$id])) {
            // Obtener los resultados
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $resultados[] = $fila; // Añadir cada usuario a la lista
            }
        } else {
            error_log('Error al ejecutar la consulta: ' . $stmt->errorInfo()[2]);
        }

        return $resultados;
    }

    public function crear($asunto, $descripcion, $fecha, $hora, $tiempo, $estado, $id_user)
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "INSERT INTO citas(Asunto, Descripcion, Fecha, Hora, Tiempo, Estado, Id_User) 
            VALUES ('$asunto','$descripcion', '$fecha', '$hora', '$tiempo', '$estado', $id_user)";
        $resultado = $conexion->exec($sql);

        if ($resultado === false) {
            echo "Error al crear la cita";
        } else {
            echo "Cita creada correctamente";
        }
        $conn->cerrar();
        return $resultado;
    }
}
