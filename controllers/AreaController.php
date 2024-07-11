<?php
require_once dirname(__DIR__) . "/models/Area.php";

class AreaController
{
    public function crearArea($nombre, $descripcion)
    {
        $area = new Area($nombre, $descripcion);
        return $area->crear();
    }

    public function mostrarAreas()
    {
        $area = new Area();
        return $area->mostrar();
    }

    public function obtenerAreaPorId($id)
    {
        $area = new Area();
        return $area->obtenerPorId($id);
    }

    public function editarArea($id, $nombre, $descripcion)
    {
        $area = new Area();
        return $area->editar($id, $nombre, $descripcion);
    }

    public function eliminarArea($id)
    {
        $area = new Area();
        return $area->eliminar($id);
    }
}
?>
