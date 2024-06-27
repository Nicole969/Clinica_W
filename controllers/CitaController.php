<?php

require_once "models/Citas.php";

class CitasController
{
    public function mostrar()
    {
        $citas = new Citas();
        return $citas->mostrar();
    }

    public function mostrarMisCitas($id)
    {
        $citas = new Citas();
        return $citas->mostrarMisCitas($id);
    }

    public function agregar($asunto, $descripcion, $fecha, $hora, $tiempo, $estado, $id_user)
    {
        $citas = new Citas();
        $citas->crear($asunto, $descripcion, $fecha, $hora, $tiempo, $estado, $id_user);
    }
}
