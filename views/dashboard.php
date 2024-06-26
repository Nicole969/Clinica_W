<?php

require_once "controllers/UsuarioController.php";
$usuarioController = new UsuarioController();
$usuarios = $usuarioController->mostrar();

session_start();

if (!isset($_SESSION["id"])) {
    # SI LA SESION NO EXISTE TE MANDO AL LOGIN
    session_start();
    header("location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <a href="../logout.php">Cerrar sesion</a>
    <h2>ERES PACIENTE O DOC?</h2>
</body>

</html>