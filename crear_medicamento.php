<?php
require_once 'controllers/MedicamentosController.php';

// Obtener datos del formulario
$nombreMedi = $_POST['nombreMedi'];
$presentacion = $_POST['presentacion'];
$fabricacion = $_POST['fabricacion'];
$preCompra = $_POST['preCompra'];
$precVenta = $_POST['precVenta'];
$stock = $_POST['stock'];
$fechProduccion = $_POST['fechProduccion']; 
$fechVencimiento = $_POST['fechVencimiento'];
$id_tipoMedi = $_POST['tipoMedicamento'];

$medicamentoController = new MedicamentoController();
$resultado = $medicamentoController->crearMedicamento($nombreMedi, $presentacion, $fabricacion, $preCompra, $precVenta, $stock, $fechProduccion, $fechVencimiento, $id_tipoMedi);

echo "<script>
alert('$resultado');
window.location.href = 'dashboard.php';
</script>";
?>
