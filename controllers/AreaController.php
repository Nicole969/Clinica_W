<?php
require_once dirname(__DIR__) . "/models/Area.php";

class AreasController
{
    public function mostrarAreas()
    {
        $area = new Area();
        return $area->mostrar();
    }
}
