<?php
session_start();

require_once "controllers/CitaController.php";

$citaController = new CitasController();
$citas = $citaController->mostrarTodasC($_SESSION["id"]);


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

<div class="flex flex-col items-center">
    <div class="w-1/2 bg-white p-6 rounded-lg mt-10">
        <h2 class="text-2xl font-bold">Historial de mis Citas</h2>
    </div>
    <table class=" bg-white border border-gray-200">
        <thead class="bg-gray-300">
            <tr>
                <th class="py-2 px-4 border-b border-gray-400">Asunto</th>
                <th class="py-2 px-4 border-b border-gray-400">Fecha</th>
                <th class="py-2 px-4 border-b border-gray-400">Medico</th>
                <th class="py-2 px-4 border-b border-gray-400">Hora</th>
                <th cclass="py-2 px-4 border-b border-gray-400">Servicio</th>
                <th class="py-2 px-4 border-b border-gray-400">Descripcion</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($citas as $cita) : ?>
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border-b border-gray-300"><?php echo $cita["Title"] ?></td>
                    <td class="py-2 px-4 border-b border-gray-300"><?php echo $cita["Start"] ?></td>
                    <td class="py-2 px-4 border-b border-gray-300"><?php echo $cita["Medico"] ?></td>
                    <td class="py-2 px-4 border-b border-gray-300"><?php echo $cita["Hora_Inicial"] ?></td>
                    <td class="py-2 px-4 border-b border-gray-300"><?php echo $cita["Servicio"] ?></td>
                    <td class="py-2 px-4 border-b border-gray-300"><?php echo $cita["Descripcion"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>