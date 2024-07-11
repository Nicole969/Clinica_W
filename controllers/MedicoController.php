<?php

require_once dirname(__DIR__) . "/models/Medico.php";

class MedicoController
{
    public function crearMedico($username, $clave, $confirmClave, $correo, $nombre, $apellidos, $celular, $direccion, $especialidad, $fecha, $dni, $id_area, $id_rol)
    {
        $medico = new Medico($username, $clave, $confirmClave, $correo, $nombre, $apellidos, $celular, $direccion, $especialidad, $fecha, $dni, $id_area, $id_rol);
        return $medico->crear();
    }
  
}
?>
