<?php


require_once "models/Notificaciones.php";

class NotificacionController
{
   
    public function obtenerNotificaciones()
    {
        $modelo = new Notificaciones();
        $notificaciones = $modelo->obtenerNotificaciones();
        return $notificaciones;
    }

}
