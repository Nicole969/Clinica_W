<?php

require_once "models/Recetas.php";

class RecetaController
{
    public function mostrar()
    {
        $tratamiento = new Recetas();
        return $tratamiento->mostrar();
    }

    public function agregar($fecha, $descripcion, $id_user, $id_cita)
    {
        $tratamiento = new Recetas();
        $tratamiento->crearRecetas($fecha, $descripcion, $id_user, $id_cita);
    }

}