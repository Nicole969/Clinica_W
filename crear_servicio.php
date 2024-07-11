<?php
require_once 'controllers/ServicioController.php';
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'admin') {
    die("Acceso denegado.");
}

// Obtener datos del formulario aaaaaaaa
$servicio = $_POST['servicio'];
$descripcion = $_POST['descripcion'];
$costo = $_POST['costo'];

$servicioController = new ServicioController();
$resultado = $servicioController->crearServicio($servicio, $descripcion, $costo);

echo "<script>
alert('$resultado');
window.location.href = 'dashboard.php';
</script>";
?> 