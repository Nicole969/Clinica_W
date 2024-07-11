<?php
require_once dirname(__DIR__) . "/models/Servicio.php";

class ServicioController
{
    public function crearServicio($servicio, $descripcion, $costo)
    {
        $servicioModel = new Servicio($servicio, $descripcion, $costo);
        return $servicioModel->crear();
    }

    public function mostrarServicios()
    {
        $servicioModel = new Servicio();
        return $servicioModel->mostrar();
    }

    public function obtenerServicioPorId($id)
    {
        $servicioModel = new Servicio();
        return $servicioModel->obtenerPorId($id);
    }

    public function editarServicio($id, $servicio, $descripcion, $costo)
    {
        $servicioModel = new Servicio();
        return $servicioModel->editar($id, $servicio, $descripcion, $costo);
    }

    public function eliminarServicio($id)
    {
        $servicioModel = new Servicio();
        return $servicioModel->eliminar($id);
    }
}
?>
