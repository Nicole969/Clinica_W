<?php
require_once 'controllers/TiposMedicamentosController.php';
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'admin') {
    die("Acceso denegado.");
}

// Verificar si se enviaron los datos esperados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $nombre = isset($_POST['nomTipoMedi']) ? $_POST['nomTipoMedi'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';

    // Verificar si ambos campos están presentes
    if (!empty($nombre)) {
        $tipoMedicamentoController = new TipoMedicamentoController();
        $resultado = $tipoMedicamentoController->crearTipoMedicamento($nombre, $descripcion);

        echo "<script>
        alert('$resultado');
        window.location.href = 'dashboard.php';
        </script>";
    } else {
        die("Error: Campos no definidos en el formulario.");
    }
} else {
    die("Error: Método de solicitud incorrecto.");
}
?>
