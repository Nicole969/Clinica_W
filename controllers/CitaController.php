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

    public function agregar($title,$start,$end,$color,$hora_inicial,$hora_final,$fecha_cr,$fecha_up,$descripcion,$estado,$id_user)
    {
        $citas = new Citas();
        $citas->crear($title,$start,$end,$color,$hora_inicial,$hora_final,$fecha_cr,$fecha_up,$descripcion,$estado,$id_user);
    }
}
