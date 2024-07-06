<?php

require_once "controllers/UsuarioController.php";
require_once "controllers/CitaController.php";

$usuarioController = new UsuarioController();
$usuarios = $usuarioController->mostrarTodos();
$pacientes = $usuarioController->mostrarPaciente();
$medicos = $usuarioController->mostrarMedicos();
$citaController = new CitasController();
$citas = $citaController->mostrar();

session_start();

if (!isset($_SESSION["id"])) {
    # SI LA SESION NO EXISTE TE MANDO AL LOGIN
    session_start();
    header("location: login.php");
}

if ($_SESSION["tipo"] == "paciente") {
    header("location: home.php");
}

?>
<?php
require_once 'layout/header.php';
require_once 'layout/nav.php';
?>

<div class="bg-gray-100 h-full">

</div>