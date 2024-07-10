<?php
session_start();

require_once "controllers/CitaController.php";

$citaController = new CitasController();
$citas = $citaController->mostrarMisCitas($_SESSION["id"]);


if (!isset($_SESSION["id"])) {
    # SI LA SESION NO EXISTE TE MANDO AL LOGIN
    header("location: login.php");
}

if ($_SESSION["tipo"] == "admin") {
    header("location: dashboard.php");
}
//historialclinico
//---enfermedades que podria tener, enfemedades posteriores, antes de la primera vez que saca cita (todos los medicos)
//historial de citas
//---sus cita pasadas, etc 
?>

<?php
require_once 'layout/header.php';
require_once 'layout/nav.php';
?>

<div class="p-2 bg-gray-100">
    <h2>Historial de mis Citas</h2>
    <table>
        <thead>
            <tr>
                <th>Asunto</th>
                <th>Descripcion</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($citas as $cita) : ?>
                <tr>
                    <td><?php echo $cita["Asunto"] ?></td>
                    <td><?php echo $cita["Descripcion"] ?></td>
                    <td><?php echo $cita["Fecha"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>