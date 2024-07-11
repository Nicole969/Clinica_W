<?php

require_once "config/Conn.php";

class Horarios
{
    public function crearHorario($diaSemana, $horaInicio, $horaFin, $Id_User)
    {
        $conn = new Conn();
        $conexion = $conn->conectar();

        $sql = "INSERT INTO Horarios (diaSemana, horaInicio, horaFin, Id_User) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);

        // Ejecutar la consulta con los parámetros proporcionados
        if ($stmt->execute([$diaSemana, $horaInicio, $horaFin, $Id_User])) {
            $conn->cerrar();
            return true;
        } else {
            error_log('Error al ejecutar la consulta: ' . $stmt->errorInfo()[2]);
            $conn->cerrar();
            return false;
        }
    }

    public function mostrar()
    {
        $conn = new Conn();
        $conexion = $conn->conectar();

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

        $conn->cerrar();

        return $resultados;
    }
}