<?php
require_once dirname(__DIR__) . "/models/Perfil.php";

class PerfilController
{
    public function crearPerfil($nombre, $apellidos, $celular, $direccion, $especialidad, $fechaNac, $fechaContrato, $sueldoEmpleado, $dni, $idReportes, $idRol, $idArea)
    {
        $perfil = new Perfil($nombre, $apellidos, $celular, $direccion, $especialidad, $fechaNac, $fechaContrato, $sueldoEmpleado, $dni, $idReportes, $idRol, $idArea);
        return $perfil->crear();
    }

    public function mostrarPerfiles()
    {
        $perfil = new Perfil();
        return $perfil->mostrarTodos();
    }

    public function obtenerPerfilPorId($id)
    {
        $perfil = new Perfil();
        return $perfil->obtenerPorId($id);
    }

    public function editarPerfil($id, $nombre, $apellidos, $celular, $direccion, $especialidad, $fechaNac, $fechaContrato, $sueldoEmpleado, $dni, $idReportes, $idRol, $idArea)
    {
        $perfil = new Perfil();
        return $perfil->editar($id, $nombre, $apellidos, $celular, $direccion, $especialidad, $fechaNac, $fechaContrato, $sueldoEmpleado, $dni, $idReportes, $idRol, $idArea);
    }

    public function eliminarPerfil($id)
    {
        $perfil = new Perfil();
        return $perfil->eliminar($id);
    }
}
?>
