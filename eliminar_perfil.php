<?php
require_once 'controllers/PerfilController.php';
session_start();


if (!isset($_SESSION['id']) || $_SESSION['tipo'] != 'admin') {
    die("Acceso denegado.");
}

// Verificar si se recibió un ID válido a través de GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de perfil médico no válido.");
}

$idPerfil = $_GET['id'];

// Crear instancia del controlador y realizar la eliminación del perfil médico
$perfilController = new PerfilController();
$resultado = $perfilController->eliminarPerfil($idPerfil);

// Redirigir de vuelta al panel de control con un mensaje de alerta
echo "<script>
alert('$resultado');
window.location.href = 'perfil.php';
</script>";
?>
