<?php

require_once "models/Horarios.php";
class HorarioController {
    public function mostrarHorarios() {
        $horarios = new Horarios();
        return $horarios->mostrar();
    }

    public function mostrarMisHorarios($id)
    {
        $citas = new Horarios();
        return $citas->mostrarMisHorarios($id);
    }
}