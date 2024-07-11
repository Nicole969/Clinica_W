<?php
require_once 'controllers/AreaController.php';
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'admin') {
    die("Acceso denegado.");
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

$areaController = new AreaController();
$resultado = $areaController->crearArea($nombre, $descripcion);

echo "<script>
alert('$resultado');
window.location.href = 'dashboard.php';
</script>";
?>