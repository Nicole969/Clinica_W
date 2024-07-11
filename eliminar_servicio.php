<?php
// Iniciar sesión para verificar permisos
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'admin') {
    die("Acceso denegado.");
}

// Verificar si se ha proporcionado un ID de servicio por GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID de servicio no proporcionado.");
}

$id_servicio = $_GET['id'];

// Incluir el controlador de Servicio
require_once 'controllers/ServicioController.php';

// Crear una instancia del controlador
$servicioController = new ServicioController();

// Intentar eliminar el servicio
$resultado = $servicioController->eliminarServicio($id_servicio);

// Redirigir al dashboard después de eliminar
echo "<script>
    alert('$resultado');
    window.location.href = 'dashboard.php';
    </script>";
?>
