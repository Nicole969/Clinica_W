<?php

require_once "config/Conn.php";

class Notificaciones
{
    private $tipo;
    private $mensaje;
    private $fechaEnvio;
    private $id_user;
    private $id_citas;

    public function mostrar()
    {
        $conn = new Conn();
        $conexion = $conn->conectar();
        $sql = "SELECT * FROM Notificaciones";
        $resultado = $conexion->query($sql);
        $conn->cerrar();
        return $resultado;
    }
    
    public function obtenerNotificaciones()
    {
        $conn = new Conn();
        $conexion = $conn->conectar();

        $sql = "SELECT notificacion.ID_Notificacion, notificacion.Tipo, notificacion.Mensaje, notificacion.FechaEnvio, notificacion.Id_User, notificacion.Id_Citas, 
                citas.Fecha AS CitaFecha, citas.Asunto AS CitaAsunto, user.Username AS Usuario
                FROM Notificaciones
                JOIN Citas ON notificacion.Id_Citas = citas.ID_Cita
                JOIN Users ON notificacion.Id_User = user.ID_User";

        $resultado = $conexion->query($sql);

        $notificaciones = [];
        if ($resultado) {
            while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $notificaciones[] = $row;
            }
        }

        $conn->cerrar();
        return $notificaciones;
    }

}
