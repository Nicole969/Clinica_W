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

if ($_SESSION["tipo"] == "paciente") {
    header("location: home.php");
}

?>
<?php
require_once 'layout/header.php';
require_once 'layout/nav.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h2>ERES PACIENTE O DOC? soy <?php echo $_SESSION["tipo"] ?></h2>
    <table>
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Correos</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario) : ?>
                <tr>
                    <td><?php echo $usuario["Username"] ?></td>
                    <td><?php echo $usuario["Correo"] ?></td>
                    <td><?php echo $usuario["tipo"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>