<?php

require_once dirname(__DIR__) . "/models/Medicamentos.php";

class MedicamentoController
{
    public function crearMedicamento($nombreMedi, $presentacion, $fabricacion, $preCompra, $precVenta, $stock, $fechProduccion, $fechVencimiento, $id_tipoMedi)
    {
        $medicamentoModel = new Medicamento($nombreMedi, $presentacion, $fabricacion, $preCompra, $precVenta, $stock, $fechProduccion, $fechVencimiento, $id_tipoMedi);
        return $medicamentoModel->crear();
    }

    public function mostrarMedicamentos()
    {
        $medicamento = new Medicamento();
        return $medicamento->mostrar();
    }

    public function obtenerMedicamentoPorId($id_medi)
    {
        $medicamentoModel = new Medicamento();
        return $medicamentoModel->obtenerPorId($id_medi);
    }

    public function editarMedicamento($id_medi, $nombreMedi, $presentacion, $fabricacion, $preCompra, $precVenta, $stock, $fechProduccion, $fechVencimiento, $id_tipoMedi)
    {
        $medicamentoModel = new Medicamento();
        return $medicamentoModel->editar($id_medi, $nombreMedi, $presentacion, $fabricacion, $preCompra, $precVenta, $stock, $fechProduccion, $fechVencimiento, $id_tipoMedi);
    }

    public function eliminarMedicamento($id)
    {
        $medicamentoModel = new Medicamento();
        return $medicamentoModel->eliminar($id);
    }
}
?>
