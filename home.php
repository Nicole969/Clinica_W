<?php

session_start();

if (!isset($_SESSION["id"])) {
    # SI LA SESION NO EXISTE TE MANDO AL LOGIN
    header("location: login.php");
}

if ($_SESSION["tipo"] == "admin") {
    header("location: dashboard.php");
}

?>

<?php
require_once 'layout/header.php';
require_once 'layout/nav.php';
?>
