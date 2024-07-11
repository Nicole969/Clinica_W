<?php
require_once dirname(__DIR__) . "/models/TiposMedicamentos.php";

class TipoMedicamentoController
{
    public function crearTipoMedicamento($nomTipoMedi, $descripcion)
    {
        $tipoMedicamento = new TipoMedicamento($nomTipoMedi, $descripcion);
        return $tipoMedicamento->crear();
    }

    public function mostrarTiposMedicamentos()
    {
        $tipoMedicamento = new TipoMedicamento();
        return $tipoMedicamento->mostrar();
    }

    public function obtenerTipoMedicamentoPorId($id)
    {
        $tipoMedicamento = new TipoMedicamento();
        return $tipoMedicamento->obtenerPorId($id);
    }

    public function editarTipoMedicamento($id, $nomTipoMedi, $descripcion)
    {
        $tipoMedicamento = new TipoMedicamento();
        return $tipoMedicamento->editar($id, $nomTipoMedi, $descripcion);
    }

    public function eliminarTipoMedicamento($id)
    {
        $tipoMedicamento = new TipoMedicamento();
        return $tipoMedicamento->eliminar($id);
    }
}

?>
