<?php

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