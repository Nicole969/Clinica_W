<?php

require_once "models/HistorialC.php";

class HistorialClinicoController
{
    public function mostrar()
    {
        $tratamiento = new HistorialC();
        return $tratamiento->mostrar();
    }

    public function agregar($fecha, $altura, $peso, $alergias, $enfermedadesp, $observaciones, $descripcion, $id_user, $id_cita)
    {
        $tratamiento = new HistorialC();
        $tratamiento->crearHist($fecha, $altura, $peso, $alergias, $enfermedadesp, $observaciones, $descripcion, $id_user, $id_cita);
    }

}