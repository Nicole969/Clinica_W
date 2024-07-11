<?php

require_once "models/Tratamientos.php";

class TratamientoController
{
    public function mostrar()
    {
        $tratamiento = new Tratamientos();
        return $tratamiento->mostrar();
    }

    public function agregar($Cantidad, $Dosis, $Duracion, $ID_Medico, $ID_Cita)
    {
        $tratamiento = new Tratamientos();
        $tratamiento->crearTratamiento($Cantidad, $Dosis, $Duracion, $ID_Medico, $ID_Cita);
    }

}