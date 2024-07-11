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
        $sql = "SELECT * FROM Citas";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }

    public function mostrarMisCitas($id)
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $resultados = [];
        $sql = "SELECT * FROM Citas WHERE ID_Paciente = ?";
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
        $sql = "INSERT INTO Citas(Asunto, Descripcion, Fecha, Hora, Tiempo, Estado, ID_Paciente) 
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

    // models/para ver las citas que tiene asignado cada medico
    public function mostrarCitasMedico($id)
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $resultados = [];
        
        // Ejemplo de consulta SQL utilizando JOIN para obtener detalles del paciente y otros campos necesarios
        $sql = "SELECT Citas.ID_Cita,Citas.Estado,Citas.Title, Citas.Hora_Inicial, Citas.Hora_Final, 
        Citas.Descripcion, Citas.Estado, Citas.Start,
        Pacientes.Username AS NombrePaciente, Pacientes.Correo AS CorreoPaciente
        FROM Citas
        INNER JOIN Users AS Pacientes ON Citas.ID_Paciente = Pacientes.ID_User
        WHERE Citas.ID_Medico = ?";

        $stmt = $conexion->prepare($sql);

        if ($stmt->execute([$id])) {
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $resultados[] = $fila;
            }
        } else {
            error_log('Error al ejecutar la consulta: ' . $stmt->errorInfo()[2]);
        }

        return $resultados;
    }

}
