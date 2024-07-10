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

        $sql = "SELECT Notificaciones.ID_Notificacion, Notificaciones.Tipo, Notificaciones.Mensaje, Notificaciones.FechaEnvio, Notificaciones.Id_User, Notificaciones.Id_Cita, 
                Citas.Fecha_Cr AS CitaFecha, Citas.Title AS CitaAsunto, Users.Username AS Usuario
                FROM Notificaciones
                JOIN Citas ON Notificaciones.Id_Cita = Citas.ID_Cita
                JOIN Users ON Notificaciones.Id_User = Users.ID_User";

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
