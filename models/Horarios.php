<?php

require_once "config/Conn.php";

class Horarios
{
    public function crearHorario($diaSemana, $horaInicio, $horaFin, $id_user)
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Horarios";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
    }

    public function mostrar() {
        $conn = new Conn();
        $conexion = $conn->conectar();

        // Query para obtener los horarios
        $sql = "SELECT * FROM Horarios";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();

        $horarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $conn->cerrar();

        return $horarios;
    }

    public function mostrarMisHorarios($id)
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $resultados = [];
        $sql = "SELECT * FROM Horarios WHERE Id_User = ?";
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
}
