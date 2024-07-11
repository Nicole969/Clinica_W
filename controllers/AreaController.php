<?php
require_once dirname(__DIR__) . "/models/Area.php";

class AreaController
{
    public function mostrarAreas()
    {
        $area = new Area();
        return $area->mostrar();
    }
}
?>
