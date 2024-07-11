<?php
require_once 'controllers/MedicamentosController.php';
require_once 'config/Conn.php';
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'admin') {
    die("Acceso denegado.");
}

$id_medi = $_GET['id'];  // Asegúrate de que 'id' en la URL sea el ID correcto del medicamento
$medicamentoController = new MedicamentoController();
$resultado = $medicamentoController->eliminarMedicamento($id_medi);

echo "<script>
alert('$resultado');
window.location.href = 'dashboard.php';
</script>";
?>
