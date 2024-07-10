<?php

require_once "config/Conn.php";

class Citas
{

    private $title;
    private $start;
    private $end;
    private $color;
    private $hora_inicial;
    private $hora_final;
    private $fecha_cr;
    private $fecha_up;
    private $descripcion;
    private $estado;
    private $id_paciente;
    private $id_medico;
    private $id_servicio;


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

    public function crear($title,$start,$end,$color,$hora_inicial,$hora_final,$fecha_cr,$fecha_up,$descripcion,$estado,$id_paciente,$id_medico,$id_servicio)
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "INSERT INTO Citas(Title,Start,End,Color,Hora_Inicial,Hora_Final,Fecha_Cr,Fecha_Up,Descripcion,Estado,ID_Paciente,ID_Medico,ID_Servicio) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $resultado = $stmt->execute([$title, $start, $end, $color, $hora_inicial, $hora_final, $fecha_cr, $fecha_up, $descripcion, $estado, $id_paciente, $id_medico, $id_servicio]);

        if ($resultado === false) {
            echo "Error al crear la cita";
        } else {
            echo "Cita creada correctamente";
        }
        $conn->cerrar();
        return $resultado;
    }
}
