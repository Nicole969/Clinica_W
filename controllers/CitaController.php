<?php

require_once "models/Citas.php";

class CitasController
{
    public function mostrar()
    {
        $citas = new Citas();
        return $citas->mostrar();
    }
}
