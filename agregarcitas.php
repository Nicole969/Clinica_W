<?php
require_once 'controllers/CitaController.php';

$citaController = new CitasController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $asunto = $_POST['asunto'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $tiempo = $_POST['tiempo'];
    $estado = $_POST['estado'];
    $id_user = $_POST['id_user'];

    $citaController->agregar($asunto, $descripcion, $fecha, $hora, $tiempo, $estado, $id_user);

    header("Location: perfil.php");
    exit();
}
?>