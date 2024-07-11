<?php

require_once dirname(__DIR__) . "/models/Medico.php";

class MedicoController
{
    public function crearMedico($username, $clave, $confirmClave, $correo, $nombre, $apellidos, $celular, $direccion, $especialidad, $fechaNac, $fechaContrato, $sueldoEmpleado, $dni, $idReportes, $idRol, $idArea)
    {
        $medico = new Medico($username, $clave, $confirmClave, $correo, $nombre, $apellidos, $celular, $direccion, $especialidad, $fechaNac, $fechaContrato, $sueldoEmpleado, $dni, $idReportes, $idRol, $idArea);
        return $medico->crear();
    }
  
}
?>